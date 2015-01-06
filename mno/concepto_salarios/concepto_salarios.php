<?php
$cedulaempleado ="";
$nombre="";
$apellido="";
$bnocturno=0;

include("../../db.php");
//$cedulaempleado =$_REQUEST['cedulaempleado'];

if ($cedulaempleado<>""){
    $sql = "select * from mrh_empleado where cedula=".$cedulaempleado;
    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);
    if (!$result){die("Error: Data not found..");}

    $nombre = $test['primernombre'];
    $apellido = $test['primerapellido'];
}
        

if (isset($_POST['submit']))
	{	   
	include("../../db.php");
    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');




        $validation = array(

            array('nombre' => 'codigo_empleado_hi',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'cedula_hi',
                'requerida' => true),

            array('nombre' => 'anhio',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'mes',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'semana',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'sueldo',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),

            array('nombre' => 'hed',
                'requerida' => false,
                'regla' => 'number'),

            array('nombre' => 'hen',
                'requerida' => false,
                'regla' => 'number'),

            array('nombre' => 'cticketa',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','),

            array('nombre' => 'dferiado',
                'requerida' => false,
                'regla' => 'number'),

        );

        $validated = new Validate($validation,$_POST);
        $validated->validate();


        if(!$validated->getIsError() && $_POST['mes'] != '0'){

            $codigo_empleado = $_POST['codigo_empleado_hi'];
            $cedula = $_POST['cedula_hi'];
            $anhio = $_POST['anhio'];
            $mes = $_POST['mes'];
            $semana = $_POST['semana'];
            $sueldo = $_POST['sueldo'];
            $hed = $_POST['hed'];
            $hen = $_POST['hen'];
            $cticketa = $_POST['cticketa'];
            $dferiado = $_POST['dferiado'];


            if($semana == '0'){

                $sueldo = str_replace(',','.',$sueldo);
              //  echo(($sueldo*12)/52);die;



                $sql = "SELECT * FROM mno_new_concepto_empleado
                      WHERE mes='$mes' AND anhio = '$anhio' AND codigo_concepto = '1'
                      AND codigo_empleado = '$codigo_empleado' AND eliminado='n' ";

                $result=mysql_query($sql);

                $test = mysql_fetch_array($result);

                if(mysql_fetch_array($result) !== false){
                    send_error_redirect(false);
                    die;
                }


                $sueldo_semanal = ($sueldo*12)/52;

                $semana_5 = 0;

                if(count(getMondays($anhio,$mes)) == 5){
                    $semana_5 = $sueldo_semanal;
                }

                $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,
                  semana_3,semana_4,semana_5,total,mes,anhio)
                VALUES
                ('$codigo_empleado','1','$sueldo_semanal',
                  '$sueldo_semanal','$sueldo_semanal','$sueldo_semanal','$semana_5','$sueldo',
                  '$mes','$anhio')";

                $result=mysql_query($sql);

                $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','3','$hed',
                  '$mes','$anhio')";

                $result=mysql_query($sql);

                $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','4','$hen',
                  '$mes','$anhio')";

                $result=mysql_query($sql);

                $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','5','$cticketa',
                  '$mes','$anhio')";

                $result=mysql_query($sql);



                $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','6','$dferiado',
                  '$mes','$anhio')";

                $result=mysql_query($sql);



            }else if($semana != '0'){



                $sql = "SELECT * FROM mno_new_concepto_empleado
                      WHERE mes='$mes' AND anhio = '$anhio' AND codigo_concepto = '1'
                      AND codigo_empleado = '$codigo_empleado' AND eliminado='n'";

                $result=mysql_query($sql);


                $str_semana = '';

                if($semana == '1'){
                    $str_semana = 'semana_1';
                }else if($semana == '2'){
                    $str_semana = 'semana_2';
                }else if($semana == '3'){
                    $str_semana = 'semana_3';
                }else if($semana == '4'){
                    $str_semana = 'semana_4';
                }else if($semana == '5'){
                    $str_semana = 'semana_5';
                }



                if(mysql_fetch_array($result) != true){

                    $sql = "INSERT INTO mno_new_concepto_empleado
                      (codigo_empleado,codigo_concepto,mes,anhio,".$str_semana.")
                      VALUE('$codigo_empleado','1','$mes','$anhio','$sueldo') ";

                    $result=mysql_query($sql);




                    $sql = "INSERT INTO mno_new_concepto_empleado
                      (codigo_empleado,codigo_concepto,mes,anhio,".$str_semana.")
                      VALUE('$codigo_empleado','3','$mes','$anhio','$hed') ";

                    $result=mysql_query($sql);

                    $sql = "INSERT INTO mno_new_concepto_empleado
                      (codigo_empleado,codigo_concepto,mes,anhio,".$str_semana.")
                      VALUE('$codigo_empleado','4','$mes','$anhio','$hen') ";

                    $result=mysql_query($sql);

                    $sql = "INSERT INTO mno_new_concepto_empleado
                      (codigo_empleado,codigo_concepto,mes,anhio,".$str_semana.")
                      VALUE('$codigo_empleado','5','$mes','$anhio','$cticketa') ";

                    $result=mysql_query($sql);

                    $sql = "INSERT INTO mno_new_concepto_empleado
                      (codigo_empleado,codigo_concepto,mes,anhio,".$str_semana.")
                      VALUE('$codigo_empleado','6','$mes','$anhio','$dferiado') ";

                    $result=mysql_query($sql);


                    send_error_redirect(false);

                }else{
                    $sql = "UPDATE mno_new_concepto_empleado
                        SET codigo_empleado='$codigo_empleado',
                        codigo_concepto='1',".$str_semana."='$sueldo'
                        WHERE mes='$mes' AND anhio='$anhio' AND codigo_concepto = '1'
                        AND codigo_empleado = '$codigo_empleado'";

                    $result=mysql_query($sql);


                    $sql = "UPDATE mno_new_concepto_empleado
                        SET codigo_empleado='$codigo_empleado',
                        codigo_concepto='3',".$str_semana."='$hed'
                        WHERE mes='$mes' AND anhio='$anhio' AND codigo_concepto = '3'
                        AND codigo_empleado = '$codigo_empleado'";

                    $result=mysql_query($sql);

                    $sql = "UPDATE mno_new_concepto_empleado
                        SET codigo_empleado='$codigo_empleado',
                        codigo_concepto='4',".$str_semana."='$hen'
                        WHERE mes='$mes' AND anhio='$anhio' AND codigo_concepto = '4'
                        AND codigo_empleado = '$codigo_empleado'";

                    $result=mysql_query($sql);

                    $sql = "UPDATE mno_new_concepto_empleado
                        SET codigo_empleado='$codigo_empleado',
                        codigo_concepto='5',".$str_semana."='$cticketa'
                        WHERE mes='$mes' AND anhio='$anhio' AND codigo_concepto = '5'
                        AND codigo_empleado = '$codigo_empleado'";

                    $result=mysql_query($sql);

                    $sql = "UPDATE mno_new_concepto_empleado
                        SET codigo_empleado='$codigo_empleado',
                        codigo_concepto='6',".$str_semana."='$dferiado'
                        WHERE mes='$mes' AND anhio='$anhio' AND codigo_concepto = '6'
                        AND codigo_empleado = '$codigo_empleado'";

                    $result=mysql_query($sql);


                    /**bonos*/
                    /* bono antiguedad */
                    $sql = "SELECT * FROM mno_empleado mrh_empleado WHERE codigo = ";



                    send_error_redirect(false);

                }

            }// fi $semana != '0'


        }else if($validated->getIsError() || $_POST['mes'] == '0' ){

            send_error_redirect(true);
        }


	mysql_close($conn);
       // }
        
        }	//post

