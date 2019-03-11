<section class="mt-3 title">
    <form method="post" class="crud-form" novalidate>
   
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Nom du produit" value="<?= $title ?>">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="content" id="content"><?= $content ?></textarea>
            </div>
            <div class="form-group">
                <label for="illustration">Illustration</label>
                <input class="form-control" type="text" name="illustration" id="illustration" placeholder="Image du produit" value="<?= $path_image ?>">
            </div>

            <div class="form-group">
                <label for="price">Prix</label>
                <input class="form-control" type="number" name="price" id="price" placeholder="Prix du produit (ex: 10.00)" value="<?= $price ?>">
            </div>

            <div class="form-group">
                <label for="type"></label>
                <select name="type" id="type" class="form-control">
                    <?php foreach(getEnumData("products","type") as $type): ?>
                    <option value="<?= $type ?>"><?= $type ?></option>
                    <?php endforeach; ?>
                </select>
            </div>  

            <button class="btn btn-success btn-block" type="submit">Valider</button>
      
    </form>
</section>