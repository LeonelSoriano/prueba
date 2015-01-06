<?php


$response;

$divs_hansome = [];

$encabezado_tabla = [];
$salidad = '';

function add_hanson(&$divs_hansom){

    array_push($divs_hansom,  '<div id="handsontable'. count($divs_hansom).'" class="handsontable" ></div>');

}

require_once('../../db.php');
include_once('../../clases/ClaseTablaEtapa.php');
include_once('../../clases/funciones.php');


if(isset($_POST['codigo'])){


    $codigo =  $_POST['codigo'];


    $sql = "SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND codigo='$codigo'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $produccion_planificada = $test['produccion_planificada'];

    $produccion_real = $test['produccion_real'];




$response['js'] =  '<script type="text/javascript">  $(function() '.'{';




//    $a->setIdjs(count($divs_hansome));
//
//    $response['js'] .=  $a->print_colores();
//add_hanson($divs_hansome);


//sentencias sql

//$sql = "SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND fecha_culminacion <> 'n' AND codigo='$codigo'";
//$result=mysql_query($sql);

$sql = "SELECT * FROM prc_orden_trabajo_etapas WHERE completo <> 'n' AND codigo_orden_trabajo='$codigo'";

$result=mysql_query($sql);



while($test = mysql_fetch_array($result)){

    $a = new ClaseTablaEtapa();
    $codigo_departamento = $test['codigo_departamento'];


    $codigo_producto = $test['codigo_producto'];



    $sql2 = "SELECT * FROM mno_gerencia WHERE codigo='$codigo_departamento'";

    $result2=mysql_query($sql2);

    $test2 = mysql_fetch_array($result2);

    $nombre_etapa =  $test2['descripcion'];


    $sql2 =" SELECT * FROM prc_etapas WHERE  codigo_producto='$codigo_producto' AND codigo_departamento='$codigo_departamento'";

    $result2=mysql_query($sql2);

    $test2 = mysql_fetch_array($result2);

    $codigo_departamento_etapa = $test2['codigo'];


    $nombre_etapa = '<div style="margin-bottom: 10px;margin-top: 18px;font-weight: bold">'.$nombre_etapa.'</div>';

    array_push($encabezado_tabla,$nombre_etapa);

    $a->setIdjs(count($divs_hansome));

    /*este es el cuadro*/



//    $sql3 = " SELECT min_productos_servicios.nombre,min_uso_consumo.cantidad_despacho,min_uso_consumo.costo_articulo  FROM min_uso_consumo
// INNER JOIN min_productos_servicios
//  ON min_uso_consumo.cod_articulo = min_productos_servicios.codigo
// WHERE codigo_orden_produccion='$codigo' AND codigo_etapa='$codigo_departamento_etapa' ";


    /* el array de salida*/
    $_array_information = [];

    $total = array();



    $sql3 = "SELECT min_productos_servicios.codigo as codigo,
 min_productos_servicios.nombre as nombre,
  min_uso_consumo.cantidad_despacho as cantidad,
  min_uso_consumo.costo_articulo as costo
  FROM min_uso_consumo
  INNER JOIN min_productos_servicios ON min_uso_consumo.cod_articulo = min_productos_servicios.codigo
  WHERE codigo_orden_produccion='$codigo' AND codigo_etapa='$codigo_departamento_etapa'
   AND devolucion = 'n'
   ORDER BY min_productos_servicios.nombre";


    $result3=mysql_query($sql3);


    while($test3 = mysql_fetch_array($result3)){

        $nombre = $test3['nombre'];
        $cantidad_real = $test3['cantidad'];
        $costo = $test3['costo'];
        $codigo_detalle = $test3['codigo'];




        $sql4 ="SELECT sum( min_uso_consumo.cantidad_despacho) as suma, sum( min_uso_consumo.costo_real) as costo_real FROM min_uso_consumo WHERE codigo_orden_produccion='$codigo' AND
              cod_articulo = '$codigo_detalle' AND codigo_etapa= '$codigo_departamento_etapa'   AND  devolucion = 'n'";

        $result4=mysql_query($sql4);

        $test4 = mysql_fetch_array($result4);

        $cantidad_real = $test4['suma'];
        $costo_real_ = $test4['costo_real'];


        $sql4 = "SELECT * FROM prc_orden_trabajo_detalle_etapa WHERE
           codigo_orden_trabajo='$codigo'AND codigo_etapa='$codigo_departamento_etapa' AND
           codigo_producto='$codigo_producto' AND codigo_producto_detalle='$codigo_detalle'";

        $result4=mysql_query($sql4);

        $test4 = mysql_fetch_array($result4);

        //$cantidad_estandar = $test4['cantidad_estandar'];

        $valor_estandar = $test4['valor_standar'];




        $sql4 = "SELECT * FROM prc_detalle_etapa WHERE codigo_producto ='$codigo_producto' AND
        codigo_etapa='$codigo_departamento_etapa' AND codigo_producto_detalle='$codigo_detalle'";


        $result4=mysql_query($sql4);

        $test4 = mysql_fetch_array($result4);

        $cantidad_estandar = $test4['cantidad_estandar'];




        $costo_real = $costo_real_;



        if(isset($_array_information[$nombre])){

            $_array_information[$nombre] = array($cantidad_estandar,$cantidad_real,$costo_real,$valor_estandar);

        }else if(!isset($_array_information[$nombre])){
            $_array_information[$nombre][0] = $cantidad_estandar;
            $_array_information[$nombre][1] += $cantidad_real;
            $_array_information[$nombre][2] += $costo_real;
            $_array_information[$nombre][3] += $valor_estandar;
        }

    }//llenar array




    $Costo_Estadar_por_Unidad_total = 0;
    $Costo_Total_Produccion_total = 0;
    $Costo_Real_por_Unidad_total = 0;
    $Cantidad_total = 0;
    $Costo_total = 0;


    foreach($_array_information as $key => $value){


        $cantidad_real_solicitada = $value[1];


        //precio estandar
        $value[0] = str_replace(',','.',$value[0]);
        $costo_estandar = $value[0]*$value[3];

        $Costo_Estadar_por_Unidad_total += $costo_estandar;

        //$total[5] += $costo_estandar;

        //precio real
        $precio_real = $value[2]/$cantidad_real_solicitada;




        $precio_real_cal = $precio_real;//precio real;



        $produccion_real_total += $produccion_real;


        $costo_estandar_total += $costo_estandar;


        $variarion_unitaria =  $precio_real - $cur ; //Var. U



        //$produccion_planificada
        $Costo_Total_Produccion = $precio_real_cal * $cantidad_real_solicitada;

        $Costo_Total_Produccion_total += $Costo_Total_Produccion;

        $Cantidad_real_por_Unidad = $cantidad_real_solicitada / $produccion_real;

        $Costo_Real_por_Unidad = $Costo_Total_Produccion / $produccion_real;

        $Costo_Real_por_Unidad_total += $Costo_Real_por_Unidad;

        $Cantidad = $value[0] - $Cantidad_real_por_Unidad;

        $Cantidad_total += $Cantidad;

        $IE = 'D';
        if($Cantidad >= 0){
            $IE = 'F';
        }

        $Costo = $costo_estandar  - $Costo_Real_por_Unidad;

        $Costo_total += $Costo;

        $IP = 'D';

        if($Costo >= 0){
            $IP = 'F';
        }

            $a->add_info(utf8_decode($key) . '     ',formatear_ve($value[0]),formatear_ve( $precio_real_cal),
                formatear_ve($Costo_Total_Produccion),
                formatear_ve($Cantidad_real_por_Unidad),
                formatear_ve($Costo_Real_por_Unidad),
                formatear_ve($value[3]),
                formatear_ve($costo_estandar),
                formatear_ve($cantidad_real_solicitada),
                formatear_ve($Cantidad),
                $IE,formatear_ve($Costo),$IP);
//$costo_real_cal 8

    }

    //$cur = $total[3]/$produccion_real;

    //$variacion_total_unitaria = $total[5] -$cur;

    //$total_variacion_total =  ($total[5]*$produccion_real) - $total[3];

    $IP_total = 'F';
    if($Costo_total < 0){
        $IP_total = 'D';
    }


    $IE_total = 'F';
    if($Cantidad_total < 0){
        $IE_total = 'D';
    }


    $a->add_info('Total       ','','',formatear_ve($Costo_Total_Produccion_total),'',formatear_ve($Costo_Real_por_Unidad_total),
        '',formatear_ve($Costo_Estadar_por_Unidad_total),'',$Cantidad_total,$IE_total,formatear_ve($Costo_total),$IP_total);

//    $a->add_info($nombre);



    $response['js'] .=  $a->print_colores();

    add_hanson($divs_hansome);

}


$response['js'] .= "});</script>";



$salidad .= ' <div id="contenedor_handsontable" >';
   for ($i=0; $i < count($divs_hansome); $i++) {
      $salidad .=$encabezado_tabla[$i]  .$divs_hansome[$i];
    }
$salidad .= '</div><br/>';

$response['html'] .= $salidad;



echo json_encode($response);

}

