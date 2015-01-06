<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 22/12/14
 * Time: 11:54 AM
 */

/** PHPExcel_IOFactory */

//var_dump(exec('ls ../../PHPExcel/Classes/PHPExcel/IOFactory.php'));

require_once( '../../PHPExcel/Classes/PHPExcel/IOFactory.php');
require_once('../../clases/Validate.php');
require_once('../../clases/funciones.php');
require_once('../../db.php');

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

for($i = 1 ; $i < count($numerical);$i++){


    $fake_post['codigoalias'] = $numerical[$i]['A'];
    $fake_post['nombre'] = $numerical[$i]['B'];
    $fake_post['inventario'] = $numerical[$i]['C'];
    $fake_post['unidad_medida'] = $numerical[$i]['D'];
    $fake_post['existencia_minima'] = $numerical[$i]['E'];
    $fake_post['existencia_maxima'] = $numerical[$i]['F'];
    $fake_post['fecha_adquisicion'] = '';
    $fake_post['fecha_venciminto'] = '';
    $fake_post['ubicacion'] = $numerical[$i]['G'];
    $fake_post['precio_inicial'] = sanear_numero($numerical[$i]['H']);
    $fake_post['cantidad_inicial'] = sanear_numero($numerical[$i]['I']);
    $fake_post['observacion'] = $numerical[$i]['J'];



    $validation = array(

        array('nombre' => 'nombre',
            'requerida' => true
        ),

        array('nombre' => 'existencia_minima',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => '.'),

        array('nombre' => 'existencia_maxima',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => '.'),


        array('nombre' => 'precio_inicial',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => '.'),



        array('nombre' => 'cantidad_inicial',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => '.'),


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


    $fake_post['codigoalias'] = $numerical[$i]['A'];
    $fake_post['nombre'] = $numerical[$i]['B'];
    $fake_post['inventario'] = $numerical[$i]['C'];
    $fake_post['unidad_medida'] = $numerical[$i]['D'];
    $fake_post['existencia_minima'] = $numerical[$i]['E'];
    $fake_post['existencia_maxima'] = $numerical[$i]['F'];
    $fake_post['fecha_adquisicion'] = '';
    $fake_post['fecha_venciminto'] = '';
    $fake_post['ubicacion'] = $numerical[$i]['G'];
    $fake_post['precio_inicial'] = sanear_numero($numerical[$i]['H']);
    $fake_post['cantidad_inicial'] = sanear_numero($numerical[$i]['I']);
    $fake_post['observacion'] = $numerical[$i]['J'];


    $codigoalias = $fake_post['codigoalias'];
    $nombre = cadena_estetica($fake_post['nombre']);
    $existencia_minima = '';
    $existencia_maxima =  ($fake_post['existencia_maxima'] ==  null) ? '0' :$fake_post['existencia_maxima'];

    $fecha_vencimiento = $fake_post['fecha_venciminto'];
    $fecha_adquisicion = $fake_post['fecha_adquisicion'];
    $ubicacion =  $fake_post['ubicacion'];
    $observacion =  $fake_post['observacion'];
    $unidad_medida_tmp = $fake_post['unidad_medida'];
    $tipo_inventario_tmp = $fake_post['inventario'];
    $imagen = '';



    if($fake_post['existencia_minima'] != ''){
        $existencia_minima = str_replace(',','.',$fake_post['existencia_minima']);
    }else if(is_null($fake_post['existencia_minima'])){
        $existencia_minima = '';
    }


/*    if($_POST['existencia_maxima'] != ''){
        $existencia_maxima = str_replace(',','.',$fake_post['existencia_maxima']);
    }*/


    if($fake_post['precio_inicial'] != ''){
        $precio_inicial = str_replace(',','.',$fake_post['precio_inicial']);
    }else if(is_null($fake_post['precio_inicial'])){
        $precio_inicial = '';
    }


    if($fake_post['cantidad_inicial'] != ''){
        $cantidad_inicial = str_replace(',','.',$fake_post['cantidad_inicial']);
    }else if(is_null($fake_post['cantidad_inicial'])){
        $cantidad_inicial = '';
    }




    $sql = "INSERT INTO min_productos_servicios(codigo_alias,nombre,existencia_minima,existencia_maxima,fecha_vencimiento,fecha_adquisicion,ubicacion,observacion,mco_unidad,inventario,foto_articulo) VALUES
        ('$codigoalias','$nombre','$existencia_minima','$existencia_maxima',
        '$fecha_vencimiento','$fecha_adquisicion','$ubicacion','$observacion','$unidad_medida_tmp','$tipo_inventario_tmp',
        '$imagen');";


    mysql_query($sql) or die('No se pudo guardar la información. min_productos_servicios'.mysql_error());


    /* coloco datos en la tabla valoracion */

    $ultimo_ID = mysql_insert_id();


    if($tipo_inventario_tmp == '12'){
        $cantidad_inicial = 0;
    }

    $promedio_actual = 0;

    if($cantidad_inicial != 0){
        $promedio_actual = $precio_inicial/$cantidad_inicial;
    }

    $sql = "INSERT INTO min_valoracion(codigo_producto,unidades,costo_total,promedio_actual) VALUES ('$ultimo_ID','$cantidad_inicial','".$precio_inicial."','$promedio_actual')";


    $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones '.mysql_error());



    $fecha = fecha_sicap();
    $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha )
VALUES('$ultimo_ID','$cantidad_inicial','".$precio_inicial."','$promedio_actual', '$fecha');
";

    $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());






}




mysql_close($conn);

send_error_redirect(false, "Datos Exportados Correctamente");
die;