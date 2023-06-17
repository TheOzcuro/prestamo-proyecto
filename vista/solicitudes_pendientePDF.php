<?php
ob_start();
include_once("../control/c_tablas.php");

echo '<img src="../css/cintillo.png" alt="" srcset="" style="width:100%">';
echo "<h2 style='text-align:center;'>FORMATO DE SOLICITUD DE EQUIPO</h2>";
echo "<table class='listar-container' style='width:100%;border-collapse:collapse;border:3px solid black;'>";
    $prestamoPendiente=GetAllUsuarioPrestamoPendiente($_POST["cedula_pendiente"]);
    $fila=count($prestamoPendiente);
    $contador=0;
    while ($fila>$contador){
       
        for ($i=0; $i < 15; $i++) {
            if ($i==1) {
                echo "<tr>";
                echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Fecha Creacion:</th>";
                echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>".$prestamoPendiente[$contador][$i]."</td>";
                echo "</tr>";
            }
            else if ($i==4) {
                echo "<tr>";
                echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Fecha de Uso, Hora Inicial y Hora final:</th>";
                echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>".$prestamoPendiente[$contador][$i].", ".$prestamoPendiente[$contador][5].", ".$prestamoPendiente[$contador][6]."</td>";
                echo "</tr>";
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
                        echo "<tr>";
                        echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Equipo: </th>";
                        echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>";
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
                        $prestamoPendiente[$contador][$i]=$agrupar_equipo;
                        echo "</td>";
                        echo "</tr>";
            }
            else if ($i==8) {
                # code...
            }
            else if ($i==9) {
                    $actividad_fila=count($actividad);
                    $actividad_contador=0;
                    while  ($actividad_fila>$actividad_contador){
                        if ($prestamoPendiente[$contador][$i]==$actividad[$actividad_contador][0]) {
                            echo "<tr>";
                            echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Actividad Programada: </th>";
                            echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>".$actividad[$actividad_contador][1]."</td>";
                            echo "</tr>";
                        }
                        $actividad_contador=$actividad_contador+1;
                    }
                }
            else if ($i==10) {
                    $salon_fila=count($salon);
                    $salon_contador=0;
                    while  ($salon_fila>$salon_contador){
                        if ($prestamoPendiente[$contador][$i]==$salon[$salon_contador][0]) {
                            echo "<tr>";
                            echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;width:310px;text-align:left;'>Salon donde se usara: </th>";
                            echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>".$salon[$salon_contador][1]."</td>";
                            echo "</tr>";
                        }
                        $salon_contador=$salon_contador+1;
                    }
                }
            else if($i==13) {
                for ($x=0; $x < count($val); $x++) {
                    if ($val[$x][0]==$prestamoPendiente[$contador][$i]) {
                        $y=$x;
                        echo "<tr>";
                        echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Solicitado Por: </th>";
                        echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>".$val[$x][0]." ".$val[$x][1]." ".$val[$x][2]."</td>";
                        echo "</tr>";
                    }
                }
                
            }
            else if ($i==14) {
                echo "<tr>";
                echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Observaciones: </th>";
                echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>".$prestamoPendiente[$contador][11]."</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Nombre y Apellido</th>";
                    echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'>";
                for ($x=0; $x < count($val); $x++) {
                if ($val[$x][0]==$prestamoPendiente[$contador][14]) {
                    $y=$x;
                   
                   
                   echo $val[$x][0]." ".$val[$x][1]." ".$val[$x][2];
                }
            }
            echo "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th class='title' style='border-bottom:1px solid black;font-size:18px;text-align:left;'>Firma</th>";
                echo "<td class='contenido' style='border-bottom:1px solid black;text-align:left;'></td>";
                echo "</tr>";
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
$dompdf->setPaper("letter");
$dompdf->render();
$dompdf->stream("formato_pendiente.pdf", array('Attachment' => false));
echo "<script>window.close();</script>";
?>