<?php

function url($routeName){
    // Parcour la liste des routes
    // et récupère le Path de a route $routeName
    global $routes;
    foreach ($routes as $route) {
        // Récupération de l'uri courant
        if ($routeName == $route[0]){
            return $route[1];
            // return var_dump($route[1]);
            // echo 'salut';
        }
    }
}