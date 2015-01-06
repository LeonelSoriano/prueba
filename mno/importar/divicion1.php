<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 09/10/14
 * Time: 08:11 AM
 */


$codigo_empleado = $fake_post['codigo_empleado_hi'];
$cedula = $fake_post['cedula_hi'];
$anhio = $fake_post['anhio'];
$mes = $fake_post['mes'];

$sueldo_mensual = str_replace(',','.',$fake_post['sueldo_mensual']);
$beca_trabajador = str_replace(',','.',$fake_post['beca_trabajador']);
$beca_hijo = str_replace(',','.',$fake_post['beca_hijo']);
$asistencia_medica_input = str_replace(',','.',$fake_post['asistencia_medica_input']);
$venta_totales = str_replace(',','.',$fake_post['venta_totales']);
$venta_acredito = str_replace(',','.',$fake_post['venta_acredito']);
$venta_colectivo = str_replace(',','.',$fake_post['venta_colectivo']);
$cobranza = str_replace(',','.',$fake_post['cobranza']);

$diferencia_salario = 0;



$exta_diurna_semana = array(0,0,0,0,0);
$exta_nocturna_semana = array(0,0,0,0,0);
$cestastiket_semana = array(0,0,0,0,0);

$exta_diurna_semana[0] = str_replace(',','.',$fake_post['exta_diurna_semana1']);
$exta_diurna_semana[1] = str_replace(',','.',$fake_post['exta_diurna_semana2']);
$exta_diurna_semana[2] = str_replace(',','.',$fake_post['exta_diurna_semana3']);
$exta_diurna_semana[3] = str_replace(',','.',$fake_post['exta_diurna_semana4']);

$exta_nocturna_semana[0] = str_replace(',','.',$fake_post['exta_nocturna_semana1']);
$exta_nocturna_semana[1] = str_replace(',','.',$fake_post['exta_nocturna_semana2']);
$exta_nocturna_semana[2] = str_replace(',','.',$fake_post['exta_nocturna_semana3']);
$exta_nocturna_semana[3] = str_replace(',','.',$fake_post['exta_nocturna_semana4']);

$cestastiket_semana[0] = str_replace(',','.',$fake_post['cestastiket1']);
$cestastiket_semana[1] = str_replace(',','.',$fake_post['cestastiket2']);
$cestastiket_semana[2] = str_replace(',','.',$fake_post['cestastiket3']);
$cestastiket_semana[3] = str_replace(',','.',$fake_post['cestastiket4']);


if(isset($fake_post['hora_extra_diurna5'])){
    $exta_diurna_semana[4] = str_replace(',','.',$fake_post['exta_diurna_semana5']);
}

if(isset($fake_post['exta_nocturna_semana5'])){
    $exta_nocturna_semana[4] = str_replace(',','.',$fake_post['exta_nocturna_semana5']);
}

if(isset($fake_post['cestastiket5'])){
    $cestastiket_semana[4] = str_replace(',','.',$fake_post['cestastiket5']);
}

//$cesta_ticket = $fake_post['cesta_ticket'];


$dias_feriado = $fake_post['dias_feriado'];



$dias_feriado_trabajado1 = $fake_post['dias_feriado_trabajado1'];
$dias_feriado_trabajado2 = $fake_post['dias_feriado_trabajado2'];
$dias_feriado_trabajado3 = $fake_post['dias_feriado_trabajado3'];
$dias_feriado_trabajado4 = $fake_post['dias_feriado_trabajado4'];

$dias_feriado_trabajado5 = 0;

if(isset($fake_post['dias_feriado_trabajado5'])){
    $dias_feriado_trabajado5 = $fake_post['dias_feriado_trabajado5'];
}
$dias_feriados_trabajador_result_total = $dias_feriado_trabajado1 +
    $dias_feriado_trabajado2 +
    $dias_feriado_trabajado3 +
    $dias_feriado_trabajado4 +
    $dias_feriado_trabajado5;
//$hora_extra_nocturna = $fake_post['hora_extra_nocturna'];


/*variables*/
/*bonos*/
$bono_antiguedad=0;
$bono_anhio_servicios=0;
$bono_eficiencia=0;
$bono_productividad=0;
$bono_profesionalizacion=0;
$bono_responsabilidad =0;
$bono_vehiculo = 0;
$sum_bono_producido =0;

$numero_lunes = count(getMondays($anhio,$mes));

$sueldo =  str_replace(',','.',$sueldo_mensual);

$sueldo = ($sueldo*12)/52;


$semana_5 = 0;

if(count(getMondays($anhio,$mes)) == 5){
    $semana_5 = $sueldo;
}

//if(>1 && <=)

$mes_sicap = $mes;
if($mes< 10){
    $mes_sicap = '0'.$mes;
}


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 35";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$MONTO_FIJO = $test['valor'];



$sql = "SELECT * FROM mno_new_variables WHERE codigo = 16";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$UNIDAD_TRIBUTARIA = $test['valor'];



$sql = "SELECT * FROM mno_new_variables WHERE codigo = 15";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$CESTA_TICKET = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 12";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$RECARGO_HORAS_EXTRAS_DIURNA = $test['valor'];




$sql = "SELECT * FROM mno_new_variables WHERE codigo = 13";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$RECARGO_HORAS_EXTRAS_NOCTURNAS = $test['valor'];



$sql = "SELECT * FROM mno_new_variables WHERE codigo = 31";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$TURNO_DIARIO = $test['valor'];




$sql = "SELECT * FROM mno_new_variables WHERE codigo = 33";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$TURNO_MIXTO = $test['valor'];



$sql = "SELECT * FROM mno_new_variables WHERE codigo = 34";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$TURNO_NOCTURNO = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 10";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$BONO_NOCTURNO = $test['valor'];



$sql = "SELECT * FROM mno_new_variables WHERE codigo = 24";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$DIAS_BANCARIOS = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 14";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$DIA_FERIADOS = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 1";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$SEGURO_SOCIAL = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 30";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$SALARIO_MINIMO = $test['valor'];



$sql = "SELECT * FROM mno_new_variables WHERE codigo = 2";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$PIE = $test['valor'];



$sql = "SELECT * FROM mno_new_variables WHERE codigo = 3";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$BANAVIH = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 4";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$INCES = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 17";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$CAJA_DE_AHORRO = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 18";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$CUOTA_SINDCAL = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 5";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$UTILIDADES = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 6";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$AGUINALDO = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 7";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$VACACIONAL = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 8";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$POST_VACACIONAL = $test['valor'];


$sql = "SELECT * FROM mno_new_variables WHERE codigo = 9";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$PRESTACIONES_SOCIALES = $test['valor'];




$sql = "SELECT * FROM mno_new_variables WHERE codigo = 11";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$INTERESES_PRESTACIONES = $test['valor'];





/* venta totales */

$sql = "SELECT sum(min_ventas.cantidad * min_ventas.costo_unidad) as venta_totales FROM min_ventas WHERE min_ventas.devolucion = 'n'
AND min_ventas.fecha_venta LIKE '".$anhio."-".$mes_sicap."%'";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$VENTAS_TOTALES = $test['venta_totales'];

/* Venta a credito */

$sql = "SELECT
    sum(min_ventas.costo_unidad * min_ventas.cantidad) as total
FROM
    min_ventas
WHERE
    min_ventas.devolucion = 'n'
        AND min_ventas.fecha_venta LIKE '".$anhio."-".$mes_sicap."%'
	AND min_ventas.venta_credito = 'si'
	AND min_ventas.codigo_empleado = '$codigo_empleado'";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$VENTAS_ACREDITO = $test['total'];

/* venta colectivo */

$sql = "SELECT
    sum(min_ventas.costo_unidad * min_ventas.cantidad) as total
FROM
    min_ventas
WHERE
    min_ventas.devolucion = 'n'
        AND min_ventas.fecha_venta LIKE '".$anhio."-".$mes_sicap."%'
	AND min_ventas.venta_colectivo = 'si'
	AND min_ventas.codigo_empleado = '$codigo_empleado'";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$VENTAS_COLECTIVO = $test['total'];


/*cobranza */

$sql = "SELECT
    sum(min_ventas.costo_unidad * min_ventas.cantidad) as total
FROM
    min_ventas
WHERE
    min_ventas.devolucion = 'n'
        AND min_ventas.fecha_venta LIKE '".$anhio."-".$mes_sicap."%'
	AND min_ventas.cobrado = 'si'
	AND min_ventas.codigo_cobrador = '$codigo_empleado'";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$COBRANZA = $test['total'];



/*numero de mepleado*/

$sql = "SELECT count(*) as valor FROM mrh_empleado";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$NUMERO_EMPLEADOS = $test['valor'];



/* Vacaciopnes*/

$monto_fijo = 0;
if(isset($fake_post['bono_responsabilidad'])){

    $monto_fijo = $MONTO_FIJO;


    $monto_fijo_semana5 = 0;

    $monto_fijo_semana = $monto_fijo/$numero_lunes;

    if($numero_lunes == 5){
        $monto_fijo_semana5 = $monto_fijo_semana;
    }

    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','62','$monto_fijo',
                  '$mes','$anhio',' $monto_fijo_semana',' $monto_fijo_semana',
                  ' $monto_fijo_semana',' $monto_fijo_semana',' $monto_fijo_semana5')";

    $test = mysql_fetch_array($result);

    $result=mysql_query($sql);

}



/*bono_responsabilidad*/
if(isset($fake_post['bono_responsabilidad'])){

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = '3'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $valor =  $test['valor'];
    $tipo_forma_pago=  $test['tipo_forma_pago'];
    $tipo_periocidad =  $test['tipo_periocidad'];


    $valor_periocidad = $valor / get_periocidad($tipo_periocidad);



    $bono_responsabilidad = $valor;

    if($tipo_forma_pago == '1'){
        $bono_responsabilidad = ($sueldo_mensual * $valor)/100;
    }else if($tipo_forma_pago == '2'){
        $bono_responsabilidad = ($UNIDAD_TRIBUTARIA * $valor)/100;

    }

    $bono_responsabilidad_semana = $bono_responsabilidad / $numero_lunes;

    $bono_responsabilidad_semana5 = 0;

    if($numero_lunes == 5){
        $bono_responsabilidad_semana5 = $bono_responsabilidad_semana;
    }

    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','14','$bono_responsabilidad',
                  '$mes','$anhio','$bono_responsabilidad_semana','$bono_responsabilidad_semana',
                  '$bono_responsabilidad_semana','$bono_responsabilidad_semana','$bono_responsabilidad_semana5')";

    $test = mysql_fetch_array($result);

    $result=mysql_query($sql);

}






$sql = "SELECT   sum(prc_orden_trabajador.horas ) as horas,
	sum(prc_orden_trabajador.bono_producido) as bono_producido,
	sum(prc_orden_trabajador.pago_unidades) as pago_unidades,
		sum(prc_orden_trabajo.produccion_real) as produccion_real
		  FROM prc_orden_trabajador
