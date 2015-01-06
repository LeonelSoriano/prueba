<?php

include_once('../../clases/Seguridad.php');
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
$a = new Seguridad();

$a->chekear_session();

/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 04/12/14
 * Time: 10:52 AM
 */


include_once('../../clases/funciones.php');
include_once('../../clases/ReporteMacro.php');

//var_dump(calculo_entre_fechas_es_mayor('2001-04-01','2004-03-02'));


include_once('../../db.php');



$tipo_post = '1';

$fecha_actual = fecha_sicap();

$a = new ReporteMacro();

$extras = array();
$extras['Historial de Compra'] = "";

$codigo_depatamento =  $_POST['codigo_departamento'];
$mes_post =  $_POST['mes'];
$anhio_post =  $_POST['anhio'];

$sql_departamento = '';

if($codigo_depatamento != '*'){
    $sql_departamento = ' WHERE mno_gerencia.codigo ='. $codigo_depatamento;
}


$a->configure_header("Reporte Activos/Bienes"  ,"asd",'./../../images/empresalogo.jpg');
$ej = function($a,$sql_departamento,$mes_post,$anhio_post){



    $depreciacion_opcion = $_POST['depreciacion'];
    $paso = 10;
    $separacion = 7;
    $a->setLetra('Times', '', 10);
    $a->print_header();

    $sql = "SELECT * FROM mno_gerencia "  . $sql_departamento;

    $result=mysql_query($sql);


    $costo_adquisicion_total = 0;
    $depreciacion_total_final = 0;


    $costo_total_reporte = 0;
    $depreciacion_total_reporte = 0;

    $dias_mes = cal_days_in_month(CAL_GREGORIAN, $mes_post, $anhio_post);


    while($test = mysql_fetch_array($result)){

        $codigo_departamento = $test['codigo'];
        $nombre_departamento = $test['descripcion'];
        $unidad_administrativa = $test['unidad_administrativa'];


        $a->_pdf->ln($separacion );

        $a->print_sub_title($paso,utf8_multiplataforma($unidad_administrativa));
        if($depreciacion_opcion != 'on'){
            $a->_pdf->setMargenIzquierdo($paso*3);
        }
        $a->_pdf->ln($separacion );

        $a->print_sub_title($paso*2,utf8_multiplataforma($nombre_departamento));

        $a->_pdf->ln($separacion);

        $primero = true;
        $vehiculo = $_POST['vehiculo'];
        $basico = $_POST['basico'];
        $maquinaria = $_POST['maquinaria'];
        $principal = $_POST['principal'];


        $sql_where = "";
        if($vehiculo == 'on'){

            $sql_where .= " OR tipo = 'bie_tipo_vehiculo' ";

        }


        if($maquinaria == 'on'){

            $sql_where .= " OR tipo = 'bie_tipo_maquinaria' ";

        }

        if($basico == 'on'){

            $sql_where .= " OR  tipo = 'bie_tipo_basico' ";

        }

        $sql2 = "SELECT
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
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'
         UNION SELECT
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

        WHERE tipo = ''
$sql_where
ORDER BY Tbl1.nombre_bien";

        $result2=mysql_query($sql2);

        $tamanhios = array();

        array_push($tamanhios,38);
        if($depreciacion_opcion == 'on') {
            array_push($tamanhios, 18);
            array_push($tamanhios, 12);
            array_push($tamanhios, 19);
            array_push($tamanhios, 24);
            array_push($tamanhios, 20);
            array_push($tamanhios, 20);
            array_push($tamanhios, 20);
        }else{
            array_push($tamanhios, 35);
        }
        array_push($tamanhios, 20);


        $datos_celda_title = array();


        $a->_pdf->SetAligns('C',0);
        $a->_pdf->SetAligns('C',1);
        $a->_pdf->SetAligns('C',2);
        $a->_pdf->SetAligns('C',3);
        $a->_pdf->SetAligns('C',4);
        $a->_pdf->SetAligns('C',5);
        $a->_pdf->SetAligns('C',6);
        $a->_pdf->SetAligns('C',7);
        $a->_pdf->SetAligns('C',8);


        array_push($datos_celda_title,utf8_multiplataforma("Nombre"));
        if($depreciacion_opcion == 'on') {
            array_push($datos_celda_title, utf8_multiplataforma("Ficha"));
            array_push($datos_celda_title, utf8_multiplataforma("Tipo"));
            array_push($datos_celda_title, utf8_multiplataforma("Fecha Adquisición"));
            array_push($datos_celda_title, utf8_multiplataforma("Costo"));
            array_push($datos_celda_title, utf8_multiplataforma("Valor Rescate"));
            array_push($datos_celda_title, utf8_multiplataforma("Vida Util (Año)"));
            array_push($datos_celda_title, utf8_multiplataforma("Vida Util (Mes)"));
        }else{
            array_push($datos_celda_title,'');
        }
        array_push($datos_celda_title,utf8_multiplataforma("Depreciación (Mes)"));




        $a->setLetra('Times', 'B', 8);

        $a->print_celda($tamanhios , $datos_celda_title,false);
        $a->_pdf->ln($separacion -4);

        $a->setLetra('Times', '', 10);

        while($test2 = mysql_fetch_array($result2)){


            if(!isset($test2['nombre_bien']))
                continue;

            $nombre_bien = $test2['nombre_bien'];
            $codigo_alias = $test2['codigo_alias'];
            $costo_adquisicion = $test2['costo_adquisicion'];
            $vida_util = $test2['vida_util'];
            $fecha_adquisicion = $test2['fecha_adquisicion'];
            $valor_rescate = $test2['valor_rescate'];

            $depreciacion_cod = $test2['depreciacion'];
            $horas = $test2['hora'];
            $kilometro = $test2['kilometro'];
            $unidades = $test2['unidades'];
            $codigo = $test2['codigo'];
            $tipo = $test2['tipo'];

            $nombre_depreciacion = '';


            $vida_util_mes = $vida_util * 12;


            $datos_celda = array();


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

            //2014-12-04 -- 2012-12-20
//var_dump($fecha_actual  .' '. $fecha_adquisicion . ' ' . $vida_util);die;

            $a->_pdf->SetAligns('L',0);

            if($depreciacion_opcion == 'on'){
                $a->_pdf->SetAligns('L',2);
            }else{
                $a->_pdf->SetAligns('R',2);
            }


            $a->_pdf->SetAligns('L',1);
            $a->_pdf->SetAligns('L',3);
            $a->_pdf->SetAligns('R',4);
            $a->_pdf->SetAligns('R',5);
            $a->_pdf->SetAligns('R',6);
            $a->_pdf->SetAligns('R',7);
            $a->_pdf->SetAligns('R',8);

            //calculo_entre_fechas_es_mayor('2001-04-01','2004-03-02');

            array_push($datos_celda,utf8_multiplataforma($nombre_bien));

            if($depreciacion_opcion == 'on') {
                array_push($datos_celda, utf8_multiplataforma($codigo_alias));
                array_push($datos_celda, utf8_multiplataforma($nombre_depreciacion));
                array_push($datos_celda, utf8_multiplataforma($fecha_adquisicion));
                array_push($datos_celda, formatear_ve($costo_adquisicion));
                array_push($datos_celda, $valor_rescate);
                array_push($datos_celda, $vida_util);
                array_push($datos_celda, $vida_util_mes);
            }else{
                array_push($datos_celda, '  ');
            }
            array_push($datos_celda,formatear_ve($depreciacion));


            $kilometro_post = $_POST['kilometro'];
            $horas_trabajadas_post = $_POST['horas_trabajadas'];
            $unidades_producidas_post = $_POST['unidades_producidas'];
            $metodo_anhios_post = $_POST['metodo_anhios'];


            if(($depreciacion_cod == 1 && $metodo_anhios_post == 'on') ||
                ($depreciacion_cod == 7 &&  $horas_trabajadas_post == 'on') ||
                ($depreciacion_cod == 2 && $unidades_producidas_post == 'on') ||
                ($depreciacion_cod == 3 &&  $kilometro_post == 'on')){

                $a->print_celda($tamanhios , $datos_celda,false);
                $a->_pdf->ln($separacion -4);
                $costo_adquisicion_total += $costo_adquisicion;
                $depreciacion_total_final += $depreciacion;
            }
        }


        $sql3 = "SELECT SUM(metros) as total FROM bien_metros_departamento WHERE codigo_departamento = '$codigo_departamento'";

        $result3=mysql_query($sql3);

        $test3 = mysql_fetch_array($result3);

        $total_metros = $test3['total'];


        $sql3 = "SELECT
    nombre_bien, codigo_contable, vida_util, fecha_adquisicion,
	costo_adquisicion,valor_rescate,codigo,mts_edificacion,codigo_contable
FROM
    bie_tipo_activo_principal
   WHERE
        STR_TO_DATE(bie_tipo_activo_principal.fecha_adquisicion,
            '%Y-%m-%d') < '$anhio_post-$mes_post-$dias_mes'";

        $result3=mysql_query($sql3);

        $test3 = mysql_fetch_array($result3);

        $nombre_bien = $test3['nombre_bien'];
        $codigo_alias = $test3['codigo_contable'];
        $vida_util = $test3['vida_util'];
        $fecha_adquisicion = $test3['fecha_adquisicion'];
        $costo_adquisicion = $test3['costo_adquisicion'];
        $valor_rescate = $test3['valor_rescate'];
        $codigo = $test3['codigo'];
        $mts_edificacion = $test3['mts_edificacion'];
        $codigo_contable = $test3['codigo_contable'];


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
        }

        $datos_celda = array();

        $vida_util_mes = $vida_util * 12;

        $a->_pdf->SetAligns('L',0);
        if($depreciacion_opcion == 'on'){
            $a->_pdf->SetAligns('L',2);
        }else{
            $a->_pdf->SetAligns('R',2);
        }


        $a->_pdf->SetAligns('L',1);
        $a->_pdf->SetAligns('L',3);
        $a->_pdf->SetAligns('R',4);
        $a->_pdf->SetAligns('R',5);
        $a->_pdf->SetAligns('R',6);
        $a->_pdf->SetAligns('R',7);
        $a->_pdf->SetAligns('R',8);



        array_push($datos_celda,utf8_multiplataforma($nombre_bien));
        if($depreciacion_opcion == 'on') {
            array_push($datos_celda, utf8_multiplataforma($codigo_alias));
            array_push($datos_celda, utf8_multiplataforma($nombre_depreciacion));
            array_push($datos_celda, utf8_multiplataforma($fecha_adquisicion));
            array_push($datos_celda, formatear_ve($costo_adquisicion));
            array_push($datos_celda, $valor_rescate);
            array_push($datos_celda, $vida_util);
            array_push($datos_celda, $vida_util_mes);
        }else{
            array_push($datos_celda, '  ');
        }


        $a->_pdf->SetAligns('L',0);
        if($depreciacion_opcion == 'on'){
            $a->_pdf->SetAligns('L',2);
        }else{
            $a->_pdf->SetAligns('R',2);
        }


        $a->_pdf->SetAligns('L',1);
        $a->_pdf->SetAligns('L',3);
        $a->_pdf->SetAligns('R',4);
        $a->_pdf->SetAligns('R',5);
        $a->_pdf->SetAligns('R',6);
        $a->_pdf->SetAligns('R',7);
        $a->_pdf->SetAligns('R',8);

        array_push($datos_celda,formatear_ve($depreciacion));


        if(!isset($depreciacion_cod))
            continue;

        if($principal == 'on'){


            $metodo_anhios_post = $_POST['metodo_anhios'];

            if($depreciacion_cod == 1 && $metodo_anhios_post == 'on'){
                $a->print_celda($tamanhios , $datos_celda,false);
                $a->_pdf->ln($separacion -4);
                $costo_adquisicion_total += $costo_adquisicion;
                $depreciacion_total_final += $depreciacion;
            }
        }

        $datos_celda_total = array();

        array_push($datos_celda_total,utf8_multiplataforma('Total'));
        if($depreciacion_opcion == 'on') {
            array_push($datos_celda_total, utf8_multiplataforma(' '));
            array_push($datos_celda_total, utf8_multiplataforma(' '));
            array_push($datos_celda_total, utf8_multiplataforma(' '));
            array_push($datos_celda_total, formatear_ve($costo_adquisicion_total));
            array_push($datos_celda_total, ' ');
            array_push($datos_celda_total, ' ');
            array_push($datos_celda_total, ' ');
        }else{
            array_push($datos_celda_total, ' ');
        }
        array_push($datos_celda_total,formatear_ve($depreciacion_total_final));


        $costo_total_reporte += $costo_adquisicion_total;
        $depreciacion_total_reporte += $depreciacion_total_final;

        $costo_adquisicion_total = 0;
        $depreciacion_total_final = 0;



        $a->print_celda($tamanhios , $datos_celda_total,false);
        $a->_pdf->ln(($separacion *2 ));

    }


    $tamanhios = array();

    array_push($tamanhios,38);
    if($depreciacion_opcion == 'on') {
        array_push($tamanhios, 18);
        array_push($tamanhios, 12);
        array_push($tamanhios, 19);
        array_push($tamanhios, 24);
        array_push($tamanhios, 20);
        array_push($tamanhios, 20);
        array_push($tamanhios, 20);
    }else{
        array_push($tamanhios, 60);
    }
    array_push($tamanhios, 20);

    if($depreciacion_opcion != 'on'){
        $a->_pdf->setMargenIzquierdo($paso*4);
    }
    $a->setLetra('Times', 'B', 10);

    $datos_celda_total = array();

    array_push($datos_celda_total,utf8_multiplataforma('Total Reporte'));
    if($depreciacion_opcion == 'on') {
        array_push($datos_celda_total, utf8_multiplataforma(' '));
        array_push($datos_celda_total, utf8_multiplataforma(' '));
        array_push($datos_celda_total, utf8_multiplataforma(' '));
        array_push($datos_celda_total, formatear_ve($costo_total_reporte));
        array_push($datos_celda_total, ' ');
        array_push($datos_celda_total, ' ');
        array_push($datos_celda_total, ' ');
    }else{
        array_push($datos_celda_total, ' ');
    }
    array_push($datos_celda_total,formatear_ve($depreciacion_total_reporte));

    $a->print_celda($tamanhios , $datos_celda_total,false);
};

$a->interfaz($ej($a,$sql_departamento,$mes_post,$anhio_post));
$a->exec();
mysql_close($conn);
