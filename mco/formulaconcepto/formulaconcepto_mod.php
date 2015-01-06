<?php
       
require("../../db.php");
$id =$_REQUEST['codigo'];
$codigoconcepto = $_REQUEST['codigoconcepto'];
$formula = "";

$result = mysql_query("SELECT * FROM mco_formulaconcepto WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result) 
    {
        die("Error: Data not found..");
    }
             
        $codigoconcepto=$test['codigoconcepto'];
        $formula=$test['formula'];
        //echo $descripcion;
        //exit;
        
$result = mysql_query("SELECT * FROM mno_concepto WHERE codigo  = '$codigoconcepto'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);


if (!$result){die("Error: Data not found..");}
             
        $codigoproceso=$test['codigoproceso'];
        $descripcion=$test['descripcion'];
        //echo $descripcion;
        //exit;

        

$contador = 0;
$contador1=0;
$contador2=0;
$monto=0;
$monto_concepto=0;
$var1=0;
$var2=0;
$monto1=0;
$monto2=0;
$op="";
$opc="";
$cont = 0;
$bd_var=0;
$cons = "";
$var = "";

if (isset($_POST['probar'])){
    $codigoconcepto=$_POST['codigoconcepto'];
    $formula=$_POST['formula'];
    $arreglo = explode(" ",$formula);
    $contador = 0;
    $cont = 0;
    $bd_var = 0;
    
    for ($i = 0; $i <= count($arreglo)-1; $i++){
        if ($arreglo[$i]=="("){
            //echo $arreglo[$i];
            $contador1 = $contador1 + 1;
            //echo $contador1;
        }
        elseif ($arreglo[$i]==")"){
            //echo $arreglo[$i];
            $contador2 = $contador2 + 1;
            //echo $contador2;
        }
    }
    
    echo $contador1;
    echo $contador2;
        
    for ($i = 0; $i <= count($arreglo)-1; $i++){
        if ($arreglo[$i]=="("){
            echo $arreglo[$i];
            $cont = 0;
        }
        elseif ($arreglo[$i]==")"){
            echo $arreglo[$i];
            $bd_var = 1;
            $cont = 2;
            
        }
        elseif (($arreglo[$i]=="+")OR($arreglo[$i]=="-")OR($arreglo[$i]=="*")OR($arreglo[$i]=="/")){    
            $cont = $cont + 1;
            if($bd_var==0){
                $op = $arreglo[$i];
                echo $op;
            }
            elseif($bd_var==1){
                $opc = $arreglo[$i];
                echo $opc;
            }
            
            
        }
        elseif (substr($arreglo[$i],0,1)=="c"){
            $cont = $cont + 1;
            if ($bd_var==0){
                if ($cont == 1){
                    $var1 = $arreglo[$i];
                    echo $var1;
                    $monto1 = funcion_calculo($var1,$op,$cont,$monto1);
                    echo $monto1;
                }
                elseif ($cont == 3){
                    $var1 = $arreglo[$i];
                    echo $var1;
                    $monto1 = funcion_calculo($var1,$op,$cont,$monto1);
                    echo $monto1;
                }    
            }
            elseif ($bd_var==1){
                if ($cont == 1){
                    $var2 = $arreglo[$i];
                    echo $var2;
                    $monto2 = funcion_calculo($var2,$op,$cont,$monto2);
                    echo $monto2;
                }
                elseif ($cont == 3){
                    $var2 = $arreglo[$i];
                    echo $var2;
                    $monto2 = funcion_calculo($var1,$op,$cont,$monto2);
                    echo $monto2;
                    
                    $monto_total = calculo_final($monto1,$monto2,$opc);
                }   
            }
            
        }
        
    }
    
$monto = $monto1;
}    

if(isset($_POST['submit']))
{	
        $formula=$_POST['formula'];

        $sql = "update mco_formulaconcepto set formula='$formula'
                 where codigo = '$id'";
       //echo $sql;
       //exit;
	mysql_query($sql)or die(mysql_error()); 
	echo "Guardado";
	
	header("Location: formulaconcepto_ver.php");			
}

function contar_parentesis($variable){
        if ($variable=="("){
            echo $variable;
        }
        elseif ($variable==")"){
            echo $variable;
        }   
}


function calcular_concepto($variable){

$contadora = 0;
$var1a=0;
$var2a=0;
$monto1a=0;
$monto2a=0;
$opa="";
$opca="";
$conta = 0;
$bd_vara=0;
$vara = "";


    $arregloa = explode(" ",$variable);
    $contadora = 0;
    $conta = 0;
    $bd_vara=0;
    
    for ($i = 0; $i <= count($arregloa)-1; $i++){
        if ($arregloa[$i]=="("){
            echo $arregloa[$i];
            $contadora = $contadora + 1;
        }    
        elseif ($arregloa[$i]==")"){
            echo $arregloa[$i];
            $contadora = $contadora - 1;
            if ($bd_vara==1){
                $conta=0;
                $monto1a = calculo_final($monto1a,$monto2a,$opca);
            }
            $bd_vara=1;
        }
        elseif (substr($arregloa[$i],0,1)=="c"){
            $conta = $conta + 1;
            if ($bd_vara==0){
                if ($conta==1){
                    $var1a = $arregloa[$i];
                    echo $var1a;
                    $opa = "";
                    //$monto1a = 0;
                    $monto1a = funcion_calculo($var1a,$opa,$conta,$monto1a); 
                }
                elseif ($conta==3){
                    $var1a = $arregloa[$i];
                    echo $var1a;
                    $monto1a = funcion_calculo($var1a,$opa,$conta,$monto1a); 
                }    
            }
            elseif ($bd_vara==1){
                if ($conta==1){
                    $var2a = $arregloa[$i];
                    echo $var2a;
                    $opa = "";
                    //$monto2a = 0;
                    $monto2a = funcion_calculo($var2a,$opa,$conta,$monto2a); 
                }
                elseif ($conta==3){
                    $var2a = $arregloa[$i];
                    echo $var2a;
                    $monto2a = funcion_calculo($var2a,$opa,$conta,$monto2a); 
                }    
            }   
     
        }
        elseif (($arregloa[$i]=="+")OR($arregloa[$i]=="-")OR($arregloa[$i]=="*")OR($arregloa[$i]=="/")){
            $conta = $conta + 1;
            if ($contadora==0){
                $opca = $arregloa[$i];
                echo $opca;
                $conta=0;
            }
            elseif($contadora<>0){
                $opa = $arregloa[$i];
                echo $opa;
            }
        }
        
    }

return $monto1a;    
    
}
 
function buscar_concepto($variable){
              include("../../db.php");
              $sql = "select * from mco_view_formulaconcepto where codigoproceso='$variable'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: Data not found..");}
              $resultado = $test['formula'];   
              return $resultado;    

}