INNER JOIN prc_orden_trabajo
ON  prc_orden_trabajador.codigo_orden_produccion =  prc_orden_trabajo.codigo
WHERE prc_orden_trabajador.eliminado = 'no'
AND
prc_orden_trabajo.eliminada = 'n'
AND
prc_orden_trabajo.fecha_culminacion LIKE '".$anhio."-".$mes_sicap."%'
AND prc_orden_trabajador.codigo_trabajador = '$codigo_empleado'";

$result=mysql_query($sql);




 $test = mysql_fetch_array($result);
    $horas = $test['horas'];
    $bono_producido = $test['bono_producido'];
    $pago_unidades = $test['pago_unidades'];
    $produccion_real = $test['produccion_real'];

//    if($produccion_real < $bono_producido){
        //$sum_bono_producido += ($pago_unidades * $bono_producido);
//    }

//    $sum_horas_trabajadas_produccion += $horas;


$sum_bono_producido = $pago_unidades * $bono_producido;
$sum_bono_producido_semana = ($pago_unidades * $bono_producido) / $numero_lunes;

$sum_bono_producido_semana5 = 0;

if($numero_lunes == 5){
    $sum_bono_producido_semana5 = $sum_bono_producido_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','16','$sum_bono_producido',
                  '$mes','$anhio','$sum_bono_producido_semana','$sum_bono_producido_semana',
                  '$sum_bono_producido_semana','$sum_bono_producido_semana','$sum_bono_producido_semana5')";


$result=mysql_query($sql)  or die('mno_new_concepto 12'.mysql_error());

/*-.-.-.-.--.-.-.-.-*/


/*bono bono_productividad*/
if(isset($fake_post['bono_productividad'])){


    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = '12'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $valor =  $test['valor'];
    $tipo_forma_pago=  $test['tipo_forma_pago'];
    $tipo_periocidad =  $test['tipo_periocidad'];


    $valor_periocidad = $valor / get_periocidad($tipo_periocidad);



    $bono_productividad = $valor ;

    if($tipo_forma_pago == '1'){
        $bono_productividad = ($sueldo_mensual * $valor)/100;
    }else if($tipo_forma_pago == '2'){
        $bono_productividad = ($UNIDAD_TRIBUTARIA * $valor)/100;

    }

    $bono_productividad_semana = $valor_periocidad / $numero_lunes;



    $bono_productividad_semana5 = 0;

    if($numero_lunes == 5){
        $bono_productividad_semana5 = $bono_productividad_semana;
    }

    $bono_productividad = $valor_periocidad;
    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','12','$valor_periocidad',
                  '$mes','$anhio','$bono_productividad_semana',
                  '$bono_productividad_semana','$bono_productividad_semana',
                  '$bono_productividad_semana','$bono_productividad_semana5')";



    $result=mysql_query($sql)  or die('mno_new_concepto 12'.mysql_error());

}else{
    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','12','0',
                  '$mes','$anhio','0',
                  '0','0',
                  '0','0')";

    $result=mysql_query($sql)  or die('mno_new_concepto 12'.mysql_error());


}



//bono_variable
$sql = "SELECT valor,periocidad FROM mno_new_bono_variable WHERE codigo_empleado = '$codigo_empleado'";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$bono_variable = 0;
$periocidad = 1;

if(isset($test['valor'])){
    $bono_variable = $test['valor'];
    $periocidad = $test['periocidad'];
}




$valor_periocidad = $bono_variable / get_periocidad($periocidad);

$bono_variable_costo = $valor_periocidad;

$bono_variable_semana = $valor_periocidad / $numero_lunes;
$bono_variable_semana5 = 0;
if($numero_lunes == 5){
    $bono_variable_semana5 = $bono_variable_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','60','$valor_periocidad',
                  '$mes','$anhio','$bono_variable_semana','$bono_variable_semana',
                  '$bono_variable_semana','$bono_variable_semana','$bono_variable_semana5')";

$test = mysql_fetch_array($result);

$result=mysql_query($sql);

/*final de bono variable*/






/*-.-.-.-.-.-.-.-.-.-..-*/

$sql = "SELECT * FROM mrh_empleado WHERE codigo='$codigo_empleado'";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$ingreso = $test['fechaingreso'];



$hoy = fecha_sicap();

$anhios_trabajo = calculo_entre_anhios($ingreso,$hoy);

$vehiculo = $test['vehiculo'];


$variable_vacaciones = 0;
if($anhios_trabajo > 15){
    $variable_vacaciones = 15 + 15;
}else{
    $variable_vacaciones = 15 + $anhios_trabajo;
}

/*bono vehculo*/
//if($vehiculo == 'si'){

//    $sql2 = "SELECT * FROM mno_new_concepto WHERE codigo = '15'";
//
//    $result2=mysql_query($sql2);
//
//    $test2 = mysql_fetch_array($result2);
//
//    $valor =  $test2['valor'];
//    $tipo_forma_pago=  $test2['tipo_forma_pago'];
//    $tipo_periocidad =  $test2['tipo_periocidad'];


    $vehiculo = $fake_post['vehiculo'];

//    $valor_periocidad = $valor / get_periocidad($tipo_periocidad);
//
//
//    $bono_vehiculo = $valor;
//
//    if($tipo_forma_pago == '1'){
//        $bono_vehiculo = ($sueldo_mensual * $valor)/100;
//    }else if($tipo_forma_pago == '2'){
//        $bono_vehiculo = ($UNIDAD_TRIBUTARIA * $valor)/100;
//
//    }

    $bono_vehiculo_semana = $vehiculo / $numero_lunes;

    $bono_vehiculo_semana5 = 0;

    if($numero_lunes == 5){
        $bono_vehiculo_semana5 = $bono_vehiculo_semana;
    }

    $sql2 = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','15','$vehiculo',
                  '$mes','$anhio','$bono_vehiculo_semana','$bono_vehiculo_semana','$bono_vehiculo_semana',
                  '$bono_vehiculo_semana','$bono_vehiculo_semana5')";

   // $test2 = mysql_fetch_array($result2);

    $result=mysql_query($sql2);
//}else{
//    $sql2 = "INSERT
//                INTO mno_new_concepto_empleado
//                (codigo_empleado,codigo_concepto,total,mes,anhio,
//                semana_1,semana_2,semana_3,semana_4,semana_5)
//                VALUES
//                ('$codigo_empleado','15','$bono_vehiculo',
//                  '$mes','$anhio','0','0','0',
//                  '0','0')";
//
//    //$test2 = mysql_fetch_array($result2);
//
//    $result=mysql_query($sql2);
//}

/*-..-.-.-.-*/

$sql = "SELECT * FROM mco_tabulador_antiguedad";


$result=mysql_query($sql);



$bono_antiguedad = 0;

while($test = mysql_fetch_array($result)){

    if( $anhios_trabajo > $test['paso'] &&  $anhios_trabajo <= $test['referencia']){
        $bono_antiguedad = $test['valor'];

    }

}

$bono_antiguedad_semana = $bono_antiguedad / $numero_lunes;
$bono_antiguedad_semana5 = 0;

if($numero_lunes == 5){
    $bono_antiguedad_semana5 = $bono_antiguedad_semana ;
}

$sql = "SELECT * FROM mco_tabulador_anhio_servicio";

$result=mysql_query($sql);

$bono_anhio_servicios = 0;


while($test = mysql_fetch_array($result)){

    if( $anhios_trabajo > $test['paso'] &&  $anhios_trabajo <= $test['referencia']){
        $bono_anhio_servicios = $test['valor'];

    }

}


//-.-.-.-.-..-.-.-.-..-.-bono_eficiencia.-.-.-.-..-.-.-.






if(isset($fake_post['bono_eficiencia'])){


    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = '11'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $valor =  $test['valor'];
    $tipo_forma_pago=  $test['tipo_forma_pago'];
    $tipo_periocidad =  $test['tipo_periocidad'];


    $valor_periocidad = $valor / get_periocidad($tipo_periocidad);



    $bono_eficiencia = $valor_periocidad;

    if($tipo_forma_pago == '1'){
        $bono_eficiencia = ($sueldo_mensual * $valor)/100;
    }else if($tipo_forma_pago == '2'){
        $bono_eficiencia = ($UNIDAD_TRIBUTARIA * $valor)/100;

    }

    $bono_eficiencia_semana = $bono_eficiencia / $numero_lunes;
    $bono_eficiencia_semana5 = 0;
    if($numero_lunes == 5){
        $bono_eficiencia_semana5 = $bono_eficiencia_semana;
    }

    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','11','$bono_eficiencia',
                  '$mes','$anhio','$bono_eficiencia_semana','$bono_eficiencia_semana',
                  '$bono_eficiencia_semana','$bono_eficiencia_semana','$bono_eficiencia_semana5')";

    $test = mysql_fetch_array($result);

    $result=mysql_query($sql);

}
//.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..

/*bono Profesionalizacion*/
if(isset($fake_post['bono_profesionalizacion'])){

    $bono_profesionalizacion = $fake_post['bono_profesionalizacion'];

//    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = '13'";
//
//    $result=mysql_query($sql);
//
//    $test = mysql_fetch_array($result);
//
//    $valor =  $test['valor'];
//    $tipo_forma_pago=  $test['tipo_forma_pago'];
//    $tipo_periocidad =  $test['tipo_periocidad'];
//
//
//    $valor_periocidad = $valor / get_periocidad($tipo_periocidad);
//


//    $bono_profesionalizacion = $valor;
//
//    if($tipo_forma_pago == '1'){
//        $bono_profesionalizacion = ($sueldo_mensual * $valor)/100;
//    }else if($tipo_forma_pago == '2'){
//        $bono_profesionalizacion = ($UNIDAD_TRIBUTARIA * $valor)/100;
//
//    }

    $bono_profesionalizacion_semana = $bono_profesionalizacion / $numero_lunes;

    $bono_profesionalizacion_semana5 = 0;

    if($numero_lunes == 5){
        $bono_profesionalizacion_semana5 = $bono_profesionalizacion_semana;
    }

    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','13','$bono_profesionalizacion',
                  '$mes','$anhio','$bono_profesionalizacion_semana','$bono_profesionalizacion_semana',
                  '$bono_profesionalizacion_semana','$bono_profesionalizacion_semana',
                  '$bono_profesionalizacion_semana5')";

    //$test = mysql_fetch_array($result);

    $result=mysql_query($sql);

}else{
    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','13','$bono_profesionalizacion',
                  '$mes','$anhio','0','0',
                  '0','0',
                  '0')";

    //$test = mysql_fetch_array($result);

    $result=mysql_query($sql);
}
/*-.-.-.-..-.-.-..--.-.-..*/

