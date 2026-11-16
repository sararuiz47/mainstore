<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Main Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            text-align: center;
            padding-top: 100px;
        }
        .tarjeta {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        h1 { color: #2b6cb0; }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background: #e53e3e;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a:hover { background: #c53030; }
    </style>
</head>
<body>
    <div class="tarjeta">
        <h1>🎉 ¡Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?>!</h1>
        <p>Has iniciado sesión correctamente en <strong>Main Store</strong>.</p>
        <a href="cerrar.php">Cerrar sesión</a>
    </div>
</body>
</html>