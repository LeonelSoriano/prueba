<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once ('../../db.php');
require_once ('../../clases/funciones.php');


    $id = 0;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else if($_POST['id'])

    if (isset($_POST['id'])){
        $id = $_POST['id'];

    }


    if(isset($_POST['submit'])){

        require_once('../../clases/Validate.php');


        $validation = array(

            array('nombre' => 'metros',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number'),

        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();

        if(!$validated->getIsError()){
            $metros_post = $_POST['metros'];
            $departamento = $_POST['departamento_hi'];

            //TODO hacer q esto de señales q no agrega si ya existe
            $sql = "SELECT COUNT(*) AS cuenta FROM bien_metros_departamento
                WHERE
                codigo_departamento ='$departamento' AND codigo_tipo_activo_principal='$id'";


            $result=mysql_query($sql);
            $test = mysql_fetch_array($result);
            $cuenta =  $test['cuenta'];


            if($cuenta == '0'){

                $sql = "INSERT INTO bien_metros_departamento(codigo_departamento,codigo_tipo_activo_principal,metros)
                    VALUES('$departamento','$id','$metros_post')";

                mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
            }else{

                send_error_redirect(true, "Ya has Asignado Todos Los Metros");
                die;
            }

        }//VAlidate->getiserror

    }


    $sql = "SELECT * FROM bie_tipo_activo_principal WHERE codigo='$id' ";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);

    $metros_edificarcion = $test['mts_edificacion'];
    $metros_edificarcion =str_replace(',','.',$metros_edificarcion);


    $sql = "SELECT SUM(metros) AS suma FROM bien_metros_departamento WHERE codigo_tipo_activo_principal='$id' AND eliminado='n'";

    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);
    $suma_metros = $test['suma'];

    $suma_metros =str_replace(',','.',$suma_metros);


    $metros_usados = $metros_edificarcion - $suma_metros;


    $metros_style = 0;//significa q es cero y sera negro en la muestra
    if($metros_usados > 0){
        $metros_style = 1;//que ser verde porq le faltan
    }else if($metros_usados < 0){
        $metros_style = 2;//que sera rojo porq estan mal de los dsatos esta usando mas
    }


    $metros_usados = str_replace('.',';',$metros_usados);




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

    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>


    <script type="text/javascript">
        $(function(){

            $( '#departamento_buscar' ).click(function() {
                var win = window.open('departamento_buscar.php', 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');
                win.focus();
            });

        });
    </script>


</head>


<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post"  name="agregar_bienes">

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
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="380">

                                <tr>
                                    <td><label>Departamento</label></td>
                                    <td><input type='text' name='departamento' disabled/></td>
                                    <td><input type='button' name='departamento_buscar' id='departamento_buscar' value='Buscar'/></td>
                                    <td><input type='hidden' name='departamento_hi' name='departamento_hi'/></td>
                                </tr>
                                <tr></tr><tr></tr>

                                <tr>
                                    <td><label>Metros</label></td>
                                    <td><input type='text' name='metros' /></td>
                                </tr>

                                <input type="hidden" name="id" value="<?php echo($id) ?>"/>

                                <tr></tr><tr></tr>
                                <table>
                                    <tr>
                                        <td><input type="submit" value="Guardar departamento" name="submit"></td>
                                        <td><a href="../../bie_menu.php"><input type="button" value="Atras"></a> </td>

                                    </tr>
                                </table>

                            </TABLE>

                            <br/><br/>
                            <div <?php if($metros_style == 2){echo('style="color: red"');}else if($metros_style == 1){echo('style="color: green"');} ?>>Metros<sup>2</sup> sin Asignar: <span ><?php echo($metros_usados)?></span></div>
                            <br/>


                            <table border=none class="tablas-nuevas" style="text-align: center">

                                <tr >
                                    <th >Departamento</th>
                                    <th>Metros<sup>2</sup> </th>
                                    <th>Eliminar</th>

                                </tr>


                                <?php

                                    $sql = "SELECT mno_gerencia.descripcion as nombre_departamento,
                                        bien_metros_departamento.metros as metros,bien_metros_departamento.codigo as codigo_principal
                                        FROM
                                         bien_metros_departamento INNER JOIN mno_gerencia
                                                ON bien_metros_departamento.codigo_departamento=mno_gerencia.codigo
                                         WHERE
                                          codigo_tipo_activo_principal='$id' AND eliminado='n';";

                                    $result=mysql_query($sql);

                                    while($test = mysql_fetch_array($result)){

                                        $codigo_consulta = $test['codigo_principal'];
                                        $nombre_departamento = $test['nombre_departamento'];
                                        $metros = $test['metros'];

                                        echo "<tr align='center'>";

                                        echo"<td><font color='black'>". $nombre_departamento. "</font></td>";
                                        echo"<td><font color='black'>". $metros. "</font></td>";

                                        echo"<td> <a href='./eliminar_departamento.php?id=$id&codigo=$codigo_consulta'>Eliminar</a> </td>";
                                        echo "</tr>";
                                    }


                                ?>

                            </table>


                            <br/><br/>

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
