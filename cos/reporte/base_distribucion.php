<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 11/12/14
 * Time: 11:12 AM
 */

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php


include_once('../../clases/funciones.php');
include_once('../../clases/ReporteMacro.php');



include_once('../../db.php');




$a = new ReporteMacro();

$extras = array();
$extras['Historial de Compra'] = "";




$a->configure_header(utf8_multiplataforma( "Base de Distribución")  ,"asd",'./../../images/empresalogo.jpg');
$ej = function($a){
    $paso = 10;
    $separacion = 7;
    $a->setLetra('Times', '', 10);
    $a->print_header();

    $a->_pdf->ln($separacion );
    $sql = "SELECT * FROM mco_unidad_erogacion ORDER BY nombre";

    $tamanhios = array();

    array_push($tamanhios,60);
    array_push($tamanhios, 35);

    $result=mysql_query($sql);

    $total_ronda = 0;
    while($test = mysql_fetch_array($result)){


        $codigo_erogacion = $test['codigo'];
        $nombre_erogacion = $test['nombre'];


        $a->_pdf->ln($separacion );

        $a->print_sub_title($paso,utf8_multiplataforma($nombre_erogacion));

        $a->_pdf->ln($separacion );


        $sql2 = "SELECT

    mno_gerencia.descripcion as nombre_gerencia,
	mco_unidad_erogacion_detalle.cantidad as cantidad
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
     WHERE mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$codigo_erogacion'";

        $result2=mysql_query($sql2);






        $datos_celda_title = array();


        $a->_pdf->SetAligns('C',0);
        $a->_pdf->SetAligns('C',1);


        $a->_pdf->setMargenIzquierdo($paso*4);
        array_push($datos_celda_title,utf8_multiplataforma("Nombre"));
        array_push($datos_celda_title, utf8_multiplataforma("Cantidad"));
        $a->setLetra('Times', 'B', 8);

        $a->print_celda($tamanhios , $datos_celda_title,false);


        $a->setLetra('Times', '', 10);



        while($test2 = mysql_fetch_array($result2)){

            $nombre_gerencia = $test2['nombre_gerencia'];
            $cantidad = $test2['cantidad'];

            $datos_celda = array();


            $a->_pdf->SetAligns('L',0);
            $a->_pdf->SetAligns('R',1);

            array_push($datos_celda,utf8_multiplataforma($nombre_gerencia ));
            array_push($datos_celda, formatear_ve($cantidad) );



            $a->print_celda($tamanhios , $datos_celda,false);

            $total_ronda += $cantidad;

        }

        $sql3 = "SELECT

	sum(mco_unidad_erogacion_detalle.cantidad) as cantidad
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
     WHERE mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$codigo_erogacion'
     AND mno_gerencia.unidad_administrativa = 'productiva'";

        $result3=mysql_query($sql3);

        $test3 = mysql_fetch_array($result3);

        $total_productiva =  $test3['cantidad'];

        $array_total = array();

        array_push($array_total,'');
        array_push($array_total,'' );

        $a->print_celda($tamanhios , $array_total,false);

        $array_total = array();
        array_push($array_total,utf8_multiplataforma('Productiva' ));
        array_push($array_total, formatear_ve($total_productiva) );


        $a->print_celda($tamanhios , $array_total,false);



        $sql3 = "SELECT

	sum(mco_unidad_erogacion_detalle.cantidad) as cantidad
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
     WHERE mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$codigo_erogacion'
     AND mno_gerencia.unidad_administrativa = 'operativa_administrativo'";

        $result3=mysql_query($sql3);

        $test3 = mysql_fetch_array($result3);

        $total_productiva =  $test3['cantidad'];


        $array_total = array();
        array_push($array_total,utf8_multiplataforma('Administrativo' ));
        array_push($array_total, formatear_ve($total_productiva) );

        $a->print_celda($tamanhios , $array_total,false);


        $sql3 = "SELECT

	sum(mco_unidad_erogacion_detalle.cantidad) as cantidad
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
     WHERE mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$codigo_erogacion'
     AND mno_gerencia.unidad_administrativa = 'operativa_venta'";

        $result3=mysql_query($sql3);

        $test3 = mysql_fetch_array($result3);

        $total_productiva =  $test3['cantidad'];




        $array_total = array();
        array_push($array_total,utf8_multiplataforma('Ventas' ));
        array_push($array_total, formatear_ve($total_productiva) );

        $a->print_celda($tamanhios , $array_total,false);



        $sql3 = "SELECT
	sum(mco_unidad_erogacion_detalle.cantidad) as cantidad
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mco_unidad_erogacion_detalle.codigo_departamento = mno_gerencia.codigo
     WHERE mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$codigo_erogacion'
     AND mno_gerencia.unidad_administrativa = 'apoyo'";

        $result3=mysql_query($sql3);

        $test3 = mysql_fetch_array($result3);

        $total_productiva =  $test3['cantidad'];



        $array_total = array();
        array_push($array_total,utf8_multiplataforma('Apoyo' ));
        array_push($array_total, formatear_ve($total_productiva) );

        $a->print_celda($tamanhios , $array_total,false);


        $total_ronda = 0;
        $a->_pdf->ln($separacion *2);

    }


    $a->_pdf->ln($separacion );

    $a->print_sub_title($paso,utf8_multiplataforma('Numero Trabajadores'));

    $a->_pdf->ln($separacion );




    $a->_pdf->SetAligns('C',0);
    $a->_pdf->SetAligns('C',1);


    $datos_celda_title = array();

    array_push($datos_celda_title,utf8_multiplataforma("Nombre"));
    array_push($datos_celda_title, utf8_multiplataforma("Cantidad"));
    $a->setLetra('Times', 'B', 8);

    $a->print_celda($tamanhios , $datos_celda_title,false);

    $a->setLetra('Times', '', 10);


    $sql3 = "SELECT
    mno_gerencia.descripcion as nombre_gerencia,
    count(mrh_empleado.codigo) as total
from
    mrh_empleado
        inner join
    mno_gerencia ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
GROUP BY mno_gerencia.descripcion";

    $result3=mysql_query($sql3);

    $a->_pdf->SetAligns('L',0);
    $a->_pdf->SetAligns('R',1);
    while($test3 = mysql_fetch_array($result3)){
        $nombre_gerencia = $test3['nombre_gerencia'];
        $total = $test3['total'];

        $array_total = array();
        array_push($array_total,utf8_multiplataforma($nombre_gerencia ));
        array_push($array_total, formatear_ve($total) );

        $a->print_celda($tamanhios , $array_total,false);

    }

    $a->_pdf->ln($separacion *2);

    $sql3 = "SELECT
    mno_gerencia.descripcion as nombre_gerencia,
    count(mrh_empleado.codigo) as total
from
    mrh_empleado
        inner join
    mno_gerencia ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'productiva'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Productiva' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);



      $sql3 = "SELECT
    mno_gerencia.descripcion as nombre_gerencia,
    count(mrh_empleado.codigo) as total
from
    mrh_empleado
        inner join
    mno_gerencia ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'operativa_administrativo'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Administrativo' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);



    $sql3 = "SELECT
    mno_gerencia.descripcion as nombre_gerencia,
    count(mrh_empleado.codigo) as total
from
    mrh_empleado
        inner join
    mno_gerencia ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'operativa_venta'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Administrativo' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);



    $sql3 = "SELECT
    mno_gerencia.descripcion as nombre_gerencia,
    count(mrh_empleado.codigo) as total
from
    mrh_empleado
        inner join
    mno_gerencia ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'operativa_venta'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Venta' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);


        $sql3 = "SELECT
    mno_gerencia.descripcion as nombre_gerencia,
    count(mrh_empleado.codigo) as total
from
    mrh_empleado
        inner join
    mno_gerencia ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'apoyo'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Apoyo'));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);


    $a->_pdf->ln($separacion );

    $a->print_sub_title($paso,utf8_multiplataforma('Metros'));

    $a->_pdf->ln($separacion );


    $sql3 = "SELECT
    mno_gerencia.descripcion as nombre,
	bien_metros_departamento.metros as cantidad
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
    ORDER BY mno_gerencia.descripcion";

    $result3=mysql_query($sql3);

    while($test3 = mysql_fetch_array($result3)){

        $nombre = $test3['nombre'];
        $cantidda = $test3['cantidad'];

        $array_total = array();
        array_push($array_total,utf8_multiplataforma($nombre));
        array_push($array_total, formatear_ve($cantidda) );

        $a->print_celda($tamanhios , $array_total,false);
    }

    $a->_pdf->ln($separacion );


    $sql3 = "SELECT
	sum(bien_metros_departamento.metros) as total
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'productiva'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Productiva' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);



    $sql3 = "SELECT
	sum(bien_metros_departamento.metros) as total
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'operativa_administrativo'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Administrativa' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);


    $sql3 = "SELECT
	sum(bien_metros_departamento.metros) as total
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'operativa_venta'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Venta' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);



    $sql3 = "SELECT
	sum(bien_metros_departamento.metros) as total
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'apoyo'";

    $result3=mysql_query($sql3);

    $test3 = mysql_fetch_array($result3);

    $total =  $test3['total'];

    $array_total = array();
    array_push($array_total,utf8_multiplataforma('Apoyo' ));
    array_push($array_total, formatear_ve($total) );

    $a->print_celda($tamanhios , $array_total,false);



};

$a->interfaz($ej($a));
$a->exec();
