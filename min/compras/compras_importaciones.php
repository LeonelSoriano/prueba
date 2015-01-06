<?php

require_once ('../../db.php');
?>

<?php

/*
if (isset($_POST['submit'])){

    $codigoalias = $_POST['codigoalias'];
    $rif = $_POST['rif'];
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $sql = "INSERT INTO min_empresa (codigo_alias,descripcion,correo,direccion,telefono,rif) VALUES ('$codigoalias','$descripcion','$correo',
      '$direccion','$telefono','$rif')";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

}

*/

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
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />


    <script src="../../js/jquery-ui-1.11.0.custom/external/jquery/jquery.js" type="text/javascript"></script>
    <script src="../../js/jquery-validation-1.13.0/dist/jquery.validate.js" type="text/javascript"></script>
    <script src="../../js/jquery-validation-1.13.0/src/localization/messages_es.js" type="text/javascript"></script>


    <script>

/*        Number.prototype.formatMoney = function(c, d, t){
            var n = this,
                c = isNaN(c = Math.abs(c)) ? 2 : c,
                d = d == undefined ? "." : d,
                t = t == undefined ? "," : t,
                s = n < 0 ? "-" : "",
                i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };


        function covertir(str_num){
            if(str_num.search(",") != -1){
                str_num.replace(",",".");
            }else if(str_num.search(".") != -1){
                str_num.replace(",",".");
            }
        }

*/




function SumComa()
{



    var pila_sum = new Array();
    var acum_sum = 0;

    this.add = function(str){

        var tmp = str.replace(",",".");

        pila_sum.push(tmp);
    }




    this.print = function(){

        for(var i = 0 ; i < pila_sum.length ; i++)
            console.log(pila_sum[i] + " -> "+ typeof(pila_sum[i]));
    }

    this.getSum = function(){

        for(var i = 0 ; i < pila_sum.length ; i++){

            if(pila_sum[i].length == 0){
                pila_sum[i] = 0;
            }
            acum_sum = parseFloat(acum_sum) + parseFloat( pila_sum[i]);



        }

        acum_sum =  Math.round(acum_sum*100)/100

        acum_sum = acum_sum.toString();
        acum_sum = acum_sum.replace(".",",");





        var rtn = acum_sum;
        acum_sum = 0;

        pila_sum.length = 0;

        return rtn;
    }


    this.divComa = function(num,div){
        var div = div.replace(",",".");
        var num = num.replace(",",".");

        div = parseFloat(div);
        num = parseFloat(num);


        var resultado = num / div;


        resultado = Math.round(resultado*100)/100;


        resultado = resultado.toString();
        resultado = resultado.replace(".",",");


        return resultado;

    }


    this.getMul = function(){

        if(acum_sum == 0 ){
            acum_sum = 1;
        }
        for(var i = 0 ; i < pila_sum.length ; i++){

            if(pila_sum[i].length == 0){
                pila_sum[i] = 0;
            }
            acum_sum = parseFloat(acum_sum) * parseFloat( pila_sum[i]);

        }

        acum_sum =  Math.round(acum_sum*100)/100

        acum_sum = acum_sum.toString();
        acum_sum = acum_sum.replace(".",",");


        var rtn = acum_sum;
        acum_sum = 0;

        pila_sum.length = 0;

        return rtn;
    }



}


        var  costo_aduanales;
        var gastos_importacion;
        var gastos_arancelarios;
        var gasto_nacionalizacion;

        $(function() {


            $("input[name=opcion_importacion][value=" + opener.document.compras.check_importacion.value + "]").prop('checked', true);
            $("input[name=opcion_aduanales][value=" + opener.document.compras.check_aduanales.value + "]").prop('checked', true);
            $("input[name=opcion_arancelarios][value=" + opener.document.compras.check_arancelarios.value + "]").prop('checked', true);
            $("input[name=opcion_nacionalizacion][value=" + opener.document.compras.check_nacionalizacion.value + "]").prop('checked', true);


            var sumComa = new SumComa();

            $( "#gasto_importacion").val(opener.document.compras.gasto_importacion.value);
            $( "#gasto_aduanales").val(opener.document.compras.gasto_aduanales.value);
            $( "#gastos_arancelarios").val(opener.document.compras.gasto_arancelarios.value);
            $( "#gasto_nacionalizacion").val(opener.document.compras.gasto_nacionalizacion.value);
            $( "#tasa_cambio").val(opener.document.compras.tasa_cambio.value);

            $( "#CONCEX" ).click(function() {
                $( "#tasa_cambio").val("6,3");

            });

            $( "#SICAD" ).click(function() {
                $( "#tasa_cambio").val("11,00");
            });

            $( "#SICAD_II" ).click(function() {
                $( "#tasa_cambio").val("49,98");
            });


            $("#boton_submit").click(function() {


                var opcion_importacion = $('input[name=opcion_importacion]:checked', '#myForm').val();
                var opcion_aduanales = $('input[name=opcion_aduanales]:checked', '#myForm').val();
                var opcion_arancelarios = $('input[name=opcion_arancelarios]:checked', '#myForm').val();
                var opcion_nacionalizacion = $('input[name=opcion_nacionalizacion]:checked', '#myForm').val();



                if(opcion_importacion != "bs"){

                    sumComa.add($( "#gasto_importacion").val());
                    sumComa.add($( "#tasa_cambio").val());

                    gastos_importacion = sumComa.getMul();
                }else{
                    sumComa.add($( "#gasto_importacion").val());
                    gastos_importacion = sumComa.getSum();
                }

                /*..-.-.-.-..-.-.-.-.-.*/
                if(opcion_aduanales != "bs"){


                    sumComa.add($( "#gasto_aduanales").val());
                    sumComa.add($( "#tasa_cambio").val());

                    costo_aduanales = sumComa.getMul();
                }else{
                    sumComa.add($( "#gasto_aduanales").val());
                    costo_aduanales = sumComa.getSum();
                }

                /*..-.-.-.-..-.-.-.-.-.*/
                if(opcion_aduanales != "bs"){


                    sumComa.add($( "#gastos_arancelarios").val());
                    sumComa.add($( "#tasa_cambio").val());

                    gastos_arancelarios = sumComa.getMul();
                }else{

                    sumComa.add($( "#gastos_arancelarios").val());
                    gastos_arancelarios = sumComa.getSum();
                }


                /*..-.-.-.-..-.-.-.-.-.*/
                if(opcion_nacionalizacion != "bs"){


                    sumComa.add($( "#gasto_nacionalizacion").val());
                    sumComa.add($( "#tasa_cambio").val());

                    gasto_nacionalizacion = sumComa.getMul();
                }else{

                    sumComa.add($( "#gasto_nacionalizacion").val());
                    gasto_nacionalizacion = sumComa.getSum();
                }

                sumComa.add(costo_aduanales);
                sumComa.add(gastos_importacion);
                sumComa.add(gastos_arancelarios);
                sumComa.add(gasto_nacionalizacion);


                var  suma_total_importacion = sumComa.getSum();



                opener.document.compras.gasto_importacion.value = $( "#gasto_importacion").val();
                opener.document.compras.gasto_aduanales.value = $( "#gasto_aduanales").val();
                opener.document.compras.gasto_arancelarios.value = $( "#gastos_arancelarios").val();
                opener.document.compras.gasto_nacionalizacion.value = $( "#gasto_nacionalizacion").val();
                opener.document.compras.tasa_cambio.value = $( "#tasa_cambio").val();
                opener.document.compras.valor_importacion.value = suma_total_importacion;



                opener.document.compras.check_importacion.value = opcion_importacion;
                opener.document.compras.check_aduanales.value = opcion_aduanales;
                opener.document.compras.check_arancelarios.value = opcion_arancelarios;
                opener.document.compras.check_nacionalizacion.value = opcion_nacionalizacion;




                window.close();
            });
            //Dólar ($)
            //alert(opener.document.compras.unidad_medida.value);




        });
    </script>


    <style>
        #tabla{

            width: 95%;
        }
    </style>



