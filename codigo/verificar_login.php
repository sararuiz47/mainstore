<?php
session_start();
include 'base_de_datos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE email = $1";
    $resultado = pg_query_params($conexion, $sql, array($email));

    if (pg_num_rows($resultado) === 1) {
        $usuario = pg_fetch_assoc($resultado);

        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];

            header("Location: bienvenido.php");
            exit;
        }
    }

    echo "<script>alert('X Correo o contraseña incorrectos. Intenta de nuevo.'); window.location.href='login.php';</script>";
}
?>