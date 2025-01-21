<?php require_once "db.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>Actualizar Datos</header>
    <nav>
    <a href="index.php">Inicio</a>
        <a href="listar.php">Listar</a>
        <a href="insertar.php">Insertar</a>
        <a href="eliminar.php">Eliminar</a>
        <a href="cargar_combos.php">Actualizar</a>
        <a href="registro_usuario.php">Registrar Usuario</a>
        <a href="login_usuario.php">Iniciar Sesión</a>
    </nav>
    <div class="container">
        <h2>Actualizar Información de Persona</h2>
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

        <form method="POST">
            <input type="hidden" name="idp" value="<?php echo $_POST['idp'] ?? ''; ?>">
            <label for="nombre">Nuevo Nombre:</label>
            <input type="text" id="nombre" name="nombres" value="<?php echo $nombres; ?>" required>
            <label for="apellido">Nuevo Apellido:</label>
            <input type="text" id="apellido" name="apellidos" value="<?php echo $apellidos; ?>" required>
            <label for="domicilio">Nuevo Domicilio:</label>
            <input type="text" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>" required>
            <button type="submit" name="update">Actualizar</button>
        </form>

        <?php
        if (isset($_POST['update'])) {
            $idp = $_POST['idp'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $domicilio = $_POST['domicilio'];

            $sql = "UPDATE personas SET 
                    nombres = '$nombres', 
                    apellidos = '$apellidos', 
                    domicilio = '$domicilio' 
                    WHERE idp = $idp";

            if ($conexion->query($sql) === TRUE) {
                echo "<p>Registro actualizado correctamente.</p>";
            } else {
                echo "<p>Error: " . $db->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>
