<?php
/**
 * Fichier qui gère la page de login, register et forgotten-password
 */
 
/**
 * security
 */
function security_login(){
    // echo "Page de login WebPizza";
    include_once "../private/src/views/security/login.php";
}
function security_register(){
    // echo "Page de register WebPizza";
    include_once "../private/src/views/security/register.php";
}
function security_forgotten_password(){
    // echo "Page de mot de passe oubliés WebPizza";
    include_once "../private/src/views/security/forgotten_password.php";
}