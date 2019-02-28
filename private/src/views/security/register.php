<?php 
include_once "../private/src/views/layout/header.php";

?>

<section id="register" class="mt-5">
    <form method="post" class="container" novalidate>
        <div class="row">
            <div class="col-4 offset-4">
                <h2>Inscription</h2>
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="Votre prénom" value="<?= $firstname ?>">               
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Votre nom"  value="<?= $lastname ?>">
                </div>
                <div class="form-group">
                 <input type="email" class="form-control" name="email" placeholder="Votre email">                
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Votre nouveau mot de passe">                
                </div>
                <!-- <div class="form-group">
                    <input type="password" class="form-control" name="passwd" placeholder="Ressaisir mot de passe">                
                </div> -->

                <button class="btn btn-success btn-block">Valider</button>
                <div class="form-link">
                    <a href="connexion">J'ai déjà un compte</a><br>
                </div>
            </div>
        </div>
    </form>

</section>
<?php include_once "../private/src/views/layout/footer.php";?>