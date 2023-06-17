<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->UpdateEquipo($_POST["codigo_equipo"],$_POST["codigo_bienes"],$_POST["nombre_equipo"],$_POST["estado"],$_POST["grupo"],$_POST["clase_select"],$_POST["codigo_original"]);
if ($val==1) {
    $_SESSION["mensaje"]="El Equipo Ha sido Modificado con exito";
}
else {
    $_SESSION["mensaje"]="El equipo que intenta modificar ya existe";
}
if ($_SESSION["usuario"]=="admin") {
    header('Location: ../vista/admin.php');
}
else {
    header('Location: ../vista/almacenista.php');
}
?>