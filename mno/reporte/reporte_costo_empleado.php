<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/12/14
 * Time: 10:11 AM
 */

include_once('../../clases/ReporteMacro.php');
include_once('../../clases/funciones.php');


include_once('../../db.php');



$tipo_post = '1';

$a = new ReporteMacro();

$extras = array();
$extras['Historial de Compra'] = "";



$anhio = $_POST['anhio'];
$mes = $_POST['mes'];
$codigoempleado = $_POST['cedulaempleado'];


$total = 'no';
if(isset($_POST['total'])){
    $total = 'si';
}

$semana_1 = 'no';
if(isset($_POST['semana_1'])){
    $semana_1 = 'si';
}

$semana_2 = 'no';
if(isset($_POST['semana_2'])){
    $semana_2 = 'si';
}

$semana_3 = 'no';
if(isset($_POST['semana_3'])){
    $semana_3 = 'si';
}

$semana_4 = 'no';
if(isset($_POST['semana_4'])){
    $semana_4 = 'si';
}

$semana_5 = 'no';
if(isset($_POST['semana_5'])){
    $semana_5 = 'si';
}



$a->configure_header("Reporte Costo Empleado"  ,"asd",'./../../images/empresalogo.jpg');
$ej = function($a,$anhio,$mes,$codigoempleado,$total_check,$semana_1,$semana_2,$semana_3,$semana_4,$semana_5){

    if($mes < 10){
        $mes = '0' . $mes;
    }

    $sql_empleado = "";
    $numero_lunes = count(getMondays($anhio,$mes));
    if( $codigoempleado != '-1' ){
        $sql_empleado = " AND mrh_empleado_backup.codigo_empleado = '$codigoempleado' ";
    }


    $total_final = 0;
    $total_semana1_final = 0;
    $total_semana2_final = 0;
    $total_semana3_final = 0;
    $total_semana4_final = 0;
    $total_semana5_final = 0;


    $a->print_header();
    $paso = 6;
    $separacion = 7;


    $a->setLetra('Times', '', 10);

    $a->_pdf->ln($separacion);
    $a->print_sub_title($paso*2,$anhio . '-' . codigo_to_mes($mes) );
    $a->_pdf->ln($separacion);

    $sql = "SELECT
    mrh_empleado_backup.cedula as cedula,
	mrh_empleado_backup.primernombre as primernombre,
	mrh_empleado_backup.primerapellido as primerapellido,
	mno_gerencia.descripcion as departamento,
	mrh_cargo.descripcion as cargo,
	mrh_cargo.tipo_cargo as tipo_cargo,
	mrh_empleado_backup.codigo_empleado as codigo_empleado

FROM
    mrh_empleado_backup
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = mrh_empleado_backup.codigo_departamento
INNER JOIN mrh_cargo
ON mrh_cargo.codigo = mrh_empleado_backup.codigocargo
WHERE
    fecha LIKE '$anhio-$mes%' ". $sql_empleado ."
ORDER BY mrh_empleado_backup.cedula";



    $result=mysql_query($sql);
    $a->_pdf->setMargenIzquierdo(0);
    while($test = mysql_fetch_array($result)){


        $primer_nombre = $test['primernombre'];
        $primerapellido = $test['primerapellido'];
        $cedula = $test['cedula'];
        $departamento = $test['departamento'];
        $cargo = $test['cargo'];
        $tipo_cargo = $test['tipo_cargo'];
        $codigo_empleado = $test['codigo_empleado'];

        $a->print_sub_title($paso*2,'C.I.:' . $cedula );
        $a->_pdf->ln($separacion);
        $a->print_sub_title($paso*3,'Empleado: ' . utf8_multiplataforma($primer_nombre) . ' ' . utf8_multiplataforma($primerapellido) );
        $a->_pdf->ln($separacion);
        $a->print_sub_title($paso*4,'Departamento: ' . utf8_multiplataforma($departamento) );
        $a->_pdf->ln($separacion);
        $a->print_sub_title($paso*5,'Cargo: ' . utf8_multiplataforma($cargo) );
        $a->_pdf->ln($separacion);
        $a->print_sub_title($paso*6,'Tipo Mano de Obra: ' . utf8_multiplataforma($tipo_cargo) );
        $a->_pdf->ln($separacion*2);



        $sub_total_empleado = 0;
        $sub_total_semana1_empleado = 0;
        $sub_total_semana2_empleado = 0;
        $sub_total_semana3_empleado = 0;
        $sub_total_semana4_empleado = 0;
        $sub_total_semana5_empleado = 0;


        $sql2 = "SELECT * FROM mno_new_concepto_tipo";

        $result2=mysql_query($sql2);

        while($test2 = mysql_fetch_array($result2)){

            $codigo_concepto_tipo = $test2['codigo'];
            $nombre_comcepto_tipo = $test2['nombre'];

            $a->setLetra('Times', 'B', 10);
            $a->print_sub_title($paso*7, utf8_multiplataforma($nombre_comcepto_tipo) );
            $a->setLetra('Times', '', 10);
            $a->_pdf->ln($separacion);

            $sql3 = "SELECT
    mno_new_concepto.nombre as nombre,
	mno_new_concepto_empleado.semana_1 as semana1,
	mno_new_concepto_empleado.semana_2 as semana2,
	mno_new_concepto_empleado.semana_3 as semana3,
	mno_new_concepto_empleado.semana_4 as semana4,
	mno_new_concepto_empleado.semana_5 as semana5,
	mno_new_concepto_empleado.total as total
FROM
    mno_new_concepto
	INNER JOIN mno_new_concepto_empleado
	ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto.tipo_concepto = '$codigo_concepto_tipo'
        AND mno_new_concepto.codigo <> 58 and
		mno_new_concepto_empleado.mes = '$mes'
AND mno_new_concepto_empleado.anhio = '$anhio'
AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
AND mno_new_concepto_empleado.total <> '0'
";

            $result3=mysql_query($sql3);

            $sub_total = 0;
            $sub_total_semana1 = 0;
            $sub_total_semana2 = 0;
            $sub_total_semana3 = 0;
            $sub_total_semana4 = 0;
            $sub_total_semana5 = 0;
            $a->_pdf->SetAligns('L',0);
            $a->_pdf->SetAligns('R',1);
            $a->_pdf->SetAligns('R',2);
            $a->_pdf->SetAligns('R',3);
            $a->_pdf->SetAligns('R',4);
            $a->_pdf->SetAligns('R',5);
            $a->_pdf->SetAligns('R',6);
            $a->_pdf->setMargenIzquierdo(($paso * -1)+6 );
            $tamanhios_title = array();

            array_push($tamanhios_title,40);



            if($semana_1 == 'si'){
                array_push($tamanhios_title,25);
            }
            if($semana_2 == 'si') {
                array_push($tamanhios_title, 25);
            }
            if($semana_3 == 'si') {
                array_push($tamanhios_title, 25);
            }
            if($semana_4 == 'si') {
                array_push($tamanhios_title, 25);
            }


            $datos_celda_title = array();

            array_push($datos_celda_title,utf8_multiplataforma( ''));


            if($semana_1 == 'si') {
                array_push($datos_celda_title, 'Semana 1');
            }
            if($semana_2 == 'si') {
                array_push($datos_celda_title, 'Semana 2');
            }
            if($semana_3 == 'si') {
                array_push($datos_celda_title, 'Semana 3');
            }
            if($semana_4 == 'si') {
                array_push($datos_celda_title, 'Semana 4');
            }

            if($numero_lunes == 5 && $semana_5 == 'si'){
                array_push($tamanhios_title,25);
                array_push($datos_celda_title,'Semana 5');
            }

            if($total_check == 'si'){
                array_push($datos_celda_title,'Total');
            }

            if($total_check == 'si') {
                array_push($tamanhios_title, 25);
            }

            $a->print_celda($tamanhios_title, $datos_celda_title,false);
            $a->_pdf->ln($separacion );

            while($test3 = mysql_fetch_array($result3)){

                $nombre_concepto = $test3['nombre'];
                $semana1 = $test3['semana1'];
                $semana2 = $test3['semana2'];
                $semana3 = $test3['semana3'];
                $semana4 = $test3['semana4'];
                $semana5 = $test3['semana5'];
                $total = $test3['total'];

                $a->_pdf->SetAligns('L',0);
                $a->_pdf->SetAligns('R',1);
                $a->_pdf->SetAligns('R',2);
                $a->_pdf->SetAligns('R',3);
                $a->_pdf->SetAligns('R',4);
                $a->_pdf->SetAligns('R',5);
                $a->_pdf->SetAligns('R',6);
                $a->_pdf->setMargenIzquierdo($paso*1);


                $tamanhios = array();


                array_push($tamanhios,35);



                if($semana_1 == 'si'){
                    array_push($tamanhios,25);
                }
                if($semana_2 == 'si') {
                    array_push($tamanhios, 25);
                }
                if($semana_3 == 'si') {
                    array_push($tamanhios, 25);
                }
                if($semana_4 == 'si') {
                    array_push($tamanhios, 25);
                }

                $datos_celda = array();

                array_push($datos_celda,utf8_multiplataforma( $nombre_concepto));


                if($semana_1 == 'si') {
                    array_push($datos_celda, formatear_ve($semana1));
                }
                if($semana_2 == 'si') {
                    array_push($datos_celda, formatear_ve($semana2));
                }
                if($semana_3 == 'si') {
                    array_push($datos_celda, formatear_ve($semana3));
                }
                if($semana_4 == 'si') {
                    array_push($datos_celda, formatear_ve($semana4));
                }

                if($numero_lunes == 5 && $semana_5 == 'si'){
                    array_push($tamanhios,25);
                    array_push($datos_celda,formatear_ve($semana5));
                }

                if($total_check == 'si') {
                    array_push($tamanhios, 25);
                }

                if($total_check == 'si'){
                    array_push($datos_celda,formatear_ve($total));
                }



                $a->print_celda($tamanhios, $datos_celda,false);
                $a->_pdf->ln($separacion - 3);


                $sub_total += $total;
                $sub_total_semana1 += $semana1;
                $sub_total_semana2 += $semana2;
                $sub_total_semana3 += $semana3;
                $sub_total_semana4 += $semana4;
                $sub_total_semana5 += $semana5;

            }//end while test3



            $array_total = array();


            array_push($array_total, 35);


            if($semana_1 == 'si') {
                array_push($array_total, 25);
            }
            if($semana_2 == 'si') {
                array_push($array_total, 25);
            }
            if($semana_3 == 'si') {
                array_push($array_total, 25);
            }
            array_push($array_total,25);


            $array_total_celda = array();

            array_push($array_total_celda,'Total ' . utf8_multiplataforma($nombre_comcepto_tipo));

            if($semana_1 == 'si') {
                array_push($array_total_celda, formatear_ve($sub_total_semana1));
            }
            if($semana_2 == 'si') {
                array_push($array_total_celda, formatear_ve($sub_total_semana2));
            }
            if($semana_3 == 'si') {
                array_push($array_total_celda, formatear_ve($sub_total_semana3));
            }
            if($semana_4 == 'si') {
                array_push($array_total_celda, formatear_ve($sub_total_semana4));
            }




            if($numero_lunes == 5 && $semana_5 == 'si'){
                array_push($array_total,25);
                array_push($array_total_celda,formatear_ve($sub_total_semana5));
            }

            if($total_check == 'si') {
                array_push($array_total, 25);
            }

            if($total_check == 'si') {
                array_push($array_total_celda, formatear_ve($sub_total));
            }

            $sub_total_empleado += $sub_total;
            $sub_total_semana1_empleado += $sub_total_semana1;
            $sub_total_semana2_empleado += $sub_total_semana2;
            $sub_total_semana3_empleado += $sub_total_semana3;
            $sub_total_semana4_empleado += $sub_total_semana4;
            $sub_total_semana5_empleado += $sub_total_semana5;


            $a->setLetra('Times', 'B', 10);
            $a->print_celda($array_total, $array_total_celda
            ,false);
            $a->setLetra('Times', '', 10);


            $sub_total = 0;
            $sub_total_semana1 = 0;
            $sub_total_semana2 = 0;
            $sub_total_semana3 = 0;
            $sub_total_semana4 = 0;
            $sub_total_semana5 = 0;

            $a->_pdf->ln($separacion );
        }//while test 2



        $array_total_empleado = array();

        array_push($array_total_empleado,35);

        if($semana_1 == 'si') {
            array_push($array_total_empleado, 25);
        }
        if($semana_2 == 'si') {
            array_push($array_total_empleado, 25);
        }
        if($semana_3 == 'si') {
            array_push($array_total_empleado, 25);
        }
        if($semana_4 == 'si') {
            array_push($array_total_empleado, 25);
        }


        $array_total_celda_empleado = array();

        array_push($array_total_celda_empleado,'Total Empleado' );

        if($semana_1 == 'si') {
            array_push($array_total_celda_empleado, formatear_ve($sub_total_semana1_empleado));
        }
        if($semana_2 == 'si') {
            array_push($array_total_celda_empleado, formatear_ve($sub_total_semana2_empleado));
        }
        if($semana_3 == 'si') {
            array_push($array_total_celda_empleado, formatear_ve($sub_total_semana3_empleado));
        }
        if($semana_4 == 'si') {
            array_push($array_total_celda_empleado, formatear_ve($sub_total_semana4_empleado));

        }

        if($numero_lunes == 5 && $semana_5 == 'si'){
            array_push($array_total_empleado,25);
            array_push($array_total_celda_empleado,formatear_ve($sub_total_semana5_empleado));
        }

        if($total_check == 'si'){
            array_push($array_total_celda_empleado,formatear_ve($sub_total_empleado));
        }

        if($total_check == 'si') {
            array_push($array_total_empleado, 25);
        }

        $total_final += $sub_total_empleado;
        $total_semana1_final += $sub_total_semana1_empleado;
        $total_semana2_final += $sub_total_semana2_empleado;
        $total_semana3_final += $sub_total_semana3_empleado;
        $total_semana4_final += $sub_total_semana4_empleado;
        $total_semana5_final += $sub_total_semana5_empleado;




        $sub_total_empleado = 0;
        $sub_total_semana1_empleado = 0;
        $sub_total_semana2_empleado = 0;
        $sub_total_semana3_empleado = 0;
        $sub_total_semana4_empleado = 0;
        $sub_total_semana5_empleado = 0;
        $a->setLetra('Times', 'B', 10);
        $a->print_celda($array_total_empleado, $array_total_celda_empleado
            ,false);
        $a->setLetra('Times', '', 10);

        $a->_pdf->ln($separacion*4);
        $a->_pdf->setMargenIzquierdo(0);
    }



    $array_total_fin = array();

    array_push($array_total_fin,35);

    if($semana_1 == 'si'){
        array_push($array_total_fin,25);
    }
    if($semana_2 == 'si') {
        array_push($array_total_fin, 25);
    }
    if($semana_3 == 'si') {
        array_push($array_total_fin, 25);
    }
    if($semana_4 == 'si') {
        array_push($array_total_fin, 25);
    }


    $array_total_celda_total = array();

    array_push($array_total_celda_total,'Total Costo' );


    if($semana_1 == 'si') {
        array_push($array_total_celda_total, formatear_ve($total_semana1_final));
    }
    if($semana_2 == 'si') {
        array_push($array_total_celda_total, formatear_ve($total_semana2_final));
    }
    if($semana_3 == 'si') {
        array_push($array_total_celda_total, formatear_ve($total_semana3_final));
    }
    if($semana_4   == 'si') {
        array_push($array_total_celda_total, formatear_ve($total_semana4_final));
    }



    if($numero_lunes == 5 && $semana_5 == 'si'){
        array_push($array_total_fin,25);
        array_push($array_total_celda_total,formatear_ve($total_semana5_final));
    }

    if($total_check == 'si') {
        array_push($array_total_fin, 25);
    }

    if($total_check == 'si'){
        array_push($array_total_celda_total,formatear_ve($total_final));
    }

    $a->setLetra('Times', 'B', 10);
    $a->print_celda($array_total_fin, $array_total_celda_total
        ,false);
    $a->setLetra('Times', '', 10);

};

$a->interfaz($ej($a,$anhio,$mes,$codigoempleado,$total,$semana_1,$semana_2,$semana_3,$semana_4,$semana_5));
$a->exec();
