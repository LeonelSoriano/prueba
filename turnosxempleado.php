<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 12:15 PM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');


$cedulaempleado ="";
$nombre="";
$apellido="";

require_once('./clases/funciones.php');


require_once('./clases/Validate.php');
include("db.php");
//$cedulaempleado =$_REQUEST['cedulaempleado'];

if ($cedulaempleado<>""){
    $sql = "select * from mrh_empleado where cedula=".$cedulaempleado;
    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);
    if (!$result)
    {
        die("Error: Data not found..");
    }

    $nombre = $test['primernombre'];
    $apellido = $test['primerapellido'];
}


if (isset($_POST['submit']))
{

    $bd_guardar=1;

    $cedulaempleado = $_POST['codigo_hi'];


//
//        if($cedulaempleado==""){
//                echo "<script type='text/javascript'>";
//                echo "    alert('Debe seleccionar cedula');";
//                echo "</script>";
//                $bd_guardar=0;
//        }
    $codigomes = $_POST['codigomes'];
    if($codigomes==""){
        echo "<script type='text/javascript'>";
        echo "    alert('Debe seleccionar el mes');";
        echo "</script>";
        $bd_guardar=0;
    }
//        $codigosemana = $_POST['codigosemana'];
//        if($codigosemana==""){
//                echo "<script type='text/javascript'>";
//                echo "    alert('Debe seleccionar la semana');";
//                echo "</script>";
//                $bd_guardar=0;
//        }
//        $codigoturno = $_POST['codigoturno'];
//        if($codigoturno==""){
//                echo "<script type='text/javascript'>";
//                echo "    alert('Debe seleccionar el turno');";
//                echo "</script>";
//                $bd_guardar=0;
//        }

    $sql = "SELECT * FROM mrh_turnoxempleado WHERE cedulaempleado = '$cedulaempleado' and codigomes = '$codigomes' and codigosemana = '$codigosemana'";
    //echo $sql;
    //exit;
    $total = mysql_num_rows(mysql_query($sql));
    if ($total <> 0){
        echo "<script type='text/javascript'>";
        echo "    alert('Esta Semana Esta Ocupada, Seleccione Otra');";
        echo "</script>";
        $bd_guardar = 0;
    }

    $anhio = $_POST['anhio'];


    if($bd_guardar==1){



        //echo $codigosemana;


        //$codigosemana = $test['codigosemana'];

        if(isset($_POST['submit'])){


            $validation = array(

                array('nombre' => 'codigo_hi',
                    'requerida' => true,
                    'regla' => 'number'),


            );

            $validated = new Validate($validation,$_POST);
            $validated->validate();


            if(!$validated->getIsError()) {

                $sql = "SELECT
    count(*) as total
FROM
    mrh_turnoxempleado
WHERE
    mrh_turnoxempleado.cedulaempleado = '$cedulaempleado'
        AND mrh_turnoxempleado.codigomes = '$codigomes'
        AND mrh_turnoxempleado.anhio = '$anhio' AND mrh_turnoxempleado.eliminado = 'no'";

                $result = mysql_query($sql);

                $test = mysql_fetch_array($result);


                $total = $test['total'];

                if ($total != "0") {
                    $a = $test['total'];
                    send_error_redirect(true, "El Empleado ya Esta Asignado En este Mes");
                    die;
                }


                if (isset($_POST['codigoturno1'])) {
                    $codigoturno = $_POST['codigoturno1'];
                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','1','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);
                }

                if (isset($_POST['codigoturno2'])) {
                    $codigoturno = $_POST['codigoturno2'];
                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','2','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);
                }
                if (isset($_POST['codigoturno3'])) {
                    $codigoturno = $_POST['codigoturno3'];
                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','3','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);
                }

                if (isset($_POST['codigoturno4'])) {
                    $codigoturno = $_POST['codigoturno4'];
                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','4','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);
                }

                if (isset($_POST['codigoturno5'])) {
                    $codigoturno = $_POST['codigoturno4'];
                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','5','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);
                }

                if (isset($_POST['codigoturno'])) {

                    $numero_lunes = count(getMondays($anhio, $cedulaempleado));

                    $codigoturno = $_POST['codigoturno'];

                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','1','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);

                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','2','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);

                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','3','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);

                    $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','4','$codigoturno','$anhio')";
                    //echo $sql;
                    mysql_query($sql);

                    if ($numero_lunes == 5) {
                        $sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
                     VALUES ('$cedulaempleado','$codigomes','5','$codigoturno','$anhio')";
                        //echo $sql;
                        mysql_query($sql);
                    }


                }

                send_error_redirect(false, 'La Información fue Almacenada Correctamente');
                die;

            }else if($validated->getIsError()){

                send_error_redirect(true , 'Ingresa El Trabajador');
            }

        }

