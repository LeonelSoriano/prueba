<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 02:45 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();

if (isset($_POST['submit'])){



    $fecha_venta = $_POST['fecha_venta'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $codigo_factura = $_POST['codigo_factura'];
    $cantidad_unidad = $_POST['cantidad_unidad'];
    $fecha_venta = $_POST['fecha_venta'];
    $existencia_articulo = $_POST['existencia_articulo_hi'];
    $codigo_articulo = $_POST['codigo_articulo'];
    $codigo_cliente = $_POST['codigo_cliente'];
    $codigo_vendedor = $_POST['codigo_vendedor'];
    $costo_unitario = $_POST['costo_unitario_hi'];

    $venta_credito = 'no';

    if(isset($_POST['venta_credito'])){
        $venta_credito = 'si';
    }

    $venta_colectivo = 'no';

    if(isset($_POST['venta_colectivo'])){
        $venta_credito = 'si';
    }

    if(is_numeric($cantidad_unidad) and is_numeric($existencia_articulo)){
        $suma = $existencia_articulo - $cantidad_unidad;

        if($suma < 0){

            echo('<div id="error_app"><marquee scrolldelay="120">Esta operación no es realizable gracias a flata de inventario</marquee></div>');


            //             // mensaje
            $mensaje = "

                                    <h1 >Reporte</h1>
                                    <table>
                                      <tr>
                                        <th>Coígo Vendedor</th><th>Codigo Factura </th><th>Codígo Articulo  </th><th>Articulo </th><th>Existencia de Articulo </th><th>Venta </th>
                                      </tr>
                                      <tr>
                                        <td style='text-align: center'>$codigo_vendedor</td><td style='text-align: center'>$codigo_factura</td><td style='text-align: center'>$codigo_articulo</td><td style='text-align: center'>$codigo_articulo</td><td style='text-align: center'>$existencia_articulo</td><td style='text-align: center'>$cantidad_unidad</td>
                                      </tr>
                                    </table>

                                  ";



            include("../../PHPMailer-master/class.phpmailer.php");
            include("../../PHPMailer-master/class.smtp.php");

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug  = 0;//2 para pruebas
            $mail->Host  = 'smtp.gmail.com';

            $mail->Port       = 587;

            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth   = true;
            $mail->Username   = "leonelsoriano3@gmail.com";
            $mail->Password   = "19elmarxista1";

            $mail->SetFrom('leonelsoriano3@hotmail.com', 'Sistema de reportes');

            $mail->AddReplyTo('leonelsoriano3@hotmail.com','El de la réplica');

            $mail->AddAddress('leonelsoriano3@hotmail.com', 'El Destinatario');


            $mail->Body = $mensaje;
            $mail->isHTML(true);
            $mail->Subject = 'Sistema de reporte ';

            $mail->AltBody = 'This is a plain-text message body';

            //Enviamos el correo
            if(!$mail->Send()) {
                echo "Error: " . $mail->ErrorInfo;
            } else {
                // echo "Enviado!";
            }


        }else{

            $sql = "INSERT INTO min_ventas (codigo_articulo,codigo_cliente,fecha_venta,fecha_entrega,codigo_factura,codigo_empleado,cantidad,costo_unidad,venta_credito,venta_colectivo)
              VALUES ('$codigo_articulo','$codigo_cliente','$fecha_venta','$fecha_entrega','$codigo_factura','$codigo_vendedor','$cantidad_unidad','$costo_unitario','$venta_credito','$venta_colectivo')";


            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


            // valoracion

            $sql = "SELECT * FROM min_valoracion WHERE  codigo_producto='$codigo_articulo'";

            $result = mysql_query($sql);

            $test = mysql_fetch_array($result);

            if (!$result)
            {
                die("Error: Data not found.. min_valoracion");
            }

            $valoracion_unidades = $test['unidades'];
            $valoracion_costo_total = $test['costo_total'];
            $promedio_actual = $test['promedio_actual'];

            $nueva_valoracion_unidades = $valoracion_unidades - $cantidad_unidad;
            //$nueva_valoracion_costo_total = $valoracion_costo_total - $costo_unitario;
            $sub_total_costo_total = $cantidad_unidad*$promedio_actual;
            $nueva_valoracion_costo_total = $valoracion_costo_total - $sub_total_costo_total;

            $sql = "UPDATE min_valoracion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total'  WHERE codigo_producto='$codigo_articulo'";


            require_once('../../clases/funciones.php');
            $fecha = fecha_sicap();
            $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha )
VALUES('$codigo_articulo', '$nueva_valoracion_unidades', '$nueva_valoracion_costo_total', '$promedio_actual', '$fecha');
";
            $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());



            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


// guardar el peps
            /** @var  $tmp_cantidad = esto es la cantidad q se esta pidiendo*/
//        $tmp_cantidad = $cantidad_unidad;
//
//
//        while($tmp_cantidad > 0){
//
//            $sql = "SELECT * FROM min_inventario_cola WHERE  codigo_producto='$codigo_articulo' and usado='n' ORDER  BY fecha  LIMIT 1";
//
//
//
//            $result = mysql_query($sql);
//
//            $test = mysql_fetch_array($result);
//
//            $cantidad_lote =  $test['cantidad'];
//
//            $codigo_cola = $test['codigo'];
//
//            $costo_cola = $test['costo_total'];
//
//
//            if($tmp_cantidad > $cantidad_lote  ){
//
//
//                $tmp_cantidad -= $cantidad_lote;
//
//
//                $sql = "UPDATE min_inventario_cola SET cantidad = 0,usado='s',costo_total=0  WHERE codigo ='$codigo_cola'";
//                mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
//
//
//            }else{
//
//                $costo_unitario_cola = $costo_cola / $cantidad_lote;
//
//                $cantidad_lote -= $tmp_cantidad;
//                $tmp_cantidad = 0;
//
//
//                $costo_cola -= $costo_unitario_cola;
//
//
//                $sql = "UPDATE min_inventario_cola SET cantidad='$cantidad_lote',costo_total='$costo_cola'  WHERE codigo='$codigo_cola'";
//                mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
//
//
//            }


            //       }//end of peps



            send_error_redirect(false,'Datps Guardados Correctamente');
            die;

        }

    }






}//post

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm(' Módulo de Inventario | Venta');



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



        $(function() {

            var sumComa = new SumComa();

            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth()<9){
                mes = myDate.getMonth() + 1;
                mes = '0' + mes;
            }else{
                mes = myDate.getMonth() + 1;
            }
            var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + myDate.getDate() ;
            $("#datepicker1").val(prettyDate);
            $("#datepicker2").val(prettyDate);



            $( "#buscar_articulo" ).click(function() {
                var win = window.open("venta_buscar_articulo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=700, height=600,left="+mitadX(600)+",top=100");
                win.focus();
            });



            $( "#buscar_cliente" ).click(function() {
                var win = window.open("venta_buscar_cliente.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=780, height=600,left=270,top=100");
                win.focus();
            });

            $( "#buscar_vendedor" ).click(function() {
                var win = window.open("venta_buscar_vendedor.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=780, height=600,left=270,top=100");
                win.focus();
            });



            $( "#cantidad_unidad" ).bind('keyup keydown mouseup change focus',function(e){

                sumComa.add($( "#costo_unitario").val());
                sumComa.add($( "#cantidad_unidad").val());

                $( "#total_pagar" ).val(sumComa.getMul());

            });


            $('#form').submit(function() {
                $( "#costo_unitario_hi" ).val( $("#costo_unitario").val());
                $( "#existencia_articulo_hi" ).val( $("#existencia_articulo").val());

                return true; // return false to cancel form action
            });


        });
    </script>
EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form method="post" name="venta" id="contact-form" id="form"   >
    <div class="formLayout">
    <fieldset>


  <label >Venta a Credito</label>
  <input type="checkbox"  style="margin-left:-8%;margin-right:15%;margin-top: 8px" name="venta_credito" id="venta_credito" />
  <br/>

  <label >Venta a Colectivo</label>
  <input type="checkbox" style="margin-left:-8%;margin-right:15%;margin-top: 8px" name="venta_colectivo" id="venta_colectivo" />
 <br/>

 <label>Nombre de Artículo</label>
 <input type="text" name="nombre_articulo" id="nombre_articulo"  disabled>
 <input type="button" name="buscar" id="buscar_articulo" value="Buscar" >
 <br/>

 <label >Código de Artículo</label>
 <input type="text" name="codigoalias" id="codigoalias" disabled/>
 <br/>

<label>Nombre de Vendedor</label>
 <input type="text" name="nombre_vendedor" id="nombre_vendedor" disabled>
<input type="button" name="buscar_vendedor" id="buscar_vendedor" value="Buscar" >
<br/>


<label for="">Cedula de Vendedor</label>
<input type="text" name="id_vendedor" id="id_vendedor" disabled/>
<br/>

<label>Nombre de Cliente</label>
 <input type="text" name="nombre_cliente" id="nombre_cliente"  disabled>
 <input type="button" name="buscar_cliente" id="buscar_cliente" value="Buscar" >
 <br/>

 <label >RIF / Cedula de Identidad</label>
 <input type="text" name="rif_cliente" id="rif_cliente" disabled/>
 <br/>

 <label >Fecha de Venta</label>
 <input type="text" id="datepicker1" name="fecha_venta">
 <br/>

 <label for="fecha_entrega">Fecha Entrega</label>
 <input type="text" id="datepicker2" name="fecha_entrega"/>
 <br/>

 <label for="codigo_factura">Codigo Factura</label>
 <input type="text" name="codigo_factura" id="codigo_factura"/>
 <br/>


 <label for="catidad_unidad">Cantidad de Venta</label>
 <input type="text" name="cantidad_unidad" id="cantidad_unidad"/>
 <br/>

<label >Existencia de Artículo</label>
<input type="text" name="existencia_articulo" id="existencia_articulo" disabled/>
<br/>

<label>Costo Unitario</label>
<input type="text" name="costo_unitario" id="costo_unitario" disabled/>
<br/>

<label > Total  </label>
<input type="text" name="total_pagar" id="total_pagar" disabled/>
<br/>

   <input type="hidden" name="codigo_articulo" id="codigo_articulo" value=""/>
<input type="hidden" name="codigo_cliente" id="codigo_cliente" value=""/>
<input type="hidden" name="codigo_vendedor" id="codigo_vendedor" value=""/>


<input type="hidden" name="costo_unitario_hi" id="costo_unitario_hi" value=""/>
<input type="hidden" name="existencia_articulo_hi" id="existencia_articulo_hi" value=""/>

<input type="submit" value="Guardar datos" name="submit">
<a href="venta_devolucion.php"><input type="button" value="Ver datos"></a>
<a href="../../min_menu.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);