<?php

class ProductsController {

    public function indexAction( $aParams ) {
        $oView = new View("products", "back");
    }

    public function formAction( $aParams ) {
        $oView = new View("productsForm", "back");
    }
    
    public function addAction( $aParams ) {

    }

    public function updateFormAction( $aParams ) {

    }

    public function updateAction( $aParams ) {

    }

    public function deleteAction( $aParams ) {

    }
    
}