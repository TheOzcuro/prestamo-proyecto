<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->DeleteGrupo($_POST["codigo_grupo"]);
$_SESSION["mensaje"]="El Grupo Ha sido Eliminado con exito";
header('Location: ../vista/admin.php');
?>