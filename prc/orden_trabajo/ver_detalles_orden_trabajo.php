<!DOCTYPE html>
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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

    <style media="screen" type="text/css">

        #handsontable table td,
        #handsontable table th{
            font-size: 11px;
            text-align: center;
            padding-left: 3px;
            padding-right: 3px;


        }

        #id_leyenda{
            line-height: 3%;
            padding-left: 40px;
            border-style: solid;
            border-width: 2px;
            border-color: #ABABEE;
            padding-top: 7px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            width: 75%;
            font-size: 1em;

        }

        #id_leyenda h2{
            margin-bottom: 20px;
            margin-left: -15px;
            font-size: 1em;

        }



        .leyenda span{
            font-weight: bold;
            font-size: 1em;

        }

        #last{
            margin-bottom: 37px;
        }

        .handsontable td {

            text-align: center;

        }
    </style>


    <script type="text/javascript">
        $(function() {


            //$('#handsontable').css('height',$('#handsontable').height()+200);

            // var ht = $('#handsontable').handsontable('getInstance');


//            $.ajax({ url : url, data : data, success : function () {
//                $container.handsontable('setDataAtCell', 0, 5 , 11 ,'program')
//            });


            // var ht = $('#handsontable').handsontable('getInstance');
            //ht.setDataAtCell(data);

           /* var data = [
                ["", "Kia", "Nissan", "Toyota", "Honda"],
                ["2008", 10, 11, 12, 13],
                ["2009", 20, 11, 14, 13],
                ["2010", 30, 15, 12, 13]
            ];

            $('#handsontable').handsontable("loadData", data);*/
            //  $('#handsontable').handsontable('setDataAtCell', 0, 5 , 'leonel' )


            $('#ordenes').bind('change',function(){


                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                var seleccionado = this.selectedIndex;



                var values = $("#ordenes_hi>option").map(function() { return $(this).val(); });


                //  if(this.selectedIndex - 1 >= 0)
                //    alert( $('#ordenes_hi  option:eq('+(this.selectedIndex - 1)+')').val());


                var parametros = { codigo : values[seleccionado-1] };

                $.ajax({
                    data:  parametros,
                    url:   'ajax_detalle_orden_trabajo.php',
                    type:  'post',
                    beforeSend: function (x) {
                        x.overrideMimeType("application/json;charset=UTF-8");
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        //$("#id_leyenda").html(response);
                        //var r = eval(response);
                        //$("#super").html(response['js']);
                        //console.log(response['js']);
                        $("#contenedor-hand").html(response['html']);
                        $("#super").html(response['js']);


                       // $('#handsontable').handsontable("loadData", r);
                    }
                });//ajax1


                //manda la selecion

                var ajax_head;
                if(this.selectedIndex - 1 >= 0)
                    ajax_head = $('#ordenes_hi  option:eq('+(this.selectedIndex - 1)+')').val();
                else
                    ajax_head = 0;

                var parametros = { codigo : ajax_head };


                $.ajax({
                    data:  parametros,
                    url:   'ajax_head_orden.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {

                        $("#head_orden").html(response);

                    }
                });//ajax2

            });

        });//end jquery


    </script>

</head>
<body class="flickr-com">

<div style="font-weight: bold" t></div>


<form method="post" name="uso_consumo" id="form">
    <div id="body_bottom_bgd">
        <div id="">

            <div align="justify" id="right_col" >

                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">

                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Almacén | Uso-Consumo</strong></h1>

                            <!-- Beginning of compulsory code below -->
                            <br/><br/>


                            <p style="margin-left: 40px;margin-bottom: 30px">
                                <label style="font-size: 14px; font-weight: bold;">Numero de Orden &nbsp;&nbsp;&nbsp;</label>

                                <select id="ordenes" style="font-size: 1.1em">
                                    <option>--------------------</option>

                                    <?php
                                    include_once('../../db.php');

                                    $result=mysql_query("SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND fecha_culminacion <> 'n'");
                                    while($test = mysql_fetch_array($result)){
                                        echo ("<option>".$test['codigo_alias']."</option>");
                                    }

                                    ?>
                                </select>
                            </p>


                                <select id="ordenes_hi" style="display: none">
                                    <?php
                                    include_once('../../db.php');

                                    $result=mysql_query("SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND fecha_culminacion <> 'n'");
                                    while($test = mysql_fetch_array($result)){

                                        echo ("<option>".$test['codigo']."</option>");

                                    }

                                    ?>
                                </select>




    <div id="head_orden" style="margin-bottom: 20px"></div>

        <div id="super" >

        </div>

<div id="contenedor-hand">

</div>

        <div id="id_leyenda">
            <h2> Leyenda: </h2>
            <p class="leyenda"> <span>√ Qs P/U: </span> Cantidad Estándar por  Unidad </p>
            <p class="leyenda"> <span>√ Ps P/U: </span> Precio Estándar por Unidad </p>
            <p class="leyenda"> <span>√ Cs P/U: </span> Costo Estándar  por Unidad </p>
            <p class="leyenda"> <span>√ Qr S: </span> Cantidad Real Solicitada </p>
            <p class="leyenda"> <span>√ Pr P/U: </span> Precio Real por Unidad </p>
            <p class="leyenda"> <span>√ Ctp: </span> Costos Total de Producción </p>
            <p class="leyenda"> <span>√ Qe P/U: </span> Cantidad Real por Unidad </p>
            <p class="leyenda"> <span>√ Cr P/U: </span>Costo Real por Unidad</p>
            <p class="leyenda" > <span>√ VQ: </span>Variación Cantidad</p>
            <p class="leyenda" > <span>√ IE: </span>Indicador de Eficiencia</p>
            <p class="leyenda" > <span>√ VC: </span>Variación Costo</p>
            <p class="leyenda" id="last"> <span>√ IP: </span>Indicador de Precio</p>
        </div>
        <br/><br/>
        <table>
            <tr>
                <td>
                    <input id="enviar" type="submit" value="Guardar datos" name="submit">
                </td>
                <td>
                    <a href="uso_consumo_ver.php"><input type="button" value="Ver datos"></a>
                </td>
                <td>
                    <a href="../../prc_menu.php"><input type="button" value="Atras"></a>
                </td>
            </tr>
        </table>
        <!-- / END -->


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