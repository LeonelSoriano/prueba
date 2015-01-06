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

    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA7j_Q-rshuWkc8HyFI4V2HxQYPm-xtd00hTQOC0OXpAMO40FHAxT29dNBGfxqMPq5zwdeiDSHEPL89A" type="text/javascript"></script>

    <script>



        $(function() {

            var geocoder;

            geocoder = new GClientGeocoder();



            $("#comprobar").click(function() {

                var zona = '';

                if($("#origen_zona").val() != ''){
                   zona = $("#origen_zona").val() + ', ';
                }

                var origen = zona + $("#origen_ciudad").val() + ', ' + $("#origen_estado").val() + ', Venezuela';

                zona = '';

                if($("#llegada_zona").val() != ''){
                    zona = $("#llegada_zona").val() + ', ';
                }

                var llegada = zona + $("#llegada_ciudad").val() + ', ' + $("#llegada_estado").val() + ', Venezuela';

                geocoder.getLocations(origen,function (response) {

                    if (!response || response.Status.code != 200){

                       $("#origen_salida").text("Origen: Discupa Pero accesa una direccion valida en el origen");

                    }else{

                        var location1 = {lat: response.Placemark[0].Point.coordinates[1],
                            lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                        $("#origen_salida").text('Origen: '+location1.address);

                    }

                });


                geocoder.getLocations(llegada,function (response) {



                    if (!response || response.Status.code != 200){

                        $("#llegada_salida").text("Llegada: Discupa Pero accesa una direccion valida en el origen");

                    }else{

                        var location1 = {lat: response.Placemark[0].Point.coordinates[1],
                            lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                        $("#llegada_salida").text('Llegada: '+location1.address);

                    }

                });

                $( "#resultado" ).delay(500).slideDown( "slow");
            });



            $("#submit").click(function(){

                var origen_codigo_google,origen_estado,origen_ciudad,origen_zona,origen_latitud,
                    origen_longitud;
                var llegada_codigo_google,llegada_estado,llegada_ciudad,llegada_zona,
                    llegada_latitud,llegada_longitud;

                var   glatlng1 = null;
                    var glatlng2 = null;


                var error_orrigen = 'false';
                var error_llegada = 'false'

                var geocoder;


                geocoder = new GClientGeocoder();

                    var zona = '';

                    if($("#origen_zona").val() != ''){
                        zona = $("#origen_zona").val() + ', ';
                    }

                    var origen = zona + $("#origen_ciudad").val() + ', ' + $("#origen_estado").val() + ', Venezuela';

                    zona = '';

                    if($("#llegada_zona").val() != ''){
                        zona = $("#llegada_zona").val() + ', ';
                    }

                    var llegada = zona + $("#llegada_ciudad").val() + ', ' + $("#llegada_estado").val() + ', Venezuela';

                    geocoder.getLocations(origen,function (response) {

                        if (!response || response.Status.code != 200){

                            window.location = "./crear_ruta.php?error=true";
                        }else{

                            var location1 = {lat: response.Placemark[0].Point.coordinates[1],
                                lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                            origen_codigo_google = location1.address;
                            origen_latitud = location1.lat;
                            origen_longitud = location1.lon;

                            glatlng1 = new GLatLng(location1.lat, location1.lon);


                            //empieza segunda direccion
                            geocoder.getLocations(llegada,function (response) {

                                if (!response || response.Status.code != 200 && error != 'true'){

                                    window.location = "./crear_ruta.php?error=true";

                                }else{

                                    var location1 = {lat: response.Placemark[0].Point.coordinates[1],
                                        lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};
                                    llegada_codigo_google = location1.address;
                                    llegada_latitud = location1.lat;
                                    llegada_longitud = location1.lon;

                                    try
                                    {
                                        glatlng2 = new GLatLng(location1.lat, location1.lon);


                                        var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);
                                        var kmdistance = (miledistance * 1.609344).toFixed(1);



                                        origen_estado =  $("#origen_estado").val();
                                        origen_ciudad =  $("#origen_ciudad").val();
                                        origen_zona =  $("#origen_zona").val();
                                        llegada_estado = $("#llegada_estado").val();
                                        llegada_ciudad = $("#llegada_ciudad").val();
                                        llegada_zona = $("#llegada_zona").val();



                                        var parametros = { origen_codigo_google : origen_codigo_google,
                                                           origen_estado        : origen_estado,
                                                           origen_ciudad        : origen_ciudad,
                                                           origen_zona          : origen_zona,
                                                           distancia            : kmdistance,
                                                           origen_latitud       : origen_latitud,
                                                           origen_longitud      : origen_longitud,
                                                           llegada_codigo_google: llegada_codigo_google,
                                                           llegada_estado       : llegada_estado,
                                                           llegada_ciudad       : llegada_ciudad,
                                                           llegada_zona         : llegada_zona,
                                                           llegada_latitud      : llegada_latitud,
                                                           llegada_longitud     : llegada_longitud
                                            };


                                        $.ajax({
                                            data:  parametros,
                                            url:   'ajax_crear_ruta.php',
                                            type:  'post',
                                            beforeSend: function () {
                                                $("#informacion").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                                            },
                                            success:  function (response) {

                                                if(response == 'true'){
                                                    window.location = "./crear_ruta.php?error=false";
                                                }else if(response == 'false'){
                                                    window.location = "./crear_ruta.php?error=true";
                                                }

                                                console.log(response);

                                            }
                                        });//ajax


                                    }catch (error_catch){
                                        window.location = "./crear_ruta.php?error=true";
                                    }



                                }


                            });//end segunda location



                        }//else location1

                    });


            });



        });
    </script>

    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->
</head>
<body class="flickr-com">

<form method="post" name="asignacion" >
    <div id="body_bottom_bgd">
        <div id="">
            <div align="justify" id="right_col" >



                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->

                        <div class="dynamicContent" align="left">

                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong> Módulo de Bienes | Crear Ruta</strong></h1>

                            <!-- Beginning of compulsory code below -->
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="8"  >
                                <tr>
                                    <td>
                                    <label >Punto de Origen</label>
                                    </td>
                                </tr>


                                <tr></tr>

                                <tr>
                                    <td>
                                    <label>Estado</label>
                                    </td>
                                    <td><input id="origen_estado" type="text"/></td>
                                </tr>


                                <tr>
                                    <td>
                                        <label >Ciudad</label>
                                    </td>
                                    <td><input id="origen_ciudad" type="text"/></td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Zona (Opcional)</label>
                                    </td>
                                    <td><input id="origen_zona" type="text"/></td>
                                </tr>

                            </TABLE>
                            <br/>
                            <hr/>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="8" >

                                <tr>
                                    <td>
                                        <label >Punto de Llegada</label>
                                    </td>

                                </tr>


                                <tr></tr>

                                <tr>
                                    <td>
                                        <label>Estado</label>
                                    </td>
                                    <td><input id="llegada_estado" type="text"/></td>
                                </tr>


                                <tr>
                                    <td>
                                        <label >Ciudad</label>
                                    </td>
                                    <td><input id="llegada_ciudad" type="text"/></td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Zona (Opcional)</label>
                                    </td>
                                    <td><input id="llegada_zona" type="text"/></td>
                                </tr>

                                <tr>
                                    <td>
                                        <input value="Comprobar Dirección" id="comprobar" type="button" title="Comprobar Dirección"/>
                                    </td>
                                </tr>

                            </TABLE>




                            <div id="marco_resultado" style=" height: 100px;font-size: 1.2em">
                                <div id="resultado" style="  border: 2px solid #669AC6;display: none;padding: 10px;
                                -webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
                                    Esta Deacuerdo con sus Direcciones? <br/>
                                    <div id="origen_salida">&nbsp;</div>
                                    <div id="llegada_salida">&nbsp;</div>
                                </div>
                            </div>

                            <br/>

                            <table>
                                <tr>
                                    <td>
                                        <input type="button" value="Guardar" id="submit">
                                    </td>

                                    <td>
                                        <a href="./rutas_ver.php"> <input type="button" value="Ver"></a>
                                    </td>

                                    <td>
                                        <a href="../../bie_menu.php"><input type="button" value="Atras"></a>
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