//			elseif ($codigosemana <> 0){
//
//				$sql = "insert into mrh_turnoxempleado(cedulaempleado,codigomes,codigosemana,codigoturno,anhio)
//						 VALUES ('$cedulaempleado','$codigomes','$codigosemana','$codigoturno','$anhio')";
//				//echo $sql;
//				mysql_query($sql);
//
//			}



        echo "<script type='text/javascript'>";
        echo "    alert('Turno Agregado');";
        echo "</script>";

        $cedulaempleado ="";


        mysql_close($conn);
    }

}

if (isset($_POST['ver_turnos']))
{
    $bd_mostrar = 1;
    $codigo_hi = $_POST['codigo_hi'];
    $codigomes = $_POST['codigomes'];
    $anhio = $_POST['anhio'];

    if($codigo_hi==""){
        echo "<script type='text/javascript'>";
        echo "    alert('Debe seleccionar la cedula');";
        echo "</script>";
        $bd_mostrar=0;
    }

    if ($bd_mostrar==1){
        header ("Location: turnosxempleado_ver.php?codigo=".$codigo_hi."&mes=".$codigomes."&anhio=".$anhio);
    }

}


$layout = new LayoutForm('Módulo de Recursos Humanos | Turnos por Empleado','.');


$layout->append_to_header(
    <<<EOT
    <script type="text/javascript">

        $(function() {


            $('#check_mensual').bind('change',function() {


                var mes = $('#codigomes').val();
                var anhio = $('#codigoanhio').val();

                var check_mensual = 'no';

                if($('#check_mensual').is(':checked')) {
                    check_mensual = 'si';
                }



                var parametros = { mes : mes,
                    anhio : anhio,
                    check_mensual: check_mensual};

                $.ajax({
                    data:  parametros,
                    url:   'turnosxempleado_ajax.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="./images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {

                        $("#respuesta").html(response);
                    }
                });

            });



            $('#codigoanhio').bind('change',function() {

                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var anhio = valueSelected;


                var check_mensual = 'no';

                if($("#check_mensual").is(':checked')) {
                    check_mensual = 'si';
                }


                var mes = $("#codigomes").val();


                var parametros = { mes : mes,
                    anhio : anhio,
                    check_mensual: check_mensual};

                $.ajax({
                    data:  parametros,
                    url:   'turnosxempleado_ajax.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="./images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {

                        $("#respuesta").html(response);
                    }
                });
            });





            $('#codigomes').bind('change',function() {

                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var mes = valueSelected;

                var anhio = $("#codigoanhio").val();

                var check_mensual = 'no';

                if($("#check_mensual").is(':checked')) {
                    check_mensual = 'si';
                }



                var parametros = { mes : mes,
                    anhio : anhio,
                    check_mensual: check_mensual};

                $.ajax({
                    data:  parametros,
                    url:   'turnosxempleado_ajax.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="./images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {

                        $("#respuesta").html(response);
                    }
                });
            });



            var anhio = $("#codigoanhio").val();
            var mes = $("#codigomes").val();


            var check_mensual = 'no';

            if($("#check_mensual").is(':checked')) {
                check_mensual = 'si';
            }


            var parametros = { mes : mes,
                anhio : anhio,check_mensual: check_mensual};

            $.ajax({
                data:  parametros,
                url:   'turnosxempleado_ajax.php',
                type:  'post',
                beforeSend: function () {
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                    '<img src="./images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {

                    $("#respuesta").html(response);
                }
            });



        });

    </script>
