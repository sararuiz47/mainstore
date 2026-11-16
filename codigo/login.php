<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>

<!-- Encabezado con ícono -->
<div style="text-align: center; padding: 20px 0;">
  <span style="font-size: 50px;">🛒</span>
  <h1 style="color: #222; margin: 10px 0; font-family: Arial, sans-serif;">Main Store</h1>
</div>

<!-- Formulario centrado -->
<div style="width: 300px; margin: 0 auto; padding: 20px;">
  <h2 style="text-align: center;">Iniciar Sesión</h2>
  
  <form method="post" action="verificar_login.php">
    <label>Correo electrónico:</label><br>
    <input type="email" name="email" required style="width: 100%; padding: 6px; margin: 6px 0 12px;"><br>
    
    <label>Contraseña:</label><br>
    <input type="password" name="contrasena" required style="width: 100%; padding: 6px; margin: 6px 0 12px;"><br><br>
    
    <button type="submit" style="width: 100%; padding: 8px; background: #3498db; color: white; border: none; border-radius: 4px; cursor: pointer;">Ingresar</button>
  </form>
  
  <p style="text-align: center; margin-top: 15px;">¿No tienes cuenta? <a href="registrarse.html">Regístrate aquí</a></p>
</div>

</body>
</html>