<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/10/14
 * Time: 09:13 PM
 */



header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(


        array('nombre' => 'tipo_pago',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'periocidad',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'nombre',
            'requerida' => true
        ),

        array('nombre' => 'codigo_get',
            'requerida' => true
        )



    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $nombre = $_POST['nombre'];
        $fijo = 'no';
        if(isset($_POST['fijo'])){
            $fijo = 'si';
        }

        $periocidad = $_POST['periocidad'];

        $tipo_pago = $_POST['tipo_pago'];

        $valor = $_POST['valor'];

        $formula = str_replace(' ', '',$nombre);
        $formula = lcfirst($formula);

        $codigo_get = $_POST['codigo_get'];


        $sql = "UPDATE mno_new_bonos_produccion SET
                nombre = '$nombre',codigo_formula='$formula',valor='$valor',tipo_forma_pago='$tipo_pago',tipo_periocidad='$periocidad'
 WHERE codigo = '$codigo_get'" ;

        mysql_query($sql) or die('error actualizar mno_new_bonos_produccion  '.mysql_error());

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false');

        die;


    }else if($validated->getIsError()){


        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true');

        die;
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM mno_new_bonos_produccion WHERE codigo = '$id'";
    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $nombre = $test['nombre'];

    $tipo_concepto = $test['tipo_concepto'];
    $valor = $test['valor'];
    $tipo_forma_pago = $test['tipo_forma_pago'];
    $tipo_periocidad = $test['tipo_periocidad'];
    $fijo = $test['fijo'];
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nomina | Nuevo Bonos de Producción</strong></h1>
                            <br/>

                            <div>Nota: El nombre solo puede contener letras</div>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td>
                                        <label>Nombre</label>
                                    </td>
                                    <td>
                                        <input id="nombre" name="nombre" type="text" value="<?php echo($nombre); ?>"/>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Fijo?</label>
                                    </td>
                                    <td>
                                        <input id="fijo" name="fijo" type="checkbox" <?php if($fijo == 'si'){echo('checked');} ?>/>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Periocidad</label>
                                    </td>
                                    <td>
                                        <select name="periocidad" id="periocidad">
                                            <option value="0" <?php if($tipo_periocidad == '0'){echo("selected");}?>>Mes</option>
                                            <option value="1" <?php if($tipo_periocidad == '1'){echo("selected");}?>>Quinceal</option>
                                            <option value="2" <?php if($tipo_periocidad == '2'){echo("selected");}?>>Mensual</option>
                                            <option value="3" <?php if($tipo_periocidad == '3'){echo("selected");}?>>Bimestral</option>
                                            <option value="4" <?php if($tipo_periocidad == '4'){echo("selected");}?>>Trimestral</option>
                                            <option value="5" <?php if($tipo_periocidad == '5'){echo("selected");}?>>Cuatrmestral</option>
                                            <option value="6" <?php if($tipo_periocidad == '6'){echo("selected");}?>>Semestral</option>
                                            <option value="7" <?php if($tipo_periocidad == '7'){echo("selected");}?>>Anual</option>
                                        </select>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <label>Forma de Pago</label>
                                    </td>
                                    <td>
                                        <select name="tipo_pago" id="tipo_pago">
                                            <option value="0" <?php if($tipo_forma_pago == '0'){echo("selected");}?>>Monto Fijo</option>
                                            <option value="1" <?php if($tipo_forma_pago == '1'){echo("selected");}?>>% Salario Base</option>
                                            <option value="2" <?php if($tipo_forma_pago == '2'){echo("selected");}?>>% Salario Normal</option>
                                            <option value="3" <?php if($tipo_forma_pago == '3'){echo("selected");}?>>% Salario Integral</option>
                                            <option value="4" <?php if($tipo_forma_pago == '4'){echo("selected");}?>>Unidad Tributaria</option>
                                        </select>
                                    </td>
                                </tr>


                                <input type="hidden" name="codigo_get" value="<?php echo($id); ?>"/>



                                <tr>
                                    <td>
                                        <label>Valor</label>
                                    </td>
                                    <td>
                                        <input id="valor" name="valor" type="text" value="<?php echo($valor); ?>"/>
                                    </td>
                                </tr>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="./bono_produccion_ver.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="../../mno_menu.html"><input type="button" value="Atras"></a> </td>

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