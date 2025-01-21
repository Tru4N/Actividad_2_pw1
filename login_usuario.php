<?php require_once "db.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>Iniciar Sesión</header>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="listar.php">Listar</a>
        <a href="insertar.php">Insertar</a>
        <a href="actualizar.php">Actualizar</a>
        <a href="eliminar.php">Eliminar</a>
        <a href="cargar_combos.php">Cargar Combos</a>
        <a href="registro_usuario.php">Registrar Usuario</a>
    </nav>
    <div class="container">
        <h2>Inicio de Sesión</h2>
        <?php
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM usuarios WHERE email = '$email'";
            $result = $conexion->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['usuario_id'] = $user['id'];
                    echo "<p class='alert alert-success'>Inicio de sesión exitoso</p>";
                } else {
                    echo "<p class='alert alert-error'>Contraseña incorrecta</p>";
                }
            } else {
                echo "<p class='alert alert-error'>Usuario no encontrado</p>";
            }
        }
        ?>
        <form method="POST" action="">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