function funcion_calculo($variable,$operador,$c,$monto){
    if ($c==1){
              include("../../db.php");
              $sql = "select * from mco_view_montoconstante where codigoproceso='$variable'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: Data not found..");}
              $resultado = $monto + $test['monto'];   
              return $resultado;                            
    }
    elseif($c==3){
              include("../../db.php");
              $sql = "select * from mco_view_montoconstante where codigoproceso='$variable'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: Data not found..");}
              $resultado = $test['monto'];   
              echo $resultado;
              if($operador=="+"){
                $resultado = $monto + $resultado;
              }
              elseif($operador=="*"){
                $resultado = $monto * $resultado;
               }
              elseif($operador=="-"){
               $resultado = $monto - $resultado;
              }
              elseif($operador=="/"){
                $resultado = $monto / $resultado;
              }
              return $resultado;                            
    }
}    

function calculo_final($variable1,$variable2,$operador){
              if($operador=="+"){
                $resultado = $variable1+ $variable2;
                return $resultado;
              }
              elseif($operador=="*"){
                $resultado = $variable1 * $variable2;
                return $resultado;
              }
              elseif($operador=="-"){
               $resultado = $variable1 - $variable2;
               return $resultado;
              }
              elseif($operador=="/"){
                $resultado = $variable1 / $variable2;
                return $resultado;
              }
 
}
mysql_close($conn);

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
<script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
<link href="../../css/htmlDatePicker.css" rel="stylesheet">
<!-- Beginning of compulsory code below -->
<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

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
    <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Constante</strong></h1>

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">
     <TR>
          <TD><label>Código Concepto</label></TD>
          <TD><p><input type="text" name="codigoconcepto" id="codigoconcepto" size="20" disabled value=<?php echo $codigoconcepto."|".$codigoproceso."|".$descripcion   ?>></p></TD>
     </TR> 
     <TR>
          <TD><label>Formula</label></TD>
          <TD><p><textarea type="text" name="formula" id="formula" style="width:200px;height:50px;" ><?php echo $formula?></textarea></p></TD>
     </TR> 
     <TR>
          <TD><label>Cálculo</label></TD>
          <TD><p><input type="text" name="calculo" id="calculo" size="20" disabled value=<?php echo $monto?> ></p></TD>
     </TR> 
    
</TABLE>

<table>
        <tr>
        <td><input type="submit" value="Probar Formula" name="probar"></td>
        <td><input type="submit" value="Guardar datos" name="submit"></td>
        <td><a href="/sicap/mco/formulaconcepto/formulaconcepto_ver.php"><input type="button" value="Atras"></a> </td>
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
