<?php
/**
 * Fichier qui gère la page de contact
 */
 
/**
 * contact
 */
function contact_index(){
    global $re, $db;
    
    $send = true;
    
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        // Récupération des données
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $message = isset($_POST['message']) ? $_POST['message'] : null;

        $_SESSION['message'] = null;
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

        if($send){
            // Enregistrement d'un message dans la BDD
            // Préparation de la requete avec pour valeur des noms de variables
            $q_str_message = $db['main']->prepare("INSERT INTO messages (firstname, lastname, email, message, sending_timestamp) 
                                                                VALUES (:firstname, :lastname, :email, :message, :sendingTimestamp)");
                                                                            
            $q_str_message->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $q_str_message->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $q_str_message->bindValue(":email", $email, PDO::PARAM_STR);
            $q_str_message->bindValue(":message", $message, PDO::PARAM_STR);
            $q_str_message->bindValue(":sendingTimestamp", time(), PDO::PARAM_INT);

            $results = $q_str_message->execute();

            var_dump($results);

            if($results){
                setFlashbag("success", "Merci $lastname, votre message a été envoyés");
            }else{
                setFlashbag("danger", "Votre message n'à pas était envoyé.");
            }
            // call_user_func('insert_success_err', $q_str_message);
            header ("location: $_SERVER[HTTP_REFERER]" );
            
            
        }else{
            echo "erreur sur le formulaire";
        }
        // Redirection vers la page precedente
        
    }
    else {
        // TODO: Suppression du else + redirection de l'utilisateur
        echo "Le formulaire ne peut être traité qu'avec la méthode POST";
    }
}