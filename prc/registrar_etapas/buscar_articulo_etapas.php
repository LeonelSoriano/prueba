<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />






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
            text-align: left;

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
            <th>Código</th>
            <th>Nombre</th>
            <th>Proveedor</th>

            <th>Ubicación</th>
            <th>Existencia</th>

            <td>Opciones</td>
        </tr>
        <?php
        include("../../db.php");
        include_once("../../clases/funciones.php");

        $result=mysql_query("SELECT * FROM min_productos_servicios WHERE inventario=1 OR inventario=2 OR inventario=11  ORDER BY nombre ");


        while($test = mysql_fetch_array($result))
        {
            //  calculos de horas
            $id = $test['codigo'];
            $codigo_alias = $test['codigo_alias'];
            $nombre= $test['nombre'];
            $proveedor = $test['proveedor'];

            $tipo_inventario = utf8_multiplataforma($test['inventario']);



            $ubicacion = $test['ubicacion'];

            $existencia = "";
            $result_=mysql_query("SELECT * FROM min_valoracion WHERE codigo_producto='$id'");
            while($test_ = mysql_fetch_array($result_)){
                $existencia = $test_['unidades'];
            }

            $result_=mysql_query("SELECT * FROM min_tipo_inventario WHERE codigo='$tipo_inventario'");

            $test_ = mysql_fetch_array($result_);

            $nombre_inventario = $test_['tipo'];


            echo "<tr align='center'>";
            echo"<td><font color='black'>" .utf8_multiplataforma($codigo_alias)."</font></td>";
            echo"<td><font color='black'>". utf8_multiplataforma($nombre) . "</font></td>";
            echo"<td><font color='black'>" .utf8_multiplataforma($proveedor) ."</font></td>";

            echo"<td><font color='black'>". utf8_multiplataforma($ubicacion) . "</font></td>";
            echo"<td style='text-align: right'><font color='black'>". utf8_multiplataforma($existencia).  "</font></td>";
            echo '<td> <ul onClick="devolvercedula(\''.$codigo_alias.'\',\''.$id.'\',\''.utf8_multiplataforma($nombre).'\',\''.$nombre_inventario.'\')" id="icons" class="ui-widget ui-helper-clearfix"> <li class="ui-state-default ui-corner-all" title=".ui-icon-check"><span class="ui-icon ui-icon-check"></span></li> </ul></td>';
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
    function devolvercedula(codigo_alias,id,nombre_articulo,nombre_inventario){

          opener.document.agregar.articulo_nombre.value = nombre_articulo;
          opener.document.agregar.codigo_articulo_hi.value = id;
        opener.document.agregar.cantidad_estandar.value = '';


        window.close();

    }
</script>




<?php

mysql_close($conn);

?>