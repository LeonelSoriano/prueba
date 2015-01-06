<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/09/14
 * Time: 11:31 AM
 */


if(isset($_POST['codigo_orden_hi'])){

    require_once('../../db.php');
    require_once('../../clases/funciones.php');


    $hoy = fecha_sicap();

    $codigo_orden = $_POST['codigo_orden_hi'];
    $produccion = $_POST['produccion'];
    $comentario = $_POST['comentario'];



    $sql = "SELECT * FROM prc_orden_trabajo WHERE codigo='$codigo_orden'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $produccion_planificada =  $test['produccion_planificada'];
    $codigo_producto =  $test['codigo_producto'];


    $indicador ='';



    if($produccion_planificada >= $produccion){
        $indicador = 'E';
    }else if ($produccion_planificada < $produccion){
        $indicador = 'I';
    }


    $sql = "UPDATE prc_orden_trabajo SET fecha_culminacion='$hoy',comentario='$comentario',produccion_real='$produccion',
     indicador = '$indicadorn' WHERE codigo='$codigo_orden'";

    $result=mysql_query($sql);


    $sql = "SELECT * FROM min_valoracion WHERE codigo_producto = '$codigo_producto'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $unidades = $test['unidades'];
    $costo_total = $test['costo_total'];
    $promedio_actual = $test['promedio_actual'];

    $valoracion_unidades = $produccion + $unidades;

    $valoracion_costo_total = $costo_total + 500;

    $valoracion_promedio_actual = $valoracion_costo_total / $valoracion_unidades;


    $sql = "UPDATE min_valoracion SET unidades='$valoracion_unidades',costo_total='$valoracion_costo_total',
     promedio_actual = '$valoracion_promedio_actual' WHERE codigo_producto = '$codigo_producto'";

    $result=mysql_query($sql);



//    $sql = "SELECT DISTINCT(prc_orden_trabajo_detalle_etapa.codigo_producto_detalle) as producto,min_valoracion.promedio_actual as valor
//FROM prc_orden_trabajo_detalle_etapa
//INNER JOIN min_valoracion
//ON min_valoracion.codigo_producto = prc_orden_trabajo_detalle_etapa.codigo_producto_detalle
//WHERE prc_orden_trabajo_detalle_etapa.codigo_orden_trabajo = '$codigo_orden'";
//
//    $result=mysql_query($sql);
//
//    while($test = mysql_fetch_array($result)) {
//        $producto = $test['producto'];
//        $valor = $test['valor'];
//
//echo('*');
//        $sql2 = "INSERT INTO prc_orden_trabajo_cierre_valor
//    ( codigo_orden, codigo_producto	, valor)
//    VALUES('$codigo_orden', '$producto', '$valor')";
//        $result2 = mysql_query($sql2) or die('No se pudo guardar la información. prc_orden_trabajo_cierre_valor '.mysql_error());
//
//    }
//


    require_once('../../clases/funciones.php');
    $fecha = fecha_sicap();
    $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha )
VALUES('$codigo_producto', '$valoracion_unidades', '$valoracion_costo_total', '$valoracion_promedio_actual', '$fecha');
";
    $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());

    header('Location: ' . $_SERVER['HTTP_REFERER']);

}

/*TODO  inventario costos etc de productos terminados ESTOY AGREGANDO UN PRECIO FICTICIO*/