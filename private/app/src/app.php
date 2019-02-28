<?php
/**
 * Démarrage de session
 * --
 * La session va permettre de suivre le visiteur pendant la durée de sa navigation
 */
session_start();
/**
 * Fichier d'exécution de l'application
 */

/**
 * 1. Intégration de la configuration
 */
require_once "../private/app/config/config.php";

/**
 * 2. Définition de l'environnement
 */
require_once "../private/app/src/environnement.php";

/**
 * 3. Comportement des erreurs
 */
require_once "../private/app/src/err_reporting.php";

/**
 * 4. Connections aux base de données
 */
require_once "../private/app/src/db_connect.php";

/**
 * 5. Routage de l'application
 */
require_once "../private/app/src/routing.php";

/**
 * 6. Inclision des fonctions "Utils"
 */
require_once "../private/app/src/load_utils.php";

require_once "../private/src/controllers/main_controller.php";
/**
 * 7. Compilation de la page
 */
require_once "../private/app/src/compile.php";
