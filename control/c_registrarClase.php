<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->RegistrarClase($_POST["clase_inf"]);
if ($val==1) {
    $_SESSION["mensaje"]="La clase ha sido registrada";
}
else {
    $_SESSION["mensaje"]="Hubo un error intentelo de nuevo";
}
header('Location: ../vista/admin.php');
?>