    <div class="container my-4">
        <a href="<?= $router->generate('admin-product-add'); ?>" class="btn btn-success float-right">Ajouter</a>
        <h1>Lista de productos</h1>
        <?php foreach ($categories as $category) : ?>
            <h2 class="list__title"><?= $category->getName() ?></h2>

            <table class="table table-hover mt-4">
                <thead class="list__thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Foto Principal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list__tbody">
                    <?php foreach ($products as $product) :
                        if ($product->getCategory_id() == $category->getId()) :
                    ?>

                            <th scope="row"><?= $product->getId() ?></th>
                            <td><?= $product->getName() ?></td>
                            <td><img src="<?= $assetsBaseUri ?>img/productos/<?= $product->getImage() ?>" class="list__picture" alt="">
                            </td>
                            <td class="text-right">
                                <a href="<?= $router->generate('admin-product-update', ['id' => $product->getId()]); ?>" class="btn btn-lg btn-warning">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </a>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-lg btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<? // $router->generate('product-delete', ['id' => $product->getId()]);
                                                                    ?>">Si, quiero borrar</a>
                                        <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                    </div>
                                </div>
                            </td>
                            </tr>
                    <?php
                        endif;
                    endforeach; ?>

                </tbody>
            </table>

        <?php
        endforeach;
        ?>