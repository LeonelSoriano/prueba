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
            <label style="margin-left: 10px">Bono eficiencia</label>
             <input type="checkbox" name="bono_eficiencia" id="bono_eficiencia" >

                        <label style="margin-left: 72px">Bono Productividad</label>
            <input type="checkbox" name="bono_productividad" id="bono_productividad" >


             <label style="margin-left: 72px">Bono Fijo</label>
            <input type="checkbox" name="monto_fijo" id="monto_fijo" >

<br/><br/>

                        <label style="margin-left: 30px">Diferencia de Salario</label>
            <input type="checkbox" name="diferencia_salario" id="diferencia_salario" >

                <label style="margin-left: 24px">Prima por Matrimonio</label>
            <input type="checkbox" name="prima_matrimonio" id="prima_matrimonio" >

</br></br>

                <label style="margin-left: 10px">Prima por Nacimiento</label>
            <input type="checkbox" name="prima_nacimiento" id="prima_nacimiento" >

            <label style="margin-left: 33px">Asistencia Medica</label>
            <input type="checkbox" name="asistencia_medica_check" id="diferencia_salario" >

<br/><br/>

');



echo('<TABLE BORDER="0" CELLSPACING="10" >');

if($mensual == 'si') {


    echo('

    <TR>
        <TD ><label>Sueldo</label></TD>
        <TD ><input type="text" name="sueldo_mensual"  size="10" value="0"></TD>
    </TR>

    <tr>');


        echo('
    <TR>
        <TD ><label>Bono Profesionalizacion</label></TD>
        <TD ><input type="text" name="bono_profesionalizacion"  size="10" value="0"></TD>
    </TR>

    <tr>');

            echo('
    <TR>
        <TD ><label>Bono Responsabilidad</label></TD>
        <TD ><input type="text" name="bono_responsabilidad"  size="10" value="0"></TD>
    </TR>

    <tr>');

    echo('
    <TR>
        <TD ><label>Vehiculo</label></TD>
        <TD ><input type="text" name="vehiculo"  size="10" value="0"></TD>
    </TR>

    <tr>');



    echo('
    <tr>
        <td>Bono % Ventas Totales</td>
        <TD ><input type="text" name="venta_totales"  size="10" value="0"></TD>
    </tr>
    ');

    echo('
    <tr>
        <td>Bono % Ventas Acredito</td>
        <TD ><input type="text" name="venta_acredito"  size="10" value="0"></TD>
    </tr>
    ');

    echo('
    <tr>
        <td>Bono % Ventas Colectivo</td>
        <TD ><input type="text" name="venta_colectivo"  size="10" value="0"></TD>
    </tr>
    ');


    echo('
    <tr>
        <td>Bono % Cobranza </td>
        <TD ><input type="text" name="cobranza"  size="10" value="0"></TD>
    </tr>
    ');

    echo('

    <tr>
        <td>Días Feriados</td>
        <TD ><input type="text" name="dias_feriado"  size="10" value="0"></TD>
    </tr>


    ');

    echo('

    <tr>
        <td>Beca Trabajador</td>
        <TD ><input type="text" name="beca_trabajador"  size="10" value="0"></TD>
    </tr>

    ');

    echo('

    <tr>
        <td>Beca Hijo</td>
        <TD ><input type="text" name="beca_hijo"  size="10" value="0"></TD>
    </tr>

    ');

    echo('

    <tr>
        <td>Asistencia Medica</td>
        <TD ><input type="text" name="asistencia_medica_input"  size="10" value="0"></TD>
    </tr>


    ');



    echo('<TR>
    <TD ><label>Horas Extras Diurnas</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="exta_diurna_semana'.($i+1).'"  size="10" value="0"></TD>');
    }

    echo('</TR>');


    echo('<TR>
    <TD ><label>Horas Extras Ncoturna</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="exta_nocturna_semana'.($i+1).'"  size="10" value="0"></TD>');
    }

    echo('</TR>');



    echo('<TR>
    <TD ><label>Cesta Ticket Adicional</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="cestastiket'.($i+1).'"  size="10" value="0"></TD>');
    }

    echo('</TR>');


    echo('<TR>
    <TD ><label>Días Feriados Trabajados</label></TD>');
    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="dias_feriado_trabajado'.($i+1).'"  size="10" value="0"></TD>');
    }

    echo('</TR>');



}else if($mensual == 'si'){

    echo('<TR>
    <TD ><label>Sueldo</label></TD>');

    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="sueldo_semana'.($i+1).'"  size="10"></TD>');
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
        echo(' <TD ><input type="text" name="dias_feriado'.($i+1).'"  size="10"></TD>');
    }

    echo('</TR>');


}


echo('</TABLE>');

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