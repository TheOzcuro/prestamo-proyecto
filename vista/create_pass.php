<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if(isset($_SESSION["mensaje"])) {
    echo "<script>alert('".$_SESSION["mensaje"]."')</script>";
    unset($_SESSION["mensaje"]);
}

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Crear Contraseña</title>
</head>
<body>
    <form action="../control/c_create_pass.php" id='login' name='pass' method='POST'>
    <div class='login_container'>
        <h1>Crear Contraseña</h1>
        <div class='input_container'>
        <label for="password">Contraseña</label>
        <input type="password" id='password' name='password' maxlength='40'>
        </div><br>
        <div class='input_container'>
        <label for="password_con">Confirmar Contraseña</label>
        <input type="password" id='password_con' name='password_con' maxlength='40'>
        </div><br>
        <button type='button' onclick='EnviarPass()'>Crear Contraseña</button>
    </div>
    </form>
</body>
<script src="../js/login.js"></script>
</html>