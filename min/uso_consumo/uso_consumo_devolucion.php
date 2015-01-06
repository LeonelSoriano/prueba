<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 19/11/14
 * Time: 01:06 PM
 */
?>


<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){

    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'requisicion_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'cantidad_devolucion',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'id',
            'requerida' => true,
            'regla' => 'number')

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){


        $requisicion_cantidad = $_POST['requisicion_hi'];
        $devolucion = $_POST['cantidad_devolucion'];
        $tipo_retiro = $_POST['retiro'];
        $id = $_POST['id'];
        $valoracion_form = $_POST['valoracion'];

        $fecha_actual = fecha_sicap();


        if(($requisicion_cantidad - $devolucion)< 0){
            $current_url = explode("?", $_SERVER['REQUEST_URI']);

            $primer_parametro = explode("&",$current_url[1]);

            header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=No Puedes Retirar Más de lo que Tienes');
            die;

        }



        $sql = "SELECT * FROM min_requisicion_etapa INNER JOIN min_productos_servicios ON min_productos_servicios.codigo = min_requisicion_etapa.codigo_producto
WHERE min_requisicion_etapa.codigo ='$id'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        $unidades = $test['unidades'];
        $nombre = $test['nombre'];
        $fecha = $test['fecha'];
        $valoracion = $test['valoracion'];
        $unidades = $test['unidades'];
        $costo = $test['costo'];
        $codigo_producto = $test['codigo_producto'];
        $codigo_departamento = $test['codigo_departamento'];


        $sql = "SELECT  * FROM min_valoracion_produccion WHERE codigo_producto ='$codigo_producto' ";

        $result = mysql_query($sql);
        $test = mysql_fetch_array($result);

        $unidades_produccion = $test['unidades'];
        $costo_total_produccion = $test['costo_total'];
        $promedio_actual_produccion = $test['promedio_actual'];


        $nueva_valoracion_produccion_unidades = $unidades_produccion - $devolucion;

        $nueva_valoracion_produccion_costo = $nueva_valoracion_produccion_unidades * $promedio_actual_produccion;


        $sql = "UPDATE min_valoracion_produccion SET
                  unidades = '$nueva_valoracion_produccion_unidades',
                  costo_total = '$nueva_valoracion_produccion_costo',
                  promedio_actual = '$promedio_actual_produccion'
                  WHERE codigo_departamento = '$codigo_departamento'
                  AND codigo_producto = '$codigo_producto'";


        $result = mysql_query($sql) or die('No se pudo guardar la información. min_valoracion_produccion' . mysql_error());


        $sql = "UPDATE min_requisicion_etapa SET unidades ='".($requisicion_cantidad - $devolucion)."',
            valoracion = '$valoracion_form', costo = '".($valoracion_form*(($requisicion_cantidad - $devolucion)))."'
        ";

        $result = mysql_query($sql) or die('No se pudo guardar la información. min_requisicion_etapa' . mysql_error());

        if($tipo_retiro == 'no_uso'){

            $sql = "SELECT * FROM min_valoracion WHERE  codigo_producto ='$codigo_producto' ";

            $result = mysql_query($sql);
            $test = mysql_fetch_array($result);

            $unidades_valoracion = $test['unidades'];
            $costo_total_valoracion = $test['costo_total'];
            $promedio_actual_valoracion = $test['promedio_actual'];


            $unidades_valoracion_actualizado = $unidades_valoracion + $devolucion;

            $costo_total_valoracion_ctualizado = $costo_total_valoracion + $nueva_valoracion_produccion_costo;


            $promedio_valoracion_actualizado = $costo_total_valoracion_ctualizado/$unidades_valoracion_actualizado;

            $sql = "UPDATE min_valoracion SET
                    unidades = '$unidades_valoracion_actualizado ',
                    costo_total = '$costo_total_valoracion_ctualizado',
                    promedio_actual = '$promedio_valoracion_actualizado'
                WHERE codigo_producto ='$codigo_producto'";

            $result = mysql_query($sql) or die('No se pudo guardar la información. min_valoracion' . mysql_error());


        }else{
                $sql = "INSERT INTO min_desincorporacion(codigo_producto,cantidad,costo,valor_unitario,fecha,comentario,retiro)
            values ('$codigo_producto','$devolucion','".($devolucion*$valoracion)."','$valoracion','$fecha_actual',
            ' ','$tipo_retiro')";

            $result = mysql_query($sql) or die('No se pudo guardar la información. min_desincorporacion' . mysql_error());

        }

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Correctamente');

        die;

    }else if($validated->getIsError()){

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Error en el Formulario');
        die;

    }
}


