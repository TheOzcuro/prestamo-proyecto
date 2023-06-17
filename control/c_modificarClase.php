<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->UpdateClase($_POST["clase_inf"], $_POST["id_clase"]);
$_SESSION["mensaje"]="La clase ha sido modificada";
header('Location: ../vista/admin.php');
?>