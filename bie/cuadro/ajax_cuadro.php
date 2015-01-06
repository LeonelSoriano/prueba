<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 19/09/14
 * Time: 09:58 AM
 */

if(isset($_POST['codigo']) && isset($_POST['tipo'])){


    require_once('../../db.php');
    require_once('../../clases/funciones.php');

    $tipo = $_POST['tipo'];
    $codigo = $_POST['codigo'];

    echo('<tr id="tmp">');
    echo('<th>Nombre Mantenimiento</th>');
    echo('<th>Periodicidad</th>');
    echo('<th>Último mantenimiento</th>');
    echo('<th>Semáforo</th>');


    echo('<th>Valor</th>');
    echo('<th>Código Contable</th>');
    echo('<th>Código Factura</th>');
    echo('<th>ALERTA</th>');
    echo('</tr>');


    $sql = "SELECT bie_mantenimiento.nombre as nombre_,
bie_mantenimiento.periodicidad as periodicidad,
bie_unidad_medida.nombre as nombre_unidad,
bie_unidad_medida.codigo as codigo_unidad_medida,
bie_realizar_mantenimiento.costo as valor,
bie_realizar_mantenimiento.numero_factura as numero_factura,
bie_realizar_mantenimiento.codigo_contable as codigo_contable,
MAX(bie_realizar_mantenimiento.fecha) as fecha
 FROM bie_realizar_mantenimiento
INNER JOIN bie_mantenimiento as bie_mantenimiento
ON
bie_realizar_mantenimiento.codigo_mantenimiento = bie_mantenimiento.codigo
INNER JOIN bie_unidad_medida
ON
bie_mantenimiento.codigo_tipo_medida = bie_unidad_medida.codigo
INNER JOIN ((SELECT codigo,tipo,nombre_bien FROM bie_tipo_basico)
 union(SELECT codigo,tipo,nombre_bien FROM bie_tipo_activo_principal)
union(SELECT codigo,tipo,nombre_bien FROM bie_tipo_vehiculo)
union(SELECT codigo,tipo,nombre_bien FROM bie_tipo_maquinaria))as tipo_bienes
ON tipo_bienes.codigo = bie_realizar_mantenimiento.codigo_bien AND
tipo_bienes.tipo = bie_realizar_mantenimiento.codigo_bien_tipo
WHERE bie_realizar_mantenimiento.eliminado = 'n' AND
bie_realizar_mantenimiento.fecha <> '' AND bie_realizar_mantenimiento.codigo_bien = '$codigo' AND
bie_realizar_mantenimiento.codigo_bien_tipo = '$tipo'
group by bie_realizar_mantenimiento.codigo_mantenimiento
ORDER BY bie_realizar_mantenimiento.numero_factura;";


    $result=mysql_query($sql);




    echo('<tr>');


    while($test = mysql_fetch_array($result))
    {
        $nombre = $test['nombre_'];
        $periodicidad = $test['periodicidad'];
        $nombre_unidad = $test['nombre_unidad'];
        $fecha = $test['fecha'];
        $codigo_unidad_medida = $test['codigo_unidad_medida'];
        $valor = $test['valor'];
        $codigo_contable = $test['codigo_contable'];
        $numero_factura = $test['numero_factura'];
        $fecha_actual = fecha_sicap();

        echo('<tr>');
//rojo F00600
//amarillo FED201
//verde 0A7311
        echo"<td><font color='black'>". $nombre . "</font></td>";
        echo"<td><font color='black'>". $periodicidad .'('. $nombre_unidad . ')'."</font></td>";
        echo"<td><font color='black'>". $fecha ."</font></td>";

        //este es el semaforo

        //TIPOS DE UNIDADES
        //1)kilometros
        //2)horas 24/dia
        //3)semestre 182/dia
        //4)semana 7/dia
        //7)unidades
        //8)año 365/dia
        //9)Días 1/dia

        $tmp =0;
        $restantes = 0;
        $color_hex = '0A7311';
        $porcentaje_pecaucion = 0;

        if($codigo_unidad_medida == '9'){
            $restantes = dias_transcurridos($fecha_actual,$fecha);

            $restantes = $restantes * 1;

            $periodicidad_convertida = $periodicidad;

            $porcentaje_pecaucion = $periodicidad_convertida * 90 /100;

            if($restantes > $periodicidad_convertida){
                $color_hex = 'F00600';

            }else if(($periodicidad_convertida-$porcentaje_pecaucion) > $restantes && ($periodicidad_convertida-$porcentaje_pecaucion) >= 0){
                $color_hex = 'FED201';
            }

        }if($codigo_unidad_medida == '8'){

            $restantes = dias_transcurridos($fecha_actual,$fecha);

            $periodicidad_convertida = $periodicidad * 365;

            $porcentaje_pecaucion = $periodicidad_convertida * 90 /100;

            if($restantes > $periodicidad_convertida){
                $color_hex = 'F00600';

            }else if(($periodicidad_convertida-$porcentaje_pecaucion) > $restantes && ($periodicidad_convertida-$porcentaje_pecaucion) >= 0){
                $color_hex = 'FED201';
            }

        }if($codigo_unidad_medida == '4'){

            $restantes = dias_transcurridos($fecha_actual,$fecha);

            $periodicidad_convertida = $periodicidad * 7;

            $porcentaje_pecaucion = $periodicidad_convertida * 90 /100;

            if($restantes > $periodicidad_convertida){
                $color_hex = 'F00600';

            }else if(($periodicidad_convertida-$porcentaje_pecaucion) > $restantes && ($periodicidad_convertida-$porcentaje_pecaucion) >= 0){
                $color_hex = 'FED201';
            }

        }if($codigo_unidad_medida == '3'){

            $restantes = dias_transcurridos($fecha_actual,$fecha);

            $periodicidad_convertida = $periodicidad * 182;

            $porcentaje_pecaucion = $periodicidad_convertida * 90 /100;

            if($restantes > $periodicidad_convertida){
                $color_hex = 'F00600';

            }else if(($periodicidad_convertida-$porcentaje_pecaucion) > $restantes && ($periodicidad_convertida-$porcentaje_pecaucion) >= 0){
                $color_hex = 'FED201';
            }

        }if($codigo_unidad_medida == '2'){

            $restantes = dias_transcurridos($fecha_actual,$fecha);

            $restantes = $restantes * 24;

            $periodicidad_convertida = $periodicidad;

            $porcentaje_pecaucion = $periodicidad_convertida * 90 /100;

            if($restantes > $periodicidad_convertida){
                $color_hex = 'F00600';

            }else if(($periodicidad_convertida-$porcentaje_pecaucion) > $restantes && ($periodicidad_convertida-$porcentaje_pecaucion) >= 0){
                $color_hex = 'FED201';
            }

        }




        echo"<td ><div style='background-color: #".$color_hex.";min-width: 16px;min-height: 18px;
            -webkit-border-radius: 20px;
-moz-border-radius: 20px;
border-radius: 20px;margin-top: -8px;margin-bottom: -6px'></div></td>";

        //termino semaforo


        echo"<td><font color='black'>". $valor . "</font></td>";
        echo"<td><font color='black'>". $codigo_contable . "</font></td>";
//        echo"<td><font color='black'>". $numero_factura . "</font></td>";
        echo"<td><font color='black'>". $tmp . "</font></td>";
        echo"<td><font color='black'></font></td>";

        echo('</tr>');

    }


    echo('</tr>');
}