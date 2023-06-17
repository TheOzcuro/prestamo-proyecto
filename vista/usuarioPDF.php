<?php
session_start();
ob_start();
include_once("../control/c_tablas.php");
$prestamoAprobado=GetAllPrestamoUsuario($_POST["cedula_usuario"]);
if (count($prestamoAprobado)==0) {
    $_SESSION["mensaje"]="Este usuario no tiene datos registrados en prestamo";
    header('Location: admin.php');
}
echo "<table class='listar-container' style='width:100%;border-collapse:collapse;'>
    <tr>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Equipo Equipo</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Fecha Creacion</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Fecha Entrega</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Fecha Devolucion</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Fecha Uso</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Hora Inicial</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Hora Final</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Equipo Solicitado</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Actividad</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Salon</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Observacion</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Estado</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Solicitante</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Revisor</th>
    </tr>";
    
    $fila=count($prestamoAprobado);
    $contador=0;
    while ($fila>$contador){
        echo "<tr>";
        for ($i=0; $i < 15; $i++) {
            if ($i==0) {
                $equipo_dato="";
                $equipo_codigo="";
                $agrupar_equipo=explode(",",$prestamoAprobado[$contador][0]);
                echo "<td class='contenido' style='border:1px solid black;'>";
                for ($y=0; $y <count($agrupar_equipo) ; $y++) { 
                    for ($x=0; $x < count($equipo); $x++) {
                        if ($equipo[$x][0]==$agrupar_equipo[$y]) {
                            echo $equipo[$x][2].", ";
                            $equipo_dato=$equipo[$x][0].".".$equipo[$x][2].",".$equipo_dato;
                            $equipo_codigo=$equipo[$x][0].",".$equipo_codigo;
                            }
                        }
                    }
                        echo "</td>";
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
                echo "<td class='contenido' style='border:1px solid black;'>";
                while($count>$n) {
                    $clase_contador=0;
                    while ($clase_fila>$clase_contador && $count>$n) {
                    if ($clase[$clase_contador][0]==$equipo_inv[$n] 
                    || $clase[$clase_contador][1]==$equipo_inv[$n]) {
                        if ($count==1) {
                            $agrupar_equipo=$cantidad[$n]." ".$clase[$clase_contador][1];
                            $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1];
                        }
                        else {
                            $agrupar_equipo=$cantidad[$n]." ".$clase[$clase_contador][1].", ".$agrupar_equipo;
                            $total_equipo=$cantidad[$n]." ".$clase[$clase_contador][1].", ".$total_equipo;
                            
                        }
                    }
                    $clase_contador=$clase_contador+1;                         
                    }
                    $n=$n+1;
                }
                echo $agrupar_equipo;
                $prestamoAprobado[$contador][$i]=$agrupar_equipo;
                echo "</td>";
            }
            else if ($i==8) {
                # code...
            }
            else if ($i==9) {
                    $actividad_fila=count($actividad);
                    $actividad_contador=0;
                    while  ($actividad_fila>$actividad_contador){
                        if ($prestamoAprobado[$contador][$i]==$actividad[$actividad_contador][0]) {
                            echo "<td class='contenido' style='border:1px solid black;'>".$actividad[$actividad_contador][1]."</td>";
                        }
                        $actividad_contador=$actividad_contador+1;
                    }
                }
            else if ($i==10) {
                    $salon_fila=count($salon);
                    $salon_contador=0;
                    while  ($salon_fila>$salon_contador){
                        if ($prestamoAprobado[$contador][$i]==$salon[$salon_contador][0]) {
                            echo "<td class='contenido' style='border:1px solid black;'>".$salon[$salon_contador][1]."</td>";
                        }
                        $salon_contador=$salon_contador+1;
                    }
                }
            else if ($i==12 && $prestamoAprobado[$contador][$i]==2 && $prestamoAprobado[$contador][2]=="") {
                echo "<td class='contenido' style='border:1px solid black;'>Aprobado</td>";
            }
            else if ($i==12 && $prestamoAprobado[$contador][$i]==2 && $prestamoAprobado[$contador][2]!="") {
                echo "<td class='contenido' style='border:1px solid black;'>Entregado</td>";
            }
            else if ($i==12 &&  $prestamoAprobado[$contador][$i]==0) {
                echo "<td class='contenido' style='border:1px solid black;'>Rechazado</td>";
            }
            else if ($i==12 && $prestamoAprobado[$contador][$i]==1) {
                echo "<td class='contenido' style='border:1px solid black;'>Pendiente</td>";
            }
            else if ($i==12 && $prestamoAprobado[$contador][$i]==3) {
                echo "<td class='contenido' style='border:1px solid black;'>Devuelto</td>";
            }
            else if($i==13) {
                for ($x=0; $x < count($val); $x++) {
                    if ($val[$x][0]==$prestamoAprobado[$contador][$i]) {
                        $y=$x;
                        echo "<td class='contenido' style='border:1px solid black;'>".$val[$x][0]."<br>".$val[$x][1]."<br>".$val[$x][2]."</td>";
                        if ($val[$x][0]==$_POST["cedula_usuario"]) {
                            $usuario=$val[$x][1].' '.$val[$x][2];
                        }
                       
                    }
                }
                
            }
            else if($i==14) {
                if ($prestamoAprobado[$contador][$i]==0) {
                    echo "<td class='contenido' style='border:1px solid black;'>Ninguno</td>";
                }
                else if ($prestamoAprobado[$contador][$i]==1) {
                    echo "<td class='contenido' style='border:1px solid black;'>Director</td>";
                }
                else {
                    for ($x=0; $x < count($val); $x++) {
                        if ($val[$x][0]==$prestamoAprobado[$contador][$i]) {
                            echo "<td class='contenido' style='border:1px solid black;'>".$val[$x][0]."<br>".$val[$x][1]."<br>".$val[$x][2]."</td>";
                            if ($val[$x][0]==$_POST["cedula_usuario"]) {
                                $usuario=$val[$x][1].' '.$val[$x][2];
                            }
                        }
                    }
                }
                
                
            }
            else {
                echo "<td class='contenido' style='border:1px solid black;'>".$prestamoAprobado[$contador][$i]."</td>";
            }
           
        }
        $contador=$contador+1;
        echo "</tr>";
    }
echo"</table>";
include_once("../libreria/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf= new Dompdf();
$html=ob_get_clean();
$option = $dompdf->getOptions();
$option->set(array('isRemoteEnable' => true));
$dompdf->set_option('dpi', 100);
$dompdf->setOptions($option);
$dompdf->loadHtml($html);
$dompdf->setPaper("A3", "landscape");
$dompdf->render();
$dompdf->stream($usuario.".pdf", array('Attachment' => false));
echo "<script>window.close();</script>";
?>