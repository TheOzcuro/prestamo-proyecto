<?php
 session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
echo $val=$ejecutar->UpdateGrupo($_POST["codigo_grupo"],$_POST["nombre_grupo"],$_POST["codigo_original_grupo"]);
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