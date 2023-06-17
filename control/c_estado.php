<?php 
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$ejecutar->UpdateState($_POST["cedula_usuario"],$_POST["cedula_original"], $_POST["rol"]);
header('Location: ../vista/admin.php');
?>