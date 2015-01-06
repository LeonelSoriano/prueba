
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


require_once ('../../db.php');
require_once ('../../clases/funciones.php');
require_once('../../clases/Validate.php');



//foreach($_POST as $key => $value)
//    echo $key."=".$value .'<br/><br/>';

if (isset($_POST['submit'])){

    $validation = array(

        array('nombre' => 'fletes',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'gastos_varios',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'monto_factura',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'codigo_bien_hi',
            'requerida' => true,
            'regla' => 'number'),


        array('nombre' => 'cantidad',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),


        array('nombre' => 'codigo_empresa',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'codigo_articulo',
            'requerida' => true,
            'regla' => 'number'),

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){

        $codigo_articulo = $_POST['codigo_articulo'];
        $codigo_empresa = $_POST['codigo_empresa'];
        $fecha_compra = $_POST['fecha_compra'];
        $rotacion = $_POST['rotacion'];
        $tipo_pago = $_POST['tipo_pago'];

        $unidad_medida = $_POST['unidad_medida'];


        /*operaciones*/
        $fletes = str_replace(",",".",$_POST['fletes']);


        $cantidad = str_replace(",",".",$_POST['cantidad']);
        $gastos_varios = str_replace(",",".",$_POST['gastos_varios']);
        $monto_factura = str_replace(",",".",$_POST['monto_factura']);
        $costo_almacenaje = str_replace(",",".",$_POST['costo_almacenaje']);



        /*datos importacion*/
        $gasto_importacion = str_replace(",",".",$_POST['gasto_importacion']);
        $check_importacion = $_POST['check_importacion'];

        $gasto_aduanales = str_replace(",",".",$_POST['gasto_aduanales']);
        $check_aduanales = $_POST['check_aduanales'];

        $gasto_arancelarios = str_replace(",",".",$_POST['gasto_arancelarios']);
        $check_arancelarios = $_POST['check_arancelarios'];

        $gasto_nacionalizacion = str_replace(",",".",$_POST['gasto_nacionalizacion']);
        $check_nacionalizacion = $_POST['check_nacionalizacion'];


        $tasa_cambio = str_replace(",",".",$_POST['tasa_cambio']);


        $sub_aduanales = $gasto_aduanales;
        $sub_arancelarios = $gasto_arancelarios;
        $sub_importacion = $gasto_importacion;
        $sub_nacionalizacion = $gasto_nacionalizacion;

        if($check_aduanales != 'bs'){
            $sub_aduanales = $gasto_aduanales * $tasa_cambio;
        }
        if($check_nacionalizacion != 'bs'){
            $sub_nacionalizacion = $gasto_nacionalizacion * $tasa_cambio;
        }
        if($check_arancelarios != 'bs'){
            $sub_arancelarios = $gasto_arancelarios * $tasa_cambio;
        }
        if($check_importacion != 'bs'){
            $sub_importacion = $gasto_importacion * $tasa_cambio;
        }


        $costo_total =$fletes  + $gastos_varios + $monto_factura + $costo_almacenaje + $sub_aduanales + $sub_importacion + $sub_arancelarios + $sub_nacionalizacion;


        $tmp_unidad = explode("(",$_POST['unidad_medida'])[0];

        $tmp_unidad = substr($tmp_unidad,0,-1);

        $sql = "SELECT * FROM min_tipo_moneda WHERE  nombre='$tmp_unidad'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unudades");
        }

        $tmp_unidad = $test['codigo'];

        /*.-.-.--.--.-.-*/


        /*busco la cantidad actual de el producto y lo sumo*/

        $sql = "SELECT * FROM min_productos_servicios WHERE  codigo='$codigo_articulo'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unudades");
        }

        $tmp_existencia_actual = $test['existencia'];

        $cantidad = str_replace(",",".",$cantidad);

        $existencia = $cantidad + $tmp_existencia_actual;

        /*-.-.-.-.-.-.-.-..-.-.-.-*/

        /*busco codigo de tipo de pago*/
        $sql = "SELECT * FROM min_tipo_pago WHERE  tipo='$tipo_pago'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unudades");
        }

        $tmp_codigo_pago = $test['codigo'];


        /*-.-.-..-.-*/


        /*-.-.--.-.-.-*/


        /*datos a compras*/

        $sql = "INSERT INTO min_compra(codigo_articulo,codigo_proveedor,fecha_compra,rotacion_inventario,codigo_moneda,codigo_tipo_pago,flete,cantidad,gastos_varios,monto_factura,costo_almacenaje,costo_total)
            VALUES ('$codigo_articulo','$codigo_empresa','$fecha_compra','$rotacion','$tmp_unidad','$tmp_codigo_pago','$fletes','$cantidad','$gastos_varios','$monto_factura','$costo_almacenaje','$costo_total')";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        $ultimo_ID = mysql_insert_id();


        $sql = "INSERT INTO min_compra_importacion (codigo_compra,gasto_importacion,gasto_importacion_moneda,gastos_aduanales,gasto_aduanales_moneda,gastos_arancelarios,gastos_arancelarios_moneda,gasto_nacionalizacion,gasto_nacionalizacion_moneda,tasa_cambio)
            VALUES ('$ultimo_ID','$gasto_importacion','$check_importacion','$gasto_aduanales','$check_aduanales','$gasto_arancelarios','$check_arancelarios','$gasto_nacionalizacion','$check_nacionalizacion','$tasa_cambio')";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());




        $sql = "SELECT * FROM min_valoracion WHERE  codigo_producto='$codigo_articulo'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unudades");
        }

        $valoracion_unidades = $test['unidades'];
        $valoracion_costo_total = $test['costo_total'];


        $nueva_valoracion_unidades = $valoracion_unidades + $cantidad;

        $nueva_valoracion_costo_total = $costo_total + $valoracion_costo_total;

        if($nueva_valoracion_unidades ==  0)
            $nueva_valoracion_unidades = 1;
        $nueva_valoracion_promedio_actual = $nueva_valoracion_costo_total / $nueva_valoracion_unidades;


        $sql = "UPDATE min_valoracion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total',promedio_actual='$nueva_valoracion_promedio_actual'  WHERE codigo_producto='$codigo_articulo'";


        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());



        /*.-.-.-.-.-..-.-.--.-.-.--.-.--.-.-.*/
        //guardo peps
        $tiempo = time();


        $costo_unidad = $costo_total / $cantidad;

        $sql = "INSERT INTO min_inventario_cola(codigo_producto,fecha,cantidad,costo_total,id_compra,costo_unidad)
            VALUES ('$codigo_articulo','$tiempo','$cantidad','$costo_total','$ultimo_ID','$costo_unidad')";



        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());



        //guardo ueps
        $sql = "INSERT INTO min_inventario_ueps(codigo_producto,fecha,cantidad,costo_total,id_compra,costo_unidad)
            VALUES ('$codigo_articulo','$tiempo','$cantidad','$costo_total','$ultimo_ID','$costo_unidad')";


        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;
    }else if($validated->getIsError()){

        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <script src="../../js/clasesVarias.js"></script>
    <script>

        function mitadX(x){
            return screen.width / 2 - x / 2;
        }

        function mitadY(y){
            return screen.width / 2 - y ;
        }

        function sum_str(str){


            return 0;

        }

        $(function() {



            var sumComa = new SumComa();

            if( $( "#unidad_medida option:selected" ).index() == 0){

                $( "#importaciones").css({"visibility" : "hidden"});
                $( "#valor_importacion").css({"visibility" : "hidden"});
            }else{
                $( "#importaciones").css({"visibility" : "visible"});
                $( "#valor_importacion").css({"visibility" : "visible"});
            }



            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth() < 10){
                mes = myDate.getMonth() + 1;
                mes = '0' + mes;
            }else{
                mes = myDate.getMonth() + 1;
            }
            var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + myDate.getDate() ;
            $("#datepicker1").val(prettyDate);
            $("#datepicker2").val(prettyDate);



            $( "#buscar_articulo" ).click(function() {
                var win = window.open("compras_buscar_articulo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
                win.focus();
            });



            $( "#importaciones" ).click(function() {
                var win = window.open("compras_importaciones.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=700, height=600 ,left="+mitadX(600)+",top=90");
                win.focus();
            });


            $( "#buscar_empresa" ).click(function() {
                var win = window.open("compras_buscar_empresa.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,,left=200,top=90 ");
                win.focus();
            });


            $( "#unidad_medida" ).change(function() {

                if( $( "#unidad_medida option:selected" ).index() == 0){

                    $( "#importaciones").css({"visibility" : "hidden"});
                    $( "#valor_importacion").css({"visibility" : "hidden"});
                }else{
                    $( "#importaciones").css({"visibility" : "visible"});
                    $( "#valor_importacion").css({"visibility" : "visible"});
                }
            });
            //
            //Number($( "#valor_importacion" ).val())


            $( "#costo_almacenaje" ).bind('keyup keydown mouseup change focus paste',function(e){

                sumComa.add($( "#costo_almacenaje" ).val());
                sumComa.add($( "#flete" ).val());
                sumComa.add($( "#monto_factura" ).val());
                sumComa.add($( "#gastos_varios" ).val());
                sumComa.add($( "#valor_importacion").val());
                var sumResultado = sumComa.getSum();


                $( "#costo_total" ).val(sumResultado);

                $( "#costo_unitario" ).val(sumComa.divComa(sumResultado,$( "#cantidad" ).val()));

            });



            $( "#monto_factura" ).bind('keyup keydown mouseup change focus paste',function(e){


                sumComa.add($( "#costo_almacenaje" ).val());
                sumComa.add($( "#flete" ).val());
                sumComa.add($( "#monto_factura" ).val());
                sumComa.add($( "#gastos_varios" ).val());
                sumComa.add($( "#valor_importacion").val());
                var sumResultado = sumComa.getSum();


                $( "#costo_total" ).val(sumResultado);

                $( "#costo_unitario" ).val(sumComa.divComa(sumResultado,$( "#cantidad" ).val()));


            });

            $( "#gastos_varios" ).bind('keyup keydown mouseup change focus paste',function(e){


                sumComa.add($( "#costo_almacenaje" ).val());
                sumComa.add($( "#flete" ).val());
                sumComa.add($( "#monto_factura" ).val());
                sumComa.add($( "#gastos_varios" ).val());
                sumComa.add($( "#valor_importacion").val());
                var sumResultado = sumComa.getSum();


                $( "#costo_total" ).val(sumResultado);

                $( "#costo_unitario" ).val(sumComa.divComa(sumResultado,$( "#cantidad" ).val()));

            });

            $( "#cantidad" ).bind('keyup keydown mouseup change focus paste',function(e){


                sumComa.add($( "#costo_almacenaje" ).val());
                sumComa.add($( "#flete" ).val());
                sumComa.add($( "#monto_factura" ).val());
                sumComa.add($( "#gastos_varios" ).val());
                sumComa.add($( "#valor_importacion").val());
                var sumResultado = sumComa.getSum();


                $( "#costo_total" ).val(sumResultado);

                $( "#costo_unitario" ).val(sumComa.divComa(sumResultado,$( "#cantidad" ).val()));

            });

            $( "#flete" ).bind('keyup keydown mouseup change focus',function(e){

                sumComa.add($( "#costo_almacenaje" ).val());
                sumComa.add($( "#flete" ).val());
                sumComa.add($( "#monto_factura" ).val());
                sumComa.add($( "#gastos_varios" ).val());
                sumComa.add($( "#valor_importacion").val());
                var sumResultado = sumComa.getSum();


                $( "#costo_total" ).val(sumResultado);

                $( "#costo_unitario" ).val(sumComa.divComa(sumResultado,$( "#cantidad" ).val()));

            });



            $('#form').submit(function() {
                $( "#costo_total_hi" ).val(  $( "#costo_total" ).val());


                return true; // return false to cancel form action
            });





        });
    </script>
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->
</head>
<body class="flickr-com">


<form method="post" name="compras" id="form">
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
        <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>Módulo de Inventario | Compras</strong></h1>

        <!-- Beginning of compulsory code below -->
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
                <TD width="173"><label>Nombre de Artículo(*)</label></TD>
                <TD width="94">
                    <input type="text" name="codigoalias" id="codigoalias" size="20"  disabled></TD>
                <TD>
                    <!--<input type="submit" value="Buscar" name="submit">-->
                    <input type="button" name="buscar" id="buscar_articulo" value="Buscar" >
                </TD>
            </TR>

            <TR>
                <TD width="173"><label>Proveedor(*)</label></TD>
                <TD width="94">
                    <input type="text" name="empresa" id="empresa" size="20"  disabled></TD>
                <TD>
                    <!--<input type="submit" value="Buscar" name="submit">-->
                    <input type="button" name="buscar" id="buscar_empresa" value="Buscar" >
                </TD>
            </TR>



            <tr>
                <td>
                    <label >Fecha de Compra</label>
                </td>
                <td>
                    <p>
                        <input type="text" id="datepicker1" name="fecha_compra">
                    </p>
                </td>
            </tr>

            <tr>
                <td>
                    <label >Rotación de Inventario</label>
                </td>
                <td>
                    <p>
                        <input type="text" id="datepicker2" name="rotacion">
                    </p>
                </td>
            </tr>



            <tr>
                <td>
                    <p>
                        <label>Tipo de Moneda</label>
                    </p>
                </td>
                <td>
                    <p>
                        <select name="unidad_medida" id="unidad_medida">
                            <?php

                            $result=mysql_query("SELECT * FROM min_tipo_moneda");

                            while($test = mysql_fetch_array($result)){
                                $id = $test['codigo'];
                                echo"<option>". $test['nombre']." (". $test['simbolo'] .")". "</option>";

                            }
                            ?>
                        </select>
                    </p>

                </td>
                <TD>
                    <p>
                        <input type="button" name="importaciones" id="importaciones" value="ingresar" />
                    </p>
                </TD>

                <TD><p>&nbsp;<input type="text" name="valor_importacion" id="valor_importacion" size="12"  disabled></p></TD>

            </tr>



            <TR>
                <TD><label>Tipo de Cobro</label></TD>
                <td>
                    <p>
                        Efectivo    <input type="radio" name="tipo_pago" value="Efectivo" checked/>
                        &nbsp;&nbsp;&nbsp;
                        Crédito   <input type="radio"  name="tipo_pago" value="Crédito"/>
                        <br/><br/>
                        Cheque    <input type="radio" name="tipo_pago" value="Cheque"/>
                        &nbsp;&nbsp;&nbsp;
                        Débito     <input type="radio" name="tipo_pago" value="Débito" />
                        <br/><br/>
                    </p>
                </td>
            </TR>

            <TR>
                <TD><label>Fletes</label></TD>
                <TD><p><input type="text" name="fletes" size="20" id="flete"></p></TD>
            </TR>

            <TR>
                <TD><label>Cantidad(*)</label></TD>
                <TD><p><input type="text" name="cantidad" id="cantidad" size="20"></p></TD>
            </TR>



            <TR>
                <TD><label>Gastos Varios</label></TD>
                <TD><p><input type="text" name="gastos_varios" size="20" id="gastos_varios"></p></TD>
            </TR>



            <TR>
                <TD><label>Monto Factura(*)</label></TD>
                <TD><p><input type="text" name="monto_factura" size="20" id="monto_factura"></p></TD>
            </TR>

            <TR>
                <TD><label>Costo de Almacenaje</label></TD>
                <TD><p><input type="text" name="costo_almacenaje" size="20" id="costo_almacenaje"></p></TD>
            </TR>


            <tr>
                <td>
                    <label>Costo Unitario</label>
                </td>
                <td><p><input type="text" name="costo_unitario" id="costo_unitario"  disabled/></p></td>
            </tr>


            <tr>
                <td>
                    <label>Costo Total</label>
                </td>
                <td><p><input type="text" id="costo_total"  name="costo_total" disabled/></p></td>
            </tr>


            <input type="hidden" name="costo_total_hi"  id="costo_total_hi" />

            <input type="hidden" name="codigo_articulo" id="codigo_articulo" value=""/>
            <input type="hidden" name="codigo_empresa" id="codigo_empresa" value=""/>

            <input type="hidden" name="gasto_importacion" id="gasto_importacion" value=""/>
            <input type="hidden" name="gasto_aduanales" id="gasto_aduanales" value=""/>
            <input type="hidden" name="gasto_arancelarios" id="gasto_arancelarios" value=""/>
            <input type="hidden" name="gasto_nacionalizacion" id="gasto_nacionalizacion" value=""/>
            <input type="hidden" name="tasa_cambio" id="tasa_cambio" value=""/>

            <input type="hidden" name="check_importacion" value="bs"/>
            <input type="hidden" name="check_aduanales" value="bs"/>
            <input type="hidden" name="check_arancelarios" value="bs"/>
            <input type="hidden" name="check_nacionalizacion" value="bs"/>



        </TABLE>

        <br/><br/>
        <table>
            <tr>
                <td>
                    <input type="submit" value="Guardar datos" name="submit">
                </td>
                <td>
                    <a href="compra_devolucion.php"><input type="button" value="Ver datos"></a>
                </td>
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


<?php

mysql_close($conn);

?>