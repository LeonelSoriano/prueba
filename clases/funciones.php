<?php

function formatear_ve($numero)
{
    $tmp_money = floor($numero * 100)/100;
    return number_format($tmp_money,2,',','.' );

}

function rendondear($numero)
{
    return floor($numero * 100)/100;
}



function fecha_sicap()
{
    $fecha_actual = date("Y-m-d");
    return $fecha_actual;
}

function sql_mes_anterior()
{
    $anterior = date('Y-m-d', strtotime(date('Y-m')." -1 month"));

    $fecha = explode('-',$anterior);

    return  $fecha[0] . '-' . $fecha[1] . '-%';
}



function send_error_redirect($bool_error,$msg=null){

    $current_url = explode("?", $_SERVER['REQUEST_URI']);

    if($bool_error){
        if($msg == null){
            header('Location: '.$current_url[0].'?error=true');
        }else{
            header('Location: '.$current_url[0].'?error=true&msg='.$msg);
        }
    }else if(!$bool_error){
        if($msg == null){
            header('Location: '.$current_url[0].'?error=false');
        }else{
            header('Location: '.$current_url[0].'?error=false&msg='.$msg);

        }
    }

    exit();


}


function redireccion_anterior(){

    $url_anterior =  $_SERVER['HTTP_REFERER'];

    header('Location:'.$url_anterior);
    die;
}

function redireccion_anterior_error($bool_error,$msg=null){



    $url_anterior =  $_SERVER['HTTP_REFERER'];

    $current_url = explode("?", $url_anterior);

    if($bool_error){
        if($msg == null){
            header('Location: '.$current_url[0].'?error=true');
        }else{
            header('Location: '.$current_url[0].'?error=true&msg='.$msg);
        }
    }else if(!$bool_error) {
        if ($msg == null) {
            header('Location: ' . $current_url[0] . '?error=false');
        } else {
            header('Location: ' . $current_url[0] . '?error=false&msg=' . $msg);

        }
    }
}


//echo dias_transcurridos('2012-07-01','2012-07-18');
//echo dias_transcurridos(nueva,actual);
function dias_transcurridos($fecha_i,$fecha_f)
{
    $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
    $dias = floor($dias);
    return $dias;
}



function codificacion($texto)
{

    if (!defined('UTF_8')) define('UTF_8', '1');
    if (!defined('ASCII')) define('ASCII', '2');
    if (!defined('ISO_8859_1')) define('ISO_8859_1', '3');


    $c = 0;
    $ascii = true;
    for ($i = 0;$i<strlen($texto);$i++) {
        $byte = ord($texto[$i]);
        if ($c>0) {
            if (($byte>>6) != 0x2) {
                return ISO_8859_1;
            } else {
                $c--;
            }
        } elseif ($byte&0x80) {
            $ascii = false;
            if (($byte>>5) == 0x6) {
                $c = 1;
            } elseif (($byte>>4) == 0xE) {
                $c = 2;
            } elseif (($byte>>3) == 0x1E) {
                $c = 3;
            } else {
                return ISO_8859_1;
            }
        }
    }
    return ($ascii) ? ASCII : UTF_8;
}

function utf8_encode_seguro($texto)
{

    return (codificacion($texto)!=3) ? utf8_decode($texto) : $texto;
}



function utf8_multiplataforma($cadena){

    if (isset($_ENV['WINDIR'])){
        return $cadena;
    }else{
        return utf8_encode_seguro($cadena);
    }
}

function is_leap_year($year)
{
    return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
}


function diferencia_salario($year){

    $anhio_bisiesto = ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));

    if($anhio_bisiesto)
        return 6;
    else
        return 5;

}


function getMondays($year, $month)
{
    $mondays = array();
    # First weekday in specified month: 1 = monday, 7 = sunday
    $firstDay = date('N', mktime(0, 0, 0, $month, 1, $year));
    /* Add 0 days if monday ... 6 days if tuesday, 1 day if sunday
        to get the first monday in month */
    $addDays = (8 - $firstDay) % 7;
    $mondays[] = date('r', mktime(0, 0, 0, $month, 1 + $addDays, $year));

    $nextMonth = mktime(0, 0, 0, $month + 1, 1, $year);

    # Just add 7 days per iteration to get the date of the subsequent week
    for ($week = 1, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year);
         $time < $nextMonth;
         ++$week, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year))
    {
        $mondays[] = date('r', $time);
    }

    return $mondays;
}


function codigo_to_mes($numero_mes){

    if($numero_mes == 1){
        return "Enero";
    }else if($numero_mes == 2){
        return "Febrero";
    }else if($numero_mes == 3){
        return "Marzo";
    }else if($numero_mes == 4){
        return "Abril";
    }else if($numero_mes == 5){
        return "Mayo";
    }else if($numero_mes == 6){
        return "Junio";
    }else if($numero_mes == 7){
        return "Julio";
    }else if($numero_mes == 8){
        return "Agosto";
    }else if($numero_mes == 9){
        return "Septiembre";
    }else if($numero_mes == 10){
        return "Octubre";
    }else if($numero_mes == 11){
        return "Noviembre";
    }else if($numero_mes == 12){
        return "Diciembre";
    }else{
        return "Error en Mes";
    }

}


function calculo_entre_anhios($fecha1,$fecha2){

    $d1 = new DateTime($fecha1);
    $d2 = new DateTime($fecha2);

    $diff = $d2->diff($d1);

    return $diff->y;

}


function calculo_entre_fechas_es_mayor($fecha1,$fecha2){

    $d1 = new DateTime($fecha1);
    $d2 = new DateTime($fecha2);

    $diff = $d2->diff($d1);

    $resultado = true;

    if($diff->invert == 1){
        $resultado = false;
    }


    return $resultado;

}


