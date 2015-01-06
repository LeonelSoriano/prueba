<?php



    require_once ('../../db.php');



    $id =$_REQUEST['codigo'];

    $sql = "SELECT * FROM min_productos_servicios WHERE codigo ='$id'";

    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);

    if (!$result)
    {
        die("Error: Data not found..");
    }

    $codigo = $test['codigo'];
    $codigo_alias = $test['codigo_alias'];
    $nombre = $test['nombre'];
    $existencia_minima = $test['existencia_minima'];
    $existencia_maxima = $test['existencia_maxima'];
    $fecha_vencimiento = $test['fecha_vencimiento'];
    $fecha_adquisicion = $test['fecha_adquisicion'];
    $foto_articulo = $test['foto_articulo'];
    $ubicacion = $test['ubicacion'];
    $observacion = $test['observacion'];
    $inventario = $test['inventario'];

    $mco_unidad = $test['mco_unidad'];


    $sql = "SELECT tipo FROM min_tipo_inventario WHERE codigo ='$inventario'";

    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);

    if (!$result)
    {
        die("Error: Data not found.. inventarios");
    }

    $inventario = $test['tipo'];


    $sql = "SELECT * FROM mco_unidad WHERE codigo ='$mco_unidad'";


    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);

    if (!$result)
    {
        die("Error: Data not found.. unidades");
    }

    $mco_unidad = $test['descripcion'] ." (" . $test['sigla'] . ")";

?>

<?php
/*este para manejar los post*/

    if (isset($_POST['submit'])){

           // print_r($_FILES['imagen']);

        $codigoalias = $_POST['codigoalias'];
        $nombre = $_POST['nombre'];
        $tipo_inventario = $_POST['inventario'];
        $unidad_medida = explode("(",$_POST['unidad_medida'])[0];
        $existencia_minima = $_POST['existencia_minima'];
        $existencia_maxima = $_POST['existencia_maxima'];
        $fecha_vencimiento = $_POST['fecha_venciminto'];
        $fecha_adquisicion = $_POST['fecha_adquisicion'];

        $ubicacion = $_POST['ubicacion'];
        $observacion = $_POST['observacion'];


$inventario = $_POST['inventario'];
        $sql ="SELECT codigo FROM min_tipo_inventario where tipo='" . $_POST['inventario'] . "'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unidades");
        }

        $inventario_post = $test['codigo'];



/*busco el codigo de unidad de medida*/

        $tmp_unidad = explode("(",$_POST['unidad_medida'])[0];

        $tmp_unidad = substr($tmp_unidad,0,-1);

        $sql = "SELECT * FROM mco_unidad WHERE  descripcion='$tmp_unidad'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unudades");
        }

        $tmp_unidad = $test['codigo'];



        /* -.-.-.*/
       // echo( $unidad_medida_tmp  . "*************");

       $sql = "UPDATE min_productos_servicios SET nombre='$nombre',existencia_maxima='$existencia_maxima',
            existencia_minima='$existencia_minima',fecha_vencimiento='$fecha_vencimiento',
            fecha_vencimiento='$fecha_vencimiento', ubicacion='$ubicacion',observacion='$observacion',inventario='$inventario_post',mco_unidad='$tmp_unidad' WHERE codigo ='$id'";



        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


        $mco_unidad = $_POST['unidad_medida'];




    }



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
    <script>
        $(function() {
            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            var mes = 0
            if(myDate.getMonth()<10){
                mes = '0' + myDate.getMonth();
            }else{
                mes = myDate.getMonth()
            }
            var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + myDate.getDate() ;
            $("#datepicker1").val(prettyDate);
            $("#datepicker2").val(prettyDate);
        });
    </script>
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->

    <style type="text/css">
        #imagen_producto {
            /*height="140px" width="140px"*/
       /*  background-color: red;
            height: 140px;
            width: 140px;
            float: right;
            margin-top: 400px;
*/
            position: absolute;
            margin-top: 340px;
            margin-left: 390px;

        }
    </style>


