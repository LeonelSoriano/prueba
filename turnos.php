<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>


<?php

include_once('clases/Validate.php');
include_once('clases/funciones.php');


$semaforo = 0;
$es_prosesado = false;
$horas_extras_nulas = false;

if(isset($_GET['semaforo'])){
    $semaforo = $_GET['semaforo'];
}

if(isset($_POST['nuevo_horario']))
{
    $semaforo = 1;
    $current_url = explode("?", $_SERVER['REQUEST_URI']);
    header('Location: '.$current_url[0].'?semaforo=1');


}


            $descripcion= "";
            $horaentrada = "";
            $horasalida = "";
            $horadescanso = "";					
            $diaslaborales = "";
            $horaextradiurno = "";
            $horaextranocturno = "";
            $horatdiario = "";
            $horatsemanal = "";
            $horatmensual = "";
            $totalhextras = "";
            $bononocdiario = "";
            $bononocsemanal = "";
            $bononocmensual = "";
            $hrsnocdiarias = "";
            $hrsnocsemanal = "";
            $hrsnocmensual = "";
            $hrslabpermitidas = "";
            $tipoturno = "";
           
if (isset($_POST['limpiar']))
	{
        $current_url = explode("?", $_SERVER['REQUEST_URI']);
        header('Location: '.$current_url[0]);
        }
            
if (isset($_POST['submit']))
	{

	include 'db.php';



        $validation = array(

            array('nombre' => 'descripcion',
                'requerida' => true
            ),


        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();




        if(!$validated->getIsError()){



            $bd_guardar = 1;
            $descripcion = $_POST['descripcion'];
            $horaentrada = $_POST['horaentrada'];

            $entradahorainicio = substr($horaentrada,0,2);
            $entradaminutosinicio =  substr($horaentrada,3,2)/60;
            $entradahorainicio = $entradahorainicio + $entradaminutosinicio;
            //echo $entradahorainicio;


            $horasalida = $_POST['horasalida'];

            $salidahorafin = substr($horasalida,0,2);
            $salidaminutosfin =  substr($horasalida,3,2)/60;
            $salidahorafin = $salidahorafin + $salidaminutosfin;
            //echo $salidahorafin;


            $horadescanso = $_POST['horadescanso'];
            //$tipoturno = $_POST['tipoturno'];
            $diaslaborales = $_POST['diaslaborales'];

            $horaextradiurno = $_POST['horasextradiurno'];

            $horaextranocturno = $_POST['horasextranocturno'];

            $resultadoextras = $horaextradiurno + $horaextranocturno;

            $horatdiario = calcularhoratdiario($entradahorainicio,$salidahorafin,$horadescanso) - $horadescanso;


            $horatsemanal = $horatdiario * $diaslaborales;

            $horatmensual = $horatsemanal * 5;

            $tipoturno = buscarturno($entradahorainicio,$salidahorafin);

            $hrslabpermitidas = calcularextras($tipoturno);

            $totalhextras =  horasextras($hrslabpermitidas,$horatsemanal);

            if ($resultadoextras>$totalhextras){
                echo "<script type='text/javascript'>";
                echo "    alert('La suma de horas extras no puede exceder a las calculadas');";
                echo "</script>";
                $bd_guardar = 0;

            }
            elseif ($resultadoextras<>$totalhextras){
                echo "<script type='text/javascript'>";
                echo "    alert('Las horas extras deben ser iguales a las calculadas');";
                echo "</script>";
                $bd_guardar = 0;

            }
            $hrsnocdiarias = horasnocturnas($entradahorainicio,$salidahorafin,$horatdiario);

            $hrsnocsemanal = $hrsnocdiarias * $diaslaborales;

            $hrsnocmensual = $hrsnocsemanal * 5;

            $bononocdiario = $hrsnocdiarias;

            $bononocsemanal = $hrsnocsemanal;

            $bononocmensual = $hrsnocmensual;

            if ($bd_guardar==1){
                $sql = "insert into mrh_turnos(descripcion,horaentrada,horasalida,horadescanso,descripciontipoturno,
                            diaslaborales,horaextradiurno,horaextranocturno,horatdiario,
                              horatsemana,horatmensual,totalhrsextra,hrsnocdiarias,
                                hrsnocsemanal,hrsnocmensual,hrslabpermitidas,bononocdiario,
                                    bononocsemanal,bononocmensual)
                 VALUES('$descripcion','$horaentrada','$horasalida','$horadescanso','$tipoturno',
                            '$diaslaborales','$horaextradiurno','$horaextranocturno',
                                    '$horatdiario','$horatsemanal','$horatmensual','$totalhextras',
                                            '$hrsnocdiarias','$hrsnocsemanal','$hrsnocmensual',
                                                    '$hrslabpermitidas','$bononocdiario','$bononocsemanal',
                                                            '$bononocmensual')";
                //echo $sql;
                //exit;
                mysql_query($sql);

                echo "<script type='text/javascript'>";
                echo "    alert('Registro Almacenado');";
                echo "</script>";
            }

            send_error_redirect(false);
            die;

        }else if($validated->getIsError()){

            send_error_redirect(true);
            die;
        }



				
}

