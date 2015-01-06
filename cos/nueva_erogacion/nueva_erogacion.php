<?php

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php


ini_set('display_errors', 'On');
ini_set('display_errors', 1);
require_once('../../clases/Validate.php');
$error =  true;
require_once ('../../db.php');

if (isset($_POST['submit'])){


    if(!isset($_POST['group1'])){


        $validations = array(
            array('nombre' => 'nombre',
                'requerida' => true),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'unidad',
                'requerida' => true,
                'regla' => 'number')

        );

        $validated = new Validate($validations,$_POST);
        $validated->validate();


        if(!$validated->getIsError()){

            $nombre = $_POST['nombre'];
            $departamento_hi = $_POST['departamento_hi'];
            $undiad = $_POST['unidad'];

            $sql = "INSERT INTO cos_erogaciones(nombre,codigo_unidad_erogacion,codigo_departamento)
        VALUES('$nombre','$undiad',$departamento_hi) ";

            $result = mysql_query($sql);

            send_error_redirect(false,'Datos Guardados Exitosamente');
            die;

        }else if($validated->getIsError()){
            send_error_redirect(true,"Hay Errores en la Información del formulario");die;
        }



    }else{
        if($_POST['group1'] != 'otro'){


            $validations = array(
                array('nombre' => 'nombre',
                    'requerida' => true)

            );

            $validated = new Validate($validations,$_POST);
            $validated->validate();

            $unidad = $_POST['unidad'];
            $nombre = $_POST['nombre'];

            if(!$validated->getIsError()) {

                $unidad = $_POST['unidad'];


                if ($_POST['group1'] == 'productiva') {

                    $sql1 = '';

                    if($unidad == '-1'){
                        $sql1 = "SELECT
	mno_gerencia.codigo as departamento
from
    mno_gerencia
        INNER JOIN
    mrh_empleado ON mrh_empleado.codigo_departamento = mno_gerencia.codigo
WHERE mno_gerencia.unidad_administrativa = 'productiva'
GROUP BY mrh_empleado.codigo_departamento";
                    }else if($unidad == '-2'){

                        $sql1 = "SELECT
    mno_gerencia.codigo as departamento
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'productiva'";

                    }else{
                        $sql1 = "SELECT
    mco_unidad_erogacion_detalle.codigo_departamento as  departamento
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = mco_unidad_erogacion_detalle.codigo_departamento
WHERE
    mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$unidad'
AND mno_gerencia.unidad_administrativa = 'productiva'";
                    }



                    $result1 = mysql_query($sql1);

                    while($test1 = mysql_fetch_array($result1))
                    {
                        $departamento = $test1['departamento'];


                        $sql = "INSERT INTO cos_erogaciones(nombre,codigo_unidad_erogacion,codigo_departamento)
        VALUES('$nombre','$unidad',$departamento) ";

                        $result = mysql_query($sql)or die('No se pudo guardar la información. '.mysql_error());;
                    }



                } else if ($_POST['group1'] == 'operativa_venta') {

                    $sql1 = '';

                    if($unidad == '-1'){
                        $sql1 = "SELECT
	mno_gerencia.codigo as departamento
from
    mno_gerencia
        INNER JOIN
    mrh_empleado ON mrh_empleado.codigo_departamento = mno_gerencia.codigo
WHERE mno_gerencia.unidad_administrativa = 'operativa_venta'
GROUP BY mrh_empleado.codigo_departamento";
                    }else if($unidad == '-2'){

                        $sql1 = "SELECT
    mno_gerencia.codigo as departamento
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'operativa_venta'";

                    }else{

                    $sql1 = "SELECT
    mco_unidad_erogacion_detalle.codigo_departamento as  departamento
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = mco_unidad_erogacion_detalle.codigo_departamento
WHERE
    mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$unidad'
AND mno_gerencia.unidad_administrativa = 'operativa_venta'";

                    }

                    $result1 = mysql_query(sql1);

                    while($test1 = mysql_fetch_array($result1))
                    {
                        $departamento = $test1['departamento'];

                        $sql = "INSERT INTO cos_erogaciones(nombre,codigo_unidad_erogacion,codigo_departamento)
        VALUES('$nombre','$unidad',$departamento)";

                        $result = mysql_query($sql)or die('No se pudo guardar la información. '.mysql_error());;
                    }

                }else if($_POST['group1'] == 'todos'){


                    $sql1 = '';

                    if($unidad == '-1'){
                        $sql1 = "SELECT
	mno_gerencia.codigo as departamento
from
    mno_gerencia
        INNER JOIN
    mrh_empleado ON mrh_empleado.codigo_departamento = mno_gerencia.codigo
GROUP BY mrh_empleado.codigo_departamento";

                    }else if($unidad == '-2'){

                        $sql1 = "SELECT
    mno_gerencia.codigo as departamento
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
";

                    }else {
                        $sql1 = "SELECT
    mco_unidad_erogacion_detalle.codigo_departamento as  departamento
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = mco_unidad_erogacion_detalle.codigo_departamento
WHERE
    mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$unidad'";
                    }

                    $result1 = mysql_query($sql1);

                    while($test1 = mysql_fetch_array($result1))
                    {
                        $departamento = $test1['departamento'];


                        $sql = "INSERT INTO cos_erogaciones(nombre,codigo_unidad_erogacion,codigo_departamento)
        VALUES('$nombre','$unidad',$departamento) ";

                        $result = mysql_query($sql)or die('No se pudo guardar la información. '.mysql_error());

                    }



                }else if ($_POST['group1'] == 'operativa_administrativo') {


                    $sql1 = '';

                    if ($unidad == '-1') {
                        $sql1 = "SELECT
	mno_gerencia.codigo as departamento
from
    mno_gerencia
        INNER JOIN
    mrh_empleado ON mrh_empleado.codigo_departamento = mno_gerencia.codigo
WHERE mno_gerencia.unidad_administrativa = 'operativa_administrativo'
GROUP BY mrh_empleado.codigo_departamento";
                    }else if($unidad == '-2'){

                        $sql1 = "SELECT
    mno_gerencia.codigo as departamento
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'productiva_administrativo'";

                    } else {

                    $sql1 = "SELECT
    mco_unidad_erogacion_detalle.codigo_departamento as  departamento
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = mco_unidad_erogacion_detalle.codigo_departamento
WHERE
    mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$unidad'
AND mno_gerencia.unidad_administrativa = 'operativa_administrativo'";
                }
                    $result1 = mysql_query($sql1);

                    while($test1 = mysql_fetch_array($result1))
                    {
                        $departamento = $test1['departamento'];


                        $sql = "INSERT INTO cos_erogaciones(nombre,codigo_unidad_erogacion,codigo_departamento)
        VALUES('$nombre','$unidad',$departamento) ";

                        $result = mysql_query($sql)or die('No se pudo guardar la información. '.mysql_error());

                    }

                } else if ($_POST['group1'] == 'apoyo') {

                    $sql1 = '';

                    if ($unidad == '-1') {
                        $sql1 = "SELECT
	mno_gerencia.codigo as departamento
from
    mno_gerencia
        INNER JOIN
    mrh_empleado ON mrh_empleado.codigo_departamento = mno_gerencia.codigo
WHERE mno_gerencia.unidad_administrativa = 'apoyo'
GROUP BY mrh_empleado.codigo_departamento";
                    }else if($unidad == '-2'){

                        $sql1 = "SELECT
    mno_gerencia.codigo as departamento
FROM
    bien_metros_departamento
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = bien_metros_departamento.codigo_departamento
WHERE mno_gerencia.unidad_administrativa = 'apoyo'";

                    } else {

                        $sql1 = "SELECT
    mco_unidad_erogacion_detalle.codigo_departamento as  departamento
FROM
    mco_unidad_erogacion_detalle
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = mco_unidad_erogacion_detalle.codigo_departamento
WHERE
    mco_unidad_erogacion_detalle.codigo_unidad_erogacion = '$unidad'
AND mno_gerencia.unidad_administrativa = 'apoyo'";
                    }

                    $result1 = mysql_query($sql1);

                    while($test = mysql_fetch_array($result1))
                    {
                        $departamento = $test['departamento'];


                        $sql = "INSERT INTO cos_erogaciones(nombre,codigo_unidad_erogacion,codigo_departamento)
        VALUES('$nombre','$unidad',$departamento) ";

                        $result = mysql_query($sql)or die('No se pudo guardar la información. '.mysql_error());;

                    }

                }

                send_error_redirect(false,'Datos Guardados Exitosamente');
                die;

            }else if($validated->getIsError()){
                send_error_redirect(true,"Hay Errores en la Información del formulario");die;
            }


        }else{




            $str = json_decode($_POST['post_array'], true);
            $cantidad1 = count($str);

            $fake_POST = array();

            $nombre = $_POST['nombre'];



            for ($i = 1; $i < $cantidad1; $i++) {

                $tmp_json = json_encode($str[$i], JSON_UNESCAPED_UNICODE);
                $codigo_departamento = json_decode($tmp_json)->{'codigo_departamento'};
                $codigo_unidad = json_decode($tmp_json)->{'codigo_unidad'};

                $fake_POST['codigo_departamento'] = $codigo_departamento;
                $fake_POST['codigo_unidad'] = $codigo_unidad;
                $fake_POST['nombre'] = $nombre;


                $validation = array(


                    array('nombre' => 'nombre',
                        'requerida' => true),


                    array('nombre' => 'codigo_departamento',
                        'requerida' => true,
                        'regla' => 'number'),


                    array('nombre' => 'codigo_unidad',
                        'requerida' => true,
                        'regla' => 'number')
                );


                $validated = new Validate($validation, $fake_POST);
                $validated->validate();

                if ($validated->getIsError()) {
                    send_error_redirect(true, "Hay Errores en la Información del formulario");
                    die;

                }
            }//endfor


            for ($i = 1; $i < $cantidad1; $i++) {

                $tmp_json = json_encode($str[$i], JSON_UNESCAPED_UNICODE);

                $codigo_departamento = json_decode($tmp_json)->{'codigo_departamento'};
                $codigo_unidad = json_decode($tmp_json)->{'codigo_unidad'};


                $sql = "INSERT INTO cos_erogaciones(nombre,codigo_unidad_erogacion,codigo_departamento)
        VALUES('$nombre','$codigo_unidad',$codigo_departamento) ";

                $result = mysql_query($sql)or die('No se pudo guardar la información. '.mysql_error());
            }

            send_error_redirect(false,'Datos Guardados Exitosamente');
            die;

        }
    }

}
?>