/*bono_responsabilidad*/
if(isset($fake_post['bono_responsabilidad'])){

    $bono_responsabilidad = $fake_post['bono_responsabilidad'];
//    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = '14'";
//
//    $result=mysql_query($sql);
//
//    $test = mysql_fetch_array($result);
//
//    $valor =  $test['valor'];
//    $tipo_forma_pago=  $test['tipo_forma_pago'];
//    $tipo_periocidad =  $test['tipo_periocidad'];
//
//    $valor_periocidad =0;
//    if($valor != 0) {
//        $valor_periocidad = $valor / get_periocidad($tipo_periocidad);
//    }
//
//
//
//    $bono_responsabilidad = $valor;
//
//    if($tipo_forma_pago == '1'){
//        $bono_responsabilidad = ($sueldo_mensual * $valor)/100;
//    }else if($tipo_forma_pago == '2'){
//        $bono_responsabilidad = ($UNIDAD_TRIBUTARIA * $valor)/100;
//
//    }

    $bono_responsabilidad_semana = $bono_responsabilidad / $numero_lunes;

    $bono_responsabilidad_semana5 = 0;

    if($numero_lunes == 5){
        $bono_responsabilidad_semana5 = $bono_responsabilidad_semana;
    }

    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','14','$bono_responsabilidad',
                  '$mes','$anhio','$bono_responsabilidad_semana','$bono_responsabilidad_semana',
                  '$bono_responsabilidad_semana','$bono_responsabilidad_semana','$bono_responsabilidad_semana5')";

    //$test = mysql_fetch_array($result);

    $result=mysql_query($sql);

}else{
    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','14','$bono_responsabilidad',
                  '$mes','$anhio','0','0',
                  '0','0','0')";

    $result=mysql_query($sql)  or die('mno_new_concepto 14'.mysql_error());

}

//.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..

//.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..


//$sql = "SELECT * FROM mno_new_concepto WHERE codigo = '15'";
//
//$result=mysql_query($sql);
//
//$test = mysql_fetch_array($result);
//
//$valor = $test['valor'];
//
//$sql = "INSERT
//                INTO mno_new_concepto_empleado
//                (codigo_empleado,codigo_concepto,total,mes,anhio)
//                VALUES
//                ('$codigo_empleado','15','$valor',
//                  '$mes','$anhio')";
//
//$result=mysql_query($sql)  or die('mno_new_concepto 15'.mysql_error());


//.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..



//$sql = "SELECT * FROM mno_new_concepto WHERE codigo = '16'";
//
//$result=mysql_query($sql);
//
//$test = mysql_fetch_array($result);
//
//$valor = $test['valor'];
//
//$sql = "INSERT
//                INTO mno_new_concepto_empleado
//                (codigo_empleado,codigo_concepto,total,mes,anhio)
//                VALUES
//                ('$codigo_empleado','16','$valor',
//                  '$mes','$anhio')";
//
//$result=mysql_query($sql)  or die('mno_new_concepto 16'.mysql_error());


//.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..



$sueldo_costo = ($sueldo*4)+$semana_5;



$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,
                  semana_3,semana_4,semana_5,total,mes,anhio)
                VALUES
                ('$codigo_empleado','1','$sueldo',
                  '$sueldo','$sueldo','$sueldo','$semana_5','$sueldo_costo',
                  '$mes','$anhio')";


$result=mysql_query($sql);


//sueldo real

$sueldo_mensual_semana = ($sueldo_mensual*12/52);

$sueldo_mensual_semana5 = 0;

if($numero_lunes == 5){
    $sueldo_mensual_semana_5 = $sueldo_mensual_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','58','$sueldo_mensual',
                  '$mes','$anhio','$sueldo_mensual_semana','$sueldo_mensual_semana','$sueldo_mensual_semana',
                  '$sueldo_mensual_semana','$sueldo_mensual_semana5')";

$result=mysql_query($sql)  or die('mno_new_concepto 58'.mysql_error());




/*-.-.---.-*/
/* cest_tiket adicional*/


$cesta_ticket_adicional = array(0,0,0,0,0);


$cesta_ticket_adicional[0] = $CESTA_TICKET * $UNIDAD_TRIBUTARIA * $cestastiket_semana[0];
$cesta_ticket_adicional[1] = $CESTA_TICKET * $UNIDAD_TRIBUTARIA * $cestastiket_semana[1];
$cesta_ticket_adicional[2] = $CESTA_TICKET * $UNIDAD_TRIBUTARIA * $cestastiket_semana[2];
$cesta_ticket_adicional[3] = $CESTA_TICKET * $UNIDAD_TRIBUTARIA * $cestastiket_semana[3];
$cesta_ticket_adicional[4] = $CESTA_TICKET * $UNIDAD_TRIBUTARIA * $cestastiket_semana[4];

$cesta_ticket_adicional_total = 0;

for($i = 0;$i < count($cesta_ticket_adicional);$i++){
    $cesta_ticket_adicional_total += $cesta_ticket_adicional[$i];
}



$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,semana_3,
                semana_4,semana_5)
                VALUES
                ('$codigo_empleado','5','$cesta_ticket_adicional_total',
                  '$mes','$anhio','$cesta_ticket_adicional[0]','$cesta_ticket_adicional[1]',
                  $cesta_ticket_adicional[2],$cesta_ticket_adicional[3],$cesta_ticket_adicional[4])";

$result=mysql_query($sql);



$cesta_ticket_ = $CESTA_TICKET * $UNIDAD_TRIBUTARIA * (dias_laborables($anhio,$mes)-$dias_feriado + $dias_feriados_trabajador_result_total);

$cesta_ticket_semana_ = $cesta_ticket_ / $numero_lunes;

$cesta_ticket_semana5_ = 0;

if($numero_lunes == 5){
    $cesta_ticket_semana5_ = $cesta_ticket_semana_;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','52','$cesta_ticket_',
                  '$mes','$anhio','$cesta_ticket_semana_','$cesta_ticket_semana_','$cesta_ticket_semana_'
                  ,'$cesta_ticket_semana_','$cesta_ticket_semana5_')";

$result=mysql_query($sql);




$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','9','$bono_antiguedad',
                  '$mes','$anhio','$bono_antiguedad_semana','$bono_antiguedad_semana',
                  '$bono_antiguedad_semana','$bono_antiguedad_semana','$bono_antiguedad_semana5')";



$result=mysql_query($sql);


$bono_anhio_servicios_semana = $bono_anhio_servicios/$numero_lunes;

$bono_anhio_servicios_semana5 = 0;

if($numero_lunes == 5){
    $bono_anhio_servicios_semana5 = $bono_anhio_servicios_semana;
}

$sql = "INSERT
            INTO mno_new_concepto_empleado
            (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,semana_3,semana_4,semana_5)
            VALUES
            ('$codigo_empleado','10','$bono_anhio_servicios',
              '$mes','$anhio','$bono_anhio_servicios_semana',$bono_anhio_servicios_semana,
              $bono_anhio_servicios_semana,$bono_anhio_servicios_semana,'$bono_anhio_servicios_semana5')";



$result=mysql_query($sql);



$variable_dias_formula = $numero_lunes * 7;

/** Salario normal */
$salario_normal = $sueldo_mensual + $bono_antiguedad + $bono_anhio_servicios + $bono_eficiencia + $bono_productividad + $bono_profesionalizacion + $bono_responsabilidad + $bono_variable_costo + $monto_fijo;





/*bono venta totales*/

//$VENTAS_TOTALES
//$venta_totales

$bono_venta_totales = ($VENTAS_TOTALES * $venta_totales) / 100;

$bono_venta_totales_semana = $bono_venta_totales / $numero_lunes;

$bono_venta_totales_semana5 = 0;

if($numero_lunes == 5){
    $bono_venta_totales_semana5 = $bono_venta_totales_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','21','$bono_venta_totales',
                  '$mes','$anhio','$bono_venta_totales_semana','$bono_venta_totales_semana',
                  '$bono_venta_totales_semana','$bono_venta_totales_semana',
                  '$bono_venta_totales_semana5')";

$result=mysql_query($sql);

/* fina bono venta totales */
/*bono credito*/

$bono_credito = ($venta_acredito * $VENTAS_ACREDITO) / 100;

$bono_credito_semana = $bono_credito / $numero_lunes;

$bono_credito_semana5 = 0;

if($numero_lunes == 5){
    $bono_credito_semana5 = $bono_credito_semana;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','22','$bono_credito',
                  '$mes','$anhio','$bono_credito_semana','$bono_credito_semana',
                  '$bono_credito_semana','$bono_credito_semana',
                  '$bono_credito_semana5')";

$result=mysql_query($sql);

/* final venta de credito */
/* Venta colectivo */

$bono_colectivo = ($venta_colectivo * $VENTAS_COLECTIVO) / 100;


$bono_colectivo_semana = $bono_colectivo / $numero_lunes;

$bono_colectivo_semana5 = 0;

if($numero_lunes == 5){
    $bono_colectivo_semana5 = $bono_credito_semana;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','23','$bono_colectivo',
                  '$mes','$anhio','$bono_colectivo_semana','$bono_colectivo_semana',
                  '$bono_colectivo_semana','$bono_colectivo_semana',
                  '$bono_colectivo_semana5')";

$result=mysql_query($sql);



/*final venta colecctivo*/
/*bono cobranza*/

    $bono_cobranza = ($cobranza * $COBRANZA ) / 100;

    $bono_cobranza_semana = $bono_cobranza / $numero_lunes;

    $bono_cobranza_semana5 = 0;

    if($numero_lunes == 5){
        $bono_cobranza_semana5 = $bono_cobranza_semana;
    }


    $sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','24','$bono_cobranza',
                      '$mes','$anhio','$bono_cobranza_semana','$bono_cobranza_semana',
                      '$bono_cobranza_semana','$bono_cobranza_semana',
                      '$bono_cobranza_semana5')";

    $result=mysql_query($sql);


/*final bono cobranza*/



/*COMICIONES TOTAL*/


$COMICIONES = $bono_cobranza + $bono_colectivo + $bono_credito + $venta_totales;

/* FINAL COMICIONES */


$sql = "SELECT mrh_turnos.horatdiario as horas_turno,
	mrh_turnos.horaextradiurno as horaextradiurno,
	mrh_turnos.horaextranocturno as horaextranocturno,
	mrh_turnos.descripciontipoturno as tipo_turno
              FROM mrh_turnoxempleado
              INNER JOIN mrh_turnos
              ON mrh_turnoxempleado.codigoturno = mrh_turnos.codigo
              INNER JOIN mrh_empleado
              ON mrh_empleado.codigo = mrh_turnoxempleado.cedulaempleado
              WHERE mrh_turnoxempleado.anhio = '$anhio'
              AND mrh_turnoxempleado.codigomes = '$mes'
              AND mrh_empleado.codigo = '$codigo_empleado'
              ORDER BY mrh_turnoxempleado.codigosemana";

