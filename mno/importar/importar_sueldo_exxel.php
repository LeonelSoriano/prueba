<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 26/12/14
 * Time: 10:23 AM
 */

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





function get_periocidad($codigo){
    if($codigo == '0'){
        return 0.5;
    }else if($codigo == '1'){
        return 1;
    }else if($codigo == '2'){
        return 2;
    }else if($codigo == '3'){
        return 3;
    }else if($codigo == '4'){
        return 4;
    }else if($codigo == '5'){
        return 6;
    }else if($codigo == '6'){
        return 12;
    }else if($codigo == '7'){
        /* TODO areglar esto de semana */
        return 0.1;
    }else{
        return 1;
    }

}

$fake_post = array();

for($i = 1 ; $i < count($numerical) ;$i++){
//
//
//    $fake_post['anhio'] = $numerical[$i]['B'];
//    $fake_post['sueldo_mensual'] = sanear_numero($numerical[$i]['J']);
//    $fake_post['mes'] = $numerical[$i]['C'];
//
//
//    $validation = array(
//
//
//        array('nombre' => 'anhio',
//            'requerida' => true,
//            'regla' => 'number'),
//
//        array('nombre' => 'sueldo_mensual',
//            'requerida' => true,
//            'regla' => 'float',
//            'tipo' => ',' ),
//
//        array('nombre' => 'mes',
//            'requerida' => true,
//            'regla' => 'number')
//
//    );
//
//    $validated = new Validate($validation,$fake_post);
//    $validated->validate();
//
//
//    if($validated->getIsError()){
//        mysql_close($conn);
//        var_dump($fake_post);
//        echo($i);
//        //send_error_redirect(true, "Problemas al cargar Información en la Linea n " . $i);
//        die;
//    }

}



for($ix = 1 ; $ix < count($numerical);$ix++){



    $fake_post['anhio'] = $numerical[$ix]['B'];
    $fake_post['sueldo_mensual'] = sanear_numero($numerical[$ix]['J']);
    $fake_post['mes'] = $numerical[$ix]['C'];
    $fake_post['cedula'] = $numerical[$ix]['A'];
    $fake_post['cedula_hi'] = $numerical[$ix]['A'];

    $fake_post['semana_mensual'] = 'on';

    if(sanear_numero($numerical[$ix]['E']) == 'si' || sanear_numero($numerical[$ix]['E']) == 'Si')
        $fake_post['bono_eficiencia'] = sanear_numero($numerical[$ix]['D']);

    if(sanear_numero($numerical[$ix]['E']) == 'si' || sanear_numero($numerical[$ix]['E']) == 'Si')
        $fake_post['diferencia_salario'] = sanear_numero($numerical[$ix]['E']);

    $fake_post['sueldo_mensual'] = sanear_numero($numerical[$ix]['J']);
    $fake_post['bono_profesionalizacion'] = sanear_numero($numerical[$ix]['K']);
    $fake_post['bono_responsabilidad'] = sanear_numero($numerical[$ix]['L']);
    $fake_post['vehiculo'] = $numerical[$ix]['M'];
    $fake_post['venta_totales'] = sanear_numero($numerical[$ix]['N']);
    $fake_post['venta_acredito'] = sanear_numero($numerical[$ix]['O']);
    $fake_post['venta_colectivo'] = sanear_numero($numerical[$ix]['P']);
    $fake_post['cobranza'] = sanear_numero($numerical[$ix]['Q']);
    $fake_post['dias_feriado'] = $numerical[$ix]['R'];
    $fake_post['beca_trabajador'] = sanear_numero($numerical[$ix]['S']);
    $fake_post['beca_hijo'] = sanear_numero($numerical[$ix]['T']);
    $fake_post['asistencia_medica_input'] = sanear_numero($numerical[$ix]['U']);
    $fake_post['exta_diurna_semana1'] = $numerical[$ix]['V'];
    $fake_post['exta_diurna_semana2'] = $numerical[$ix]['W'];
    $fake_post['exta_diurna_semana3'] = $numerical[$ix]['X'];
    $fake_post['exta_diurna_semana4'] = $numerical[$ix]['Y'];
    $fake_post['exta_diurna_semana5'] = $numerical[$ix]['Z'];
    $fake_post['exta_nocturna_semana1'] = $numerical[$ix]['AA'];
    $fake_post['exta_nocturna_semana2'] = $numerical[$ix]['AB'];
    $fake_post['exta_nocturna_semana3'] = $numerical[$ix]['AC'];
    $fake_post['exta_nocturna_semana4'] = $numerical[$ix]['AD'];
    $fake_post['exta_nocturna_semana5'] = $numerical[$ix]['AE'];
    $fake_post['cestastiket1'] = $numerical[$ix]['AF'];
    $fake_post['cestastiket2'] = $numerical[$ix]['AG'];
    $fake_post['cestastiket3'] = $numerical[$ix]['AH'];
    $fake_post['cestastiket4'] = $numerical[$ix]['AI'];
    $fake_post['cestastiket5'] = $numerical[$ix]['AJ'];
    $fake_post['dias_feriado_trabajado1'] = $numerical[$ix]['AK'];
    $fake_post['dias_feriado_trabajado2'] = $numerical[$ix]['AL'];
    $fake_post['dias_feriado_trabajado3'] = $numerical[$ix]['AM'];
    $fake_post['dias_feriado_trabajado4'] = $numerical[$ix]['AN'];
    $fake_post['dias_feriado_trabajado5'] = $numerical[$ix]['AO'];

    if(sanear_numero($numerical[$ix]['E']) == 'si' || sanear_numero($numerical[$ix]['E']) == 'Si')
        $fake_post['monto_fijo'] = $numerical[$ix]['AP'];




    $anhio = $fake_post['anhio'];
    $mes = $fake_post['mes'];

    $sueldo_mensual =$fake_post['sueldo_mensual'];


    $cedula = $fake_post['cedula'];


    $sql = "SELECT codigo FROM mrh_empleado WHERE cedula='$cedula'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $codigo_empleado_hi = '';



    if(isset($test['codigo'])){

        $codigo_empleado_hi = $test['codigo'];
        $fake_post['codigo_empleado_hi'] = $codigo_empleado_hi;
    }else{

        mysql_close($conn);

        send_error_redirect(true, "Problemas al cargar Información no existe la cedula " . $ix);
        die;
    }


    $sql = "

            SELECT
    count(*) as total
FROM
    mno_new_concepto_empleado
WHERE
    mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.mes = '$mes'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado_hi';
            ";


    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    if( $test['total'] != '0' ){


        send_error_redirect(true,"Ya has asignado este Mes");die;
    }


    $sql = "

            SELECT
    count(*) as total
FROM
    mrh_turnoxempleado
WHERE
    mrh_turnoxempleado.anhio = '$anhio'
        AND mrh_turnoxempleado.codigomes = '$mes'
        AND mrh_turnoxempleado.cedulaempleado = '$codigo_empleado_hi' AND mrh_turnoxempleado.eliminado = 'no';

            ";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);


    if($test['total'] == '0' ){
        send_error_redirect(true,"Debes asignarle un Turno Primero " . $ix);die;
    }


    include('./divicion1.php');
}




mysql_close($conn);

send_error_redirect(false, "Datos Exportados Correctamente");
die;