<!-- Header -->

<?php dump($productCat) ?> 
<h1 class="titleFicha <?= $productCat->category_name ?>"><?= $product->getName() ?> </h1>

<div class="overlay"></div>

<div class="FotoInfo container-md row">
  <div id="carouselExampleIndicators" class="carousel slide FotoProducto col-lg-8" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php for ($i = 0; $i < count($pictures) + 1; $i++) : ?>
        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?> "></li>
      <?php endfor ?>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active ">

        <img class="d-block w-100 img_carousel " src="<?= $assetsBaseUri ?>img/productos/<?= $product->getImage() ?>">
      </div>
      <?php if (count($pictures) >= 1) : ?>

        <?php for ($i = 0; $i < count($pictures); $i++) : ?>
          <div class="carousel-item ">
            <img class="d-block w-1OO img_carousel" src="<?= $assetsBaseUri ?>img/productos/<?= $pictures[$i]->getPicture() ?>">
          </div>
        <?php endfor ?>
      <?php endif ?>

      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" height='400' data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <div class=" TxtInlcuye col-lg-4 right <?= $productCat->category_name ?> ">
    <h2 id="detail_include">INCLUYE</h2>
    <?= $product->getInclude() ?>
  </div>
</div>


<!-- <div class="container-fluid"> -->
<div class="row Caracteristicas">
  <div class=" col-sm left TxtCaracteristicas <?= $productCat->category_name ?>">
    <h2 id="detail_desc">DESCRIPTION</h2>
    <?= $product->getDescription(); ?>
  </div>
</div>

<!-- </div> -->