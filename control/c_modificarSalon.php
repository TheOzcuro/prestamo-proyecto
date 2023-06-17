<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->UpdateSalon($_POST["salon_inf"], $_POST["id_salon"]);
$_SESSION["mensaje"]="El Salon ha sido modificada";
header('Location: ../vista/admin.php');
?>