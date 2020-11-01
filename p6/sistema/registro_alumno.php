<?php 

    if(!empty($_POST))
    {
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['dni']) || empty($_POST['telefono']) || empty($_POST['username'])
        || empty($_POST['password']) || empty($_POST['start'])    )
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';// funciona bien
        }else{
            include "../conexion.php";
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['email'];
            $dni = $_POST['dni'];
            $tel = $_POST['telefono'];
            $user = $_POST['username'];
            $pass = md5($_POST['password']);
            $fecharegistro = $_POST['start'];

            //echo "SELECT * FROM users_admin WHERE dni = '$dni' ";
            $query = mysqli_query($conection,"SELECT * FROM students WHERE nif = '$dni' OR email = '$correo' OR telephone = '$tel' ");
            $result = mysqli_fetch_array($query);
            if($result > 0){
                $alert= '<p class="msg_error">El curso ya existe.</p>';//no me funciona ya que duplica las entradas
            }else{
                $query_insert = mysqli_query($conection, "INSERT INTO students(username,pass,email,name,surname,telephone,nif,date_registered) 
                VALUES('$user','$pass','$correo','$nombre','$apellido','$tel','$dni','$fecharegistro')");

                if($query_insert){
                    $alert='<p class="msg_save">Alumno creado</p>';
                }else{
                   $alert='<p class="msg_error">Error al crear el alumno</p>';
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
	<title>Registro alumnos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>	
	<section id="container">
		<div class="form_register">
            <h1>Registro de Alumnos</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert :''; ?></div>

            <form action="" method="post">
            <label for="nombre">Nombre del alumno</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" placeholder="DNI">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Direccion de correo">
            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" id="telefono" placeholder="Telefono">
            <label for="username">Nombre de usuario</label>
            <input type="username" name="username" id="username" placeholder="Nombre de Usuario">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Contraseña">

            <label for="start">Fecha de registro:</label>
            <input type="date" id="start" name="start" value="2020-01-12" min="2020-01-01" max="2020-12-31">

            <input type="submit" value="Crear nuevo Alumno" class="btn_save">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>