if (isset($_POST['procesar']))
	{

            $descripcion = $_POST['descripcion'];
            $horaentrada = $_POST['horaentrada'];
            
            $entradahorainicio = substr($horaentrada,0,2);
            $entradaminutosinicio =  substr($horaentrada,3,2)/60;
            $entradahorainicio = $entradahorainicio + $entradaminutosinicio;
            //echo $entradahorainicio;
            
            
            $horasalida = $_POST['horasalida'];
            
            $salidahorafin = substr($horasalida,0,2);
            $salidaminutosfin =  substr($horasalida,3,2)/60;
            $salidahorafin = $salidahorafin + $salidaminutosfin;
            //echo $salidahorafin;
            
            
            $horadescanso = $_POST['horadescanso'];					
            //$tipoturno = $_POST['tipoturno'];
            $diaslaborales = $_POST['diaslaborales'];
            
            if ($diaslaborales==0){
                echo "<script type='text/javascript'>";
                echo "    alert('Los días laborales deben estar entre 1 y 5');";
                echo "</script>";
                $es_prosesado = true;
                $semaforo = 1;
            }
            if ($diaslaborales>5){
                echo "<script type='text/javascript'>";
                echo "    alert('La LOTTT establece maximo 5 días');";
                echo "</script>";  
                $diaslaborales =0;
                $semaforo = 1;
                $es_prosesado = true;
            }
            
            
            $horaextradiurno = 0;
            $horaextranocturno = 0;

            if(isset($_POST['horasextradiurno'])){
                $horaextradiurno = $_POST['horasextradiurno'];
            }


            if(isset($_POST['horasextradiurno'])){
                $horaextranocturno = $_POST['horasextranocturno'];
            }

            $horatdiario = calcularhoratdiario($entradahorainicio,$salidahorafin,$horadescanso) - $horadescanso; 
                    
            
            $horatsemanal = $horatdiario * $diaslaborales;
            
            $horatmensual = $horatsemanal * 5;
            
            $tipoturno = buscarturno($entradahorainicio,$salidahorafin);
            
            $hrslabpermitidas = calcularextras($tipoturno);
            
            $totalhextras =  horasextras($hrslabpermitidas,$horatsemanal);
            if($totalhextras==0){
                    $horaextradiurno = 0;
                    $horaextranocturno = 0;
                $horas_extras_nulas = true;

            }
            
            $hrsnocdiarias = horasnocturnas($entradahorainicio,$salidahorafin,$horatdiario);
            
            $hrsnocsemanal = $hrsnocdiarias * $diaslaborales;
            
            $hrsnocmensual = $hrsnocsemanal * 5;
            
            $bononocdiario = $hrsnocdiarias;
            
            $bononocsemanal = $hrsnocsemanal;
            
            $bononocmensual = $hrsnocmensual;


            
        }

function horasextras($hpermitida,$hsemanal){
    if ($hpermitida>=$hsemanal){
        $resultado = 0;
        return $resultado;
    }
    elseif($hpermitida<$hsemanal){
        $resultado = $hsemanal - $hpermitida;
        return $resultado;
    }
}
        
