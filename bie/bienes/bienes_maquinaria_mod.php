<?php

require_once ('../../db.php');
include_once("../until/SubirFoto.php");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

?>


<?php

include_once('../../db.php');

if (isset($_POST['submit'])){

    print_r($_POST);


    include_once('../../clases/funciones.php');
    include_once('../../clases/Validate.php');

    $validation = array(

        array('nombre' => 'nombre_bien',
            'requerida' => true),

        array('nombre' => 'codigo_contable',
            'requerida' => true),

        array('nombre' => 'vida_util',
            'requerida' => true
        ),

        array('nombre' => 'costo_adquisicion',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','
        ),

        array('nombre' => 'valor_rescate',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','
        ),

        array('nombre' => 'monto_depreciar',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','
        ),

        array('nombre' => 'fecha_adquisicion',
            'requerida' => true,
            'regla' => 'fecha'),

        array('nombre' => 'metodo_depreciacion',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'valor_mercado',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','
        ),

        array('nombre' => 'valor_actualizado',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','
        ),

        array('nombre' => 'departamento_hi',
            'requerida' => true,
            'regla' => 'number',
            'tipo' => ','
        ),

        array('nombre' => 'unidades_producidas',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','
        ),

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){

        $nombre_bien = $_POST['nombre_bien'];
        $codigo_alias = $_POST['codigo'];
        $codigo_contable = $_POST['codigo_contable'];
        $departamento_hi = $_POST['departamento_hi'];
        $vida_util = $_POST['vida_util'];
        $fecha_adquisicion = $_POST['fecha_adquisicion'];
        $costo_adquisicion = $_POST['costo_adquisicion'];
        $valor_rescate = $_POST['valor_rescate'];
        $monto_depreciar = $_POST['monto_depreciar'];
        $metodo_depreciacion = $_POST['metodo_depreciacion'];
        $valor_mercado = $_POST['valor_mercado'];
        $valor_actualizado = $_POST['valor_actualizado'];
        $unidades_producidas = $_POST['unidades_producidas'];

        $codigo_bien = $_POST['codigo_bien'];


        $sql = "UPDATE bie_tipo_maquinaria SET nombre_bien = '$nombre_bien', codigo_alias = '$codigo_alias',
         codigo_contable = '$codigo_contable', codigo_departamento = '$departamento_hi', vida_util = '$vida_util',
          fecha_adquisicion = '$fecha_adquisicion' , costo_adquisicion = '$costo_adquisicion',
          valor_rescate = '$valor_rescate', monto_depreciar = '$monto_depreciar', valor_mercado = '$valor_mercado',
          valor_actualizado = '$valor_actualizado', unidades_producidas='$unidades_producidas' WHERE codigo = '$codigo_bien'";


        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        header("Location: ./bienes_maquinaria_mod?id=".$codigo_bien."&error=false");

        //send_error_redirect(false);
    }else{
        header("Location: ./bienes_maquinaria_mod?id=".$codigo_bien."&error=true");
    }




}


if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "SELECT bie_tipo_maquinaria.nombre_bien as nombre_bien, bie_tipo_maquinaria.codigo_alias codigo_alias,
    bie_tipo_maquinaria.codigo_contable as codigo_contable, mno_gerencia.descripcion as nombre_departamento,
    bie_tipo_maquinaria.codigo_departamento as codigo_departamento, bie_tipo_maquinaria.vida_util as vida_util,
    bie_tipo_maquinaria.fecha_adquisicion as fecha_adquisicion, bie_tipo_maquinaria.costo_adquisicion as costo_adquisicion,
    bie_tipo_maquinaria.valor_rescate as valor_rescate,  bie_tipo_maquinaria.codigo_depreciacion as codigo_depreciacion,
    bie_tipo_maquinaria.valor_mercado as valor_mercado, bie_tipo_maquinaria.valor_actualizado as valor_actualizado,
    bie_tipo_maquinaria.unidades_producidas as unidades_producidas
        FROM bie_tipo_maquinaria
        JOIN mno_gerencia
         ON bie_tipo_maquinaria.codigo_departamento = mno_gerencia.codigo
         WHERE bie_tipo_maquinaria.codigo ='$id'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result)or die('bie_tipo_maquinaria'.mysql_error());;

    $nombre_bien = $test['nombre_bien'];

    $codigo_alias = $test['codigo_alias'];
    $codigo_contable = $test['codigo_contable'];

    $nombre_departamento = $test['nombre_departamento'];
    $codigo_departamento = $test['codigo_departamento'];
    $vida_util = $test['vida_util'];
    $fecha_adquisicion = $test['fecha_adquisicion'];
    $costo_adquisicion = $test['costo_adquisicion'];
    $valor_rescate = $test['valor_rescate'];
    $codigo_depreciacion = $test['codigo_depreciacion'];
    $valor_mercado = $test['valor_mercado'];
    $valor_actualizado = $test['valor_actualizado'];
    $unidades_producidas = $test['unidades_producidas'];


}

