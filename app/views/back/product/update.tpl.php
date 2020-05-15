    <a href="<? /* $router->generate('product-list')  */ ?>" class="btn btn-success float-right">Retour</a>
    <h2 class="action__title">Actualizar un producto</h2>

    <form action="" method="POST" enctype='multipart/form-data' class="mt-5 form">
        <div class="form-group">
            <label for="name">Nombre del producto</label>
            <input name="name" value="<?= $product->getName() ?>" type="text" class="form-control" id="name" placeholder="Nom du produit">
        </div>
        <div class="form-group">
            <label for="image">Foto principal</label>
            <input name="image" type="file" class="form-control" id="image" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
            <div class="container-gallery">
                <div class="col-xs-3 gallery"></div>
                <?php if (isset($product)) : ?>
                    <div class="fform group container images">
                        <h2 class="selection__title"> Foto selecionada(s)</h2>
                        <div class="col-xs-3">
                            <img src="<?= $assetsBaseUri ?>img/productos/<?= $product->getImage() ?>" class="img-rounded" />
                        <?php endif ?>
                        </div>
                    </div>
            </div>
        </div>


        <div class="form-group">
            <label for="image">Otras Fotos</label>
            <input name="imagesWithId[]" multiple="multiple" type="file" class="form-control" id="imagesWithId" aria-describedby="pictureHelpBlock">
            <div class="container-gallery">
                <div class="col-xs-3 gallery2"></div>

                <?php if (count($imagesWithId) > 0) : ?>
                    <div class="form group container images">
                        <h2 class="selection__title">Foto(s)</h2>
                        <?php foreach ($imagesWithId as $image) : ?>
                            <div class="col-xs-5">
                                <img src="<?= $assetsBaseUri ?>img/productos/<?= $image->getPicture() ?>" class="img-rounded" />
                                <p class="page-header">
                                    <span>
                                        <a class="btn btn-danger" href="<?= $router->generate('delete-imageAddi', ['id' => $image->getId()]); ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
                                    </span>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="form-group">
                            <div class="alert alert-warning">
                                <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
                            </div>
                        </div>
                    <?php endif ?>
                    </div>
            </div>


            <div class="container desc_inclu">
                <div class="form-group desc">
                    <label for="description">Descripción</label>
                    <textarea name="description" type="text" class="form-control" id="description"><?= $product->getDescription() ?></textarea>
                </div>
                <div class="form-group incl">
                    <label for="include">include</label>
                    <textarea name="include" type="text" class="form-control" id="include"><?= $product->getInclude() ?></textarea>
                </div>
            </div>
            <div class="form-group incl">
                <label for="video">Video</label>
                <input name="video" value="<?= $product->getVideo() ?>" type="text" class="form-control" id="video">
            </div>
            <div class="form-group">
                <label for="price">Precio</label>
                <input name="price" value="<?= $product->getPrice() ?>" type="number" class="form-control" id="price" placeholder="34.99">
            </div>
            <div class="form-group">
                <label for="status">Estado</label>
                <select name="status" type="number" class="form-control" id="status" placeholder="status" min="1" max="2">
                    <?php foreach ($status as $id => $stat) : ?>
                        <option value="<?= $id ?>"><?= $stat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Categorie</label>
                <select name="category_id" type="number" class="form-control category_id" id="category_id" placeholder="">
                    <?php foreach ($allCategories as $category) : ?> ;
                        <option value="<?= $category->getId() ?>" <?= ($product->getCategory_id() == $category->getId()) ? "selected" : '' ?>><?= $category->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" id="sub_category">
                <label for="subCategory_id">Subcategorias</label>
                <select name="subCategory_id" type="number" class="form-control" id="subCategory_id" placeholder="">
                    <option value="">--Please choose an option--</option>
                    <?php foreach ($allSubCategories as $subCategory) : ?> ;
                        <option value="<?= $subCategory->getId() ?>" <?= ($product->getCategory_id() == $subCategory->getId()) ? "selected" : '' ?> class="newOption"><?= $subCategory->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" value='Upload' name='update' class="btn btn-primary btn-block mt-5">Validar</button>
    </form>