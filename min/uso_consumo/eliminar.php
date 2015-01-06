<?php

header("Content-Type: text/html;charset=utf-8");


include("../../db.php");


if(isset($_GET['codigo']))
{

    $codigo = $_GET['codigo'];
    $codigo_articulo = $_GET['articulo'];

    $fecha_actual = date("Y-n-j");

    $sql = "UPDATE  min_uso_consumo SET devolucion='$fecha_actual' WHERE codigo='$codigo' " or die('No se pudo guardar la información. '.mysql_error());

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());



    //valoracion

    $sql = "select * from min_uso_consumo where codigo='$codigo'";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    if (!$result)
    {
        die("Error: Data not found.. min_venta");
    }

    $cod_articulo = $test['cod_articulo'];
    $cantidad = $test['cantidad_despacho'];



//-.-.-.-.---.--.-..-.-.


    $sql = "select * from min_valoracion where codigo_producto='$codigo_articulo'";


    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    if (!$result)
    {
        die("Error: Data not found.. de unudades");
    }

    $valoracion_unidades = $test['unidades'];
    $valoracion_costo_total_ = $test['costo_total'];
    $promedio_actual = $test['promedio_actual'];

    $nueva_valoracion_unidades = $valoracion_unidades + $cantidad;



    $tmp_costo_total = $promedio_actual * $cantidad;
    $nueva_valoracion_costo_total = $valoracion_costo_total_ + $tmp_costo_total;


    $sql = "UPDATE min_valoracion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total' WHERE codigo_producto ='$codigo_articulo'";


    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());






// cierro bd
    mysql_close($conn);




    // redirrecion es directorio actual
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    $extra = 'uso_consumo_ver.php';

    header("Location: http://$host$uri/$extra");

}