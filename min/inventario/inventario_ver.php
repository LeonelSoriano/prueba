<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 01:02 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');
require_once("../../clases/funciones.php");



$a = new Seguridad();

$a->chekear_session();


//POST

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Reabrir Orden');



$layout->append_to_header(
    <<<EOT

   <script>

        $(function(){


            var codigo = "";

            $("#inventario").bind("change",function(){
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                codigo = valueSelected;

                var parametros = { codigo : codigo };

             $.ajax({
                    data:  parametros,
                    url:   "ajax_ver_inventarios.php",
                    type:  "post",
                    beforeSend: function () {
                       // $("#resultado").html("<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">");
                    },
                    success:  function (response) {

                        $("#tabla_nueva").html(response);
                    }
                });

            });

        });


    </script>


EOT
);

$layout->get_header();


$select_form = '';

   $result=mysql_query("SELECT tipo FROM min_tipo_inventario");
        while($test = mysql_fetch_array($result)){

            $select_form .= "<option>". $test['tipo']."</option>";
        }


$table_form = '';

$result=mysql_query("SELECT * FROM min_productos_servicios ORDER BY nombre");
$acum_costo_total = 0;
while($test = mysql_fetch_array($result))
{
    $id = $test['codigo'];


    $codigo_alias = $test['codigo_alias'];
    $nombre_articulo = $test['nombre'];

    $fecha_adquisicion = $test['fecha_adquisicion'];
    $ubicacion = $test['ubicacion'];
    $inventario = $test['inventario'];
    $mco_unidad = $test['mco_unidad'];




    $sql2 ="SELECT tipo FROM min_tipo_inventario where codigo='" . $inventario . "'";
    $result2 = mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);
    if (!$result2)
    {
        die("Error: Data not found.. de tipo inventario");
    }
    $nombre_inventario = $test2['tipo'];



    $sql2 ="SELECT descripcion FROM mco_unidad where codigo='" . $mco_unidad . "'";
    $result2 = mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);
    if (!$result2)
    {
        die("Error: Data not found.. de tipo unidad");
    }
    $nombre_unidad = $test2['descripcion'];



    $sql2 ="SELECT * FROM min_valoracion where codigo_producto='" . $id . "'";
    $result2 = mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);
    if (!$result2)
    {
        die("Error: Data not found.. de tipo unidad");
    }
    $cantidad_existente = $test2['unidades'];
    $costo_total = $test2['costo_total'];
    $costo_unidad = $test2['promedio_actual'];
    $acum_costo_total +=$costo_total;


    $table_form .= "<td><font color='black'>". $codigo_alias . "</font></td>";
    $table_form .= "<td><font color='black'>". $nombre_articulo . "</font></td>";

    $table_form .= "<td><font color='black'>". $fecha_adquisicion. "</font></td>";
    $table_form .= "<td><font color='black'>". $ubicacion. "</font></td>";
    $table_form .= "<td><font color='black'>".$nombre_inventario . "</font></td>";
    $table_form .= "<td><font color='black'>".$nombre_unidad . "</font></td>";
    $table_form .= "<td style='text-align: right'><font color='black'>".formatear_ve($cantidad_existente) . "</font></td>";
    $table_form .= "<td style='text-align: right'><font color='black'>".formatear_ve($costo_unidad) . "</font></td>";
    $table_form .= "<td style='text-align: right'><font color='black'>".formatear_ve($costo_total) . "</font></td>";


    $table_form .= "<td> <a href ='inventario_mod.php?codigo=$id'>Modificar</a>";

    $table_form .=  "</tr>";

}
$table_form .= "<td><font color='black'>Total</font></td>";
$table_form .= "<td><font color='black'></font></td>";

$table_form .= "<td><font color='black'></font></td>";
$table_form .= "<td><font color='black'></font></td>";
$table_form .= "<td><font color='black'></font></td>";
$table_form .= "<td><font color='black'></font></td>";
$table_form .= "<td><font color='black'></font></td>";
$table_form .= "<td><font color='black'></font></td>";


$table_form .= "<td><font color='black'>".formatear_ve($acum_costo_total) . "</font></td>";
$table_form .= "<td><font color='black'></font></td>";




$layout->set_form(

    <<<EOT
     <formmethod="post" name="inventario_ver"  id="contact-form">
    <div class="formLayout">
    <fieldset>

     <label>Tipo de Inventario</label>

     <select id="inventario">
           <option>Total Inventario</option>
            $select_form
    </select>

 <table border=none class="tablas-nuevas" id="tabla_nueva">

<tr style="text-align: center">
    <th >Código</th>

    <th>Nombre de Artículo</th>


    <th>Fecha Adquisicion</th>
    <th>Ubicación</th>
    <th>Tipo de Inventario</th>
    <th>Unidad de Medida</th>

    <th>Existencia Actual (Unidades)</th>
    <th> Valor Unidad </th>
    <th>Existencia Actual (Bs)</th>
    <th></th>

</tr>

<tr>
$table_form
 </tr>
</table>

<br/>
 <a href="../../min_menu.php"><input type="button" value="Atras"></a>

         </div>
    </fieldset>
    </form>


EOT

);

$layout->get_footer();
mysql_close($conn);