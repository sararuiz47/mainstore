<?php
session_start();
include 'base de datos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    
    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($resultado) === 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        if (password_verify($_POST['contrasena'], $usuario['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            header("Location: bienvenido.php");
            exit;
        }
    }
    echo "<script>alert('❌ Correo o contraseña incorrectos. Intenta de nuevo.'); window.location.href='login.php';</script>";
}
?>