<?php 
include_once "../private/src/views/layout/header.php";
?>


<section id="login" class="mt-5">
    <form method="post" class="container" novalidate>
        <div class="row">
            <div class="col-4 offset-4">
                <h2>Connexion</h2>
                <!-- Champ Email -->
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Votre adresse email">
                </div>

                <!-- Champ Mot de passe -->
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Votre mot de passe">
                </div>

                <button class="btn btn-success btn-block">Login</button>

                <div class="form-link">
                    <a href="/inscription">Je n'ai pas encore de compte</a><br>
                    <a href="/mot-de-passe-oublie">J'ai oublié mon mot de passe</a>
                </div>

            </div>
        </div>
    </form>

</section>
<?php include_once "../private/src/views/layout/footer.php"; ?>