function dateDiff ($d1, $d2) {

    return round(abs(strtotime($d1)-strtotime($d2))/86400);
}



//usocountDays(2014, 4, array(0, 6));
function countDays($year, $month, $ignore) {
    $count = 0;
    $counter = mktime(0, 0, 0, $month, 1, $year);
    while (date("n", $counter) == $month) {
        if (in_array(date("w", $counter), $ignore) == false) {
            $count++;
        }
        $counter = strtotime("+1 day", $counter);
    }
    return $count;
}


function dias_laborables($anhio,$mes)
{
    return countDays($anhio, $mes, array(0, 6));
}



function cadena_estetica($cadena){

    if(strlen($cadena ) == ''){
        return '';
    }
    if(strlen($cadena )> 0){
        $nueva_cadena = '';

        $nueva_cadena = strtoupper($cadena[0]);

        $espacio = false;
        for($i=1;$i< strlen($cadena); $i++){


            if($cadena[$i] == " "){
                $nueva_cadena .= $cadena[$i];
                $espacio = true;

                $i++;
                if($i >= strlen($cadena))
                    return $nueva_cadena;

            }


            if($espacio){
                $nueva_cadena .= strtoupper($cadena[$i]);

                $espacio = false;
            }else{
                $nueva_cadena .=  strtolower($cadena[$i]);
            }


        }

        return $nueva_cadena;
    }else{
        return  '';
    }

}





function my_encode($string){


    $string = preg_replace('/ñ/', 'enhie', $string);
    $string = preg_replace('/Ñ/', 'ENHIE', $string);
    $string = preg_replace('/á/', 'acute', $string);
    $string = preg_replace('/Á/', 'ACUTE', $string);
    $string = preg_replace('/é/', 'ecute', $string);
    $string = preg_replace('/É/', 'ECUTE', $string);
    $string = preg_replace('/í/', 'icute', $string);
    $string = preg_replace('/í/', 'ICUTE', $string);
    $string = preg_replace('/í/', 'ICUTE', $string);
    $string = preg_replace('/Ü/', 'UPOITCUTE', $string);
    $string = preg_replace('/Ü/', 'upoitcute', $string);


    return $string;

}

function my_decode($string){

    $string = preg_replace('/enhie/', 'ñ', $string);
    $string = preg_replace('/ENHIE/', 'Ñ', $string);
    $string = preg_replace('/acute/', 'á', $string);
    $string = preg_replace('/ACUTE/', 'Á', $string);
    $string = preg_replace('/ecute/', 'é', $string);
    $string = preg_replace('/ECUTE/', 'É', $string);
    $string = preg_replace('/icute/', 'í', $string);
    $string = preg_replace('/ICUTE/', 'í', $string);
    $string = preg_replace('/ICUTE/', 'í', $string);
    $string = preg_replace('/UPOITCUTE/', 'Ü', $string);
    $string = preg_replace('/upoitcute/', 'Ü', $string);

    return $string;
}

function sanear_numero($numero){

    $numero = str_replace(',','',$numero);
    $numero = str_replace(' ','',$numero);
    $numero = str_replace('.',',',$numero);

    return $numero;

}




/*select primera_consulta.codigo as codigo,primera_consulta.tipo as tipo,primera_consulta.nombre_bien as nombre_bien, primera_consulta.codigo_alias as codigo_alias, primera_consulta.vida_util as vida_util, primera_consulta.kilometro as kilometro, primera_consulta.nombre_departamento as nombre_departamento  from(
    (select bie_tipo_basico.codigo as codigo, bie_tipo_basico.tipo as tipo,bie_tipo_basico.nombre_bien as nombre_bien,bie_tipo_basico.codigo_alias as codigo_alias,bie_tipo_basico.vida_util as vida_util,' ' as kilometro,mno_gerencia.descripcion as nombre_departamento from bie_tipo_basico

inner join mno_gerencia on mno_gerencia.codigo = bie_tipo_basico.codigo_departamento where bie_tipo_basico.eliminado = 'n'
)
union
(select bie_tipo_vehiculo.codigo as codigo,bie_tipo_vehiculo.tipo as tipo,bie_tipo_vehiculo.nombre_bien as nombre_bien,bie_tipo_vehiculo.codigo_alias as codigo_alias,bie_tipo_vehiculo.vida_util as vida_util,bie_tipo_vehiculo.kilometros as kilometro,mno_gerencia.descripcion as nombre_departamento from bie_tipo_vehiculo

inner join mno_gerencia on mno_gerencia.codigo = bie_tipo_vehiculo.codigo_departamento
 where bie_tipo_vehiculo.eliminado = 'n'
)
union

(select bie_tipo_maquinaria.codigo as codigo,bie_tipo_maquinaria.tipo as tipo,bie_tipo_maquinaria.nombre_bien as nombre_bien,bie_tipo_maquinaria.codigo_alias as codigo_alias,bie_tipo_maquinaria.vida_util as vida_util,'' as kilometro,mno_gerencia.descripcion as nombre_departamento from bie_tipo_maquinaria
inner join mno_gerencia on mno_gerencia.codigo = bie_tipo_maquinaria.codigo_departamento where bie_tipo_maquinaria.eliminado = 'n'
)
)as primera_consulta
left join bie_asignaciones on primera_consulta.codigo  = bie_asignaciones.codigo_bien and  primera_consulta.tipo = bie_asignaciones.tipo_bien where bie_asignaciones.codigo_bien is null
*/


