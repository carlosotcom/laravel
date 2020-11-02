<?php
include "../conexion.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Administracion</title>
</head>
<body>
	<?php include "includes/header.php"; ?>	
	<section id="container">
        <h1>Listado de usuarios administradores</h1>
        <a href="registro_admin.php" class="btn_new">Crear usuario</a>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Username</th>
                <th>Acciones</th>
            </tr>
            <?php
            $query = mysqli_query($conection, "SELECT username, name, email, surname,dni FROM users_admin");
            $result = mysqli_num_rows($query);
            if($result > 0){
                while ($data = mysqli_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $data["name"] ?></td>
                    <td><?php echo $data["surname"] ?></td>
                    <td><?php echo $data["username"] ?></td>
                    <td><?php echo $data["dni"] ?></td>
                    <td><?php echo $data["email"] ?></td>
                    <td>
                        <a class="link_edit" href="edit_admin.php">Editar</a>
                        |
                        <a class="link_delete" href="#">Eliminar</a>
                    </td>
                </tr>

            <?php
                }
            }
            ?>
        </table>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>