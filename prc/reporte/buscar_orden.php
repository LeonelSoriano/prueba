<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 20/11/14
 * Time: 09:51 AM
 */
?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>SICAP | Sistema Integral de Costos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
        <link href="../../js/jquery-ui-1.11.0.custom/jquery-ui.css" rel="stylesheet">
        <script src="../../js/jquery-ui-1.11.0.custom/external/jquery/jquery.js"></script>
        <script src="../../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>

        <style>
            body{
                font: 62.5% "Trebuchet MS", sans-serif;
                margin: 50px;
            }
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



    </head>
    <body class="flickr-com">


    <!-- Beginning of compulsory code below -->
    <form method="post">

        <table border=none class="tablas-nuevas">
            <tr>
                <th>Nombre Articulo</th>
                <th>Orden</th>
                <th>Fecha de Inicio</th>
                <th>Producción Planificada</th>
                <th>Producción Real</th>
                <th></th>
            </tr>
            <?php
            include("../../db.php");


            $mes = $_GET['mes'];
            $anhio = $_GET['anhio'];


            $sql_articulo = ' ';

            if( $_GET['articulo'] != "*"){
                $articulo = $_GET['articulo'];

                $sql_articulo = "min_productos_servicios.codigo = '$articulo' AND";
            }

            $sql ="SELECT
    prc_orden_trabajo.codigo as id,
	min_productos_servicios.nombre as nombre_articulo,
	prc_orden_trabajo.fecha_inicio as fecha_inicio,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.produccion_planificada as produccion_planificada,
	prc_orden_trabajo.produccion_real as produccion_real
FROM
    prc_orden_trabajo
        INNER JOIN
    min_productos_servicios ON min_productos_servicios.codigo = prc_orden_trabajo.codigo_producto
WHERE
	prc_orden_trabajo.fecha_culminacion <> 'n' AND
	". $sql_articulo ."
	prc_orden_trabajo.eliminada = 'n'
	AND prc_orden_trabajo.fecha_inicio LIKE '$anhio-$mes%'";

            $result=mysql_query($sql);





            $primera_entrada = true;

            while($test = mysql_fetch_array($result))
            {
                //  calculos de horas
                $id = $test['id'];
                $nombre_articulo = $test['nombre_articulo'];
                $fecha_inicio = $test['fecha_inicio'];
                $codigo_alias = $test['codigo_alias'];
                $produccion_planificada = $test['produccion_planificada'];
                $produccion_real = $test['produccion_real'];



                if($primera_entrada){

                    echo "<tr align='center'>";

                    echo"<td style='text-align: left'><font color='black'> Todos </font></td>";
                    echo"<td><font color='black'> </font></td>";
                    echo"<td><font color='black'> </font></td>";
                    echo"<td><font color='black'> </font></td>";
                    echo"<td><font color='black'> </font></td>";

                    echo '<td> <ul onClick="devolver(\''. '*'.'\',\''.''.'\')" id="icons" class="ui-widget ui-helper-clearfix"> <li class="ui-state-default ui-corner-all" title=".ui-icon-check"><span class="ui-icon ui-icon-check"></span></li> </ul></td>';
                    echo "</tr>";


                    $primera_entrada = false;
                }


                echo "<tr align='center'>";

                echo"<td style='text-align: left'><font color='black'>". $nombre_articulo .  "</font></td>";
                echo"<td style='text-align: left'><font color='black'>". $codigo_alias . "</font></td>";
                echo"<td style='text-align: left'><font color='black'>". $fecha_inicio . "</font></td>";
                echo"<td style='text-align: right'><font color='black'>". $produccion_planificada . "</font></td>";
                echo"<td style='text-align: right'><font color='black'>". $produccion_real . "</font></td>";

                echo '<td> <ul onClick="devolver(\''.$id.'\',\''.$codigo_alias.'\')" id="icons" class="ui-widget ui-helper-clearfix"> <li class="ui-state-default ui-corner-all" title=".ui-icon-check"><span class="ui-icon ui-icon-check"></span></li> </ul></td>';
                echo "</tr>";/*     <span onClick="devolvercedula(\''.$codigo_alias.'\',\''.$nombre.'\',\''.$proveedor.'\',\''.$descripcion.'\',\''.$ubicacion.'\',\''.$existencia.'\')" class="ui-icon ui-icon-check"></span>*/
            }
            mysql_close($conn);
            ?>
        </table>

        <!-- / END -->

    </form>

    </body>
    </html>

    <script>
        function devolver(id,nombre){

            opener.document.formulario.orden.value = nombre;
            opener.document.formulario.orden_hi.value = id;

            window.close();

        }
    </script>





<?php

mysql_close($conn);

?>