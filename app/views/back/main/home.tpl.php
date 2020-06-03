<div class="container my-4">
    <p class="display-4">
        Bienvenue dans le backOffice <strong>Dans les shoe</strong>...
    </p>

    <div class="row mt-5">
        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Categorias</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mainCategories as $category) : ?>
                                <tr>
                                    <th scope="row"><?= $category->getid() ?></th>
                                    <td><?= $category->getName() ?></td>
                                    <td class="text-right">
                                        <a href="<? //php $router->generate('category-update', ['id' => $category->getId()]);
                                                    ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php // $router->generate('category-delete', ['id' => $category->getId()]);
                                                                                ?>">Confirmar
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups!</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <a href=<?php //$router->generate('category-list') 
                            ?> class="btn btn-block btn-success">Voir
                        plus</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Promociones <a href="">Activar</a> </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombres</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mainProducts as $product) : ?>
                                <tr>
                                    <th scope="row"><?= $product->getId() ?></th>
                                    <td><?= $product->getName() ?></td>
                                    <td class="text-right">
                                        <a href="<?= $router->generate('admin-product-update', ['id' => $product->getId()]); ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php // $router->generate('product-delete', ['id' => $category->getId()]);
                                                                                ?>">Si, quiero borrar</a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <a href="<?= $router->generate('admin-product-list'); ?>" class="btn btn-block btn-success">Voir plus</a>
                </div>
            </div>
        </div>
    </div>
</div>