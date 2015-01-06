<?php

include("../../db.php");
require_once("../../clases/funciones.php");

$str_result = "";


$codigo = $_POST['codigo'];


$str_result .='<tr style="text-align: center;">
<th >Código</th>
<th>Nombre de Artículo</th>
<th>Fecha Adquisicion</th>
<th>Ubicación</th>
<th>Tipo de Inventario</th>
 <th>Unidad de Medida</th>
<th>Existencia Actual (Unidades)</th>
<th> Valor Unidad </th>
<th>Existencia Actual (Bs)</th>
<th></th>
    </tr>

<tr>';



$result=mysql_query("SELECT * FROM min_tipo_inventario WHERE tipo='$codigo'");

if (!$result)
{
    die("Error: Data not found.. de tipo inventario");
}

$test = mysql_fetch_array($result);

$tmp_tipo_inv = $test['codigo'];



            if($codigo == "Total Inventario"){
                $result=mysql_query("SELECT * FROM min_productos_servicios ORDER BY nombre");



            }else{
                $result=mysql_query("SELECT * FROM min_productos_servicios WHERE inventario='$tmp_tipo_inv' ORDER BY nombre");

            }

        $acum_costo_total = 0;
        while($test = mysql_fetch_array($result))
        {
            $id = $test['codigo'];


            $codigo_alias = $test['codigo_alias'];
            $nombre_articulo = $test['nombre'];

            $fecha_adquisicion = $test['fecha_adquisicion'];
            $ubicacion = $test['ubicacion'];
            $inventario = $test['inventario'];
            $mco_unidad = $test['mco_unidad'];




            $sql2 ="SELECT tipo FROM min_tipo_inventario where codigo='" . $inventario . "'";
            $result2 = mysql_query($sql2);
            $test2 = mysql_fetch_array($result2);
            if (!$result2)
            {
                die("Error: Data not found.. de tipo inventario");
            }
            $nombre_inventario = $test2['tipo'];



            $sql2 ="SELECT descripcion FROM mco_unidad where codigo='" . $mco_unidad . "'";
            $result2 = mysql_query($sql2);
            $test2 = mysql_fetch_array($result2);
            if (!$result2)
            {
                die("Error: Data not found.. de tipo unidad");
            }
            $nombre_unidad = $test2['descripcion'];



            $sql2 ="SELECT * FROM min_valoracion where codigo_producto='" . $id . "'";
            $result2 = mysql_query($sql2);
            $test2 = mysql_fetch_array($result2);
            $costo_unidad = $test2['promedio_actual'];
            if (!$result2)
            {
                die("Error: Data not found.. de tipo unidad");
            }
            $cantidad_existente = $test2['unidades'];
            $costo_total = $test2['costo_total'];

            $acum_costo_total +=$costo_total;


            $str_result .= "<td><font color='black'>". $codigo_alias . "</font></td>";
            $str_result .= "<td><font color='black'>".$nombre_articulo. "</font></td>";

            $str_result .= "<td><font color='black'>". $fecha_adquisicion. "</font></td>";
            $str_result .= "<td><font color='black'>". $ubicacion. "</font></td>";
            $str_result .= "<td><font color='black'>".$nombre_inventario . "</font></td>";
            $str_result .= "<td><font color='black'>".$nombre_unidad . "</font></td>";
            $str_result .= "<td style='text-align: right'><font color='black'>".formatear_ve($cantidad_existente) . "</font></td>";
            $str_result .= "<td style='text-align: right'><font color='black'>".formatear_ve($costo_unidad) . "</font></td>";


            $str_result .= "<td style='text-align: right'><font color='black'>".formatear_ve($costo_total). "</font></td>";



            $str_result .= "<td> <a href ='inventario_mod.php?codigo=$id'>Modificar</a>";
//                                        echo"<td> <a href ='cargo_del.php?codigo=$id'>Borrar</a>";

            $str_result .=  "</tr>";

        }

$str_result .= "<td><font color='black'>ToTal</font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td><font color='black'></font></td>";


$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td><font color='black'></font></td>";
$str_result .= "<td style='text-align: right'><font color='black'>".formatear_ve($acum_costo_total)."</font></td>";
$str_result .= "<td><font color='black'></font></td>";



mysql_close($conn);

echo($str_result);
