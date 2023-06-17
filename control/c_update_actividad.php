<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->UpdateActividad($_POST["actividad_inf"], $_POST["id"]);
$_SESSION["mensaje"]="La actividad ha sido modificada";
header('Location: ../vista/admin.php');
?>