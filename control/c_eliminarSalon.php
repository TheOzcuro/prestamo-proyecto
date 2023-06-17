<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->EliminarSalon($_POST["id_salon"]);
$_SESSION["mensaje"]="El salon ha sido eliminada";
header('Location: ../vista/admin.php');
?>