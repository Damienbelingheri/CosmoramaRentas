</header>
    <a href="<? /* $router->generate('product-list')  */ ?>" class="btn btn-success float-right">Retour</a>
    <h2 class="action__title">agregar un producto</h2>

    <?php dump($_SESSION)?>
    <?php dump($errorsPicture)?>
    <?php dump($messageValidation)?>

    <form action="" method="POST" enctype='multipart/form-data' class="mt-5 form">
        <div class="form-group">
            <label for="name">Nombre del producto</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="Nom du produit">
        </div>
        <div class="form-group">
            <label for="image">Foto principal</label>
            <input name="image" type="file" class="form-control" id="image" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
            <div class="container-gallery">
                <div class="col-xs-3 gallery"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="image">Otras Fotos</label>
            <input name="imagesWithId[]" multiple="multiple" type="file" class="form-control" id="imagesWithId" aria-describedby="pictureHelpBlock">
            <div class="container-gallery">
                <div class="col-xs-3 gallery2"></div>
            </div>
        </div>

        <div class="container desc_inclu">
            <div class="form-group desc">
                <label for="description">Descripción</label>
                <textarea name="description" type="text" class="form-control" id="description"></textarea>
            </div>
            <div class="form-group incl">
                <label for="include">include</label>
                <textarea name="include" type="text" class="form-control" id="include"></textarea>
            </div>
        </div>
        <div class="form-group incl">
            <label for="video">Video</label>
            <input name="video" type="text" class="form-control" id="video">
        </div>
        <div class="form-group">
            <label for="price">Precio</label>
            <input name="price" type="number" class="form-control" id="price" placeholder="34.99">
        </div>
        <div class="form-group">
            <label for="status">Estado</label>
            <select name="status" type="number" class="form-control" id="status" placeholder="status" min="1" max="2">
                <?php foreach ($status as $id => $stat) : ?>
                    <option value="<?= $id ?>"><?= $stat ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group ">
            <label for="category_id">Categoría</label>
            <select name="category_id" type="number" class="form-control category_id" id="category_id" placeholder="">
                <option value="">--Please choose an option--</option>
                <?php foreach ($allCategories as $category) : ?> ;
                <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>;
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group" id="sub_category">
            <label for="subCategory_id">SubCategoría</label>
            <select name="subCategory_id" type="number" class="form-control" id="subCategory_id" placeholder="">
            </select>
        </div>
        <button type="submit" value='Upload' name='upload' class="btn btn-primary btn-block mt-5">Validar</button>
    </form>