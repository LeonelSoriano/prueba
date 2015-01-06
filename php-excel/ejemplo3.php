<?php
//error_reporting(E_ALL ^ E_NOTICE);
require_once ('excel_reader2.php');

include_once('../clases/funciones.php');
include_once('../db.php');

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read('b.xls');
$asd = 0;

function cambiar_mes($mes){

    if($mes == 'Aug'){
        return  '08';
    }else if($mes == 'May'){
        return  '05';
    }else if($mes == 'Oct'){
        return '10';
    }else if($mes == 'Jun'){
        return '06';

    }else if($mes == 'Dec'){
        return '12';

    }else if($mes == 'Feb'){
        return '02';

    }else if($mes == 'Jul'){
        return '07';
    }else if($mes == 'Apr'){
        return '04';
    }else if($mes == 'Jan'){
        return '01';
    }else if($mes == 'Sep'){
        return '09';
    }else if($mes == 'Mar'){
        return  '03';
    }else if($mes == 'Nov'){
        return '11';
    }
    else{
        return $mes;
    }



}

function tranform_anhio ($anhio){


    if($anhio >= 0 && $anhio <= 30){
        return '20' . $anhio;
    }else{
        return '19'. $anhio;
    }
}

//echo("<table>");
//
//
//for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
//    echo("<tr>");
//    for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
//        echo("<td>".$data->sheets[0]['cells'][$i][$j] ."</td>");
//    }
//    echo("</tr>");
//
//}
//echo("</table>");

//$sql = "insert into mrh_empleado(cedula,ficha,primernombre,segundonombre,primerapellido,segundoapellido,
//					fechanacimiento,telefono,celular,estadocivil,becado,sexo,fechaingreso,fechaegreso,
//						codigocargo,estatus,condicion,codigoperioricidad,direccionhabitacion,codigo_departamento,vehiculo,nacionalidad,tipo_trabajador,foto)
//                                                      values('$cedula','$ficha','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$fechanacimiento',
//							'$telefono','$celular','$estadocivil','$becado','$sexo','$fechaingreso','$fechaegreso','$codigocargo','$estatus','$condicion',
//								'$codigoperioricidad','$direccionhabitacion','$departamento','$vehiculo','$nacionalidad','$tipo_trabajador','$imagen')";


//$sql = "insert into mrh_empleado(
//					,,,
//						,,,,,,,,,foto)
//                                                      values('$cedula','$ficha','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$fechanacimiento',
//							'$telefono','$celular','$estadocivil','$becado','$sexo','$fechaingreso','$fechaegreso','$codigocargo','$estatus','$condicion',
//								'$codigoperioricidad','$direccionhabitacion','$departamento','$vehiculo','$nacionalidad','$tipo_trabajador','$imagen')";



header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

//require_once('./min/until/SubirFoto.php');
//include('./clases/Validate.php');



for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {


    $sql_pre = '';

    $sql_post = "";


    $cedula= $data->sheets[0]['cells'][$i][1];

    $ficha= $data->sheets[0]['cells'][$i][2];

    $primernombre=  cadena_estetica($data->sheets[0]['cells'][$i][3]);


    $segundonombre= cadena_estetica($data->sheets[0]['cells'][$i][4]);


    $primerapellido= cadena_estetica($data->sheets[0]['cells'][$i][5]);
    $segundoapellido= cadena_estetica($data->sheets[0]['cells'][$i][6]);




    $time = strtotime($data->sheets[0]['cells'][$i][7]);
    $newformat = date('Y-m-d',$time);

    $fechanacimiento= $newformat;



    $telefono= $data->sheets[0]['cells'][$i][8];
    $celular= $data->sheets[0]['cells'][$i][9];


    $edo_civil = $data->sheets[0]['cells'][$i][10];
    $estadocivil= $edo_civil[0];


    $edo_sexo = $data->sheets[0]['cells'][$i][11];
    $sexo = $edo_sexo[0];



    $time = strtotime($data->sheets[0]['cells'][$i][12]);
    $newformat = date('Y-m-d',$time);

    $fechaingreso = $newformat;



    $codigocargo = cadena_estetica($data->sheets[0]['cells'][$i][13]);

    $sql = "SELECT codigo FROM mrh_cargo WHERE  descripcion = '$codigocargo'";


    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $codigocargo = $test['codigo'];



    //$newDate = date("d-m-Y", strtotime($originalDate));echo($newDate);die;


    $direccionhabitacion= $data->sheets[0]['cells'][$i][14];




    $becado='no';


    $fechaegreso= ' ';

    $estatus= '1';
    $condicion= 'N';
    $codigoperioricidad= '0';


    $tipo_trabajador = ' ';


    $nacionalidad = 'V';

    $departamento= '3';

    $vehiculo = 'no';


   // $subirFoto = new SubirFoto($_FILES['imagen'],'./img_empleados/');
    //$subirFoto->cargarFoto();
    $imagen = '';



    $sql = "insert into mrh_empleado(cedula,ficha,primernombre,segundonombre,primerapellido,segundoapellido,
					fechanacimiento,telefono,celular,estadocivil,becado,sexo,fechaingreso,fechaegreso,
						codigocargo,estatus,condicion,codigoperioricidad,direccionhabitacion,codigo_departamento,vehiculo,nacionalidad,tipo_trabajador,foto)
                                                      values('$cedula','$ficha','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$fechanacimiento',
							'$telefono','$celular','$estadocivil','$becado','$sexo','$fechaingreso','$fechaegreso','$codigocargo','$estatus','$condicion',
								'$codigoperioricidad','$direccionhabitacion','$departamento','$vehiculo','$nacionalidad','$tipo_trabajador','$imagen')";

    //exit;
    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());




}
