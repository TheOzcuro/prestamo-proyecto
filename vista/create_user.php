<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if (isset($_SESSION["error"])) {
    echo "<script>alert('".$_SESSION["error"]."')</script>";
    session_destroy();
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de Usuario</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<form action="../control/c_create_user.php" method="post" name='crear' id='crear'>
    <div class='login_container'>
        <h1>Crear Usuario</h1>
        <div class='input_container'>
        <label for="usuario">Cedula</label>
        <input type="text" id='cedula' name='cedula' maxlength='30'>
        </div><br>
        <div class='input_container'>
        <label for="usuario">Nombre</label>
        <input type="text" id='nombre' name='nombre' maxlength='40'>
        </div><br>
        <div class='input_container'>
        <label for="usuario">Apellido</label>
        <input type="text" id='apellido' name='apellido'maxlength='40'> 
        </div><br>
        <div class='input_container'>
        <label for="pass">Contraseña</label>
        <input type="password" id='pass' name='pass' maxlength='50'>
        </div><br>
        <div class='input_container'>
        <label for="pass">Confirmar Contraseña</label>
        <input type="password" id='conpass' name='conpass' maxlength='50'>
        </div><br>
        <a href="login.php">Volver al Inicio de Sesion</a><br>
        <button type='button' onclick='Send()'>Crear</button>
    </div>
</form>
    <script src="../js/create_user.js"></script>
</body>
</html>