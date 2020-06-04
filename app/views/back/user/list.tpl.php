<div class="container my-4">
        <a href=<?= $router->generate('admin-user-add');?> class="btn btn-success float-right">Ajouter</a>
        <h2>Liste des Utilisateurs</h2>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                </tr>


            </thead>
            <tbody>
                <?php dump($users); ?>
            <?php foreach($users as $user):?>
                <tr>
                    <th scope="row"><?= $user->getid()?></th>
                    <td><?= $user->getUsername()?></td>
                    <td><?= $user->getEmail()?></td>
                    <td><?= $user->getRole()?></td>
                
                    <td class="text-right">
                        <a href="<?= $router->generate('admin-user-update', ['id' => $user->getId()]);?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= $router->generate('admin-user-delete', ['id' => $user->getId()]);?>">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <p></p>
                <?php endforeach ?>   
            </tbody>
        </table>
    </div>