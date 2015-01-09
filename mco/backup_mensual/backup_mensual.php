<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/01/15
 * Time: 12:10 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


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



    mysql_close($coon);
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






include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Cierre Mensual');


$layout->append_to_header('
    <script>

        function resetForms() {
            for (var i = 0; i < document.forms.length; i++) {
                document.forms[i].reset();
            }
            }

            $(function() {
                resetForms();

            });
    </script>');


$layout->get_header();


$boton_disambled = '';
if($disambled)
    $boton_disambled = "disabled";


$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" name="gerencia"  id="contact-form">
    <div class="formLayout">
    <fieldset>


    <input type="submit" value="Cierre de Mes" name="submit" $boton_disambled>

    <a href="../../mco_menu.php"><input type="button" value="Atras"></a>



    </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);