if (isset($_POST['ver_turnos']))
	{	
            $bd_mostrar = 1;
            $codigo_empleado_hi = $_POST['codigo_empleado_hi'];
            if($codigo_empleado_hi==""){
                echo "<script type='text/javascript'>";
                echo "    alert('Debe seleccionar la cedula');";
                echo "</script>";  
                $bd_mostrar=0;
            }
            
            if ($bd_mostrar==1){
                header ("Location: concepto_salarios_ver.php?codigo=$codigo_empleado_hi");
            }
                
	}
	
	

function calcular_lunes($mes){
		include("../../db.php");
		$sql = "select count(codigomes) as nro_lunes from mrh_semana where codigomes=$mes";
        $resultin = mysql_query($sql);
        $field = mysql_fetch_array($resultin);
        if (!$resultin){die("Error: Data not found..");}
        $nro_lunes= $field['nro_lunes'];
        return $nro_lunes;
}
		
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
<link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery-ui-1.10.4.custom.js"></script>
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/sicap/resources/demos/style.css">

 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });

        $( "#buscar_empleado" ).click(function() {
            var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
            win.focus();
        });
    });
</script>    
<!-- Beginning of compulsory code below -->

<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>
<body class="flickr-com">

<p>&nbsp;</p>
<!-- Beginning of compulsory code below -->
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

 <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Conceptos de Salarios</strong></h1>
