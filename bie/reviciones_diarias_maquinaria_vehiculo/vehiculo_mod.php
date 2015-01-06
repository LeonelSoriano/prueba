<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
require_once('../../db.php');



if(isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'kilometros',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'codigo_bien_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'agua',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'frenos',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'aceite',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'filtro',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'cauchos',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'codigo_get',
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){


        $codigo_get = $_POST['codigo_get'];


        $kilometros = $_POST['kilometros'];
        $observacion = $_POST['observacion'];
        $codigo_bien_hi = $_POST['codigo_bien_hi'];
        $caucho = $_POST['cauchos'];
        $filtro = $_POST['filtro'];
        $aceite = $_POST['aceite'];
        $agua = $_POST['agua'];
        $frenos = $_POST['frenos'];
        $fecha_actual = fecha_sicap();



        $sql = "SELECT kilometros FROM bie_tipo_vehiculo WHERE codigo = '$codigo_bien_hi'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $kilometros_anteror = $test['kilometros'];

        $nuevos_kilometros =$kilometros - $kilometros_anteror ;


        $sql = "UPDATE  bie_revicion_diaria_vhiculo SET
          cod_vehiculo ='$codigo_bien_hi' ,agua ='$agua' ,aceite ='$aceite' ,filtro ='$filtro' ,caucho ='$caucho' ,frenos ='$frenos' ,observacion ='$observacion' ,kilometros ='$nuevos_kilometros'
          WHERE codigo = $codigo_get";


        mysql_query($sql) or die('error agregar revicion de vehiculo'.mysql_error());


        $sql = "UPDATE bie_tipo_vehiculo SET kilometros = '$kilometros' WHERE codigo = '$codigo_bien_hi'";

        mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());

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

    $sql = "SELECT
bie_revicion_diaria_vhiculo.cod_vehiculo as codigo_vehiculo,
bie_tipo_vehiculo.nombre_bien as nombre_vehiculo,
bie_tipo_vehiculo.placa_vehculo as placa_vehiculo,
bie_revicion_diaria_vhiculo.agua as agua,
bie_revicion_diaria_vhiculo.aceite as aceite,
bie_revicion_diaria_vhiculo.filtro as filtro,
bie_revicion_diaria_vhiculo.caucho as caucho,
bie_revicion_diaria_vhiculo.frenos as frenos,
bie_revicion_diaria_vhiculo.observacion as observaciones,
bie_revicion_diaria_vhiculo.kilometros as kilometros
FROM bie_revicion_diaria_vhiculo
INNER JOIN bie_tipo_vehiculo
ON bie_tipo_vehiculo.codigo = bie_revicion_diaria_vhiculo.cod_vehiculo
WHERE bie_revicion_diaria_vhiculo.codigo='$id'";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $codigo_vehiculo = $test['codigo_vehiculo'];
    $nombre_vehiculo = $test['nombre_vehiculo'];
    $placa_vehiculo = $test['placa_vehiculo'];
    $agua = $test['agua'];
    $aceite = $test['aceite'];
    $filtro = $test['filtro'];
    $caucho = $test['caucho'];
    $frenos = $test['frenos'];
    $observaciones = $test['observaciones'];
    $kilometros = $test['kilometros'];


}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>

    <script type="text/javascript">

        $(function() {

            $("#buscar_vehiculo").click(function() {
                var win = window.open("buscar_vehiculo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" >

                <div id="header">
                </div>

                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td><label>Vehículo</label></td>
                                    <td>
                                        <input type="text" name="nombre_vehiculo"  disabled value="<?php echo($nombre_vehiculo);?>">
                                        <input type="text" name="placa_vehiculo"  disabled size="10" value="<?php echo($placa_vehiculo);?>">
                                        <input type="button" name="buscar_vehiculo" id="buscar_vehiculo" value="Buscar" />

                                    </td>
                                    <input type="hidden" name="codigo_bien_hi" id="codigo_bien_hi" value="<?php echo($codigo_vehiculo);?>"/>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Agua</label>
                                    </td>
                                    <td>
                                        <select name="agua" id="agua">
                                            <option value="1" <?php if($agua == "1"){echo('selected="selected"');} ?>>Bien</option>
                                            <option value="2" <?php if($agua == "2"){echo('selected="selected"');} ?>>Regular</option>
                                            <option value="3" <?php if($agua == "3"){echo('selected="selected"');} ?>>Revisión</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Aceite</label>
                                    </td>
                                    <td>
                                        <select name="aceite" id="aceite">
                                            <option value="1" <?php if($aceite == "1"){echo('selected="selected"');} ?>>Bien</option>
                                            <option value="2" <?php if($aceite == "2"){echo('selected="selected"');} ?>>Regular</option>
                                            <option value="3" <?php if($aceite == "3"){echo('selected="selected"');} ?>>Revisión</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Filtro</label>
                                    </td>
                                    <td>
                                        <select name="filtro" id="filtro">
                                            <option value="1" <?php if($filtro == "1"){echo('selected="selected"');} ?>>Bien</option>
                                            <option value="2" <?php if($filtro == "2"){echo('selected="selected"');} ?>>Regular</option>
                                            <option value="3" <?php if($filtro == "3"){echo('selected="selected"');} ?>>Revisión</option>
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <label>Cauchos</label>
                                    </td>
                                    <td>
                                        <select name="cauchos" id="cauchos">
                                            <option value="1" <?php if($caucho == "1"){echo('selected="selected"');} ?>>Bien</option>
                                            <option value="2" <?php if($caucho == "2"){echo('selected="selected"');} ?>>Regular</option>
                                            <option value="3" <?php if($caucho == "3"){echo('selected="selected"');} ?>>Revisión</option>
                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <label>Frenos</label>
                                    </td>
                                    <td>
                                        <select name="frenos" id="frenos">
                                            <option value="1" <?php if($frenos == "1"){echo('selected="selected"');} ?>>Bien</option>
                                            <option value="2" <?php if($frenos == "2"){echo('selected="selected"');} ?>>Regular</option>
                                            <option value="3" <?php if($frenos == "3"){echo('selected="selected"');} ?>>Revisión</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Kilometros</label>
                                    </td>
                                    <td>
                                        <input id="kilometros" name="kilometros" type="text" value="<?php echo($kilometros); ?>"/>
                                    </td>
                                </tr>


                                <tr>
                                    <td><label > Observación </label></td>
                                    <td>
                                        <textarea name="observacion" id="observacion" cols="25" rows="8"><?php echo($observaciones); ?></textarea>

                                    </td>
                                </tr>


                                <!-- leonel -->

                                <input type="hidden" name="codigo_get" value="<?php echo($id); ?>"/>
                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="vehiculo_ver.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="../../bie_menu.php"><input type="button" value="Atras"></a> </td>

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