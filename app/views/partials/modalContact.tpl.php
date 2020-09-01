<!--Section: Contact v.2-->

<h2 class="h1-responsive font-weight-bold text-center my-4"><img class="contact__logo" src="<?= $assetsBaseUri ?>/img/logo/COSMORAMA-LOGO-GIF2.gif" alt=""> </h2>

<section class="contact__form">
    <form method="POST" action="<?= $router->generate('sendMail') ?>" class="text-center">
        <div class="form-group">
            <input type="Nombre" name="name" class="form-control" id="inputNombre" placeholder="NOMBRE">
        </div>
        <div class="form-group ">
          
          <input type="email" name="email" class="form-control" id="inputMail" aria-describedby="emailHelp" placeholder="MAIL">      
      </div>
        <div class="form-group">
            <textarea class="form-control" name="message" id="inputMessage" placeholder="MENSAGE" rows="6"></textarea>
        </div>  
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  
    </form>
    </section>




    <section class="contact__items">
        <div>
           <p><i class="fas fa-paper-plane"></i></p>
               <a class="info" class href="mailto:CosmoramaRentas@gmail.com">CosmoramaRentas
               @ gmail.com</a>
        </div>
        <div id="">
           <p><i class="fas fa-search-location"></i></p> 
           <p>Colonia Tabacalera
               <br>
               Delegación Cuahutemoc 
               <br>
               CP06030
           </p>
        </div>
        <div>
           <p><i class="fas fa-mobile-alt"></i></p> 
           <a class="info" href="tel:+525540787575">+525540787575</a>
          
               <br>
               <a class="info" href="tel:+5255168723173">+5255168723173</a>
        </div>


    </section>



