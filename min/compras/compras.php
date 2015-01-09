<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 11:46 AM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


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


include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Compras');



$layout->append_to_header(
    <<<EOT
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
EOT
);

$layout->get_header();



$moneda_from = '';

$result=mysql_query("SELECT * FROM min_tipo_moneda");

while($test = mysql_fetch_array($result)){
    $id = $test['codigo'];
    $moneda_from .= "<option>". $test['nombre']." (". $test['simbolo'] .")". "</option>";

}


$layout->set_form(

    <<<EOT
 
     <form method="post" name="compras"   id="contact-form" id="form" >
    <div class="formLayout">
    <fieldset>

    <label>Nombre de Artículo(*)</label>
    <input type="text" name="codigoalias" id="codigoalias" disabled>
    <input type="button" name="buscar" id="buscar_articulo" value="Buscar" >
    <br/>

    <label>Proveedor(*)</label>
     <input type="text" name="empresa" id="empresa" disabled>
     <input type="button" name="buscar" id="buscar_empresa" value="Buscar" >
     <br/>

     <label >Fecha de Compra</label>
     <input type="text" id="datepicker1" name="fecha_compra">
     <br/>

      <label >Rotación de Inventario</label>
       <input type="text" id="datepicker2" name="rotacion">
       <br/>

       <label>Tipo de Moneda</label>
       <select name="unidad_medida" id="unidad_medida">
       $moneda_from
       </select>
       <br/>

       <input type="button" name="importaciones" id="importaciones" value="ingresar" />
 <input type="text" name="valor_importacion" id="valor_importacion"  disabled>

 <br/>
 <label>Tipo de Cobro</label>
 <br/>

 <label>Efectivo </label>
 <input style="margin-right:15%;margin-top: 8px" type="radio" name="tipo_pago" value="Efectivo" checked/>

 <label>Crédito</label>
 <input type="radio" style="margin-right:15%;margin-top: 8px"  name="tipo_pago" value="Crédito"/>
 <br/>

 <label>Cheque </label>
  <input type="radio" style="margin-right:15%;margin-top: 8px" name="tipo_pago" value="Cheque"/>

  <label>Débito </label>
  <input  style="margin-right:15%;margin-top: 8px" type="radio" name="tipo_pago" value="Débito" />
 <br/>

 <label>Fletes</label>
 <input type="text" name="fletes"  id="flete" />
 <br/>

 <label>Cantidad(*)</label>
 <input type="text" name="cantidad" id="cantidad" />
 <br/>

 <label>Gastos Varios</label>
 <input type="text" name="gastos_varios" id="gastos_varios">
 <br/>

 <label>Monto Factura(*)</label>
 <input type="text" name="monto_factura"  id="monto_factura">
 <br/>

 <label>Costo de Almacenaje</label>
 <input type="text" name="costo_almacenaje"  id="costo_almacenaje">
 <br/>

 <label>Costo Unitario</label>
 <input type="text" name="costo_unitario" id="costo_unitario"  disabled/>
 <br/>

 <label>Costo Total</label>
 <input type="text" id="costo_total"  name="costo_total" disabled/>
 <br/>

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


    <br/>
    <br/>

     <input type="submit" value="Guardar datos" name="submit">
      <a href="compra_devolucion.php?paso=0"><input type="button" value="Ver datos"></a>
       <a href="../../min_menu.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);