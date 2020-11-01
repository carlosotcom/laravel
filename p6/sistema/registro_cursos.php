<?php 

    if(!empty($_POST))
    {
        $alert='';
        if(empty($_POST['nombrecurso']) || empty($_POST['descripcion']) || empty($_POST['start']) || empty($_POST['finish']))
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';// funciona bien
        }else{
            include "../conexion.php";
            $nombre = $_POST['nombrecurso'];
            $descripcion = $_POST['descripcion'];
            $fechainicio = $_POST['start'];
            $fechafin = $_POST['finish'];

            //echo "SELECT * FROM users_admin WHERE dni = '$dni' ";
            $query = mysqli_query($conection,"SELECT * FROM courses WHERE name = '$nombre' OR description ='$description' OR date_start = '$start'  OR date_end = '$finish' ");
            $result = mysqli_fetch_array($query);
            if($result > 0){
                $alert= '<p class="msg_error">El curso ya existe.</p>';//no me funciona ya que duplica las entradas
            }else{
                $query_insert = mysqli_query($conection, "INSERT INTO courses(name,description,date_start,date_end) 
                VALUES('$nombre','$descripcion','$fechainicio','$fechafin')");

                if($query_insert){
                    $alert='<p class="msg_save">Curso creado</p>';
                }else{
                   $alert='<p class="msg_error">Error al crear el curso</p>';
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
	<title>Registro curso</title>
</head>
<body>
	<?php include "includes/header.php"; ?>	
	<section id="container">
		<div class="form_register">
            <h1>Registro de Cursos</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert :''; ?></div>

            <form action="" method="post">
            <label for="nombrecurso">Nombre del curso</label>
            <input type="text" name="nombrecurso" id="nombrecurso" placeholder="Nombre del curso">
            <label for="descripcion del curso">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
            <label for="start">Start date:</label>
            <input type="date" id="start" name="start" value="2020-01-01" min="2020-01-01" max="2020-12-31">
            <label for="start">Start date:</label>
            <input type="date" id="finish" name="finish" value="2020-01-12" min="2020-01-01" max="2020-12-31">
            <label class="radio">Activar curso
                <input type="radio" checked="checked" name="radio">
                <span class="check"></span>
            </label>
            <input type="submit" value="Crear nuevo curso" class="btn_save">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>