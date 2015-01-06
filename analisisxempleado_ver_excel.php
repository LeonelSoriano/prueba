<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
    $file="analisisxempleado.xls";
    $test="<table>"
            . "<tr>"
                . "<td>SICAP</td>"
                . "<td>Versión 1.0</td>"
            . "</tr>"
            . "</table>";

    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
    echo $test;
?>

<table border=1>
      <?php
	include("db.php");
        $cedula =$_POST['cedulaempleado'];
        $result=mysql_query("SELECT * FROM mrh_empleado Where Cedula ='$cedula'");
        while($test = mysql_fetch_array($result)){
            $nombre = strtoupper($test['primernombre']);
            $apellido = strtoupper($test['primerapellido']);
        }
        $mes = $_POST['mes'];
        
        echo"<td><font color='black'> ".$cedula." </font></td>";
        echo"<td><font color='black'> ".$nombre." </font></td>";
        echo"<td><font color='black'> ".$apellido." </font></td>";

        echo "<tr>";
        echo "<td>Descripción</td>  <!-- Nombre Turno -->";
        echo "<td>Mes</td>  <!-- Mes -->";
        echo "<td>H/E</td>  <!-- Hora de Entrada  -->";
        echo "<td>H/S</td>   <!-- Hora de Salida -->";
        echo "<td>H/D</td>    <!-- Hora de Descanso -->";
        echo "<td>T</td>    <!-- Turno -->";
        echo "<td>DT</td>    <!-- Dias Trabajados -->";
        echo "<td>HTD</td>    <!-- Hora de Trabajo Diario -->";
        echo "<td>HTS</td>    <!-- Hora de Trabajo Semanal -->";
        echo "<td>HPL</td>    <!-- Horas Permitidas Laborales -->";
        echo "<td>THE</td>    <!-- Total Horas Extras -->";
        echo "<td>HED</td>    <!-- Horas Extra Diurnas -->";
        echo "<td>HEN</td>    <!-- Horas Extra Nocturnas -->";
        echo "<td>HTM</td>    <!-- Horas de Trabajo Mensual -->";
        echo "<td>HND</td>    <!-- Horas Nocturnas Diarias -->";
        echo "<td>HNS</td>    <!-- Horas Nocturnas Semanales -->";
        echo "<td>HNM</td>    <!-- Horas Nocturnas Mensuales -->";
        echo "<td>BND</td>    <!-- Bono Nocturno Diario -->";
        echo "<td>BNS</td>    <!-- Bono Nocturno Semanal-->";
        echo "<td>BNM</td>    <!-- Bono Nocturno Mensual -->";
        echo "<td>NSM</td>";
        echo "</tr>";
        
        $result=mysql_query("SELECT * FROM mrh_view_analisisxempleado WHERE cedulaempleado='$cedula' and codigomes='$mes' ORDER BY descripcion");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $mes_dias =dias($mes);
                    $id = $test['codigo'];	
                    $horatmensual = $test['horatsemana']*$mes_dias;
                    $hrsnocmensual = $test['hrsnocmensual']*$mes_dias;
                    $bononocmensual = $test['bononocmensual']*$mes_dias;
                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['descripcion']. "</font></td>";
                    echo"<td><font color='black'>". $test['codigomes']. "</font></td>";
                    echo"<td><font color='black'>". $test['horaentrada']."</font></td>";
                    echo"<td><font color='black'>". $test['horasalida']. "</font></td>";
                    echo"<td><font color='black'>". $test['horadescanso']. "</font></td>";
                    echo"<td><font color='black'>". $test['descripciontipoturno']."</font></td>";
                    echo"<td><font color='black'>". $test['diaslaborales']. "</font></td>";
                    echo"<td><font color='black'>". $test['horatdiario']. "</font></td>";
                    echo"<td><font color='black'>". $test['horatsemana']. "</font></td>";
                    echo"<td><font color='black'>". $test['hrslabpermitidas']."</font></td>";
                    echo"<td><font color='black'>". $test['totalhrsextra']."</font></td>";
                    echo"<td><font color='black'>". $test['horaextradiurno']. "</font></td>";
                    echo"<td><font color='black'>". $test['horaextranocturno']."</font></td>";
                    echo"<td><font color='black'>". $horatmensual. "</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocdiarias']. "</font></td>";
                    echo"<td><font color='black'>". $test['hrsnocsemanal']. "</font></td>";
                    echo"<td><font color='black'>". $hrsnocmensual. "</font></td>";
                    echo"<td><font color='black'>". $test['bononocdiario']. "</font></td>";
                    echo"<td><font color='black'>". $test['bononocsemanal']."</font></td>";
                    echo"<td><font color='black'>". $bononocmensual . "</font></td>";
                    echo"<td><font color='black'>". $mes_dias . "</font></td>";
                    echo "</tr>";
		}
	mysql_close($conn);
        
function dias($dato){
    if(trim($dato)!=""){
        $cant_dias = date('t',strtotime(date('Y').$dato.'-'.'01-'));
        $lunes = 0;
        for($i=1; $i<=$cant_dias; $i++){
            if(date('w',strtotime(date('Y').'-'.$dato.'-'.$i))==6){
                $lunes++;
            }
        }
        return $lunes;
    }
    else{
        return 'Error';
    }
}
    ?>
</table>