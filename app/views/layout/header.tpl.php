<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cosmorama Rentas</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <!-- Custom Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <!-- Custom CSS -->
  <link href="<?= $assetsBaseUri ?>css/stylish-portfolio.css" rel="stylesheet">
  <link href="<?= $assetsBaseUri ?>css/style.css" rel="stylesheet">
  <link href="<?= $assetsBaseUri ?>node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">


</head>

<body>
  <header>
  
    <?php
    
    if ( strpos($_SERVER['REQUEST_URI'], "admin")!== false || isset($_SESSION['userConnected'])) {
      include __DIR__ . '/../partials/navBackOffice.tpl.php';
    } else {
      include __DIR__ . '/../partials/nav.tpl.php';
    }

    if ($_SESSION['mailSent']):
    ?>
     <div class="alert alert-success text-center font-weight-bold"><?= $_SESSION['mailSent']?> </div>
    <?php endif ?>
