<?php 
session_start();
include_once('../modelo/m_ejecutar.php');
$ejecutar= new registry();
if ($_POST["usuario"]=="0000" && $_POST["pass"]=="unearte2022") {
    $_SESSION["cedula_revisor"]=1;
    $_SESSION["nombre"]="Director/a";
    header("Location: ../vista/admin.php");
    $_SESSION["usuario"]="admin";
}
else {
    $array=$ejecutar->GetUser($_POST["usuario"]);
    if (count($array)==0) {
        $_SESSION["mensaje"]="El usuario no existe";
        header("Location: ../vista/login.php");
    }
    else if ($array[0][0]=="" && $array[0][3]==$_POST["usuario"]) {
        $_SESSION["cedula"]=$_POST["usuario"];
        header("Location: ../vista/create_pass.php");
    }
    else if ($array[0][0]==$_POST["pass"]) {
        if ($array[0][2]==0) {
            $_SESSION["mensaje"]="Su usuario ha sido desactivado por el momento, comuniquese con el director para volver a activarla";
            header("Location: ../vista/login.php");
        }
        else if($array[0][1]=="usuario") {
            $_SESSION["usuario"]="usuario";
            $_SESSION["nombre"]=$ejecutar->GetName($_POST["usuario"]);
            $_SESSION["datos"]=$ejecutar->GetAllPrestamo($_POST["usuario"]);
            $_SESSION["actividad"]=$ejecutar->GetActividad();
            $_SESSION["salon"]=$ejecutar->GetSalon();
            $_SESSION["cedula_usuario"]=$_POST["usuario"];
            header("Location: ../vista/user.php");
        }
        else if($array[0][1]=="almacenista") {
            $_SESSION["nombre"]=$ejecutar->GetName($_POST["usuario"]);
            $_SESSION["cedula_revisor"]=$_POST["usuario"];
            $_SESSION["usuario"]="almacenista";
            header("Location: ../vista/almacenista.php");
        }
        else if($array[0][1]=="administrador") {
            $_SESSION["nombre"]=$ejecutar->GetName($_POST["usuario"]);
            $_SESSION["cedula_revisor"]=$_POST["usuario"];
            $_SESSION["usuario"]="admin";
            header("Location: ../vista/admin.php");
        }
    }
    else {
        $_SESSION["mensaje"]="La contraseña es incorrecta";
        header("Location: ../vista/login.php");
    }
}
?>