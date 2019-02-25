<?php

// Dans le cas ou la variable $db_config n'est pas défini (dans le fichier config.php)
// On initialise la variable $db_config avec un tableau vide
if (!isset($db_config)){
    $db_config = [];
}

// On boucle sur la liste de config des connexions aux bases de données
// var_dump($db_config);

foreach ($db_config as $name => $params) {
    // Génère la chaine DSN 'Domain Source Name) PDO (ex = 'mysql:host=localhost;dbname=DBNAME')
    $db_dsn = $params['type'].":";
    $db_dsn.= "host=".$params['host'].";";
    $db_dsn.= "port=".$params['port'].";";
    $db_dsn.= "dbname=".$params['schema'].";";
    $db_dsn.= "charset=".$params['charset'];

    // Nom de l'utilisateur de la base de données
    $db_user = $params['user'];
    // Mot de passe de l'utilisateur de la base de données
    $db_pass = $params['pass'];
    // Instance de connection
    $db[$name] = new PDO($db_dsn, $db_user, $db_pass);
    $GLOBALS['data_base'] = $db[$name];

    // COmportement des erreurs PDO
    if ($env == 'dev'){
        $db[$name]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}
    