$result=mysql_query($sql);

$semana_horas = array(0,0,0,0,0);
$semana_horas_nocturna = array(0,0,0,0,0);
$semana_horas_total = 0;
$semana_horas_total_nocturna = 0;

$indice = 0;

$salario_normal_semanal = $salario_normal / $numero_lunes;


while($test = mysql_fetch_array($result)) {

    $horas_turno = $test['horas_turno'];
    $horaextradiurno = $test['horaextradiurno'];
    $horaextranocturno = $test['horaextranocturno'];


    $tipo_turno = $test['tipo_turno'];

    $formula_tipo_turno = 0;

    if($tipo_turno == 'D'){

        $formula_tipo_turno = $TURNO_DIARIO;

    }else if($tipo_turno == 'M'){

        $formula_tipo_turno = $TURNO_MIXTO;

    }else if($tipo_turno == 'N'){

        $formula_tipo_turno = $TURNO_NOCTURNO;

    }


    $Horas_Extras_Diurnas = $salario_normal_semanal / 7 / $formula_tipo_turno * $RECARGO_HORAS_EXTRAS_DIURNA * $horaextradiurno;

    $Horas_Extras_Nocturna = $salario_normal_semanal / 7 / $formula_tipo_turno * $RECARGO_HORAS_EXTRAS_NOCTURNAS * $horaextranocturno;


    $semana_horas[$indice] = $Horas_Extras_Diurnas;
    $semana_horas_nocturna[$indice] = $Horas_Extras_Nocturna;
    $indice +=1;
}

for($i = 0;$i < count($semana_horas);$i++){
    $semana_horas_total += $semana_horas[$i];
    $semana_horas_total_nocturna += $semana_horas_nocturna[$i];
}





/*BOnos nocturnos y diurnos*/

$sql = "SELECT
    mrh_turnos.bononocsemanal as bononocturno,
	mrh_turnos.descripciontipoturno as desripcio_turno,
	mrh_turnos.bononocdiario as diario
              FROM mrh_turnoxempleado
              INNER JOIN mrh_turnos
              ON mrh_turnoxempleado.codigoturno = mrh_turnos.codigo
              INNER JOIN mrh_empleado
              ON mrh_empleado.codigo = mrh_turnoxempleado.cedulaempleado
              WHERE mrh_turnoxempleado.anhio = '$anhio'
              AND mrh_turnoxempleado.codigomes = '$mes'
              AND mrh_empleado.codigo = '$codigo_empleado'
              AND mrh_turnoxempleado.eliminado = 'no'
              ORDER BY mrh_turnoxempleado.codigosemana";



$bono_nocturno_semanal = array(0,0,0,0,0);

$suma_indice_bono = 0;

$indice_bono_nocturno = 0;

$result=mysql_query($sql);

while($test = mysql_fetch_array($result)) {

    $bononocturno = $test['bononocturno'];
    $desripcio_turno = $test['desripcio_turno'];



    $formula_tipo_turno = 0;

    if($desripcio_turno == 'D'){

        $formula_tipo_turno = $TURNO_DIARIO;

    }else if($desripcio_turno == 'M'){

        $formula_tipo_turno = $TURNO_MIXTO;

    }else if($desripcio_turno == 'N'){

        $formula_tipo_turno = $TURNO_NOCTURNO;

    }

    $bono_nocturno = $salario_normal_semanal / 7 / $formula_tipo_turno * ($BONO_NOCTURNO/100) * $bononocturno;

    $bono_nocturno_semanal[$indice_bono_nocturno] = $bono_nocturno;

    $indice_bono_nocturno += 1;

}


for($i = 0;$i < count($bono_nocturno_semanal);$i++){
    $suma_indice_bono += $bono_nocturno_semanal[$i];

}



$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','54','$suma_indice_bono',
                  '$mes','$anhio','$bono_nocturno_semanal[0]','$bono_nocturno_semanal[1]',
                  '$bono_nocturno_semanal[2]','$bono_nocturno_semanal[3]',
                  '$bono_nocturno_semanal[4]')";


$result=mysql_query($sql);




/*hora extra diurna*/
$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','3','$semana_horas_total',
                  '$mes','$anhio','$semana_horas[0]','$semana_horas[1]',
                  '$semana_horas[2]','$semana_horas[3]','$semana_horas[4]')";


$result=mysql_query($sql);
$semana_horas_total_extra = $semana_horas_total;


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','4','$semana_horas_total_nocturna',
                  '$mes','$anhio','$semana_horas_nocturna[0]','$semana_horas_nocturna[1]',
                  '$semana_horas_nocturna[2]','$semana_horas_nocturna[3]',
                  '$semana_horas_nocturna[4]')";

$result=mysql_query($sql);


$sql = "SELECT
mrh_turnos.horatsemana as turno_semana,
mrh_turnos.descripciontipoturno as tipo_turno,
	mrh_turnos.horaextradiurno as extradiurno,
	mrh_turnos.horaextranocturno as extraranocturno
              FROM mrh_turnoxempleado
              INNER JOIN mrh_turnos
              ON mrh_turnoxempleado.codigoturno = mrh_turnos.codigo
              INNER JOIN mrh_empleado
              ON mrh_empleado.codigo = mrh_turnoxempleado.cedulaempleado
              WHERE mrh_turnoxempleado.anhio = '$anhio'
              AND mrh_turnoxempleado.codigomes = '$mes'
              AND mrh_empleado.codigo = '$codigo_empleado' AND
              mrh_turnoxempleado.eliminado = 'no'
              ORDER BY mrh_turnoxempleado.codigosemana";



$semana_horas_extraordinaria = array(0,0,0,0,0);
$semana_horas_nocturna_extraordinaria = array(0,0,0,0,0);
$semana_horas_total_extraordinaria = 0;
$semana_horas_total_nocturna_extraordinaria = 0;

$Horas_Extras_Diurnas_extraordinaria= array(0,0,0,0,0);
$Horas_Extras_Nocturna_extraordinaria = 0;

$indice_extraordinaria = 0;

$result=mysql_query($sql);

while($test = mysql_fetch_array($result)){

    $turno_semana = $test['turno_semana'];
    $extradiurno = $test['extradiurno'];
    $extraranocturno = $test['extraranocturno'];

    $tipo_turno = $test['tipo_turno'];

    $formula_tipo_turno = 0;

    if($tipo_turno == 'D'){

        $formula_tipo_turno = $TURNO_DIARIO;

    }else if($tipo_turno == 'M'){

        $formula_tipo_turno = $TURNO_MIXTO;

    }else if($tipo_turno == 'N'){

        $formula_tipo_turno = $TURNO_NOCTURNO;

    }
    //$hora_extra_diurna
    /* TODO acomodar ese 8  horario mensuak a smeana */
    $Horas_Extras_Diurnas_extraordinaria[$indice_extraordinaria] = (($salario_normal + $suma_indice_bono)/$numero_lunes) / 7 / $formula_tipo_turno *
        ($exta_diurna_semana[$indice_extraordinaria] + $extradiurno) *$RECARGO_HORAS_EXTRAS_DIURNA ;

//semana_noral

    $semana_horas_nocturna_extraordinaria[$indice_extraordinaria] = ($salario_normal/$numero_lunes) / 7 / $formula_tipo_turno *
        ($BONO_NOCTURNO/100) * $exta_nocturna_semana[$indice_extraordinaria];


    $semana_horas_extraordinaria[$indice_extraordinaria] = (($salario_normal + $suma_indice_bono)/$numero_lunes) / 7 / $formula_tipo_turno *
        ($exta_nocturna_semana[$indice_extraordinaria] + $extraranocturno)  *$RECARGO_HORAS_EXTRAS_NOCTURNAS;

    $indice_extraordinaria +=1;

}


for($i = 0;$i < count($semana_horas_extraordinaria);$i++){
    $semana_horas_total_extraordinaria +=  $semana_horas_extraordinaria[$i];
    $semana_horas_total_nocturna_extraordinaria += $semana_horas_nocturna_extraordinaria[$i];
}



$hora_extra_diaria_adicional_total = $Horas_Extras_Diurnas_extraordinaria[0] + $Horas_Extras_Diurnas_extraordinaria[1] + $Horas_Extras_Diurnas_extraordinaria[2] + $Horas_Extras_Diurnas_extraordinaria[3] + $Horas_Extras_Diurnas_extraordinaria[4];

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','55','$hora_extra_diaria_adicional_total',
                  '$mes','$anhio','$Horas_Extras_Diurnas_extraordinaria[0]',
                  '$Horas_Extras_Diurnas_extraordinaria[1]','$Horas_Extras_Diurnas_extraordinaria[2]',
                  '$Horas_Extras_Diurnas_extraordinaria[3]','$Horas_Extras_Diurnas_extraordinaria[4]')";

$result=mysql_query($sql);



$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','56','$semana_horas_total_extraordinaria',
                  '$mes','$anhio','$semana_horas_extraordinaria[0]',
                  '$semana_horas_extraordinaria[1]','$semana_horas_extraordinaria[2]',
                  '$semana_horas_extraordinaria[3]','$semana_horas_extraordinaria[4]')";

$result=mysql_query($sql);


$Horas_Extras_Nocturna_extraordinaria = $semana_horas_nocturna_extraordinaria[0] + $semana_horas_nocturna_extraordinaria[1] + $semana_horas_nocturna_extraordinaria[2] + $semana_horas_nocturna_extraordinaria[3] + $semana_horas_nocturna_extraordinaria[4] ;


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,semana_3,
                semana_4,semana_5)
                VALUES
                ('$codigo_empleado','61','$Horas_Extras_Nocturna_extraordinaria',
                  '$mes','$anhio','$semana_horas_nocturna_extraordinaria[0]',
                  '$semana_horas_nocturna_extraordinaria[1]','$semana_horas_nocturna_extraordinaria[2]',
                  '$semana_horas_nocturna_extraordinaria[3]','$semana_horas_nocturna_extraordinaria[4]')";

$result=mysql_query($sql);
/* fin del  hors extras diurnas y nocturnas */


/*Diferencia de salario*/

$diferencia_salario = 0;

if(isset($fake_post['diferencia_salario'])){

    $diferencia_salario = $salario_normal * diferencia_salario($anhio) / $DIAS_BANCARIOS;
}

$diferencia_salario_semana = $diferencia_salario / $numero_lunes;

$diferencia_salario_semana5 = 0;

if($numero_lunes == 5){
    $diferencia_salario_semana5 = $diferencia_salario_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','59','$diferencia_salario',
                  '$mes','$anhio','$diferencia_salario_semana','$diferencia_salario_semana','$diferencia_salario_semana',
                  '$diferencia_salario_semana','$diferencia_salario_semana5')";