?>


<?php

    if(isset($_GET['codigo'])){
        $codigo = $_GET['codigo'];
        $sql = "SELECT * FROM min_requisicion_etapa INNER JOIN min_productos_servicios ON min_productos_servicios.codigo = min_requisicion_etapa.codigo_producto
WHERE min_requisicion_etapa.codigo ='$codigo'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        $unidades = $test['unidades'];
        $valoracion = $test['valoracion'];
        $nombre = $test['nombre'];
        $fecha = $test['fecha'];
    }

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>

    <script type="text/javascript">

        $(function() {



        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario">

    <div id="body_bottom_bgd">
        <div id="">
            <div align="justify" id="right_col" >

                <div id="header">
                </div>

                <div id="">
                    <div id="firefoxbug">

                        <div class="dynamicContent" align="left">


                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventarío | Devolución</strong></h1>
                            <br/>

                            <?php

                            if(isset($_GET['msg'])){
                                $error =  $_GET['error'];

                                $msg = $_GET['msg'];

                                if($error == 'true'){
                                    echo('<div id="error_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');
                                }else if($error == 'false'){
                                    echo('<div id="done_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');

                                }

                            }

                            ?>

                            <br/>

                            <div><?php echo($fecha  . '</br></br>' . $nombre); ?></div>

                            <TABLE BORDER="0" CELLSPACING="10" >
<!---->
<!--                                <tr>-->
<!--                                    <td><label>Nombre Bien</label></td>-->
<!--                                    <td>-->
<!--                                        <input type="text" name="nombre_bien"  disabled>-->
<!--                                        <input type="button" name="buscar_bien" id="buscar_bien" value="Buscar"/>-->
<!--                                        <input type="hidden" name="codigo_bien_hi" id="codigo_bien_hi"/>-->
<!--                                        <input type="hidden" name="codigo_bien_tipo_hi" id="codigo_bien_tipo_hi"/>-->
<!--                                    </td>-->
<!---->
<!--                                </tr>-->

                                <tr>
                                    <td><label>Cantidad en Requisión</label></td>
                                    <td>
                                        <input type="text" name="requisicion"  disabled value="<?php echo($unidades);   ?>" />
                                    </td>

                                </tr>

                                <input type="hidden" name="requisicion_hi" value="<?php echo($unidades);   ?>"/>

                                <input type="hidden" name="valoracion" value="<?php echo($valoracion); ?>"/>
                                <tr>
                                    <td>
                                        <label>Cantidad de Devolución</label>
                                    </td>
                                    <td>
                                        <input name="cantidad_devolucion"  type="text" value="<?php echo($unidades);   ?>" />
                                    </td>
                                </tr>


                                <tr>
                                    <td><label >Tipo de Retiro</label></td>
                                    <td>
                                        <select name="retiro" id="retiro">
                                            <option value="no_uso">No uso</option>
                                            <option value="obsolesencia">Obsolesencia</option>
                                            <option value="deterioro">Deterioro</option>
                                            <option value="dañado">Dañado</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- leonel -->
                                <input type="hidden" name="id" value="<?php echo($_GET['codigo']); ?>"/>

                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td>
                                        <a href="../uso_consumo/uso_consumo_ver.php?paso=0"><input type="button" value="Atras"></a>
                                    </td>
                                </tr>
                            </table>
                            <!-- / END -->
                            <p></p>
                        </div>
                    </div><!--end firefoxbug-->
                </div><!--end left_bgd-->

            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>
                <!--end right_col-->
            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>


</form>

</body>
</html>