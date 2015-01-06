<?php

require_once ('../../db.php');
include_once("../until/SubirFoto.php");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


?>

<?php
if (isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');


    $validation = array(

        array('nombre' => 'nombre',
            'requerida' => true
        ),

        array('nombre' => 'existencia_minima',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'existencia_maxima',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),


        array('nombre' => 'precio_inicial',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),



        array('nombre' => 'cantidad_inicial',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),


    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $subirFoto = new SubirFoto($_FILES['imagen'],'../img_articulos/');
        $subirFoto->cargarFoto();

        $codigoalias =  $_POST['codigoalias'];
        $nombre = $_POST['nombre'];
        $tipo_inventario = $_POST['inventario'];
        $unidad_medida = explode("(",$_POST['unidad_medida'])[0];

        $existencia_minima = 0;
        if($_POST['existencia_minima'] != ''){
            $existencia_minima = str_replace(',','.',$_POST['existencia_minima']);
        }

        $existencia_maxima = 0;
        if($_POST['existencia_maxima'] != ''){
            $existencia_maxima = str_replace(',','.',$_POST['existencia_maxima']);
        }

        $precio_inicial = 0;
        if($_POST['precio_inicial'] != ''){
            $precio_inicial = str_replace(',','.',$_POST['precio_inicial']);
        }

        $cantidad_inicial = 0;
        if($_POST['cantidad_inicial'] != ''){
            $cantidad_inicial = str_replace(',','.',$_POST['cantidad_inicial']);
        }

        $fecha_vencimiento = $_POST['fecha_venciminto'];
        $fecha_adquisicion = $_POST['fecha_adquisicion'];
        $imagen = $subirFoto->getNombreSubir();
        $ubicacion = $_POST['ubicacion'];
        $observacion = $_POST['observacion'];


        $sql ="SELECT codigo FROM mco_unidad where descripcion='" . $unidad_medida . "'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unudades");
        }

        $unidad_medida_tmp = $test['codigo'];


        $sql ="SELECT codigo FROM min_tipo_inventario where tipo='" . $tipo_inventario . "'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de tipo inventario");
        }
        $tipo_inventario_tmp = $test['codigo'];



        $sql = "INSERT INTO min_productos_servicios(codigo_alias,nombre,existencia_minima,existencia_maxima,fecha_vencimiento,fecha_adquisicion,ubicacion,observacion,mco_unidad,inventario,foto_articulo) VALUES
        ('$codigoalias','$nombre','$existencia_minima','$existencia_maxima',
        '$fecha_vencimiento','$fecha_adquisicion','$ubicacion','$observacion','$unidad_medida_tmp','$tipo_inventario_tmp',
        '$imagen');";


        mysql_query($sql) or die('No se pudo guardar la información. min_productos_servicios'.mysql_error());


        /* coloco datos en la tabla valoracion */

        $ultimo_ID = mysql_insert_id();


        if($tipo_inventario_tmp == '12'){
            $cantidad_inicial = 0;
        }

        $promedio_actual = 0;

        if($cantidad_inicial != 0){
            $promedio_actual = $precio_inicial/$cantidad_inicial;
        }

        $sql = "INSERT INTO min_valoracion(codigo_producto,unidades,costo_total,promedio_actual) VALUES ('$ultimo_ID','$cantidad_inicial','".$precio_inicial."','$promedio_actual')";


        $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones '.mysql_error());



        require_once('../../clases/funciones.php');
        $fecha = fecha_sicap();
        $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha )
VALUES('$ultimo_ID','$cantidad_inicial','".$precio_inicial."','$promedio_actual', '$fecha');
";

        $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());


        /*--.--.-.--.-.-.-.-..--..-*/
        /*guardar a la table de fotos*/
        $sql = "SELECT codigo FROM min_productos_servicios where foto_articulo='".$imagen."'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found..");
        }

        $codigo_articulo = $test['codigo'];
        $imagen_nombre = $subirFoto->getName();
        $imagen_tipo = $subirFoto->getType();
        $imagen_tamano = $subirFoto->getSize();


        $sql = "insert into min_imagen(nombre_subir,codigo_min_articulos,name,type,size) values ('$imagen','$codigo_articulo',
        '$imagen_nombre','$imagen_tipo','$imagen_tamano')";

        $result = mysql_query($sql) or die('No se pudo guardar la información. min_imagen'.mysql_error());


        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true, "Problemas al cargar Información");
        die;
    }



    //echo('<div id="done_app"><marquee scrolldelay="100">Datos Guardados Correctamente</marquee></div>');

}

