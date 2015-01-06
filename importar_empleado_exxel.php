<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 22/12/14
 * Time: 11:54 AM
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



$numerical = array_values($objPHPExcel->getActiveSheet()->toArray(null,true,true,true));


$fake_post = array();

for($i = 1 ; $i < count($numerical);$i++){


    $fake_post['cedula'] = $numerical[$i]['A'];
    $fake_post['nacionalidad'] = $numerical[$i]['N'];
    $fake_post['becado'] = $numerical[$i]['B'];
    $fake_post['ficha'] = $numerical[$i]['C'];
    $fake_post['sexo'] = $numerical[$i]['O'];
    $fake_post['primernombre'] = $numerical[$i]['D'];
    $fake_post['fechaingreso'] = $numerical[$i]['P'];
    $fake_post['segundonombre'] = $numerical[$i]['E'];
    $fake_post['fechaegreso'] = $numerical[$i]['Q'];
    $fake_post['primerapellido'] = $numerical[$i]['F'];
    $fake_post['codigocargo'] = $numerical[$i]['R'];
    $fake_post['departamento'] = $numerical[$i]['S'];
    $fake_post['segundoapellido'] = $numerical[$i]['G'];
    $fake_post['estatus'] = $numerical[$i]['T'];
    $fake_post['fechanacimiento'] = $numerical[$i]['H'];
    $fake_post['condicion'] = $numerical[$i]['U'];
    $fake_post['telefono'] = $numerical[$i]['I'];
    $fake_post['tipo_trabajador'] = $numerical[$i]['V'];
    $fake_post['celular'] = $numerical[$i]['J'];
    $fake_post['estadocivil'] = $numerical[$i]['K'];
    $fake_post['codigoperioricidad'] = 0;
    $fake_post['direccion'] = $numerical[$i]['L'];
    $fake_post['vehiculo'] = $numerical[$i]['M'];



    $validation = array(

        array('nombre' => 'primernombre',
            'requerida' => true),

        array('nombre' => 'segundonombre',
            'requerida' => false),

        array('nombre' => 'primerapellido',
            'requerida' => true,
            'regla' => 'letter'),

        array('nombre' => 'segundoapellido',
            'requerida' => false,
            'regla' => 'letter'),

        array('nombre' => 'fechaingreso',
            'requerida' => true),

        array('nombre' => 'cedula',
            'requerida' => true,
            'regla' => 'number')

    );



    $validated = new Validate($validation,$fake_post);
    $validated->validate();


    if($validated->getIsError()){
        mysql_close($conn);
        send_error_redirect(true, "Problemas al cargar Información en la Linea n " . $i);
        die;
    }

}

for($i = 1 ; $i < count($numerical);$i++){



    $fake_post['cedula'] = $numerical[$i]['A'];
    $fake_post['nacionalidad'] = $numerical[$i]['N'];
    $fake_post['becado'] = $numerical[$i]['B'];
    $fake_post['ficha'] = $numerical[$i]['C'];
    $fake_post['sexo'] = $numerical[$i]['O'];
    $fake_post['primernombre'] = cadena_estetica($numerical[$i]['D']);
    $fake_post['fechaingreso'] = $numerical[$i]['P'];
    $fake_post['segundonombre'] = cadena_estetica($numerical[$i]['E']);
    $fake_post['fechaegreso'] = $numerical[$i]['Q'];
    $fake_post['primerapellido'] = cadena_estetica($numerical[$i]['F']);
    $fake_post['codigocargo'] = $numerical[$i]['R'];
    $fake_post['departamento'] = $numerical[$i]['S'];
    $fake_post['segundoapellido'] = cadena_estetica($numerical[$i]['G']);
    $fake_post['estatus'] = $numerical[$i]['T'];
    $fake_post['fechanacimiento'] = $numerical[$i]['H'];
    $fake_post['condicion'] = $numerical[$i]['U'];
    $fake_post['telefono'] = $numerical[$i]['I'];
    $fake_post['tipo_trabajador'] = $numerical[$i]['V'];
    $fake_post['celular'] = $numerical[$i]['J'];
    $fake_post['estadocivil'] = $numerical[$i]['K'];
    $fake_post['codigoperioricidad'] = 0;
    $fake_post['direccion'] = $numerical[$i]['L'];
    $fake_post['vehiculo'] = $numerical[$i]['M'];


    $cedula=$fake_post['cedula'];
    $ficha=$fake_post['ficha'];
    $primernombre=  $fake_post['primernombre'];
    $segundonombre= $fake_post['segundonombre'];
    $primerapellido= $fake_post['primerapellido'];
    $segundoapellido= $fake_post['segundoapellido'];
    $fechanacimiento= $fake_post['fechanacimiento'];
    $telefono=$fake_post['telefono'];
    $celular=$fake_post['celular'];
    $estadocivil=$fake_post['estadocivil'];
    $becado=$fake_post['becado'];
    $sexo=$fake_post['sexo'];
    $fechaingreso=$fake_post['fechaingreso'];
    $fechaegreso=$fake_post['fechaegreso'];
    $codigocargo=$fake_post['codigocargo'];
    $estatus=$fake_post['estatus'];
    $condicion=$fake_post['condicion'];
    $codigoperioricidad=$fake_post['codigoperioricidad'];
    $direccionhabitacion=$fake_post['direccion'];
    $tipo_trabajador = $fake_post['tipo_trabajador'];
    $nacionalidad = $fake_post['nacionalidad'];
    $departamento=$fake_post['departamento'];
    $vehiculo = $fake_post['vehiculo'];


    $sql = "SELECT count(*) as total FROM mrh_empleado WHERE  mrh_empleado.cedula = '$cedula' AND mrh_empleado.nacionalidad = '$nacionalidad'";


    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    if( strcmp($test['total'],'0')  ){
        $a = $test['total'];

        mysql_close($conn);
        send_error_redirect(true, "El Empleado ya Existe");
        die;
    }

    $imagen = '';

    $sql = "insert into mrh_empleado(cedula,ficha,primernombre,segundonombre,primerapellido,segundoapellido,
					fechanacimiento,telefono,celular,estadocivil,becado,sexo,fechaingreso,fechaegreso,
						codigocargo,estatus,condicion,codigoperioricidad,direccionhabitacion,codigo_departamento,vehiculo,nacionalidad,tipo_trabajador,foto)
                                                      values('$cedula','$ficha','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$fechanacimiento',
							'$telefono','$celular','$estadocivil','$becado','$sexo','$fechaingreso','$fechaegreso','$codigocargo','$estatus','$condicion',
								'$codigoperioricidad','$direccionhabitacion','$departamento','$vehiculo','$nacionalidad','$tipo_trabajador','$imagen')";
    //echo $sql;
    //exit;
    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());



}




mysql_close($conn);

send_error_redirect(false, "Datos Exportados Correctamente");
die;