<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 03/10/14
 * Time: 09:28 AM
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
                <th>Nombre</th>
                <th>Valor</th>
                <th>Fijo</th>
                <th>Periocidad</th>
                <th>Forma de Pago</th>
                <th></th>

            </tr>
            <?php
            include("../../db.php");
            $sql ="SELECT
    mno_new_bonos_produccion.codigo as codigo,
    mno_new_bonos_produccion.nombre as nombre,
    mno_new_bonos_produccion.valor as valor,
    mco_periocidad.nombre as periocidad,
    mco_forma_pago.nombre as forma_pago,
    mno_new_bonos_produccion.fijo as fijo
FROM
    mno_new_bonos_produccion
        INNER JOIN
    mco_periocidad ON mno_new_bonos_produccion.tipo_periocidad = mco_periocidad.codigo
        INNER JOIN
    mco_forma_pago ON mco_forma_pago.codigo = mno_new_bonos_produccion.tipo_forma_pago
WHERE
    mno_new_bonos_produccion.eliminado = 'no';";
            $result=mysql_query($sql);


            while($test = mysql_fetch_array($result))
            {
                //  calculos de horas
                $id = $test['codigo'];
                $nombre = $test['nombre'];
                $valor = $test['valor'];
                $fijo = $test['fijo'];
                $periocidad = $test['periocidad'];
                $forma_pago = $test['forma_pago'];

                echo "<tr align='center'>";

                echo"<td><font color='black'>". $nombre .  "</font></td>";
                echo"<td><font color='black'>". $valor . "</font></td>";
                echo"<td><font color='black'>". $fijo . "</font></td>";
                echo"<td><font color='black'>".  $periocidad .  "</font></td>";
                echo"<td><font color='black'>".  $forma_pago .  "</font></td>";
                echo '<td> <ul onClick="devolver(\''.$id.'\',\''.$nombre.'\')" id="icons" class="ui-widget ui-helper-clearfix"> <li class="ui-state-default ui-corner-all" title=".ui-icon-check"><span class="ui-icon ui-icon-check"></span></li> </ul></td>';
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

            opener.document.formulario.nombre_bono.value = nombre;
            opener.document.formulario.codigo_bono_hi   .value = id;
           // opener.document.formulario.placa_vehiculo.value = placa;

            window.close();

        }
    </script>




<?php

mysql_close($conn);

?>