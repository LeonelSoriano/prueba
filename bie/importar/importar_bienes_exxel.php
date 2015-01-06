<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 28/12/14
 * Time: 02:06 PM
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


    $fake_post['codigo_tipo'] = $numerical[$i]['A'];
    $fake_post['codigo_contable'] = $numerical[$i]['C'];
    $fake_post['vida_util'] = $numerical[$i]['E'];
    $fake_post['costo_adquisicion'] = sanear_numero($numerical[$i]['G']);
    $fake_post['valor_rescate'] = sanear_numero($numerical[$i]['H']);
    $fake_post['monto_depreciar'] = sanear_numero($numerical[$i]['I']);
    $fake_post['fecha_adquisicion'] = sanear_numero($numerical[$i]['F']);
    $fake_post['metodo_depreciacion'] = $numerical[$i]['J'];
    $fake_post['valor_mercado'] = sanear_numero($numerical[$i]['L']);
    $fake_post['valor_actualizado'] = sanear_numero($numerical[$i]['M']);
    $fake_post['departamento_hi'] = $numerical[$i]['D'];
    $fake_post['unidades_producidas'] = $numerical[$i]['N'];
    $fake_post['kilometros'] = sanear_numero($numerical[$i]['O']);
    $fake_post['placa_vehculo'] = $numerical[$i]['S'];

    $tipo = $fake_post['codigo_tipo'];


    if($tipo == 1){//basico

        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true
            ),

            array('nombre' => 'costo_adquisicion',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number',
                'tipo' => ','
            )

        );


        $validated = new Validate($validation,$fake_post);
        $validated->validate();


        if($validated->getIsError()){
            mysql_close($conn);
            send_error_redirect(true, "Problemas al cargar Información en la Linea n " . $i);
            die;
        }




    }else if($tipo == 2)
    {//maquinaria


        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true
            ),

            array('nombre' => 'costo_adquisicion',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),
            array('nombre' => 'unidades_producidas',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number',
                'tipo' => ','
            ),

        );

        $validated = new Validate($validation,$fake_post);
        $validated->validate();


        if($validated->getIsError()){
            mysql_close($conn);
            send_error_redirect(true, "Problemas al cargar Información en la Linea n " . $i);
            die;
        }


    }else if($tipo == 3){//vehiculo


        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true
            ),

            array('nombre' => 'costo_adquisicion',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),


            array('nombre' => 'kilometros',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'kilometros',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'placa_vehculo',
                'requerida' => true
            ),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number',
                'tipo' => ','
            ),

        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();


        if($validated->getIsError()){
            mysql_close($conn);
            send_error_redirect(true, "Problemas al cargar Información en la Linea n " . $i);
            die;
        }


    }else if($tipo == 4){//activo principal

        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'nombre_bien',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'costo_adquisicion',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();

        if(!$validated->getIsError()){

            $nombre_bien = $_POST['nombre_bien'];
            $codigo_alias = $_POST['codigo'];
            $codigo_contable = $_POST['codigo_contable'];
            $vida_util = $_POST['vida_util'];
            $fecha_adquisicion = $_POST['fecha_adquisicion'];
            $costo_adquisicion = $_POST['costo_adquisicion'];
            $valor_rescate = $_POST['valor_rescate'];
            $monto_depreciar = $_POST['monto_depreciar'];
            $metodo_depreciacion = $_POST['metodo_depreciacion'];
            $valor_mercado = $_POST['valor_mercado'];
            $valor_actualizado = $_POST['valor_actualizado'];
            $metros2 = $_POST['mts_edificacion'];


            $sql = "INSERT INTO bie_tipo_activo_principal(nombre_bien,codigo_alias,codigo_contable,
            vida_util,fecha_adquisicion,costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,
            valor_mercado,valor_actualizado,mts_edificacion)
            VALUES
            ('$nombre_bien','$codigo_alias','$codigo_contable','$vida_util',
            '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion',
            '$valor_mercado','$valor_actualizado','$metros2') ";


            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

            $ultimo_ID = mysql_insert_id();

            header('Location: ./agregar_departamento_activo_principal.php?id='.$ultimo_ID.'');


        }else if($validated->getIsError()){
            send_error_redirect(true);
        }


    }




}


