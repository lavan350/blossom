<?php

class Users extends BaseSql {
    protected $id_user = null;
    protected $firstname;
    protected $lastname;
    protected $sexe;
    protected $birthday_date;
    protected $address;
    protected $email;
    protected $zip_code;
    protected $city;
    protected $pwd;
    protected $token;
    protected $status;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_user = $id;
    }

    public function setFirstname($firstname) {
        // Kevin
        $this->firstname = ucfirst(strtolower(trim($firstname)));
    }

    public function setLastname($lastname) {
        // TAING
        $this->lastname = strtoupper(trim($lastname));
    }

    public function setSexe($sexe) {
        $this->sexe = trim($sexe);
    }

    public function setAddress($address) {
        $this->address = trim($address);
    }

    public function setZipCode($zip_code) {
        $this->zip_code = trim($zip_code);
    }

    public function setCity($city) {
        $this->city = trim($city);
    }

    public function setEmail($email) {
        // minuscule
        $this->email = strtolower(trim($email));
    }

    public function setPwd($pwd) {
        // Salt unique PAR mot de passe
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setBirthdayDate($birthday_date) {
        $this->birthday_date = trim($birthday_date);
    }

    public function setStatus($status) {
        $this->status = trim($status);
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function getBirthdayDate()
    {
        return $this->birthday_date;
    }


    public function getAddress()
    {
        return $this->address;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function adminFormAdd() {
		return [
					"config" => [ "method" => "POST", "action" => "", "submit" => "S'inscrire", "class" => "form col-md-10"],
					"input" => [
						"firstname" =>      [
                                                "title" => "Prénom",
                                                "type" => "text",
                                                "placeholder" => "Jean",
                                                "required" => true,
                                                "minString" => 2
                                            ],
						"lastname" =>       [
                                                "title" => "Nom de famille",
                                                "type" => "text",
                                                "placeholder" => "DUPONT",
                                                "required" => true,
                                                "minString" => 2
                                            ],
                        "Masculin" =>           [
                                                "type" => "radio",
                                                "name" => "sexe",
                                                "value" => "0",
                                                "checked" => true
										    ],
                        "Feminin" =>        [
                                                "type" => "radio",
                                                "name" => "sexe",
                                                "value" => "1"
										    ],
                        "birthday_date" =>  [
                                                "title" => "Date de naissance",
                                                "type" => "date",
                                                "required" => true,
										    ],
                        "email" =>          [
                                                "title" => "E-mail",
                                                "type" => "email",
                                                "placeholder" => "exemple@gmail.com",
                                                "required" => true
                                            ],
						"pwd" =>            [
                                                "title" => "Mot de passe",
                                                "type" => "password",
                                                "required" => true
                                            ],
						"pwdConfirm" =>     [
                                                "title" => "Veuillez confirmer votre mot de passe",
                                                "type" => "password",
                                                "required" => true,
                                                "confirm" => "pwd"
                                            ]
					]
		];
	}

    public function userFormAdd() {
		return [
					"config" => [ "method" => "POST", "action" => "", "submit" => "Enregistrer un utilisateur", "class" => "form col-md-4"],
					"input" => [
						"firstname" =>      [
                                                "title" => "Prénom",
                                                "type" => "text",
                                                "placeholder" => "Jean",
                                                "required" => true,
                                                "minString" => 2
                                            ],
						"lastname" =>       [
                                                "title" => "Nom de famille",
                                                "type" => "text",
                                                "placeholder" => "DUPONT",
                                                "required" => true,
                                                "minString" => 2
                                            ],
                        "Masculin" =>           [
                                                "type" => "radio",
                                                "name" => "sexe",
                                                "value" => "0",
                                                "checked" => true
										    ],
                        "Feminin" =>        [
                                                "type" => "radio",
                                                "name" => "sexe",
                                                "value" => "1"
										    ],
                        "birthday_date" =>  [
                                                "title" => "Date de naissance",
                                                "type" => "date",
                                                "required" => true,
										    ],
                        "email" =>          [
                                                "title" => "E-mail",
                                                "type" => "email",
                                                "placeholder" => "exemple@gmail.com",
                                                "required" => true
                                            ],
						"pwd" =>            [
                                                "title" => "Mot de passe",
                                                "type" => "password",
                                                "required" => true
                                            ],
						"pwdConfirm" =>     [
                                                "title" => "Veuillez confirmer le mot de passe",
                                                "type" => "password",
                                                "required" => true,
                                                "confirm" => "pwd"
                                            ]
					]
		];
	}
}

?>