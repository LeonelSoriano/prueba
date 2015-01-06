<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 12/12/14
 * Time: 10:59 AM
 */
?>



<?php

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


include_once('../../clases/funciones.php');
include_once('../../clases/ReporteMacro.php');

//var_dump(calculo_entre_fechas_es_mayor('2001-04-01','2004-03-02'));


include_once('../../db.php');




$a = new ReporteMacro();

$extras = array();
$extras['Historial de Compra'] = "";


$a->configure_header(utf8_multiplataforma("Relación de Costo y Gasto"),"asd",'./../../images/empresalogo.jpg');
$ej = function($a){



    $fecha_sicap = fecha_sicap();

    $fecha_sicap_array = explode('-',$fecha_sicap);

    $mes_sicap = $fecha_sicap_array[1];
    $anhio_sicap = $fecha_sicap_array[0];
    $dia_sicap = $fecha_sicap_array[2];

    $anhio_post = $_POST['anhio'];
    $mes_post = $_POST['mes'];


    if(($anhio_sicap == $anhio_post) && ($mes_post == $mes_sicap)){
     //   echo('Actual');
    }else{
     //   echo('Pasado');
    }



    $paso = 10;
    $separacion = 7;
    $a->setLetra('Times', '', 10);
    $a->print_header();

    $sql = "SELECT
    cos_erogaciones.codigo_unidad_erogacion as codigo_unidad_erogacion,
    cos_erogaciones.nombre as nombre
FROM
    cos_erogaciones
        INNER JOIN cos_detalle_erogaciones
    ON cos_detalle_erogaciones.codigo_erogacion = cos_erogaciones.codigo
    WHERE cos_detalle_erogaciones.fecha LIKE '$anhio_post-$mes_post-%'
ORDER BY cos_erogaciones.nombre";


    $sub_total = 0;
    $tota_final = 0;

    $result = mysql_query($sql);

    $tamanhios = array();

    array_push($tamanhios, 40);
    array_push($tamanhios, 18);
    array_push($tamanhios, 20);

    $a->_pdf->SetAligns('L',0);
    $a->_pdf->SetAligns('C',1);
    $a->_pdf->SetAligns('R',2);
    $a->_pdf->setMargenIzquierdo($paso*4);

    $datos_celda_title = array();

    $dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes_post, $anhio_post);

    while($test = mysql_fetch_array($result)){

        $codigo_unidad_erogacion = $test['codigo_unidad_erogacion'];
        $nombre_unidad_erogacion = $test['nombre'];

        $a->print_sub_title($paso,utf8_multiplataforma($nombre_unidad_erogacion));


        $sql2 = '';


        if($codigo_unidad_erogacion == '-1'){
            $sql2 = 'SELECT
   count(*) as cantidad,
	mno_gerencia.codigo as codigo_gerencia,
	mno_gerencia.descripcion as gerencia
from
    mno_gerencia
        INNER JOIN
    mrh_empleado ON mrh_empleado.codigo_departamento = mno_gerencia.codigo
GROUP BY mrh_empleado.codigo_departamento';



        }else{
        $sql2 = "SELECT
mco_unidad_erogacion_detalle.cantidad as cantidad,
mno_gerencia.descripcion as gerencia,
mno_gerencia.codigo as codigo_gerencia
 FROM cos_erogaciones
INNER JOIN mno_gerencia ON mno_gerencia.codigo = cos_erogaciones.codigo_departamento
INNER JOIN mco_unidad_erogacion ON mco_unidad_erogacion.codigo = cos_erogaciones.codigo_unidad_erogacion
INNER JOIN mco_unidad_erogacion_detalle on
mco_unidad_erogacion_detalle.codigo_unidad_erogacion = mco_unidad_erogacion.codigo
AND mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
WHERE cos_erogaciones.codigo_unidad_erogacion = $codigo_unidad_erogacion";

        }


        $result2 = mysql_query($sql2);

        while($test2 = mysql_fetch_array($result2)){

            $cantidad = $test2['cantidad'];
            $gerencia = $test2['gerencia'];
            $codigo_gerencia = $test2['codigo_gerencia'];

            $sql3 = '';


            if($codigo_unidad_erogacion == '-1'){
                $sql3 = "SELECT sum(cos_detalle_erogaciones.costo) as costo FROM cos_detalle_erogaciones
INNER JOIN cos_erogaciones
ON cos_erogaciones.codigo = cos_detalle_erogaciones.codigo_erogacion
WHERE cos_erogaciones.codigo_unidad_erogacion = '$codigo_unidad_erogacion'
    AND cos_detalle_erogaciones.fecha LIKE '$anhio_post-$mes_post-%'";


            }else {
                $sql3 = "SELECT
   sum(cos_detalle_erogaciones.costo) as costo
FROM
    cos_erogaciones
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = cos_erogaciones.codigo_departamento
        INNER JOIN
    mco_unidad_erogacion ON mco_unidad_erogacion.codigo = cos_erogaciones.codigo_unidad_erogacion
        INNER JOIN
    mco_unidad_erogacion_detalle ON mco_unidad_erogacion_detalle.codigo_unidad_erogacion = mco_unidad_erogacion.codigo
        AND mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
	INNER JOIN cos_detalle_erogaciones ON cos_detalle_erogaciones.codigo_erogacion = cos_erogaciones.codigo
WHERE cos_erogaciones.codigo_unidad_erogacion = $codigo_unidad_erogacion
AND cos_detalle_erogaciones.fecha LIKE '$anhio_post-$mes_post-%'
 ";

            }
            $result3 = mysql_query($sql3);
            $test3 = mysql_fetch_array($result3);
            $costo = $test3['costo'];

            $sql3 = '';

            if($codigo_unidad_erogacion == '-1'){
                $sql3 = "SELECT sum(empleados.cantidad) as cuenta FROM(
SELECT
   count(*) as cantidad
from
    mno_gerencia
        INNER JOIN
    mrh_empleado ON mrh_empleado.codigo_departamento = mno_gerencia.codigo
GROUP BY mrh_empleado.codigo_departamento
) as empleados";

            }else{
                $sql3 = "SELECT
 sum(mco_unidad_erogacion_detalle.cantidad) as cuenta
 FROM cos_erogaciones
INNER JOIN mno_gerencia ON mno_gerencia.codigo = cos_erogaciones.codigo_departamento
INNER JOIN mco_unidad_erogacion ON mco_unidad_erogacion.codigo = cos_erogaciones.codigo_unidad_erogacion
INNER JOIN mco_unidad_erogacion_detalle on
mco_unidad_erogacion_detalle.codigo_unidad_erogacion = mco_unidad_erogacion.codigo
AND mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
WHERE cos_erogaciones.codigo_unidad_erogacion = $codigo_unidad_erogacion";

            }

            $result3 = mysql_query($sql3);
            $test3 = mysql_fetch_array($result3);
            $cuenta = $test3['cuenta'];

            $datos_celda= array();


            if($cantidad != 0) {

                array_push($datos_celda, utf8_multiplataforma($gerencia));
                array_push($datos_celda, utf8_multiplataforma(''));
                array_push($datos_celda,  formatear_ve($costo/$cuenta*$cantidad));
                $sub_total += $costo/$cuenta*$cantidad;

            }else{
                continue;
            }
            $a->print_celda($tamanhios , $datos_celda,false);
            //$a->print_sub_title($paso*3,utf8_multiplataforma($gerencia));


        }
        $a->_pdf->ln($separacion*1   );
        $datos_celda= array();
        array_push($datos_celda, utf8_multiplataforma('Total'));
        array_push($datos_celda, utf8_multiplataforma(''));
        array_push($datos_celda,  formatear_ve($sub_total));
        $a->print_celda($tamanhios , $datos_celda,false);
        $tota_final += $sub_total;
        $sub_total = 0;

        $a->_pdf->ln($separacion*2 );

    }

    $a->print_sub_title($paso,utf8_multiplataforma("Depreciaión"));


    $sub_total = 0;

    $sql4 = "SELECT * FROM mno_gerencia ";

    $result4=mysql_query($sql4);


    $costo_adquisicion_total = 0;
    $depreciacion_total_final = 0;


    $costo_total_reporte = 0;
    $depreciacion_total_reporte = 0;


    $total_depreciacion_departamento = 0;

    while($test4 = mysql_fetch_array($result4)){


        $codigo_departamento = $test4['codigo'];
        $nombre_departamento = $test4['descripcion'];
        $unidad_administrativa = $test4['unidad_administrativa'];


        $sql5 = "SELECT
    Tbl1.nombre_bien,
    Tbl1.codigo_alias,
    Tbl1.costo_adquisicion,
    Tbl1.vida_util,
    Tbl1.fecha_adquisicion,
    Tbl1.valor_rescate,
    Tbl1.depreciacion,
	Tbl1.hora,
	Tbl1.kilometro,
	Tbl1.unidades,
	Tbl1.codigo,
	Tbl1.tipo
FROM
    (SELECT
        nombre_bien as nombre_bien,
            codigo_alias as codigo_alias,
            costo_adquisicion,
            vida_util,
            fecha_adquisicion,
            valor_rescate,
            codigo_depreciacion as depreciacion,
			bie_tipo_basico.horas_trabajadas as hora,
			'0' as kilometro,
			'0' as unidades,
			codigo as codigo,
			'bie_tipo_basico' as tipo
    FROM
        bie_tipo_basico
    WHERE
        bie_tipo_basico.codigo_departamento = '$codigo_departamento'
         AND STR_TO_DATE(bie_tipo_basico.fecha_adquisicion,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'
            UNION SELECT
        nombre_bien as nombre_bien,
            codigo_alias as codigo_alias,
            costo_adquisicion,
            vida_util,
            fecha_adquisicion,
            valor_rescate,
            codigo_depreciacion as depreciacion,
			'0' as hora,
			bie_tipo_vehiculo.kilometros as kilometro,
			'0' as unidades,
			codigo as codigo,
			'bie_tipo_vehiculo' as tipo
    FROM
        bie_tipo_vehiculo
    WHERE
        bie_tipo_vehiculo.codigo_departamento = '$codigo_departamento'
         AND STR_TO_DATE(bie_tipo_vehiculo.fecha_adquisicion,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes' UNION SELECT
        nombre_bien as nombre_bien,
            codigo_alias as codigo_alias,
            costo_adquisicion,
            vida_util,
            fecha_adquisicion,
            valor_rescate,
            codigo_depreciacion as depreciacion,
			bie_tipo_maquinaria.horas_trabajadas as hora,
			'0' as kilometro,
			bie_tipo_maquinaria.unidades_producidas as unidades,
			codigo as codigo,
			'bie_tipo_maquinaria' as tipo
    FROM
        bie_tipo_maquinaria
    WHERE
        bie_tipo_maquinaria.codigo_departamento = '$codigo_departamento'
                AND STR_TO_DATE(bie_tipo_maquinaria.fecha_adquisicion,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'
            ) Tbl1
        WHERE
    tipo = ''
    OR tipo = 'bie_tipo_vehiculo'
    OR tipo = 'bie_tipo_maquinaria'
    OR tipo = 'bie_tipo_basico'
ORDER BY Tbl1.nombre_bien";

        $result5=mysql_query($sql5);

        while($test5 = mysql_fetch_array($result5)){


            $nombre_bien = $test5['nombre_bien'];
            $codigo_alias = $test5['codigo_alias'];
            $costo_adquisicion = $test5['costo_adquisicion'];
            $vida_util = $test5['vida_util'];
            $fecha_adquisicion = $test5['fecha_adquisicion'];
            $valor_rescate = $test5['valor_rescate'];

            $depreciacion_cod = $test5['depreciacion'];
            $horas = $test5['hora'];
            $kilometro = $test5['kilometro'];
            $unidades = $test5['unidades'];
            $codigo = $test5['codigo'];
            $tipo = $test5['tipo'];

            $nombre_depreciacion = '';


            $vida_util_mes = $vida_util * 12;


            $depreciacion = 0;
            $depreciado_label = "Depreciado Totalmente";

            //sacar kilometros


            if($depreciacion_cod == 1){

                $nombre_depreciacion = 'LR';

                $fecha_actual = fecha_sicap();

                if(calculo_entre_anhios($fecha_actual,$fecha_adquisicion)  < $vida_util){

                    $monto_depreciar = $costo_adquisicion - ($costo_adquisicion * $valor_rescate / 100);

                    $anhio_vida_util_formula = $monto_depreciar/$vida_util;

                    $depreciacion_total =  1/12*$anhio_vida_util_formula;

                    $depreciacion = $depreciacion_total;

                    $depreciado_label = "No Depreciado";
                }


            }else if($depreciacion_cod == 7){

                $nombre_depreciacion = 'HT';

                $sql_inside = "SELECT
    sum(bie_unidades_depreciacion.unidades) as total
FROM
    bie_unidades_depreciacion
WHERE bie_unidades_depreciacion.codigo_bien = '$codigo'
                                                                                                                        AND tipo_bien = '$tipo'
AND STR_TO_DATE(bie_unidades_depreciacion.fecha,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'
";

                $result_inside=mysql_query($sql_inside);

                $test_inside = mysql_fetch_array($result_inside);

                $total = $test_inside['total'];


                if($total  < $horas){

                    $monto_depreciar = $costo_adquisicion - ($costo_adquisicion * $valor_rescate / 100);

                    $anhio_vida_util_formula = $monto_depreciar/$horas;

                    $depreciacion_total =  $anhio_vida_util_formula*$total;

                    $depreciacion = $depreciacion_total;

                    $depreciado_label = "No Depreciado";
                }


            }else if($depreciacion_cod == 2){
                $nombre_depreciacion = 'UP';


                $sql_inside = "SELECT
    sum(bie_unidades_depreciacion.unidades) as total
FROM
    bie_unidades_depreciacion
WHERE bie_unidades_depreciacion.codigo_bien = '$codigo'
AND tipo_bien = '$tipo'
AND STR_TO_DATE(bie_unidades_depreciacion.fecha,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'
";

                $result_inside=mysql_query($sql_inside);

                $test_inside = mysql_fetch_array($result_inside);

                $total = $test_inside['total'];


                if($total  < $unidades){

                    $monto_depreciar = $costo_adquisicion - ($costo_adquisicion * $valor_rescate / 100);

                    $anhio_vida_util_formula = $monto_depreciar/$unidades;

                    $depreciacion_total =  $anhio_vida_util_formula*$total;

                    $depreciacion = $depreciacion_total;

                    $depreciado_label = "No Depreciado";
                }



            }else if($depreciacion_cod == 3){
                $nombre_depreciacion = 'KM';


                $sql_inside = "SELECT
    sum(bie_unidades_depreciacion.unidades) as total
FROM
    bie_unidades_depreciacion
WHERE bie_unidades_depreciacion.codigo_bien = '$codigo'
AND tipo_bien = '$tipo'
AND STR_TO_DATE(bie_unidades_depreciacion.fecha,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'
";


                $result_inside=mysql_query($sql_inside);

                $test_inside = mysql_fetch_array($result_inside);

                $total = $test_inside['total'];


                if($total < $kilometro){

                    $monto_depreciar = $costo_adquisicion - $costo_adquisicion * $valor_rescate / 100;

                    $anhio_vida_util_formula = $monto_depreciar/$kilometro;

                    $depreciacion_total =  $anhio_vida_util_formula*$total;

                    $depreciacion = $depreciacion_total;

                    $depreciado_label = "No Depreciado";
                }


            }

            $total_depreciacion_departamento += $depreciacion;


        }//end while $test5

        //edificio

        $sql5 = "SELECT SUM(metros) as total FROM bien_metros_departamento WHERE codigo_departamento = '$codigo_departamento'";

        $result5=mysql_query($sql5);

        $test5 = mysql_fetch_array($result5);

        $total_metros = $test5['total'];


        $sql5 = "SELECT
    nombre_bien, codigo_contable, vida_util, fecha_adquisicion,
	costo_adquisicion,valor_rescate,codigo,mts_edificacion,codigo_contable
FROM
    bie_tipo_activo_principal
    WHERE
        STR_TO_DATE(bie_tipo_activo_principal.fecha_adquisicion,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'";

        $result5=mysql_query($sql5);

        $test5 = mysql_fetch_array($result5);

        $nombre_bien = $test5['nombre_bien'];
        $codigo_alias = $test5['codigo_contable'];
        $vida_util = $test5['vida_util'];
        $fecha_adquisicion = $test5['fecha_adquisicion'];
        $costo_adquisicion = $test5['costo_adquisicion'];
        $valor_rescate = $test5['valor_rescate'];
        $codigo = $test5['codigo'];
        $mts_edificacion = $test5['mts_edificacion'];
        $codigo_contable = $test5['codigo_contable'];


        $nombre_depreciacion = 'LR';

        $depreciacion = 0;

        $fecha_actual = fecha_sicap();
        if(calculo_entre_anhios($fecha_actual,$fecha_adquisicion)  < $vida_util){

            $costo_adquisicion_mts = $costo_adquisicion / $total_metros;

            $monto_depreciar = $costo_adquisicion_mts - ($costo_adquisicion_mts * $valor_rescate / 100);

            $anhio_vida_util_formula = $monto_depreciar/$vida_util;

            $depreciacion_total =  1/12*$anhio_vida_util_formula;

            $depreciacion = $depreciacion_total;

            $depreciado_label = "No Depreciado";


            $total_depreciacion_departamento += $depreciacion;
        }


        $datos_celda= array();
        array_push($datos_celda, utf8_multiplataforma($nombre_departamento));
        array_push($datos_celda, utf8_multiplataforma(''));
        array_push($datos_celda,  formatear_ve($total_depreciacion_departamento));
        $a->print_celda($tamanhios , $datos_celda,false);
        $sub_total += $total_depreciacion_departamento;
        $total_depreciacion_departamento = 0;
    }

    $a->_pdf->ln($separacion);
    $datos_celda= array();
    array_push($datos_celda, utf8_multiplataforma('Total'));
    array_push($datos_celda, utf8_multiplataforma(''));
    array_push($datos_celda,  formatear_ve($sub_total));
    $a->print_celda($tamanhios , $datos_celda,false);
    $tota_final += $sub_total;
    $sub_total = 0;



    $a->_pdf->ln($separacion*2);
    $datos_celda= array();
    array_push($datos_celda, utf8_multiplataforma('Total Final'));
    array_push($datos_celda, utf8_multiplataforma(''));
    array_push($datos_celda,  formatear_ve($tota_final));
    $a->print_celda($tamanhios , $datos_celda,false);



};

$a->interfaz($ej($a));
$a->exec();
