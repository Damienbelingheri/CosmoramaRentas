</div><!-- fin du container my-4 -->
</body>
<?php if (!isset($temoin)) : ?>
  <!-- Footer -->
  <footer>
    
  </footer>
<?php else : ?>

  <footer>
    <div class="blank"></div>
  </footer>
 <?php endif; ?>






 <!-- And for every user interaction, we import Bootstrap JS components -->
 <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
<!-- <script src="<?= $assetsBaseUri ?>vendor/jquery-easing/jquery.easing.min.js"></script>
 -->
<!-- Custom scripts for this template -->
<script src="<?= $assetsBaseUri ?>js/app.js"></script>
<script src="<?= $assetsBaseUri ?>js/stylish-portfolio.min.js"></script>
<script src="<?= $assetsBaseUri ?>js/validation.js"></script>
<script src="<?= $assetsBaseUri ?>js/displayImage.js"></script>
<script src="<?= $assetsBaseUri ?>ckeditor4/ckeditor.js"></script>
<script src="<?= $assetsBaseUri ?>js/ckeditorOption.js"></script>

</body>

</html>