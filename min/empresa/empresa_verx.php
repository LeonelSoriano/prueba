<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>
<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->

<!--<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Listado de Turnos</h1>-->

<!-- Beginning of compulsory code below -->

<form method="post">

   <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
          <!--</div>-->                <!-- Menu -->
                  <!--  ?php include 'include/nav.php'; ?>-->
                <div align="justify" id="right_col"  style="width: 85%">
                    <div id="header">
                    </div>
                        <div id="">
                            <div id="firefoxbug"><!-- firefoxbug -->
                               <!-- <div id="blue_line"></div>-->
                                <div class="dynamicContent" align="left">
                                  <!--  <h1>Inicio</h1>-->
    <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Proveedor</strong></h1>
        <br/><br/>
        <table border=none class="tablas-nuevas">

            <tr id="tmp">
                <th >Nombre</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Correo Eectrónico</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th></th>
            </tr>
            <tr>
            <?php
            include("../../db.php");
            $result=mysql_query("SELECT * FROM min_empresa");
                while($test = mysql_fetch_array($result)){

                    $id = $test['codigo'];

                    echo "<tr align='center'>";
                    echo"<td><font color='black'>". $test['codigo_alias']. "</font></td>";
                    echo"<td><font color='black'>". $test['rif']. "</font></td>";
                    echo"<td><font color='black'>". $test['descripcion']. "</font></td>";
                    echo"<td><font color='black'>". $test['correo']. "</font></td>";
                    echo"<td><font color='black'>". $test['direccion']. "</font></td>";
                    echo"<td><font color='black'>". $test['telefono']. "</font></td>";


                    echo"<td> <a href ='empresa_mod.php?codigo=$id'>Modificar</a></td>";
                    echo "</tr>";
                }
            mysql_close($conn);
            ?>
            </tr>

        </table>
       <br/>
    <a href="empresa.php"><input type="button" value="Atras"></a>
<p></p>
                                </div>
                            </div><!--end firefoxbug-->
                        </div><!--end left_bgd-->

                </div>
                <p>
                  <!--end right_col-->
                </p>
                <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>

<!-- / END -->

</form>

</body>
</html>