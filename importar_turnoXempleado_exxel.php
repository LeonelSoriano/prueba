<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 26/12/14
 * Time: 12:38 PM
 */

/** PHPExcel_IOFactory */

//var_dump(exec('ls ../../PHPExcel/Classes/PHPExcel/IOFactory.php'));

require_once( './PHPExcel/Classes/PHPExcel/IOFactory.php');
require_once('./clases/Validate.php');
require_once('./clases/funciones.php');
require_once('./db.php');

$objReader = new PHPExcel_Reader_Excel5();
//	$objReader = new PHPExcel_Reader_Excel2007();
//	$objReader = new PHPExcel_Reader_Excel2003XML();
//	$objReader = new PHPExcel_Reader_OOCalc();
//	$objReader = new PHPExcel_Reader_SYLK();
//	$objReader = new PHPExcel_Reader_Gnumeric();
//	$objReader = new PHPExcel_Reader_CSV();
$objPHPExcel = $objReader->load($tmp_file);

$objPHPExcel->setActiveSheetIndex(0);

$numerical = array_values($objPHPExcel->getActiveSheet()->toArray(null,true,true,true));

$fake_post = array();


for($i = 4 ; $i < count($numerical);$i++){

    $cedula = $numerical[$i]['A'];

    $sql = "SELECT codigo FROM mrh_empleado WHERE cedula = $cedula";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);


    if(!isset($test['codigo'])){

        mysql_close($conn);
        send_error_redirect(true, "Empelado no Existe en la Base de Datos " . $cedula);
        die;
    }

}



for($i = 4 ; $i < count($numerical);$i++){

    $cedula = $numerical[$i]['A'];

    $codigomes = $numerical[1]['B'];

    if($codigomes < 10){
        $codigomes .= '0' . $codigomes;
    }


    $anhio = $numerical[1]['A'];


    $sql = "SELECT codigo FROM mrh_empleado WHERE cedula = $cedula";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $fake_post['codigo_hi'] = $numerical[$i]['A'];

    $cedulaempleado = $test['codigo'];

    $sql = "SELECT
    count(*) as total
FROM
    mrh_turnoxempleado
WHERE
    mrh_turnoxempleado.cedulaempleado = '$cedulaempleado'
        AND mrh_turnoxempleado.codigomes = '$codigomes'
        AND mrh_turnoxempleado.anhio = '$anhio' AND mrh_turnoxempleado.eliminado = 'no'";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);


    $total = $test['total'];

    if ($total != "0") {
        mysql_close($conn);
        $a = $test['total'];
        send_error_redirect(true, "El Empleado ya Esta Asignado En este Mes");
        die;
    }

    $numero_lunes = getMondays($anhio,$codigomes);


    $codigoturno1 = $numerical[$i]['B'];
    $codigoturno2 = $numerical[$i]['C'];
    $codigoturno3 = $numerical[$i]['D'];
    $codigoturno4 = $numerical[$i]['E'];
    $codigoturno5 = $numerical[$i]['F'];


    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                 VALUES ('$cedulaempleado','$codigomes','1','$codigoturno1','$anhio')";
    //echo $sql;
    mysql_query($sql);


    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                 VALUES ('$cedulaempleado','$codigomes','2','$codigoturno2','$anhio')";
    //echo $sql;
    mysql_query($sql);


    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                 VALUES ('$cedulaempleado','$codigomes','3','$codigoturno3','$anhio')";
    //echo $sql;
    mysql_query($sql);


    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                 VALUES ('$cedulaempleado','$codigomes','4','$codigoturno4','$anhio')";
    //echo $sql;
    mysql_query($sql);



    if($numero_lunes == 5){

        $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                         VALUES ('$cedulaempleado','$codigomes','5','$codigoturno5','$anhio')";
        //echo $sql;
        mysql_query($sql);
    }

}



mysql_close($conn);

send_error_redirect(false, "Datos Exportados Correctamente");
die;