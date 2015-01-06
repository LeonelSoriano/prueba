<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
if (isset($_POST['submit']))
{
    include 'db.php';
    require_once('./clases/Validate.php');
    require_once('./clases/funciones.php');



    $validation = array(

        array('nombre' => 'codigoalias',
            'requerida' => true,
        ),

        array('nombre' => 'descripcion',
            'requerida' => true,
        )
    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){

        $codigoalias=$_POST['codigoalias'];

        $descripcion= cadena_estetica($_POST['descripcion']);
        $tipo_cargo = $_POST['tipo_cargo'];
        $tipo_cargo_opcion = $_POST['tipo_cargo_opcion'];


        $sql = "SELECT count(*) as total FROM mrh_cargo WHERE codigoalias='$codigoalias' OR descripcion ='$descripcion'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        $total = $test['total'];


        if($total != '0'){
            send_error_redirect(true,'Cargo ya Existe');
            die;
        }



        $sql = "insert into mrh_cargo(codigoalias,descripcion,tipo_cargo,tipo_cargo_opcion)
                                                      values('$codigoalias','$descripcion','$tipo_cargo',$tipo_cargo_opcion)";
        //echo $sql;
        //exit;
        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){
        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }


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
    <link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="css/htmlDatePicker.css" rel="stylesheet">
    <!-- Beginning of compulsory code below -->
    <link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="./js/jquery-1.10.2.js"></script>
    <!-- / END -->

    <script type="text/javascript">

        $(function() {

            $('#tipo_cargo').bind('change',function() {

                var tipo_cargo = $('#tipo_cargo').val();

                if (tipo_cargo == "produccion") {

                    $("#tipo_cargo_opcion").html(" <option value='directa'>Directa</option> <option >Indirecta</option>");
                } else if(tipo_cargo == "operativo"){
                    $("#tipo_cargo_opcion").html(" <option value='administracion'>Administración</option> <option >Venta</option>");

                }




            });

        });

        
    </script>




</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->


<form method="post">
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
                            <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Cargo</strong></h1>
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
                                    <TD><p><input type="text" name="codigoalias" id="codigoalias" size="20"></p></TD>
                                </TR>
                                <TR>
                                    <TD><label>Descripción</label></TD>
                                    <TD><p><input type="text" name="descripcion" id="descripcion" size="20"></p></TD>
                                </TR>
                                <TR>
                                    <TD><label >Tipo Cargo</label></TD>
                                    <td>
                                        <select id="tipo_cargo" style="height: 21px" name="tipo_cargo" id="">
                                            <option value="produccion">Producción</option>
                                            <option value="operativo">Operativo</option>
                                        </select>
                                    </td>


                                </TR>
                                <tr>
                                    <td></td>
                                    <td>
                                        <select style="height: 21px" name="tipo_cargo_opcion" id="tipo_cargo_opcion">
                                            <option value="directo">Directo</option>
                                            <option value="indirecto">Indirecto</option>
                                        </select>
                                    </td>

                                </tr>



                            </TABLE>

                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="cargo_ver.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="mrh_menu.php"><input type="button" value="Atras"></a> </td>
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
