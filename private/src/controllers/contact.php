<?php
/**
 * Fichier qui gère la page de contact
 */
 
/**
 * contact
 */
function contact_index(){
    // Expressions régulières
    $re = [
        "firstname" => '/^[a-z-]+$/i',
        "lastname" => '/^[a-z-]+$/i',
        "email" => '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'
    ];
    $send = true;
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        // Récupération des données
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $message = isset($_POST['message']) ? $_POST['message'] : null;

        // -- Contrôle des champs

        // Contrôle du champ Prénom
        if (!preg_match($re['firstname'], $firstname)){
            echo "Erreur du champ firstname";
            $send = false;
        }
        // Contrôle du champ nom
        if (!preg_match($re['lastname'], $lastname)){
            echo "Erreur du champ lastname";
            $send = false;
        }
        // Contrôle du champ email
        if (!preg_match($re['email'], $email)){
            echo "Erreur du champ email";
            $send = false;
        }
        // Contrôle du champ message
        if (strlen($message) < 10){
            echo "Erreur du champ message";
            $send = false;
        }
        // var_dump($_SERVER);
        if($send){
            // Enregistrement d'un message dans la BDD
            // Préparation de la requete avec pour valeur des noms de variables
            $q_str_message = $GLOBALS['data_base']->prepare("INSERT INTO messages(firstname,lastname,email,message,sending_date) VALUES (:prenom, :nom, :email, :message, NOW())");
            $q_str_message->execute(array(
                'prenom' => $firstname,
                'nom' => $lastname,
                'email' => $email,
                'message' => $message,
            ));
            call_user_func('insert_success_err', $q_str_message);
            // Redirection vers une autre page
            header ("Location: $_SERVER[HTTP_REFERER]" );
                        Exit();
            
        }else{
            echo "erreur sur le formulaire";
        }

    }
    else {
        // TODO: Suppression du else + redirection de l'utilisateur
        echo "Le formulaire ne peut être traité qu'avec la méthode POST";
    }
}