</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post" id="myForm" accept-charset="UTF-8">

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




                            <!-- este lleva de mas en una ventana emergente gasto de importacion
                            gastos aduanales, gostos arancelarios, gasto nacionalizacion -->
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="380" id="tabla">
                                <tr>
                                    <td><label>Gasto de Importación </label></td>
                                    <TD><p><input type="text" id="gasto_importacion" name="gasto_importacion"  size="20" /></p></TD>
                                    <td><p>
                                            <input type="radio" name="opcion_importacion" value="bs" checked/>&nbsp; Bol&iacute;var
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="opcion_importacion" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
                                    </p></td>
                                </tr>

                                <tr>
                                    <td><label>Gastos Aduanales</label></td>
                                    <TD><p><input type="text" name="" id="gasto_aduanales" size="20"/></p></TD>

                                    <td><p>
                                            <input type="radio" name="opcion_aduanales" value="bs" checked/>&nbsp; Bol&iacute;var
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="opcion_aduanales" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
                                        </p></td>
                                </tr>


                                <TR>
                                    <td><label>Gastos Arancelarios</label></td>
                                    <td><p><input type="text" name="gastos_arancelarios" id="gastos_arancelarios"></p></td>

                                    <td><p>
                                            <input type="radio" name="opcion_arancelarios" value="bs" checked/>&nbsp; Bol&iacute;var
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="opcion_arancelarios" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
                                        </p></td>
                                </TR>

                                <tr>
                                    <td><label >Gasto de Nacionalizacion</label></td>
                                    <td><p><input type="text" name="gasto_nacionalizacion" id="gasto_nacionalizacion"  size="20"/></p></td>
                                    <td><p>
                                            <input type="radio" name="opcion_nacionalizacion" value="bs" checked/>&nbsp; Bol&iacute;var
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="opcion_nacionalizacion" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
                                        </p></td>

                                </tr>
                                <br/>


                                <tr>
                                    <td><label >Tasa de Cambio</label></td>
                                    <td><p><input type="text" name="tasa_cambio" id="tasa_cambio"/></p></td>
                                    <td>
                                        <p><input type="button" name="CONCEX" value="CONCEX" id="CONCEX"/>
                                        <input type="button" name="SICAD" value="SICAD" id="SICAD"/>
                                            <input type="button" name="SICAD_II" value="SICAD II" id="SICAD_II"/>
                                        </p>
                                    </td>


                                </tr>


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="button" id="boton_submit" value="Guardar datos" name="boton_submit" />

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



<!--  guardado este codigo q lo colocare en configuracino -->
<?php

/*<label>Tipo de Empresa</label><br/>
    <div style="margin-left: 135px">


       <?php
       $result = mysql_query("SET NAMES utf8");
        $result=mysql_query("SELECT tipo FROM min_tipo_empresa");
        while($test = mysql_fetch_array($result)){

            echo "<p><input type='checkbox' name='tipo[]' value='". utf8_encode($test['tipo']) . "'/>&nbsp;&nbsp;&nbsp;&nbsp;" .utf8_encode($test['tipo']) ."</p>";

        }

*/
?>

