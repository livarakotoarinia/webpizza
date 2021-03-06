<?php
/**
 * Fichier de routage de l'applications
 *
 * - RAPPEL du format d'une route dans le tableau ^route
 *      - Le nopm de la route
 *      - Le "path"
 *      - Le "controller", la fonction déclenché par la route
 *      - La|Les méthode(s)
 */

if(!isset($routes)){
    $routes = [];
}

// Récupération de l'uri courant
if(!empty($_SERVER['REQUEST_URI'])){
    $uri = $_SERVER['REQUEST_URI'];
    $uri = explode("?", $uri);
    $uri = $uri[0];
}

// Recherch de l'URI dans le tableau de routage
foreach ($routes as $route) {
    
    if($uri == $route[1]){
        // On ajoute le nom de la route courante dans la variable $GLOBALS de PHP
        // Pour l'utiliser par la suite.
        $GLOBALS['route_active'] = $route[0];

        // Si la route est trouvé dans la table de routage on sort de la boucle
        // grace au mot clé "break;"
        // La variable $route contient les infos de la dernière itération de la boucle
        break;
    }
}
// A ce niveau soit la variable $route est renseignée grace à un URI trouvé
// dans le tableau $route, soit elle à pris la valeur de la dernière itération
// du tableau $route, C.A.D. la route 404
// var_dump($route);

if (!isset($GLOBALS['route_active'])){
    $GLOBALS['route_active'] = "error-404";
}
