<?php
/**
 * Fichier qui gère la page de mon-compte
 */
 
/**
 * contact
 */
function account_index(){
    // echo "Page de mon-compte WebPizza";
    // Verifie si l'utilisateur n'est pas identifié   
    if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
       redirect("/connexion");
    }
        include_once "../private/src/views/accounts/mon-compte.php";
}