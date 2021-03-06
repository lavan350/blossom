<?php

class ProductController {

    /*
    * View page produit
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("products", "front");

        $oProduct = new Products();
        $oColor = new Colors();
        $oCapacity = new Capacities();
        $oComment = new Comments();
        $oImages = new Images();

        $sId = $aParams['GET']['is'];
        $oProduct->setId( $sId );
        $aResultProduct = $oProduct->select();

        $oComment->setStatus(1);
        $oComment->setProductsIdProduct( $sId );
        $aResultComment = $oComment->select();

        $oColor->setProductsIdProduct( $sId );
        $oColor->setStatus(1);
        $aResultColor = $oColor->select();
        
        $oCapacity->setProductsIdProduct( $sId );
        $oCapacity->setStatus(1);
        $aResultCapacity = $oCapacity->select();

        $oImages->setProductsIdProduct( $sId );
        $oImages->setStatus(1);
        $aResultImages = $oImages->select();

        $aConfigs = [];

        $aProducts = ['products' => $aResultProduct];
        array_push($aConfigs, $aProducts );

        $aColors = ['colors' => $aResultColor];
        array_push($aConfigs, $aColors );

        $aCapacities = ['capacities' => $aResultCapacity];
        array_push($aConfigs, $aCapacities);

        $aComments = [];
        foreach ( $aResultComment as $aComment ) {
            $oUser = new Users();
            $oUser->setId($aComment['users_idusers']);
            $aUser = $oUser->select()[0];

            array_push($aComments, [
                'id_comment' => $aComment['id_comment'],
                'comment' => $aComment['comment'],
                'date_inserted' => $aComment['date_inserted'],
                'user' => $aUser
            ]);
        }
        array_push($aConfigs, [ 'comment' => $aComments ]);
        
        $aImages = ['images' => $aResultImages];
        array_push($aConfigs, $aImages);

        $oView->assign('aConfigs', $aConfigs);
    }

    public function addAction($aParams) {
        $sId = $aParams['GET']['is'];

        $oProduct = new Products();
        $oProduct->setId($sId);
        $aProduct = $oProduct->select()[0];
        $iQuantity = $aProduct['quantity'];

        if ( $iQuantity <= 0 ) {
            header('location: /front/product?is=' . $sId . '&validity=true#error');
            return;
        }

        if ( empty($_SESSION['id_user']) ) {
            header('location: /front/product?is=' . $sId . '&connection=false#error');
            return;
        }

        $oCart = new Carts();
        $oCart->setProductsIdProduct( $sId );
        $oCart->setUsersIdUser( $_SESSION['id_user'] );
        $oCart->setStatus(1);

        if ( $aParams['POST']['color'] ) {
            $oColor = new Colors();
            $oColor->setProductsIdProduct( $sId );
            $oColor->setName( $aParams['POST']['color'] );
            $aIdColor = $oColor->select( array('id_color') )[0]['id_color'];

            $oCart->setColorsIdColor( $aIdColor );
        }
        if ( $aParams['POST']['capacity'] ) {
            $oCapacity = new Capacities();
            $oCapacity->setProductsIdProduct( $sId );
            $oCapacity->setCapacityNumber( $aParams['POST']['capacity'] );
            $aIdCategory = $oCapacity->select(array('id_capacity'))[0]['id_capacity'];

            $oCart->setCapacitiesIdCapacity( $aIdCategory );
        }

        $oCart->save();

        $oProduct = new Products();
        $oProduct->setId($sId);
        $aQuantity = $oProduct->select( array('quantity') );
        $iQuantity = $aQuantity[0]['quantity'];
        $iNewQuantity = $iQuantity - 1;
        $oProduct->setQuantity( $iNewQuantity );
        $oProduct->save();

        header('location: /front/cart');
        return;
    }

    /*
    * Ajout d'un commentaire
    */ 
    public function addCommentAction( $aParams ) {
        $oUser = new Users();
        $oComment = new Comments();
        $oProduct = new Products();

        $sId = $aParams['GET']['is'];

        if ( empty($_SESSION['id_user']) ) {
            header('location: /front/product?is=' . $sId . '&connection=false#error');
            return;
        }

        if ( !empty( $aParams['POST'] )) {
            $oComment->setComment($aParams['POST']['comment']);
            $oComment->setUsersIdUsers($_SESSION['id_user']);
            $oComment->setProductsIdProduct($sId);
            $oComment->setStatus(0);
            $oComment->save();

            header('location: /front/product?is='.$sId.'&comment=true#error');
            return;
        }

    }

}
