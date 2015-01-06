<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 11/11/14
 * Time: 03:51 PM
 */


?>
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

            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Celular</th>
            <th>TelÃ©fono</th>
            <th>Opciones</th>
        </tr>
        <?php
        include("../../db.php");
        $result=mysql_query("SELECT * FROM mrh_empleado order by cedula");
        while($test = mysql_fetch_array($result))
        {
            //  calculos de horas
            $id = $test['codigo'];
            $cedula = $test['cedula'];
            $primernombre = $test['primernombre'];
            $primerapellido = $test['primerapellido'];


            $celular = $test['celular'];
            $telefono = $test['telefono'];


            echo "<tr align='center'>";
            echo"<td><font color='black'>" .$primernombre."</font></td>";
            echo"<td><font color='black'>". $primerapellido . "</font></td>";
            echo"<td><font color='black'>". $cedula . "</font></td>";
            echo"<td><font color='black'>". $celular . "</font></td>";
            echo"<td><font color='black'>". $telefono.  "</font></td>";
            echo '<td> <ul onClick="devolverdatos(\''.$primernombre.'\',\''.$id.'\',\''.$primerapellido.'\')" id="icons" class="ui-widget ui-helper-clearfix"> <li class="ui-state-default ui-corner-all" title=".ui-icon-check"><span class="ui-icon ui-icon-check"></span></li> </ul></td>';
            echo "</tr>";
        }
        mysql_close($conn);
        ?>
    </table>

    <!-- / END -->

</form>


<script>
    function devolverdatos(primernombre,id,primerapellido){

        var nombre = primerapellido + ' '+ primernombre;

        opener.document.uso_consumo.codigo_empleado_hi.value = id;
        opener.document.uso_consumo.empleado_ver.value = nombre;

        window.close();

    }
</script>



</body>
</html>