$result=mysql_query($sql);


/*Dias Feriados trabajados*/

$dias_feriados_trabajador_result1 = 0;
$dias_feriados_trabajador_result2 = 0;
$dias_feriados_trabajador_result3 = 0;
$dias_feriados_trabajador_result4 = 0;
$dias_feriados_trabajador_result5 = 0;

if($dias_feriado_trabajado1 != '0'){

    $dias_feriados_trabajador_result1 =   ($salario_normal / $numero_lunes) / 7 * $dias_feriado_trabajado1 * $DIA_FERIADOS ;
}

if($dias_feriado_trabajado2 != '0'){

    $dias_feriados_trabajador_result2 =   ($salario_normal/ $numero_lunes) / 7 * $dias_feriado_trabajado2 * $DIA_FERIADOS ;
}

if($dias_feriado_trabajado3 != '0'){

    $dias_feriados_trabajador_result3 =   ($salario_normal/ $numero_lunes) / 7 * $dias_feriado_trabajado3 * $DIA_FERIADOS ;
}

if($dias_feriado_trabajado4 != '0'){

    $dias_feriados_trabajador_result4 =   ($salario_normal/ $numero_lunes) / 7 * $dias_feriado_trabajado4 * $DIA_FERIADOS ;
}

if($dias_feriado_trabajado5 != '0'){

    $dias_feriados_trabajador_result5 =   ($salario_normal/ $numero_lunes) / 7 * $dias_feriado_trabajado5 * $DIA_FERIADOS ;
}

$dias_feriados_trabajador_result_total = $dias_feriados_trabajador_result1 +
    $dias_feriados_trabajador_result2 + $dias_feriados_trabajador_result3 +
    $dias_feriados_trabajador_result4 + $dias_feriados_trabajador_result5;


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','6','$dias_feriados_trabajador_result_total',
                  '$mes','$anhio','$dias_feriados_trabajador_result1','$dias_feriados_trabajador_result2',
                  '$dias_feriados_trabajador_result3','$dias_feriados_trabajador_result4',
                  '$dias_feriados_trabajador_result5')";

$result=mysql_query($sql);

/* final de dia feriado trabajado */

$sql = "SELECT count(*) as total  FROM mrh_carga
INNER JOIN mrh_empleado
on mrh_empleado.codigo = mrh_carga.cedulaempleado
WHERE
 mrh_carga.parentesco = 'H'";


$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$total_hijos_empresa = $test['total'];


/*prima por hijo*/
$sql = "SELECT count(*) as total  FROM mrh_carga
INNER JOIN mrh_empleado
on mrh_empleado.codigo = mrh_carga.cedulaempleado
WHERE mrh_empleado.codigo = '$codigo_empleado'
AND mrh_carga.parentesco = 'H'";


$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$total_hijos = $test['total'];


$sql = "SELECT * FROM mno_new_concepto WHERE codigo = 17";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$prima_valor = $test['valor'];
$prima_forma_pago = $test['tipo_forma_pago'];
$prima_periocidad = $test['tipo_periocidad'];

//
//if($prima_periocidad == '0'){
//    $prima_valor = $prima_valor / 2;
//}else if($prima_periocidad == '1'){
//    $prima_valor = $prima_valor / 4.33;
//} else if($prima_periocidad == '2'){
//    $prima_valor = $prima_valor / 8.6;
//}else if($prima_periocidad == '3'){
//    $prima_valor = $prima_valor / 13;
//}else if($prima_periocidad == '4'){
//    $prima_valor = $prima_valor / 17.33;
//}else if($prima_periocidad == '5'){
//    $prima_valor = $prima_valor / 26;
//}else if($prima_periocidad == '6'){
//
//    $prima_valor = $prima_valor / 52;
//}
//


if($prima_forma_pago == '0'){

    $prima = $prima_valor * $total_hijos;

}else if($prima_forma_pago == '1'){

    $prima = (($sueldo_mensual * $prima_valor)  / 100)*$total_hijos;

}else if($prima_forma_pago == '2'){

    $prima = ($UNIDAD_TRIBUTARIA * $prima_valor) * $total_hijos;
}

//$prima_valor =0;

if($prima_periocidad == '0'){
    $prima_valor = $prima_valor / 2;
}else if($prima_periocidad == '1'){
    $prima_valor = $prima;
} else if($prima_periocidad == '2'){
    $prima_valor = $prima_valor / 2;
}else if($prima_periocidad == '3'){
    $prima_valor = $prima_valor / 3;
}else if($prima_periocidad == '4'){
    $prima_valor = $prima_valor / 4;
}else if($prima_periocidad == '5'){
    $prima_valor = $prima_valor / 6;
}else if($prima_periocidad == '6'){

    $prima_valor = $prima_valor / 12;
}





$prima_hijo_semana = $prima_valor / $numero_lunes;

$prima_hijo_semana5 = 0;

if($numero_lunes == 5){
    $prima_hijo_semana5 = $prima_hijo_semana;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','17','$prima_valor',
                  '$mes','$anhio','$prima_hijo_semana','$prima_hijo_semana','$prima_hijo_semana',
                  '$prima_hijo_semana','$prima_hijo_semana5')";

$result=mysql_query($sql);


/* final de prima hijo */


/*  Prima matrimonio */

$prima_matrimonio = 0;

if(isset($fake_post['prima_matrimonio'])){

    $sql = "SELECT * FROM mno_new_concepto
WHERE codigo = '19'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $valor_prima_matrimonio = $test['valor'];
    $tipo_forma_pago_prima_hijo = $test['tipo_forma_pago'];

    if($tipo_forma_pago_prima_hijo == '0'){

        $prima_matrimonio = $valor_prima_matrimonio;

    }else if($tipo_forma_pago_prima_hijo == '1'){

        $prima_matrimonio = ($sueldo_mensual * $valor_prima_matrimonio)  / 100;

    }else if($tipo_forma_pago_prima_hijo == '2'){

        $prima_matrimonio = $UNIDAD_TRIBUTARIA * $valor_prima_matrimonio;
    }

}

$prima_matrimonio_semana = $prima_matrimonio / $numero_lunes;

$prima_matrimonio_semana5 = 0;

if($numero_lunes == 5){
    $prima_matrimonio_semana5 = $prima_matrimonio_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','19','$prima_matrimonio',
                  '$mes','$anhio','$prima_matrimonio_semana','$prima_matrimonio_semana',
                  '$prima_matrimonio_semana','$prima_matrimonio_semana','$prima_matrimonio_semana5')";

$result=mysql_query($sql);

/*final de prima matrimonio*/
/*prima hogar*/

$prima_hogar = 0;

$sql = "SELECT * FROM mno_new_concepto
WHERE codigo = '18'";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$valor_prima_hogar = $test['valor'];
$tipo_forma_pago_prima_hogar = $test['tipo_forma_pago'];


if($tipo_forma_pago_prima_hogar == '0'){

    $prima_hogar = $valor_prima_hogar;

}else if($tipo_forma_pago_prima_hogar == '1'){

    $prima_hogar = ($sueldo_mensual * $valor_prima_hogar)  / 100;

}else if($tipo_forma_pago_prima_hogar == '2'){

    $prima_hogar = $UNIDAD_TRIBUTARIA * $valor_prima_hogar;
}

$prima_hogar_semana = $prima_hogar / $numero_lunes;

$prima_hogar_semana5 = 0;

if($numero_lunes == 5){
    $prima_hogar_semana5 = $prima_hogar_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,
                semana_1,semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','18','$prima_hogar',
                  '$mes','$anhio','$prima_hogar_semana','$prima_hogar_semana',
                  '$prima_hogar_semana','$prima_hogar_semana','$prima_hogar_semana5')";

$result=mysql_query($sql);


/* final prima hogar */







/*prima nacimiento*/

$prima_nacimiento = 0;

if(isset($fake_post['prima_nacimiento'])){

    $sql = "SELECT * FROM mno_new_concepto
WHERE codigo = '20'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $valor_prima_nacimiento = $test['valor'];
    $tipo_forma_pago_prima_nacimiento = $test['tipo_forma_pago'];

    if($tipo_forma_pago_prima_nacimiento == '0'){

        $prima_nacimiento = $valor_prima_nacimiento;

    }else if($tipo_forma_pago_prima_nacimiento == '1'){

        $prima_nacimiento = ($sueldo_mensual * $valor_prima_nacimiento)  / 100;

    }else if($tipo_forma_pago_prima_nacimiento == '2'){

        $prima_nacimiento = $UNIDAD_TRIBUTARIA * $valor_prima_nacimiento;
    }

}


$prima_nacimiento_semana = $prima_nacimiento / $numero_lunes;

$prima_nacimiento_semana5 = 0;

if($numero_lunes == 5){
    $prima_nacimiento_semana5 = $prima_nacimiento_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,
                semana_2,semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','20','$prima_nacimiento',
                  '$mes','$anhio','$prima_nacimiento_semana','$prima_nacimiento_semana',
                  '$prima_nacimiento_semana','$prima_nacimiento_semana','$prima_nacimiento_semana5')";

$result=mysql_query($sql);

/* final  prima nacimiento */
/* Seguro Social */

$salario_normal_convertido = $salario_normal;

if($salario_normal > ($SALARIO_MINIMO * 5)){
    $salario_normal_convertido = $SALARIO_MINIMO * 5;
}

$salario_normal_semanal_convertido = $salario_normal_semanal;


if($salario_normal_semanal > (($SALARIO_MINIMO * 5)*12/52)){
    $salario_normal_semanal_convertido = (($SALARIO_MINIMO * 5)*12/52);

}


$seguro_social_semanal = 0;


$seguro_social_semana5 = 0;

$seguro_social_total = 0;

//$salario_normal_semanal

$seguro_social_semanal = ($salario_normal_semanal_convertido * $SEGURO_SOCIAL)/100;
$seguro_social_total = ($salario_normal_convertido * $SEGURO_SOCIAL) / 100;

if($numero_lunes == 5){
    $seguro_social_semana5 = ($salario_normal_semanal_convertido * $SEGURO_SOCIAL) / 100;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','25','$seguro_social_total',
                  '$mes','$anhio','$seguro_social_semanal','$seguro_social_semanal',
                  '$seguro_social_semanal','$seguro_social_semanal',
                  '$seguro_social_semana5')";

$result=mysql_query($sql);


/*complemento al compenzatorio*/


$compenzatorio = ($salario_normal + $COMICIONES + $pago_unidades + $sum_bono_producido)/$numero_lunes * 2 - $sueldo_mensual / 7 * 2;

$compenzatorio_semana = $compenzatorio / $numero_lunes;

