<!DOCTYPE html>
<html lang="en">
<?php
include_once("../control/c_tablas.php");
session_start();
if ($_SESSION["usuario"]!="almacenista") {
    header('Location: login.php');
}
if(isset($_SESSION["mensaje"])) {
    echo "<script>alert('".$_SESSION["mensaje"]."')</script>";
    unset($_SESSION["mensaje"]);
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacenista</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/tabla.css">
</head>
<body>
<nav>
        <img src="../css/menu.png" alt="Menu" onclick='Menu()'>
        <h1>Hola, Bievenido <?php echo $_SESSION["nombre"][0][0]." ".$_SESSION["nombre"][0][1] ?></h1>
    </nav>
    <div class='blackcover'></div>



    <div class='mensaje_rechazar'>
    <h3 style='text-align:center;'>¿Esta seguro/a que desea rechazar esta solicitud?</h3><br>
    <label for="observacion" style='font-size:18px;'>Escriba una Observacion con respecto a esta solicitud si es necesario:</label><br>

    <form action="../control/c_prestamoPendiente.php" method="post" id='form_pendiente' name='form_pendiente'>
        <input type="text" id='cedula_pendiente' name='cedula_pendiente' hidden>
        <input type="text" placeholder='Observacion' maxlength='70' id='observacion' name='observacion'>
    </form><br><br>

    <button class='button' type='button' onclick='Rechazar()'>Si</button>
    <button class='button' type='button' style='float:right;' onclick='VentanaRechazarCerrar(".mensaje_rechazar")'>No</button></div>


    <div class='mensaje_devolver'>
    <h3 style='text-align:center;'>¿Desea devolver el equipo?</h3><br>
    <label for="observacion" style='font-size:18px;'>Escriba una Observacion con respecto a esta solicitud si es necesario:</label><br>
    <form action="../control/c_prestamoDevuelto.php" method="post" id='form_devuelto' name='form_devuelto'>
        <input type="text" id='fecha_de_uso' name='fecha_de_uso' hidden>
        <input type="text" id='fecha_devuelto' name='fecha_devuelto' hidden>
        <input type="text" id='equipo_devuelto' name='equipo_devuelto' hidden>
        <input type="text" id='cedula_devuelto' name='cedula_devuelto' hidden>
        <input type="text" placeholder='Observacion' maxlength='70' id='observacion' name='observacion'>
    </form><br><br>

    <button class='button' type='button' onclick='Devolver()'>Si</button>
    <button class='button' type='button' style='float:right;' onclick='VentanaRechazarCerrar(".mensaje_devolver")'>No</button></div>


    <div class='mensaje_entregado'>
    <h3 style='text-align:center;'>¿Desea entregar el equipo?</h3><br>
    <label for="observacion" style='font-size:18px;'>Escriba una Observacion con respecto a esta solicitud si es necesario:</label><br>
    <form action="../control/c_prestamoEntregado.php" method="post" id='form_entregado' name='form_entregado'>
        <input type="text" id='fecha_entregado' name='fecha_entregado' hidden>
        <input type="text" id='cedula_entregado' name='cedula_entregado' hidden>
        <input type="text" placeholder='Observacion' maxlength='70' id='observacion' name='observacion'>
    </form><br><br>

    <button class='button' type='button' onclick='Entregar()'>Si</button>
    <button class='button' type='button' style='float:right;' onclick='VentanaRechazarCerrar(".mensaje_entregado")'>No</button></div>



    <div class='submenu'>
        <nav>
        <div id='boton_grupo'>Grupos</div>
        <div id='boton_equipo'>Objetos Individuales</div>
        <div id='solicitudes_prestamo'>Solicitudes de Prestamos</div>
        <div id='prestamo_activo'>Prestamos Activos</div>
        <div id='prestamo_devuelto'>Prestamos Devueltos</div>
        <div id='solicitudes_rechazadas'>Solicitudes Rechazadas</div>
        <a href="logout.php"><div>Cerrar Session</div></a>
        </nav>
    </div>
    <form action="../control/c_registrar_equipo.php" name="registrar_equipo" id="registrar_equipo" method='POST'>
        <div id='registrar_equipos_container' class='container'>
            <div class='input_container'>
                <label for="codigo_equipo">Codigo de Equipo</label><br>
                <input type="text" id='codigo_equipo' name='codigo_equipo' class='registrar_input' maxlength='20'>
                <input type="checkbox" class='checkbox' onclick='Check(0,this,"codigo_equipo")'>
            </div><br>
            <div class='input_container'>
                <label for="codigo_bienes">Codigo Bienes Nacionales</label><br>
                <input type="text" id='codigo_bienes' name='codigo_bienes' class='registrar_input' maxlength='20'>
                <input type="checkbox" class='checkbox' onclick='Check(1,this,"codigo_bienes")'>
            </div><br>
            <div class='input_container'>
                <label for="nombre_equipo">Nombre del Equipo</label><br>
                <input type="text" id='nombre_equipo' name='nombre_equipo' class='registrar_input' maxlength='40'>
                <input type="checkbox" class='checkbox' onclick='Check(2,this,"nombre_equipo")'>
            </div><br>
            <div class='input_container'>
                <label for="estado">Estado</label><br>
                <select name="estado" id="estado" class='registrar_input'>
                    <option value="">Seleccione</option>
                    <option value="bien">Bien</option>
                    <option value="danano">Dañado</option>
                    <option value="perdido">Perdido</option>
                    <option value="obsoleto">Obsoleto</option>
                </select>
                <input type="checkbox" class='checkbox' onclick='Check(3,this,"estado")'>
            </div><br>
            <div class='input_container'>
                <label for="grupo">Grupo</label><br>
                <select name="grupo" id="grupo" class='registrar_input'>
                    <option value="">Seleccione</option>
                    <option value="ninguno">Ninguno</option>
                    <?php 
                    $fila=count($grupo);
                    $contador=0;
                    while ($fila>$contador){
                        echo "<option value='".$grupo[$contador][0]."'>".$grupo[$contador][1]."</option>";
                        $contador=$contador+1;
                    }
                    ?>
                </select>
                <input type="checkbox" class='checkbox' onclick='Check(4,this,"grupo")'>
            </div><br>
            
            <div class='button_container'>
                <button type='button' style='' onclick='RegistrarEquipo()' id='boton-registrar'>Registrar</button>
                <button type='button' style='left: 50px;' class='cerrar_equipo'>Cerrar</button>
            </div>
            <input type="text" id='codigo_original' name='codigo_original' style='position:absolute;' class='registrar_input' hidden>
        </div>
    </form>
    <div class='tabla_equipo container_tabla' style='display: none;'>
    <a href="objetosPDF.php" class='pdf' style='position:absolute;height:30px;text-align:center;padding-top:7px;left:900px;bottom:5px;'>Descargar PDF</a>
        <div class='tabla' style='grid-template-columns: 150px 150px 200px 150px 150px 150px'>
            <div class='titulo' maxlength='40'>Codigo Equipos</div>
            <div class='titulo' maxlength='50'>Codigo Bienes</div>
            <div class='titulo' maxlength='50'>Nombre Equipo</div>
            <div class='titulo' maxlength='70'>Estado</div>
            <div class='titulo' maxlength='70'>Grupo</div>
            <div></div>
            <?php
            $fila=count($equipo);
            $filagrupo=count($grupo);
            $contador=0;
            while ($fila>$contador){
                $valorgrupo="Ninguno";
                $contadorgrupo=0;
                while ($filagrupo>$contadorgrupo) {
                    if ($grupo[$contadorgrupo][0]==$equipo[$contador][4]) {
                        $valorgrupo=$grupo[$contadorgrupo][1];
                    }
                    $contadorgrupo=$contadorgrupo+1;
                }
                for ($i=0; $i < 5; $i++) { 
                    if ($i==4) {
                        echo "<div class='contenido'>".$valorgrupo."</div>";
                    }
                    else {
                        echo "<div class='contenido'>".$equipo[$contador][$i]."</div>";
                    }
                    
                }
                print_r("<button type='button' class='botones-tabla' onclick='UpdateEquipos(`".$equipo[$contador][0]."`,`".$equipo[$contador][1]."`,`".$equipo[$contador][2]."`,`".$equipo[$contador][3]."`,`".$equipo[$contador][4]."`)'>Modificar</button>");
                $contador=$contador+1;
            }
            
            ?>
        </div>
        <button type='button' class='agregar_equipo'>Agregar Registro</button>
    </div>
    <form action="../control/c_registrar_grupo.php" name="registrar_grupo" id="registrar_grupo" method='POST'>
        <div id='registrar_grupo_container' class='container' style='top:10%;'>
            <div class='input_container'>
                <label for="codigo_grupo">Codigo de Grupo</label><br>
                <input type="text" id='codigo_grupo' name='codigo_grupo' class='registrar_input' maxlength='20'>
                <input type="checkbox" class='checkbox' onclick='Check(0,this,"codigo_grupo")'>
            </div><br>
            <div class='input_container'>
                <label for="nombre_grupo">Nombre de Grupo</label><br>
                <input type="text" id='nombre_grupo' name='nombre_grupo' class='registrar_input' maxlength='20'>
                <input type="checkbox" class='checkbox' onclick='Check(1,this,"nombre_grupo")'>
            </div><br>
            <div class='button_container'>
                <button type='button' style='' onclick='RegistrarGrupo()' id='boton-registrar'>Registrar</button>
                <button type='button' style='left: 50px;' class='cerrar_grupo'>Cerrar</button>
            </div>
            <input type="text" id='codigo_original_grupo' name='codigo_original_grupo' style='position:absolute;' class='registrar_input' hidden>
        </div>
    </form>
    <div class='tabla_grupo container_tabla' style='display: none;'>
    <a href="grupoPDF.php" class='pdf' style='position:absolute;height:30px;text-align:center;padding-top:7px;left:850px;bottom:5px;'>Descargar PDF</a>
        <div class='tabla' style='grid-template-columns: 150px 300px 300px 150px'>
            <div class='titulo' maxlength='40'>Codigo Grupo</div>
            <div class='titulo' maxlength='50'>Codigo Nombre</div>
            <div class='titulo' maxlength='50'>Objetos del grupo </div>
            <div></div>
            <?php
            $fila=count($grupo);
            $filaequipo=count($equipo);
            $contador=0;
            while ($fila>$contador){
                $contadorequipo=0;
                for ($i=0; $i < 2; $i++) { 
                    echo "<div class='contenido'>".$grupo[$contador][$i]."</div>";
                }
                echo "<div class='contenido'>";
                while ($filaequipo>$contadorequipo) {
                    if ($grupo[$contador][0]==$equipo[$contadorequipo][4]) {
                        echo $grupo[$contadorequipo][0]."<->".$grupo[$contadorequipo][1]."<br>";
                    }
                    $contadorequipo=$contadorequipo+1;
                }
                echo "</div>";
                print_r("<button type='button' class='botones-tabla' onclick='UpdateGrupo(`".$grupo[$contador][0]."`,`".$grupo[$contador][1]."`)'>Modificar</button>");
                $contador=$contador+1;
            }
            
            ?>
        </div>
        <button type='button' class='agregar_grupo'>Agregar Registro</button>
    </div>
    <div class='tabla_prestamo container_tabla' style='display: none;' id='tabla_pendiente'>
    <a class='pdf' style='position:absolute;height:30px;text-align:center;padding-top:7px;' onclick='PDFUsuarioFecha("fecha_pendiente")'>Descargar PDF</a>
    <form action="pendientePDF.php" method="post" id='fecha_pendiente' name='fecha_pendiente'>
    <select name="meses_pendientes" id="meses_pendientes" style='position:absolute;left:30%;top:40px;' title='Seleccione el mes que quiere el PDF'>
        <option value="">Todos</option>
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
    </form>
    <h2 style='text-align:center;font-size:32px;'>Solicitudes Pendientes</h2>
        <div class='tabla'>
            <div class='titulo' maxlength='70'>Equipo Entregado</div>
            <div class='titulo' maxlength='40'>Fecha de Creacion</div>
            <div class='titulo' maxlength='50'>Fecha de Entrega</div>
            <div class='titulo' maxlength='50'>Fecha de Devolucion</div>
            <div class='titulo' maxlength='70'>Equipo Solicitado</div>
            <div class='titulo' maxlength='40'>Estado</div>
            <div class='titulo' maxlength='50'>Solicitante</div>
            <div></div>

            <?php
            $fila=count($prestamoPendiente);
            $contador=0;
            while ($fila>$contador){
                for ($i=0; $i < 14; $i++) {
                    if ($i==5 || $i==6 || $i==4 || $i==8) {
        
                    }
                    else if ($i==7) {
                        $clase_fila=count($clase);
                        $clase_contador=0;
                        $equipo_inv=explode(",",$prestamoPendiente[$contador][$i]);
                        $count=count($equipo_inv);
                        $agrupar_equipo="";
                        $cantidad=explode(",",$prestamoPendiente[$contador][8]);
                        $total_equipo="";
                        $n=0;
                        echo "<div class='contenido'>";
                        while($count>$n) {
                            $clase_contador=0;
                            while ($clase_fila>$clase_contador && $count>$n) {
                            if ($clase[$clase_contador][0]==$equipo_inv[$n] 
                            || $clase[$clase_contador][1]==$equipo_inv[$n]) {
                                if ($count==1) {
                                    $agrupar_equipo=$clase[$clase_contador][1];
                                    $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1];
                                }
                                else {
                                    $agrupar_equipo=$clase[$clase_contador][1].",".$agrupar_equipo;
                                    $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1].", ".$total_equipo;
                                    
                                }
                            }
                            $clase_contador=$clase_contador+1;                         
                            }
                            $n=$n+1;
                        }
                        echo $agrupar_equipo;
                        $prestamoPendiente[$contador][$i]=$agrupar_equipo;
                        echo "</div>";
                    }
                    else if($i>8 && $i<12){
                        if ($i==9) {
                            $actividad_fila=count($actividad);
                            $actividad_contador=0;
                            while  ($actividad_fila>$actividad_contador){
                                if ($prestamoPendiente[$contador][$i]==$actividad[$actividad_contador][0]) {
                                    $prestamoPendiente[$contador][$i]=$actividad[$actividad_contador][1];
                                }
                                $actividad_contador=$actividad_contador+1;
                            }
                        }
                        else if ($i==10) {
                            $salon_fila=count($salon);
                            $salon_contador=0;
                            while  ($salon_fila>$salon_contador){
                                if ($prestamoPendiente[$contador][$i]==$salon[$salon_contador][0]) {
                                    $prestamoPendiente[$contador][$i]=$salon[$salon_contador][1];
                                }
                                $salon_contador=$salon_contador+1;
                            }
                        }
                    } 
                    else if ($i==12) {
                        echo "<div class='contenido'>Pendiente</div>";
                    }
                    else if($i==13) {
                        for ($x=0; $x < count($val); $x++) {
                            if ($val[$x][0]==$prestamoPendiente[$contador][$i]) {
                                $y=$x;
                                echo "<div class='contenido'>".$val[$x][0]."<br>".$val[$x][1]."<br>".$val[$x][2]."</div>";
                            }
                        }
                        
                    }
                    else {
                        echo "<div class='contenido'>".$prestamoPendiente[$contador][$i]."</div>";
                    }
                   
                }
                print_r("<button type='button' class='botones-tabla' onclick='Vermas(`".$prestamoPendiente[$contador][0]."`,`".$prestamoPendiente[$contador][1]."`,`".$prestamoPendiente[$contador][2]."`,`".$prestamoPendiente[$contador][3]."`,`".$prestamoPendiente[$contador][4]."`,`".$prestamoPendiente[$contador][5]."`,`".$prestamoPendiente[$contador][6]."`,`".$total_equipo."`,`".$prestamoPendiente[$contador][9]."`,`".$prestamoPendiente[$contador][10]."`,`".$prestamoPendiente[$contador][11]."`,`".$prestamoPendiente[$contador][12]."`,`".$prestamoPendiente[$contador][13]."`,`".$val[$y][1]."`,`".$val[$y][2]."`,`".$prestamoPendiente[$contador][14]."`,`".$prestamoPendiente[$contador][15]."`)'>Ver Mas</button>");             
                $contador=$contador+1;
            }
            ?>
        </div>
    </div>
    
    






    <div class='tabla_prestamo container_tabla' style='display: none;' id='tabla_rechazado'>
    <h2 style='text-align:center;font-size:32px;'>Solicitudes Rechazadas</h2>
    <a class='pdf' style='position:absolute;height:30px;text-align:center;padding-top:7px;' onclick='PDFUsuarioFecha("fecha_rechazado")'>Descargar PDF</a>
    <form action="rechazadoPDF.php" method="post" id='fecha_rechazado' name='fecha_rechazado'>
    <select name="meses_pendientes" id="meses_pendientes" style='position:absolute;left:30%;top:40px;' title='Seleccione el mes que quiere el PDF'>
        <option value="">Todos</option>
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
    </form>
        <div class='tabla'>
            <div class='titulo' maxlength='70'>Equipo Entregado</div>
            <div class='titulo' maxlength='40'>Fecha de Creacion</div>
            <div class='titulo' maxlength='50'>Fecha de Entrega</div>
            <div class='titulo' maxlength='50'>Fecha de Devolucion</div>
            <div class='titulo' maxlength='70'>Equipo Solicitado</div>
            <div class='titulo' maxlength='40'>Estado</div>
            <div class='titulo' maxlength='50'>Solicitante</div>
            <div></div>

            <?php
            $fila=count($prestamoRechazado);
            $contador=0;
            while ($fila>$contador){
                for ($i=0; $i < 14; $i++) {
                    if ($i==5 || $i==6 || $i==4 || $i==8) {
                        
                    }
                    else if ($i==7) {
                        $clase_fila=count($clase);
                        $clase_contador=0;
                        while ($clase_fila>$clase_contador) {
                           if ($clase[$clase_contador][0]==$prestamoRechazado[$contador][$i] 
                           || $clase[$clase_contador][1]==$prestamoRechazado[$contador][$i]) {
                             $prestamoRechazado[$contador][$i]=$clase[$clase_contador][1];
                             echo "<div class='contenido'>".$prestamoRechazado[$contador][$i]."</div>";
                           }
                           $clase_contador=$clase_contador+1;                         
                        }
                    }
                    else if($i>8 && $i<12){
                        if ($i==9) {
                            $actividad_fila=count($actividad);
                            $actividad_contador=0;
                            while  ($actividad_fila>$actividad_contador){
                                if ($prestamoRechazado[$contador][$i]==$actividad[$actividad_contador][0]) {
                                    $prestamoRechazado[$contador][$i]=$actividad[$actividad_contador][1];
                                }
                                $actividad_contador=$actividad_contador+1;
                            }
                        }
                        else if ($i==10) {
                            $salon_fila=count($salon);
                            $salon_contador=0;
                            while  ($salon_fila>$salon_contador){
                                if ($prestamoRechazado[$contador][$i]==$salon[$salon_contador][0]) {
                                    $prestamoRechazado[$contador][$i]=$salon[$salon_contador][1];
                                }
                                $salon_contador=$salon_contador+1;
                            }
                        }
                    } 
                    else if ($i==12) {
                        echo "<div class='contenido'>Rechazado</div>";
                    }
                    else if($i==13) {
                        for ($x=0; $x < count($val); $x++) {
                            if ($val[$x][0]==$prestamoRechazado[$contador][$i]) {
                                $y=$x;
                                echo "<div class='contenido'>".$val[$x][0]."<br>".$val[$x][1]."<br>".$val[$x][2]."</div>";
                            }
                            if ($val[$x][0]==$prestamoRechazado[$contador][14]) {
                                $prestamoRechazado[$contador][14]=$val[$x][0]."<br>".$val[$x][1]." ".$val[$x][2];
                            }
                        }
                        
                    }
                    else {
                        echo "<div class='contenido'>".$prestamoRechazado[$contador][$i]."</div>";
                    }
                   
                }
                print_r("<button type='button' class='botones-tabla' onclick='Vermas(`".$prestamoRechazado[$contador][0]."`,`".$prestamoRechazado[$contador][1]."`,`".$prestamoRechazado[$contador][2]."`,`".$prestamoRechazado[$contador][3]."`,`".$prestamoRechazado[$contador][4]."`,`".$prestamoRechazado[$contador][5]."`,`".$prestamoRechazado[$contador][6]."`,`".$prestamoRechazado[$contador][7]."`,`".$prestamoRechazado[$contador][8]."`,`".$prestamoRechazado[$contador][9]."`,`".$prestamoRechazado[$contador][10]."`,`".$prestamoRechazado[$contador][11]."`,`".$prestamoRechazado[$contador][12]."`,`".$prestamoRechazado[$contador][13]."`,`".$val[$y][1]."`,`".$val[$y][2]."`,`".$prestamoRechazado[$contador][14]."`)'>Ver Mas</button>");             
                $contador=$contador+1;
            }
            ?>
        </div>
    </div>














    <div class='tabla_prestamo container_tabla' style='display: none;' id='tabla_aprobado'>
    <h2 style='text-align:center;font-size:32px;'>Solicitudes Aprobadas</h2>
    <a class='pdf' style='position:absolute;height:30px;text-align:center;padding-top:7px;' onclick='PDFUsuarioFecha("fecha_aprobado")'>Descargar PDF</a>
    <form action="aprobadoPDF.php" method="post" id='fecha_aprobado' name='fecha_aprobado'>
    <select name="meses_pendientes" id="meses_pendientes" style='position:absolute;left:30%;top:40px;' title='Seleccione el mes que quiere el PDF'>
        <option value="">Todos</option>
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
    </form>
    <b style='font-size:12px;text-align:center;position:absolute;top:43px;left:530px;'>Nota: Puede ver el nombre de los equipos al dejar el mouse o cursor encima de los codigos de equipo</b>
        <div class='tabla'>
            <div class='titulo' maxlength='70'>Equipo Entregado</div>
            <div class='titulo' maxlength='40'>Fecha de Creacion</div>
            <div class='titulo' maxlength='50'>Fecha de Entrega</div>
            <div class='titulo' maxlength='50'>Fecha de Devolucion</div>
            <div class='titulo' maxlength='70'>Equipo Solicitado</div>
            <div class='titulo' maxlength='40'>Estado</div>
            <div class='titulo' maxlength='50'>Solicitante</div>
            <div></div>

            <?php
            $fila=count($prestamoAprobado);
            $contador=0;
            while ($fila>$contador){
                for ($i=0; $i < 14; $i++) {
                    if($i==0) {
                        $equipo_dato="";
                        $equipo_codigo="";
                        $agrupar_equipo=explode(",",$prestamoAprobado[$contador][0]);
                        echo "<div class='contenido'>";
                        for ($y=0; $y <count($agrupar_equipo) ; $y++) { 
                            for ($x=0; $x < count($equipo); $x++) {
                                if ($equipo[$x][0]==$agrupar_equipo[$y]) {
                                    echo "<p title='".$equipo[$x][2]."' style='display:inline;cursor:context-menu;'>".$equipo[$x][0]."</p><br>";
                                    $equipo_dato=$equipo[$x][0].".".$equipo[$x][2].",".$equipo_dato;
                                    $equipo_codigo=$equipo[$x][0].",".$equipo_codigo;
                                }
                            }
                        }
                        echo "</div>";
                        
                    }
                    else if ($i==5 || $i==6 || $i==4 || $i==8) {
        
                    }
                    else if ($i==7) {
                        $clase_fila=count($clase);
                        $clase_contador=0;
                        $equipo_inv=explode(",",$prestamoAprobado[$contador][$i]);
                        $count=count($equipo_inv);
                        $agrupar_equipo="";
                        $cantidad=explode(",",$prestamoAprobado[$contador][8]);
                        $total_equipo="";
                        $n=0;
                        echo "<div class='contenido'>";
                        while($count>$n) {
                            $clase_contador=0;
                            while ($clase_fila>$clase_contador && $count>$n) {
                            if ($clase[$clase_contador][0]==$equipo_inv[$n] 
                            || $clase[$clase_contador][1]==$equipo_inv[$n]) {
                                if ($count==1) {
                                    $agrupar_equipo=$clase[$clase_contador][1];
                                    $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1];
                                }
                                else {
                                    $agrupar_equipo=$clase[$clase_contador][1].",".$agrupar_equipo;
                                    $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1].", ".$total_equipo;
                                    
                                }
                            }
                            $clase_contador=$clase_contador+1;                         
                            }
                            $n=$n+1;
                        }
                        echo $agrupar_equipo;
                        $prestamoAprobado[$contador][$i]=$agrupar_equipo;
                        echo "</div>";
                    }
                    else if($i>8 && $i<12){
                        if ($i==9) {
                            $actividad_fila=count($actividad);
                            $actividad_contador=0;
                            while  ($actividad_fila>$actividad_contador){
                                if ($prestamoAprobado[$contador][$i]==$actividad[$actividad_contador][0]) {
                                    $prestamoAprobado[$contador][$i]=$actividad[$actividad_contador][1];
                                }
                                $actividad_contador=$actividad_contador+1;
                            }
                        }
                        else if ($i==10) {
                            $salon_fila=count($salon);
                            $salon_contador=0;
                            while  ($salon_fila>$salon_contador){
                                if ($prestamoAprobado[$contador][$i]==$salon[$salon_contador][0]) {
                                    $prestamoAprobado[$contador][$i]=$salon[$salon_contador][1];
                                }
                                $salon_contador=$salon_contador+1;
                            }
                        }

                    } 
                    else if ($i==12 && $prestamoAprobado[$contador][2]!="") {
                        echo "<div class='contenido'>En Prestamo</div>";
                    }
                    else if ($i==12 && $prestamoAprobado[$contador][2]=="") {
                        echo "<div class='contenido'>Aprobado (En espera de entrega)</div>";
                    }
                    else if($i==13) {
                        for ($x=0; $x < count($val); $x++) {
                            if ($val[$x][0]==$prestamoAprobado[$contador][$i]) {
                                $y=$x;
                                echo "<div class='contenido'>".$val[$x][0]."<br>".$val[$x][1]."<br>".$val[$x][2]."</div>";
                            }
                            else if ($val[$x][0]==$prestamoAprobado[$contador][14]) {
                                $prestamoAprobado[$contador][14]=$val[$x][0]."<br>".$val[$x][1]." ".$val[$x][2];
                            }
                        }
                        
                    }
                    else {
                        echo "<div class='contenido'>".$prestamoAprobado[$contador][$i]."</div>";
                    }
                   
                }
                print_r("<button type='button' class='botones-tabla' onclick='Vermas(`".$equipo_dato."`,`".$prestamoAprobado[$contador][1]."`,`".$prestamoAprobado[$contador][2]."`,`".$prestamoAprobado[$contador][3]."`,`".$prestamoAprobado[$contador][4]."`,`".$prestamoAprobado[$contador][5]."`,`".$prestamoAprobado[$contador][6]."`,`".$total_equipo."`,`".$prestamoAprobado[$contador][9]."`,`".$prestamoAprobado[$contador][10]."`,`".$prestamoAprobado[$contador][11]."`,`".$prestamoAprobado[$contador][12]."`,`".$prestamoAprobado[$contador][13]."`,`".$val[$y][1]."`,`".$val[$y][2]."`,`".$prestamoAprobado[$contador][14]."`,`".$prestamoAprobado[$contador][15]."`,`".$equipo_codigo."`)'>Ver Mas</button>");             
                $contador=$contador+1;
            }
            ?>
        </div>
    </div>

















    <div class='tabla_prestamo container_tabla' style='display: none;' id='tabla_devuelto'>
    <h2 style='text-align:center;font-size:32px;'>Solicitudes Devueltas</h2>
    <a class='pdf' style='position:absolute;height:30px;text-align:center;padding-top:7px;' onclick='PDFUsuarioFecha("fecha_devuelta")'>Descargar PDF</a>
    <form action="devueltoPDF.php" method="post" id='fecha_devuelta' name='fecha_devuelta'>
    <select name="meses_pendientes" id="meses_pendientes" style='position:absolute;left:30%;top:40px;' title='Seleccione el mes que quiere el PDF'>
        <option value="">Todos</option>
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
    </form>
    <b style='font-size:12px;text-align:center;position:absolute;top:43px;left:530px;'>Nota: Puede ver el nombre de los equipos al dejar el mouse o cursor encima de los codigos de equipo</b>
        <div class='tabla'>
            <div class='titulo' maxlength='70'>Equipo Entregado</div>
            <div class='titulo' maxlength='40'>Fecha de Creacion</div>
            <div class='titulo' maxlength='50'>Fecha de Entrega</div>
            <div class='titulo' maxlength='50'>Fecha de Devolucion</div>
            <div class='titulo' maxlength='70'>Equipo Solicitado</div>
            <div class='titulo' maxlength='40'>Estado</div>
            <div class='titulo' maxlength='50'>Solicitante</div>
            <div></div>

            <?php
            $fila=count($prestamoDevuelto);
            $contador=0;
            while ($fila>$contador){
                for ($i=0; $i < 14; $i++) {
                    if($i==0) {
                        $equipo_dato="";
                        $equipo_codigo="";
                        $agrupar_equipo=explode(",",$prestamoDevuelto[$contador][0]);
                        echo "<div class='contenido'>";
                        for ($y=0; $y <count($agrupar_equipo) ; $y++) { 
                            for ($x=0; $x < count($equipo); $x++) {
                                if ($equipo[$x][0]==$agrupar_equipo[$y]) {
                                    echo "<p title='".$equipo[$x][2]."' style='display:inline;cursor:context-menu;'>".$equipo[$x][0]."</p><br>";
                                    $equipo_dato=$equipo[$x][0].".".$equipo[$x][2].",".$equipo_dato;
                                    $equipo_codigo=$equipo[$x][0].",".$equipo_codigo;
                                }
                            }
                        }
                        echo "</div>";
                        
                    }
                    else if ($i==5 || $i==6 || $i==4 || $i==8) {
                        
                    }
                    else if ($i==7) {
                        $clase_fila=count($clase);
                        $clase_contador=0;
                        $equipo_inv=explode(",",$prestamoDevuelto[$contador][$i]);
                        $count=count($equipo_inv);
                        $agrupar_equipo="";
                        $cantidad=explode(",",$prestamoDevuelto[$contador][8]);
                        $total_equipo="";
                        $n=0;
                        echo "<div class='contenido'>";
                        while($count>$n) {
                            $clase_contador=0;
                            while ($clase_fila>$clase_contador && $count>$n) {
                            if ($clase[$clase_contador][0]==$equipo_inv[$n] 
                            || $clase[$clase_contador][1]==$equipo_inv[$n]) {
                                if ($count==1) {
                                    $agrupar_equipo=$clase[$clase_contador][1];
                                    $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1];
                                }
                                else {
                                    $agrupar_equipo=$clase[$clase_contador][1].",".$agrupar_equipo;
                                    $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1].", ".$total_equipo;
                                    
                                }
                            }
                            $clase_contador=$clase_contador+1;                         
                            }
                            $n=$n+1;
                        }
                        echo $agrupar_equipo;
                        $prestamoDevuelto[$contador][$i]=$agrupar_equipo;
                        echo "</div>";
                    }
                    else if($i>8 && $i<12){
                        if ($i==9) {
                            $actividad_fila=count($actividad);
                            $actividad_contador=0;
                            while  ($actividad_fila>$actividad_contador){
                                if ($prestamoDevuelto[$contador][$i]==$actividad[$actividad_contador][0]) {
                                    $prestamoDevuelto[$contador][$i]=$actividad[$actividad_contador][1];
                                }
                                $actividad_contador=$actividad_contador+1;
                            }
                        }
                        else if ($i==10) {
                            $salon_fila=count($salon);
                            $salon_contador=0;
                            while  ($salon_fila>$salon_contador){
                                if ($prestamoDevuelto[$contador][$i]==$salon[$salon_contador][0]) {
                                    $prestamoDevuelto[$contador][$i]=$salon[$salon_contador][1];
                                }
                                $salon_contador=$salon_contador+1;
                            }
                        }
                    } 
                    else if ($i==12) {
                        echo "<div class='contenido'>Devuelto</div>";
                    }
                    else if($i==13) {
                        for ($x=0; $x < count($val); $x++) {
                            
                            if ($val[$x][0]==$prestamoDevuelto[$contador][$i]) {
                                $y=$x;
                                echo "<div class='contenido'>".$val[$x][0]."<br>".$val[$x][1]."<br>".$val[$x][2]."</div>";
                            }
                            else if ($val[$x][0]==$prestamoDevuelto[$contador][14]) {
                                $prestamoDevuelto[$contador][14]=$val[$x][0]."<br>".$val[$x][1]." ".$val[$x][2];
                            }
                        }
                        
                    }
                    else {
                        echo "<div class='contenido'>".$prestamoDevuelto[$contador][$i]."</div>";
                    }
                   
                }
                print_r("<button type='button' class='botones-tabla' onclick='Vermas(`".$equipo_dato."`,`".$prestamoDevuelto[$contador][1]."`,`".$prestamoDevuelto[$contador][2]."`,`".$prestamoDevuelto[$contador][3]."`,`".$prestamoDevuelto[$contador][4]."`,`".$prestamoDevuelto[$contador][5]."`,`".$prestamoDevuelto[$contador][6]."`,`".$total_equipo."`,`".$prestamoDevuelto[$contador][9]."`,`".$prestamoDevuelto[$contador][10]."`,`".$prestamoDevuelto[$contador][11]."`,`".$prestamoDevuelto[$contador][12]."`,`".$prestamoDevuelto[$contador][13]."`,`".$val[$y][1]."`,`".$val[$y][2]."`,`".$prestamoDevuelto[$contador][14]."`,`".$prestamoDevuelto[$contador][15]."`,`".$equipo_codigo."`)'>Ver Mas</button>");             
                $contador=$contador+1;
            }
            ?>
        </div>
    </div>
    <div class='asigar_equipo' style='top:100px;transform: translate(-50%,0%);width:700px;'>
        <form action="../control/c_prestamoAprobado.php" method="post" name='form_aprobado' id='form_aprobado'>
        <input type="text" id='cedula_aprobado' name='cedula_aprobado' hidden>
        <input type="text" id='fecha_aprobado' name='fecha_aprobado' hidden>
        <h2 style='text-align:center'>Añadir Equipo</h2>
        <label for="" style='font-size:20px;'>Equipos:</label><br>
        <b style='font-size:10px;'>Nota: Si no puede seleccionar nada es que no hay equipos disponibles</b><br>
        <select name="equipo_prestamo" id="equipo_prestamo" style='width:73%;'>
            <option value="">Seleccione Equipo</option>
            <?php 
            $prestamo_equipo=count($equipo);
            $contador=0;
            $indice=1;
            while  ($prestamo_equipo>$contador){
                echo "<option value='".$equipo[$contador][0]."' id='".$indice."'>Codigo: ".$equipo[$contador][0]."-Nombre:".$equipo[$contador][2]."</option>";
                $contador=$contador+1;
                $indice=$indice+1;
            }
            ?>
        </select>
        <button class='añadir_equipo' onclick='AñadirEquipo()' type='button'>Añadir Equipo</button><br><br><br>
        <label for="" style='font-size:20px;'>Equipos Añadidos:</label><br>
        <b style='font-size:12px;'>Nota: Para eliminar los equipos añadidos haga click encima de ellos</b><br>
        <div class='container_equipos_añadidos' style='display:flex;flex-direction:row;'></div><br><br><br>
        <label for="observacion" style='font-size:18px;'>Escriba una Observacion con respecto a esta solicitud si es necesario:</label><br>
        <input type="text" placeholder='Observacion' maxlength='70' id='observacion' name='observacion'><br><br><br>
        <button type='button' style='width:40%;' onclick='Aprobar()'>Realizar Prestamo</button>
        <button type='button' style='float:right;' onclick='VentanaRechazarCerrar(".asigar_equipo")'>Cerrar</button>
        <input type="text" id='agrupar_equipo' name='agrupar_equipo' hidden>
        </form>
    </div>
    <div class="informacion_container">
        <h2 style='grid-column:1/5;text-align:center;'>Informacion del Prestamo</h2>
        <div style='font-weigth'>Equipo Entregado <br>
        <p class='parrafo' id='equipo_entregado'></p></div>
        <div>Fecha de Creacion <br>
        <p class='parrafo'></p></div>
        <div>Fecha Entrega <br>
        <p  class='parrafo'></p></div>
        <div>Fecha Devolucion <br>
        <p  class='parrafo'></p></div>
        <div>Fecha Uso <br>
        <p  class='parrafo'></p></div>
        <div>Hora Inicial <br>
        <p  class='parrafo'></p></div>
        <div>Hora Final <br>
        <p  class='parrafo'></p></div>
        <div style='grid-column:1/3;word-break:break-word;'>Equipo Solicitado<br>
        <p  class='parrafo'></p></div>
        <div>Actividad <br>
        <p  class='parrafo'></p></div>
        <div>Salon <br>
        <p  class='parrafo'></p></div>
        <div>Observacion <br>
        <p  class='parrafo'></p></div>
        <div>Estado <br>
        <p  class='parrafo'></p></div>
        <div>Cedula Solicitante <br>
        <p  class='parrafo'></p></div>
        <div>Nombre Solicitante <br>
        <p  class='parrafo'></p></div>
        <div>Apellido Solicitante <br>
        <p  class='parrafo'></p></div>
        <div style='grid-column:1/5;'>Cedula Revisor<br>
        <p  class='parrafo'></p></div>
        <button type='button' class='boton' id='asigar_equipo' style='display:none' onclick='VentanaRechazar(".asigar_equipo")'>Asigar Equipo</button>
        <button type='button' class='boton' id='rechazar' style='display:none' onclick='VentanaRechazar(".mensaje_rechazar")'>Rechazar</button>
        <button type='button' class='boton' id='eliminar' style='display:none'>Eliminar</button>
        <button type='button' class='boton' id='devolver' style='display:none' onclick='VentanaRechazar(".mensaje_devolver")'>Devolver</button>
        <button type='button' class='boton' id='entregar' style='display:none' onclick='VentanaRechazar(".mensaje_entregado")'>Entregar</button>
        <button type='button' class='boton' id='cancelar' style='display:none' onclick='VentanaRechazar(".mensaje_rechazar")'>Cancelar</button>
        <button type='button' class='boton' style='grid-column:4/5;' id='cerrar' onclick='Cerrar()'>Cerrar</button>
    </div>                
<script src="../js/almacenista.js"></script>
</body>
</html>