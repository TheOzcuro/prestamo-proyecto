<?php
ob_start();
include_once("../control/c_tablas.php");
echo "<table class='listar-container' style='width:100%;border-collapse:collapse;'>
    <tr>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Codigo Equipo</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Codigo Bienes</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Nombre Equipo</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Estado</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Grupo</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Clase</th></tr>";
    
    $fila=count($equipo);
    $filagrupo=count($grupo);
    $filaclase=count($clase);
    $contador=0;
    while ($fila>$contador){
        echo "<tr>";
        $valorgrupo="Ninguno";
        $valorclase="";
        $contadorgrupo=0;
        $contadorclase=0;
        while ($filagrupo>$contadorgrupo) {
            if ($grupo[$contadorgrupo][0]==$equipo[$contador][4]) {
                $valorgrupo=$grupo[$contadorgrupo][1];
            }
            $contadorgrupo=$contadorgrupo+1;
        }
        while ($filaclase>$contadorclase) {
            if ($clase[$contadorclase][0]==$equipo[$contador][5]) {
                $valorclase=$clase[$contadorclase][1];
            }
            $contadorclase=$contadorclase+1;
        }
        for ($i=0; $i < 6; $i++) { 
            if ($i==4) {
                echo "<td class='contenido' style='border:1px solid black;'>".$valorgrupo."</td>";
            }
            else if ($i==5) {
                echo "<td class='contenido' style='border:1px solid black;'>".$valorclase."</td>";
            }
            else {
                echo "<td class='contenido' style='border:1px solid black;'>".$equipo[$contador][$i]."</td>";
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
$dompdf->stream("grupo.pdf", array('Attachment' => false));
echo "<script>window.close();</script>";
?>