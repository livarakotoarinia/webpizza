<?php include_once "../private/src/views/layout/header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2><?= $pageTitle ?></h2>
        
            <!-- Affiche la liste des article --> 
            <div class="row">
                <?php foreach($products as $product): ?>
                <div class="col-12 col-md-3">
                    <div class="card">
                        <img src="assets/images/<?= $product['illustration'] ?>" alt="Produits <?= $product['name'] ?>" class="card-img-top img-fluid">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product["name"] ?></h5>
                            <p class="card-text"><?= join(", ", $product['ingredients']) ?></p>
                            <p class="card-text"><?= $product['price'] ?> &euro;</p>
                            <a href="/add-to-order?id=<?= $product['id'] ?>" class="btn btn-block btn-success">Ajouter au panier</a>                        <!-- ?php if(isset($_SESSION['user']) && $_SESSION['user']['email'] == "anisuki59@hotmail.fr"): ?>
                            <a href="/admin/product/update?id=?= $product['id'] ?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Modifier produit</a>
                        ?php endif; ?> -->
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
            </div>
                <!-- <div>Aucune Pizza dans la BDD</div> -->
        </div>

    </div>
</div>

<?php include_once "../private/src/views/contact/form.php"; ?>
<?php include_once "../private/src/views/layout/footer.php"; ?>