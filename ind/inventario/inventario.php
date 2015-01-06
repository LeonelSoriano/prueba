<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 23/12/14
 * Time: 10:09 AM
 */

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


include_once('../../db.php');


$a = new ReporteMacro();

$extras = array();
$extras['Historial de Compra'] = "";


$a->configure_header("Reporte Activos/Bienes"  ,"asd",'./../../images/empresalogo.jpg');


$ej = function($a){

    $paso = 10;
    $separacion = 7;
    $a->setLetra('Times', '', 10);
    $a->print_header();


    $sql = " SELECT
            sum(min_valoracion.unidades*min_valoracion.promedio_actual) AS costo

        FROM
            min_productos_servicios INNER JOIN mco_unidad
                ON mco_unidad.codigo = min_productos_servicios.mco_unidad INNER JOIN min_tipo_inventario
                ON min_tipo_inventario.codigo = min_productos_servicios.inventario INNER JOIN min_valoracion
                ON min_valoracion.codigo = min_productos_servicios.codigo
WHERE
    (
        min_tipo_inventario.codigo = '1'
        OR min_tipo_inventario.codigo = '2'
        OR min_tipo_inventario.codigo = '3'
        OR min_tipo_inventario.codigo = '4'
        OR min_tipo_inventario.codigo = '6'
        OR min_tipo_inventario.codigo = '7'
        OR min_tipo_inventario.codigo = '8'
        OR min_tipo_inventario.codigo = '9'
        OR min_tipo_inventario.codigo = '10'
        OR min_tipo_inventario.codigo = '11'
        OR min_tipo_inventario.codigo = '12'
    ) ";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);
    $suma_total = $test['costo'];


    $result=mysql_query($sql);

    $sql = " SELECT

            min_tipo_inventario.tipo AS Inventario ,
            sum(min_valoracion.unidades*min_valoracion.promedio_actual) AS costo
        FROM
            min_productos_servicios INNER JOIN mco_unidad
                ON mco_unidad.codigo = min_productos_servicios.mco_unidad INNER JOIN min_tipo_inventario
                ON min_tipo_inventario.codigo = min_productos_servicios.inventario INNER JOIN min_valoracion
                ON min_valoracion.codigo = min_productos_servicios.codigo
WHERE
    (
        min_tipo_inventario.codigo = '1'
        OR min_tipo_inventario.codigo = '2'
        OR min_tipo_inventario.codigo = '3'
        OR min_tipo_inventario.codigo = '4'
        OR min_tipo_inventario.codigo = '6'
        OR min_tipo_inventario.codigo = '7'
        OR min_tipo_inventario.codigo = '8'
        OR min_tipo_inventario.codigo = '9'
        OR min_tipo_inventario.codigo = '10'
        OR min_tipo_inventario.codigo = '11'
        OR min_tipo_inventario.codigo = '12'
    ) GROUP BY min_tipo_inventario.tipo";

    $result=mysql_query($sql);


    $a->_pdf->ln($separacion );

    $a->print_sub_title($paso,'Formula = ((Monto)*100)/(Total Inventario)');

    $a->_pdf->ln($separacion );

    $a->_pdf->SetAligns('L',0);
    $a->_pdf->SetAligns('R',1);

    while($test = mysql_fetch_array($result)){

        $Inventario = $test['Inventario'];
        $costo = $test['costo'];

        $a->_pdf->ln($separacion );


        $tamanhios = array();

        array_push($tamanhios,38);
        array_push($tamanhios,38);




        $datos_celda_title = array();
        //$a->print_sub_title($paso*2,utf8_multiplataforma($nombre_inventario) .   .);

        array_push($datos_celda_title, utf8_multiplataforma($Inventario));
        array_push($datos_celda_title, number_format((float)($costo*100)/$suma_total, 2, ',', '.') . '%');

        $a->setLetra('Times', '', 10);

        $a->_pdf->setMargenIzquierdo($paso*3);
        $a->print_celda($tamanhios , $datos_celda_title,false);
    }

};


$a->interfaz($ej($a));
$a->exec();
mysql_close($conn);

















mysql_close($conn);