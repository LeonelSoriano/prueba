<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
$file="turnos.xls";
$test="<table  ><tr><td>SICAP</td><td>Versión 1.0</td></tr></table>";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $test;
?>

<table border=1>
    <tr>
        <td>Descripción</td>
        <td>H/E</td>
        <td>H/S</td>
        <td>H/D</td>
        <td>T</td>
        <td>DT</td>
        <td>HTD</td>
        <td>HTS</td>
        <td>HPL</td>
        <td>THE</td>
        <td>HED</td>
        <td>HEN</td>
        <td>HTM</td>
        <td>HND</td>
        <td>HNS</td>
        <td>HNM</td>
        <td>BND</td>
        <td>BNS</td>
        <td>BNM</td>

    </tr>
    <?php
	include("db.php");
	$result=mysql_query("SELECT * FROM mrh_turnos");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    echo "<tr align='center'>";	
                    echo"<td><font color='black'>". $test['descripcion']. "</font></td>";
                    echo"<td><font color='black'>" .$test['horaentrada']."</font></td>";
                    echo"<td><font color='black'>". $test['horasalida']. "</font></td>";
                    echo"<td><font color='black'>". $test['horadescanso']. "</font></td>";
                    echo"<td><font color='black'>" .$test['descripciontipoturno']."</font></td>";
                    echo"<td><font color='black'>". $test['diaslaborales']. "</font></td>";
                    echo"<td><font color='black'>". $test['horaextradiurno']. "</font></td>";
                    echo"<td><font color='black'>" .$test['horaextranocturno']."</font></td>";
                    echo"<td><font color='black'>". $test['horatdiario']. "</font></td>";
                    echo"<td><font color='black'>". $test['horatsemana']. "</font></td>";
                    echo"<td><font color='black'>". $test['horatmensual']. "</font></td>";
                    echo"<td><font color='black'>" .$test['totalhrsextra']."</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocdiarias']. "</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocsemanal']. "</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocmensual']. "</font></td>";
                    echo"<td><font color='black'>" .$test['hrslabpermitidas']."</font></td>";
                    echo"<td><font color='black'>". $test['bononocdiario']. "</font></td>";
                    echo"<td><font color='black'>" .$test['bononocsemanal']."</font></td>";
                    echo"<td><font color='black'>". $test['bononocmensual']. "</font></td>";
                    
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 
