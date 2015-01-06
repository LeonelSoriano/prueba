<?php
/**
INSERT INTO prueba (codigo_alias,descripcion,correo,direccion,telefono,rif)
SELECT codigo_alias,descripcion,correo,direccion,telefono,rif
FROM min_empresa


INSERT INTO table2 (st_id,uid,changed,status,assign_status)
SELECT st_id,from_uid,now(),'Pending','Assigned'
FROM table1
 */



require_once ('../../db.php');
require_once('../../clases/funciones.php');
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


//if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
//{
//    /// do your magic
//
//    $_SESSION['error'] = "Thanks for your message!";
//
//    $myurl = "backup_mensual.php";
//
//    header("Location: $myurl");
//    header("HTTP/1.1 303 See Other");
//    die("redirecting");
//}
//
//if ( isset($_SESSION['error']) )
//{
//    print "The result of your submission: ".$_SESSION['error'];
//    unset($_SESSION['error']);
//}




$sql = "SELECT * FROM mco_backup_mensual WHERE ultimo='s'";

$result = mysql_query($sql);

$test = mysql_fetch_array($result);

if (!$result)
{
    die("Error: Data not found.. de unudades");
}

$id_ultimo = $test['codigo'];

$mes_ultimo = $test['mes'];

$ano_ultimo = $test['ano'];


$ano_actual = date('o');
$mes_actual = date('n');


function respaldo_valoracion(){

    $sql = "SELECT * FROM min_valoracion";

    $result=mysql_query($sql);

    $fecha_respaldo = fecha_sicap();

    while($test = mysql_fetch_array($result)){
        $codigo_producto = $test['codigo_producto'];
        $unidades = $test['unidades'];
        $costo_total = $test['costo_total'];
        $promedio_actual = $test['promedio_actual'];

        $sql2 = "INSERT INTO min_valoracion_backup
        (codigo_producto,
        unidades,
        costo_total,
        promedio_actual,fecha)
        VALUES
        ($codigo_producto,
        '$unidades',
        '$costo_total',
        '$promedio_actual','$fecha_respaldo');
        ";

        mysql_query($sql2) or die('no se pudo guardar min_valoracion_backup'.mysql_error());
    }

}


function resplado_bienes(){

    $sql = "SELECT * FROM bie_tipo_basico";

    $result=mysql_query($sql);

    $fecha_respaldo = fecha_sicap();

    while($test = mysql_fetch_array($result)){
        $codigo = $test['codigo'];
        $nombre_bien = $test['nombre_bien'];
        $codigo_alias = $test['codigo_alias'];
        $codigo_contable =  $test['codigo_contable'];
        $codigo_departamento =  $test['codigo_departamento'];
        $vida_util =  $test['vida_util'];
        $fecha_adquisicion = $test['fecha_adquisicion'];
        $costo_adquisicion =  $test['costo_adquisicion'];
        $valor_rescate = $test['valor_rescate'];
        $monto_depreciar = $test['monto_depreciar'];
        $codigo_depreciacion = $test['codigo_depreciacion'];
        $valor_mercado = $test['valor_mercado'];
        $valor_actualizado = $test['valor_actualizado'];
        $eliminado = $test['eliminado'];
        $tipo = $test['tipo'];

        $sql2 = "INSERT INTO bie_backup_bienes
(codigo,
nombre_bien,
codigo_alias,
codigo_contable,
codigo_departamento,
vida_util,
fecha_adquisicion,
costo_adquisicion,
valor_rescate,
monto_depreciar,
codigo_depreciacion,
valor_mercado,
valor_actualizado,
eliminado,
tipo,
fecha_backup)
VALUES
($codigo ,
'$nombre_bien' ,
$codigo_alias ,
$codigo_contable ,
$codigo_departamento ,
'$vida_util' ,
'$fecha_adquisicion' ,
'$costo_adquisicion' ,
'$valor_rescate' ,
'$monto_depreciar' ,
$codigo_depreciacion ,
'$valor_mercado' ,
'$valor_actualizado' ,
'$eliminado',
'$tipo' ,
$fecha_respaldo );
";

        mysql_query($sql2) or die('no se pudo guardar bie_backup_bienes'.mysql_error());
    }


}


