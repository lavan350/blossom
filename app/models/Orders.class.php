<?php

class Orders extends BaseSql {
    protected $id_order = null;
    protected $tracking_number;
    protected $status;
    protected $users_idusers;
    protected $product_idproduct;

    public function __construct() {
        // On instancie le parent 
        parent::__construct();
    }

    public function setId($id) {
        $this->id_order = trim($id);
    }

    public function setTrackingNumber($tracking_number) {
        $this->tracking_number = trim($tracking_number);
    }

    public function setStatus($status) {
        $this->status = trim($status);
    }

    public function setUsersIdUsers($users_idusers) {
        $this->users_idusers = trim($users_idusers);
    }

    public function setProductIdProduct($product_idproduct) {
        $this->product_idproduct = trim($product_idproduct);
    }

    public function getIdOrder()
    {
        return $this->id_order;
    }

    public function getTrackingNumber()
    {
        return $this->tracking_number;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getUsersIdusers()
    {
        return $this->users_idusers;
    }

    public function getProductIdproduct()
    {
        return $this->product_idproduct;
    }

    public function checkoutForm() {
		return [
            "config" => [ "method" => "POST", "action" => "", "submit" => "Soumettre le paiement", "class" => "form col-md-5 row is-h-centered"],
            "input" => [
                "card_number" => [
                                "title" => "Numero de carte de crédit",
                                "type" => "number",
                                "requiredNum" => 15
                ],
                "expiration_date" => [
                                "title" => "Date d'expiration (Format MMAA, ex : 0121)",
                                "type" => "number",
                                "requiredNum" => 4
                ],
                "crypto" => [
                                "title" => "Cryptogramme",
                                "type" => "number",
                                "requiredNum" => 3
                ]
            ]
        ];
    }
}

?>