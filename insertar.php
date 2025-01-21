<?php require_once "db.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Datos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>Insertar Datos</header>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="listar.php">Listar</a>
        <a href="actualizar.php">Actualizar</a>
        <a href="eliminar.php">Eliminar</a>
        <a href="cargar_combos.php">Cargar Combos</a>
        <a href="registro_usuario.php">Registrar Usuario</a>
        <a href="login_usuario.php">Iniciar Sesión</a>
    </nav>
    <div class="container">
        <h2>Formulario de Inserción</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $domicilio = $_POST['domicilio'];

            $sql = "INSERT INTO personas (nombres, apellidos, domicilio) VALUES ('$nombres', '$apellidos', '$domicilio')";
            if ($conexion->query($sql) === TRUE) {
                echo "<p class='alert alert-success'>Datos insertados correctamente</p>";
            } else {
                echo "<p class='alert alert-error'>Error al insertar: " . $conexion->error . "</p>";
            }
        }
        ?>
        <form method="POST" action="">
            <label for="nombres">Nombre</label>
            <input type="text" id="nombres" name="nombres" required>
            
            <label for="apellidos">Apellido</label>
            <input type="text" id="apellidos" name="apellidos" required>
            
            <label for="domicilio">Domicilio</label>
            <input type="text" id="domicilio" name="domicilio" required>
            
            <button type="submit">Insertar</button>
        </form>
    </div>
</body>
</html>
