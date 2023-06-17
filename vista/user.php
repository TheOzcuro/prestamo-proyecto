<!DOCTYPE html>
<html lang="en">
<?php
include_once("../control/c_tablas.php");
session_start();
if ($_SESSION["usuario"]!="usuario") {
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
    <title>Usuario</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/tabla.css">
</head>
<body>
    <nav>
        <img src="../css/menu.png" alt="Menu" onclick='Menu()'>
        <h1>Hola, Bievenido <?php echo $_SESSION["nombre"][0][0]." ".$_SESSION["nombre"][0][1] ?></h1>
    </nav>
    <div class='submenu'>
        <nav>
        <div id='boton_usuario'>Solicitar Prestamos</div>
        <div id='boton_grupo'>Prestamos Activos</div>
        <a href="logout.php"><div>Cerrar Session</div></a>
        </nav>
    </div>
    <div class="informacion_container" style='top:-15%;'>
        <h2 style='grid-column:1/5;text-align:center;'>Informacion del Prestamo</h2>
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
        <div style='grid-column:3/5'>Equipo Solicitado<br>
        <p  class='parrafo'></p></div>
        <div>Actividad <br>
        <p  class='parrafo'></p></div>
        <div>Salon <br>
        <p  class='parrafo'></p></div>
        <div>Observacion <br>
        <p  class='parrafo'></p></div>
        <div>Estado <br>
        <p  class='parrafo'></p></div>
        <div>Revisor <br>
        <p  class='parrafo'></p></div>
        <br><br><br>
        <button type='button' class='boton' style='grid-column:2/4;' id='cerrar' onclick='Cerrar()'>Cerrar</button>
    </div>       
    <form action="../control/c_prestamo.php" method="post" id='prestamo' name='prestamo'>
        <input type="text" id='fecha_hoy' name='fecha_hoy' hidden>
        <div id='prestamo-container' class='container_tabla'>
            <h2 style='grid-column:1/4; text-align: center;'>Realizar Prestamos</h2>
            <div class='input_container'>
                    <label for="fecha_uso">Fecha de Uso</label><br>
                    <input type="date" id='fecha_uso' name='fecha_uso' class='registrar_input' maxlength='30'>
                    <input type="checkbox" class='checkbox' onclick='Check(0,this,"fecha_uso")'>
                </div>
                <div class='input_container'>
                    <label for="fecha_uso">Fecha de Devolucion</label><br>
                    <input type="date" id='fecha_devolucion' name='fecha_devolucion' class='registrar_input' maxlength='30'>
                    <input type="checkbox" class='checkbox' onclick='Check(0,this,"fecha_devolucion")'>
                </div>
            <div class='input_container'>
                    <label for="hora_inicial">Hora Inicial</label><br>
                    <input type="time" id='hora_inicial' name='hora_inicial' class='registrar_input' maxlength='30'>
                    <input type="checkbox" class='checkbox' onclick='Check(0,this,"hora_inicial")'>
                </div>
            <div class='input_container'>
                    <label for="hora_final">Hora Final</label><br>
                    <input type="time" id='hora_final' name='hora_final' class='registrar_input' maxlength='30'>
                    <input type="checkbox" class='checkbox' onclick='Check(0,this,"hora_final")'>
                </div>
                <div class='input_container'>
                    <label for="actividad_programada">Actividad Programada</label><br>
                    <select name="actividad_programada" id="actividad_programada" class='registrar_input'>
                        <option value="">Seleccione la Actividad</option>
                        <?php
                        $fila=count($_SESSION["actividad"]);
                        $contador=0;
                        while  ($fila>$contador){
                            echo "<option value='".$_SESSION["actividad"][$contador][0]."'>"
                            .$_SESSION["actividad"][$contador][1]."</option>";
                            $contador=$contador+1;
                        }
                        ?>
                    </select>
                    <input type="checkbox" class='checkbox' onclick='Check(0,this,"actividad_programada")'>
                </div>
                <div class='input_container'>
                    <label for="salon_uso">Salon donde se usara</label><br>
                    <select name="salon_uso" id="salon_uso" class='registrar_input'>
                        <option value="">Seleccione el Salon</option>
                        <?php
                        $fila=count($_SESSION["salon"]);
                        $contador=0;
                        while  ($fila>$contador){
                            echo "<option value='".$_SESSION["salon"][$contador][0]."'>"
                            .$_SESSION["salon"][$contador][1]."</option>";
                            $contador=$contador+1;
                        }
                        ?>
                    </select>
                    <input type="checkbox" class='checkbox' onclick='Check(0,this,"salon_uso")'>
                </div>
                <div class='input_container'>
                    <label for="clase">Clase</label><br>
                    <select name="clase_select" id="clase_select" class='registrar_input'>
                        <option value="">Seleccione</option>      
                        <?php 
                        $fila=count($clasesbien);
                        $contador=0;
                        $fila_equipo=count($equipo);
                        $indice=1;
                        while ($fila>$contador){
                            $equiposbien=0;
                            $contador_equipo=0;
                            while ($fila_equipo>$contador_equipo) {
                                if ($equipo[$contador_equipo][5]==$clasesbien[$contador][0]) {
                                    if ($equipo[$contador_equipo][3]=="bien") {
                                        $equiposbien=$equiposbien+1;
                                    }
                                }
                                $contador_equipo=$contador_equipo+1;
                            }
                            echo "<option value='".$clasesbien[$contador][0]."' id='".$indice."' class='".$equiposbien."'>".$clasesbien[$contador][1]."</option>";
                            $contador=$contador+1;
                            $indice=$indice+1;
                        }
                        ?>
                    </select>
                    <input type="checkbox" class='checkbox' onclick='Check(5,this,"clase_select")'>
            </div>
                <div class='input_container' style='position:relative;'>
                    <label for="cantidad">Cantidad</label><br>
                    <button id='img_user' type='button' title='Reducir Cantidad'><b style='top:-7px'>-</b></button>
                    <input type="text" id='cantidad' name='cantidad' class='registrar_input' maxlength='30' style='width:10%;font-size:22px;text-align:center;margin-left:120px;' value='0' disabled>
                    <button id='img_add' type='button' title='Aumentar Cantidad'><b style='top:-5px'>+</b></button>
                    <input type="checkbox" class='checkbox' onclick='Check(0,this,"cantidad")'>
                </div>
                <div class='input_container' style='position:relative;'>
                    <button type='button' style='position:relative;top:20px;left:65px;' onclick=AñadirEquipo()>Añadir Equipo</button>
                </div>
                <div class='container_equipos' style='grid-column:1/4;display:flex;flex-direction:row;flex-wrap:wrap;'>

                </div>
                <input type="text" id='equipos_texto' name='equipos_texto' hidden>
                <input type="text" id='equipos_cantidad' name='equipos_cantidad' hidden>
                <button type='button' class='boton' style='grid-column:2/3;font-size:28px' onclick='RegistrarSolicitud()'>Solicitar</button>
            </div>
            <div class='tabla_prestamo container_tabla' style='display: none;grid-template-columns:150px 150px 150px 150px 150px 150px;'>
        <div class='tabla'>
            <div class='titulo' maxlength='40'>Fecha de Creacion</div>
            <div class='titulo' maxlength='50'>Fecha de Entrega</div>
            <div class='titulo' maxlength='50'>Fecha de Devolucion</div>
            <div class='titulo' maxlength='50'>Fecha de Uso</div>
            <div class='titulo' maxlength='70'>Equipo Solicitado</div>
            <div class='titulo' maxlength='40'>Estado</div>
            <div class='titulo' maxlength='50'>Revisor</div>
            <div></div>

            <?php
            $fila=count($_SESSION["datos"]);
            $contador=0;
            while ($fila>$contador){
                for ($i=0; $i < 13; $i++) {
                    if ($i==4 || $i==5) {
                        
                    }
                    else if ($i==6) {
                        $clase_fila=count($clase);
                        $clase_contador=0;
                        $equipo_inv=explode(",",$_SESSION["datos"][$contador][$i]);
                        $count=count($equipo_inv);
                        $agrupar_equipo="";
                        $cantidad=explode(",",$_SESSION["datos"][$contador][7]);
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
                        $_SESSION["datos"][$contador][$i]=$agrupar_equipo;
                        echo "</div>";
                    }
                    else if($i>6 && $i<11){
                        if ($i==7) {
                            # code...
                        }
                        else if ($i==8) {
                            $actividad_fila=count($_SESSION["actividad"]);
                            $actividad_contador=0;
                            while  ($actividad_fila>$actividad_contador){
                                if ($_SESSION["datos"][$contador][$i]==$_SESSION["actividad"][$actividad_contador][0] 
                                || $_SESSION["datos"][$contador][$i]===$_SESSION["actividad"][$actividad_contador][1]) {
                                    $_SESSION["datos"][$contador][$i]=$_SESSION["actividad"][$actividad_contador][1];
                                }
                                $actividad_contador=$actividad_contador+1;
                            }
                        }
                        else if ($i==9) {
                            $salon_fila=count($_SESSION["salon"]);
                            $salon_contador=0;
                            while  ($salon_fila>$salon_contador){
                                if ($_SESSION["datos"][$contador][$i]==$_SESSION["salon"][$salon_contador][0] 
                                || $_SESSION["datos"][$contador][$i]==$_SESSION["salon"][$salon_contador][1]) {
                                    $_SESSION["datos"][$contador][$i]=$_SESSION["salon"][$salon_contador][1];
                                }
                                $salon_contador=$salon_contador+1;
                            }
                        }
                    } 
                    else if ($_SESSION["datos"][$contador][11]==0 && $i==11) {
                        echo "<div class='contenido'>Rechazado</div>";
                    }
                    else if ($_SESSION["datos"][$contador][11]==1 && $i==11) {
                        echo "<div class='contenido'>Pendiente</div>";
                    }
                    else if ($_SESSION["datos"][$contador][11]==2 && $i==11) {
                        echo "<div class='contenido'>En Prestamo</div>";
                    }
                    else if ($_SESSION["datos"][$contador][11]==3 && $i==11) {
                        echo "<div class='contenido'>Devuelto</div>";
                    }
                    else if ($_SESSION["datos"][$contador][12]==0 && $i==12) {
                        $_SESSION["datos"][$contador][12]="";
                        echo "<div class='contenido'></div>";
                    }
                    else if ($_SESSION["datos"][$contador][12]==1 && $i==12) {
                        $_SESSION["datos"][$contador][12]="Director/a";
                        echo "<div class='contenido'>Director/a</div>";
                    }
                    else {
                        echo "<div class='contenido'>".$_SESSION["datos"][$contador][$i]."</div>";
                    }
                   
                }
                print_r("<button type='button' class='botones-tabla' onclick='Vermas(`".$_SESSION["datos"][$contador][0]."`,`".$_SESSION["datos"][$contador][1]."`,`".$_SESSION["datos"][$contador][2]."`,`".$_SESSION["datos"][$contador][3]."`,`".$_SESSION["datos"][$contador][4]."`,`".$_SESSION["datos"][$contador][5]."`,`".$total_equipo."`,`".$_SESSION["datos"][$contador][8]."`,`".$_SESSION["datos"][$contador][9]."`,`".$_SESSION["datos"][$contador][10]."`,`".$_SESSION["datos"][$contador][11]."`,`".$_SESSION["datos"][$contador][12]."`)'>Ver Mas</button>");             
                $contador=$contador+1;
                
            }
            ?>
        </div>
    </div>                                                                                                                                                                                                                                                                                 
    </form>
<script src="../js/user.js"></script>
</body>
</html>