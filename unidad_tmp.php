<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php

if(isset($_POST['submit'])){

    require_once 'db.php';

    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];

    $sql = "insert into mco_unidad (descripcion,sigla)
                    values('$descripcion','$codigo');";

    echo $sql;
    //echo $sql;
    //exit;

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
    echo "Registro Almacenado";
}
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

    <script>
        $(function() {
            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />




</head>

<body class="flickr-com">

<p><a href="mrh_menu.php" class="main-site">Principal</a></p>

<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Gerencia</h1>

<!-- Beginning of compulsory code below -->
<form method="post">


    <TABLE BORDER="0" CELLSPACING="2" WIDTH="400">

        <TR>
            <TD><label>Código</label></TD>
            <TD><p><input type="text" name="codigo" id="codigo" size="20"></p></TD>
        </TR>
        <TR>
            <TD><label>Descripción</label></TD>
            <TD><p><input type="text" name="descripcion" id="descripcion" size="20"></p></TD>
        </TR>


    </TABLE>

    <p><input type="submit" value="Guardar datos" name="submit"></p>


    <form/>
    <!-- / END -->

</body>
</html>
