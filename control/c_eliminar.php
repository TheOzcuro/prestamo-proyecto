<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->Delete($_POST["cedula_usuario"]);
$_SESSION["mensaje"]="El Usuario Ha sido Eliminado con exito";
header('Location: ../vista/admin.php');
?>