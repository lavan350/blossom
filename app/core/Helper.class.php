<?php

class Helper {

    static function getAge( $sBirthDay ) {
        // Création d'un objet dateTime a partir de la date de naissance
        $oDateTime = new DateTime($sBirthDay);
        // Que l'on va comparer avec la date d'aujourd'hui
        $oToday = new DateTime();
        // Calcul de la différence entre les deux dates
        $iDifference = $oToday->diff($oDateTime);
        // On récupère la différence en année
        $iAge = $iDifference->y;
        
        return $iAge;
    }

    static function getSexe( $iSexe ) {
        return $iSexe ? "Femme" : "Homme";
    }

    static function getStatus( $iStatus ) {
        return $iStatus ? "Actif" : "Inactif";
    }
}