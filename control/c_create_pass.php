<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->RegistrarPass($_POST["password"], $_SESSION["cedula"]);
if ($val==1) {
    $_SESSION["mensaje"]="Se ha registrado correctamente la contraseña";
}
else {
    $_SESSION["mensaje"]="Ha ocurrido un error intente mas tarde";
}
header('Location: ../vista/login.php');
?>