<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 03:22 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

include_once("../../clases/Paginador.php");

$a = new Seguridad();

$a->chekear_session();


include_once("../../clases/funciones.php");

$a = new Paginador("min_productos_servicios",$_GET['paso'],'Where min_productos_servicios.inventario = 12');

if (isset($_POST['id']) && isset($_POST['value'])){
    require_once ('../../clases/Validate.php');

    $validation = array(

        array('nombre' => 'id',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'value',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),

    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $value = str_replace(',','.',$_POST['value']);
        $id = $_POST['id'];

        $fecha_actual = fecha_sicap();


        $sql = "UPDATE min_valoracion
SET  unidades='1', costo_total='$value', promedio_actual='$value'
WHERE codigo_producto='$id';
";

        mysql_query($sql) or die('No se pudo guardar la información. valoracion '.mysql_error());

        $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual, fecha)
VALUES( $id, '1', '$value', '$value', '$fecha_actual');
";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());




        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = 'paso=' . $_GET['paso'];

        header('Location: '.$current_url[0].'?'.$primer_parametro.'&error=false&msg=Datos Guardados Correctamente');
        die;

    }else{
        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = 'paso=' . $_GET['paso'];

        header('Location: '.$current_url[0].'?'.$primer_parametro.'&error=true&msg=Debes Solo Ingeresar Valores Numericos con Coma');
        die;
    }

}

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm(' Módulo de de Inventarios | Actualizar no Inventariables');



$layout->append_to_header(
    <<<EOT
   <script type="text/javascript">

        $(function() {


//post-link
            $(".hola").on('click', function(event) {



                var id = $(this).attr('id');
                var valor = $("#valor" +id ).val();

                event.preventDefault();
                    $('body').append($('<form/>', {
                        id: 'form',
                        method: 'POST',
                        action: '#'
                    }));

                    $('#form').append($('<input/>', {
                        type: 'hidden',
                        name: 'id',
                        value: id
                    }));

                    $('#form').append($('<input/>', {
                        type: 'hidden',
                        name: 'value',
                        value: valor
                    }));

                    $('#form').submit();

                    return false;
                });



        })//jquery


    </script>
EOT
);

$layout->get_header();


$table_form = '';

$result=mysql_query("SELECT
        min_productos_servicios.codigo as codigo,
        min_productos_servicios.nombre as nombre,
        min_productos_servicios.fecha_adquisicion as fecha_adquisicion,
        min_productos_servicios.ubicacion as ubicacion,
        min_productos_servicios.observacion as observacion,
        min_tipo_inventario.tipo as tipo,
        mco_unidad.descripcion as descripcion,
        mco_unidad.sigla as sigla,
	min_valoracion.promedio_actual as precio
    FROM
        min_productos_servicios
            INNER JOIN
        min_tipo_inventario ON min_productos_servicios.inventario = min_tipo_inventario.codigo
            INNER JOIN
        mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
        	INNER JOIN
	min_valoracion ON min_valoracion.codigo_producto = min_productos_servicios.codigo
        WHERE min_productos_servicios.eliminado = 'no' AND min_productos_servicios.inventario = 12
        ORDER BY min_productos_servicios.nombre " . $a->print_sql_limit()
);

while($test = mysql_fetch_array($result))
{


    $id = $test['codigo'];
    $precio = $test['precio'];

    $sql2 = "SELECT  max(min_valoracion_historico.fecha) as fecha FROM min_valoracion_historico WHERE codigo_producto = '$id'";
    $result2=mysql_query($sql2);

    $test2 = mysql_fetch_array($result2);
    $fecha = $test2['fecha'];

    $fecha_actual = fecha_sicap();

    $b =  dateDiff($fecha,$fecha_actual );


    $table_form .=  "<tr align='center'>";
    //$table_form .= "<td><font color='black'>" .$test['codigo']."</font></td>";

    if($b > 15){

        $table_form .= "<td style='background-color: #dc4241' ><font color='black'>". utf8_multiplataforma($test['nombre']) ."</font></td>";

        $table_form .=  "<td style='background-color: #dc4241'>  <input type='text' id='valor" .$id."' value='". formatear_ve($precio) ."'/>  </td>";
        $table_form .= "<td style='background-color: #c83c3b'> <a href ='#' class='hola' id='$id'>Actualizar</a> </td>";
    }else{
        $table_form .= "<td  ><font color='black'>". utf8_multiplataforma($test['nombre']) ."</font></td>";

        $table_form .=  "<td >  <input type='text' id='valor" .$id."' value='". str_replace('.','',formatear_ve($precio))  ."'/>  </td>";
        $table_form .= "<td > <a href ='#' class='hola' id='$id'>Actualizar</a> </td>";
    }
    $table_form .=  "</tr>";
}



$layout->set_form(

    <<<EOT
  {$a->print_sql_foot()}
  <br/>
  <br/>

     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>
  <table border=none class="tablas-nuevas">

    <tr style="text-align: center">
        <th style="min-width: 250px">Nombre</th>

        <th>Valor</th>

        <th></th>

    </tr>
$table_form
  </table>

  <br/>
  <br/>
  {$a->print_sql_foot()}

  <br/>
  <br/>
   <a href="../../min_menu.php"><input type="button" value="Atras"></a>

 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);