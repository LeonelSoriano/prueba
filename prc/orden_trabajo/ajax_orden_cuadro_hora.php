<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/10/14
 * Time: 08:13 PM
 */


include_once('../../db.php');
include_once('./EtapaHorasClase.php');
//
//$html = '';
//$js = '';
//$response = array();
//
//$divs_hansome = array();
//
//function add_hanson(&$divs_hansom){
//
//    array_push($divs_hansom,  '<div id="handsontable'. count($divs_hansom).'" class="handsontable" ></div>');
//
//}
//
//
//$codigo = $_POST['codigo'];
//
//
//
//$response['js'] =  '<script type="text/javascript">  $(function() '.'{';
//
//
//
//
//$sql = "SELECT
//    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
//	mrh_empleado.cedula as cedula,
//	prc_orden_trabajador.horas as horas,
//	prc_orden_trabajador.codigo_etapa as etapa,
//	mno_gerencia.descripcion as descripcion
//FROM
//    prc_orden_trabajo
//        INNER JOIN
//    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
//		INNER JOIN
//	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
//		INNER JOIN
//	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
//		INNER JOIN
//	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
//WHERE
//    prc_orden_trabajo.codigo = '$codigo'
//";
//
//$result=mysql_query($sql);
//
//
//$a = new EtapaHorasClase();
//
////while($test = mysql_fetch_array($result)){
////
////    $nombre =  $test['nombre'];
//
//    $a->add_info('Total       ','0','0','0','0','0','0','0','0','0','0','0');
//
//
//
//
////}
//
//$response['js'] .=  $a->print_colores();
//
//add_hanson($divs_hansome);
//
//
//$response['js'] .= "});</script>";
//
//$html .= ' <div id="contenedor_handsontable" >';
//
//
//
//$html .= '</div><br/>';
//
//
//
//
//
//$response['html'] = $html;
//
//
//echo json_encode($response);


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
    $mes =  $_POST['mes'];
    $anhio =  $_POST['anhio'];

    $mes_anterior = 0;
    $anhio_anterior = 0;

    if($mes == 1){
        $mes_anterior = 12;
        $anhio_anterior = $anhio - 1;
    }else{
        $anhio_anterior = $anhio;
        $mes_anterior = $mes - 1;
    }





    $sql = "SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND codigo='$codigo'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $produccion_planificada = $test['produccion_planificada'];

    $produccion_real = $test['produccion_real'];





    $codigo_producto = $test['codigo_producto'];



    $sql = "SELECT * FROM prc_semielaborados WHERE codigo_producto=$codigo_producto";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $cantidad_maxima_mensual = $test['cantidad'];



    $response['js'] =  '<script type="text/javascript">  $(function() '.'{';




//    $a->setIdjs(count($divs_hansome));
//
//    $response['js'] .=  $a->print_colores();
//add_hanson($divs_hansome);


//sentencias sql

