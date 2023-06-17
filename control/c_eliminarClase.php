<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->EliminarClase($_POST["id_clase"]);
$_SESSION["mensaje"]="El salon ha sido eliminada";
header('Location: ../vista/admin.php');
?>