<form method="post" name="formulario">
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
<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">





    <TR>
        <TD><label>Cédula de Empleado</label></TD>
        <td> <input type="text" name="cedula"  disabled></td><td><input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
        </TD>

        <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
        <input type="hidden" name="cedula_hi" id="cedula_hi"/>
    </TR>




    <TR>


        <TD><label>Año</label></TD>
        <TD>
            <select name='anhio' id="anhio" >

                <?php $anhio = date('Y');
                echo('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
                echo('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
                echo('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
                echo('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
                echo('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');
                ?>
            </select>
        </TD>



        <TD><label>Mes</label></TD>
            <?php // consulta de los meses
        // Consultar la base de datos
                include("../../db.php");
                $consulta_mysql='select * from mrh_mes';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='mes' id='mes' onChange='cargasemana(this.value)'>";
                    echo "<option value='0'>------</option>";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigo']."'>".$fila['descripcion']."</option>";
                    }
                echo "</select>";
                echo "</TD>";
             ?>   

        <TD><label>Semana</label></TD>
        <TD>
           <select name='semana' id='semana'></select>
        </TD>
    </TR>

    <TR>
        <TD width="107"><label>Sueldo</label></TD>
        <TD width="98"><input type="text" name="sueldo" id="sueldo" size="20"></TD>
    </TR>



    <TR>
        <TD width="107"><label>Horas Extras Diurnas</label></TD>
        <TD width="98"><input type="text" name="hed" id="hed" size="20"></TD>
    </TR>
    <TR>
        <TD width="107"><label>Horas Extras Nocturnas</label></TD>
        <TD width="98"><input type="text" name="hen" id="hen" size="20"></TD>
    </TR>

    <TR>
        <TD width="107"><label>Cesta Ticket Adicional</label></TD>
        <TD width="98"><input type="text" name="cticketa" id="cticketa" size="20"></TD>
    </TR>
     <TR>
        <TD width="107" size="20"><label>Dias Feriados</label></TD>
        <TD width="98"><input type="text" name="dferiado" id="dferiado" size="20"></TD>
    </TR>
    
</TABLE>
<br/>
<TABLE>
<TR>
    <TD>
        <a><input type="Submit" name="ver_turnos" value="Ver Datos"></a> 
    </TD>
    <TD>
        <!--<input type="button" onClick="javascript: insertar()" name="asignar" value="Asignar Turno" >-->
        <a><input type="Submit" name="submit" value="Asignar Concepto"></a> 
    </TD>    
    <TD>
        <a href="/sicap/mno_menu.html"><input type="button" value="Atras"></a> 
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

function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {

	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}

if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

/*function insertar(){

	divResultado = document.getElementById('resultado');

	var	cedulaempleado = document.getElementById("cedulaempleado").value;
	var	codigomes = document.getElementById("mes").value;
        var	codigosemana = document.getElementById("semana").value;
        var	codigoturno = document.getElementById("turno").value;

  	alert(codigosemana);
	exit;

	ajax=objetoAjax();
	ajax.open("POST", "turnosxempleado_insertar.php",true);

	ajax.onreadystatechange=function() {
  	if (ajax.readyState==4) {
		divResultado.innerHTML = ajax.responseText
	}
 }

        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	trama="cedulaempleado="+cedulaempleado+
                "&codigomes="+codigomes+
                    "&codigosemana="+codigosemana+
                        "&codigoturno="+codigoturno;
        //alert(trama);
        //exit;
        ajax.send(trama);

	alert('Registro Guardado');


}*/

function buscar_empleado(){
    win = window.open("concepto_salarios_buscarempleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400");
    win.focus();
}


function cargasemana(str)
	{
		if (str=="")
		{
			document.getElementById("mes").innerHTML="";
			return;

			}

		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();

			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

				}

		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("semana").innerHTML=xmlhttp.responseText;

				}

			}
         var anhio = document.getElementById("anhio").value;

		xmlhttp.open("GET","/sicap/semana.php?codigomes="+str + "&anhio="+anhio ,true);

		xmlhttp.send();
	}
</script>
