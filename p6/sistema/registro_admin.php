<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
	<title>Registro Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>	
	<section id="container">
		<div class="form_register">
            <h1>Registro de Usuario</h1>
            <hr>
            <div class="alert"><p>Error</p></div>
            <form>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni" placeholder="dni">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="email">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="password">
            <input type="submit" value="Crear nuevo Administrador" class="btn_save">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>