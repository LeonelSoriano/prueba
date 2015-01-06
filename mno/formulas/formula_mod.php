<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 28/09/14
 * Time: 03:18 PM
 */



header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){



    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'formula',
            'requerida' => true
        ),

        array('nombre' => 'nombre',
            'requerida' => true
        ),



    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $nombre = $_POST['nombre'];
        $formula = $_POST['formula'];
        $codigo_get = $_POST['codigo_get'];




        $sql = "UPDATE  mno_new_formulas SET
             nombre = '$nombre',formula='$formula'
          WHERE codigo = '$codigo_get'";

        mysql_query($sql) or die('error actualizar formula  '.mysql_error());



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

    $sql = "SELECT *FROM mno_new_formulas WHERE codigo='$id' ";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $nombre = $test['nombre'];
    $formula = $test['formula'];
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



</head>


<body class="flickr-com">

<?php

if(isset($_GET['msg'])){
    print rawurldecode($_GET['msg']);
}

?>

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Formulas</strong></h1>
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
                                        <label>Formula</label>
                                    </td>
                                    <td>
                                        <input  name="formula" type="text" value="<?php echo($formula); ?>"/>
                                    </td>
                                </tr>
                                <input type="hidden" name="codigo_get" value="<?php echo($id); ?>"/>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="formula_ver.php"><input type="button" value="Ver datos"></a> </td>
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