<?php
/**
 * Fichier de compilation de l'application
 * 
 * Ce fichier génère la page finale HTML avant de retourner le résultat au navigateir
 */

// Dans le cas ou la route est vide, on force le programme a redefinir la route
// vers la page 404
if(empty($route)){
    $route = end($routes); // Fonction PHP qui met le curseur de php sur la dernière entré du tableau (ici page "404")
}

/**
 * Récupération des éléments de la route que definissent le controleur
 */

 // Si ce paramètre est vide, on arrete le programme
if (!isset($route[2]) || empty($route[2])){
    throw new Exception("Le contrôleur n'est pas définit.");    
}

// Initialisation des variables qui définiront le fichier et la fonction à executer
$controller_file = null; // homepage
$controller_path = null; // "../private/src/controllers/".$controller_file.".php";
$controller_methode = null; // homepage_index

// Récuperation des éléments du controleur
$controller = explode(":", $route[2]);

// -- Définition du fichier controleur
$controller_file = isset($controller[0]) ? $controller[0] : null;
if($controller_file !== null && !empty($controller_file)){
    $controller_path = "../private/src/controllers/".$controller_file.".php";
}
// -- Définition de la fonction à executer
$controller_methode = isset($controller[1]) ? $controller[1] : null;

if($controller_methode !== null && !empty($controller_methode)){
    $controller_methode = $controller_file."_".$controller_methode;
}else{
    $controller_methode = $controller_file."_index";
}

/**
 * Intégration du fichier controleur
 */
if(!file_exists($controller_path)){
    // Si oui le programme est arreté
    throw new Exception("Le fichier controleur de la route \"".$route[0]."\"est manquant.");
}

// Le fichier existe, il est inclus dans le programme
include_once $controller_path;

/**
 * Execution de la fonction du controleur
 */
// test l'existance de la fonction du controleur
if(!function_exists($controller_methode)){
    throw new Exception("La méthode \"".$controller_methode."\" de la route \"".$route[0]."\" est manquante");
}

// Execution de la fonction liée à la route
$controller_methode();