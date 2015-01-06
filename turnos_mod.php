<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
       
require("db.php");
$id =$_REQUEST['codigo'];
$sql = "SELECT * FROM mrh_turnos WHERE codigo  = '$id'";
//echo $sql;
$result = mysql_query($sql);
$test = mysql_fetch_array($result);
if (!$result) 
    {
        die("Error: Data not found..");
    }
        $descripcion = $test['descripcion'];
        $horaentrada = $test['horaentrada'];
        $horasalida = $test['horasalida'];
        $horadescanso = $test['horadescanso'];
        $tipoturno = $test['descripciontipoturno'];
        $diaslaborales = $test['diaslaborales'];
        $horaextradiurno = $test['horaextradiurno'];
        $horaextranocturno = $test['horaextranocturno'];
        $horatdiario = $test['horatdiario'];
        $horatsemanal = $test['horatsemana'];
        $horatmensual = $test['horatmensual'];
        $totalhextras = $test['totalhrsextra'];
        $hrsnocdiarias = $test['hrsnocdiarias'];
        $hrsnocsemanal = $test['hrsnocsemanal'];
        $hrsnocmensual =$test['hrsnocmensual'];
        $hrslabpermitidas = $test['hrslabpermitidas'];
        $bononocdiario = $test['bononocdiario'];
        $bononocsemanal = $test['bononocsemanal'];
        $bononocmensual = $test['bononocmensual'];     
    	
                
if(isset($_POST['submit']))
{	


        
include 'db.php';
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
                $horaextradiurno = 0;
                $horaextranocturno = 0;
            }
            elseif ($resultadoextras<>$totalhextras){
                echo "<script type='text/javascript'>";
                echo "    alert('Las horas extras deben ser iguales a las calculadas');";
                echo "</script>";    
                $bd_guardar = 0;

            }
            $hrsnocdiarias = horasnocturnas($entradahorainicio,$salidahorafin);
            
            $hrsnocsemanal = $hrsnocdiarias * $diaslaborales;
            
            $hrsnocmensual = $hrsnocsemanal * 5;
            
            $bononocdiario = $hrsnocdiarias;
            
            $bononocsemanal = $hrsnocsemanal;
            
            $bononocmensual = $hrsnocmensual;

        if ($bd_guardar==1){
	mysql_query("UPDATE mrh_turnos SET 
                        descripcion = '$descripcion',
                        horaentrada = '$horaentrada',
                        horasalida = '$horasalida',
                        horadescanso = '$horadescanso',
                        descripciontipoturno = '$tipoturno',
                        diaslaborales = '$diaslaborales',
                        horaextradiurno = '$horaextradiurno',
                        horaextranocturno = '$horaextranocturno',
                        horatdiario = '$horatdiario',
                        horatsemana = '$horatsemanal',
                        horatmensual = '$horatmensual',
                        totalhrsextra = '$totalhextras',
                        hrsnocdiarias = '$hrsnocdiarias',
                        hrsnocsemanal = '$hrsnocsemanal',
                        hrsnocmensual ='$hrsnocmensual',
                        hrslabpermitidas = '$hrslabpermitidas',
                        bononocdiario = '$bononocdiario',
                        bononocsemanal = '$bononocsemanal',
                        bononocmensual = '$bononocmensual'
                    WHERE codigo = '$id'")
				or die(mysql_error()); 
	echo "Guardado";
	
	header("Location: turnos_ver.php");			
        }
}
mysql_close($conn);
?> 

<?php

          
if (isset($_POST['limpiar']))
	{	
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
            }
            if ($diaslaborales>5){
                echo "<script type='text/javascript'>";
                echo "    alert('La LOTTT establece maximo 5 días');";
                echo "</script>";  
                $diaslaborales =0;
            }
            
            
            $horaextradiurno = $_POST['horasextradiurno'];
            $horaextranocturno = $_POST['horasextranocturno'];   
    
            $horatdiario = calcularhoratdiario($entradahorainicio,$salidahorafin,$horadescanso) - $horadescanso; 
                    
            
            $horatsemanal = $horatdiario * $diaslaborales;
            
            $horatmensual = $horatsemanal * 5;
            
            $tipoturno = buscarturno($entradahorainicio,$salidahorafin);
            
            $hrslabpermitidas = calcularextras($tipoturno);
            
            $totalhextras =  horasextras($hrslabpermitidas,$horatsemanal);
            
            $hrsnocdiarias = horasnocturnas($entradahorainicio,$salidahorafin);
            
            $hrsnocsemanal = $hrsnocdiarias * $diaslaborales;
            
            $hrsnocmensual = $hrsnocsemanal * 5;
            
            $bononocdiario = $hrsnocdiarias;
            
            $bononocsemanal = $hrsnocsemanal;
            
            $bononocmensual = $hrsnocmensual;
            
            
        }

function horasextras($hpermitida,$hsemanal){
    if ($hpermitida>$hsemanal){
        $resultado = 0;
        return $resultado;
    }
    elseif($hpermitida<$hsemanal){
        $resultado = $hsemanal - $hpermitida;
        return $resultado;
    }
}
        
