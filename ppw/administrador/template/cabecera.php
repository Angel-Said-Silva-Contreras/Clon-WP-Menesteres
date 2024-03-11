
<?php

session_start();
  if(!isset($_SESSION['usuario'])){
    header("Location:../index.php");
  }else{
    if($_SESSION['usuario']=="ok"){
      $nombreUsuario=$_SESSION["nombreUsuario"];
    }
  }

?>


<!doctype html>
<html lang="en">
  <head>
    <title>Menu Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!--<link rel="stylesheet" href="/css/styleAdmin.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@1,100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  </head>
  <body>
      

    <?php $url="http://".$_SERVER['HTTP_HOST']."/ppw" ?>


    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del sitio web<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/inicio.php" width="35" >Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/productos.php" width="35" > Administrador Men&uacute;</a>
            <a class="nav-link" href="logout.php" width="35" > Logout </a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/administrador/seccion/cerrar.php" width="35" >Cerrar sesi&oacute;n</a>
            <a class="nav-item nav-link" href="<?php echo $url;?> " width="35"  >Ver sitio web</a>
        </div>
    </nav>


    <div class="container">
        <br><br>
        <div class="row">