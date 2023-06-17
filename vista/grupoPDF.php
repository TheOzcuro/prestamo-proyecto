<?php
ob_start();
include_once("../control/c_tablas.php");
echo "<table class='listar-container' style='width:100%;border-collapse:collapse;'>
    <tr>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Codigo Grupo</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Codigo Nombre</th>
    <th class='title' style='border:1px solid black;font-size:18px;background: rgb(73, 87, 214);color:white;'>Objetos Grupo</th>";
    $fila=count($grupo);
            $filaequipo=count($equipo);
            $contador=0;
            while ($fila>$contador){
                echo "<tr>";
                $contadorequipo=0;
                for ($i=0; $i < 2; $i++) { 
                    echo "<td class='contenido' style='border:1px solid black;'>".$grupo[$contador][$i]."</td>";
                }
                echo "<td class='contenido' style='border:1px solid black;'>";
                while ($filaequipo>$contadorequipo) {
                    if ($grupo[$contador][0]==$equipo[$contadorequipo][4]) {
                        echo $equipo[$contadorequipo][0]."-".$equipo[$contadorequipo][2]."<br>";
                    }
                    $contadorequipo=$contadorequipo+1;
                }
                echo "</td>";
                echo "</tr>";
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
$dompdf->stream("objetos.pdf", array('Attachment' => false));
echo "<script>window.close();</script>";
?>