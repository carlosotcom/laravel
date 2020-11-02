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
            $query_teachers = mysqli_query($mysqli, "SELECT id_teacher, name FROM teachers");
            $result = mysqli_fetch_array($query);
            if($result > 0){
                $alert= '<p class="msg_error">La asignatura ya existe.</p>';//no me funciona ya que duplica las entradas
            }else{
                $query_insert = mysqli_query($conection, "INSERT INTO users_admin(username,name,surname,dni,email,password) 
                VALUES('$nomusuario','$nombre','$apellidos','$dni','$correo','$pass')");

                if($query_insert){
                    $alert='<p class="msg_save">Asignatura creada</p>';
                }else{
                    $alert='<p class="msg_error">Error al crear la asignatura</p>';
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
	<title>Registro asignaturas</title>
</head>
<body>
	<?php include "includes/header.php"; ?>	
	<section id="container">
		<div class="form_register">
            <h1>Registro de Asignaturas</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert :''; ?></div>

            <form action="" method="post">
            <label for="nombreasig">Nombre de la asignatura</label>
            <input type="text" name="nombreasig" id="nombreasig" placeholder="Nombre de la asignatura">
            <label for="favcolor">Select el color de la asignatura</label>
            <input type="color" id="favcolor" name="favcolor" value="#ff0000"><br><br>
            <label for="profesor">Profesor</label>
            <select name="sel_profe">
            <?php 
                 while($datos = mysqli_fetch_array($query_teachers))
                    {
            ?>
                     <option value="1"><?php echo $datos['name']?></option>
            <?php
                    }
            ?>
            </select>


            <input type="submit" value="Crear nueva asignatura" class="btn_save">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>