function respaldo_empleados()
{
    $sql = "SELECT * FROM mrh_empleado";

    $result=mysql_query($sql);

    $fecha_respaldo = fecha_sicap();


    while($test = mysql_fetch_array($result)){


        $codigo = $test['codigo'];
        $cedula = $test['cedula'];
        $ficha = $test['ficha'];
        $primernombre = $test['primernombre'];
        $segundonombre = $test['segundonombre'];
        $primerapellido = $test['primerapellido'];
        $segundoapellido = $test['segundoapellido'];
        $fechanacimiento = $test['fechanacimiento'];
        $telefono = $test['telefono'];
        $celular = $test['celular'];
        $estadocivil = $test['estadocivil'];
        $becado = $test['becado'];
        $sexo = $test['sexo'];
        $fechaingreso = $test['fechaingreso'];
        $fechaegreso = $test['fechaegreso'];
        $codigocargo = $test['codigocargo'];
        $estatus = $test['estatus'];
        $condicion = $test['condicion'];
        $codigoperioricidad = $test['codigoperioricidad'];
        $direccionhabitacion = $test['direccionhabitacion'];
        $codigo_departamento = $test['codigo_departamento'];
        $retirado = $test['retirado'];
        $vehiculo = $test['vehiculo'];
        $tipo_trabajador = $test['tipo_trabajador'];
        $foto = $test['foto'];
        $nacionalidad = $test['nacionalidad'];


        $sql2 = "INSERT INTO mrh_empleado_backup
(
cedula,
ficha,
primernombre,
segundonombre,
primerapellido,
segundoapellido,
fechanacimiento,
telefono,
celular,
estadocivil,
becado,
sexo,
fechaingreso,
fechaegreso,
codigocargo,
estatus,
condicion,
codigoperioricidad,
direccionhabitacion,
codigo_departamento,
retirado,
vehiculo,
tipo_trabajador,
foto,
nacionalidad,
codigo_empleado,
fecha)
VALUES
(
'$cedula' ,
'$ficha' ,
'$primernombre' ,
'$segundonombre' ,
'$primerapellido' ,
'$segundoapellido' ,
'$fechanacimiento' ,
'$telefono' ,
'$celular' ,
'$estadocivil' ,
'$becado' ,
'$sexo' ,
'$fechaingreso' ,
'$fechaegreso' ,
'$codigocargo' ,
'$estatus' ,
'$condicion' ,
'$codigoperioricidad' ,
'$direccionhabitacion' ,
'$codigo_departamento' ,
'$retirado' ,
'$vehiculo' ,
'$tipo_trabajador' ,
'$foto',
'$nacionalidad' ,
'$codigo' ,
'$fecha_respaldo');
";
        mysql_query($sql2) or die('no se pudo guardar min_valoracion_backup'.mysql_error());
    }
}


function guardar($mes_actual,$ano_actual,$id_ultimo){

    $fecha_completa_respaldo = fecha_sicap();

    $sql = "UPDATE mco_backup_mensual SET ultimo='n' WHERE codigo = '$id_ultimo'";

    mysql_query($sql) or die('No se pudo actlizar la información de la ultima fecha. '.mysql_error());


    $sql = "INSERT INTO mco_backup_mensual(mes,ano,respaldo_fecha,ultimo)
             VALUES('$mes_actual','$ano_actual','$fecha_completa_respaldo','s')";

    mysql_query($sql) or die('No se pudo actlizar la fecha del nuevo respaldo. '.mysql_error());


}


if (isset($_POST['submit'])){


    if($ano_ultimo == $ano_actual){

        if($mes_actual > $mes_ultimo){
            guardar($mes_actual,$ano_actual,$id_ultimo);
            respaldo_valoracion();
            respaldo_empleados();

        }
    }else if($ano_ultimo <  $ano_actual){

        guardar($mes_actual,$ano_actual,$id_ultimo);
        respaldo_valoracion();
        respaldo_empleados();

    }



    $myurl = "backup_mensual.php";

    header("Location: $myurl");
    header("HTTP/1.1 303 See Other");



    /*TODO agregar la opcion al crear la empresa del primer backup la fecha y eso*/

//echo('<div id="done_app"><marquee scrolldelay="100">Datos Guardados Correctamente</marquee></div>');

}

//cuando carga la pagina


$sql = "SELECT * FROM mco_backup_mensual WHERE ultimo='s'";

$result = mysql_query($sql);

$test = mysql_fetch_array($result);

if (!$result)
{
    die("Error: Data not found.. de unudades");
}

$id_ultimo = $test['codigo'];

$mes_ultimo = $test['mes'];

$ano_ultimo = $test['ano'];



$disambled = true;
$error_datos = false;



if($ano_ultimo == $ano_actual){

    if($mes_actual > $mes_ultimo){
        $disambled = false;

    }else if($mes_actual < $mes_ultimo){
        $error_datos = true;
    }
}else if($ano_ultimo <  $ano_actual){

    $disambled = false;


}else if($ano_ultimo >  $ano_actual){
    $error_datos = true;

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

        function resetForms() {
            for (var i = 0; i < document.forms.length; i++) {
                document.forms[i].reset();
            }

            $(function() {
                resetForms();

            });
    </script>
    <!-- Beginning of compulsory code below -->
    <link href="../..css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../..css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->
</head>
<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->
<form method="post" name="inventario" enctype="multipart/form-data">
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


                            <table>
                                <tr>
                                    <td >
                                        <input type="submit" value="Cierre de Mes" name="submit" <?php
                                        if($disambled)
                                            echo("disabled");?>>
                                    </td>
                                    <td> &nbsp;&nbsp;&nbsp;&nbsp;</td>

                                    <td>
                                        <a href="../../min_menu.php"><input type="button" value="Atras"></a>
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
