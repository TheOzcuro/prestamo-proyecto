<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$ejecutar->Rechazar($_POST["cedula_pendiente"],$_POST["observacion"],$_SESSION["cedula_revisor"]);
$_SESSION["mensaje"]="Se ha rechazado la solicitud correctamente";
if ($_SESSION["usuario"]=="admin") {
    header('Location: ../vista/admin.php');
}
else {
    header('Location: ../vista/almacenista.php');
}
?>