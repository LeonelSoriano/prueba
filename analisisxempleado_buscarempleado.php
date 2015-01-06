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

<!-- / END -->

</head>
<body class="flickr-com">


<!-- Beginning of compulsory code below -->
<form method="post">

<table border=1>
    <tr>
        <td>Cédula</td>
        <td>Ficha</td>
        <td>Nombres</td>
        <td>Apellidos</td>

        <td>Opciones</td>
    </tr>
    <?php
	include("db.php");
	$result=mysql_query("SELECT * FROM mrh_empleado");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    $cedula = $test['cedula'];
                    $ficha= $test['ficha'];
                    $nombre = $test['primernombre'];
                    echo $nombre;
                    $apellido = $test['primerapellido'];

                    echo "<tr align='center'>";	
                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                    echo"<td><font color='black'>". $test['cedula']. "</font></td>";
                    echo"<td><font color='black'>" .$test['ficha']."</font></td>";
                    echo"<td><font color='black'>". $test['primernombre']." ".$test['segundonombre']. "</font></td>";
                    echo"<td><font color='black'>". $test['primerapellido']." ".$test['segundoapellido']. "</font></td>";
                    echo '<td><input type="button" onClick="devolvercedula(\''.$cedula.'\',\''.$nombre.'\',\''.$apellido.'\')" name="buscar" value="Seleccionar" ></td>';
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
function devolvercedula(ced,nom,ape){
    //      alert(ced);
    //     alert(nom);
    //      alert(ape);
    ced = ced.toUpperCase();
    nom = nom.toUpperCase();
    ape = ape.toUpperCase();
    opener.document.turnoxempleado.cedulaempleado.value = ced;
    opener.document.turnoxempleado.nombre.value = nom;
    opener.document.turnoxempleado.apellido.value = ape;
    window.close()
}
</script> 