function horasnocturnas($horain,$horaout,$horas){
        include 'db.php';
    	$result=mysql_query("SELECT * FROM mrh_tipoturno Where descripcion = 'D'");
        while($test = mysql_fetch_array($result))
        	{
                  
                    $horainicioturno = $test['horainicio'];
                    $horafinturno = $test['horafin'];
                    $horainicio = substr($horainicioturno,0,2);
                    $minutosinicio =  substr($horainicioturno,3,2)/60;


                    $HI = $horainicio + $minutosinicio;
                    
                    $horafin = substr($horafinturno,0,2);
                    $minutosfin = substr($horafinturno,3,2)/60;
                    $HO = $horafin + $minutosfin;


                }

        if ($horain==$horaout){
               $tipoturno = "N"; 
        }
        elseif(($horain>=$HI)AND($horain<=$HO)AND($horaout<$HI)){
                    $tipoturno = "N";
       
        }
        elseif(($horain>=$HI)AND($horain<=$HO)AND($horaout>=$HI)){
                $resultado = $horaout - $HO;
                if($resultado>=4){
                    $tipoturno = "N";
   
                }
                elseif(($resultado>0)AND($resultado<4)){
                    $tipoturno = "M";
                }
        }
        elseif(($horain<$HI)AND($horaout>=$HI)AND($horaout<=$HO)){
                $resultado = $HI - $horain;
                if($resultado>=4){
                    $tipoturno = "N";
                }
                elseif(($resultado>0)AND($resultado<4)){
                    $tipoturno = "M";
                }
        }       
        elseif(($horain>=$HO)AND($horaout>=$HI)AND($horaout<=$HO)){
                   $tipoturno = "N";
        }  
        elseif(($horain<$HO)AND($horaout>=$HI)AND($horaout<=$HO)){
                $resultado = $HI - $horain;
                if($resultado>=4){
                    $tipoturno = "N";
                }
                elseif(($resultado>0)AND($resultado<4)){
                    $tipoturno = "M";
                }
        }
        if(($horain>=$HI)AND($horain<=$HO)AND($horaout>=$HI)AND($horaout<=$HO)){
            //echo "turno diurno";
            $tipoturno = "D";
        }   
        
//        echo $horain;
//        echo "-";
//        echo $horaout;
//        echo "****";
//        echo $HI;
//        echo "-";
//        echo $HO;
        
        if ($horain==$horaout){
            $resultado = 10;
        }
        elseif(($tipoturno=="M")){
            if($horain<$HI){
                $resultado = $HI - $horain;
 
            }
            elseif($horaout>$HO){
                $resultado = $horaout - $HO;
 
            }
            else{
                $resultado=0;
            }
        }
        elseif ($tipoturno=="N"){
			//$resultado = $horas;
            if($horain<$HI){
                $resultado = $HI - $horain;

            }
            //esto lo movi porq es donde se calculan horas nocturnas
		}
        else{
            $resultado=0;
        }
        
		
return $resultado;
}



function calcularextras($valor){
        include 'db.php';

        $result=mysql_query("SELECT * FROM mrh_tipoturno Where descripcion = '$valor'");
        
        while($test = mysql_fetch_array($result))
        	{
                    $resultado = $test['horasemanales'];
                }   
                
        return $resultado;
}
        
function diaL($mes)    {
    if(trim($mes)!="")    {
        $cant_dias = date('t',strtotime(date('Y').$mes.'-'.'01-'));
        $lunes = 0;
        for($i=1; $i<=$cant_dias; $i++)    {
            if(date('w',strtotime(date('Y').'-'.$mes.'-'.$i))==6)    {
                $lunes++;
            }
        }
        
        return $lunes;
    }else    {
        return 'Malll';
    }
}

