<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 09:38 AM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


$sql = "SELECT * FROM mno_gerencia ORDER BY profundidad";

$result=mysql_query($sql);



$depende = [];

while($test = mysql_fetch_array($result)){
    $descripcion = $test['descripcion'];
    $nombre_depende = $test['nombre_depende'];

    $depende[$descripcion] = $nombre_depende ;
    // $depende[$descripcion] = $nombre_depende;
}


include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Ver Organigrama(estructura)');



$layout->append_to_header(
    <<<EOT

EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
<div style="color:#0db1bd;font-size: 1.5em;font-weight: bold;" >Organigrama</div>

<iframe src="./unidad.php" frameborder="0" width="150%" height="500"></iframe>

<a href="/sicap/mco_menu.php"><input type="button" value="Atras"></a>


EOT

);

$layout->get_footer();
mysql_close($conn);