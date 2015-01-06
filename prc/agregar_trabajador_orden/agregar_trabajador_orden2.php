<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 03/10/14
 * Time: 10:52 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');

if(isset($_POST['submit'])){

    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');


    $validation = array(

        array('nombre' => 'codigo_trabajador_hi',
            'requerida' => true),

        array('nombre' => 'bono_producido',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'pago_unidades',
            'requerida' => true,
            'regla' => 'number'),

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){

        $codigo_trabajador_hi;

        if(isset($_POST['codigo_trabajador_hi'])){
            $codigo_trabajador_hi = $_POST['codigo_trabajador_hi'];
        }

        if(isset($_GET['codigo_trabajador_hi'])){
            $codigo_trabajador_hi = $_GET['codigo_trabajador_hi'];
        }


        $horas = $_POST['horas'];
        $nombre_orden_hi = $_POST['nombre_orden_hi'];
        $codigo_etapa = $_POST['codigo_etapa_hi'];

        $bono_producido = $_POST['bono_producido'];
        $pago_unidades = $_POST['pago_unidades'];


        $sql = "INSERT INTO  prc_orden_trabajador(codigo_trabajador,codigo_orden_produccion,horas,
        codigo_etapa,bono_producido,pago_unidades)
      VALUES
        ('$codigo_trabajador_hi','$nombre_orden_hi','$horas','$codigo_etapa','$bono_producido','$pago_unidades')";


        mysql_query($sql) or die('error agregar trabajador a orden'.mysql_error());


        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.'nombre_orden_hi='.$nombre_orden_hi .'&error=false');

        die;

    }else if($validated->getIsError()){

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.'nombre_orden_hi='.$nombre_orden_hi .'&error=false');

        die;
    }



}




$nombre_orden_hi = 0;
if(isset($_POST['nombre_orden_hi'])){

    $nombre_orden_hi = $_POST['nombre_orden_hi'];

}
if(isset($_GET['nombre_orden_hi'])){

    $nombre_orden_hi = $_GET['nombre_orden_hi'];

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


            $("#buscar_etapa").click(function() {
                var win = window.open("buscar_etapa.php?orden=<?php echo($nombre_orden_hi); ?>", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });


            $("#buscar_trabajador").click(function() {
                var win = window.open("buscar_trabajador.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario" action="agregar_trabajador_orden2.php">

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Agregar Trabajador a Orden</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >



                                <tr>
                                    <td><label>Trabajador</label></td>
                                    <td>
                                        <input type="text" name="cedula_trabajador"  disabled>
                                        <input type="button" name="buscar_trabajador" id="buscar_trabajador" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="codigo_trabajador_hi" id="codigo_trabajador_hi"/>
                                </tr>



                                <tr>
                                    <td><label>Etapa</label></td>
                                    <td>
                                        <input type="text" name="etapa_campo"  disabled>
                                        <input type="button" name="buscar_etapa" id="buscar_etapa" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="codigo_etapa_hi" id="codigo_etapa_hi"/>
                                </tr>


                                <tr>
                                    <td><label>Horas</label></td>
                                    <td>
                                        <input type="text" name="horas"  >

                                    </td>
                                </tr>

                                <!-- leonel -->
                                <input type="hidden" name="nombre_orden_hi" value="<?php echo($nombre_orden_hi);?>"/>

                            </TABLE>
                            <br/>
                            <hr/>
                            <br/>
                            <table BORDER="0" CELLSPACING="10">

                                <tr>
                                    <td><label style="font-size: 16px"> Bono </label></td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Unidades Producidas</label>
                                    </td>

                                    <td>
                                        <input type="text" name="bono_producido" >
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <label> Pago por Unidades</label>
                                    </td>

                                    <td>
                                        <input type="text" name="pago_unidades"  >
                                    </td>
                                </tr>

                            </table>



                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="agregar_trabajador_orden.php"><input type="button" value="Atras"></a> </td>

                                </tr>
                            </table>

                            <br/>
                            <table border=none class="tablas-nuevas">

                                <tr id="tmp">
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Nombre Orden</th>
                                    <th>Horas</th>
                                    <th>Bono a Partir de</th>
                                    <th>Bono por Unidades</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <?php


                                    include("../../db.php");
                                    $result=mysql_query("SELECT
    prc_orden_trabajador.codigo as codigo,
    mrh_empleado.cedula as cedula,
    mrh_empleado.primernombre as nombre,
    mrh_empleado.primerapellido as apellido,
    prc_orden_trabajo.codigo_alias as nombre_orden,
    prc_orden_trabajador.horas as horas,
    prc_orden_trabajador.bono_producido as bono_producido,
    prc_orden_trabajador.pago_unidades as pago_unidades
FROM
    prc_orden_trabajador
        inner JOIN
    mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
        inner JOIN
    prc_orden_trabajo ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
WHERE
    prc_orden_trabajador.codigo_orden_produccion = '$nombre_orden_hi' AND prc_orden_trabajador.eliminado = 'no';");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];
                                        $cedula = $test['cedula'];
                                        $nombre =$test['nombre'];
                                        $apellido = $test['apellido'];
                                        $nombre_orden = $test['nombre_orden'];
                                        $horas = $test['horas'];
                                        $bono_producido = $test['bono_producido'];
                                        $pago_unidades = $test['pago_unidades'];



                                        echo "<tr align='center'>";
                                        echo"<td><font color='black'>". $cedula . "</font></td>";
                                        echo"<td><font color='black'>". $nombre. "</font></td>";
                                        echo"<td><font color='black'>". $apellido. "</font></td>";
                                        echo"<td><font color='black'>". $nombre_orden. "</font></td>";
                                        echo"<td><font color='black'>". $horas. "</font></td>";
                                        echo"<td><font color='black'>". $bono_producido. "</font></td>";
                                        echo"<td><font color='black'>". $pago_unidades. "</font></td>";



                                        echo"<td> <a href ='agregar_trabajador_orden_del.php?id=$id'>Borrar</a></td>";
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
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