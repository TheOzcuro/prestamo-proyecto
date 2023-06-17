<?php
ob_start();
include_once("../control/c_tablas.php");
echo "<table class='listar-container' style='width:100%;border-collapse:collapse;'>
    <tr>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Cedula</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Nombre</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Apellido</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Rol</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Estado</th></tr>";
    $fila=count($val);
    $contador=0;
    while ($fila>$contador){
        echo "<tr>";
        for ($i=0; $i < 5; $i++) { 
            if ($val[$contador][4]==0 && $i==4) {
                echo "<td class='contenido' style='border:1px solid black;'>Inactivo</td>";
            }
            if ($val[$contador][4]==1 && $i==4) {
                echo "<td class='contenido' style='border:1px solid black;'>Activo</td>";
            }
            else if($i!=4) {
                echo "<td class='contenido' style='border:1px solid black;'>".$val[$contador][$i]."</td>";
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
$dompdf->stream("usuario.pdf", array('Attachment' => false));
echo "<script>window.close();</script>";
?>