<nav class="navbar navbar-expand-lg navbar-light ">
  <div class="container">
    <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">
      <img src="<?= $assetsBaseUri ?>img/logo/LOGO-PEQUEÑO.png" width="100" height="100" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Calálogo
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach ($categories as $category) : ?>
              <a class="dropdown-item" href="<?= $router->generate('main-category', ['id' => $category->getId()]); ?>"><?= $category->getName() ?></a>
            <?php endforeach; ?>
          </div>
        <li class="nav-item">
          <a class="nav-link" href="#">Condiciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter">Contacto</a>

          
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>               
                <div class="modal-body">
                <?php include __DIR__ . '/modalContact.tpl.php'; ?>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>



