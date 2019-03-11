<?php
/**
 * Fichier qui gère la page de login, register et forgotten-password
 */
 
/**
 * security
 */
function security_login(){
    global $db;

    if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id'])){
        redirect("/mon-compte");
     }
    // echo "Page de login WebPizza";
    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $isValid = true;
    
        // Récuperation des données
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password_text = isset($_POST['password']) ? $_POST['password'] : null;
    
        // Est-ce qu'un utilisateur correspond à l'adresse email ?
        $q = $db['main']->prepare("SELECT id, fullname, email, password FROM users WHERE email=:email");
        $q->bindValue(":email", $email, PDO::PARAM_STR);
        $q->execute();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
    
        // var_dump($r[0]['password']);
        // var_dump(password_hash('a123456A', PASSWORD_DEFAULT));
        // var_dump(password_verify($password_text, $r[0]['password']));
        if(empty($r)){
            $isValid = false;
        }
    
        if($isValid){
            if(password_verify($password_text, $r[0]['password'])){
                unset($r[0]['password']);
                $_SESSION['user'] = $r[0];
                redirect();
            }else{
                $isValid = false;
                setFlashbag("danger","oops, mauvais identifiants....");
            }
        }
    }
    include_once "../private/src/views/security/login.php";
}

function security_register(){
    
    global $re, $db;
    if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id'])){
        redirect("/mon-compte");
     }
    $firstname = null;
    $lastname = null;
    $email = null;

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        $isValid = true;
        
        // Récupération des données 
        $firstname      = isset($_POST['firstname']) ? trim($_POST['firstname']) : null;
        $lastname       = isset($_POST['lastname']) ? trim($_POST['lastname']) : null;
        $email          = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password_text  = isset($_POST['password']) ? $_POST['password'] : null;
        $password_hash  = password_hash($password_text, PASSWORD_DEFAULT);
        // $passwd         = isset($_POST['passwd']) ? $_POST['passwd'] : null;

        // Vérification de l'unicité de l'utilisateur
        $q = $db['main']->prepare("SELECT id FROM users WHERE email = :email");
        $q->bindValue(':email', $email, PDO::PARAM_STR);
        $q->execute();
        $r = $q->fetchAll();

        if(!empty($r)){
            $isValid = false;
        }

        if($isValid){

            if (!preg_match($re['firstname'], $firstname)){
                echo "Erreur sur le champ prénom";
                $isValid = false;
            }
            if (!preg_match($re['lastname'], $lastname)){
                echo "Erreur sur le champ nom";
                $isValid = false;
            }
            if (!preg_match($re['email'], $email)){
                echo "Erreur sur le champ email";
                $isValid = false;
            }
            if ((!preg_match($re['password'], $password_text))){
                echo "Erreur sur le champ password";
                $isValid = false;
            }
        
            $q = $db['main']->prepare("INSERT INTO users (firstname, lastname, email, password) 
                                        VALUES (:firstname, :lastname, :email, :password)");
            $q->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            $q->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            $q->bindValue(":email", $email, PDO::PARAM_STR);
            $q->bindValue(":password", $password_hash, PDO::PARAM_STR);
        
            $r = $q->execute();

            if($r){
                redirect("/connexion");
            }else{
                setFlashbag("danger","Les données n'ont pas été enregistrées dans la BDD");
            }
        }else{
            setFlashbag("warning","oops, erreur sur le form");
            
        }
    }
    // echo "Page de register WebPizza";
    include_once "../private/src/views/security/register.php";
}
function security_forgotten_password(){
    // echo "Page de mot de passe oubliés WebPizza";
    include_once "../private/src/views/security/forgotten_password.php";
}

/**
 * Fonction qui permet de changer le mot de passe de l'utilisateur en cours
 *
 * @return void
 */
function security_modif_password(){
    // echo "Page de mot de passe oubliés WebPizza";
    global $db;
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $isValid = true;

        $email = $_SESSION['user']['email'];
        $old_pwd_text = isset($_POST['old-password']) ? $_POST['old-password'] : null;
        $new_pwd_text = isset($_POST['new-password']) ? $_POST['new-password'] : null;
        $re_pwd_text = isset($_POST['re-password']) ? $_POST['re-password'] : null;
        $new_pwd_hash  = password_hash($new_pwd_text, PASSWORD_DEFAULT);
        
        $q = $db['main']->prepare("SELECT * FROM `users` WHERE `email`=:email");
        $q->bindValue(":email", $email, PDO::PARAM_STR);
        $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        
        // var_dump(password_verify($old_pwd_text, $r['password']));
        
        if(empty($r)){
            $isValid = false;
        }

        if($isValid){
            // Test si le champs 'ancien mot de passe' correspond aux password de la BDD
            if(password_verify($old_pwd_text, $r['password']) && ($new_pwd_text == $re_pwd_text)){
                unset($r[0]['password']);
                $q = $db['main']->prepare("UPDATE users SET `password` = :newPwd WHERE `email` = :email");
                $q->bindValue(":email", $email, PDO::PARAM_STR);
                $q->bindValue(":newPwd", $new_pwd_hash, PDO::PARAM_STR);
                $q->execute();
                redirect("/mon-compte");
            }else{
                $isValid = false;
                setFlashbag("danger","oops, les nouveaux mot de passe ne correspondent pas");
            }
        }else{
            setFlashbag("danger","oops, mauvais mots de passe....");
        }
    }

    include_once "../private/src/views/security/modif_password.php";
}
function security_logout(){
    session_destroy();
    redirect();
}