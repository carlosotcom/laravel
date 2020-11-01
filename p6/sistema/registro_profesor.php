<?php 

    if(!empty($_POST))
    {
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['telefono']) || empty($_POST['dni'])
        || empty($_POST['email']))
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';// funciona bien
        }else{
            include "../conexion.php";
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $tel = $_POST['dni'];
            $dni = $_POST['email'];
            $correo = $_POST['username'];

            //echo "SELECT * FROM users_admin WHERE dni = '$dni' ";
            $query = mysqli_query($conection,"SELECT * FROM teachers WHERE name = '$nombre' OR surname ='$apellido' OR telephone = '$tel' 
            OR nif= '$dni' OR email = '$correo' ");
            $result = mysqli_fetch_array($query);
            if($result > 0){
                $alert= '<p class="msg_error">El profesor ya existe.</p>';//no me funciona ya que duplica las entradas
            }else{
                $query_insert = mysqli_query($conection, "INSERT INTO teachers(name,surname,telephone,nif,email) 
                VALUES('$nombre','$apellido','$tel','$dni','$correo')");

                if($query_insert){
                    $alert='<p class="msg_save">Profesor creado</p>';
                }else{
                    $alert='<p class="msg_error">Error al crear el profesor</p>';
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
            <label for="telefono">Nombre de usuario</label>
            <input type="text" name="telefono" id="telefono" placeholder="Telefono">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" placeholder="dni">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="email">
            <input type="submit" value="Crear nuevo Profesor" class="btn_save">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>