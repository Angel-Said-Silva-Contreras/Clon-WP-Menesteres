
<?php

    session_start();

    if($_POST){

        if(($_POST['usuario']=="admin")&&($_POST['contraseña']=="1234")){

            $_SESSION['usuario']="ok";
            $_SESSION['nombreUsuario']="admin";

            header('Location:inicio.php');

        }else{
            $mensaje = "Error: El usuario o contraseña son incorrectos";
        }


    }

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Administrador</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">


                <div class="col-md-4">
                    
                </div>


                <div class="col-md-4">

                    <br><br><br>

                        <div class="card">
                            <div class="card-header">
                                Login
                            </div>
                            <div class="card-body">
                                
                            <?php if(isset($mensaje)) {?>
                                <div class="alert alert-danger" role="alert">
                                    <strong> <?php echo$mensaje; ?> </strong>
                                </div>
                            <?php }    ?>

                                <form method="POST" >
                                <div class = "form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" name="usuario" placeholder="Escribe usuario: admin">
                                </div>

                                <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" name="contraseña" placeholder="Escribe contraseña: 1234">
                                </div>

                                <button type="submit" class="btn btn-primary">Entrar al administrador</button>
                                </form>
                                
                                
                            </div>

                        </div>
                    
                </div>
                
            </div>
        </div>
      
    </body>
</html>