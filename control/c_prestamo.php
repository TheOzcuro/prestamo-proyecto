<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$validar=$ejecutar->VerifyPrestamo($_SESSION["cedula_usuario"]);
if ($validar==1) {
    echo $ejecutar->RegistrarPrestamo($_POST['fecha_hoy'],$_POST['fecha_uso'], $_POST['fecha_devolucion'],$_POST['hora_inicial'],$_POST['hora_final'],$_POST['equipos_texto'],$_POST['equipos_cantidad'],$_POST['actividad_programada'],$_POST['salon_uso'],$_SESSION["cedula_usuario"]);
    header('Location: ../vista/user.php');
    $_SESSION["datos"]=$ejecutar->GetAllPrestamo($_SESSION["cedula_usuario"]);
    $_SESSION["mensaje"]="Se ha creado exitosamente la solicitud de prestamo";
}
else {
    header('Location: ../vista/user.php');
    $_SESSION["mensaje"]="Usted tiene un prestamo activo o posee el maximo de solicitudes de prestamo";
}

?>