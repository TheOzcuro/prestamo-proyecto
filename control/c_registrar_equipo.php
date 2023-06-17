<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
echo $val=$ejecutar->RegistrarEquipoInv($_POST["codigo_equipo"],$_POST["codigo_bienes"],$_POST["nombre_equipo"],$_POST["estado"], $_POST["grupo"], $_POST["clase_select"]);
if ($val==1) {
   
    $_SESSION["mensaje"]="El equipo se ha registrado de forma exitosa";
}
else {
    $_SESSION["mensaje"]="El codigo de equipo que ingreso ya existe";
}

if ($_SESSION["usuario"]=="admin") {
    header('Location: ../vista/admin.php');
}
else {
    header('Location: ../vista/almacenista.php');
}
?>