?>



<!DOCTYPE html>
<html>
<head lang="es">
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
            $( "#datepicker1" ).datepicker({ dateFormat: "yy-mm-dd" });
            $( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd" });
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth()<9){
                mes = myDate.getMonth() +1;
                mes = "0" + mes;
            }else{
                mes = myDate.getMonth() + 1;
            }
            var prettyDate =(myDate.getFullYear()  + "-" +mes) + "-" + myDate.getDate() ;
            $("#datepicker1").val(prettyDate);
            $("#datepicker2").val(prettyDate);


            $( "#buscar_empresa" ).click(function() {
                var win = window.open("inventario_buscar_empresa.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });
    </script>
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->
</head>
<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->
<form method="post" name="inventario" enctype="multipart/form-data">
<div id="body_bottom_bgd">
<div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
    <!--</div>--> <!-- Menu -->
    <!-- ?php include 'include/nav.php'; ?>-->
    <div align="justify" id="right_col" >

        <div id="header">
        </div>
        <div id="">
            <div id="firefoxbug"><!-- firefoxbug -->
                <!-- <div id="blue_line"></div>-->
                <div class="dynamicContent" align="left">
                    <!-- <h1>Inicio</h1>-->
                    <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                    <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong> Módulo de Inventario | Productos y Servicios</strong></h1>

                    <!-- Beginning of compulsory code below -->
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
                    <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

                        <TR>
                            <TD><label>Código</label></TD>
                            <TD><p><input type="text" name="codigoalias" size="20"></p></TD>
                        </TR>

                        <TR>
                            <TD><label>Nombre de Artículo(*)</label></TD>
                            <TD><p><input type="text" name="nombre" size="20"></p></TD>
                        </TR>


                        <TR>
                            <TD><label>Tipo de Inventario</label></TD>
                            <TD><p>
                                    <select name="inventario">

                                        <?php
                                        $result=mysql_query("SELECT tipo FROM min_tipo_inventario");
                                        while($test = mysql_fetch_array($result)){

                                            echo"<option>". $test['tipo']."</option>";
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


                                        $result=mysql_query("SELECT descripcion,sigla FROM mco_unidad");
                                        while($test = mysql_fetch_array($result)){

                                            echo"<option>".$test['descripcion']." (". $test['sigla'].")". "</option>";

                                        }

                                        ?>
                                    </select>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="">Existencia Mínima</label>
                            <td>
                                <p><input type="text" name="existencia_minima"/></p>
                            </td>
                            </td>
                        </tr>


                        <tr>
                            <td><label for="">Existencia Maxima</label>
                            <td>
                                <p><input type="text" name="existencia_maxima"/></p>
                            </td>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label >Fecha de Vencimiento</label>
                            </td>
                            <td>
                                <p>
                                    <input type="text" id="datepicker1" name="fecha_venciminto">
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label >Fecha de Adquisición</label>
                            </td>
                            <td>
                                <p>
                                    <input type="text" id="datepicker2" name="fecha_adquisicion">
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Foto del Artículo</label>
                            </td>

                            <td>
                                <p>
                                    <input type="file" name="imagen" >
                                </p>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label >Ubicación</label>
                            </td>
                            <td>
                                <p><input type="text" name="ubicacion"/></p>
                            </td>
                        </tr>


                        <tr>
                            <td><label >Costo</label></td>
                            <td><input type="text" name="precio_inicial" value="1"/></td>
                        </tr>

                        <tr>
                            <td><label >Cantidad Inicial</label></td>
                            <td><input type="text" name="cantidad_inicial" value="0"/></td>
                        </tr>

                        <tr>
                            <td>
                                <label >Observación</label>
                            </td>
                            <td>
                                <textarea rows="4" cols="18" name="observacion">

                                </textarea>
                            </td>
                        </tr>



                    </TABLE>
                    <input type="hidden" name="codigo_empresa" id="codigo_empresa" value=""/>
                    <br/>

                    <table>
                        <tr>
                            <td>
                                <input type="submit" value="Guardar datos" name="submit">
                            </td>
                            <td>
                                <a href="articulo_ver.php?paso=0"><input type="button" value="Ver datos"></a>
                            </td>
                            <td>
                                <a href="../../min_menu.php"><input type="button" value="Atras"></a>
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