<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$return=$ejecutar->VerificarFecha($_POST["agrupar_equipo"],$_POST["fecha_de_uso"]);
$fecha=$ejecutar->VerificarFechaEquipo($_POST["cedula_solicitante"],$_POST["fecha_de_uso"]);

if ($return!="") {
    $_SESSION["mensaje"]="Los equipos, ".$return."No estaran disponibles para la fecha de uso";
    if ($_SESSION["usuario"]=="admin") {
        header('Location: ../vista/admin.php');
    }
    else {
        header('Location: ../vista/almacenista.php');
    }
}
else if(count($fecha)!=0) {
    $_SESSION["mensaje"]="Le fecha de uso que escogio el usuario choca con otra fecha de uso del mismo usuario";
    if ($_SESSION["usuario"]=="admin") {
        header('Location: ../vista/admin.php');
    }
    else {
        header('Location: ../vista/almacenista.php');
    }
}
else {
    $ejecutar->Aprobar($_POST["cedula_aprobado"],$_POST["observacion"],$_SESSION["cedula_revisor"],$_POST["agrupar_equipo"]);
    $_SESSION["mensaje"]="Se ha aprobado la solicitud correctamente";
    
    if ($_SESSION["usuario"]=="admin") {
        header('Location: ../vista/admin.php');
    }
    else {
        header('Location: ../vista/almacenista.php');
    }
    
}

?>