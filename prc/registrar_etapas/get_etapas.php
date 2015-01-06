<?php

include("../../db.php");

$codigo = $_POST['codigo'];



$sql = "SELECT * FROM prc_etapas WHERE codigo_producto='$codigo'";


$result=mysql_query($sql);


$str_return = "";

$str_return .= '<br/><br/>
    <table style="text-align: center;width: 80%" border=none class="tablas-nuevas" >
            <tr>
                <th>Nombre</th>
                <th>Eliminar</th>
            </tr>
';

while($test = mysql_fetch_array($result)){

    $codigo_departamento = $test['codigo_departamento'];
    $codigo_etapa = $test['codigo'];

    $sql2 = "SELECT * FROM mno_gerencia WHERE codigo='$codigo_departamento'";

    $result2=mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);
    $nombre = $test2["descripcion"];



    $str_return .= "<tr align='center' >";
    $str_return .= "<td> $nombre</td>";
    $str_return .= "<td style='width: 150px'><a href='agregar_descripcion_etapa.php?id=$codigo_etapa&codigo_producto=$codigo' >Modificar</a></td>";
    $str_return .= "</tr>";


}
mysql_close($conn);
$str_return .= "</table>";

echo($str_return);


