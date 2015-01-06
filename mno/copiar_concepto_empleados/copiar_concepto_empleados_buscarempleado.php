<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery-ui-1.10.4.custom.js"></script>
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/sicap/resources/demos/style.css">

<!-- Beginning of compulsory code below -->

<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!-- / END -->

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

        <th>Opciones</th>
    </tr>
    <?php
	include("../../db.php");
	$result=mysql_query("SELECT * FROM mrh_empleado");
        while($test = mysql_fetch_array($result))
        	{
                //  calculos de horas
                    $id = $test['codigo'];	
                    $cedula = $test['cedula'];
                    $ficha= $test['ficha'];
                    $nombre = $test['primernombre'];
                    //echo $nombre;
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

<script>
function devolvercedula(ced,nom,ape){
    //     alert(ced);
    //     alert(nom);
    //     alert(ape);
    ced = ced.toUpperCase();
    nom = nom.toUpperCase();
    ape = ape.toUpperCase();
    //     alert(ced);
    //     alert(nom);
        //alert(window.opener.win);
  
    
    opener.document.copiar_concepto_empleados.cedulaempleado.value = ced;
    opener.document.copiar_concepto_empleados.nombre.value = nom;
    opener.document.copiar_concepto_empleados.apellido.value = ape;
    window.close()
}
</script> 

</body>
</html>