$compenzatorio_semana5 = 0;
if($numero_lunes == 5){
    $compenzatorio_semana5 =   $compenzatorio_semana;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','62','$compenzatorio',
                  '$mes','$anhio','$compenzatorio_semana','$compenzatorio_semana',
                  '$compenzatorio_semana','$compenzatorio_semana',
                  '$compenzatorio_semana5')";

$result=mysql_query($sql);


/*--.-.-.-.-.-*/



/* final seguro social  */
$salario_integral = $salario_normal + $suma_indice_bono + $diferencia_salario + $bono_venta_totales +
    $bono_credito + $bono_colectivo + $bono_cobranza + $vehiculo + $semana_horas_total_extraordinaria +
    $semana_horas_total_nocturna_extraordinaria ;
/*Perdida Involuntaria de Empleo*/


$salario_normal_convertido_pie = $salario_normal;

if($salario_normal > ($SALARIO_MINIMO * 10)){
    $salario_normal_convertido_pie = $SALARIO_MINIMO * 10;
}

$salario_normal_semanal_convertido_pie = $salario_normal_semanal;


if($salario_normal_semanal > (($SALARIO_MINIMO * 10)*12/52)){
    $salario_normal_semanal_convertido_pie = (($SALARIO_MINIMO * 10)*12/52);
}

$pie_semanal = 0;

$pie_semana5 = 0;

$pie_total = 0;

//$salario_normal_semanal

//$pie_semanal = ($salario_normal_semanal_convertido * $PIE)/100;
$pie_total = ($salario_normal_convertido_pie * $PIE) / 100;
$pie_semanal = $pie_total / $numero_lunes;


if($numero_lunes == 5){
    $pie_semana5 = $pie_semanal;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','26','$pie_total',
                  '$mes','$anhio','$pie_semanal','$pie_semanal',
                  '$pie_semanal','$pie_semanal',
                  '$pie_semana5')";

$result=mysql_query($sql);

/* final Perdida Involuntaria de Empleo*/
/* Banavih   */

$salario_integral_semanal = $salario_integral / $numero_lunes;

$banavih_semanal5 = 0;

$banavih_total = $salario_integral  * $BANAVIH / 100;
$banavih_semanal = $salario_integral_semanal  * $BANAVIH / 100;

if($numero_lunes == 5){
    $banavih_semanal5 = $banavih_semanal;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','27','$banavih_total',
                  '$mes','$anhio','$banavih_semanal','$banavih_semanal',
                  '$banavih_semanal','$banavih_semanal',
                  '$banavih_semanal5')";

$result=mysql_query($sql);

/*final banavih*/
/* inces */


$ince_semanal5 = 0;

$ince_total = $salario_normal  * $INCES / 100;
$ince_semanal = $salario_normal_semanal  * $INCES / 100;

if($numero_lunes == 5){
    $ince_semanal5 = $ince_semanal;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','28','$ince_total',
                  '$mes','$anhio','$ince_semanal','$ince_semanal',
                  '$ince_semanal','$ince_semanal',
                  '$ince_semanal5')";

$result=mysql_query($sql);

/*final ince*/
/*Caja de Ahorro*/


$caja_semanal5 = 0;

//$caja_total = $sueldo_mensual  * $CAJA_DE_AHORRO / 100;
$caja_total = $sueldo_mensual  * $CAJA_DE_AHORRO / 100;
$caja_semanal = $caja_total / $numero_lunes;
if($numero_lunes == 5){
    $caja_semanal5 = $caja_semanal;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','29','$caja_total',
                  '$mes','$anhio','$caja_semanal','$caja_semanal',
                  '$caja_semanal','$caja_semanal',
                  '$caja_semanal5')";

$result=mysql_query($sql);

/* final caja */
/* Cuota Sindical */

$cuota_sindical_semana5 = 0;

$cuota_sindical_total = $CUOTA_SINDCAL;

$cuota_sndcal_semana = $CUOTA_SINDCAL / $numero_lunes;

if($numero_lunes == 5){
    $cuota_sindical_semana5 = $cuota_sndcal_semana ;
}

$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','30','$cuota_sindical_total',
                  '$mes','$anhio','$cuota_sndcal_semana','$cuota_sndcal_semana',
                  '$cuota_sndcal_semana','$cuota_sndcal_semana',
                  '$cuota_sindical_semana5')";

$result=mysql_query($sql);

/*final cuota sindical*/
/* utilidades */

$utilidades_semana5 = 0;

$utilidades_semana = $salario_normal_semanal *  $UTILIDADES / 360;

$utilidades_total = $utilidades_semana * $numero_lunes;

if($numero_lunes == 5){
    $utilidades_semana5 = $utilidades_semana;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','31','$utilidades_total',
                  '$mes','$anhio','$utilidades_semana','$utilidades_semana',
                  '$utilidades_semana','$utilidades_semana',
                  '$utilidades_semana5')";

$result=mysql_query($sql);

/* final utilidades*/
/* aguinaldo */

$aguinaldo_semana5 = 0;

$aguinaldo_semana = $salario_normal_semanal *  $AGUINALDO / 360;

$aguinaldo_total = $aguinaldo_semana * $numero_lunes;

if($numero_lunes == 5){
    $aguinaldo_semana5 = $aguinaldo_semana;
}


$sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','32','$aguinaldo_total',
                  '$mes','$anhio','$aguinaldo_semana','$aguinaldo_semana',
                  '$aguinaldo_semana','$aguinaldo_semana',
                  '$aguinaldo_semana5')";

$result=mysql_query($sql);

/* final aguinaldo */
/*bono vacacional*/





    $vacacional_semana5 = 0;

    $vacacional_semana = $salario_normal_semanal *  $variable_vacaciones / 360;



    $vacacional_total = $vacacional_semana * $numero_lunes;

    if($numero_lunes == 5){
        $vacacional_semana5 = $vacacional_semana;
    }


    $sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','33','$vacacional_total',
                      '$mes','$anhio','$vacacional_semana','$vacacional_semana',
                      '$vacacional_semana','$vacacional_semana',
                      '$vacacional_semana5')";

    $result=mysql_query($sql);

/*final vacacional*/
/* post vacacional */

    $vacacional_post_semana5 = 0;

    $vacacional_post_semana = $salario_normal_semanal *  $POST_VACACIONAL / 360;

    $vacacional_post_total = $vacacional_post_semana * $numero_lunes;

    if($numero_lunes == 5){
        $vacacional_post_semana5 = $vacacional_post_semana;
    }


    $sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','34','$vacacional_post_total',
                      '$mes','$anhio','$vacacional_post_semana','$vacacional_post_semana',
                      '$vacacional_post_semana','$vacacional_post_semana',
                      '$vacacional_post_semana5')";

    $result=mysql_query($sql);

    /*final post vacacional*/
    /* Prestaciones Sociales */

    $prestaciones_sociales_semana5 = 0;


    $prestaciones_sociales_total = $salario_integral / 30 *  $PRESTACIONES_SOCIALES ;

    $prestaciones_sociales_semana = $prestaciones_sociales_total / $numero_lunes;

    if($numero_lunes == 5){
        $prestaciones_sociales_semana5 = $prestaciones_sociales_semana;
    }


    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','35','$prestaciones_sociales_total',
                  '$mes','$anhio','$prestaciones_sociales_semana','$prestaciones_sociales_semana',
                  '$prestaciones_sociales_semana','$prestaciones_sociales_semana',
                  '$prestaciones_sociales_semana5')";

    $result=mysql_query($sql);

    /* final prestaciones sociales */
    /* Intereses Prestaciones Sociales */

    $intereses_prestaciones_semana5 = 0;

    $intereses_prestaciones_semana = $prestaciones_sociales_semana * ($INTERESES_PRESTACIONES/100) / 12;

    $intereses_prestaciones_total = $intereses_prestaciones_semana * $numero_lunes;

    if($numero_lunes == 5){
        $intereses_prestaciones_semana5 = $intereses_prestaciones_semana;
    }


    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','36','$intereses_prestaciones_total',
                  '$mes','$anhio','$intereses_prestaciones_semana','$intereses_prestaciones_semana',
                  '$intereses_prestaciones_semana','$intereses_prestaciones_semana',
                  '$intereses_prestaciones_semana5')";

    $result=mysql_query($sql);

    /*  final interes prestaciones */
    /* beca trabajador */

    $beca_trabajador_semana5 = 0;

    $beca_trabajador_semana = $beca_trabajador / $numero_lunes;

    $beca_trabajador_total = $beca_trabajador_semana * $numero_lunes;

    if($numero_lunes == 5){
        $beca_trabajador_semana5 = $beca_trabajador_semana;
    }


    $sql = "INSERT
                                INTO mno_new_concepto_empleado
                                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                                semana_3,semana_4,semana_5)
                                VALUES
                                ('$codigo_empleado','37','$beca_trabajador_total',
                                  '$mes','$anhio','$beca_trabajador_semana','$beca_trabajador_semana',
                                  '$beca_trabajador_semana','$beca_trabajador_semana',
                                  '$beca_trabajador_semana5')";

    $result=mysql_query($sql);

    /* final beca trabajador */
    /* beca hijos */

    $beca_hijo_semana5 = 0;

    //$beca_hijo_semana = ($beca_hijo * $total_hijos) / $numero_lunes;
    $beca_hijo_semana = ($beca_hijo *$total_hijos) / $numero_lunes;

    $beca_hijo_total = $beca_hijo * $total_hijos;

    if($numero_lunes == 5){
        $beca_hijo_semana5 = $beca_hijo_semana;
    }


    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','38','$beca_hijo_total',
                  '$mes','$anhio','$beca_hijo_semana','$beca_hijo_semana',
                  '$beca_hijo_semana','$beca_hijo_semana',
                  '$beca_hijo_semana5')";

    $result=mysql_query($sql);

    /*  final beca hijo*/
    /* asistencia medica */


    $asistencia_medica_input_semana5 = 0;

    $asistencia_medica_input_semana = $asistencia_medica_input / $numero_lunes;

    $asistencia_medica_input_total = $asistencia_medica_input_semana * $numero_lunes;

    if($numero_lunes == 5){
        $asistencia_medica_input_semana5 = $asistencia_medica_input_semana;
    }

    $asistencia_medica_semana_sql =  $asistencia_medica_input_semana;
    $asistencia_medica_semana_total_sql = $asistencia_medica_input_total;
    $asistencia_medica_semana5_sql = $asistencia_medica_input_semana5;

    if(isset($fake_post['asistencia_medica_check'])){

        $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 39";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $asistecima_medica_valor = $test['valor'];
        $asistecima_medica_forma_pago = $test['tipo_forma_pago'];
        $asistecima_medica_periocidad = $test['tipo_periocidad'];

        if($asistecima_medica_periocidad == '0'){
            $asistecima_medica_valor = $asistecima_medica_valor / 2;
        }else if($asistecima_medica_periocidad == '1'){
            $asistecima_medica_valor = $asistecima_medica_valor / 4.33;
        } else if($asistecima_medica_periocidad == '2'){
            $asistecima_medica_valor = $asistecima_medica_valor / 8.6;
        }else if($asistecima_medica_periocidad == '3'){
            $asistecima_medica_valor = $asistecima_medica_valor / 13;
        }else if($asistecima_medica_periocidad == '4'){
            $asistecima_medica_valor = $asistecima_medica_valor / 17.33;
        }else if($asistecima_medica_periocidad == '5'){
            $asistecima_medica_valor = $asistecima_medica_valor / 26;
        }else if($asistecima_medica_periocidad == '6'){

            $asistecima_medica_valor = $asistecima_medica_valor / 52;
        }

        $asistecima_medica_mensual = $asistecima_medica_valor * $numero_lunes;

        $asistencia_medica = 0;

        if($asistecima_medica_forma_pago == '0'){

            $asistencia_medica = $asistecima_medica_mensual;

        }else if($asistecima_medica_forma_pago == '1'){

            $asistencia_medica = ($sueldo_mensual * $asistecima_medica_mensual)  / 100;

        }else if($asistecima_medica_forma_pago == '2'){

            $asistencia_medica = $UNIDAD_TRIBUTARIA * $asistecima_medica_mensual;
        }

        $asistencia_medica_semana = ($asistencia_medica / $numero_lunes)/$NUMERO_EMPLEADOS;

        $asistencia_medica_semana5 = 0;

        $asistencia_medica_total = $asistencia_medica_semana * $numero_lunes;

        if($numero_lunes == 5){
            $asistencia_medica_semana5 = $asistencia_medica_semana;
        }

         $asistencia_medica_semana_sql += $asistencia_medica_semana;
         $asistencia_medica_semana_total_sql += $asistencia_medica_total;
         $asistencia_medica_semana5_sql += $asistencia_medica_semana5;
    }

    $sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','39','$asistencia_medica_semana_total_sql',
                      '$mes','$anhio','$asistencia_medica_semana_sql','$asistencia_medica_semana_sql',
                      '$asistencia_medica_semana_sql','$asistencia_medica_semana_sql',
                      '$asistencia_medica_semana5_sql')";

    $result=mysql_query($sql);

    /* final asistencia medica */
    /* juguetes */


    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 40";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $juguete_valor = $test['valor'];
    $juguete_forma_pago = $test['tipo_forma_pago'];
    $juguete_periocidad = $test['tipo_periocidad'];


    if($juguete_forma_pago == '0'){

        $juguete = $juguete_valor * $total_hijos;

    }else if($juguete_forma_pago == '1'){

        $juguete = (($sueldo_mensual * $juguete_valor)  / 100)*$total_hijos;

    }else if($juguete_forma_pago == '2'){

        $juguete = ($UNIDAD_TRIBUTARIA * $juguete_valor) * $total_hijos;
    }

    //$prima_valor =0;

    if($juguete_periocidad == '0'){
        $juguete_valor = $juguete / 2;
    }else if($juguete_periocidad == '1'){
        $juguete_valor = $juguete;
    } else if($juguete_periocidad == '2'){
        $juguete_valor = $juguete / 2;
    }else if($juguete_periocidad == '3'){
        $juguete_valor = $juguete / 3;
    }else if($juguete_periocidad == '4'){
        $juguete_valor = $juguete / 4;
    }else if($juguete_periocidad == '5'){
        $juguete_valor = $juguete / 6;
    }else if($juguete_periocidad == '6'){

        $juguete_valor = $juguete / 12;
    }



    $juguete_total = $juguete_valor;

    $juguete_semana5 = 0;

    $juguete_semana = $juguete_total / $numero_lunes;


    if($numero_lunes == 5){
        $juguete_semana5 = $juguete_semana;
    }


    $sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','40','$juguete_total',
                      '$mes','$anhio','$juguete_semana','$juguete_semana',
                      '$juguete_semana','$juguete_semana',
                      '$juguete_semana5')";

    $result=mysql_query($sql);

    /* final juguete */
    /* Guarderia */
    $sql = "SELECT count(*) as total  FROM mrh_carga
