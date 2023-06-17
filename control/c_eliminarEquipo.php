<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->DeleteEquipo($_POST["codigo_equipo"]);
$_SESSION["mensaje"]="El Equipo Ha sido Eliminado con exito";
header('Location: ../vista/admin.php');
?>