function horasnocturnas($horain,$horaout){
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
        
        /*echo $horain;
        echo "-";
        echo $horaout;
        echo "****";
        echo $HI;
        echo "-";
        echo $HO;*/
        
        if ($horain==$horaout){
            $resultado = 10;
        }
        elseif(($tipoturno=="M")OR($tipoturno=="N")){
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
                    //echo $horain;
                    //echo "-";
                    //echo $HI;
                    //echo "-";
                    //echo $horaout;
                    //echo "-";
                    //echo $HO;
                   

                    
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

<!-- / END -->

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
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
<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Turnos</strong></h1>

<!-- Beginning of compulsory code below -->
<form method="post">

<TD><TABLE BORDER="0" CELLSPACING="1" WIDTH="588">

     <TR>
          <TD width="181"><label>Turno (*)</label></TD>
          <TD width="400"><p><input type="text" name="descripcion" id="descripcion" size="10"value="<?php echo $descripcion;?>" ></p></TD>
          
          <TD width="181"><label>Hora de T. Diario</label></TD>
          <TD width="400"><p><input type="text" name="horatdiario" id="horatdiario" size="10" value="<?php echo $horatdiario;?>" disabled></p></TD>
     
          <TD width="181"><label>Bono Noc Diario</label></TD>
          <TD width="400"><p><input type="text" name="bononocdiario" id="bononocdiario" size="10" value="<?php echo $bononocdiario;?>" disabled></p></TD>
     
     </TR> 
     <TR>
          <TD><label>Hora de Entrada (*)</label></TD>
	  <TD>
	  <select id="horaentrada" name="horaentrada" id="horaentrada" >
                                <option value="<?php echo $horaentrada;?>"><?php echo $horaentrada;?></option>
                                <option value="00:00">00:00</option>
				<option value="01:00">01:00</option>
				<option value="02:00">02:00</option>
				<option value="03:00">03:00</option>
				<option value="04:00">04:00</option>
                                <option value="05:00">05:00</option>
				<option value="06:00">06:00</option>
				<option value="07:00">07:00</option>
				<option value="08:00">08:00</option>
				<option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
				<option value="11:00">11:00</option>
				<option value="12:00">12:00</option>
				<option value="13:00">13:00</option>
				<option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
				<option value="16:00">16:00</option>
				<option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
				<option value="19:00">19:00</option>
				<option value="20:00">20:00</option>
				<option value="21:00">21:00</option>
				<option value="22:00">22:00</option>
				<option value="23:00">23:00</option>
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
	  <select id="horasalida" name="horasalida" id="horasalida" >
                                <option value="<?php echo $horasalida;?>"><?php echo $horasalida;?></option>
                                <option value="00:00">00:00</option>
				<option value="01:00">01:00</option>
				<option value="02:00">02:00</option>
				<option value="03:00">03:00</option>
				<option value="04:00">04:00</option>
                                <option value="05:00">05:00</option>
				<option value="06:00">06:00</option>
				<option value="07:00">07:00</option>
				<option value="08:00">08:00</option>
				<option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
				<option value="11:00">11:00</option>
				<option value="12:00">12:00</option>
				<option value="13:00">13:00</option>
				<option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
				<option value="16:00">16:00</option>
				<option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
				<option value="19:00">19:00</option>
				<option value="20:00">20:00</option>
				<option value="21:00">21:00</option>
				<option value="22:00">22:00</option>
				<option value="23:00">23:00</option>
	  </select> 
	  </TD>

          <TD><label>Hora de T. Men.</label></TD>
          <TD><p><input type="text" name="horatmensual" id="horatmensual" size="10" value="<?php echo $horatmensual;?>" disabled></p></TD>
     
          <TD width="181"><label>Bono Noc Mensual</label></TD>
          <TD width="400"><p><input type="text" name="bononocmensual" id="bononocmensual" size="10" value="<?php echo $bononocmensual;?>" disabled></p></TD>
     
     </TR> 
    <TR>
          <TD><label>Hora de Descanso (*)</label></TD>
          <TD><p><input type="text" name="horadescanso" id="horadescanso" size="10" value="<?php echo $horadescanso;?>"></p></TD>
          
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
          <TD><label>Dias Laborales (*)</label></TD>
          <TD><p><input type="text" name="diaslaborales" id="diaslaborales" size="10" value="<?php echo $diaslaborales;?>"></p> </TD>
          
          <TD><label>Hrs Noc Semanal</label></TD>
          <TD><p><input type="text" name="hrsnocsemanal" id="hrsnocsemanal" size="10" value="<?php echo $hrsnocsemanal;?>" disabled></p></TD>
           
    </TR>
    <TR>
          <TD><label>Horas Extra Diurno (*)</label></TD>
          <TD><p><input type="text" name="horasextradiurno" id="horasextradiurno" size="10" value="<?php echo $horaextradiurno;?>"></p></TD>
     
          <TD><label>Hrs Noc Mensual</label></TD>
          <TD><p><input type="text" name="hrsnocmensual" id="hrsnocmensual" size="10" value="<?php echo $hrsnocmensual;?>" disabled></p></TD>
           
    </TR>
    <TR>
          <TD><label>Horas Extra Nocturno (*)</label></TD>
          <TD><p><input type="text" name="horasextranocturno" id="horasextranocturno" size="10" value="<?php echo $horaextranocturno;?>"></p></TD>
   
          <TD><label>Hrs Lab Permitidas</label></TD>
          <TD><p><input type="text" name="hrslabpermitidas" id="hrslabpermitidas" size="10" value="<?php echo $hrslabpermitidas;?>" disabled></p></TD>
           
    </TR>
    
    
</TABLE>
 
    
<TABLE>
    <TR>
        <TD><input type="submit" value="Procesar" name="procesar"></TD>
        <TD><input type="submit" value="Guardar datos" name="submit"></TD>
        <TD><a href="turnos_ver.php"><input type="button" value="Atras"></a></TD>
        <TD><input type="submit" value="Limpiar" name="limpiar"></TD>
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


