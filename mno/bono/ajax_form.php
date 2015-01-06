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

echo('<TABLE BORDER="0" CELLSPACING="10" >');

if($mensual == 'si'){

    echo('    <TR>
        <TD ><label>Valor</label></TD>
        <TD ><input type="text" name="valor"  size="20"></TD>
    </TR>



    ');

}else if($mensual == 'no'){

    echo('<TR>
    <TD ><label>Valor</label></TD>');

    for($i = 0;$i < $numero_lunes; $i++){
        echo(' <TD ><input type="text" name="valor'.($i+1).'"  size="10"></TD>');
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