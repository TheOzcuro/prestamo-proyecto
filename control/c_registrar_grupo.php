<?php
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
$val=$ejecutar->RegistrarGrupo($_POST["codigo_grupo"],$_POST["nombre_grupo"]);
if ($val==1) {
   
    $_SESSION["mensaje"]="El grupo se ha registrado de forma exitosa";
}
else {
    $_SESSION["mensaje"]="El codigo de grupo que ingreso ya existe";
}
if ($_SESSION["usuario"]=="admin") {
    header('Location: ../vista/admin.php');
}
else {
    header('Location: ../vista/almacenista.php');
}

?>