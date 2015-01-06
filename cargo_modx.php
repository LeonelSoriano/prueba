<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php

require("db.php");
$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mrh_cargo WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
    {
        die("Error: Data not found..");
    }
             
        $codigoalias=$test['codigoalias'];
        $descripcion=$test['descripcion'];
        $tipo_cargo = $test['tipo_cargo'];
        $tipo_cargo_opcion = $test['tipo_cargo_opcion'];

                
if(isset($_POST['submit']))
{

    include_once("./clases/funciones.php");
    include_once("./clases/Validate.php");



    $validation = array(

        array('nombre' => 'codigoalias',
            'requerida' => true,
        ),

        array('nombre' => 'descripcion',
            'requerida' => true,
        ),


    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){


        $codigoalias=$_POST['codigoalias'];
        $descripcion=$_POST['descripcion'];
        $tipo_cargo =$_POST['tipo_cargo'];
        $tipo_cargo_opcion=$_POST['tipo_cargo_opcion'];

        $sql = "update mrh_cargo set codigoalias='$codigoalias',descripcion='$descripcion',
            tipo_cargo = '$tipo_cargo',tipo_cargo_opcion='$tipo_cargo_opcion'
             where codigo = '$id'";

        //echo $sql;
        //exit;
        mysql_query($sql)

        or die(mysql_error());

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');

        die;


    }else if($validated->getIsError()){

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;
    }



}
mysql_close($conn);
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.10.4.custom.js"></script>   

<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />



    <script src="./js/jquery-1.10.2.js"></script>
    <!-- / END -->

    <script type="text/javascript">

        $(function() {

            $('#tipo_cargo').bind('change',function() {

                var tipo_cargo = $('#tipo_cargo').val();

                if (tipo_cargo == "produccion") {

                    $("#tipo_cargo_opcion").html(" <option value='directa'>Directa</option> <option >Indirecta</option>");
                } else if(tipo_cargo == "operativo"){
                    $("#tipo_cargo_opcion").html(" <option value='administracion'>Administración</option> <option >Venta</option>");

                }


            });



        });


    </script>
    


<!-- Beginning of compulsory code below -->

<link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>
$layout->get_header();

<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>

<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Empleados</h1>-->

<!-- Beginning of compulsory code below -->
<form method="post">
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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Cargo</strong></h1>
                                    <br/>

                                    <?php

                                    if(isset($_GET['msg'])){
                                        $error =  $_GET['error'];

                                        $msg = $_GET['msg'];

                                        if($error == 'true'){
                                            echo('<div id="error_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');
                                        }else if($error == 'false'){
                                            echo('<div id="done_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');

                                        }

                                    }

                                    ?>

                                    <br/>
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

     <TR>
          <TD><label>Código</label></TD>
          <TD><p><input type="text" name="codigoalias" id="codigoalias" size="20" value="<?php echo $codigoalias?>"></p></TD>
     </TR> 
    <TR>
          <TD><label>Descripción</label></TD>
          <TD><p><input type="text" name="descripcion" id="descripcion" size="20" value="<?php echo $descripcion?>"></p></TD>
     </TR>
    <TR>
        <TD><label >Tipo Cargo</label></TD>
        <?php echo($tipo_cargo ); ?>
        <td>
            <select id="tipo_cargo" style="height: 21px" name="tipo_cargo" id="">
                <option value="produccion" <?php if($tipo_cargo == 'produccion'){echo("selected");} ?>>Producción</option>
                <option value="operativo" <?php if($tipo_cargo == 'operativo'){echo("selected");} ?>>Operativo</option>
            </select>
        </td>

    </TR>
    <tr>
        <td></td>
        <td>
            <select style="height: 21px" name="tipo_cargo_opcion" id="tipo_cargo_opcion">
                <?php

                if($tipo_cargo == 'produccion'){
                    if($tipo_cargo_opcion == 'directa'){
                        echo("<option value='directa' selected>Directa</option> <option value='indirecta'>Indirecta</option>");
                    }else{
                        echo("<option value='directa'>Directa</option> <option value='indirecta' selected>Indirecta</option>");
                    }

                }else{
                    if($tipo_cargo_opcion == 'administrativo'){
                        echo("<option value='directa'  selected>Directa</option> <option value='indirecta'>Indirecta</option>");
                    }else{
                        echo("<option value='produccion' selected>Directa </option> <option value='indirecta' selected>Indirecta</option>");
                    }

                }

                ?>
            </select>
        </td>



    </tr>

</TABLE>


<input type="submit" name="submit" value="Guardar datos" >
<a href="cargo_ver.php"><input type="button" value="Ver datos"></a> 

<!-- / END -->
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



</form>
</body>
</html>
