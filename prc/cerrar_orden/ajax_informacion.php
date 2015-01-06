<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 31/08/14
 * Time: 03:05 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');
require_once('../../clases/funciones.php');


if(isset($_POST['codigo_departamento'])){

    require_once('../../clases/funciones.php');


    $codigo = $_POST['codigo'];

    $codigo_departamento = $_POST['codigo_departamento'];

    $hoy = fecha_sicap();

    $sql = "UPDATE prc_orden_trabajo_etapas SET completo='$hoy' WHERE codigo_orden_trabajo='$codigo' AND
        codigo_departamento='$codigo_departamento'";

    $result=mysql_query($sql);

}



if(isset($_POST['codigo']) &&  $_POST['codigo'] != 0){



    $codigo =  $_POST['codigo'];


    $sql = "SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND codigo='$codigo'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);


    $codigo_producto = $test['codigo_producto'];
    $produccion_planificada = $test['produccion_planificada'];
    $fecha_inicio = $test['fecha_inicio'];


    $response_tabla = '';


    $tabla_cabecera =' <table border=none class="tablas-nuevas" style="text-align: center;margin-top: 15px;margin-bottom: 40px">
    <tr>
        <th >Nombre</th>
        <th>Consumo</th>
        <th>Valor</th>
        <th>Fecha</th>
    </tr>';



    $sql = "SELECT * FROM prc_orden_trabajo_etapas WHERE completo = 'n' AND codigo_orden_trabajo='$codigo'";


    $result=mysql_query("$sql");
    while($test = mysql_fetch_array($result)){

        $codigo_d = $test['codigo_departamento'];
        $codigo_orden_trabajo_etapa = $test['codigo'];



        $sql2 = "SELECT * FROM mno_gerencia WHERE codigo = '$codigo_d'";

        $result2=mysql_query($sql2);
        $test2 = mysql_fetch_array($result2);

        $nombre_departamento = $test2['descripcion'];


        $sql2 = "SELECT * FROM prc_etapas WHERE codigo_producto='$codigo_producto'
        AND codigo_departamento='$codigo_d'";


        $result2=mysql_query($sql2);
        $test2 = mysql_fetch_array($result2);

        $codigo_trabajo_etapa = $test2['codigo'];





        $sql2 = "SELECT min_productos_servicios.nombre as nombre,
          min_uso_consumo.cantidad_despacho as despacho,
          min_uso_consumo.costo_articulo as costo, min_uso_consumo.fecha_uso as fecha
          FROM min_uso_consumo
         INNER JOIN min_productos_servicios ON
         min_uso_consumo.cod_articulo = min_productos_servicios.codigo
         WHERE min_uso_consumo.codigo_orden_produccion = '$codigo'
         AND min_uso_consumo.codigo_etapa ='$codigo_trabajo_etapa' ORDER BY min_productos_servicios.nombre";


        $response_tabla .= $tabla_cabecera;


        $result2=mysql_query($sql2);
        while($test2 = mysql_fetch_array($result2)){

            $nombre_consumo = $test2['nombre'];
            $despacho_consumo = $test2['despacho'];
            $costo_consumo = $test2['costo'];
            $fecha_consumo = $test2['fecha'];

            $response_tabla .= "<tr>";
            $response_tabla .= "<td><font color='black'>".utf8_decode( $nombre_consumo) . "</font></td>";
            $response_tabla .= "<td><font color='black'>".utf8_decode( $despacho_consumo) . "</font></td>";
            $response_tabla .= "<td><font color='black'>".formatear_ve( $costo_consumo) . "</font></td>";
            $response_tabla .= "<td><font color='black'>".$fecha_consumo . "</font></td>";
            $response_tabla .= "</tr>";


        }

        $response_tabla .= "<div>".$nombre_departamento."   <a  href='cerrar.php?codigo_departamento=".$codigo_d."&codigo=".$codigo."'><input type='button' value='Cerrar'></a>  </div>";


        //aca termina la tabla de la etapa

    }



    $sql2 = "SELECT count(*) as total FROM prc_orden_trabajo_etapas
        WHERE codigo_orden_trabajo = '$codigo' AND completo = 'n'";

    $result2=mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);

    $total = $test2['total'];


    $required = 'disabled';

    if($total == 0){
        $required = '';
    }



    $sql = "SELECT * FROM min_productos_servicios WHERE codigo = '$codigo_producto'";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $nombre =  utf8_multiplataforma($test['nombre']);


    echo('Nombre: '.$nombre.'   </br></br> Produccion Planificada:   '.$produccion_planificada.'
    <br/><br/>
    Fecha de Inicio: '. $fecha_inicio .'
<br/><br/>


    <form action="cerrar.php" method="POST">
    <label >Comentario&nbsp;&nbsp;&nbsp;&nbsp;</label>
     <textarea rows="3" cols="30" name="comentario"></textarea><br/><br/>
        <input style="margin-right: 12px" type="text" name="produccion" placeholder="Producción Final" '.$required.'/><input value="Cerrar Orden" type="submit" id="enviar" '.$required.'/>
        <input type="hidden" name="codigo_orden_hi" value="'. $codigo .'"/>

    </form>
<br/><br/>
    <hr/><br/>
'. $response_tabla);

}
