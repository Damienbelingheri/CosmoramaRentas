
<a href="<?= $router->generate('admin-product-list') ?>" class="btn btn-success float-right">back</a>
<h2 class="action__title">Agregar un producto</h2>



<?php if (!empty($errorList) || is_null($errorsPicture)) : ?>
    <div class="alert alert-danger text-center font-weight-bold">The product could not be added</div>
<?php endif; ?>

<?php if (!empty($successList)) : ?>
    <?php foreach($successList as $success) : ?>
    <div class="alert alert-success text-center font-weight-bold"><?= $success ?> </div>
    <?php endforeach ?>
<?php endif; ?>

<form action='' method="POST" enctype='multipart/form-data' class="mt-5 form">
    <div class="form-group">
        <label for="name">Nombre del producto</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Nom du produit">
        <?php if (!empty($errorList['name'])) : ?>
            <div class="text-danger  font-weight-bold"><?= $errorList['name'] ?></div>
        <?php endif; ?>
    </div>


    <div class="form-group">
        <label for="image">Foto principal</label>
        <input name="image" type="file" class="form-control" id="image" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
        <?php if (!empty($errorsPicture)) : ?>
                <div class="text-danger  font-weight-bold"><?= $errorsPicture->getErrors() ?></div>
            <?php endif; ?>
        <div class="container-gallery">
            <div class="col-xs-3 gallery"></div>
        </div>
        


    </div>
    <div class="form-group">
        <label for="image">Otras Fotos</label>
        <input name="imagesWithId[]" multiple="multiple" type="file" class="form-control" id="imagesWithId" aria-describedby="pictureHelpBlock">
        <?php if (!empty($errorsPicture) && $errorsPicture->getErrors() !== "Image requiered") : ?>
                <div class="text-danger  font-weight-bold"><?= $errorsPicture->getErrors() ?></div>
            <?php endif; ?>
        <div class="container-gallery">
            <div class="col-xs-3 gallery2"></div>  
        </div>
    </div>

    <div class="container desc_inclu">
        <div class="form-group desc">
            <label for="description">Descripción</label>
            <textarea name="description" type="text" class="form-control" id="description"></textarea>
            <?php if (!empty($errorList['description'])) : ?>
                <div class="text-danger  font-weight-bold"><?= $errorList['description'] ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group incl">
            <label for="include">include</label>
            <textarea name="include" type="text" class="form-control" id="include"></textarea>
            <?php if (!empty($errorList['include'])) : ?>
                <div class="text-danger  font-weight-bold"><?= $errorList['include'] ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group incl">
        <label for="video">Video</label>
        <input name="video" type="text" class="form-control" id="video">
        <?php if (!empty($errorList['video'])) : ?>
            <div class="text-danger  font-weight-bold"><?= $errorList['video'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="price">Precio</label>
        <input name="price" type="number" class="form-control" id="price" placeholder="34.99">
        <?php if (!empty($errorList['price'])) : ?>
            <div class="text-danger  font-weight-bold"><?= $errorList['price'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="status">Estado</label>
        <select name="status" type="number" class="form-control" id="status" placeholder="status" min="1" max="2">
            <?php foreach ($status as $id => $stat) : ?>
                <option value="<?= $id ?>"><?= $stat ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errorList['status'])) : ?>
            <div class="text-danger  font-weight-bold"><?= $errorList['status'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group ">
        <label for="category_id">Categoría</label>
        <select name="category_id" type="number" class="form-control category_id" id="category_id" placeholder="">
            <option value="">--Please choose an option--</option>
            <?php foreach ($allCategories as $category) : ?> ;
                <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>;
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errorList['category_id'])) : ?>
            <div class="text-danger  font-weight-bold"><?= $errorList['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group" id="sub_category">
        <label for="subCategory_id">SubCategoría</label>
        <select name="subCategory_id" type="number" class="form-control" id="subCategory_id" placeholder="">
        </select>
    </div>
    <button type="submit" value='Upload' name='upload' class="btn btn-primary btn-block mt-5">Validar</button>
</form>