<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'base de datos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['fname'] . ' ' . $_POST['lname'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['pswd'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $contrasena);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('✅ ¡Cuenta creada con éxito! Ya puedes iniciar sesión.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('❌ Error: " . addslashes(mysqli_error($conexion)) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>✅ Conectado correctamente</h2>
    <p><a href="registrarse.html">← Volver al formulario</a></p>
</body>
</html>