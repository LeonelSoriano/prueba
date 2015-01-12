<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 10:46 AM
 */


include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');


$empleado_ver = '';


$result=mysql_query("SELECT
                          mrh_empleado.codigo as codigo,
                          mrh_empleado.cedula as cedula,
                          mrh_empleado.ficha as ficha,
                          mrh_empleado.primernombre as primernombre,
                          mrh_empleado.primerapellido as primerapellido,
                          mrh_empleado.segundonombre as segundonombre,
                          mrh_empleado.segundoapellido as segundoapellido,
                          mrh_empleado.nacionalidad as condicion,
                          mrh_empleado.fechanacimiento as fechanacimiento,
                          mrh_empleado.telefono as telefono,
                          mrh_empleado.estatus as estatus,
                          mrh_cargo.descripcion as cargo
                        FROM mrh_empleado
                        INNER JOIN mrh_cargo
                        ON mrh_cargo.codigo = mrh_empleado.codigocargo
                        ORDER BY mrh_empleado.cedula*1");
while($test = mysql_fetch_array($result))
{
    //  calculos de horas
    $id = $test['codigo'];
    $cedula =$test['cedula'];
    $empleado_ver .= "<tr align='center'>";
    //echo"<td><font color='black'>" .$test['co digo']."</font></td>";

    $empleado_ver .= "<td><font color='black'>". $test['cedula']. "</font></td>";
    $empleado_ver .= "<td><font color='black'>". $test['condicion']. "</font></td>";
    $empleado_ver .= "<td><font color='black'>" .$test['ficha']."</font></td>";
    $empleado_ver .= "<td><font color='black'>". $test['primernombre']." ".$test['segundonombre']. "</font></td>";
    $empleado_ver .= "<td><font color='black'>". $test['primerapellido']." ".$test['segundoapellido']. "</font></td>";

    $empleado_ver .= "<td><font color='black'>" .$test['fechanacimiento']."</font></td>";
    $empleado_ver .= "<td><font color='black'>". $test['telefono']. "</font></td>";
    $empleado_ver .= "<td><font color='black'>". $test['estatus']. "</font></td>";
    $empleado_ver .= "<td><font color='black'>". $test['cargo']. "</font></td>";
    $empleado_ver .= "<td> <a href ='empleados_mod.php?codigo=$id'>Modificar</a>";
    $empleado_ver .= "<td> <a href ='empleados_del.php?codigo=$id'><center>Borrar</center></a>";
    $empleado_ver .= "<td> <a href ='carga.php?codigo=$id'><center>Carga Familiar</center></a>";
    $empleado_ver .= "</tr>";
}




$layout = new LayoutForm('Módulo de Recursos Humanos | Empleado Ver','.');

$layout->append_to_header('
 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: "yy-mm-dd" });
        $( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd" });
        $( "#datepicker3" ).datepicker({ dateFormat: "yy-mm-dd" });
    });
</script>
 ');

$layout->get_header();


$layout->set_form(
    '

    <table  class="tablas-nuevas">
    <tr style="text-align: center">

        <th>Cédula</th>
        <th>Nacionalidad</th>
        <th>Ficha</th>
        <th>Nombres</th>
        <th>Apellidos</th>

        <th>Edad</th>
        <th>Teléfono</th>
        <th>Estatus</th>
        <th>Cargo</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>

'.$empleado_ver.'

</table>
<br/>
  <td><a href="empleados.php"><input type="button" value="Atras"></a></td>
    '


);