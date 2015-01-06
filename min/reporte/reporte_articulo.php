<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 28/10/14
 * Time: 03:10 PM
 */
?>

<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


?>

<?php

require_once('./../../db.php');
include_once('../../clases/ReporteDivicion.php');
require_once("./../../clases/funciones.php");

$a = new ReporteDivicion();

$extras = array();
$extras['Reportes de Inventarios '] = "";


$filtrado = '';
$post = $_POST;

$primera_entrada = true;
$otro_filtrado = false;
$hubo_filtro = false;


foreach ($post as $key => $val) {

    $hubo_filtro = true;

    if (strpos($key,'checkbox_') !== false) {
        if($primera_entrada){
            $filtrado .= 'WHERE (';
        }

        $codigo_inventario = str_replace('checkbox_','',$key);

        if($otro_filtrado){
            $filtrado .= " OR ";
        }

        $filtrado .= "min_productos_servicios.inventario = '$codigo_inventario' ";

        $otro_filtrado = true;

        $primera_entrada = false;
    }
}

if($hubo_filtro){
    $filtrado .= ' ) ';
}

if($_POST['filtrado'] == 'con'){
    if($primera_entrada){
        $filtrado .= 'WHERE ';
    }

    if($otro_filtrado){
        $filtrado .= " AND ";
    }

    $filtrado .= " min_valoracion.unidades <> '0' ";

    $otro_filtrado = true;

    $primera_entrada = false;

}else if($_POST['filtrado'] == 'sin'){
    if($primera_entrada){
        $filtrado .= 'WHERE ';
    }

    if($otro_filtrado){
        $filtrado .= " AND ";
    }

    $filtrado .= " min_valoracion.unidades = '0' ";

    $otro_filtrado = true;

    $primera_entrada = false;

}


$sql = "SELECT * FROM mco_empresa";

$result = mysql_query($sql);

$test = mysql_fetch_array($result);

$direccion =  $test['direccion'];



$a->configure_header("Reporte de Inventario",$direccion,'./../../images/empresalogo.jpg',$extras);
$a->print_header();


$a->alinght('R',2);
$a->alinght('R',3);
$a->alinght('R',4);

$a->exec_sql('
    SELECT * FROM (SELECT
    a.nombre AS nombre ,
    a.Inventario AS inventario ,
    a.tipo_medida AS tipo_medida ,
    a.unidades AS unidades ,
    a.precio AS precio ,
    a.costo AS total
FROM
    (


        SELECT
            min_productos_servicios.nombre AS Nombre ,
            min_tipo_inventario.tipo AS Inventario ,
            mco_unidad.descripcion AS tipo_medida ,
            min_valoracion.unidades AS unidades ,
            min_valoracion.promedio_actual AS precio ,
            (min_valoracion.unidades*min_valoracion.promedio_actual) AS costo ,
            min_productos_servicios.nombre AS Nombre2
        FROM
            min_productos_servicios INNER JOIN mco_unidad
                ON mco_unidad.codigo = min_productos_servicios.mco_unidad INNER JOIN min_tipo_inventario
                ON min_tipo_inventario.codigo = min_productos_servicios.inventario INNER JOIN min_valoracion
                ON min_valoracion.codigo = min_productos_servicios.codigo
       '.$filtrado.'
    UNION ALL SELECT
            "Subtotal" AS Nombre ,
            min_tipo_inventario.tipo AS Inventario ,
            "" AS tipo_medida ,
            SUM(min_valoracion.unidades) AS unidades ,
            SUM(min_valoracion.promedio_actual) AS precio ,
            SUM(min_valoracion.unidades*min_valoracion.promedio_actual) AS costo ,
            "ZZZZZZZZZZZZZZZZZZZZZZZ" AS Nombre2
        FROM
            min_productos_servicios INNER JOIN mco_unidad
                ON mco_unidad.codigo = min_productos_servicios.mco_unidad INNER JOIN min_tipo_inventario
                ON min_tipo_inventario.codigo = min_productos_servicios.inventario INNER JOIN min_valoracion
                ON min_valoracion.codigo = min_productos_servicios.codigo
        '.$filtrado.'
        GROUP BY
            min_tipo_inventario.codigo
   ORDER BY
     Inventario ,
    Nombre2
    ) AS a



 UNION     SELECT
            "Total" AS Nombre ,
            " " AS Inventario ,
            "" AS tipo_medida ,
            SUM(min_valoracion.unidades) AS unidades ,
            SUM(min_valoracion.promedio_actual) AS precio ,
            SUM(min_valoracion.unidades*min_valoracion.promedio_actual) AS costo

        FROM
            min_productos_servicios INNER JOIN mco_unidad
                ON mco_unidad.codigo = min_productos_servicios.mco_unidad INNER JOIN min_tipo_inventario
                ON min_tipo_inventario.codigo = min_productos_servicios.inventario INNER JOIN min_valoracion
                ON min_valoracion.codigo = min_productos_servicios.codigo
        '.$filtrado.'


    ) as b
');
/*
$a->exec_sql('SELECT
    min_productos_servicios.nombre as "Nombre",
	min_tipo_inventario.tipo as "Inventario",
	mco_unidad.descripcion as "Tipo de Medida",
	min_valoracion.unidades as "Unidades",
	min_valoracion.promedio_actual as "Precio",
	(min_valoracion.unidades*min_valoracion.promedio_actual) as "Costo Total"

FROM
    min_productos_servicios
INNER JOIN mco_unidad
ON mco_unidad.codigo = min_productos_servicios.mco_unidad
INNER JOIN min_tipo_inventario
ON min_tipo_inventario.codigo = min_productos_servicios.inventario
INNER JOIN min_valoracion
ON min_valoracion.codigo = min_productos_servicios.codigo ' . $filtrado .
'ORDER BY min_tipo_inventario.tipo,min_productos_servicios.nombre');

*/

$a->setDivicionIndex(1);
$a->setPrefixSubdivicion("Inventario: ");
$a->addMoney(2);
$a->addMoney(3);
$a->addMoney(4);
$a->print_body();
$a->exec();

?>