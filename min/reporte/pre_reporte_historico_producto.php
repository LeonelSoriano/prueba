<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/01/15
 * Time: 01:15 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventarios | Historico Producto');




$select_inventario_from = '';
$result=mysql_query("SELECT * FROM min_tipo_inventario WHERE codigo <>'12'");
while($test = mysql_fetch_array($result)){

    $codigo = $test['codigo'];
    $select_inventario_from .= "<option value='$codigo'>". $test['tipo']."</option>";
}


$layout->append_to_header(
    <<<EOT
    <script type="text/javascript">

        $(function() {

            var head_active = false;

            var opciones_usadas = [];

            $( '#articulo_buscar' ).click(function() {

                var cod_inventario = $('#inventario').val();


                var win = window.open('articulo_buscar.php?codigo_inventario='+cod_inventario, 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');
                win.focus();
                win.onbeforeunload = function(e) {

                    var nombre_producto = decodeURIComponent(escape($('#nombre_producto').val()));
                    var id_producto = $('#id_producto').val();


                    if(opciones_usadas.indexOf(nombre_producto) == -1){

                        opciones_usadas.push(nombre_producto);



                    if(!head_active && nombre_producto != ''){
                        $('#table').after('<br/><br/>' +
                        '<table border=none class="tablas-nuevas" id="tabla">' +
                        '  <tr  style="text-align: center">' +
                        '<th>Nombre</th>' +
                        '<th></th>' +
                        '<th style="display: none">codigo_producto_hi</th>' +

                        '</tr>' +
                        '</table>');

                        head_active = true;
                    }


                    $('#tabla tr:last').after("<tr>" +
                    "<td  style='text-align: left'>  "+ nombre_producto +"  </td> " +
                    "<td> <ul  id='icons' class='ui-widget ui-helper-clearfix'> <li class='ui-state-default ui-corner-all' title='.ui-icon-check'><span class='ui-icon ui-icon-check'></span></li> </ul></td>" +
                    "<td style='display: none'> <label >"+id_producto+"</label> </td> " +
                    "</tr>");

                        $('.ui-widget').click(function() {
                            $(this).parent().parent().remove(); //Deleting TD element
                        });


                    }
                };

            });



            /*-.-..-.-.-.-.-..-.-.-.-..-.-*/

            $('#form').submit(function() {
                //$( "#existencia_articulo_hi" ).val(  $( "#existencia_articulo" ).val());
                //$( "#cantidad_final_hi" ).val(  $( "#cantidad_final" ).val());


                var columns = $('#tabla tr th').map(function() {  return $(this).text();
                });

                var tableObject = $('#tabla  tr').map(function(i) {    var row = {};  $(this).find('td').each(function(i) {      var rowName = columns[i];    row[rowName] = $(this).text();
                });return row;   }).get();


                var json_tabla= JSON.stringify(tableObject);


                $("#post_array").val(json_tabla);
                $("#post_array").serializeArray();


                return true; // return false to cancel form action
            });



        });

    </script>


    <style>

        .demoHeaders {
            margin-top: 2em;
        }
        #dialog-link {
            padding: .4em 1em .4em 20px;
            text-decoration: none;
            position: relative;
        }
        #dialog-link span.ui-icon {
            margin: 0 5px 0 0;
            position: absolute;
            left: .2em;
            top: 50%;
            margin-top: -8px;
        }
        #icons {
            margin: 0;
            padding: 0;
        }
        #icons li {
            margin: 2px;
            position: relative;
            padding: 4px 0;
            cursor: pointer;
            float: left;
            list-style: none;
        }
        #icons span.ui-icon {
            float: left;
            margin: 0 4px;
        }
        .fakewindowcontain .ui-widget-overlay {
            position: absolute;
        }
        select {
            width: 200px;
        }

        table.tablas-nuevas {
            border-collapse: collapse;



        }

        table.tablas-nuevas, th.tablas-nuevas, td.tablas-nuevas {
            border: 1px solid black;
        }

        table.tablas-nuevas {
            margin: 0 auto;
            width: 90%;

        }

        table.tablas-nuevas th {
            height: 30px;

            padding-right: 3px;
            padding-left: 3px;
        }


        table.tablas-nuevas td {
            text-align: center;

            vertical-align: bottom;

        }

        table.tablas-nuevas td {
            padding: 6px;
        }

        table.tablas-nuevas ,table.tablas-nuevas td,table.tablas-nuevas th {
            border: 0px solid;

        }



        table.tablas-nuevas td{
            border-right: .5px solid white;
            border-bottom: .1px solid black;
        }


        table.tablas-nuevas th {
            border: 0.5px solid white;
            background-color: #88A3FD;
            font-weight: normal;
            border-top: 5px solid #7A96F9;
            padding-right: 3px;
            padding-left: 3px;
        }


        table.tablas-nuevas tr:nth-child(odd){ background-color:#ECF0FF; }

        table.tablas-nuevas tr:nth-child(even)    { background-color:#C6D1FC; }

        table.tablas-nuevas tr:nth-child(even):hover{
            background-color: #B0C1FA;
        }

        table.tablas-nuevas tr:nth-child(odd):hover{
            background-color: #B0C1FA;
        }

    </style>
EOT
);


$layout->get_header();

$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" id="form" name="formulario" action="reporte_historico_producto.php  id="contact-form">
    <div class="formLayout">
    <fieldset>

<label>Tipo de Inventario</label>
<select name="inventario"  id="inventario">
$select_inventario_from
</select>
<br/>



    <label style="width: 100px">Compra</label>
   <input style="margin-top: 8px" type="radio" name="tipo" id="compra" value="compra" checked/>
    <br/>

 <label style="width: 100px">Venta</label>
<input style="margin-top: 8px" type="radio" name="tipo" id="venta" value="venta"/>
<br/>

<label>Articulo</label>
<input type='button' name='articulo_buscar' id='articulo_buscar' value='Buscar'/>
<input type='hidden' name='articulo_hi' name='articulo_hi'/>

<input type="hidden" id="nombre_producto" value=""/>
<input type="hidden" id="id_producto" value=""/>
<input type="hidden" value="" id="post_array" name="post_array"/>

<br/>

<div id="table">

</div>
<br/>
<br/>
<input type="submit" value="Generar Reporte" name="submit">
<a href="../../min_menu.php"><input type="button" value="Atras"></a>


    </div>
    </fieldset>
    </form>
EOT
);



$layout->get_footer();
mysql_close($conn);