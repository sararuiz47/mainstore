<?php
$servidor = "main-store";
$usuario_db = "root";
$contrasena_db = "";
$nombre_db = "main-store";

$conexion = new mysqli($servidor, $usuario_db, $contrasena_db, $nombre_db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>