<?php

require_once("../../db.php");
header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);




    if(isset($_POST['submit'])){


        include('./../../clases/funciones.php');
        include('./../../clases/Validate.php');




        $validation = array(

            array('nombre' => 'id_articulo',
                'requerida' => true,
                'regla' => 'number'),



            array('nombre' => 'codigo_departamento_hi',
                'requerida' => true,
                'regla' => 'number'),


            array('nombre' => 'horas_estandar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),


        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();



        if(!$validated->getIsError()){

            $id_producto = $_POST['id_articulo'];
            $nombre_etapa = $_POST['codigo_departamento_hi'];
            $horas_estandar = str_replace(',','.',$_POST['horas_estandar']);


            $sql = "SELECT COUNT(*) AS cuantos FROM  prc_etapas WHERE codigo_producto='$id_producto' AND codigo_departamento='$nombre_etapa'";
            $resultado =  mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
            $data=mysql_fetch_assoc($resultado);
            $cantidad_etapas = $data['cuantos'];




            if($nombre_etapa == '' || $cantidad_etapas != 0){
                $current_url = explode("?", $_SERVER['REQUEST_URI']);

                $primer_parametro = 'id_articulo=' . $_GET['id_articulo'];

                header('Location: '.$current_url[0].'?'.$primer_parametro.'&error=true&msg=Ya has Ingresado esta Etapa');
                die;

            }else{


                $hora_convertida = $horas_estandar/60;
                $sql = "INSERT INTO prc_etapas(codigo_producto,codigo_departamento,horas_estandar)  VALUES ('$id_producto','$nombre_etapa','$hora_convertida')";
                mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());




                $primer_parametro = 'id_articulo=' . $_GET['id_articulo'];

                header('Location: '.$current_url[0].'?'.$primer_parametro.'&error=false&msg=Datos Guardados Exitosamente');
                die;

            }


        }else if($validated->getIsError()){

            $current_url = explode("?", $_SERVER['REQUEST_URI']);

            $primer_parametro = 'id_articulo=' . $_GET['id_articulo'];

            header('Location: '.$current_url[0].'?'.$primer_parametro.'&error=true&msg=Hay Errores en la Información del formulario');
            die;
        }








    }




if($_GET['id_articulo']){


    $id_producto = $_GET['id_articulo'];

    $sql = "SELECT nombre FROM min_productos_servicios WHERE codigo = '$id_producto'";

    $resultado =  mysql_query($sql) or die('probemas en lectura de articulo '.mysql_error());
    $test=mysql_fetch_assoc($resultado);
    $nombre = $test['nombre'];



}






?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAPC | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

    <script src="./../../js/jquery-1.10.2.js"></script>
    <script src="./../../js/jquery-ui-1.10.4.custom.js"></script>


    <script>

        $(function(){


            $('#buscar_etapa').click(function(){
                var win = window.open("buscar_departamento.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

    <!-- / END -->

</head>
<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->

<!--<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Listado de Turnos</h1>-->

<!-- Beginning of compulsory code below -->

<form  method="POST" accept-charset="UTF-8" name="registrar" id="registrar">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <?php

//                if($is_void_etapa)
//                    echo('<br/><div id="error_app"><marquee scrolldelay="120">Asocia una Etapa al Producto o no lo Selecciones Más de una Vez</marquee></div>');

            ?>
            <div align="justify" id="right_col" >
                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>    Módulo de  Producción | Registrar Etapas</strong></h1>
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


                                <table>
                                    <tr>
                                        <td style="width: 130px"><label> Nombre de Etapa(*)  </label></td>
                                        <td style="width: 170px"><input type="text" name="nombre_etapa" id="nombre_etapa" size="20"  value="<?php echo($nombre) ?>" disabled></td>
                                        <td><input id="buscar_etapa" type="button" value="Buscar"></td>
                                        <input type="hidden" name="id_articulo" value="<?php echo($id_producto) ?>"/>
                                        <input type="hidden" name="codigo_departamento_hi" />
                                    </tr>

                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr><tr><tr></tr></tr>

                                    <tr >
                                        <td style="width: 130px"> Tiempo Estandar de Producción(Minutos)(*) </td>
                                        <td><input type="text" id="horas_estandar" name="horas_estandar" value="0"/></td>
                                        <td><input id="guardar_nombre" type="submit" name="submit" value="Agregar"></td>
                                    </tr>

                                    <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                                    <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>

                                </table>

                            <table border=none class="tablas-nuevas" >

                                <tr >
                                    <th style="text-align: center">  Nombre de la Etapa</th>
                                    <th style="text-align: center">  Horas</th>
                                    <th style="text-align: center"> Modificar</th>
                                    <th style="text-align: center"> Eliminar</th>


                                </tr>
                                <?php

                                $result=mysql_query("SELECT * FROM prc_etapas WHERE desactivo='n' AND codigo_producto='$id_producto' ");

                                while($test = mysql_fetch_array($result))
                                {

                                    $cod = $test['codigo'];
                                    $horas = $test['horas_estandar'];

                                    $codigo_departamento = $id = $test['codigo_departamento'];

                                    $result2=mysql_query("SELECT * FROM mno_gerencia WHERE codigo='$codigo_departamento'");
                                    $test2 = mysql_fetch_array($result2);
                                    $nombre = $test2['descripcion'];


                                    echo "<tr align='center'>";
                                    echo"<td><font color='black'>". $nombre . "</font></td>";
                                    echo"<td style='text-align: right'><font color='black'>". $horas . "</font></td>";
                                    echo"<td style='text-align: center'><font color='black'><a href='registrar_etapas_mod.php?codigo=".$cod."'>Modificar</a></font></td>";
                                    echo"<td style='text-align: center'><font color='black'><a href='registrar_etapas_del.php?codigo=".$cod."'>Eliminar</a></font></td>";

                                    echo "</tr>";
                                }
                                mysql_close($conn);
                                ?>
                            </table>
                            <br/><br/>
                            <a href="producto_etapa.php"><input type="button" value="Atras"></a>
                            <p></p>
                        </div>
                    </div><!--end firefoxbug-->
                </div><!--end left_bgd-->

            </div>
            <p>
                <!--end right_col-->
            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>

    <!-- / END -->

</form>

</body>
</html>

<?php

//mysql_close($conn);

?>