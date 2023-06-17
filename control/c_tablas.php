<?php 
include_once("../modelo/m_ejecutar.php");
$ejecutar= new registry();
$ejecutar->ComprobarPrestamos();
$val=$ejecutar->GetTableUsuario("usuario");
$equipo=$ejecutar->GetTableEquipo();
$grupo=$ejecutar->GetTable("grupo");
$actividad=$ejecutar->GetActividad();
$clase=$ejecutar->GetTable('clase');
$clasesbien=$ejecutar->GetClasesBien();
$salon=$ejecutar->GetSalon();
$prestamoPendiente=$ejecutar->GetAllPrestamoPendiente();
$prestamoRechazado=$ejecutar->GetAllPrestamoRechazada();
$prestamoAprobado=$ejecutar->GetAllPrestamoAprobada();
$prestamoDevuelto=$ejecutar->GetAllPrestamoDevuelta();
function Verificar($equipo, $clase, $estado)
{
    $ejecutar->VerificarEquipos($equipo, $clase, $estado);
}
function GetAllPrestamoUsuario($cedula)
{
    $ejecutar= new registry();
    return $ejecutar->GetAllUsuarioPrestamo($cedula);
}
function GetAllUsuarioPrestamoPendiente($cedula)
{
    $ejecutar= new registry();
    return $ejecutar->GetAllUsuarioPrestamoPendiente($cedula);
}
function GetAllUsuarioCronograma($fecha, $estado)
{
    $ejecutar= new registry();
    return $ejecutar->GetAllUsuarioCronograma($fecha, $estado);
}
?>