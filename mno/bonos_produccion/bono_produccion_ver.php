<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 10:12 AM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


//POST

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm(' Módulo de Nómina | Bonos de Produccion');



$layout->append_to_header(
    <<<EOT

EOT
);

$table_from = '';

$result=mysql_query("

SELECT
    mno_new_bonos_produccion.codigo as codigo,
    mno_new_bonos_produccion.nombre as nombre,
    mno_new_bonos_produccion.valor as valor,
    mco_forma_pago.nombre as tipo_pago,
    mco_periocidad.nombre as periocidad
FROM
    mno_new_bonos_produccion
        INNER JOIN
    mco_periocidad ON mco_periocidad.codigo = mno_new_bonos_produccion.tipo_periocidad
        INNER JOIN
    mco_forma_pago ON mco_forma_pago.codigo = mno_new_bonos_produccion.tipo_forma_pago
WHERE mno_new_bonos_produccion.eliminado = 'no'
");
while($test = mysql_fetch_array($result)){

    $id = $test['codigo'];
    $nombre = $test['nombre'];
    $valor = $test['valor'];
    $tipo_pago = $test['tipo_pago'];
    $periocidad = $test['periocidad'];



    $table_from .= "<tr align='center'>";
    $table_from .= "<td><font color='black'>". $nombre . "</font></td>";
    $table_from .= "<td><font color='black'>". $valor. "</font></td>";
    $table_from .= "<td><font color='black'>". $tipo_pago. "</font></td>";
    $table_from .= "<td><font color='black'>". $periocidad. "</font></td>";



    $table_from .= "<td> <a href ='bono_produccion_mod.php?id=$id'>Modificar</a></td>";
    $table_from .= "<td> <a href ='bono_produccion_del.php?id=$id'>Borrar</a></td>";
    $table_from .= "</tr>";
}


$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>

     <table border=none class="tablas-nuevas">

        <tr id="tmp" style="text-align: center">
            <th>Nombre</th>
            <th>Valor</th>
            <th>Tipo de Pago</th>
            <th>Periocidad</th>

            <th></th>
            <th></th>

        </tr>
        <tr >
        $table_from


        </tr>
         </table>

 <br/>

    <a href="./nuevo_bono.php"><input type="button" value="Atras"></a>
 
 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);