<!DOCTYPE html>
<html>
<head lang="es">
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />

    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <link href="../../js/jquery-ui-1.11.0.custom/jquery-ui.css" rel="stylesheet">
    <script src="../../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->


    <style type="text/css">
        .formLayout
        {
            /*background-color: #f3f3f3;*/
            /*border: solid 1px #a1a1a1;*/
            /*padding: 10px;*/

        }

        .formLayout label
        {
            display: block;
            width: 100px;
            float: left;
            margin-bottom: 15px;
        }

        .formLayout input{
            display: block;

            float: left;
            margin-bottom: 15px;
        }

        .formLayout label
        {

            padding-right: 20px;
            padding-top: 2px;
        }

        br
        {
            clear: left;
        }

        /*jquery ui*/

        #dialog-link {
            padding: .4em 1em .4em 20px;
            text-decoration: none;
            position: relative;
        }
        #dialog-link span.ui-icon {
            margin: 0 5px 0 0;
            position: absolute;
            left: .2em;
            top: 50%;
            margin-top: -8px;
        }
        #icons {
            margin: 0;
            padding: 0;
        }
        #icons li {
            margin: 2px;
            position: relative;
            padding: 4px 0;
            cursor: pointer;
            float: left;
            list-style: none;
        }
        #icons span.ui-icon {
            float: left;
            margin: 0 4px;
        }


    </style>

    <script>

        function resetForms() {
            for (var i = 0; i < document.forms.length; i++) {
                document.forms[i].reset();
            }
        }

        var form_principal = "<div id='informacion'>"+
            "<label>Departamento</label>"+
            "<input type='text' name='departamento' disabled/>"+
            "<input type='button' name='departamento_buscar' id='departamento_buscar' value='Buscar'/>"+
            "<input type='hidden' name='departamento_hi' name='departamento_hi'/>"+
            "<br/>"+
            "<label for='unidad'> Unidad </label>"+
            "<select name='unidad' id='unidad'>"+
            "            <?php

                $sql ="SELECT codigo,nombre FROM mco_unidad_erogacion";

                $result = mysql_query($sql);

                while($test = mysql_fetch_array($result)){
                    $codigo = $test['codigo'];
                    $nombre = $test['nombre'];
                    echo("<option value='$codigo'>$nombre</option>");
                }
                echo("<option value='-1'>Trabajadores</option>");
                 echo("<option value='-2'>Metros Edificación</option>");
            ?> </select><br/>";


        $(function(){


            function agregar(){
                $("#agregar").click(function() {

                    if(!head_exsit){
                        $('#tabla_articulos ').after('<br/><br/>' +
                        '<table border=none class="tablas-nuevas" id="tabla">' +
                        '  <tr  style="text-align: center">' +
                        '<th>Departamento</th>' +
                        '<th>Tipo Unidad</th>' +
                        '<th>Eliminar</th>' +
                        '<th style="display: none">codigo_departamento</th>' +
                        '<th style="display: none">codigo_unidad</th>' +

                        '</tr>' +
                        '</table>');
                        head_exsit = true;
                    }


                    if($("#departamento").val() != '' && $("#cantidad").val() != ''){

                        var departamento = $("#departamento").val();


                        var nombre_unidad = $("#unidad option:selected").text();

                        var codigo_unidad = $("#unidad").val();

                        var departamento_hi = $("#departamento_hi").val();


                        $('#tabla tr:last').after("<tr>" +
                        "<td  style='text-align: left; '> <label style='font-size: 10px;'> " +departamento + " </label> </td> " +
                        "<td   style='text-align: left'> <label style='font-size: 10px'>"+nombre_unidad+"</label> </td> " +
                        "<td> <ul  id='icons' class='ui-widget ui-helper-clearfix'> <li   class='ui-state-default ui-corner-all' title='.ui-icon-check'><span  class='ui-icon ui-icon-check'></span></li> </ul></td>" +
                        "<td style='display: none'> <label >"+ departamento_hi +"</label> </td> " +
                        "<td style='display: none'> <label >"+ codigo_unidad +"</label> </td> " +


                        "</tr>");


                        $("#departamento").val('');
                        $("#cantidad").val('');
                        $("#departamento_hi").val();


                        $('.ui-widget').click(function() {
                            $(this).parent().parent().remove(); //Deleting TD element
                        });

                    }

                });


            }


            var form_secundario = "<hr style='margin-top: 10px;margin-bottom: 20px' />"+
                    "<label style=' width: 50px' >Productiva</label><input style='margin-right: 125px'  type='radio' name='group1' value='productiva'  checked>"+
                    "<label  style=' width: 84px'>Operativa(Venta)</label><input  style='margin-right: 40px'  type='radio' name='group1' value='operativa_venta'><br/>"+
                    " <label  style='width: 135px'>Operativa(Administrativo)</label><input  style='margin-right: 40px' type='radio' name='group1' value='operativa_administrativo' checked>"+
                    "<label  style='width: 32px'>Apoyo</label><input  style='margin-right: 40px' type='radio' name='group1' value='apoyo' ><br/>"+
                "<label  style='width: 32px'>Todos</label><input  style='margin-right: 40px' type='radio' name='group1' value='todos' >"+
                    "<label  style='width: 32px'>Otro</label><input id='otro_radio' style='margin-right: 40px' type='radio' name='group1' value='otro' ><br/>"+
            "<label for='unidad'> Unidad </label>"+
            "<select name='unidad' id='unidad'>"+
            "<?php

                            $sql ="SELECT codigo,nombre FROM mco_unidad_erogacion";

                            $result = mysql_query($sql);

                            while($test = mysql_fetch_array($result)){
                                $codigo = $test['codigo'];
                                $nombre = $test['nombre'];
                                echo("<option value='$codigo'>$nombre</option>");
                            }
                            echo("<option value='-1'>Trabajadores</option>");
                            echo("<option value='-2'>Metros Edificación</option>");
                       ?></select><br/>";


            var form_secundario_cuadro = "<hr style='margin-bottom: 20px'/>"+
                "<label>Departamento</label>"+
                "<input type='text' name='departamento' id='departamento' disabled/>"+
                "<input type='button' name='departamento_buscar' id='departamento_buscar' value='Buscar'/>"+
                "<input type='hidden' name='departamento_hi' id='departamento_hi' value=''/><br/>"+

                "<input style='margin-left: 310px' type='button' value='Agregar' id='agregar'/><br/>"+
                "<div id='tabla_articulos' ></div> <input type='hidden' value='' id='post_array' name='post_array'/>";

            $('#informacion').html(form_principal);

            $( "#distribuible" ).prop( "checked", false );


            var head_exsit = false;



            $("input[name='group1']").on("change", function () {



                if(this.value == 'otro'){
                    $('#seleccion_otro').html(form_secundario_cuadro);

                }else{
                    $('#seleccion_otro').html('');
                }
            });



            resetForms();

            $( '#departamento_buscar' ).click(function() {
                var win = window.open('departamento_buscar.php', 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');
                win.focus();
            });



            $('#distribuible').bind('change',function() {

                var check_distribuible = 'no';

                if($("#distribuible").is(':checked')) {
                    check_distribuible = 'si';
                }


                if(check_distribuible == 'no'){
                    $('#informacion').html(form_principal);
                    $('#seleccion_otro').html('');

                    $( '#departamento_buscar' ).click(function() {
                        var win = window.open('departamento_buscar.php', 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');
                        win.focus();
                    });


                }else{
                    $('#informacion').html(form_secundario);


                    $("input[name='group1']").on("change", function () {



                        if(this.value == 'otro'){
                            $('#seleccion_otro').html(form_secundario_cuadro);

                            $( '#departamento_buscar' ).click(function() {
                                var win = window.open('departamento_buscar.php', 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');

                                win.focus();
                            });

                            agregar();

                            $('#form').submit(function() {

                                var columns = $('#tabla tr th').map(function() {  return $(this).text();
                                });

                                var tableObject = $('#tabla  tr').map(function(i) {    var row = {};  $(this).find('td').each(function(i) {      var rowName = columns[i];    row[rowName] = $(this).text();
                                });return row;   }).get();


                                var json_tabla= JSON.stringify(tableObject);



                                $("#post_array").val(json_tabla);
                                $("#post_array").serializeArray();


                                return true; // return false to cancel form action
                            });


                        }else{
                            $('#seleccion_otro').html('');
                        }
                    });
                }

            });//end distruible

        });
    </script>

</head>
<body class="flickr-com">

<form method="post" name="nueva_erogacion" enctype="multipart/form-data" id="form">
<div id="body_bottom_bgd">
<div id="">
<div align="justify" id="right_col" >

<?php
if ( isset($_GET['error'])){

    if($_GET['error'] == 'false'){
        echo('<div id="done_app"><marquee scrolldelay="100">Datos Guardados Correctamente</marquee></div>');
    }else{
        echo('<div id="error_app"><marquee scrolldelay="120">El Campo Nombre es Requerido</marquee></div>');
    }
}

?>

<div id="header">
</div>
<div id="">
    <div id="firefoxbug"><!-- firefoxbug -->
        <!-- <div id="blue_line"></div>-->
        <div class="dynamicContent" align="left">
            <!-- <h1>Inicio</h1>-->
            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong> Módulo Costos y Gastos | Agregar Erogacion</strong></h1>

            <!-- Beginning of compulsory code below -->
            <br/><br/>



            <div class="formLayout">

                <label >Nombre</label>
                <input type="text" name="nombre"><br/>

                    <label for="distribuible">Distribuible</label>
                    <input type="checkbox" name="distribuible" id="distribuible" /><br/>

                <div id="informacion">

                </div>

                <div id="seleccion_otro">

                </div>

            </div>

            <table style="margin-top: 30px">
                <tr>
                    <td>
                        <input type="submit" value="Guardar datos" name="submit">
                    </td>
                    <td>
                        <a href="erogacion_ver.php"><input type="button" value="Ver Datos"></a>
                    </td>


                    <td>
                        <a href="../../cos_menu.php"><input type="button" value="Atras"></a>
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
