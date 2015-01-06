<?php


ini_set('display_errors', 'On');
ini_set('display_errors', 1);

?>

<?php
//echo dias_transcurridos('2012-07-01','2012-07-18');

function dias_transcurridos($fecha_i,$fecha_f)
{
    $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
     $dias = floor($dias);
    return $dias;
}



if(isset($_POST['submit'])){

    require_once ('../../db.php');
    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');





    $validation = array(

        array('nombre' => 'codigo_empleado_hi',
            'requerida' => true,
            'regla' => 'number'
        ),

        array('nombre' => 'codigo_bien_hi',
            'requerida' => true,
            'regla' => 'number'
        ),

        array('nombre' => 'codigo_bien_tipo_hi',
            'requerida' => true,
            'regla' => 'number'
        ),



        array('nombre' => 'fecha_adquisicion',
            'requerida' => true,
            'regla' => 'fecha'
        ),


    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $fecha_actual = fecha_sicap();

        $codigo_empleado = $_POST['codigo_empleado_hi'];
        $codigo_bien = $_POST['codigo_bien_hi'];
        $codigo_bien_tipo = $_POST['codigo_bien_tipo_hi'];
        $fecha_adquisicion = $_POST['fecha_adquisicion'];


        $nombre_tabla = '';



        $sql = "SELECT *, count(*) as cantidad FROM bie_asignaciones WHERE codigo_bien = '$codigo_bien' AND
            codigo_tipo_bien = '$codigo_bien_tipo' AND desasignado = 'n' AND eliminado = 'n'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);


        $fecha_asignacion = $test['fecha_asignacion'];
        $fecha_culminacion = $test['fecha_culminacion'];
        $count = $test['cantidad'];


        if($count == '1'){

            $esta_asignado = dias_transcurridos($fecha_culminacion,$fecha_actual);


            if($esta_asignado >= 0){

                header('Location: ./asignar_bien.php?exist=true');

            }else if($esta_asignado < 0){

                $sql = "UPDATE bie_asignaciones SET desasignado ='s' WHERE
                codigo_bien = '$codigo_bien' AND
            codigo_tipo_bien = '$codigo_bien_tipo' AND desasignado = 'n' AND eliminado = 'n'";

                mysql_query($sql) or die('error actualizando datos bie_asignacioes '.mysql_error());

                $sql = "INSERT INTO bie_asignaciones (codigo_bien,codigo_tipo_bien,
                    codigo_trabajador,fecha_asignacion,fecha_culminacion)
                    VALUES ('$codigo_bien','$codigo_bien_tipo','$codigo_empleado',
                    '$fecha_actual','$fecha_adquisicion')";

                mysql_query($sql) or die('error agregar bie_asignaciones  '.mysql_error());

                send_error_redirect(false);
            }

        }else if($count == '0'){

            $sql = "INSERT INTO bie_asignaciones (codigo_bien,codigo_tipo_bien,
                    codigo_trabajador,fecha_asignacion,fecha_culminacion)
                    VALUES ('$codigo_bien','$codigo_bien_tipo','$codigo_empleado',
                    '$fecha_actual','$fecha_adquisicion')";

            mysql_query($sql) or die('error agregar bie_asignaciones  '.mysql_error());

            send_error_redirect(false);
            die;

        }

       // send_error_redirect(false);

    }else if($validated->getIsError()){

        send_error_redirect(true);
    }



}


?>



<!DOCTYPE html>
<html>
<head lang="es">
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <script>
        $(function() {
            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth()<10){
                mes = myDate.getMonth() +1;
                mes = '0' + mes;
            }else{
                mes = myDate.getMonth() + 1;
            }
            var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + myDate.getDate() ;
            $("#datepicker1").val(prettyDate);
            $("#datepicker2").val(prettyDate);



            $( "#buscar_empleado" ).click(function() {
                var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });



            $( "#buscar_bien" ).click(function() {
                var win = window.open("buscar_bien.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });
    </script>
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->
</head>
<body class="flickr-com">

<form method="post" name="asignacion" >
<div id="body_bottom_bgd">
<div id="">
<div align="justify" id="right_col" >

<?php

if(isset($_GET['exist'])){
    echo("Producto esta asignado");
}

?>


<div id="header">
</div>
<div id="">
    <div id="firefoxbug"><!-- firefoxbug -->
        <!-- <div id="blue_line"></div>-->
        <div class="dynamicContent" align="left">
            <!-- <h1>Inicio</h1>-->
            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong> Módulo de Inventario | Productos y Servicios</strong></h1>

            <!-- Beginning of compulsory code below -->
            <br/><br/>
            <TABLE BORDER="0" CELLSPACING="6"  >

                <TR>
                    <TD><label>Empleado</label></TD>
                    <TD><input type="text" name="nombre_empleado"  disabled>
                        <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/></TD>

                    <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
                </TR>
                <tr></tr>
                <TR>
                    <TD><label>Bien</label></TD>
                    <TD><input type="text" name="nombre_bien"  disabled>
                        <input type="button" name="buscar_bien" id="buscar_bien" value="Buscar"/></TD>
                    <input type="hidden" name="codigo_bien_hi"/>
                    <input type="hidden" name="codigo_bien_tipo_hi"/>
                </TR>
                <tr></tr> <tr></tr>
                <tr>
                    <td>
                        <label >Fecha de Culminación</label>
                    </td>
                    <td>
                            <input type='text' id='datepicker1' name='fecha_adquisicion'>
                    </td>
                </tr>


            </TABLE>
            <br/>

            <table>
                <tr>
                    <td>
                        <input type="submit" value="Asignar" name="submit">
                    </td>

                    <td>
                        <a href="./asignar_ver.php"> <input type="button" value="Ver"></a>
                    </td>

                    <td>
                        <a href="../../bie_menu.php"><input type="button" value="Atras"></a>
                    </td>
                </tr>
            </table>
            <!-- / END -->
            <p></p>
        </div>
    </div><!--end firefoxbug-->
</div><!--end left_bgd-->

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
    <!--end right_col-->
</p>
<p>&nbsp; </p>
<div class="clearboth"></div>
</div>
<div align="center" class="pie">SICAP 2014</div>
</div>


</form>
</body>
</html>