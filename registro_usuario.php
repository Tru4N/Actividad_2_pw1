<?php require_once "db.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>Registro de Usuario</header>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="listar.php">Listar</a>
        <a href="insertar.php">Insertar</a>
        <a href="actualizar.php">Actualizar</a>
        <a href="eliminar.php">Eliminar</a>
        <a href="cargar_combos.php">Cargar Combos</a>
        <a href="login_usuario.php">Iniciar Sesión</a>
    </nav>
    <div class="container">
        <h2>Formulario de Registro</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
            if ($conexion->query($sql) === TRUE) {
                echo "<p class='alert alert-success'>Usuario registrado correctamente</p>";
            } else {
                echo "<p class='alert alert-error'>Error al registrar: " . $conexion->error . "</p>";
            }
        }
        ?>
        <form method="POST" action="">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>