//$sql = "SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND fecha_culminacion <> 'n' AND codigo='$codigo'";
//$result=mysql_query($sql);

    $sql = "SELECT prc_orden_trabajo.produccion_real FROM  prc_orden_trabajo WHERE codigo = '$codigo'";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $produccion_real = $test['produccion_real'];



    $sql = "SELECT * FROM prc_orden_trabajo_etapas WHERE completo <> 'n' AND codigo_orden_trabajo='$codigo'";

    $result=mysql_query($sql);



    while($test = mysql_fetch_array($result)){

        $a = new EtapaHorasClase();
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
        $hora_estandar = $test2['horas_estandar'];


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



        $sql3 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado
FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo' AND prc_orden_trabajo_etapas.codigo = '$codigo_departamento_etapa'";


        $result3=mysql_query($sql3);


        while($test3 = mysql_fetch_array($result3)){

            $nombre = $test3['nombre'];
            //$cantidad_real = $test3['cantidad'];
            $horas = $test3['horas'];
            $codigo_detalle = $test3['codigo'];
            $codigo_empleado = $test3['codigo_empleado'];



            $sql4 = "SELECT SUM(mno_new_concepto_empleado.total) as total FROM mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE mno_new_concepto_empleado.anhio = '$anhio'
AND mno_new_concepto_empleado.mes = '$mes'
AND mno_new_concepto_empleado.eliminado = 'no'
AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
AND mno_new_concepto_empleado.codigo_concepto <> '58'";


            $result4 = mysql_query($sql4);
            $test4 = mysql_fetch_array($result4);
            $sueldo_actual = $test4['total'];


            $sql4 = "SELECT SUM(mno_new_concepto_empleado.total) as total FROM mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE mno_new_concepto_empleado.anhio = '$anhio_anterior'
AND mno_new_concepto_empleado.mes = '$mes_anterior'
AND mno_new_concepto_empleado.eliminado = 'no'
AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
AND mno_new_concepto_empleado.codigo_concepto <> '58'";


            $result4 = mysql_query($sql4);
            $test4 = mysql_fetch_array($result4);
            $sueldo_anterior = $test4['total'];


            $sql4 = "SELECT
    SUM(mrh_turnos.horatsemana) as total,
	SUM(mrh_turnos.horatsemana)/count(mrh_turnos.horatsemana) as semana
FROM
    mrh_turnoxempleado
INNER JOIN mrh_turnos ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio'
AND mrh_turnoxempleado.codigomes = '$mes'
AND mrh_turnoxempleado.eliminado = 'no'";


            $result4 = mysql_query($sql4);
            $test4 = mysql_fetch_array($result4);
            $horario_actual = $test4['total'];
            $horario_actual_semana = $test4['semana'];

            $sql4 = "SELECT
    SUM(mrh_turnos.horatsemana) as total,
	SUM(mrh_turnos.horatsemana)/count(mrh_turnos.horatsemana) as semana
FROM
    mrh_turnoxempleado
INNER JOIN mrh_turnos ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'
AND mrh_turnoxempleado.eliminado = 'no'";


            $result4 = mysql_query($sql4);
            $test4 = mysql_fetch_array($result4);
            $horario_anterior = $test4['total'];
            $horario_anterior_semana = $test4['semana'];




            //codigo_orden_trabajo codigo_orden_trabajo
            //codigo_etapa codigo_etapa
            //codigo_producto
            //producto_detalle codigo_producto_detalle
            //min_uso_consumo.costo_articulo *
//            $sql4 ="SELECT sum( min_uso_consumo.cantidad_despacho) as suma FROM min_uso_consumo WHERE codigo_orden_produccion='$codigo' AND
//              cod_articulo = '$codigo_detalle' AND codigo_etapa= '$codigo_departamento_etapa'   AND  devolucion = 'n'";
//
//            $result4=mysql_query($sql4);
//
//            $test4 = mysql_fetch_array($result4);
//
//            $cantidad_real = $test4['suma'];
//
//
//            $sql4 = "SELECT * FROM prc_orden_trabajo_detalle_etapa WHERE
//           codigo_orden_trabajo='$codigo'AND codigo_etapa='$codigo_departamento_etapa' AND
//           codigo_producto='$codigo_producto' AND codigo_producto_detalle='$codigo_detalle'";
//
//            $result4=mysql_query($sql4);
//
//            $test4 = mysql_fetch_array($result4);
//
//            //$cantidad_estandar = $test4['cantidad_estandar'];
//
//            $valor_estandar = $test4['valor_standar'];
//
//
//
//            $sql4 = "SELECT * FROM prc_detalle_etapa WHERE codigo_producto ='$codigo_producto' AND
//        codigo_etapa='$codigo_departamento_etapa' AND codigo_producto_detalle='$codigo_detalle'";
//
//            $result4=mysql_query($sql4);
//
//            $test4 = mysql_fetch_array($result4);
//
//            $cantidad_estandar = $test4['cantidad_estandar'];
//
//
//
//
//            $costo_real = $costo * $cantidad_real;


//
//        $sql4 = "SELECT sum() FROM prc_orden_trabajo_detalle_etapa WHERE
//           codigo_orden_trabajo='$codigo'AND codigo_etapa='$codigo_departamento_etapa' AND
//           codigo_producto='$codigo_producto' AND codigo_producto_detalle='$codigo_detalle'";


            $horas_estandar_permitidas = $cantidad_maxima_mensual/$hora_estandar;


            $costo_hora_hombre_efectivo = $sueldo_anterior / $horario_anterior_semana;



            if(isset($_array_information[$nombre])){

                $_array_information[$nombre] = array($horas_estandar_permitidas,($sueldo_anterior/$horario_anterior),$horas,($sueldo_actual/$horario_actual));

            }else if(!isset($_array_information[$nombre])){
                $_array_information[$nombre][0] = $horas_estandar_permitidas;
                $_array_information[$nombre][1] += ($sueldo_anterior/$horario_anterior);
                $_array_information[$nombre][2] += $horas;
                $_array_information[$nombre][3] += ($sueldo_actual/$horario_actual);

            }

        }//llenar array



        $produccion_real_Total = 0;
        $costo_estandar_total = 0;
        $tcrpr_total = 0;
        $cur_total = 0;

        $precio_estandar_hora_total = 0;
        $costo_estandar_unidad_total = 0;
        $hora_total_trabajada_total = 0;
        $costo_unitario_hora_total = 0;
        $costo_total_producion_total = 0;
        $horas_reales_unidad_total = 0;
        $costo_real_unidad_total = 0;
        $variacion_hora_total = 0;
        $variacion_costo_total = 0;

        foreach($_array_information as $key => $value){



            $horas_estandar = $value[0];
            $precio_estandar_hora = round($value[1],2);
            $horas = round($value[2],2);


            $horas_reales_unidad = round($horas / $produccion_real,2);



            $costo_estandar_unidad = round($precio_estandar_hora * $horas_estandar,2);

            $salidad = $horas_estandar;
            $costo_total_produccion = round($horas*$precio_estandar_hora + $horas_estandar*$precio_estandar_hora, 2);

            $variacion_hora = round(($horas_estandar-$horas_reales_unidad),2);

            $IE = 'F';

            if($variacion_hora < 0){
                $IE = 'D';
            }




            $costo_reales_unidad = round($costo_total_produccion / $produccion_real,2);


            $precio_estandar_hora_2 = $precio_estandar_hora * 8;


            $sueldo_actual = round($costo_total_produccion/$horas,2);

            $variacion_costo = round(($costo_estandar_unidad - $costo_reales_unidad ),2);


            $IP = 'F';

            if($variacion_costo < 0){
                $IP = 'D';
            }

            /*totales*/

            $precio_estandar_hora_total += $precio_estandar_hora;
            $costo_estandar_unidad_total += $costo_estandar_unidad;
            $hora_total_trabajada_total += $horas;
            $costo_unitario_hora_total += $sueldo_actual;
            $costo_total_producion_total += $costo_total_produccion;
            $horas_reales_unidad_total += $horas_reales_unidad;
            $costo_real_unidad_total += $costo_reales_unidad;
            $variacion_hora_total += $variacion_hora;
            $variacion_costo_total += $variacion_costo;




     /*       $total[0] += $horas_estandar;//unidad planificada
            $total[1] += $value[1];//cantidad usada real


            //precio estandar
            $costo_estandar = $value[0]*$value[3];

            //$total[5] += $costo_estandar;

            //precio real
            $precio_real = $value[2]/$value[1];

            $precio_real_cal = $precio_real;//precio real;


            $costo_real_cal = ($value[1]*$precio_real_cal) / $produccion_real;//costo real;*/



/*            $total[2] += $precio_real_cal;
            $total[3] += $costo_real_cal;
            $produccion_real_total += $produccion_real;

            $total[4] += $value[3];//valor estandar
            $costo_estandar_total += $costo_estandar;
            $tcrpr_total += ($value[1]*$precio_real_cal);



            $cur =  $precio_real/$produccion_real; //C/U r


            $variarion_unitaria =  $precio_real - $cur ; //Var. U

            $variacion_total = ($value[1]*$precio_real_cal) - $costo_real_cal;
            $total_variacion_total += $variacion_total;
            $cur_total += $cur;
            $variacion_total_unitaria += $variarion_unitaria;*/

            //$produccion_planificada


            //COSTO TOTAL PRODUCCION $costo_total_produccion
            $a->add_info($key
                ,$horas_estandar   //He P/U
                ,$sueldo_actual //C/U h
                ,$costo_total_produccion, //CTP
                $horas_reales_unidad, //Hr P/U-> cantidad_real_unidad
                $costo_reales_unidad,   //Cr P/U
                $precio_estandar_hora, //Ps P/H
                $costo_estandar_unidad,  //Cs P/U
                $horas,     //ht
                $variacion_hora,
                $IE,
                $variacion_costo,
                $IP);
//$costo_real_cal 8

        }

        //$cur = $total[3]/$produccion_real;

        //$variacion_total_unitaria = $total[5] -$cur;

        //$total_variacion_total =  ($total[5]*$produccion_real) - $total[3];

        $IE_TOTAL = 'F';

        if($variacion_hora_total < 0){
            $IE_TOTAL = 'D';
        }

        $IP_TOTAL = 'F';

        if($variacion_costo_total < 0){
            $IP_TOTAL = 'D';
        }


        $a->add_info('Total       ',$horas_estandar,$costo_unitario_hora_total,$costo_total_producion_total,
            $horas_reales_unidad_total,$costo_real_unidad_total,
            $precio_estandar_hora_total,$costo_estandar_unidad_total,$hora_total_trabajada_total,
            $variacion_hora_total,$IE_TOTAL,$variacion_costo_total,$IP_TOTAL);


        $response['js'] .=  $a->print_colores();

        add_hanson($divs_hansome);

    }


    $response['js'] .= "});</script>";




    $salidad .= ' <div id="contenedor_handsontable" >';
    for ($i=0; $i < count($divs_hansome); $i++) {
        $salidad .=$encabezado_tabla[$i]  .$divs_hansome[$i];
    }
    $salidad .= '</div><br/>';



    $response['html'] = $salidad;


    echo json_encode($response);

}


