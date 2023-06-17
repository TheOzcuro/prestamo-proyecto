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
    <title>Inicio Sesion</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<form action="../control/c_login.php" method="post" name='login' id='login'>
    <div class='login_container'>
        <h1>Iniciar Sesion</h1>
        <div class='input_container'>
        <label for="usuario">Cedula</label>
        <input type="text" id='usuario' name='usuario' maxlength='30'>
        </div><br>
        <div class='input_container'>
        <label for="pass">Contraseña</label>
        <input type="password" id='pass' name='pass' maxlength='50'>
        </div><br>
        <button type='button' onclick='Enviar()'>Ingresar</button>
    </div>
</form>
<script src="../js/login.js">
    input[0].addEventListener('keypress',KeyNumeros);
    input[1].addEventListener('keypress',KeyVarchar);
</script>
</body>
</html>