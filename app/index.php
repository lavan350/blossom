<?php

session_start();
require 'conf.inc.php';

function autoloader( $sClass ) {
    $sClass = $sClass . ".class.php";
 
    if ( file_exists( "core/" . $sClass ) ) {
        include "core/" . $sClass;

    } else if ( file_exists( "models/" . $sClass ) ) {
        include "models/" . $sClass;
    }
}

spl_autoload_register("autoloader");

$sUri = substr(urldecode($_SERVER["REQUEST_URI"]), strlen(dirname($_SERVER["SCRIPT_NAME"])));
$sUri = ltrim($sUri, "/");
$aUri = explode("?", $sUri);
$aUriExploded = explode("/", $aUri[0]);

$sController = (empty($aUriExploded[0])? "index" : $aUriExploded[0]);
$sAction = (empty($aUriExploded[1])? "index" : $aUriExploded[1]);


$sController = ucfirst(strtolower($aUriExploded[0])) . "Controller";
$sAction = strtolower($aUriExploded[1]) . "Action";

unset($aUriExploded[0]);
unset($aUriExploded[1]);

$aUriExploded = array_values($aUriExploded);

$aParams = [
    "GET" => $_GET,
    "POST" => $_POST,
    "URL" => $aUriExploded
];

if ( file_exists( "controllers/" . $sController . ".class.php" ) ) {
    include "controllers/" . $sController . ".class.php";
    
    if ( class_exists( $sController ) ) {
        $oController = new $sController();

        if ( method_exists( $oController, $sAction ) ) {
            $oController->$sAction( $aParams );

        } else {
            die ("L'action " . $sAction . " n'existe pas");
        }
    } else {
        die ("La class " . $sController . " n'existe pas");
    }
} else {
    die ("Le fichier " . $sController . " n'existe pas");
}