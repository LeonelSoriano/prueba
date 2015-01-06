<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 12/12/14
 * Time: 10:42 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


require_once('../../db.php');


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



</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario" action="reporte_relacion_costo_gasto.php">

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


<h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Reporte Costo Empleado</strong></h1>
<br/>


<br/>
<TABLE BORDER="0" CELLSPACING="10" >
    <TR class="fecha">
        <TD><label>Fecha</label></TD>
        <TD>
            <select name='anhio' id='anhio' >

                <?php $anhio = date('Y');
                $anhio_presente = $anhio;
                $anhio = $anhio - 10;

                for($i = $anhio ; $i < $anhio+12 ;$i++){

                    if($i == $anhio_presente){
                        echo('<option value="'.($i).'"selected>'.($i).'</option>');

                    }else{
                        echo('<option value="'.($i).'">'.($i).'</option>');
                    }
                }

                ?>
            </select>


            <select name='mes' id='mes' >

                <?php

                $mes = date('n');


                if($mes == 1){
                    echo(" <option value='1' selected>Enero</option>");
                }else{
                    echo(" <option value='1' >Enero</option>");
                }
                if($mes == 2){
                    echo(" <option value='2' selected>Febrero</option>");
                }else{
                    echo(" <option value='2' >Febrero</option>");
                }
                if($mes == 3){
                    echo(" <option value='3' selected>Marzo</option>");
                }else{
                    echo(" <option value='3' >Marzo</option>");
                }
                if($mes == 4){
                    echo(" <option value='4' selected>Abril</option>");
                }else{
                    echo(" <option value='4' >Abril</option>");
                }
                if($mes == 5){
                    echo(" <option value='5' selected>Mayo</option>");
                }else{
                    echo(" <option value='5' >Mayo</option>");
                }
                if($mes == 6){
                    echo(" <option value='6' selected>Junio</option>");
                }else{
                    echo(" <option value='6' >Junio</option>");
                }
                if($mes == 7){
                    echo(" <option value='7' selected>Julio</option>");
                }else{
                    echo(" <option value='7' >Julio</option>");
                }
                if($mes == 8){
                    echo(" <option value='8' selected>Agosto</option>");
                }else{
                    echo(" <option value='8' >Agosto</option>");
                }
                if($mes == 9){
                    echo(" <option value='9' selected>Septiembre</option>");
                }else{
                    echo(" <option value='9' >Septiembre</option>");
                }
                if($mes == 10){
                    echo(" <option value='10' selected>Octubre</option>");
                }else{
                    echo(" <option value='10' >Octubre</option>");
                }
                if($mes == 11){
                    echo(" <option value='11' selected>Noviembre</option>");
                }else{
                    echo(" <option value='11' >Noviembre</option>");
                }
                if($mes == 12){
                    echo(" <option value='12' selected>Diciembre</option>");
                }else{
                    echo(" <option value='12' >Diciembre</option>");
                }

                ?>

            </select>
        </TD>
    <TR>
</TABLE>

<table>

    <tr>
        <td><input type="submit" value="Generar Reporte" name="submit" ></td>
        <td><a href="../../cos_menu.php"><input type="button" value="Atras"></a> </td>

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



