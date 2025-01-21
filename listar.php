<?php require_once "db.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Datos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>Listar Datos</header>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="insertar.php">Insertar</a>
        <a href="actualizar.php">Actualizar</a>
        <a href="eliminar.php">Eliminar</a>
        <a href="cargar_combos.php">Cargar Combos</a>
        <a href="registro_usuario.php">Registrar Usuario</a>
        <a href="login_usuario.php">Iniciar Sesión</a>
    </nav>
    <div class="container">
        <h2>Listado de Personas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Domicilio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM personas";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['idp']}</td>
                                <td>{$row['nombres']}</td>
                                <td>{$row['apellidos']}</td>
                                <td>{$row['domicilio']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay registros disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
