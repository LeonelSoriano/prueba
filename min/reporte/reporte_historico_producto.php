<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 12/11/14
 * Time: 04:24 PM
 */


$str = json_decode($_POST['post_array'], true);

$cantidad1 = count($str);

$fake_POST = array();


$codigo_articulos = '';
$primer_filtro = true;

for ($i = 1; $i < $cantidad1; $i++) {


    $tmp_json = json_encode($str[$i], JSON_UNESCAPED_UNICODE);


    $nombre = json_decode($tmp_json)->{'Nombre'};
    $codigo_producto = json_decode($tmp_json)->{'codigo_producto_hi'};


    if($primer_filtro){
        $codigo_articulos = " WHERE min_productos_servicios.codigo ='$codigo_producto' ";
        $primer_filtro = false;
    }else{
        $codigo_articulos .= " AND min_productos_servicios.codigo ='$codigo_producto' ";
    }


}
    require_once('./../../db.php');
    include_once('../../clases/ReporteDivicion.php');
    require_once("./../../clases/funciones.php");

    $a = new ReporteDivicion();

    $extras = array();
    $extras['Historial de Compra'] = "";


    $asd = utf8_decode('Importación');

        $historial_tipo = '';
        if($_POST['tipo'] == "compra"){
            $historial_tipo = 'Compra';
        }else if($_POST['tipo'] == "venta"){
            $historial_tipo = "Venta";
        }

    $a->configure_header("Historial de ".$historial_tipo,"asd",'./../../images/empresalogo.jpg',$extras);
    $a->print_header();


    $sql = '';

    if($_POST['tipo'] == "compra"){

        $sql = "SELECT
min_compra.fecha_compra as fecha,
    min_productos_servicios.nombre as nombre,
	min_compra.cantidad as cantidad,
	min_compra.monto_factura as factura,
min_compra.costo_total as costo,
	min_empresa.codigo_alias as 'Proveedor',
min_compra.flete as flete,
min_compra_importacion.gasto_importacion as '".$asd."'

FROM
    min_compra
INNER JOIN min_productos_servicios
ON min_compra.codigo_articulo = min_productos_servicios.codigo
INNER JOIN min_empresa
ON min_empresa.codigo = min_compra.codigo_proveedor
INNER JOIN min_compra_importacion
ON min_compra_importacion.codigo_compra = min_compra.codigo
".$codigo_articulos."
ORDER BY min_compra.fecha_compra";
    }else{

        $sql = "
        SELECT
	min_ventas.fecha_venta as 'Fecha',
	min_productos_servicios.nombre as 'Nombre',
	min_ventas.cantidad as 'Total de Unidades',
	min_ventas.costo_unidad as 'Valor Unidad',
min_empresa.codigo_alias as 'Cliente',
min_ventas.devolucion as 'Devolucion'

 FROM min_ventas
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = min_ventas.codigo_articulo
INNER JOIN min_empresa
ON min_empresa.codigo = min_ventas.codigo_cliente
".$codigo_articulos."
ORDER BY min_ventas.fecha_venta ";


    }

    $a->exec_sql($sql);


    $a->setDivicionIndex(0);
    $a->setPrefixSubdivicion("Inventario: ");

if($_POST['tipo'] != "compra"){
    $a->addMoney(2);
}
//    $a->addMoney(2);

//    $a->addMoney(4);
    $a->print_body();

    $a->exec();