for($i = 1 ; $i < count($numerical);$i++){


    $fake_post['codigo_tipo'] = $numerical[$i]['A'];
    $fake_post['nombre_bien'] = $numerical[$i]['B'];
    $fake_post['codigo_contable'] = $numerical[$i]['C'];
    $fake_post['vida_util'] = $numerical[$i]['E'];
    $fake_post['costo_adquisicion'] = sanear_numero($numerical[$i]['G']);
    $fake_post['valor_rescate'] = sanear_numero($numerical[$i]['H']);
    $fake_post['monto_depreciar'] = sanear_numero($numerical[$i]['I']);
    $fake_post['fecha_adquisicion'] = sanear_numero($numerical[$i]['F']);
    $fake_post['metodo_depreciacion'] = $numerical[$i]['J'];
    $fake_post['valor_mercado'] = sanear_numero($numerical[$i]['L']);
    $fake_post['valor_actualizado'] = sanear_numero($numerical[$i]['M']);
    $fake_post['departamento_hi'] = $numerical[$i]['D'];
    $fake_post['unidades_producidas'] = $numerical[$i]['N'];
    $fake_post['kilometros'] = sanear_numero($numerical[$i]['O']);
    $fake_post['placa_vehculo'] = $numerical[$i]['S'];
    $fake_post['horas'] = $numerical[$i]['K'];
    $fake_post['modelo_vehculo'] = $numerical[$i]['P'];
    $fake_post['marca_vehculo'] = $numerical[$i]['Q'];
    $fake_post['tipo_vehculo'] = $numerical[$i]['R'];
    $fake_post['serial_vehculo'] = $numerical[$i]['T'];
    $fake_post['tipo_licencia'] = $numerical[$i]['U'];
    $fake_post['mts_edificacion'] = $numerical[$i]['V'];


    //$existencia_maxima =  ($fake_post['existencia_maxima'] ==  null) ? '0' :$fake_post['existencia_maxima'];

    $tipo = $fake_post['codigo_tipo'];



    if($tipo == 1){//basico



        $nombre_bien = $fake_post['nombre_bien'];
        $codigo_alias = '';
        $codigo_contable = $fake_post['codigo_contable'];
        $departamento_hi = $fake_post['departamento_hi'];
        $vida_util = $fake_post['vida_util'];
        $fecha_adquisicion = $fake_post['fecha_adquisicion'];
        $costo_adquisicion = $fake_post['costo_adquisicion'];
        $valor_rescate = $fake_post['valor_rescate'];
        $monto_depreciar = $fake_post['monto_depreciar'];
        $metodo_depreciacion = $fake_post['metodo_depreciacion'];
        $valor_mercado = $fake_post['valor_mercado'];
        $valor_actualizado = $fake_post['valor_actualizado'];

        $horas = ($fake_post['horas'] ==  null) ? '0' :$fake_post['horas'];


        $sql = "INSERT INTO bie_tipo_basico(nombre_bien,codigo_alias,codigo_contable,codigo_departamento,
        vida_util,fecha_adquisicion,costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,
        valor_mercado,valor_actualizado,horas_trabajadas)
        VALUES
        ('$nombre_bien','$codigo_alias','$codigo_contable','$departamento_hi','$vida_util',
        '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion',
        '$valor_mercado','$valor_actualizado','$horas') ";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    }else if($tipo == 2){//maquinaria



        $nombre_bien = $fake_post['nombre_bien'];
        $codigo_alias = $fake_post['codigo'];
        $codigo_contable = $fake_post['codigo_contable'];
        $departamento_hi = $fake_post['departamento_hi'];
        $vida_util = $fake_post['vida_util'];
        $fecha_adquisicion = $fake_post['fecha_adquisicion'];
        $costo_adquisicion = $fake_post['costo_adquisicion'];
        $valor_rescate = $fake_post['valor_rescate'];
        $monto_depreciar = $fake_post['monto_depreciar'];
        $metodo_depreciacion = $fake_post['metodo_depreciacion'];
        $valor_mercado = $fake_post['valor_mercado'];
        $valor_actualizado = $fake_post['valor_actualizado'];
        $unidades_producidas = $fake_post['unidades_producidas'];
        $horas= ($fake_post['horas'] ==  null) ? '0' :$fake_post['horas'];


        $sql = "INSERT INTO bie_tipo_maquinaria(nombre_bien,codigo_alias,codigo_contable,codigo_departamento,
        vida_util,fecha_adquisicion,costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,
        valor_mercado,valor_actualizado,unidades_producidas,horas_trabajadas)
        VALUES
        ('$nombre_bien','$codigo_alias','$codigo_contable','$departamento_hi','$vida_util',
        '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion',
        '$valor_mercado','$valor_actualizado','$unidades_producidas','$horas')";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    }else if($tipo == 3) {//vehiculo


        $validated = new Validate($validation, $_POST);
        $validated->validate();


        $nombre_bien = $fake_post['nombre_bien'];
        $codigo_alias = $fake_post['codigo'];
        $codigo_contable = $fake_post['codigo_contable'];
        $codigo_departamento = $fake_post['departamento_hi'];
        $vida_util = $fake_post['vida_util'];
        $fecha_adquisicion = $fake_post['fecha_adquisicion'];
        $costo_adquisicion = $fake_post['costo_adquisicion'];
        $valor_rescate = $fake_post['valor_rescate'];
        $monto_depreciar = $fake_post['monto_depreciar'];
        $metodo_depreciacion = $fake_post['metodo_depreciacion'];
        $kilometros = $fake_post['kilometros'];
        $modelo_vehculo = $fake_post['modelo_vehculo'];
        $marca_vehculo = $fake_post['marca_vehculo'];
        $tipo_vehculo = $fake_post['tipo_vehculo'];
        $placa_vehculo = $fake_post['placa_vehculo'];
        $serial_vehculo = $fake_post['serial_vehculo'];
        $tipo_licencia = $fake_post['tipo_licencia'];
        $valor_mercado = $fake_post['valor_mercado'];
        $valor_actualizado = $fake_post['valor_actualizado'];


        $sql = "INSERT INTO bie_tipo_vehiculo
                (nombre_bien,codigo_alias,codigo_contable,codigo_departamento,vida_util,fecha_adquisicion,
                costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,kilometros,modelo_vehculo,
                marca_vehculo,tipo_vehculo,placa_vehculo,serial_vehculo,tipo_licencia,valor_mercado,valor_actualizado)
                VALUES
                ('$nombre_bien','$codigo_alias','$codigo_contable','$codigo_departamento','$vida_util',
                '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion','$kilometros',
                '$modelo_vehculo','$marca_vehculo','$tipo_vehculo','$placa_vehculo','$serial_vehculo','$tipo_licencia',
                '$valor_mercado','$valor_actualizado')";


        mysql_query($sql) or die('No se pudo guardar la información. ' . mysql_error());


    }else if($tipo == 4){//activo principal

            $nombre_bien = $fake_post['nombre_bien'];
            $codigo_alias = $fake_post['codigo'];
            $codigo_contable = $fake_post['codigo_contable'];
            $vida_util = $fake_post['vida_util'];
            $fecha_adquisicion = $fake_post['fecha_adquisicion'];
            $costo_adquisicion = $fake_post['costo_adquisicion'];
            $valor_rescate = $fake_post['valor_rescate'];
            $monto_depreciar = $fake_post['monto_depreciar'];
            $metodo_depreciacion = $fake_post['metodo_depreciacion'];
            $valor_mercado = $fake_post['valor_mercado'];
            $valor_actualizado = $fake_post['valor_actualizado'];
            $metros2 = $fake_post['mts_edificacion'];

            $sql = "INSERT INTO bie_tipo_activo_principal(nombre_bien,codigo_alias,codigo_contable,
            vida_util,fecha_adquisicion,costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,
            valor_mercado,valor_actualizado,mts_edificacion)
            VALUES
            ('$nombre_bien','$codigo_alias','$codigo_contable','$vida_util',
            '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion',
            '$valor_mercado','$valor_actualizado','$metros2') ";


            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

//            $ultimo_ID = mysql_insert_id();
//
//            header('Location: ./agregar_departamento_activo_principal.php?id='.$ultimo_ID.'');

    }



}


mysql_close($conn);

send_error_redirect(false, "Datos Exportados Correctamente");
die;