INNER JOIN mrh_empleado
on mrh_empleado.codigo = mrh_carga.cedulaempleado
WHERE mrh_empleado.codigo = '$codigo_empleado'
AND mrh_carga.parentesco = 'H' AND
mrh_carga.estudios = 'G'";


    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $hijos_guarderia = $test['total'];


$sql = "SELECT * FROM mno_new_concepto WHERE codigo = 41";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$guarderia_valor = $test['valor'];
$guarderia_forma_pago = $test['tipo_forma_pago'];
$guarderia_periocidad = $test['tipo_periocidad'];



if($guarderia_forma_pago == '0'){

    $guarderia = $guarderia_valor * $total_hijos;

}else if($guarderia_forma_pago == '1'){

    $guarderia = (($sueldo_mensual * $guarderia_valor)  / 100)*$total_hijos;

}else if($guarderia_forma_pago == '2'){

    $guarderia = ($UNIDAD_TRIBUTARIA * $guarderia_valor) * $total_hijos;
}


$guarderia_valor = $guarderia;


if($guarderia_periocidad == '0'){
    $guarderia_valor = $guarderia_valor / 2;
}else if($guarderia_periocidad == '1'){
    $guarderia_valor = $guarderia_valor;
} else if($guarderia_periocidad == '2'){
    $guarderia_valor = $guarderia_valor / 2;
}else if($guarderia_periocidad == '3'){
    $guarderia_valor = $guarderia_valor / 3;
}else if($guarderia_periocidad == '4'){
    $guarderia_valor = $guarderia_valor / 4;
}else if($guarderia_periocidad == '5'){
    $guarderia_valor = $guarderia_valor / 6;
}else if($guarderia_periocidad == '6'){

    $guarderia_valor = $guarderia_valor / 12;
}






//$guarderia_mensual = $guarderia_valor * $numero_lunes;

//$guarderia = 0;
//
//if($guarderia_forma_pago == '0'){
//
//    $guarderia = $guarderia_mensual;
//
//}else if($guarderia_forma_pago == '1'){
//
//    $guarderia = ($sueldo_mensual * $guarderia_mensual)  / 100;
//
//}else if($guarderia_forma_pago == '2'){
//
//    $guarderia = $UNIDAD_TRIBUTARIA * $guarderia_mensual;
//}

$guarderia_semana = 0;
if($hijos_guarderia != 0){
    $guarderia_semana = ($guarderia / $numero_lunes);
}

$guarderia_semana5 = 0;

$guarderia_total = $guarderia_semana  * $numero_lunes;

if($numero_lunes == 5){
    $guarderia_semana5 = $guarderia_semana;
}


$sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','41','$guarderia_total',
                      '$mes','$anhio','$guarderia_semana','$guarderia_semana',
                      '$guarderia_semana','$guarderia_semana',
                      '$guarderia_semana5')";

$result=mysql_query($sql);

    /* salir  guarderia */
    /* Fiesta Fin de Año Trabajadores */

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 43";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $dia_ninho_valor = $test['valor'];
    $dia_ninho_forma_pago = $test['tipo_forma_pago'];

    $dia_ninho = 0;

    if($dia_ninho_forma_pago == '0'){

        $dia_ninho = $dia_ninho_valor;

    }else if($dia_ninho_forma_pago == '1'){

        $dia_ninho = ($sueldo_mensual * $dia_ninho_valor)  / 100;

    }else if($dia_ninho_forma_pago == '2'){

        $dia_ninho = $UNIDAD_TRIBUTARIA * $dia_ninho_valor;
    }


    $dia_ninho_total = 0;

    if($total_hijos_empresa != 0){
        $dia_ninho_total = $dia_ninho / $total_hijos_empresa * $total_hijos /  12;
    }


    $dia_ninho_semana5 = 0;


    $dia_ninho_semana = $dia_ninho_total  / $numero_lunes;

    if($numero_lunes == 5){
        $dia_ninho_semana5 = $dia_ninho_semana;
    }


    $sql = "INSERT
                        INTO mno_new_concepto_empleado
                        (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                        semana_3,semana_4,semana_5)
                        VALUES
                        ('$codigo_empleado','43','$dia_ninho_total',
                          '$mes','$anhio','$dia_ninho_semana','$dia_ninho_semana',
                          '$dia_ninho_semana','$dia_ninho_semana',
                          '$dia_ninho_semana5')";

    $result=mysql_query($sql);

    /* final dia del niño */
    /* fiesta fin de año */
    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 44";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $fiesta_anhio_trabajador_valor = $test['valor'];
    $fiesta_anhio_trabajador_forma_pago = $test['tipo_forma_pago'];




    if($fiesta_anhio_trabajador_forma_pago == '0'){

        $fiesta_anhio_trabajador = $fiesta_anhio_trabajador_valor;

    }else if($fiesta_anhio_trabajador_forma_pago == '1'){

        $fiesta_anhio_trabajador = ($sueldo_mensual * $fiesta_anhio_trabajador_valor)  / 100;

    }else if($fiesta_anhio_trabajador_forma_pago == '2'){

        $fiesta_anhio_trabajador = $UNIDAD_TRIBUTARIA * $fiesta_anhio_trabajador_valor;
    }


    $fiesta_anhio_trabajador_total = $fiesta_anhio_trabajador / $NUMERO_EMPLEADOS /12;

    $fiesta_anhio_trabajador_semana = $fiesta_anhio_trabajador_total/$numero_lunes;

    $fiesta_anhio_trabajador_semana5 = 0;



    if($numero_lunes == 5){
        $fiesta_anhio_trabajador_semana5 = $fiesta_anhio_trabajador_semana;
    }


    $sql = "INSERT
                            INTO mno_new_concepto_empleado
                            (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                            semana_3,semana_4,semana_5)
                            VALUES
                            ('$codigo_empleado','44','$fiesta_anhio_trabajador_total',
                              '$mes','$anhio','$fiesta_anhio_trabajador_semana','$fiesta_anhio_trabajador_semana',
                              '$fiesta_anhio_trabajador_semana','$fiesta_anhio_trabajador_semana',
                              '$fiesta_anhio_trabajador_semana5')";

    $result=mysql_query($sql);

    /* final fiesta fin de anhio*/
    /* Fiesta Fin de Año Niños */

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 45";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $fiesta_anhio_ninho_valor = $test['valor'];
    $fiesta_anhio_ninho_forma_pago = $test['tipo_forma_pago'];

    $fiesta_anhio_ninho = 0;

    if($fiesta_anhio_ninho_forma_pago == '0'){

        $fiesta_anhio_ninho = $fiesta_anhio_ninho_valor;

    }else if($fiesta_anhio_ninho_forma_pago == '1'){

        $fiesta_anhio_ninho = ($sueldo_mensual * $fiesta_anhio_ninho_valor)  / 100;

    }else if($fiesta_anhio_ninho_forma_pago == '2'){

        $fiesta_anhio_ninho = $UNIDAD_TRIBUTARIA * $fiesta_anhio_ninho_valor;
    }

