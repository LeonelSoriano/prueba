

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

    <!-- / END -->

    <script type="application/javascript" >



        $(function() {



            $( "#buscar" ).click(function() {
                var ventana_nueva = window.open("buscar_etapa.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=700, height=600 ,left=600,top=90");
                ventana_nueva.focus();
                ventana_nueva.onbeforeunload = function(){
                    //ajax



                    var codigo = $('#codigo_hi').val();

                    var parametros = { codigo : codigo };

                    $.ajax({
                        data:  parametros,
                        url:   'get_etapas.php',
                        type:  'post',
                        beforeSend: function () {
                            $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                        },
                        success:  function (response) {
                            $("#resultado").html(response);
                        }
                    });



                }
            });


            $( "a.hola" ).click(function( event ) {
                event.preventDefault();

            });



        });



    </script>

</head>
<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->

<!--<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Listado de Turnos</h1>-->

<!-- Beginning of compulsory code below -->

<form action="/" id="searchForm">

</form>

<form  method="post" name="detalles_etapa" accept-charset="UTF-8">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" style="width: 80%">
                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>

                                    Módulo de Inventario | Productos y servicios</strong></h1>
                            <br/><br/>
                            <table>
                                <tr>

                                    <td style="width: 155px"><input type="text" name="articulo_nombre" placeholder="articulo" id="articulo_nombre"></td>
                                    <td><input type="button" value="Buscar" id="buscar"></td>
                                    <input type="hidden" id="codigo_hi"/>

                                </tr>
                            </table>


                          <!-- SERV_TABLE -->
                            <span id="resultado"></span>



                            <br/><br/><br/>
                            <a href="../../prc_menu.php"><input type="button" value="Atras"></a>
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