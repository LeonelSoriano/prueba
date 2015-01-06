<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 19/12/14
 * Time: 01:01 PM
 */


ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once("../../db.php");

include_once("../../clases/ChartFactory.php");
include("../../clases/funciones.php");

$a = new ChartFactory('Empleados');

$sql = '';


$filtrado_sql = $_POST['filtrado'];

if($filtrado_sql == "departamento"){

    $sql = "SELECT
    mno_gerencia.descripcion as gerencia,
    count(mrh_empleado.codigo) as total
FROM
    mrh_empleado INNER JOIN mno_gerencia
        ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
 GROUP BY mno_gerencia.descripcion";

}else if($filtrado_sql == 'tipo_empleado'){

    $sql = "
    SELECT
    IF(mrh_empleado.tipo_trabajador='EMP','Empleado','Obrero') as gerencia,

    count(mrh_empleado.codigo) as total
FROM
    mrh_empleado
GROUP BY
    mrh_empleado.tipo_trabajador";
}




$result=mysql_query($sql);


$valores = array();
$nombres = array();

$filtrado = $_POST['chart'];

while($test = mysql_fetch_array($result))
{
    $nombre_inventario = $test['gerencia'];
    $total_inventario = $test['total'];

    if($filtrado == "bar_value"){
        array_push($nombres,$nombre_inventario );
    }else{
        array_push($nombres,$nombre_inventario );
    }
    array_push($valores,(float)$total_inventario);

}


//$tipo,$nombres,$valores,$barra_horisontal='',$barra_vertical=''



if($filtrado == "pie2d"){
    $a->create_chart(0,$valores,$nombres);
}else if($filtrado == "pie3d"){
    $a->create_chart(1,$valores,$nombres);
}else if($filtrado == "bar_value"){
    $a->create_chart(2,$valores,$nombres,'Inventario','Costo');
}else if($filtrado == "bar_porcent"){
    $a->create_chart(3,$valores,$nombres,'Inventario','Costo');
}

mysql_close($conn);


//?>