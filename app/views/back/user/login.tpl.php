</header>
    <?php 
        if (!is_null($goodList)):
            foreach($goodList as $key => $good):
    ?>
    <div class="alert alert-success"><?= $good?></div>
    <?php 
        //supprimer le message de la session pour ne pas le réafficher sur la prochaine page
            endforeach;
        endif;
    ?>
 <?php dump($_SESSION) ?>


 <a href="<?= $router->generate('main-home') ?>" class="btn btn-success float-right">Retour</a>


 <h2 class="h1-responsive font-weight-bold text-center my-4"><img class="contact__logo" src="<?= $assetsBaseUri ?>/img/logo/COSMORAMA-LOGO-GIF2.gif" alt=""></h2>

<section class="contact__form">
    <form class="text-center">
        <div class="form-group">
            <input type="name" name="userNname" class="form-control" id="userName" placeholder="User Name">
        </div>
        <div class="form-group ">
          
          <input type="password" name="password" class="form-control" id="password" aria-describedby="passwordHelp" placeholder="MAIL">      
      </div>
    </form>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </section>

    <?php if (!empty($errorsList)): ?>
        <div class="text-danger font-weight-bold">Cuidado ! Hay errores</div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary btn-block mt-5">Se connecter</button>
 </form>