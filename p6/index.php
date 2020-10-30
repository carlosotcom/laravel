<?php
$alert = '';
session_start();//inicialiamos la session
if(!empty($_SESSION['active'])) //si la sesion es true nos dirige a la pagina del administrador
{
     header('location: sistema/');  
}else {
    {
        if(empty($_POST['usuario']) || empty($_POST['clave'])) //comprueba que se haya escrito en los imputbox
        {
            $alert = "Ingrese su usuario y contraseña";
        }else{
            require_once "conexion.php"; //importa el archivo de conexion
            $user = mysqli_real_escape_string($conection, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));//encriptamos el password
            //echo $pass;exit; esta sentencia es para ver la contraseña encriptada, en la base de datos el tipo de la contraseña se ha de cambiar a md5

            $query = mysqli_query($conection, "SELECT * FROM users_admin WHERE username = '$user' AND password = '$pass'");//query para comprobar si existe usuario con ese password
            $result = mysqli_num_rows($query);

            if($result > 0)
            {
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idusername'] = $data['id_user_admin'];
                $_SESSION['nombreusuario'] = $data['username'];
                $_SESSION['nombre'] = $data['name'];
                $_SESSION['mail'] = $data['email'];
                $_SESSION['passw'] = $data['password'];

                header('location: sistema/');            
            }else{
                $alert = 'El usuario o la clave son incorrectos';
                session_destroy();
            }
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
    <link rel="stylesheet" type = "text/css" href="sistema/css/stylelogin.css">
</head>
<body>
    <section id="container">
        <form action ="" method="post">
            <h3>Iniciar sesion</h3>
         <img src="sistema/img/login.png" alt="login">
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="password" name="clave" placeholder="Contraseña">
        <div class="alert"><?php  echo isset($alert)? $alert : ''; ?></div>
        <input type="submit" value="INGRESAR">
        </form>
    </section>
</body>
</html>