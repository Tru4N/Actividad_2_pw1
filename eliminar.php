<?php require_once "db.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Datos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>Eliminar Datos</header>
    <nav>
    <a href="index.php">Inicio</a>
        <a href="listar.php">Listar</a>
        <a href="insertar.php">Insertar</a>
        <a href="actualizar.php">Actualizar</a>
        <a href="cargar_combos.php">Eliminar</a>
        <a href="registro_usuario.php">Registrar Usuario</a>
        <a href="login_usuario.php">Iniciar Sesión</a>
    </nav>
    <div class="container">
        <h2>Eliminar Persona</h2>
        <form method="POST">
            <label for="idp">Seleccionar Persona:</label>
            <select id="idp" name="idp" onchange="this.form.submit()">
                <option value="">Seleccione</option>
                <?php
                $sql = "SELECT idp, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM personas";
                $result = $conexion->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $selected = isset($_POST['idp']) && $_POST['idp'] == $row['idp'] ? 'selected' : '';
                    echo "<option value='{$row['idp']}' $selected>{$row['nombre_completo']}</option>";
                }
                ?>
            </select>
        </form>

        <?php
        $nombres = $apellidos = $domicilio = '';
        if (!empty($_POST['idp'])) {
            $idp = $_POST['idp'];
            $sql = "SELECT * FROM personas WHERE idp = $idp";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                $nombres = $data['nombres'];
                $apellidos = $data['apellidos'];
                $domicilio = $data['domicilio'];
            }
        }
        ?>

        <?php if (!empty($nombres)) : ?>
            <p>Nombre: <?php echo $nombres; ?></p>
            <p>Apellido: <?php echo $apellidos; ?></p>
            <p>Domicilio: <?php echo $domicilio; ?></p>
            <form method="POST">
                <input type="hidden" name="idp" value="<?php echo $_POST['idp'] ?? ''; ?>">
                <button type="submit" name="delete">Eliminar</button>
            </form>
        <?php endif; ?>

        <?php
        if (isset($_POST['delete'])) {
            $idp = $_POST['idp'];

            // Lógica de eliminación y reinicio de AUTO_INCREMENT
            $stmt = $conexion->prepare("DELETE FROM personas WHERE idp = ?");
            $stmt->bind_param("i", $idp);

            if ($stmt->execute()) {
                // Reiniciar el AUTO_INCREMENT si no quedan registros
                $result = $conexion->query("SELECT COUNT(*) AS total FROM personas");
                $row = $result->fetch_assoc();

                if ($row['total'] == 0) {
                    $conexion->query("ALTER TABLE personas AUTO_INCREMENT = 1");
                }

                echo "<p class='success'>Registro eliminado correctamente y AUTO_INCREMENT reiniciado si era necesario.</p>";
            } else {
                echo "<p class='error'>Error al eliminar el registro: {$conexion->error}</p>";
            }
        }
        ?>
    </div>
</body>
</html>
