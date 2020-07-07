<section class="masthead d-flex">  
  <div class="container  text-center my-auto">
    <h1 class="mb-3">
      <?= $category2->getName() ?></h1>
    <div class="overlay"></div>
</section>
</header>
<?php if ($category2->getHas_subCat() == "yes") : ?>
  <section class="content-section content_list">

    <?php foreach ($subCategories as $subCategory) : ?>

      <div class="container subCategory__container">
        <h2 class="subCategory__title"><?= $subCategory->name ?></h2>
        <div class="row no-gutters">
          <?php foreach ($products as $product) : ?>

            <?php if ($product->getSubCategory_id() === $subCategory->id) : ?>
              <div class=" list_product__picture _bo col-lg-6">
                <a href="<?= $router->generate('main-product', ['id' => $product->getId()]); ?>">
                  <img class="image _bp" src="<?= $assetsBaseUri ?>img/productos/<?= $product->getImage() ?>" />
                </a>
                <h2 class="name__camera"><?= $product->getName(); ?></h2>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
      </div>
    <?php endforeach ?>
  </section>
<?php else : ?>
  <section class="content-section content_list">
    <div class="container subCategory__container">
      <div class="row no-gutters">
        <?php foreach ($products as $product) : ?>
          <div class=" list_product__picture _bo col-lg-6">
            <a href="<?= $router->generate('main-product', ['id' => $product->getId()]); ?>">
              <img class="image _bp" src="<?= $assetsBaseUri ?>img/productos/<?= $product->getImage() ?>" />
            </a>
            <h2 class="name__camera"><?= $product->getName(); ?></h2>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  <?php endif ?>
  </section>