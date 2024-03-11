
<?php

    session_start();

    include("administrador/config/database.php");

    if(isset($_SESSION['user_id'])){
        $registros = $conn->prepare('SELECT id, nombre, apellido, email, password FROM users WHERE id = :id');
        $registros ->bindparam(':id', $_SESSION['user_id']);
        $registros ->execute();
        $results = $registros->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0  ){
            $user = $results;
        }

    }

?>

<?php include("template/cabecera2.php");?>  


<?php if(!empty($user)): ?>
<br> Bienvenid@. <?= $user['nombre']." ". $user['apellido'];  ?>
<br> Estas loggeado a la aplicaci&oacute;n
<!--<a href="Logout.php"> Logout </a>-->


<?php else: ?>

<?php endif; ?>

        <div class="jumbotron text-center">
            
        <br><br><br>
            <style>

                body {
                background-color: #292c37;
                color: white;
                }

                

            </style>
        
        
            <h1 class="display-3">E-Food Truck Menesteres</h1>
            <p class="lead">Comida callejera con un concepto Geek diferente para los paladares exigentes. <br> 
                Cada mes actualizamos nuestro men&uacute; con una comida solo disponible por tiempo limitado. </p>

                <br>

                <div>

                    <img  src="img-for-page/frm.webp" class="img-thumbnail rounded mx-auto d-block " >
                </div>

                <br><br>

                <hr class="my-2">

                <h3>El Verano Llego a Menesteres</h3>
                <p>All You Need Is Love</p>

                <div>

                    <img  src="img-for-page/aynil.webp" class="img-thumbnail rounded mx-auto d-block " >
                </div>

                <br><br>

                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="menu.php" role="button">Menu de Verano</a>
                </p>

                    <br><br>
                    
                        <hr class="my-2">
                    
                    <br><br><br>


                    <div>


                        <img  src="img-for-page/ofertas.webp" class="img-thumbnail rounded mx-auto d-block " >
                    </div>

                <br><br><br>
                    
                    <hr class="my-2">
                
                <br><br><br>

                <h2 class="display-3">E-Food Truck Menesteres</h2>
                        <p class="lead">Comida callejera con un concepto diferente para los paladares exigentes. <br> 
                        Cada mes actualizamos nuestro men&uacute; con una comida solo disponible por tiempo limitado. </p>

                        <br><br>
                    <div>
                    <style>
                        
                    </style>
                    <img  src="img-for-page/foto.webp" class="img-thumbnail rounded mx-auto d-block " >
                    
                </div>

                <br><br>

                <p>Comida del mes</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href=" /ppw/menu.php  " role="button">Ir a la comida del mes</a>
                </p>

                    <br><br>
                    
                        <hr class="my-2">
                    
                    <br><br><br>

                <div>
                    <style>
                        
                    </style>
                    <img  src="img-for-page/comidaycena.webp" class="img-thumbnail rounded mx-auto d-block " >
                </div>

                    <br><br><br>

                <br><br>

                <hr class="my-2">

                <br><br>


                <br>

                <div>
                    <img  src="img-for-page/food-truck-chica.jpg" class="img-thumbnail rounded mx-auto d-block " >
                </div>

                <br><br>

<p>M&aacute;s Informaci&oacute;n acerca de nosotros E-Food Truck Menesteres</p>
<p class="lead">
    <a class="btn btn-primary btn-lg" href="nosotros.php" role="button">Acerca de Nosotros</a>
</p>

                <br><br><br>

            </div>

<?php include("template/piepagina.php");?>