function buscarturno($horain,$horaout){
        include 'db.php';
        $tipoturno ="";
    	$result=mysql_query("SELECT * FROM mrh_tipoturno Where descripcion = 'L'");
        while($test = mysql_fetch_array($result))
        	{
                  
                    $horainicioturno = $test['horainicio'];
                    $horafinturno = $test['horafin'];
                    $horainicio = substr($horainicioturno,0,2);
                    $minutosinicio =  substr($horainicioturno,3,2)/60;
                    
                    $HI = $horainicio + $minutosinicio;
                    
                    $horafin = substr($horafinturno,0,2);
                    $minutosfin = substr($horafinturno,3,2)/60;
                    $HO = $horafin + $minutosfin;
//                    echo $horain;
//                    echo "-";
//                    echo $HI;
//                    echo "-";
//                    echo $horaout;
//                    echo "-";
//                    echo $HO;
                    

                    
                    //echo $horafinturno;
                    //echo $horassemanalesturno;
                }
        
        if ($horain==$horaout){
               $tipoturno = "N"; 
               return $tipoturno;
        }
        elseif(($horain>=$HI)AND($horain<=$HO)AND($horaout<$HI)){
                    $tipoturno = "N";
                    return $tipoturno;
        }
        elseif(($horain>=$HI)AND($horain<=$HO)AND($horaout>=$HI)){
                $resultado = $horaout - $HO;
                if($resultado>=4){
                    $tipoturno = "N";
                    return $tipoturno;
                }
                elseif(($resultado>0)AND($resultado<4)){
                    $tipoturno = "M";
                    return $tipoturno;
                }
        }
        elseif(($horain<$HI)AND($horaout>=$HI)AND($horaout<=$HO)){
                $resultado = $HI - $horain;
                if($resultado>=4){
                    $tipoturno = "N";
                    return $tipoturno;
                }
                elseif(($resultado>0)AND($resultado<4)){
                    $tipoturno = "M";
                    return $tipoturno;
                }
        }       
        elseif(($horain>=$HO)AND($horaout>=$HI)AND($horaout<=$HO)){
                   $tipoturno = "N";
                   return $tipoturno;
        }  
        elseif(($horain<$HO)AND($horaout>=$HI)AND($horaout<=$HO)){
                $resultado = $HI - $horain;
                if($resultado>=4){
                    $tipoturno = "N";
                    return $tipoturno;
                }
                elseif(($resultado>0)AND($resultado<4)){
                    $tipoturno = "M";
                    return $tipoturno;
                }
        }
        if(($horain>=$HI)AND($horain<=$HO)AND($horaout>=$HI)AND($horaout<=$HO)){
            //echo "turno diurno";
            $tipoturno = "D";
            return $tipoturno;
        }       
        
 
     }
        
