<div class="container my-4">
    <a href="<?= $router->generate('admin-user-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter un produit</h2>

    <form action="" method="POST" class="mt-5">
        <!-- pour se protéger des attaques csrf -->
        <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">

        <?php if (!empty($errorsList)) : ?>
            <div class="alert alert-danger text-center font-weight-bold">User could not be added</div>
        <?php endif; ?>


        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input name="username" type="text" class="form-control" id="username" placeholder="John">
                <?php if (!empty($errorsList['username'])) : ?>
                    <div class="text-danger font-weight-bold"><?= $errorsList['username'] ?></div>
                <?php endif; ?>
            </div>

            <!-- // Si on veut ajouter une photo
         <div class="form-group">
        <label for="picture"></label>
        <input name="picture" type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
        <small id="pictureHelpBlock" class="form-text text-muted">
            URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
        </small>
    </div> -->

            <form method="POST" class="mt-5">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="email">
                    <?php if (!empty($errorsList['email'])) : ?>
                        <div class="text-danger font-weight-bold"><?= $errorsList['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="emailToConfront">Verificar Email</label>
                    <input name="emailToConfront" type="email" class="form-control" id="email" placeholder="De nouveau">
                    <?php if (!empty($errorsList['emailCompared'])) : ?>
                        <div class="text-danger font-weight-bold"><?= $errorsList['emailCompared'] ?></div>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe" aria-describedby="subtitleHelpBlock">
                    <?php if (!empty($errorsList['password'])) : ?>
                        <div class="text-danger font-weight-bold"><?= $errorsList['password'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="passwordToConfront">Vérificación Contraseña</label>
                    <input name="passwordToConfront" type="password" class="form-control" id="password" placeholder="De nouveau" aria-describedby="subtitleHelpBlock">
                    <?php if (!empty($errorsList['passwordCompared'])) : ?>
                        <div class="text-danger font-weight-bold"><?= $errorsList['passwordCompared'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" type="number" class="form-control" id="role" placeholder="">
                        <option value="admin">Administrator</option>
                        <option value="catalog-manager">Catalog manager</option>
                    </select>
                </div>
                <!-- Mot de passe -->

                <!-- <div class="form-group">
        <label for="status">Role</label>
        <select name="role" type="number" class="form-control" id="role" placeholder="">
        <option value= "admin">Administrateur</option>
        <option value= "catalog-manager">Catalog manager</option>  
        </select>     
    </div> -->

                <button type="submit" class="btn btn-primary btn-block mt-5">Nuevo usario</button>
            </form>