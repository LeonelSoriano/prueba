<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/10/14
 * Time: 09:49 AM
 */

include_once("../../clases/funciones.php");

$mes = $_POST['mes'];
$anhio = $_POST['anhio'];
$mensual = $_POST['mensual'];

$numero_lunes =  count(getMondays($anhio,$mes));


echo('

<br/>
<label >Bono eficiencia</label>
<input style="margin-right:15%;margin-top: 8px" type="checkbox" name="bono_eficiencia" id="bono_eficiencia" >

<label >Bono Productividad</label>
<input style="margin-right:15%;margin-top: 8px" type="checkbox" name="bono_productividad" id="bono_productividad" >
<br/>

<label >Bono Fijo</label>
 <input style="margin-right:15%;margin-top: 8px" type="checkbox" name="monto_fijo" id="monto_fijo" >



<label >Diferencia de Salario</label>
<input style="margin-right:15%;margin-top: 8px" type="checkbox" name="diferencia_salario" id="diferencia_salario" >
<br/>

<label> Prima por Matrimonio</label>
<input style="margin-right:15%;margin-top: 8px" type="checkbox" name="prima_matrimonio" id="prima_matrimonio" >

<label >Prima por Nacimiento</label>
<input style="margin-right:15%;margin-top: 8px" type="checkbox" name="prima_nacimiento" id="prima_nacimiento" >
<br/>
            <label >Asistencia Medica</label>
            <input style="margin-right:15%;margin-top: 8px" type="checkbox" name="asistencia_medica_check" id="diferencia_salario" >


<br/><br/>

');




if($mensual == 'si') {


    echo('


<label>Sueldo</label>
<input type="text" name="sueldo_mensual"  size="10" value="0">


  <br/>>');


        echo('
<label>Bono Profesionalizacion</label>
       <input type="text" name="bono_profesionalizacion"  size="10" value="0">

    <br/>');

            echo('

<label>Bono Responsabilidad</label>
        <input type="text" name="bono_responsabilidad"  size="10" value="0">

    <br/>');

    echo('

        <label>Vehiculo</label>
        <input type="text" name="vehiculo"  size="10" value="0">
    <br/>
');



    echo('

        <label>Bono % Ventas Totales</label>
        <input type="text" name="venta_totales"  size="10" value="0">
    <br/>
    ');

    echo('
        <label>Bono % Ventas Acredito</label>
        <input type="text" name="venta_acredito"  size="10" value="0">
    <br/>
    ');

    echo('
        <label>Bono % Ventas Colectivo</label>
        <input type="text" name="venta_colectivo"  size="10" value="0">
    </br>
    ');


    echo('
        <label>Bono % Cobranza </label>
        <input type="text" name="cobranza"  size="10" value="0">
    <br/>
    ');

    echo('

        <label>Días Feriados</label>
        <input type="text" name="dias_feriado"  size="10" value="0">
    <br/>
    ');

    echo('
        <label>Beca Trabajador</label>
        <input type="text" name="beca_trabajador"  size="10" value="0">
    <br/>

    ');

    echo('

        <label>Beca Hijo</label>
        <input type="text" name="beca_hijo"  size="10" value="0">
    <br/>

    ');

    echo('

        <label>Asistencia Medica</label>
        <input type="text" name="asistencia_medica_input"  size="10" value="0">
    <br/>
    ');



    echo('
    <label>Horas Extras Diurnas</label>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <input style="width:8%" type="text" name="exta_diurna_semana'.($i+1).'"  size="10" value="0">');
    }

    echo('<br/>');

    echo('
   <label>Horas Extras Ncoturna</label>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <input style="width:8%" type="text" name="exta_nocturna_semana'.($i+1).'"  size="10" value="0">');
    }

    echo('<br/>');



    echo('
    <label>Cesta Ticket Adicional</label>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo('<input style="width:8%" type="text" name="cestastiket'.($i+1).'"  size="10" value="0">');
    }

    echo('<br/>');


    echo('
    <label>Días Feriados Trabajados</label>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo('<input style="width:8%"  type="text" name="dias_feriado_trabajado'.($i+1).'"  size="10" value="0">');
    }

    echo('<br/>');


}else if($mensual == 'asdsi'){

    echo('<TR>
    <TD ><label>Sueldo</label></TD>');

    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input style="width:8%"  type="text" name="sueldo_semana'.($i+1).'"  size="10"></TD>');
    }

    echo('</TR>');


    echo('<TR>
    <TD ><label>Horas Extras Diurnas</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="exta_diurna_semana'.($i+1).'"  size="10"></TD>');
    }

    echo('</TR>');


    echo('<TR>
    <TD ><label>Horas Extras Ncoturna</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="exta_nocturna_semana'.($i+1).'"  size="10"></TD>');
    }

    echo('</TR>');



    echo('<TR>
    <TD ><label>Cesta Ticket Adicional</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="cestastiket'.($i+1).'"  size="10"></TD>');
    }

    echo('</TR>');


    echo('<TR>
    <TD ><label>Días Feriados</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input style="width:8%"  type="text" name="dias_feriado'.($i+1).'"  size="10"></TD>');
    }

    echo('</TR>');


}




//echo('  <TABLE BORDER="0" CELLSPACING="10" >
//                                <TR>
//                                    <TD><label>Cédula de Empleado</label></TD>
//                                    <td> <input type="text" name="cedula"  disabled></td><td><input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
//                                    </TD>
//
//                                    <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
//                                    <input type="hidden" name="cedula_hi" id="cedula_hi"/>
//                                </TR>
//
//                             </TABLE>   ');