</head>
<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->
<form method="post" enctype="multipart/form-data">
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Apartado</strong></h1>

                            <!-- Beginning of compulsory code below -->

                            <br/><br/>



                            <div id="imagen_producto">
                                <img src="<?php echo('../img_articulos/'.$foto_articulo) ?>" alt="foto articulo" height="140px" width="140px"/>
                            </div>
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

                                <TR>
                                    <TD><label>Código</label></TD>
                                    <TD><p><input type="text" name="codigoalias" size="20" value="<?php echo($codigo_alias); ?>"></p></TD>
                                </TR>

                                <TR>
                                    <TD><label>Nombre de Artículo</label></TD>
                                    <TD><p><input type="text" name="nombre" size="20" value="<?php echo($nombre); ?>"></p></TD>
                                </TR>


                                <TR>
                                    <TD><label>Tipo de Inventario</label></TD>
                                    <TD><p>
                                            <select name="inventario" >
                                                <?php
                                                    echo"<option>".$inventario. "</option>";

                                                $result=mysql_query("SELECT tipo FROM min_tipo_inventario");
                                                while($test = mysql_fetch_array($result)){

                                                    echo"<option>". utf8_encode($test['tipo'])."". "</option>";
                                                }

                                                ?>
                                            </select>
                                        </p></TD>
                                </TR>


                                <tr>
                                    <td>
                                        <label >Unidad de Medida</label>
                                    </td>
                                    <td>
                                        <p>
                                            <select name="unidad_medida" >
                                                <?php

                                                echo"<option>".$mco_unidad. "</option>";

                                                $result=mysql_query("SELECT descripcion,sigla FROM mco_unidad");
                                                while($test = mysql_fetch_array($result)){
                                                    $id = $test['codigo'];
                                                    echo"<option>".$test['descripcion']."  (". $test['sigla'].")". "</option>";

                                                }

                                                ?>
                                            </select>
                                        </p>
                                    </td>
                                </tr>



                                <tr>
                                    <td><label for="">Existencia Mínima</label>
                                    <td>
                                        <p><input type="text" name="existencia_minima" value="<?php echo($existencia_minima) ?>"/></p>
                                    </td>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="">Existencia Maxima</label>
                                    <td>
                                        <p><input type="text" name="existencia_maxima" value="<?php echo($existencia_maxima) ?>"/></p>
                                    </td>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label >Fecha de Vencimiento</label>
                                    </td>
                                    <td>
                                        <p>
                                            <input type="text" id="datepicker1" name="fecha_venciminto"  value="<?php echo($fecha_vencimiento) ?>" ">
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label >Fecha de Adquisición</label>
                                    </td>
                                    <td>
                                        <p>
                                            <input type="text" id="datepicker2" name="fecha_adquisicion" value="<?php echo($fecha_adquisicion) ?>" />
                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Foto del Artículo</label>
                                    </td>

                                    <td>
                                        <p>
                                            <input type="file" name="imagen"/>
                                        </p>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <label >Ubicación</label>
                                    </td>
                                    <td>
                                        <p><input type="text" name="ubicacion" value="<?php echo($ubicacion) ?>"/></p>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <label >Observación</label>
                                    </td>
                                    <td>
                                        <textarea rows="4" cols="18" name="observacion"  ><?php echo($observacion) ?></textarea>

                                    </td>
                                </tr>

                            </table>
                            <!-- / END -->



                            </TABLE>


                            <br/><br/><br/>

                            <table>
                                <tr>
                                    <td>
                                        <input type="submit" value="Guardar datos" name="submit">&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td>
                                        <a href="inventario_ver.php"><input type="button" value="Ver datos"></a>&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td>
                                        <a href="inventario_ver.php"><input type="button" value="Atras"></a>&nbsp;&nbsp;&nbsp;
                                    </td>
                                </tr>
                            </table>


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
