<?php

$alert = '';
    if(!empty($_POST))
    {
        if(empty($_POST['usuario']) || empty($_POST['clave']))
        {
            $alert = "Ingrese su usuario y contraseña";
        }else{
            require_once "conexion.php";

            $user = $_POST['usuario'];
            $pass = $_POST['clave'];
            $query = mysqli_query($conection, "SELECT * FROM users_admin WHERE username = '$user' AND password = '$pass'");
            $result = mysqli_num_rows($query);

            if($result > 0)
            {
                $data = mysqli_fetch_array($query);
                session_start();
                $_SESSION['active'] = true;
                $_SESSION['idusername'] = $data['id_user_admin'];
                $_SESSION['nombreusuario'] = $data['username'];
                $_SESSION['nombre'] = $data['name'];
                $_SESSION['mail'] = $data['email'];
                $_SESSION['passw'] = $data['password'];

                header('location: sistema/');            
            }else{
                $alert = 'El usuario o la clave son incorrectos';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type = "text/css" href="css/stylelogin.css">
</head>
<body>
    <section id="container">
        <form action ="" method="post">
            <h3>Iniciar sesion</h3>
         <img src="img/login.png" alt="login">
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="password" name="clave" placeholder="Contraseña">
        <div class="alert"><?php  echo isset($alert)? $alert : ''; ?></div>
        <input type="submit" value="INGRESAR">
        </form>
    </section>
</body>
</html>