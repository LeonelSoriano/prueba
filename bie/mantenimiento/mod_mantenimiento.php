<?php


ini_set('display_errors', 'On');
ini_set('display_errors', 1);

?>

<?php


require_once ('../../db.php');

if(isset($_POST['submit'])){

    require_once('../../clases/Validate.php');

    $validation = array(

        array('nombre' => 'nombre_mantenimiento',
            'requerida' => true),

        array('nombre' => 'tipo_medida',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'codigo_get',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'periodicidad',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'tipo_bien',
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $nombre_mantenimiento = $_POST['nombre_mantenimiento'];
        $tipo_medida = $_POST['tipo_medida'];
        $codigo_get = $_POST['codigo_get'];
        $periodicidad = $_POST['periodicidad'];
        $tipo_bien = $_POST['tipo_bien'];

        $sql = "UPDATE bie_mantenimiento SET nombre='$nombre_mantenimiento', codigo_tipo_medida='$tipo_medida',
                  codigo_tipo_bien = '$tipo_bien', periodicidad = '$periodicidad'
            WHERE codigo='$codigo_get'";

        mysql_query($sql) or die('error agregar bie_mantenimiento  '.mysql_error());


        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        header('Location: '.$current_url[0].'?'.$current_url[1].'&error=false');
        die;

    }else if($validated->getIsError()){


        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        header('Location: '.$current_url[0].'?'.$current_url[1].'&error=true');
        die;
    }

}


if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "SELECT  bie_mantenimiento.codigo as id,
bie_mantenimiento.nombre as nombre_mantenimiento,
bie_unidad_medida.nombre as nombre_medida,
bie_unidad_medida.codigo as codigo_medida,
bie_tipo_bien.nombre as nombre_bien,
bie_mantenimiento.codigo_tipo_bien as codigo_tipo_bien,
bie_mantenimiento.periodicidad as periodicidad
FROM bie_mantenimiento
INNER JOIN bie_unidad_medida
ON
bie_mantenimiento.codigo_tipo_medida = bie_unidad_medida.codigo
INNER JOIN bie_tipo_bien
ON
bie_mantenimiento.codigo_tipo_bien = bie_tipo_bien.codigo
WHERE bie_mantenimiento.eliminado = 'n' AND
bie_mantenimiento.codigo = '$id'";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $nombre_mantenimiento = $test['nombre_mantenimiento'];
    $nombre_unidad = $test['nombre_medida'];
    $codigo_medida = $test['codigo_medida'];
    $codigo_tipo_bien = $test['codigo_tipo_bien'];
    $nombre_bien = $test['nombre_bien'];
    $periodicidad = $test['periodicidad'];


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
            var prettyDate = <?php echo('"'. $fecha_culminacion . '"'); ?> ;
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


                                <tr>
                                    <td>
                                        <label>Nombre Mantenimiento</label>
                                    </td>
                                    <td>
                                        <input name="nombre_mantenimiento"  type="text" value="<?php echo($nombre_mantenimiento); ?>"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="">Unidad de Medida</label>
                                    <td>
                                        <select name="tipo_medida" >
                                            <?php
                                            $sql = "SELECT * FROM bie_unidad_medida";
                                            $result=mysql_query($sql);

                                            echo("<option value='". $codigo_medida ."'>" . $nombre_unidad . "</option>");
                                            while($test = mysql_fetch_array($result))
                                            {
                                                $nombre_unidad2 = $test['nombre'];
                                                $id = $test['codigo'];
                                                echo("<option value='". $id ."'>" . $nombre_unidad2 . "</option>");
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    </td>
                                </tr>




                                <tr>
                                    <td>
                                        <label>Periodicidad</label>
                                    </td>
                                    <td>
                                        <input name="periodicidad"  type="text" value="<?php echo($periodicidad); ?>"/>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Tipo de Bien</label>
                                    </td>
                                    <td>
                                        <select name="tipo_bien" >
                                            <?php
                                            $sql = "SELECT * FROM bie_tipo_bien";
                                            $result=mysql_query($sql);

                                            while($test = mysql_fetch_array($result))
                                            {
                                                $tipo_unidad = $test['nombre'];

                                                $id = $test['codigo'];

                                                if($id != $codigo_tipo_bien){
                                                    echo("<option value='". $id ."'>" . $tipo_unidad . "</option>");
                                                }else if($id == $codigo_tipo_bien){
                                                    echo("<option value='". $id ."'selected>" . $tipo_unidad . "</option>");
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>





                                <input type="hidden" name="codigo_get" value="<?php echo($_GET['id']); ?>"/>
                            </TABLE>
                            <br/>

                            <table>
                                <tr>
                                    <td>
                                        <input type="submit" value="Guardar" name="submit">
                                    </td>

                                    <td>
                                        <a href="./ver_mantenimiento.php"><input type="button" value="Atras"></a>
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