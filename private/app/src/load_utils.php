<?php
/**
 * Fichier de chargement automatique des script du répertoire /private/app/utils
 */

// Test si la constante "UTIL_PATH" n'est définie
if (!defined('UTILS_PATH')) {
    define('UTILS_PATH', null);
}

if (UTILS_PATH != null){

    // Scanner le répertoire UTIL_PATH
    $utils_scan = scandir(UTILS_PATH);
    
    // Une boucle sur la liste des entrées $utils_scan
    foreach ($utils_scan as $key => $value) {
        // Filtre les fichiers se terminant par ".php"
        if (preg_match("/\.php$/", $value)){
            // On invlus uniquement les fichiers ".php"
            include_once UTILS_PATH.$value;
        }
    }
}