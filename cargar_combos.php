<?php require_once "db.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Combos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>Cargar Combos</header>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="listar.php">Listar</a>
        <a href="insertar.php">Insertar</a>
        <a href="actualizar.php">Actualizar</a>
        <a href="eliminar.php">Eliminar</a>
        <a href="registro_usuario.php">Registrar Usuario</a>
        <a href="login_usuario.php">Iniciar Sesión</a>
    </nav>
    <div class="container">
        <h2>Selecciona una Opción</h2>
        <form method="POST" action="">
            <label for="opcion">Opciones:</label>
            <select id="opcion" name="opcion">
                <option value="">Seleccionar</option>
                <?php
                $sql = "SELECT idp, nombres FROM personas";
                $result = $conexion->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['idp']}'>{$row['nombres']}</option>";
                }
                ?>
            </select>
            <button type="submit">Enviar</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $opcion = $_POST['opcion'];
            if ($opcion) {
                echo "<p class='alert alert-success'>Has seleccionado el ID: $opcion</p>";
            } else {
                echo "<p class='alert alert-error'>Por favor, selecciona una opción.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
