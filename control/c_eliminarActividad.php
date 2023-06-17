<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->EliminarActividad($_POST["id"]);
$_SESSION["mensaje"]="La actividad ha sido eliminada";
header('Location: ../vista/admin.php');
?>