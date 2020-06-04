



<nav class="navbar navbar-expand-lg navbar-light nav-admin">
    <div class="container">
        <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">Cosmorama</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= $router->generate('admin-home') ?>">Home<span
                            class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="">Categorias</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('admin-product-list')?>">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Promociones</a>
                </li>
            </ul>
           <!--  <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Rechercher</button>
            </form> -->
            <ul class="navbar-nav ">

        
            
                <?php if(!empty($_SESSION['userConnected'])): ?>
                <li class="nav-item" style="padding-top: 8px">
                    <p><?= !empty($userConnected) ? $userConnected->getUsername() : "" ?>
                    </p>
                </li>

                <?php if(in_array($userConnected->getRole(), ["admin","superadmin"]) ):?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('admin-user-list') ?>">Users</a>
                </li>

                <?php endif; ?> 

                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('admin-user-logout') ?>">Logout</a>
                </li>

                <?php else : ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('admin-user-login') ?>">Login</a>
                </li>

                <?php endif ;?>

            </ul>
        </div>

    </div>
</nav>
<!-- 

<?php $un = 1 ?> 

<?php if($blabla): ?> 
<?php if($blbla): ?> 
<?php else: ?> 
    bla
<?php endif; ?> 
<?php endif; ?> 
 -->