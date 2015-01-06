<?php


include("../../db.php");
//articulo detalle
$codigo_articulo = $_POST['codigo_articulo'];

//articulo producto
$codigo_producto = $_POST['codigo_producto'];
$codigo_etapa= $_POST['codigo_etapa'];

$cantidad = '';
$codigo_articulo = '';

if(isset($_POST['cantidad']) && isset( $_POST['codigo_articulo'])){
    $cantidad = str_replace(',','.',$_POST['cantidad']) ;
    $codigo_articulo = $_POST['codigo_articulo'];
}







$sql = "SELECT COUNT(*) AS cuantos FROM prc_detalle_etapa  WHERE codigo_producto_detalle='$codigo_articulo'
AND  codigo_etapa='$codigo_etapa'";


$resultado =  mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
$data=mysql_fetch_assoc($resultado);
$cantidad_count = $data['cuantos'];

if($cantidad_count != 0 &&  isset($_POST['cantidad'])){

    echo('<span> ya has asignado ese articulo a esta etapa </span>');


}else if(isset($_POST['cantidad'])){
    $sql = "INSERT INTO prc_detalle_etapa (codigo_producto,cantidad_estandar,codigo_etapa,codigo_producto_detalle)
    VALUES('$codigo_producto','$cantidad','$codigo_etapa','$codigo_articulo') ";


    $result=mysql_query($sql);
}



//actualizo tabla

$sql = "SELECT * FROM prc_detalle_etapa WHERE codigo_producto='$codigo_producto' AND codigo_etapa='$codigo_etapa'";


$result=mysql_query($sql);


$str_return = "";

$str_return .= '<br/><br/>
     <table style="text-align: center;width: 110%" border=none class="tablas-nuevas" id="tabla_resultado">
            <tr style="text-align: center;">
                <th>Nombre</th>
                <th>Cantidad Estadar</th>
                <th></th>
                <th></th>
            </tr>
';

while($test = mysql_fetch_array($result)){

    $cantidad_estandar = $test['cantidad_estandar'];
    $codigo_producto_detalle = $test['codigo_producto_detalle'];

    $sql2 = "SELECT * FROM min_productos_servicios WHERE codigo='$codigo_producto_detalle'";

    $result2=mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);
    $nombre = $test2["nombre"];



    $str_return .= "<tr >";
    $str_return .= "<td style='text-align: left'>". utf8_decode($nombre) ."</td>";
    $str_return .= "<td style='text-align: left'> ". str_replace('.',',',$cantidad_estandar)."</td>";
    $str_return .= "<td><a href='agregar_descripcion_etapa.php?id=1' >eliminar</a></td>";
    $str_return .= "<td><a href='agregar_descripcion_etapa.php?id=1'>Modificar</a></td>";
    $str_return .= "</tr>";

    /* TODO agregar los eliminar y modificar */
}
mysql_close($conn);
$str_return .= "</table>";

echo($str_return);


