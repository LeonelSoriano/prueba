<?php

include("../../db.php");
require_once("../../clases/funciones.php");

$str_result = "";


$mes = $_POST['mes'];
$ano = $_POST['ano'];





$sql = "SELECT              cos_detalle_erogaciones.codigo as codigo,
                            cos_erogaciones.nombre as erogacion,
                            cos_detalle_erogaciones.cuenta_contable as cuenta_contable,
                            cos_detalle_erogaciones.fecha as fecha,
                            cos_detalle_erogaciones.costo as costo
                            FROM cos_detalle_erogaciones
                            INNER JOIN cos_erogaciones ON cos_erogaciones.codigo = cos_detalle_erogaciones.codigo_erogacion
                            where cos_detalle_erogaciones.eliminado = 'n' AND cos_detalle_erogaciones.fecha like '".$ano."-".$mes."%'
                            ORDER BY erogacion";


$result=mysql_query($sql);

if (!$result)
{
    die("Error: Data not found.. de tipo inventario");
}

$block = false;


$total = 0;
while($test = mysql_fetch_array($result)){

    if($block == false){
        $str_result .='<tr style="text-align: center;">
<th>Nombre</th>
<th>Cuenta Contable</th>

<th>Fecha</th>
 <th>Costo</th>
  <th></th>
    <th></th>
    </tr>
<tr>';
        $block = true;
    }

    $erogacion = $test['erogacion'];
    $cuenta_contable = $test['cuenta_contable'];
    $fecha = $test['fecha'];
    $costo = $test['costo'];
    $total += $costo;
    $codigo = $test['codigo'];


    $str_result .= "<td style='text-align: left'><font color='black'>". $erogacion . "</font></td>";
    $str_result .= "<td style='text-align: left'><font color='black'>". $cuenta_contable . "</font></td>";
    $str_result .= "<td style='text-align: left'><font color='black'>". $fecha . "</font></td>";
    $str_result .= "<td style='text-align: right'><font color='black'>". formatear_ve($costo) . "</font></td>";
    $str_result .= "<td> <a href ='erogacion_mod.php?codigo=$codigo'>Modificar</a>";
    $str_result .= "<td> <a href ='erogacion_del.php?codigo=$codigo'>Eliminar</a>";
    $str_result .= "</tr>";

}
$str_result .= "<tr>";
$str_result .= "<td><font color='black'>Total</font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td style='text-align: right'><font color='black'>".formatear_ve($total)."</font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td><font color='black'></font></td>";

    $str_result .= "</tr>";

mysql_close($conn);

echo($str_result);
