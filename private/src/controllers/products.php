<?php
/**
 * Fichier qui gère la page des produits
 */
 
/**
 * products
 */
function products_pizzas(){

    include_once "../private/src/models/products.php";
    $pageTitle = "Nos pizzas";
    $products = [];
    $productsModel = getPizzas();
    // Reconstruction de la liste des produits
    foreach ($productsModel as $product) {
        if (!isset($products[$product['productID']])){
        // if (!isset($products[$product->productID])){
            $products[$product['productID']] = [];
            // $products[$product->productID] = [];
        }
        $products[$product['productID']]['id'] = $product['productID'];
        $products[$product['productID']]['name'] = $product['productName'];
        $products[$product['productID']]['price'] = $product['productPrice'];
        $products[$product['productID']]['illustration'] = $product['productIllustration'];
        // var_dump(isset($products[$product['productID']]['ingredients']));
        if (!isset($products[$product['productID']]['ingredients'])){
            $products[$product['productID']]['ingredients'] = [];
        }
        array_push($products[$product['productID']]['ingredients'], $product['ingredientName']);
    }

    // echo "Page des pizzas WebPizza";
    include_once "../private/src/views/products/read.php";
}
/**
 * salads
 */
function products_salads(){
    
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Salades";
    $products = getSalads();
    // echo "Page des pizzas WebPizza";
    include_once "../private/src/views/products/read.php";
}
/**
 * desserts
 */
function products_desserts(){
    // echo "Page des desserts WebPizza";
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Desserts";
    $products = getDesserts();
    // echo "Page des pizzas WebPizza";
    include_once "../private/src/views/products/read.php";
}
/**
 * drinks
 */
function products_drinks(){
    // echo "Page des desserts WebPizza";
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Boissons";
    $products = getDrinks();
    // echo "Page des pizzas WebPizza";
    include_once "../private/src/views/products/read.php";
}
/**
 * menus
 */
function products_menus(){
    // echo "Page des menus WebPizza";
    include_once "../private/src/models/products.php";
    $pageTitle = "Nos Menus";
    $products = getMenus();
    // echo "Page des pizzas WebPizza";
    include_once "../private/src/views/products/read.php";
}


if(isset($_SESSION['user']) && $_SESSION['user']['email'] == "anisuki59@hotmail.fr"){    
    // Creation d'un produit
    function products_create(){
        global $db;
        $title = null;
        $content = null;
        $path_image = null;
        $price = null;
        $type = null;

        // Traitement du formulaire de création de l'article
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $isValid = true;

            // Récupération des données
            $title          = isset($_POST['title']) ? trim($_POST['title']) : null;
            $content        = isset($_POST['content']) ? trim($_POST['content']) : null;
            $path_image     = isset($_POST['illustration']) ? trim($_POST['illustration']) : null;

            $price          = isset($_POST['price']) ? trim($_POST['price']) : null;
            $type           = isset($_POST['type']) ? trim($_POST['type']) : null;
            // Controle des données
            // if (valeur pas OK) {
            //     $isValid = false;
            // }

            if ($isValid) {

                // Ajout des données à la BDD
                $query = $db['main']->prepare("INSERT INTO products (`name`, `description` ,`illustration`, `price`, `type`) 
                                                            VALUES (:title  , :content, :illustration, :price, :type)");
                $query->bindValue(':title', $title, PDO::PARAM_STR);
                $query->bindValue(':content', $content, PDO::PARAM_STR);
                $query->bindValue(':illustration', $path_image, PDO::PARAM_STR);
                $query->bindValue(':price', $price, PDO::PARAM_STR);
                $query->bindValue(':type', $type, PDO::PARAM_STR);

                $results = $query->execute();

                if($results){
                    redirect("/mon-compte");
                }else{
                    setFlashbag("danger","Les données n'ont pas été enregistrées dans la BDD");
                }
            }else{
                setFlashbag("warning","oops, erreur sur le form");
                
            }
        }
        include_once "../private/src/views/products/create.php";
    }

    function products_update(){
        // echo "MAJ #".$_GET['id'];
        global $db;
        $title = null;
        $content = null;
        $path_image = null;
        $price = null;
        $type = null;

        // -- AFFICHAGE DE L'ARTICLE DANS LE FORM (pt.1)

        //Récupération de l'ID de l'article
        $article_id = isset($_GET['id']) ? trim($_GET['id']) : null;

        // Test l'ID de l'article
        if (empty($article_id)) {
            echo "L'ID de l'article n'est pas défini..";
            exit;
        }

        // -- TRAITEMENT DU FORM

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $isValid = true;

            // Récupération des données
            $title          = isset($_POST['title']) ? trim($_POST['title']) : null;
            $content        = isset($_POST['content']) ? trim($_POST['content']) : null;
            $category_id    = isset($_POST['category']) ? trim($_POST['category']) : null;

            // Controle des données
            // if (valeur pas OK) {
            //     $isValid = false;
            // }

            if ($isValid) {

                // MAJ de la BDD
                $query = $db->prepare("UPDATE articles SET `title`=:title, `content`=:content, `category_id`=:category_id WHERE id=:id");
                $query->bindValue(':title', $title, PDO::PARAM_STR);
                $query->bindValue(':content', $content, PDO::PARAM_STR);
                $query->bindValue(':category_id', $category_id, PDO::PARAM_INT);
                $query->bindValue(':id', $article_id, PDO::PARAM_INT);

                $query->execute();

                header("location: read.php?id=".$article_id);
                exit;

            }
        }

        // -- AFFICHAGE DE L'ARTICLE DANS LE FORM (pt.2)

        // Récupération de l'article
        $query = $db->prepare("SELECT title, content, category_id FROM articles WHERE id=:id");
        $query->bindValue(':id', $article_id, PDO::PARAM_INT);
        $query->execute();

        $article = $query->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            $title = $article['title'];
            $content = $article['content'];
            $category_id = $article['category_id'];
        }
        include_once "../private/src/views/products/crud/update.php";
    }
}
