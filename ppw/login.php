<?php 

    session_start();

    if(isset($_SESSION['user_id'])){
        header('Location: /ppw/index.php');
    }

    include("template/cabecera.php");

    include("administrador/config/database.php");

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $registros = $conn-> prepare ('SELECT id, email, password FROM users WHERE email=:email' );
        $registros->bindParam(':email', $_POST['email']);
        $registros->execute();
        $results = $registros->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($results) > 0 && password_verify($_POST['password'],$results['password'])){
            $_SESSION['user_id'] = $results['id'];
            header('Location: /ppw/index2.php');
        } else{
            $message = 'Tus pendejadas no coinciden';
        }

    }

?> 

<style>

    input[type="text"]{

    outline: none;
    padding: 20px;
    display: block;
    width: 300px;
    border-radius: 3px;
    border: 1px solid #eee;
    margin: 2px auto;

}

input[type="password"]{

outline: none;
padding: 20px;
display: block;
width: 300px;
border-radius: 3px;
border: 1px solid #eee;
margin: 20px auto;

}


input[type="submit"]{

    padding: 10px;
    color: #fff;
    background: #0098cb;
    width: 320px;
    margin: 20px auto;
    margin-top: 0;
    border: 0;
    border-radius: 3px;
    cursor: pointer;

}

input[type="submit"]:hover{

background-color: #00b8eb;

}

h2{
    padding-top: 35px;
    padding-bottom: 35px;
}

h3{
    padding-top: 25px;
    padding-bottom: 25px;
}

body {
background-color: #292c37;
color: white;
}


</style>


    <h2>E-Food Truck Menesteres</h2>
    <h3>Iniciar Sesi&oacute;n</h3>
    <span> O <a href="signup.php"> Registrarse </a> </span>

    <?php  if(!empty($message)) : ?>
        <p> <?= $message ?> </p>
    <?php endif;?>
    <br><br>

    <div class="formLogin">
        <form action="login.php" method="post">

            <input type="text" name="email" placeholder="Introduce tu correo electr&oacute;nico" >
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            <input type="password" name="password" placeholder="Introduce tu contraseña" >
            <input type="submit" value="Send" >

            <br><br><br>

        </form>
    </div>
    
    </div>

<br><br>

<?php include("template/piepagina.php");?>