?>


<!DOCTYPE html>
<html>
<head lang="es">
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <script>
        $(function(){
            $( '#datepicker1' ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( '#datepicker2' ).datepicker({ dateFormat: 'yy-mm-dd' });

            $('#datepicker1').val(<?php echo('"' . $fecha_adquisicion . '"'); ?>);
            $('#datepicker2').val(prettyDate);

        });
    </script>
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->
</head>
<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->
<form method="post" name="agregar_bienes" >
    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>--> <!-- Menu -->
            <!-- ?php include 'include/nav.php'; ?>-->
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
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">


                                <tr>
                                    <td><label>Nombre del Bien</label></td>
                                    <td><input type='text' name='nombre_bien' value="<?php echo($nombre_bien); ?>"/></td>
                                </tr>

                                <tr>
                                    <td><label>Código</label></td>
                                    <td><input type='text' name='codigo' name='codigo' value="<?php echo($codigo_alias); ?>"/></td>
                                </tr>

                                <tr>
                                    <td><label>Código Contable</label></td>
                                    <td><input type='text' name='codigo_contable' name='codigo_contable'  value="<?php echo($codigo_contable); ?>"/></td>
                                </tr>

                                <tr>
                                    <td><label>Departamento</label></td>
                                    <td><input type='text' name='departamento' value="<?php echo($nombre_departamento); ?>" disabled/></td>
                                    <td><input type='button' name='departamento_buscar' id='departamento_buscar' value='Buscar'/></td>
                                    <td><input type='hidden' name='departamento_hi' name='departamento_hi' value="<?php echo($codigo_departamento); ?>" /></td>
                                </tr>


                                <script>

                                    $( '#departamento_buscar' ).click(function() {
                                        var win = window.open('departamento_buscar.php', 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');
                                        win.focus();
                                    });

                                </script>



                                <tr>
                                    <td><label>Unidades Producidas</label></td>
                                    <td><input type='text' name='unidades_producidas' value="<?php echo($unidades_producidas); ?>"/></td>
                                </tr>


                                <tr>
                                    <td><label>Vida Útil (Años)</label></td>
                                    <td><input type='text' name='vida_util' value="<?php echo($vida_util); ?>"/></td>
                                </tr>


                                <tr>
                                    <td>
                                        <label >Fecha de Adquisición</label>
                                    </td>
                                    <td>
                                        <p>
                                            <input type='text' id='datepicker1' name='fecha_adquisicion' value="hola">
                                        </p>
                                    </td>
                                </tr>


                                <tr>
                                    <td><label>Costo de Adquisición</label></td>
                                    <td><input type='text' name='costo_adquisicion' value="<?php echo($costo_adquisicion); ?>"/></td>
                                </tr>



                                <tr>
                                    <td><label>Valor de Rescate</label></td>
                                    <td><input type='text' name='valor_rescate' value="<?php echo($valor_rescate); ?>"/></td>
                                </tr>


                                <tr>
                                    <td><label>Monto a depreciar</label></td>
                                    <td><input type='text' name='monto_depreciar' value="<?php echo($valor_rescate); ?>"/></td>
                                </tr>



                                <tr>
                                    <td><label>Metodo de Depreciacion</label></td>
                                    <td><select name='metodo_depreciacion'>

                                            <option value='1' <?php if($codigo_depreciacion == "1"){echo('selected="selected"');} ?>>Linea Recta</option>
                                            <option value='2' <?php if($codigo_depreciacion == "2"){echo('selected="selected"');} ?>>Unidades Producidas</option>
                                            <option value='3' <?php if($codigo_depreciacion == "3"){echo('selected="selected"');} ?>>Ktms. Recoridos</option>
                                            <option value='4' <?php if($codigo_depreciacion == "4"){echo('selected="selected"');} ?>>Digito Creciente</option>
                                            <option value='5' <?php if($codigo_depreciacion == "5"){echo('selected="selected"');} ?>>Digito Decreciente</option>
                                            <option value='6' <?php if($codigo_depreciacion == "6"){echo('selected="selected"');} ?>>% Fijo</option>

                                        </select><td>
                                </tr>



                                <tr>
                                    <td><label>Valor del Mercado</label></td>
                                    <td><input type='text' name='valor_mercado' value="<?php echo($valor_mercado); ?>"/></td>
                                </tr>


                                <tr>
                                    <td><label>Valor Actualizado</label></td>
                                    <td><input type='text' name='valor_actualizado' value="<?php echo($valor_actualizado); ?>"/></td>
                                </tr>

                                <input type='hidden' name='codigo_tipo' value='2'/>
                                <input type='hidden' name='codigo_bien' value='<?php echo($_GET['id']) ?>'/>

                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td>
                                        <input type="submit" value="Guardar datos" name="submit">
                                    </td>
                                    <td>
                                        <a href="./bienes_ver.php"><input type="button" value="Atras"></a>
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