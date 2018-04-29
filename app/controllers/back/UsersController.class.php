<?php

class UsersController {

    /*
    * View listing des utilisateurs
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("users", "back");
        $oUser = new Users();

        $aConfigs = $oUser->select();
        $aConfigs = $oUser->unsetKeyColumns($aConfigs, array('date_inserted', 'date_updated', 'token', 'pwd'));
        $aConfigs['label'] = array('id', 'prénom', 'nom', 'genre', 'âge', 'email', 'adresse', 'postal', 'ville', 'status', 'options');

        foreach ( $aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'birthday_date') {
                    $aValue[$sKey] = Helper::getAge($aValue[$sKey]);
                }
                if ( $sKey === 'sexe') {
                    $aValue[$sKey] = Helper::getSexe($aValue[$sKey]);
                }
                if ( $sKey === 'status') {
                    $aValue[$sKey] = Helper::getStatus($aValue[$sKey]);
                }
                if ( !$aValue[$sKey] ) {
                    $aValue[$sKey] = 'Non renseigné';
                }
            }
        }

        $oView->assign("aConfigs", $aConfigs);
    }

    /*
    * View profil utilisateur
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * Formulaire d'ajout utilisateur 
    */ 
    public function addAction( $aParams ) {

    }

    /*
    * Update d'un utilisateur en bdd 
    */ 
    public function updateAction( $aParams ) {
        // if ($_POST['update']) {
            // $oProduct = new Products(); 
            // $oProduct->setProductName($_POST['search']);
            // $oAllProducts = $oProduct->search();   

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        // } else {
        //     http_response_code(404);            
        // }
        // $oToken = new Token();
        // $oToken->setTokenSession();
        
        // $oUser = new Users();
        // $oUser->setId(1);
        // $oUser->setFirstname('Test');
		// $oUser->setLastname('taing');
		// $oUser->setEmail('Lol@gmail.com');
		// $oUser->setPwd('Test1234');
		// $oUser->setBirthdayDate('1996-01-05');
        // $oUser->setToken($oToken->getToken());
        // $oUser->setSexe(0);
        // $oUser->setAddress('Address');
        // $oUser->setCity('Ville');
        // $oUser->setZipCode(01234);
		// $oUser->setStatus(1);
		// $oUser->save();
    }

    /*
    * Update des droits utilisateur en bdd 
    */ 
    public function updateRightsAction( $aParams ) {

    }

    /*
    * Suppression d'un utilisateur en bdd
    */ 
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $oUser = new Users();

            $oUser->setId($_GET['id']);
            $sStatus = $oUser->select(array('status'))[0]['status'];

            $sStatus ? $oUser->setStatus(0) : $oUser->setStatus(1);                
            $oUser->save();

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        } else {
            http_response_code(404);            
        }
    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des utilisateur(s)
    */ 
    public function searchAction( $aParams ) {
        if ($_POST['search']) {
            $oUser = new Users(); 
            $oUser->setEmail($_POST['search']);
            $oAllEmails = $oUser->search();   

            http_response_code(200);
            echo json_encode($oAllEmails);
        } else {
            http_response_code(404);
        }
    }
    
    /**
     * Mail confirmation
     */
    public function confirmAction( $aParams ) {
        if ( $aParams['GET']['token'] ) {
            $oUser = new Users();
            $aTokens = $oUser->select(array('id_user', 'token'));
            $sToken = null;
            $sId = 0;
            $bCheck = false;

            foreach ( $aTokens as $sKey => $sValue ) {
                if ( $aParams['GET']['token'] === $sValue['token'] ) {
                    $bCheck = true;
                    $sToken = $sValue['token'];
                    $sId = $sValue['id_user'];
                    break;
                }
            }
    
            if ( $bCheck ) {
                $oUser->setId($sId);
                $oUser->setStatus(1);
                $oUser->save();
    
                header('Location: /back');
            }
        }
    }
}