function calcularhoratdiario($horain,$horaout,$horasleep){
    
    if($horain==$horaout){
        $resultado = 24;
    }
    elseif ($horain>$horaout){
        $horain = 24 - $horain;
        $resultado = $horaout + $horain;
    }
    else{
        $resultado = $horaout - $horain;
    }
 return $resultado;
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
<link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<script src="js/htmlDatePicker.js" type="text/javascript"></script>
<link href="css/htmlDatePicker.css" rel="stylesheet">
<!-- Beginning of compulsory code below -->
<link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
<link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-1.10.2.js"></script>


<script>

    $(function() {
//        $('#guardar_datos').hide();
        $('#guardar_datos').click(function(event){
           // var isValid = true;


            var  pre_horasextradiurno=0;
            var pre_horasextranocturno=0;


            if($('#horasextradiurno').val() == ''){

                pre_horasextradiurno = 0;
            }else{
                pre_horasextradiurno =  $('#horasextradiurno').val();
            }


            if($('#horasextranocturno').val() == ''){
                pre_horasextranocturno = 0;
            }else{
                pre_horasextranocturno =  $('#horasextranocturno').val();
            }



            if(isNaN(parseInt(pre_horasextranocturno))   ||
                isNaN(parseInt(pre_horasextradiurno))  ){
                alert("solo numeros en los campos de Horas Extra Diurno  y/o Horas Extra Nocturno ");
                event.preventDefault();
                return;
            }


            var horas_extras = parseInt( $('#totalhextras').val());

            var horasextradiurno  = parseInt($('#horasextradiurno').val());
            var horasextranocturno = parseInt($('#horasextranocturno').val());



            //alert(horasextradiurno + horasextranocturno);

            if(horas_extras == horasextradiurno + horasextranocturno){



            }else{
                alert('Total Hrs Extras debe ser Igual a la Suma de Horas Extras Diurna y Nocturna');
                event.preventDefault();
            }

        });

    });
</script>

</head>


<body class="flickr-com">

<form method="post"  id="formulario" action="turnos.php<?php if($semaforo == 1 || $semaforo == 2 && !$es_prosesado){echo('?semaforo=2');} ?>">
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
<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Turnos</strong></h1>

<!-- Beginning of compulsory code below -->
<form method="post">
<br/>
<TD><TABLE BORDER="0" CELLSPACING="1" WIDTH="700">

     <TR>

         <?php

            if($semaforo == 0){
                echo('          <TD width="181"><label>Turno (*)</label></TD>
          <TD width="400"><p><input type="text" name="descripcion" id="descripcion" size="10"value="'.$descripcion.'" disabled></p></TD>');
            }else if($semaforo == 1 || $semaforo == 2){
                echo('          <TD width="181"><label>Turno (*)</label></TD>
          <TD width="400"><p><input type="text" name="descripcion" id="descripcion" size="10"value="'.$descripcion.'" ></p></TD>');
            }

         ?>


          
          <TD ><label>Hora de T. Diario</label></TD>
          <TD width="400"><p><input type="text" name="horatdiario" id="horatdiario" size="10" value="<?php echo $horatdiario;?>" disabled></p></TD>
     
          <TD width="181"><label>Bono Noc Diario</label></TD>
          <TD width="400"><p><input type="text" name="bononocdiario" id="bononocdiario" size="10" value="<?php echo $bononocdiario;?>" disabled></p></TD>
     
     </TR> 
     <TR>
          <TD><label>Hora de Entrada (*)</label></TD>
	  <TD>
	  <select id="horaentrada" name="horaentrada" id="horaentrada" <?php if($semaforo == 0){echo('disabled');} ?>>
                                <option value="<?php echo $horaentrada;?>"><?php echo $horaentrada;?></option>
                                <option value="00:00">00:00</option>
                                <option value="00:30">00:30</option>
				<option value="01:00">01:00</option>
				<option value="01:30">01:30</option>	
				<option value="02:00">02:00</option>
				<option value="02:30">02:30</option>
				<option value="03:00">03:00</option>
				<option value="03:30">03:30</option>
				<option value="04:00">04:00</option>
				<option value="04:30">04:30</option>
                <option value="05:00">05:00</option>
                <option value="05:30">05:30</option>
				<option value="06:00">06:00</option>
				<option value="06:30">06:30</option>
				<option value="07:00">07:00</option>
				<option value="07:30">07:30</option>
				<option value="08:00">08:00</option>
				<option value="08:30">08:30</option>
				<option value="09:00">09:00</option>
				<option value="09:30">09:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
				<option value="11:00">11:00</option>
				<option value="11:30">11:30</option>
				<option value="12:00">12:00</option>
				<option value="12:30">12:30</option>
				<option value="13:00">13:00</option>
				<option value="13:30">13:30</option>
				<option value="14:00">14:00</option>
				<option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
				<option value="16:00">16:00</option>
				<option value="16:30">16:30</option>
				<option value="17:00">17:00</option>
				<option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
				<option value="19:00">19:00</option>
				<option value="19:30">19:30</option>
				<option value="20:00">20:00</option>
				<option value="20:30">20:30</option>
				<option value="21:00">21:00</option>
				<option value="21:30">21:30</option>
				<option value="22:00">22:00</option>
				<option value="22:30">22:30</option>
				<option value="23:00">23:00</option>
				<option value="23:30">23:30</option>
	  </select>
	  </TD>
          <!--<TD><p><input type="text" name="horaentrada" id="horaentrada" size="10" value="<?php echo $horaentrada;?>"></p></TD>-->
     
          
          <TD><label>Hora de T. Sem.</label></TD>
          <TD><p><input type="text" name="horatsemanal" id="horatsemanal" size="10" value="<?php echo $horatsemanal;?>" disabled></p></TD>
     
          <TD width="181"><label>Bono Noc Semanal</label></TD>
          <TD width="400"><p><input type="text" name="bononocsemanal" id="bononocsemanal" size="10" value="<?php echo $bononocsemanal;?>" disabled></p></TD>
     
     </TR> 
     <TR>
          <!--<TD><label>Hora de Salida (*)</label></TD>
          <TD><p><input type="text" name="horasalida" id="horasalida" size="10" value="<?php echo $horasalida;?>"></p></TD>-->
          
          <TD><label>Hora de Salida (*)</label></TD>
	  <TD>
	  <select id="horasalida" name="horasalida" id="horasalida" <?php if($semaforo == 0){echo('disabled');} ?>>
                                <option value="<?php echo $horasalida;?>"><?php echo $horasalida;?></option>
                                <option value="00:00">00:00</option>
                                <option value="00:30">00:30</option>
				<option value="01:00">01:00</option>
				<option value="01:30">01:30</option>	
				<option value="02:00">02:00</option>
				<option value="02:30">02:30</option>
				<option value="03:00">03:00</option>
				<option value="03:30">03:30</option>
				<option value="04:00">04:00</option>
				<option value="04:30">04:30</option>
                                <option value="05:00">05:00</option>
                                <option value="05:30">05:30</option>
				<option value="06:00">06:00</option>
				<option value="06:30">06:30</option>
				<option value="07:00">07:00</option>

				<option value="07:30">07:30</option>
				<option value="08:00">08:00</option>
				<option value="08:30">08:30</option>
				<option value="09:00">09:00</option>
				<option value="09:30">09:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
				<option value="11:00">11:00</option>
				<option value="11:30">11:30</option>
				<option value="12:00">12:00</option>
				<option value="12:30">12:30</option>
				<option value="13:00">13:00</option>
				<option value="13:30">13:30</option>
				<option value="14:00">14:00</option>
				<option value="14:30">14:30</option>
                                <option value="15:00">15:00</option>
                                <option value="15:30">15:30</option>
				<option value="16:00">16:00</option>

				<option value="16:30">16:30</option>
				<option value="17:00">17:00</option>
				<option value="17:30">17:30</option>
                                <option value="18:00">18:00</option>
                                <option value="18:30">18:30</option>
				<option value="19:00">19:00</option>
				<option value="19:30">19:30</option>
				<option value="20:00">20:00</option>
				<option value="20:30">20:30</option>
				<option value="21:00">21:00</option>
				<option value="21:30">21:30</option>
				<option value="22:00">22:00</option>
				<option value="22:30">22:30</option>
				<option value="23:00">23:00</option>
				<option value="23:30">23:30</option>
	  </select>
	  </TD>

          <TD><label>Hora de T. Men.</label></TD>
          <TD><p><input type="text" name="horatmensual" id="horatmensual" size="10" value="<?php echo $horatmensual;?>" disabled></p></TD>
     
          <TD width="181"><label>Bono Noc Mensual</label></TD>
          <TD width="400"><p><input type="text" name="bononocmensual" id="bononocmensual" size="10" value="<?php echo $bononocmensual;?>" disabled></p></TD>
     
     </TR> 
    <TR>

        <?php

        if($semaforo == 0){
            echo('<TD><label>Hora de Descanso (*)</label></TD>
          <TD><p><input type="text" name="horadescanso" id="horadescanso" size="10" value="'.$horadescanso.'" disabled></p></TD>');
        }else if($semaforo == 1 || $semaforo == 2){
            echo('          <TD><label>Hora de Descanso (*)</label></TD>
          <TD><p><input type="text" name="horadescanso" id="horadescanso" size="10" value="'.$horadescanso.'"></p></TD>');
        }

        ?>


          <TD><label>Total Hrs Extras</label></TD>
          <TD><p><input type="text" name="totalhextras" id="totalhextras" size="10" value="<?php echo $totalhextras;?>" disabled></p></TD>
               
     </TR>
    <TR>
         <TD><label>Tipo de Turno</label></TD>    
         <TD><p><input type="text" name="tipoturno" id="tipoturno" size="10" value="<?php echo $tipoturno;?>" disabled></p></td>
        
         <TD><label>Hrs Noc Diarias</label></TD>
         <TD><p><input type="text" name="hrsnocdiarias id="hrsnocdiarias" size="10" value="<?php echo $hrsnocdiarias;?>" disabled></p></TD>
           
    </TR>
    <TR>


        <?php

        if($semaforo == 0){
            echo('          <TD><label>Dias Laborales (*)</label></TD>
          <TD><p><input type="text" name="diaslaborales" id="diaslaborales" size="10" value="'.$diaslaborales.'" disabled></p> </TD>');
        }else if($semaforo == 1 || $semaforo == 2){
            echo('          <TD><label>Dias Laborales (*)</label></TD>
          <TD><p><input type="text" name="diaslaborales" id="diaslaborales" size="10" value="'.$diaslaborales.'" ></p> </TD>');
        }

        ?>




          
          <TD><label>Hrs Noc Semanal</label></TD>
          <TD><p><input type="text" name="hrsnocsemanal" id="hrsnocsemanal" size="10" value="<?php echo $hrsnocsemanal;?>" disabled></p></TD>
           
    </TR>
    <TR>

        <?php

        if($semaforo == 0 || $semaforo == 1 || $horas_extras_nulas){
            echo('          <TD><label>Horas Extra Diurno (*)</label></TD>
          <TD><p><input type="text" name="horasextradiurno" id="horasextradiurno" size="10" value="'.$horaextradiurno.'" disabled></p></TD>');
        }else if($semaforo == 2){
            echo('          <TD><label>Horas Extra Diurno (*)</label></TD>
          <TD><p><input type="text" name="horasextradiurno" id="horasextradiurno" size="10" value="'.$horaextradiurno.'" ></p></TD>');
        }

        ?>



     
          <TD><label>Hrs Noc Mensual</label></TD>
          <TD><p><input type="text" name="hrsnocmensual" id="hrsnocmensual" size="10" value="<?php echo $hrsnocmensual;?>" disabled></p></TD>
           
    </TR>
    <TR>

        <?php

        if($semaforo == 0 || $semaforo == 1 || $horas_extras_nulas){
            echo('          <TD><label>Horas Extra Nocturno (*)</label></TD>
          <TD><p><input type="text" name="horasextranocturno" id="horasextranocturno" size="10" value="'.$horaextranocturno.'" disabled></p></TD>');
        }else if($semaforo == 2){
            echo('          <TD><label>Horas Extra Nocturno (*)</label></TD>
          <TD><p><input type="text" name="horasextranocturno" id="horasextranocturno" size="10" value="'.$horaextranocturno.'" ></p></TD>');
        }

        ?>


   
          <TD><label>Hrs Lab Permitidas</label></TD>
          <TD><p><input type="text" name="hrslabpermitidas" id="hrslabpermitidas" size="10" value="<?php echo $hrslabpermitidas;?>" disabled></p></TD>
           
    </TR>
    

</TABLE>

<br/>

<div>Los Campos Numericos deben ser expresados con punto (.)</div>
<br/>
<div>Los Campos  con (*) son Obligatorios</div>
<br/>
<?php echo('<div> La Suma de Horas Extra Diurno y Horas Extra Nocturno no Deben de Ser mayores a Total Hrs Extras </div>'); ?>
<br/>

<TABLE>
    <TR>




        <?php

            if($semaforo == 0){
                echo('<td><input name="nuevo_horario"   type="submit" value="ingresar Nuevo Horario"/></td>');
                echo('<TD><input type="submit" value="Procesar" name="procesar" disabled></TD>');
                echo('<TD><input type="submit" value="Guardar datos" name="submit" id="guardar_datos" disabled></TD>');
            }else if($semaforo == 1){
                echo('<td><input name="nuevo_horario"   type="submit" value="ingresar Nuevo Horario" disabled/></td>');
                echo('<TD><input type="submit" value="Procesar" name="procesar" ></TD>');
                echo('<TD><input type="submit" value="Guardar datos" name="submit" id="guardar_datos" disabled></TD>');
            }else if($semaforo == 2){
                echo('<td><input name="nuevo_horario"   type="submit" value="ingresar Nuevo Horario" disabled/></td>');
                echo('<TD><input type="submit" value="Procesar" name="procesar" ></TD>');
                echo('<TD><input type="submit" value="Guardar datos" name="submit" id="guardar_datos" ></TD>');
            }




        ?>


        <TD><a href="turnos_ver.php"><input type="button" value="Ver datos"></a> </TD>
        <TD><a href="mrh_menu.php"><input type="button" value="Atras"></a></TD>
        <TD><input type="submit" value="Limpiar" name="limpiar" id="limpiar"></TD>
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
