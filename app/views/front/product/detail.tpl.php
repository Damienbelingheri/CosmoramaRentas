
  <!-- Header -->
  <div class="container my-auto">

    <h1 class="mb-3 product__title"><?= $product->getName() ?> </h1>
    <div class="overlay"></div>
</div>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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


<div class="container-fluid">
  <div class="row">

    <div class="col-sm-8 product__video">

      <div class="video-responsive">
        <iframe width="560" height="315" src="<?= $product->getVideo() ?>" frameborder="10" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>

    <div class="col-sm-4 right">
      <h2>INCLUYE</h2>
     <?= $product->getInclude() ?>
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm left">
      <h2>DESCRIPTION</h2>
      <p class="product__description"><?= $product->getDescription(); ?>
      </p>
    </div>
  </div>

</div>