
<?php if (!empty($_SESSION['mailSent'])) : ?>

   <!--  <div class="alert alert-success text-center font-weight-bold"><?= $_SESSION['mailSent'];
    session_unset();
    ?> </div> -->
<?php endif; ?>
   <!-- Logo principale -->
  
   <section class="BannerPrincipal" colspan="3;">
	<div class="BannerFijo"> <img src=".<?= $assetsBaseUri ?>/img/logo/CamaraPrincipal-06.png" width="100%" alt=""/></div>
	<div class="BannerNoFijo"><img src="<?= $assetsBaseUri ?>/img/logo/BannerNoFijo-06.png" width="100%" alt=""/></div>
</section>


   </header>

   <section> 
	<div class="TitleProductos"> Nuestros Productos</div>
</section>
   <div class="container my-4">
   <!-- Categories -->
  
   <section class="row no-gutters">
     <!--  TODO Ajouter un lien qui renvoie a la cat séléctionné  -->

     <?php foreach ($categories as $category) : ?>
    
    
       <div class=" overlay-image _bo col-lg-4"><a href="<?= $router->generate('main-category', ['id' => $category->getId()]); ?>">
           <img class=" image _bp " src=" <?= $assetsBaseUri ?><?= $category->getPicture(); ?> " alt="Alt text" />
           <div class=" hover _bq ">
             <img class=" image _bp blur " src=" <?= $assetsBaseUri ?><?= $category->getPicture(); ?> " alt="<?= $category->getName()  ?>" />
             <div class=" text _q "> <?= $category->getName()  ?> </div>
           </div>
         </a>
       </div>
     <?php endforeach; ?>
    
   </section>

 </div>
 
 <h2 id="TextFilmemos"> ¡Filmemos Pues! </h2>	