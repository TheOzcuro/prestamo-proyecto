<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->RegistrarUsers($_POST["cedula_usuario"],$_POST["nombre_usuario"],$_POST["apellido_usuario"],$_POST["rol"]);
if ($val==1) {
   
    $_SESSION["mensaje"]="El Usuario ".$_POST["nombre_usuario"]." ".$_POST["apellido_usuario"]." Ha sido registrado con exito";
}
else {
    $_SESSION["mensaje"]="El usuario ya existe";
}

header('Location: ../vista/admin.php');
?>