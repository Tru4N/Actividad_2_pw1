<?php
$host = "localhost";       // Cambiar según tu servidor
$usuario = "root";         // Usuario de la base de datos
$password = "";   // Contraseña de la base de datos
$db = "db_web";            // Nombre de la base de datos

$conexion = new mysqli($host, $usuario, $password, $db);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
