<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
echo $ejecutar->Devuelto($_POST["cedula_devuelto"],$_POST["observacion"],$_SESSION["cedula_revisor"],$_POST["equipo_devuelto"], $_POST["fecha_devuelto"]);
$_SESSION["mensaje"]="Se ha devuelto el equipo correctamente";
if ($_SESSION["usuario"]=="admin") {
    header('Location: ../vista/admin.php');
}
else {
    header('Location: ../vista/almacenista.php');
}
?>