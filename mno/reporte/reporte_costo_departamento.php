<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/01/15
 * Time: 04:42 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once("../../clases/tree.php");




//var_dump($array_depende);


// empiezo

include_once('../../clases/ReporteMacro.php');
include_once('../../clases/funciones.php');


include_once('../../db.php');


$a = new ReporteMacro();

$extras = array();
$extras['Historial de Compra'] = "";




$a->configure_header("Reporte Costo Empleado"  ,"asd",'./../../images/empresalogo.jpg');


$ej = function($a){



    $a->print_header();
    $paso = 6;
    $separacion = 7;


    $a->setLetra('Times', '', 10);


    $tree = new Tree();

    $elements = $tree->get();


    $masters = $elements["masters"];
    $childrens = $elements["childrens"];

    $array_depende = $tree->get_depende($childrens,26);


    $array_tamanhio = array();
    $array_info = array();

    array_push($array_tamanhio,50);
    array_push($array_tamanhio, 40);
    array_push($array_tamanhio, 25);

    $a->_pdf->ln($separacion);
    $a->setLetra('Times', '', 10);


    $a->_pdf->SetAligns('L',0);
    $a->_pdf->SetAligns('L',1);
    $a->_pdf->SetAligns('L',2);

    $a->setLetra('Times', 'B', 10);
    array_push($array_info,'Nombre');
    array_push($array_info,'Cedula' );
    array_push($array_info,'Sueldo' );

    $a->_pdf->setMargenIzquierdo($paso*6);

    $a->print_celda($array_tamanhio, $array_info ,false);
    $a->setLetra('Times', '', 10);
    $a->_pdf->ln($separacion);

    $total_final = 0;
    for($i=0;$i < count($array_depende);$i++){


        $codigo_departamento = $array_depende[$i][1];

        $sql = "SELECT
COUNT(DISTINCT mno_new_concepto_empleado.codigo_empleado) as cuenta

FROM
    mno_new_concepto_empleado INNER JOIN mno_new_concepto
        ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
     INNER JOIN mrh_empleado_backup
     ON mno_new_concepto_empleado.codigo_empleado = mrh_empleado_backup.codigo_empleado
WHERE
    mno_new_concepto_empleado.anhio = '2014'
    AND mno_new_concepto_empleado.mes = '12'
    AND mno_new_concepto_empleado.eliminado = 'no'
    AND mrh_empleado_backup.fecha LIKE '2014-12%'
    AND mrh_empleado_backup.codigo_departamento = '$codigo_departamento'
    AND mno_new_concepto_empleado.codigo_concepto <> '58'
    GROUP BY mno_new_concepto_empleado.codigo_empleado";




        $result=mysql_query($sql);
        $a->_pdf->setMargenIzquierdo(0);


        $test = mysql_fetch_array($result);


        if(!is_numeric($test['cuenta']) )
            continue;




        $a->print_sub_title($paso*2,utf8_multiplataforma($array_depende[$i][0]));
        $a->_pdf->ln($separacion);





        $sql = "SELECT
    SUM(mno_new_concepto_empleado.total) AS total,
    mrh_empleado_backup.primernombre as nombre1,
    mrh_empleado_backup.segundonombre as nombre2,
    mrh_empleado_backup.primerapellido as apellido1,
    mrh_empleado_backup.segundoapellido as apellido2,
    mrh_empleado_backup.cedula as cedula

FROM
    mno_new_concepto_empleado INNER JOIN mno_new_concepto
        ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
     INNER JOIN mrh_empleado_backup
     ON mno_new_concepto_empleado.codigo_empleado = mrh_empleado_backup.codigo_empleado
WHERE
    mno_new_concepto_empleado.anhio = '2014'
    AND mno_new_concepto_empleado.mes = '12'
    AND mno_new_concepto_empleado.eliminado = 'no'
    AND mrh_empleado_backup.fecha LIKE '2014-12%'
    AND mrh_empleado_backup.codigo_departamento = '$codigo_departamento'
    AND mno_new_concepto_empleado.codigo_concepto <> '58'
    GROUP BY mno_new_concepto_empleado.codigo_empleado";




        $result=mysql_query($sql);
        $a->_pdf->setMargenIzquierdo(0);

        $array_info = array();


        $sub_total = 0;



        while($test = mysql_fetch_array($result)){

            $array_info = array();

            $a->_pdf->SetAligns('L',0);
            $a->_pdf->SetAligns('L',1);
            $a->_pdf->SetAligns('R',2);

            $cedula = $test['cedula'];
            $sueldo = $test['total'];
            $nombre1 = $test['nombre1'];
            $apellido1 = $test['apellido1'];


            array_push($array_info,$nombre1 .' '. $apellido1);
            array_push($array_info,$cedula );
            array_push($array_info,formatear_ve($sueldo) );
            $a->_pdf->setMargenIzquierdo($paso*6);
            $a->print_celda($array_tamanhio, $array_info ,false);


            $sub_total +=$sueldo;
        }
        $a->_pdf->ln($separacion);

        $array_info = array();
        array_push($array_info,'Sub total');
        array_push($array_info,' ');
        array_push($array_info,formatear_ve($sub_total));
        $a->print_celda($array_tamanhio, $array_info ,false);

        $total_final += $sub_total;
        $sub_total = 0;

        $a->_pdf->ln($separacion*2);

    }

    $array_info = array();
    array_push($array_info,'Total');
    array_push($array_info,' ');
    array_push($array_info,formatear_ve($total_final));
    $a->print_celda($array_tamanhio, $array_info ,false);



};




$a->interfaz($ej($a));
$a->exec();
mysql_close($conn);