$fiesta_anhio_ninho_semana = 0;
    if($total_hijos_empresa != 0){
        $fiesta_anhio_ninho_semana = ($fiesta_anhio_ninho / 52)/  $total_hijos_empresa;
    }

    $fiesta_anhio_ninho_semana5 = 0;

    $fiesta_anhio_ninho_total = $fiesta_anhio_ninho_semana  * $numero_lunes;

    if($numero_lunes == 5){
        $fiesta_anhio_ninho_semana5 = $fiesta_anhio_ninho_semana;
    }


    $sql = "INSERT
                                INTO mno_new_concepto_empleado
                                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                                semana_3,semana_4,semana_5)
                                VALUES
                                ('$codigo_empleado','45','$fiesta_anhio_ninho_total',
                                  '$mes','$anhio','$fiesta_anhio_ninho_semana','$fiesta_anhio_ninho_semana',
                                  '$fiesta_anhio_ninho_semana','$fiesta_anhio_ninho_semana',
                                  '$fiesta_anhio_ninho_semana5')";

    $result=mysql_query($sql);

    /* final fuesta niño */
    /*Obsequio Fin de Año*/

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 46";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $obsequio_fin_valor = $test['valor'];
    $obsequio_fin_forma_pago = $test['tipo_forma_pago'];

    $obsequio_fin = 0;

    if($obsequio_fin_forma_pago == '0'){

        $obsequio_fin = $obsequio_fin_valor;

    }else if($obsequio_fin_forma_pago == '1'){

        $obsequio_fin = ($sueldo_mensual * $obsequio_fin_valor)  / 100;

    }else if($obsequio_fin_forma_pago == '2'){

        $obsequio_fin = $UNIDAD_TRIBUTARIA * $obsequio_fin_valor;
    }

    $obsequio_fin_semana = ($obsequio_fin / 52)/  $NUMERO_EMPLEADOS;

    $obsequio_fin_semana5 = 0;

    $obsequio_fin_total = $obsequio_fin_semana  * $numero_lunes;

    if($numero_lunes == 5){
        $obsequio_fin_semana5 = $obsequio_fin_semana;
    }


    $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                semana_3,semana_4,semana_5)
                VALUES
                ('$codigo_empleado','46','$obsequio_fin_total',
                  '$mes','$anhio','$obsequio_fin_semana','$obsequio_fin_semana',
                  '$obsequio_fin_semana','$obsequio_fin_semana',
                  '$obsequio_fin_semana5')";

    $result=mysql_query($sql);

    /* fin obsequio fin de año */
    /* Plan Vacacional */

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 47";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $plan_vacacional_valor = $test['valor'];
    $plan_vacacional_forma_pago = $test['tipo_forma_pago'];

    $plan_vacacional = 0;

    if($plan_vacacional_forma_pago == '0'){

        $plan_vacacional = $plan_vacacional_valor;

    }else if($plan_vacacional_forma_pago == '1'){

        $plan_vacacional = ($sueldo_mensual * $plan_vacacional_valor)  / 100;

    }else if($plan_vacacional_forma_pago == '2'){

        $plan_vacacional = $UNIDAD_TRIBUTARIA * $plan_vacacional_valor;
    }


    $plan_vacacional_semana = 0;
    if($total_hijos_empresa != 0){
        $plan_vacacional_semana = ($plan_vacacional / 52)/  $total_hijos_empresa;
    }

    $plan_vacacional_semana5 = 0;

    $plan_vacacional_total = $plan_vacacional_semana  * $numero_lunes;

    if($numero_lunes == 5){
        $plan_vacacional_semana5 = $plan_vacacional_semana;
    }


    $sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','47','$plan_vacacional_total',
                      '$mes','$anhio','$plan_vacacional_semana','$plan_vacacional_semana',
                      '$plan_vacacional_semana','$plan_vacacional_semana',
                      '$plan_vacacional_semana5')";

    $result=mysql_query($sql);

    /* final plan vacaciones */
    /*dia de las madres*/

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 48";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $dia_madre_valor = $test['valor'];
    $dia_madre_forma_pago = $test['tipo_forma_pago'];

    $dia_madre = 0;

    if($dia_madre_forma_pago == '0'){

        $dia_madre = $dia_madre_valor;

    }else if($dia_madre_forma_pago == '1'){

        $dia_madre = ($sueldo_mensual * $dia_madre_valor)  / 100;

    }else if($dia_madre_forma_pago == '2'){

        $dia_madre = $UNIDAD_TRIBUTARIA * $dia_madre_valor;
    }

    $dia_madre_semana = ($dia_madre / 52)/  $NUMERO_EMPLEADOS;

    $dia_madre_semana5 = 0;

    $dia_madre_total = $dia_madre_semana  * $numero_lunes;

    if($numero_lunes == 5){
        $dia_madre_semana5 = $dia_madre_semana;
    }


    $sql = "INSERT
                        INTO mno_new_concepto_empleado
                        (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                        semana_3,semana_4,semana_5)
                        VALUES
                        ('$codigo_empleado','48','$dia_madre_total',
                          '$mes','$anhio','$dia_madre_semana','$dia_madre_semana',
                          '$dia_madre_semana','$dia_madre_semana',
                          '$dia_madre_semana5')";

    $result=mysql_query($sql);

    /*final dia de las madres*/
    /* servicio recrecional */
    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 49";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $recreacional_valor = $test['valor'];
    $recreacional_forma_pago = $test['tipo_forma_pago'];

    $recreacional = 0;

    if($recreacional_forma_pago == '0'){

        $recreacional = $recreacional_valor;

    }else if($recreacional_forma_pago == '1'){

        $recreacional = ($sueldo_mensual * $recreacional_valor)  / 100;

    }else if($recreacional_forma_pago == '2'){

        $recreacional = $UNIDAD_TRIBUTARIA * $recreacional_valor;
    }

    $recreacional_semana = ($recreacional / 52)/  $total_hijos_empresa;

    $recreacional_semana5 = 0;

    $recreacional_total = $recreacional_semana  * $numero_lunes;

    if($numero_lunes == 5){
        $recreacional_semana5 = $recreacional_semana;
    }


    $sql = "INSERT
                            INTO mno_new_concepto_empleado
                            (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                            semana_3,semana_4,semana_5)
                            VALUES
                            ('$codigo_empleado','49','$recreacional_total',
                              '$mes','$anhio','$recreacional_semana','$recreacional_semana',
                              '$recreacional_semana','$recreacional_semana',
                              '$recreacional_semana5')";

    $result=mysql_query($sql);

    /*final recreacional*/
    /*servicioo de trnasporte*/

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 50";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $transporte_valor = $test['valor'];
    $transporte_forma_pago = $test['tipo_forma_pago'];

    $transporte = 0;

    if($transporte_forma_pago == '0'){

        $transporte = $transporte_valor;

    }else if($transporte_forma_pago == '1'){

        $transporte = ($sueldo_mensual * $transporte_valor)  / 100;

    }else if($transporte_forma_pago == '2'){

        $transporte = $UNIDAD_TRIBUTARIA * $transporte_valor;
    }

    $transporte_semana = ($transporte )/  $NUMERO_EMPLEADOS / $numero_lunes;

    $transporte_semana5 = 0;

    $transporte_total = ($transporte )/  $NUMERO_EMPLEADOS;

    if($numero_lunes == 5){
        $transporte_semana5 = $transporte_semana;
    }


    $sql = "INSERT
                                INTO mno_new_concepto_empleado
                                (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                                semana_3,semana_4,semana_5)
                                VALUES
                                ('$codigo_empleado','50','$transporte_total',
                                  '$mes','$anhio','$transporte_semana','$transporte_semana',
                                  '$transporte_semana','$transporte_semana',
                                  '$transporte_semana5')";

    $result=mysql_query($sql);

    /* final trasnporte */
    /* utiles escolares */

    $sql = "SELECT * FROM mno_new_concepto WHERE codigo = 51";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $utiles_escolares_valor = $test['valor'];
    $utiles_escolares_forma_pago = $test['tipo_forma_pago'];

    $utiles_escolares = 0;

    if($utiles_escolares_forma_pago == '0'){

        $utiles_escolares = $utiles_escolares_valor;

    }else if($utiles_escolares_forma_pago == '1'){

        $utiles_escolares = ($sueldo_mensual * $utiles_escolares_valor)  / 100;

    }else if($utiles_escolares_forma_pago == '2'){

        $utiles_escolares = $UNIDAD_TRIBUTARIA * $utiles_escolares_valor;
    }

    $utiles_escolares_semana = ($utiles_escolares / 52)*  $total_hijos;

    $utiles_escolares_semana5 = 0;

    $utiles_escolares_total = $utiles_escolares_semana  * $numero_lunes;

    if($numero_lunes == 5){
        $utiles_escolares_semana5 = $utiles_escolares_semana;
    }


    $sql = "INSERT
                                    INTO mno_new_concepto_empleado
                                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                                    semana_3,semana_4,semana_5)
                                    VALUES
                                    ('$codigo_empleado','51','$utiles_escolares_total',
                                      '$mes','$anhio','$utiles_escolares_semana','$utiles_escolares_semana',
                                      '$utiles_escolares_semana','$utiles_escolares_semana',
                                      '$utiles_escolares_semana5')";

    $result=mysql_query($sql);


    /* dotacion uniforme */

        $sql = "SELECT sum( min_requisicion.cantidad_despacho * min_requisicion.valor_unidad)/(52/2) as total FROM min_requisicion
            WHERE min_requisicion.fecha_uso LIKE '".$anhio."-".$mes."%'
            AND min_requisicion.beneficiario = '$codigo_empleado'
            ";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $requisicion = $test['total'];

        $requisicion_semana = $requisicion;

        $requisicion_semana5 = 0;

        $requisicion_total = $requisicion_semana * $numero_lunes;


        if($numero_lunes == 5){
            $requisicion_semana5 = $requisicion_semana;
        }


        $sql = "INSERT
                    INTO mno_new_concepto_empleado
                    (codigo_empleado,codigo_concepto,total,mes,anhio,semana_1,semana_2,
                    semana_3,semana_4,semana_5)
                    VALUES
                    ('$codigo_empleado','42','$requisicion_total',
                      '$mes','$anhio','$requisicion_semana','$requisicion_semana',
                      '$requisicion_semana','$requisicion_semana',
                      '$requisicion_semana5')";

        $result=mysql_query($sql);



//echo($salario_normal .' /7* '. $DIA_FERIADOS . ' * ' . $dias_feriado_trabajado);



//send_error_redirect(false,"Sueldo Procesado Correctamente");die;
//
