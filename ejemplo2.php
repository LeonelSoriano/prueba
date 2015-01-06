<?php
    include_once('db.php');


    $cedulaempleado = $_GET['cedulaempleado'];
    $mes = $_GET['mes'];


    $semanas_mes = calcular_lunes($mes);

    $salario_integral = 0;
    $salario_normal = 0;


function calcular_lunes($mes){

    $sql = "select count(codigomes) as nro_lunes from mrh_semana where codigomes='$mes'";
    $resultin = mysql_query($sql);
    $field = mysql_fetch_array($resultin);
    if (!$resultin){die("Error: Data not foudnd..");}
    $nro_lunes= $field['nro_lunes'];

    return $nro_lunes;
}



$result=mysql_query("SELECT * FROM mrh_empleado WHERE cedula ='$cedulaempleado'");

$test = mysql_fetch_array($result);


$codigo_empleado = $test['codigo'];

$primer_nombre = $test['primernombre'];
$primer_apellido = $test['primerapellido'];


$nombre_completo = $primer_apellido . '  ' . $primer_nombre;


//cargo
$result_=mysql_query("SELECT * FROM mno_proceso_empleados WHERE codigoempleado='$codigo_empleado'");

$test_ = mysql_fetch_array($result_);


$codigomes = $test_['codigomes'];


$sql = "select distinct
  mno_departamento.descripcion
from
  mno_departamento
  join
  mno_proceso_empleados
    ON
      mno_departamento.codigogerencia = mno_proceso_empleados.codigogerencia and
      mno_departamento.codigo = mno_proceso_empleados.codigodepartamento
WHERE
  mno_proceso_empleados.codigoempleado = '$codigo_empleado' AND
  mno_proceso_empleados.codigomes = '$codigomes'";


$result=mysql_query($sql);
$test = mysql_fetch_array($result);

$nombre_cargo = $test['descripcion'];


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>


    <script src="./js/jquery-handsontable/dist/jquery.handsontable.js"></script>
    <link rel="stylesheet" media="screen" href="./js/jquery-handsontable/dist/jquery.handsontable.full.css">
    <link rel="stylesheet" media="screen" href="./js/jquery-handsontable/demo/css/samples.css">

    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->

    <style media="screen" type="text/css">


    </style>


    <script type="text/javascript">
        $(function() {
        <?php
        include_once('Claseejemplo.php');


        $a = new Claseejemplo($semanas_mes);



$_array_information = [];



$sql = "SELECT * FROM mno_view_concepto_empleados WHERE  codigomes = '$codigomes' AND codigoempleado = '$codigo_empleado'";

$result=mysql_query($sql);

while($test = mysql_fetch_array($result))
{
    $descripcion = $test['descripcion'];
    $resultado = $test['resultado'];
    $codigo_tipo = $test['codigotipo'];

    $sql2 = "select descripcion from mno_tipo_concepto where codigo_concepto = '$codigo_tipo'";

    $result2=mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);

    $nombre_divicion = $test2['descripcion'];


    if($descripcion == 'Salario Integral'){
        $salario_integral += $resultado;
    }else if($descripcion == 'Salario Normal'){
        $salario_normal += $resultado;
    }


    if(!isset($_array_information[$nombre_divicion][$descripcion]) && $nombre_divicion != ''){
        $_array_information[$nombre_divicion][$descripcion] = [];
    }
    if($nombre_divicion != ''){
        array_push($_array_information[ $nombre_divicion][$descripcion],$resultado);
    }

}

        $a->add_info($_array_information);

    //array_push($_array_information[$nombre_divicion][$descripcion],$resultado);

//                $a->add_info("salario","base",array(1,2,3,4));
//                        $a->add_info("dos","este es ",array(1,2,3,4));
//                        $a->add_info("dos","segundo",array(1,2,3,4));
        $a->procesar();
        $a->print_colores();

        ?>
        });

    </script>

</head>
<body class="flickr-com">



<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post" name="uso_consumo" id="form">
<div id="body_bottom_bgd">
<div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
<!--</div>-->                <!-- Menu -->
<!--  ?php include 'include/nav.php'; ?>-->
<div align="justify" id="right_col" >





<div id="header">
</div>
<div id="">
    <div id="firefoxbug"><!-- firefoxbug -->
        <!-- <div id="blue_line"></div>-->
        <div class="dynamicContent" align="left">
            <!--  <h1>Inicio</h1>-->
            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Almacén | Uso-Consumo</strong></h1>
            <br/>
            <div>Nombre: <?php echo($nombre_completo); ?> </div>
            <br/>
            <div>Cedula: <?php echo($cedulaempleado); ?> </div>
            <br/>
            <div> <?php echo($nombre_cargo); ?> </div><!--  TODO agregar cargo -->
            <br/>
            <div>Salario Integral: <?php echo(formatear_ve($salario_integral)); ?></div>
            <br/>
            <div>Salario Normal: <?php echo(formatear_ve($salario_normal)); ?></div>


            <!-- Beginning of compulsory code below -->
            <br/><br/>
            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">




                <div class="handsontable" id="handsontable"></div>

                <?php
                //echo(date("Y-n-j")  );

                //    $var = [];
                //
                //    $var['sueldo']['dis'] = array(3,3,3);
                //
                //    $var['sueldo']['tres'] = array(2,2,2);
                //
                //
                //    $var['presta']['tres'] = array(2,5,2);
                //
                //    foreach($var as $key => $value){
                //
                //        foreach($value as $key2 => $value2){
                //            echo( $key.'->'.$key2  . '</br>');
                //            print_r($value2);
                //        }
                //    }



              //  $a->hola();

                ?>

            </TABLE>

            <table>
                <tr>
                    <td>
                        <input id="enviar" type="submit" value="Guardar datos" name="submit">
                    </td>
                    <td>
                        <a href="uso_consumo_ver.php"><input type="button" value="Ver datos"></a>
                    </td>
                    <td>
                        <a href="../../min_menu.html"><input type="button" value="Atras"></a>
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



