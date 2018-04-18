<?php

class BaseSql {
    private $sTable;
    private $sId;
    private $oPdo;
    private $aColumns;

    public function getTable() {
        return $this->sTable;
    }

    public function getId() {
        return $this->sId;
    }

    public function getPdo() {
        return $this->oPdo;
    }

    public function __construct() {
        $this->sTable = strtolower(get_called_class());

        if ( $this->sTable == "capacities" ) {
            $this->sId = "id_capacity";
        } else if ( $this->sTable == "categories" ) {
            $this->sId = "id_category";
        } else {
            $this->sId = substr_replace("id_" . $this->sTable, "", -1);
        }

        try {
            // Connexion à la bdd
            $this->oPdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASSWORD);
        } catch (Expression $e) {
            die("Erreur " . $e->getMessage());
        }

    }
    
    public function setColumns() {
        $aColumnsExcluded = get_class_vars(get_class());
        // Retire les attributs de cette class : sTable oPdo aColumns
        // On ne garde que les attributs de la classe enfant
        $this->aColumns = array_diff_key(get_object_vars($this), $aColumnsExcluded);
    }

    public function cleanColumns() {
        foreach ($this->aColumns as $sKey => $sValue) {
            if (!$sValue) {
                unset($this->aColumns[$sKey]);
            }
        }
    }
    
    public function save() {
        $this->setColumns();

        if ( $this->aColumns[$this->sId] ) {
            $this->cleanColumns();

            foreach ($this->aColumns as $sKey => $sValue) {
                $aSqlSet[] =  $sKey . " = :" . $sKey;
            }

            $sQuery = "UPDATE " . $this->sTable . " SET " . implode( ", ", $aSqlSet ) . " WHERE " . $this->sId . " = :" . $this->sId;
            $oRequest = $this->oPdo->prepare($sQuery);
            $oRequest->execute($this->aColumns);
        } else {
            unset($this->aColumns[$this->sId]);
            $sUsersColumns = implode(",", array_keys($this->aColumns));
            $sValuesColumns = implode(",:", array_keys($this->aColumns));

            $sQuery = "INSERT INTO " . $this->sTable . " (" .  $sUsersColumns . ")" . " VALUES (:" . $sValuesColumns . ")";
            $oRequest = $this->oPdo->prepare($sQuery);
            $oRequest->execute($this->aColumns);
        }
    }

    public function select( $aSelect = "*" ) {
        $this->setColumns();
        $this->cleanColumns();
        
        $aSelect === "*" ? : $aSelect = implode(', ', $aSelect);
        
        foreach ($this->aColumns as $sKey => $sValue) {
            $aSqlSet[] =  $sKey . " = :" . $sKey;
        }
        
        if ( $aSqlSet ) {
            $sQuery = "SELECT " . $aSelect . " FROM " . $this->sTable . " WHERE " . implode( " AND ", $aSqlSet );
        } else {
            $sQuery = "SELECT " . $aSelect . " FROM " . $this->sTable;
        }
        $oRequest = $this->oPdo->prepare( $sQuery );
        $oRequest->execute( $this->aColumns );

        return $oRequest->fetchAll();
    }

    public function search() {
        $this->setColumns();
        $this->cleanColumns();
        
        foreach ($this->aColumns as $sKey => $sValue) {
            $aSqlSet[] =  $sKey . " LIKE :" . $sKey;
            $this->aColumns[$sKey] = '%' . $sValue . '%';
        }
        
        $sQuery = "SELECT * FROM " . $this->sTable . " WHERE " . implode( " AND ", $aSqlSet );

        $oRequest = $this->oPdo->prepare( $sQuery );
        $oRequest->execute( $this->aColumns );

        return $oRequest->fetchAll();
    }

    public function isLoginValids($sEmail, $sPwd) {
        $sQuery = "SELECT pwd FROM " . $this->sTable . " WHERE email = :email";
        $oRequest = $this->oPdo->prepare($sQuery);
        $oRequest->execute(array(':email' => $sEmail));

        if ( $aResults = $oRequest->fetch() ) {
            if ( password_verify( $sPwd, $aResults['pwd'] ) ) {
                return 1;
            }
        }

        return 0;
    }

}