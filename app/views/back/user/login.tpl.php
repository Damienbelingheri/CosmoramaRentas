</header>
 <a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-right">Retour</a>


 <h2 class="h1-responsive font-weight-bold text-center my-4"><img class="contact__logo" src="<?= $assetsBaseUri ?>/img/logo/COSMORAMA-LOGO-GIF2.gif" alt=""></h2>

<section class="contact__form">
    <form class="text-center" method="POST">
        <div class="form-group">
            <input type="email" name="email" class="form-control" id="email" placeholder="email">
        </div>
        <div class="form-group ">
          <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="password">      
      </div>
      <button type="submit" class="btn btn-primary btn-block mt-5">Se connecter</button>
    </form>
    </section>
    <?php if (!empty($errorsList)): ?>
        <div class="text-danger font-weight-bold">Cuidado ! Hay errores</div>
    <?php endif; ?>
   
 </form>