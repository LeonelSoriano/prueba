<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="leonelsoriano3@gmail.com" />

    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <!--    <script src="/js/jquery-ui-1.10.4.custom.min.js"></script>-->


    <script src="./../../js/jquery-handsontable/dist/jquery.handsontable.js"></script>
    <link rel="stylesheet" media="screen" href="./../../js/jquery-handsontable/dist/jquery.handsontable.full.css">
    <link rel="stylesheet" media="screen" href="./../../js/jquery-handsontable/demo/css/samples.css">


    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->


    <script type="text/javascript">

        $(function() {

            $('#ordenes').bind('change',function(){

//                var optionSelected = $("option:selected", this);
//                var valueSelected = this.value;
//                var codigo = valueSelected;


                var codigo;
                if(this.selectedIndex - 1 >= 0)
                    codigo = $('#ordenes_hi  option:eq('+(this.selectedIndex - 1)+')').val();
                else
                    codigo = 0;


                $('#codigo_orden_hi').val(codigo);


                var parametros = { codigo : codigo };


                $.ajax({
                    data:  parametros,
                    url:   'ajax_informacion.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#informacion").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {

                        $("#informacion").html(response);

                    }
                });//ajax

            });


            $("body").on('click', "a", function(event) {


                var url = ($(this).attr('href'));


                if(url == '../../prc_menu.html'){


                    return;
                }event.preventDefault();
                var codigo = getURLParameter(url, 'codigo');
                var codigo_departamento = getURLParameter(url, 'codigo_departamento');

                var parametros = { codigo : codigo, codigo_departamento : codigo_departamento };

                $.ajax({
                    data:  parametros,
                    url:   'ajax_informacion.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#informacion").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {

                        $("#informacion").html(response);

                    }
                });//ajax



            });//final body


        })//jquery


        function getURLParameter(url, name) {
            return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
        }




    </script>


</head>


<body class="flickr-com">


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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>


                            <br/>


                            <p style="margin-left: 40px;margin-bottom: 30px">
                                <label style="font-size: 14px; font-weight: bold;">Tipo de Inventario &nbsp;&nbsp;&nbsp;</label>

                                <select id="ordenes" style="font-size: 1.1em">
                                    <option>--------------------</option>

                                    <?php
                                    include_once('../../db.php');

                                    $result=mysql_query("SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND fecha_culminacion='n'");
                                    while($test = mysql_fetch_array($result)){
                                        echo ("<option>".$test['codigo_alias']."</option>");
                                    }

                                    ?>
                                </select>
                            </p>


                            <select id="ordenes_hi" style="display: none">
                                <?php
                                include_once('../../db.php');

                                $result=mysql_query("SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND fecha_culminacion='n'");
                                while($test = mysql_fetch_array($result)){

                                    echo ("<option>".$test['codigo']."</option>");

                                }

                                ?>
                            </select>


                            <div id="informacion">
                            </div>

                            <br/>
                            <br/>

                            <table>
                                <tr>
                                    <td><a href="../../prc_menu.php"><input type="button" value="Atras"></a> </td>

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



</body>
</html>
