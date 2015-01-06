<?php

$monto = 0;
$formula = "";
$monto_resultado=0;

if (isset($_POST['probar'])){
    $codigoconcepto=$_POST['codigoconcepto'];
    $formula=$_POST['formula'];
    //echo $formula; 
    
    $monto_resultado = formula_completa($formula);
    echo $monto_resultado;
    $monto_resultado = calcular_formula($monto_resultado);
    
	$monto = $monto_resultado; 
}    

function formula_completa($variable){
	
	
	$bd_concepto = 0;
   
    
    while($bd_concepto==0){
		$bd_concepto = 1;
		$resultado = "";
		$concepto = "";
		
		$arreglo = explode(" ",$variable);	
		for ($i = 0; $i <= count($arreglo)-1; $i++){
			//echo $arreglo[$i];
			$cadena = $arreglo[$i];
			if (substr($arreglo[$i],0,1)=="p"){
				$concepto = buscar_concepto($arreglo[$i]);
				$cadena = $concepto;
				$bd_concepto = 0;
			}
			
			$resultado = $resultado . " " . $cadena;
		}
		$variable = $resultado;
	}
	return $resultado;
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

function calcular_formula($variable){

$cont = 0;
$op = 0;
$j = 0;
$k = 0;
$p[$k] = 0;
$a[$j] = "&";
$acumulador = 0;
$var1="&";
$var2="&";
$bd=0;

    $arreglo = explode(" ",$variable);
    for ($i = 0; $i <= count($arreglo)-1; $i++){
		//echo $arreglo[$i];
		if ($arreglo[$i]=="("){
			//echo $arreglo[$i];
			$cont = 0;
			if ($bd==0){
				
			}
			elseif($bd==1){
				$k = $k + 1;
				$p[$k] = $op;
			}
			
			

		}
		elseif ($arreglo[$i]==")"){
			//echo $arreglo[$i];
			$cont = 1;
			if(($var1<>"&")and($var2<>"&")){
				$acumulador = calcular($var1,$var2,$op);
				$j = $j + 1;
				$a[$j] = $acumulador;
				//echo $a[$j];
			}
			elseif(($var1=="&")and($var2=="&")){
				$acumulador = calcular($a[$j-1],$a[$j],$p[$k]);
				$j = $j - 1;
				$a[$j] = $acumulador;
				//echo $a[$j];
				$k = $k - 1;
			}
			elseif(($var1=="&")and($var2<>"&")){
				$acumulador=calcular($a[$j],$var2,$op);
				$a[$j] = $acumulador;
			}
			elseif(($var1<>"&")and($var2=="&")){
				$acumulador=$var1;
				$j = $j + 1;
				$a[$j] = $acumulador;
				
			
			}


			$op = 0;
			$var1 = "&";
			$var2 = "&";
			


	
		}
		elseif (substr($arreglo[$i],0,1)=="c"){
			//echo $arreglo[$i];
			$cont = $cont + 1;
			if($cont == 1){
				$var1 = $arreglo[$i];
				//echo $var1;
				$var1 = buscar_valor($var1);
				//echo $var1;
				if ($bd==0){
					$bd=1;
				}
				
			}
			elseif ($cont == 3){
				$var2 = $arreglo[$i];
				//echo $var2;
				$var2 = buscar_valor($var2);
				//echo $var2;
			}
			
		}
		elseif (($arreglo[$i]=="+")OR($arreglo[$i]=="-")OR($arreglo[$i]=="*")OR($arreglo[$i]=="/")){    
			//echo $arreglo[$i];
			$cont = $cont + 1;
			if($cont == 2){
				$op = $arreglo[$i];
				//echo $op;
			}
		}
	}
   

   return $a[1]; 
}

function buscar_valor($variable){
			  include("../../db.php");
              $sql = "select * from mco_view_montoconstante where codigoproceso='$variable'";
              //echo $sql;
              //exit;
              $result = mysql_query($sql);
              $test = mysql_fetch_array($result);
              if (!$result){die("Error: Data not found..");}
              $resultado = $test['monto'];   
              return $resultado;   	
}

function calcular($variable1,$variable2,$operador){
	     	  if($operador=="+"){
                $resultado = $variable1 + $variable2;
              }
              elseif($operador=="*"){
                $resultado = $variable1 * $variable2;
               }
              elseif($operador=="-"){
               $resultado = $variable1 - $variable2;
              }
              elseif($operador=="/"){
                $resultado = $variable1 / $variable2;
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
    <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Monto por Concepto</strong></h1>

<TABLE BORDER="0" CELLSPACING="4" WIDTH="500">
     <TR>	 
     <TD><label>Concepto</label></TD>    
            <?php // consulta de los meses
            // Consultar la base de datos
                include("../../db.php");
                $consulta_mysql='select * from mno_concepto where asignacion="N"';
                $resultado_consulta_mysql=mysql_query($consulta_mysql);
                echo "<TD>";
                echo "<select name='codigoconcepto' id='codigoconcepto' >";
                    while($fila=mysql_fetch_array($resultado_consulta_mysql)){
                        echo "<option value='".$fila['codigo']."'>".$fila['codigoproceso']."  |  ".$fila['descripcion']."</option>";
                    }
                echo "</select>";
                echo "</TD>";
             ?>   
     </TR>     
     <TR>
          <TD><label>Formula</label></TD>
          <TD><p><textarea type="text" name="formula" id="formula" style="width:600px; height:50px;" ><?php echo $formula?></textarea></p></TD>
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
        <td><a href="/sicap/mco/formulaconcepto/formulaconcepto_ver.php"><input type="button" value="Ver datos"></a> </td>
        <td><a href="/sicap/mco_menu.html"><input type="button" value="Atras"></a> </td>
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

        
        
<?php
if (isset($_POST['submit']))
	{	   
            include '../../db.php';        
            $codigoconcepto=$_POST['codigoconcepto'];

            $formula=$_POST['formula'];
            
            $sql = "update mno_concepto set asignacion='S' where codigo='$codigoconcepto'";
            //echo $sql;
           // exit;
            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());	

            $sql = "insert into mco_formulaconcepto(codigoconcepto,formula)
                                                          values('$codigoconcepto','$formula')";
            //echo $sql;
            //exit;
            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());	
            
            echo "<script type='text/javascript'>";
            echo "alert('Registro Almacenado');";
            echo "document.location.href = document.location.href;";
            echo "</script>"; 	
	}

?>
</form>
</body>
</html>

