<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){

    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'codigo_bien_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'codigo_bien_tipo_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'codigo_mantenimiento_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'numero_factura',
            'requerida' => true,
        ),

        array('nombre' => 'costo',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'medida_especial',
            'requerida' => false,
            'regla' => 'number'),

        array('nombre' => 'codigo_get',
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $codigo_bien_hi = $_POST['codigo_bien_hi'];
        $codigo_bien_tipo_hi = $_POST['codigo_bien_tipo_hi'];
        $codigo_mantenimiento_hi = $_POST['codigo_mantenimiento_hi'];
        $codigo_contable = $_POST['codigo_contable'];
        $numero_factura = $_POST['numero_factura'];
        $costo = $_POST['costo'];
        $codigo_get = $_POST['codigo_get'];

        $medida_especial = '';

        if(isset($_POST['medida_especial'])){
            $medida_especial = $_POST['medida_especial'];
        }


        $sql = "UPDATE bie_realizar_mantenimiento SET codigo_bien='$codigo_bien_hi',
                codigo_bien_tipo = '$codigo_bien_hi',codigo_mantenimiento='$codigo_mantenimiento_hi',
                codigo_contable = '$codigo_contable',numero_factura='$numero_factura',
                costo = '$costo',medida_especial = '$medida_especial'
            WHERE codigo='$codigo_get'";



        mysql_query($sql) or die('problemas al agregar be_realizar_mantenimiento  '.mysql_error());


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
bie_realizar_mantenimiento.codigo as codigo,
bie_tipo.nombre_bien as nombre_bien,
bie_tipo_bien.nombre as nombre_tipo,
bie_realizar_mantenimiento.codigo_bien_tipo as codigo_tipo,
bie_realizar_mantenimiento.codigo_contable as codigo_contable,
bie_realizar_mantenimiento.numero_factura as numero_factura,
bie_realizar_mantenimiento.costo as costo,
bie_realizar_mantenimiento.medida_especial as medida_especial,
bie_realizar_mantenimiento.codigo_bien_tipo as tipo_bien,
bie_realizar_mantenimiento.codigo_mantenimiento as codigo_mantenimiento,
bie_realizar_mantenimiento.codigo_bien as codigo_bien,
bie_mantenimiento.nombre as nombre_mantenimiento
FROM bie_realizar_mantenimiento
INNER JOIN bie_tipo_bien
ON bie_tipo_bien.codigo = bie_realizar_mantenimiento.codigo_bien_tipo
INNER JOIN (
SELECT bie_tipo_activo_principal.tipo as tipo,bie_tipo_activo_principal.codigo,bie_tipo_activo_principal.nombre_bien FROM bie_tipo_activo_principal

union
SELECT bie_tipo_vehiculo.tipo as tipo,bie_tipo_vehiculo.codigo,bie_tipo_vehiculo.nombre_bien FROM bie_tipo_vehiculo

union
SELECT bie_tipo_basico.tipo as tipo,bie_tipo_basico.codigo,bie_tipo_basico.nombre_bien FROM bie_tipo_basico

union
SELECT bie_tipo_maquinaria.tipo as tipo,bie_tipo_maquinaria.codigo,bie_tipo_maquinaria.nombre_bien FROM bie_tipo_maquinaria

)as bie_tipo
on bie_tipo.codigo = bie_realizar_mantenimiento.codigo_bien AND bie_tipo.tipo = bie_realizar_mantenimiento.codigo_bien_tipo
INNER JOIN bie_mantenimiento
ON bie_mantenimiento.codigo = bie_realizar_mantenimiento.codigo_mantenimiento
WHERE bie_realizar_mantenimiento.eliminado = 'n' AND bie_realizar_mantenimiento.codigo = '$id'";


    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $codigo = $test['codigo'];
    $nombre_bien = $test['nombre_bien'];
    $nombre_tipo = $test['nombre_tipo'];
    $codigo_contable = $test['codigo_contable'];
    $numero_factura = $test['numero_factura'];
    $costo = $test['costo'];
    $medida_especial = $test['medida_especial'];
    $tipo_bien = $test['tipo_bien'];
    $codigo_mantenimiento = $test['codigo_mantenimiento'];
    $codigo_bien = $test['codigo_bien'];
    $nombre_mantenimiento = $test['nombre_mantenimiento'];
    $codigo_tipo = $test['codigo_tipo'];

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


            var codigo_tipo;

            $("#buscar_bien").click(function() {

                var win = window.open("buscar_bien.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

            $("#buscar_mantenimiento").click(function() {
                codigo_tipo = $("#codigo_bien_tipo_hi").val();
                var win = window.open("buscar_mantenimiento.php?id="+codigo_tipo, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario">

    <div id="body_bottom_bgd">
        <div id="">
            <div align="justify" id="right_col" >

                <div id="header">
                </div>

                <div id="">
                    <div id="firefoxbug">

                        <div class="dynamicContent" align="left">


                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes | Realizar Mantenimiento</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td><label>Nombre Bien</label></td>
                                    <td>
                                        <input type="text" name="nombre_bien"  disabled value="<?php echo($nombre_bien) ?>">
                                        <input type="button" name="buscar_bien" id="buscar_bien" value="Buscar"/>
                                        <input type="hidden" name="codigo_bien_hi" id="codigo_bien_hi" value="<?php echo($codigo_bien) ?>"/>
                                        <input type="hidden" name="codigo_bien_tipo_hi" id="codigo_bien_tipo_hi" value="<?php echo($codigo_tipo) ?>"/>
                                    </td>

                                </tr>

                                <tr>
                                    <td><label>Nombre Mantenimiento</label></td>
                                    <td>
                                        <input type="text" name="nombre_mantenimiento" disabled  value="<?php echo($nombre_mantenimiento) ?>">
                                        <input type="button" name="buscar_mantenimiento" id="buscar_mantenimiento" value="Buscar"/>
                                    </td>
                                    <input type="hidden" name="codigo_mantenimiento_hi" value="<?php echo($codigo_mantenimiento) ?>"/>
                                </tr>


                                <tr>
                                    <td>
                                        <label>Código Contable</label>
                                    </td>
                                    <td>
                                        <input name="codigo_contable"  type="text" value="<?php echo($codigo_contable);?>"/>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <label>Número Factura</label>
                                    </td>
                                    <td>
                                        <input name="numero_factura"  type="text" value="<?php echo($numero_factura); ?>"/>
                                    </td>
                                </tr>


                                <tr id="medida_campo"  >

                                    <?php

                                      if($codigo_tipo == '2'){
                                          echo('<td><label>Unidades</label></td><td><input type="text" name="medida_especial" value="'.$medida_especial.'"/></td>');
                                      } else if($codigo_tipo == '3'){
                                          echo('<td><label>Kilometros</label></td><td><input type="text" name="medida_especial" value="'.$medida_especial.'"/></td>');

                                      }

                                    ?>

                                </tr>


                                <tr>
                                    <td><label >Costo</label></td>
                                    <td><input name="costo" type="text" value="<?php echo($costo); ?>" /></td>
                                </tr>

                                <!-- leonel -->
                                <input type="hidden" name="codigo_get" value="<?php echo($id); ?>"/>

                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="ver_realizar_mantenimiento.php"><input type="button" value="Ver datos"></a> </td>
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