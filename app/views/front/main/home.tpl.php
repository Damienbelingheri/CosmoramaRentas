
<?php if (!empty($_SESSION['mailSent'])) : ?>

   <!--  <div class="alert alert-success text-center font-weight-bold"><?= $_SESSION['mailSent'];
    session_unset();
    ?> </div> -->
<?php endif; ?>
   <!-- Logo principale -->
   <section class="masthead d-flex cont__logo">
     <img id="logo" src="<?= $assetsBaseUri ?>/img/logo/LOGO-PRINCIPAL.png" alt="" >
   </section>


   </header>
   <div class="container my-4">




   <!-- Promotions -->

   <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
     <div class="carousel-inner">
       <div class="carousel-item active">
         <img class="d-block w-100" src="<?= $assetsBaseUri ?>img/banners/BANNER.png" alt="First slide">
       </div>
       <div class="carousel-item">
         <img class="d-block w-100" src="<?= $assetsBaseUri ?>img/banners/BANNER.png" alt="Second slide">
       </div>
       <div class="carousel-item">
         <img class="d-block w-100" src="<?= $assetsBaseUri ?>img/banners/BANNER.png" alt="Third slide">
       </div>
     </div>
     <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>
     </a>
     <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
     </a>
   </div>







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