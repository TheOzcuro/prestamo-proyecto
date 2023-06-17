<?php
ob_start();
include_once("../control/c_tablas.php");
echo "<table class='listar-container' style='width:100%;border-collapse:collapse;'>
    <tr>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Clase</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Objetos en Buen estado</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Objetos en Buen Estado</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Objetos en Prestamo</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Objetos en Total</th></tr>";
    $fila=count($clase);
    $contador=0;
    $fila_equipo=count($equipo);
    while ($fila>$contador){
        echo"<tr>";
        $equiposbien=0;
        $equipodeteriorado=0;
        $equipoprestado=0;
        $equipototal=0;
        $contador_equipo=0;
        while ($fila_equipo>$contador_equipo) {
            if ($equipo[$contador_equipo][5]==$clase[$contador][0]) {
                if ($equipo[$contador_equipo][3]=="bien") {
                    $equiposbien=$equiposbien+1;
                    $equipototal=$equipototal+1;
                }
                else if($equipo[$contador_equipo][3]=="prestamo") {
                    $equipoprestado=$equipoprestado+1;
                    $equipototal=$equipototal+1;
                }
                else {
                    $equipodeteriorado=$equipodeteriorado+1;
                    $equipototal=$equipototal+1;
                }
            }
            $contador_equipo=$contador_equipo+1;
        }
        for ($i=1; $i < 2; $i++) { 
            echo "<td class='contenido' style='border:1px solid black;'>".$clase[$contador][$i]."</td>";
            
        }
        echo "<td class='contenido' style='border:1px solid black;'>".$equiposbien."</td>";
        echo "<td class='contenido' style='border:1px solid black;'>".$equipodeteriorado."</td>";
        echo "<td class='contenido' style='border:1px solid black;'>".$equipoprestado."</td>";
        echo "<td class='contenido' style='border:1px solid black;'>".$equipototal."</td></tr>";
        $contador=$contador+1;
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
$dompdf->stream("clases.pdf", array('Attachment' => false));
echo "<script>window.close();</script>";
?>