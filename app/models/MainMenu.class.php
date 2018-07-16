<?php

class MainMenu {

    public function mainMenuConfigs() {
        $oCategory = new Categories();
        $oCategory->setStatus(1);
        $aCategories = $oCategory->select();
        
        $aConfigs[ 'logo' ] = [ 'url' => '/public/img/logo.png' ];

        foreach ( $aCategories as $sKey => $aValue ) {
            $aConfigs[ $aValue['category_name'] ] = [ 'url' => '/front/category?is=' . strtolower($aValue['category_name']) ];
        }

        return $aConfigs;
    }

}

?>