EOT

 );


$layout->get_header();


$anhio_form = '';

 $anhio = date('Y');

$anhio_form .= ('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
$anhio_form .=('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
$anhio_form .= ('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
$anhio_form .= ('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
$anhio_form .= ('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');


$mes_from = '';


$mes = date('n');

if($mes == 1){
    $mes_from .= (" <option value='1' selected>Enero</option>");
}else{
    $mes_from .= (" <option value='1' >Enero</option>");
}
if($mes == 2){
    $mes_from .= (" <option value='2' selected>Febrero</option>");
}else{
    $mes_from .= (" <option value='2' >Febrero</option>");
}
if($mes == 3){
    $mes_from .= (" <option value='3' selected>Marzo</option>");
}else{
    $mes_from .= (" <option value='3' >Marzo</option>");
}
if($mes == 4){
    $mes_from .= (" <option value='4' selected>Abril</option>");
}else{
    $mes_from .= (" <option value='4' >Abril</option>");
}
if($mes == 5){
    $mes_from .= (" <option value='5' selected>Mayo</option>");
}else{
    $mes_from .= (" <option value='5' >Mayo</option>");
}
if($mes == 6){
    $mes_from .= (" <option value='6' selected>Junio</option>");
}else{
    $mes_from .= (" <option value='6' >Junio</option>");
}
if($mes == 7){
    $mes_from .= (" <option value='7' selected>Julio</option>");
}else{
    $mes_from .= (" <option value='7' >Julio</option>");
}
if($mes == 8){
    $mes_from .= (" <option value='8' selected>Agosto</option>");
}else{
    $mes_from .= (" <option value='8' >Agosto</option>");
}
if($mes == 9){
    $mes_from .= (" <option value='9' selected>Septiembre</option>");
}else{
    $mes_from .= (" <option value='9' >Septiembre</option>");
}
if($mes == 10){
    $mes_from .= (" <option value='10' selected>Octubre</option>");
}else{
    $mes_from .= (" <option value='10' >Octubre</option>");
}
if($mes == 11){
    $mes_from .= (" <option value='11' selected>Noviembre</option>");
}else{
    $mes_from .= (" <option value='11' >Noviembre</option>");
}
if($mes == 12){
    $mes_from .= (" <option value='12' selected>Diciembre</option>");
}else{
    $mes_from .= (" <option value='12' >Diciembre</option>");
}






$layout->set_form(

    <<<EOT

    <form id="contact-form" method="post" enctype="multipart/form-data" name="turnoxempleado">
    <div class="formLayout">
    <fieldset>

            <label>Cédula de Empleado</label>
<input type="text" name="cedulaempleado" id="cedulaempleado" size="20" value="$cedulaempleado" ?>
<input type="button" onClick="javascript: buscar_empleado()" name="buscar" value="Buscar" >
                            <input type="hidden" name="codigo_hi" id="codigo_hi"/>
<br/>


<script type="text/javascript">
    function buscar_empleado(){
        var win = window.open("turnosxempleados_buscarempleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
        win.focus();
    }
    </script>

<label>Nombre</label>
<input type="text" name="nombre" id="nombre" size="20" value="$nombre">
<br/>
<label>Apellido</label>
<input type="text" name="apellido" id="apellido" size="20" value="$apellido">
<br/>

<label >Mensual?</label>
<input  type="checkbox" id="check_mensual"/><label for="checkbox3" style="float: left"><span></span></label>
<br/>

<label>Año</label>

<select name='anhio' id='codigoanhio' >


$anhio_form

 </select>


 </br>
 <label>Mes</label>
 <select name='codigomes' id='codigomes' >
$mes_from
 </select>
 <br/>


                <div id="respuesta">

                </div>


 <br/>
   <a><input type="Submit" name="ver_turnos" value="Ver Datos"></a>
   <a><input type="Submit" name="submit" value="Asignar Turno"></a>
   <a href="mrh_menu.php"><input type="button" value="Atras"></a>

             </div>
        </fieldset>
    </form>



EOT

);

$layout->get_footer();