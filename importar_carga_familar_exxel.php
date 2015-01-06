<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 26/12/14
 * Time: 02:46 PM
 */



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


if (file_exists('import_'. $target_file)) {
    unlink('import_'. $target_file);
}



$fake_post = array();



//array (size=10)
//  'id' => string '1' (length=1)
//  'cedula' => string '123' (length=3)
//  'primernombre' => string 'leonel' (length=6)
//  'segundonombre' => string 'soriano' (length=7)
//  'primerapellido' => string 'mavare' (length=6)
//  'segundoapellido' => string 'soriano' (length=7)
//  'fechanacimiento' => string '2014-12-10' (length=10)
//  'parentesco' => string 'M' (length=1)
//  'estudios' => string 'G' (length=1)
//  'submit' => string 'Agregar Cargar' (length=14)
//


for($i = 1 ; $i < count($numerical);$i++){


    $fake_post['cedula_empleado'] = $numerical[$i]['A'];
    $fake_post['cedula'] = $numerical[$i]['B'];
    $fake_post['primernombre'] = $numerical[$i]['C'];
    $fake_post['segundonombre'] = $numerical[$i]['D'];
    $fake_post['primerapellido'] = $numerical[$i]['E'];
    $fake_post['segundoapellido'] = $numerical[$i]['F'];
    $fake_post['fechanacimiento'] = $numerical[$i]['G'];



    $validation = array(

        array('nombre' => 'cedula',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'primernombre',
            'requerida' => true,
            'regla' => 'letter'),

        array('nombre' => 'segundonombre',
            'requerida' => false,
            'regla' => 'letter'),

        array('nombre' => 'primerapellido',
            'requerida' => true,
            'regla' => 'letter'),

        array('nombre' => 'segundoapellido',
            'requerida' => false,
            'regla' => 'letter'),

        array('nombre' => 'fechanacimiento',
            'requerida' => true
        )

    );

    $validated = new Validate($validation,$fake_post);
    $validated->validate();

    if($validated->getIsError()){

        mysql_close($conn);
        send_error_redirect(true, "Problemas al cargar Información en la Linea n " . $i);
        die;

    }



}



for($i = 1 ; $i < count($numerical);$i++) {

    $cedula=$numerical[$i]['B'];

    $primernombre=$numerical[$i]['C'];;
    $segundonombre=$numerical[$i]['D'];;
    $primerapellido=$numerical[$i]['E'];;
    $segundoapellido=$numerical[$i]['F'];;
    $fechanacimiento=$numerical[$i]['G'];;
    $parentesco=$numerical[$i]['H'];;
    $estudios=$numerical[$i]['I'];;

    $fake_post['cedula_trabajador'] = $numerical[$i]['A'];

    $cedula_trabajador = $fake_post['cedula_trabajador'];


    $sql = "SELECT codigo FROM mrh_empleado WHERE cedula='$cedula_trabajador'";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $codigo_empleado_hi = '';


    if (isset($test['codigo'])) {
        $codigo_empleado_hi = $test['codigo'];
        $fake_post['codigo_empleado_hi'] = $codigo_empleado_hi;
    } else {
        mysql_close($conn);
        send_error_redirect(true, "Problemas al cargar Información no existe la cedula " . $cedula);
        die;
    }



    $sql = "insert into mrh_carga(cedulaempleado,cedula,primernombre,segundonombre,primerapellido,
                            segundoapellido,fechanacimiento,parentesco,estudios)
                values ('$codigo_empleado_hi','$cedula','$primernombre','$segundonombre','$primerapellido',
                        '$segundoapellido','$fechanacimiento','$parentesco','$estudios')";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


}


mysql_close($conn);
send_error_redirect(false, "Datos Exportados Correctamente");
die;