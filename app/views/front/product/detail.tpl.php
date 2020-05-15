<header class="masthead d-flex">
  <!-- Header -->
  <div class="container  text-center my-auto">

    <h1 class="mb-3"><?= $product->getName() ?> </h1>
    <div class="overlay"></div>
</header>
<?php dump($pictures, $product) ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active ">
     
      <img class="d-block w-100" src="<?=$assetsBaseUri?>img/productos/<?=$product->getImage()?>">
    </div>
    <?php if(count($pictures)>= 1) :?>

    <?php for($i= 0 ; $i < count($pictures); $i++):?>
    <div class="carousel-item ">
      <img class="d-block w-1OO" src="<?=$assetsBaseUri ?>img/productos/<?=$pictures[$i]->getPicture()?>">
    </div>
    <?php endfor ?>
    <?php endif ?>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" height= '400' data-slide="prev">
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
      <div class="col left">
        <h2>DESCRIPTION</h2>
        <p class="product__description"><?= $product->getDescription();?>
        </p>
      </div>
      <div class="col right">
        <h2>INCLUYE</h2>
        <p class="Product__include"><?= $product->getInclude()?></p>
      </div>
    </div>
  </div>
  
  <iframe width="560" height="315" src="<?=$product->getVideo()?>" frameborder="10" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

  
