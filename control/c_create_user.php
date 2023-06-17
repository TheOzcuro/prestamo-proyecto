<?php
session_start();
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$ejecutar->setDatos($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['pass']);
$val=$ejecutar->Registrar();
echo $val;

if ($val==2 && $val!=1) {
    $_SESSION["error"]="La cedula del usuario ya existe";
    header("Location: ../vista/create_user.php");
}
else {
    $_SESSION["error"]='Usuario Registrado';
    header("Location: ../vista/login.php");
}

?>
