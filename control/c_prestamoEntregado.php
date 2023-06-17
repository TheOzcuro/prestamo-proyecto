<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
echo $count=$ejecutar->VerificarPrestamo($_POST["cedula_entregado_solicitante"]);

if($count>0) {
    $_SESSION["mensaje"]="El usuario tiene actualmente un prestamo, no se le pueden aprobar mas solicitudes hasta que devuelva el equipo";
    if ($_SESSION["usuario"]=="admin") {
        header('Location: ../vista/admin.php');
    }
    else {
        header('Location: ../vista/almacenista.php');
    }
}
else {
    echo $ejecutar->Entregar($_POST["cedula_entregado"], $_POST["fecha_entregado"], $_POST["observacion"]);
    $_SESSION["mensaje"]="Se ha entregado el equipo correctamente";
    if ($_SESSION["usuario"]=="admin") {
        header('Location: ../vista/admin.php');
    }
    else {
        header('Location: ../vista/almacenista.php');
    }
}

?>