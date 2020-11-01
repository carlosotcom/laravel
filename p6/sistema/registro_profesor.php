<?php 

    if(!empty($_POST))
    {
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['dni']) || empty($_POST['email'])
        || empty($_POST['username']) || empty($_POST['password']))
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';// funciona bien
        }else{
            include "../conexion.php";
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellido'];
            $dni = $_POST['dni'];
            $correo = $_POST['email'];
            $nomusuario = $_POST['username'];
            $pass = md5($_POST['password']);

            //echo "SELECT * FROM users_admin WHERE dni = '$dni' ";
            $query = mysqli_query($conection,"SELECT * FROM users_admin WHERE dni = '$dni' OR email ='$correo' OR password = '$pass' ");
            $result = mysqli_fetch_array($query);
            if($result > 0){
                $alert= '<p class="msg_error">El usuario ya existe.</p>';//no me funciona ya que duplica las entradas
            }else{
                $query_insert = mysqli_query($conection, "INSERT INTO users_admin(username,name,surname,dni,email,password) 
                VALUES('$nomusuario','$nombre','$apellidos','$dni','$correo','$pass')");

                if($query_insert){
                    $alert='<p class="msg_save">Usuario creado</p>';
                }else{
                    $alert='<p class="msg_error">Error al crear el usuario</p>';
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Registro profesor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>	
	<section id="container">
		<div class="form_register">
            <h1>Registro de Profesor</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert :''; ?></div>

            <form action="" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" placeholder="dni">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="email">
            <label for="username">Nombre de usuario</label>
            <input type="text" name="username" id="username" placeholder="Nombre de usuario">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="password">
            <input type="submit" value="Crear nuevo Administrador" class="btn_save">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>