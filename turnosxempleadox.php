<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php

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


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>

    <script src="js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="css/htmlDatePicker.css" rel="stylesheet">

    <link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="./css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="./js/jquery-1.10.2.js"></script>

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

    <!-- / END -->

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post"  name="turnoxempleado">
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
                <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Turnos por Empleado</strong></h1>
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
                        <TD width="173"><label>Cédula de Empleado</label></TD>
                        <TD width="94">
                            <input type="text" name="cedulaempleado" id="cedulaempleado" size="20" value=<?php echo $cedulaempleado ?>></TD>
                        <TD>
                            <!--<input type="submit" value="Buscar" name="submit">-->
                            <input type="button" onClick="javascript: buscar_empleado()" name="buscar" value="Buscar" >
                            <input type="hidden" name="codigo_hi" id="codigo_hi"/>
                        </TD>
                    </TR>

                    <TR>
                        <TD><label>Nombre</label></TD>
                        <TD><input type="text" name="nombre" id="nombre" size="20" value=<?php echo($nombre) ?>></TD>
                        <TD width="107"><label>Apellido</label></TD>
                        <TD width="98"><input type="text" name="apellido" id="apellido" size="20" value=<?php echo($apellido); ?>></TD>
                    </TR>


                    <tr>
                        <td><label for="">Mensual?</label></td>
                        <td><input  type="checkbox" id="check_mensual"/></td>
                    </tr>

                    <TR>
                        <TD><label>Año</label></TD>
                        <TD>
                            <select name='anhio' id='codigoanhio' >

                                <?php $anhio = date('Y');
                                echo('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
                                echo('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
                                echo('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
                                echo('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
                                echo('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');
                                ?>
                            </select>
                        </TD>


                    <TR>
                        <TD><label>Mes</label></TD>
                        <TD>
                            <select name='codigomes' id='codigomes' >

                                <?php

                                $mes = date('n');

                                if($mes == 1){
                                    echo(" <option value='1' selected>Enero</option>");
                                }else{
                                    echo(" <option value='1' >Enero</option>");
                                }
                                if($mes == 2){
                                    echo(" <option value='2' selected>Febrero</option>");
                                }else{
                                    echo(" <option value='2' >Febrero</option>");
                                }
                                if($mes == 3){
                                    echo(" <option value='3' selected>Marzo</option>");
                                }else{
                                    echo(" <option value='3' >Marzo</option>");
                                }
                                if($mes == 4){
                                    echo(" <option value='4' selected>Abril</option>");
                                }else{
                                    echo(" <option value='4' >Abril</option>");
                                }
                                if($mes == 5){
                                    echo(" <option value='5' selected>Mayo</option>");
                                }else{
                                    echo(" <option value='5' >Mayo</option>");
                                }
                                if($mes == 6){
                                    echo(" <option value='6' selected>Junio</option>");
                                }else{
                                    echo(" <option value='6' >Junio</option>");
                                }
                                if($mes == 7){
                                    echo(" <option value='7' selected>Julio</option>");
                                }else{
                                    echo(" <option value='7' >Julio</option>");
                                }
                                if($mes == 8){
                                    echo(" <option value='8' selected>Agosto</option>");
                                }else{
                                    echo(" <option value='8' >Agosto</option>");
                                }
                                if($mes == 9){
                                    echo(" <option value='9' selected>Septiembre</option>");
                                }else{
                                    echo(" <option value='9' >Septiembre</option>");
                                }
                                if($mes == 10){
                                    echo(" <option value='10' selected>Octubre</option>");
                                }else{
                                    echo(" <option value='10' >Octubre</option>");
                                }
                                if($mes == 11){
                                    echo(" <option value='11' selected>Noviembre</option>");
                                }else{
                                    echo(" <option value='11' >Noviembre</option>");
                                }
                                if($mes == 12){
                                    echo(" <option value='12' selected>Diciembre</option>");
                                }else{
                                    echo(" <option value='12' >Diciembre</option>");
                                }

                                ?>

                            </select>
                        </TD>



                    </TR>




                    <!--    <table border="1" width="100">-->
                    <!--    <TR>-->
                    <!--          <TD><label>Seleccione Turno</label></TD>-->
                    <!--            --><?php //// consulta de los meses
                    //             // Consultar la base de datos
                    //
                    //                $consulta_mysql='select * from mrh_turnos';
                    //                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                    //                echo "<TD>";
                    //                echo "<select name='codigoturno' id='codigoturno' size='10'>";
                    //                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                    //                        echo "<option value='".$fila['codigo']."'>".$fila['descripcion'].'-'.$fila['horaentrada'].'-'.$fila['horasalida']."</option>";
                    //                    }
                    //                echo "</select>";
                    //                echo "</TD>";
                    //             ?>
                    <!--    </TR>-->
                    <!--    </table>-->

                </TABLE>


                <div id="respuesta">

                </div>

                <TABLE>
                    <TR>
                        <TD>
                            <a><input type="Submit" name="ver_turnos" value="Ver Datos"></a>
                        </TD>
                        <TD>
                            <!--<input type="button" onClick="javascript: insertar()" name="asignar" value="Asignar Turno" >-->
                            <a><input type="Submit" name="submit" value="Asignar Turno"></a>
                        </TD>
                        <TD>
                            <a href="mrh_menu.php"><input type="button" value="Atras"></a>
                        </TD>
                    </TR>
                </TABLE>
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

<script type="text/javascript">
    //EVENTOS EN javascript

    //function objetoAjax(){
    //	var xmlhttp=false;
    //	try {
    //		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    //	} catch (e) {
    //
    //	try {
    //		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    //	} catch (E) {
    //		xmlhttp = false;
    //	}
    //}
    //
    //if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    //	  xmlhttp = new XMLHttpRequest();
    //	}
    //	return xmlhttp;
    //}
    //
    ///*function insertar(){
    //
    //	divResultado = document.getElementById('resultado');
    //
    //	var	cedulaempleado = document.getElementById("cedulaempleado").value;
    //	var	codigomes = document.getElementById("mes").value;
    //        var	codigosemana = document.getElementById("semana").value;
    //        var	codigoturno = document.getElementById("turno").value;
    //
    //  	alert(codigosemana);
    //	exit;
    //
    //	ajax=objetoAjax();
    //	ajax.open("POST", "turnosxempleado_insertar.php",true);
    //
    //	ajax.onreadystatechange=function() {
    //  	if (ajax.readyState==4) {
    //		divResultado.innerHTML = ajax.responseText
    //	}
    // }
    //
    //        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //	trama="cedulaempleado="+cedulaempleado+
    //                "&codigomes="+codigomes+
    //                    "&codigosemana="+codigosemana+
    //                        "&codigoturno="+codigoturno;
    //        //alert(trama);
    //        //exit;
    //        ajax.send(trama);
    //
    //	alert('Registro Guardado');
    //
    //
    //}*/

    function buscar_empleado(){
        var win = window.open("turnosxempleados_buscarempleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
        win.focus();
    }


    //function cargasemana(str)
    //	{
    //		if (str=="")
    //		{
    //			document.getElementById("codigomes").innerHTML="";
    //			return;
    //
    //			}
    //
    //		if (window.XMLHttpRequest)
    //		{// code for IE7+, Firefox, Chrome, Opera, Safari
    //			xmlhttp=new XMLHttpRequest();
    //
    //			}
    //			else
    //			{// code for IE6, IE5
    //				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    //
    //				}
    //
    //		xmlhttp.onreadystatechange=function()
    //		{
    //			if (xmlhttp.readyState==4 && xmlhttp.status==200)
    //			{
    //				document.getElementById("codigosemana").innerHTML=xmlhttp.responseText;
    //
    //				}
    //
    //			}
    //		xmlhttp.open("GET","semana.php?codigomes="+str,true);
    //
    //		xmlhttp.send();
    //	}
</script>
