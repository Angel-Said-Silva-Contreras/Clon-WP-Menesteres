<?php include("../template/cabecera.php");?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtdescripcionPlatillo=(isset($_POST['txtdescripcionPlatillo']))?$_POST['txtdescripcionPlatillo']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";




include("../config/db.php");
include("../config/database.php");



switch($accion){
    
    case "Agregar":

        //INSERT INTO `platillos` (`id`, `nombre`, `imagen`, `descripcionPlatillo`) VALUES (NULL, 'galletas de hojaldre en forma de corazon', 'aggg.jpg', 'Docena de mini galletas de hojaldre en forma de corazón');
        //$sentenciaSQL = $conexion->prepare("INSERT INTO comidas (nombre, imagen) VALUES (:nombre,:imagen);");
        //$sentenciaSQL -> bindParam(':nombre',$txtNombre);
        $sentenciaSQL = $conexion->prepare("INSERT INTO platillos (nombre,imagen,precio,descripcionPlatillo) VALUES (:nombre,:imagen,:precio,:descripcionPlatillo);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);

        $fecha = new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':descripcionPlatillo',$txtdescripcionPlatillo);
        $sentenciaSQL->execute();
            
        header("Location:productos.php");

        break;

    case "Modificar":

        $sentenciaSQL=$conexion->prepare("UPDATE platillos SET nombre=:nombre, precio=:precio, descripcionPlatillo=:descripcionPlatillo where id=:id ");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->bindParam(':descripcionPlatillo',$txtdescripcionPlatillo);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        if($txtImagen!=""){

            $fecha = new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL=$conexion->prepare("SELECT imagen FROM platillos where id=:id ");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $comida=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
            if(isset($comida["imagen"]) && ($comida["imagen"]!="imagen.jpg") ){
    
                if(file_exists("../../img/".$comida["imagen"])){
    
                    unlink("../../img/".$comida["imagen"]);
    
                }
    
            }

            $sentenciaSQL=$conexion->prepare("UPDATE platillos SET imagen=:imagen where id=:id ");
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
        }
        
        header("Location:productos.php");

        break;


    case "Cancelar":
            header("Location:productos.php");
        break;


    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM platillos where id=:id ");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $comida=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $comida['nombre'];
        $txtPrecio = $comida['precio'];
        $txtImagen = $comida['imagen'];
        $txtdescripcionPlatillo = $comida['descripcionPlatillo']; 

        

        break;


    case "Borrar":

        $sentenciaSQL=$conexion->prepare("SELECT imagen FROM platillos where id=:id ");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $comida=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($comida["imagen"]) && ($comida["imagen"]!="imagen.jpg") ){

            if(file_exists("../../img/".$comida["imagen"])){

                unlink("../../img/".$comida["imagen"]);

            }

        }

        
        $sentenciaSQL=$conexion->prepare("DELETE FROM platillos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        header("Location:productos.php");


        break;


}



$sentenciaSQL=$conexion->prepare("SELECT * FROM platillos");
$sentenciaSQL->execute();
$listaComida=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);





?>


    <div class="col-md-4">


        <div class="card">

            <div class="card-header" >
                Datos de Comida
            </div>

                <div class="card-body">

            <form method="POST" enctype="multipart/form-data" >
                
                <div class = "form-group">
                    <label for="txtID">ID de platillo: </label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name = "txtID" id="txtID" placeholder="ID">
                </div>

                <div class = "form-group">
                    <label for="txtID">Nombre del platillo: </label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name = "txtNombre" id="txtNombre" placeholder="Nombre del platillo">
                </div>

                <div class = "form-group">
                    <label for="txtID">Precio del platillo: </label>
                    <input type="text" required class="form-control" value="<?php echo $txtPrecio; ?>" name = "txtPrecio" id="txtPrecio" placeholder="Precio del platillo">
                </div>

                <div class = "form-group">
                    <label for="txtID">Descripción del platillo: </label>
                    <input type="text" class="form-control" value="<?php echo $txtdescripcionPlatillo; ?>" name = "txtdescripcionPlatillo" id="txtdescripcionPlatillo" placeholder="Descripción del platillo">
                </div>

                <div class = "form-group">
                    <label for="txtID">Imagen: </label>

                    <?php  echo $txtImagen;  ?>
                    <br/>

                    <?php 

                        if($txtImagen!= ""){ ?>

                            <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?> " width="100"  alt=""> 

                        <?php 
                            }
                        ?>

                    <input type="file"  class="form-control" name = "txtImagen" id="txtImagen" placeholder="Foto del platillo">
                </div>


                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo($accion=="Seleccionar")?"disabled":"";?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>

            </form>




            </div>

        </div>        
        

    </div>


    <div class="col-md-8">


        <table class="table table-bordered "  >
            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($listaComida as $comida) { ?>
                <tr>
                    <td> <?php echo $comida['id']; ?> </td>
                    <td> <?php echo $comida['nombre']; ?> </td>
                    <td> 
                        
                    <img class="img-thumbnail rounded" src="../../img/<?php echo $comida['imagen']; ?> " width="100"  alt=""> 
                
                    </td>



                    <td> <?php echo $comida['descripcionPlatillo']; ?> </td>

                    <td> <?php echo $comida['precio']; ?> </td>
                    
                    
                    <td>

                    <form method="post">

                        <input type="hidden" name="txtID" id="textID" value="<?php echo $comida['id']; ?>" />

                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />

                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />

                    </form>

                    </td>

                </tr>

            <?php } ?>

            </tbody>
        </table>

    </div>

<?php include("../template/piepagina.php");?>