<?php
/**
 * Fichier de configuration général de l'application
 * 
 * 1. Définition des constantes
 * 2. Définition des variables d'environnement d'exécution
 */

 /**
  * 1. Définition des constantes
  */

// Définir le chemin du répertoire "utils"
define('UTILS_PATH', "../private/app/utils/");

// WEBSITE_TITLE : Définition du titre du site
define('WEBSITE_TITLE', "WebPizza !");

/**
 * 2. Définition des variables d'environnement d'exécution 
 */

// Environnement de développement ou production ?
// les valeurs peuvent être : "prod" ou "dev"
// Par défaut, on considère que l'application s'exécute en environnement de PROD
$env = "prod";

// Liste des domaines que l'on considères comme étant des environnement de développement
$dev_domains = [
  "127.0.0.1",
  "localhost",
  "webpizza.local"
];

/**
 * 3. Définition des variables de base de donnée
 */

// Liste des configurations de connections aux bases de données par défaut
$db_config = [];

// Liste des connections aux base de données
// Cette liste sera nourris par le dichier db_connect.php
$db = [];

// Inclusion de la config de la base de données
require_once "database.php";

/**
 * 4. Définition des variables de routage
 */

// Définition de l'uri par défaut
$uri = "/";

// Définition de la table de routage par défaut
$routes = [];

// Contient les informations de la route courante
$route = [];

// Inclusion de la config du routage
require_once "routes.php";

/**
 * Definition des exepressions régulières
 */
 
$re = [
  "firstname" => '/^[a-z-]+$/i',
  "lastname" => '/^[a-z-]+$/i',
  "email" => '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
  "password" => '/((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,15})$/',

  //Règles pour le CRUD product
  "product_name" => '/^[a-z0-9-\s]+$/i'
];