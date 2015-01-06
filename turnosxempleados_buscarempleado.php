<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />

<script src="js/htmlDatePicker.js" type="text/javascript"></script>
<link href="css/htmlDatePicker.css" rel="stylesheet">

<!-- Beginning of compulsory code below -->

<link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
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

<table border=1 class="tablas-nuevas">
    <tr>
        <th>Cédula</th>
        <th>Ficha</th>
        <th>Nombres</th>
        <th>Apellidos</th>

        <th></th>
    </tr>
    <?php
	include("db.php");
	$result=mysql_query("SELECT * FROM mrh_empleado ORDER BY cedula*1");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    $cedula = $test['cedula'];
                    $ficha= $test['ficha'];
                    $nombre = $test['primernombre'];

                    $apellido = $test['primerapellido'];

                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td style='text-align: left'><font color='black'>". $test['cedula']. "</font></td>";
                    echo"<td style='text-align: left'><font color='black'>" .$test['ficha']."</font></td>";
                    echo"<td style='text-align: left'><font color='black'>". $test['primernombre']." ".$test['segundonombre']. "</font></td>";
                    echo"<td style='text-align: left'><font color='black'>". $test['primerapellido']." ".$test['segundoapellido']. "</font></td>";
                    echo '<td ><input type="button" onClick="devolvercedula(\''.$cedula.'\',\''.$nombre.'\',\''.$apellido.'\',\''.$id.'\')" name="buscar" value="Seleccionar" ></td>';
                    echo "</tr>";
		}
	mysql_close($conn);
    ?>
</table> 

<!-- / END -->

</form>

</body>
</html>

<script>
function devolvercedula(ced,nom,ape,codigo){
    //      alert(ced);
    //     alert(nom);
    //      alert(ape);


    opener.document.turnoxempleado.cedulaempleado.value = ced;
    opener.document.turnoxempleado.nombre.value = nom;
    opener.document.turnoxempleado.apellido.value = ape;
    opener.document.turnoxempleado.codigo_hi.value = codigo;
    window.close()
}
</script> 