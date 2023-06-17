<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->UpdateUsers($_POST["cedula_usuario"],$_POST["nombre_usuario"],$_POST["apellido_usuario"],$_POST["rol"],$_POST["cedula_original"]);
if ($val==1) {
    $_SESSION["mensaje"]="El Usuario Ha sido Modificado con exito";
}
else {
    $_SESSION["mensaje"]="La cedula que intenta registrar ya existe";
}
header('Location: ../vista/admin.php');
?>