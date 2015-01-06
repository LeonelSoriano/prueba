<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 18/12/14
 * Time: 10:01 AM
 */

ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once("../../db.php");

include_once("../../clases/ChartFactory.php");
include("../../clases/funciones.php");

$a = new ChartFactory('Inventarios');


//$filtrado_sql = $_POST['filtrado'];



$sql = "SELECT * FROM (SELECT
    min_tipo_inventario.tipo as nombre,
    sum(min_valoracion.unidades * min_valoracion.promedio_actual) as total,
    min_tipo_inventario.codigo as inventario
FROM
    min_productos_servicios INNER JOIN min_valoracion
        ON min_valoracion.codigo_producto = min_productos_servicios.codigo
    INNER JOIN min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
    WHERE min_tipo_inventario.tipo <> '12'
GROUP BY min_tipo_inventario.tipo) q1
WHERE q1.inventario <> 12 AND q1.total <> 0";

$result=mysql_query($sql);


$valores = array();
$nombres = array();

$filtrado = $_POST['chart'];

while($test = mysql_fetch_array($result))
{
    $nombre_inventario = $test['nombre'];
    $total_inventario = $test['total'];

    if($filtrado == "bar_value"){
        array_push($nombres,$nombre_inventario );
    }else{
        array_push($nombres,$nombre_inventario );
    }
    array_push($valores,(float)$total_inventario);

}


//$tipo,$nombres,$valores,$barra_horisontal='',$barra_vertical=''



if($filtrado == "pie2d"){
    $a->create_chart(0,$valores,$nombres);
}else if($filtrado == "pie3d"){
    $a->create_chart(1,$valores,$nombres);
}else if($filtrado == "bar_value"){
    $a->create_chart(2,$valores,$nombres,'Inventario','Costo');
}else if($filtrado == "bar_porcent"){
    $a->create_chart(3,$valores,$nombres,'Inventario','Costo');
}

mysql_close($conn);

// include_once("../../db.php");
//include("../../clases/funciones.php");
//
//$sql = "SELECT * FROM (SELECT
//    min_tipo_inventario.tipo as nombre,
//    sum(min_valoracion.unidades * min_valoracion.promedio_actual) as total,
//    min_tipo_inventario.codigo as inventario
//FROM
//    min_productos_servicios INNER JOIN min_valoracion
//        ON min_valoracion.codigo_producto = min_productos_servicios.codigo
//    INNER JOIN min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
//    WHERE min_tipo_inventario.tipo <> '12'
//GROUP BY min_tipo_inventario.tipo) q1
//WHERE q1.inventario <> 12 AND q1.total <> 0";
//
//$result=mysql_query($sql);
//
//$valores = array();
//$nombres = array();
//
//while($test = mysql_fetch_array($result))
//{
//    $nombre_inventario = $test['nombre'];
//    $total_inventario = $test['total'];
//
//    array_push($valores,$nombre_inventario .' ' . formatear_ve($total_inventario));
//    array_push($nombres,(float)$total_inventario);
//
//}
//
//
// include("../../pChart/class/pData.class.php");
// include("../../pChart/class/pDraw.class.php");
// include("../../pChart/class/pPie.class.php");
// include("../../pChart/class/pImage.class.php");
//
//
// $x_global = 800;
// $y_global =  550;
//
//
// /* Create and populate the pData object */
//
//$MyData2 = new pData();
//
//$MyData2->addPoints($nombres,"ScoreA");
//
//$MyData2->setSerieDescription("ScoreA","Application A");
//
//$MyData2->loadPalette("../../pChart/palettes/leonel.color", TRUE);
///* Define the absissa serie */
//$MyData2->addPoints($valores,"Labels");
//$MyData2->setAbscissa("Labels");
//
//
// $MyData = new pData();
//
// $MyData->addPoints(array(50,2,3,4,7,10,25,48,41,10),"ScoreA");
//
// $MyData->setSerieDescription("ScoreA","Application A");
//
//
// /* Define the absissa serie */
// $MyData->addPoints(array("A0","ñññ","C2","D3","E4","F5","G6","H7","I8","J9"),"Labels");
// $MyData->setAbscissa("Labels");
//
// /* Create the pChart object */
// $myPicture = new pImage($x_global,$y_global,$MyData);
//
// /* Draw a solid background */
// $Settings = array("R"=>221, "G"=>221, "B"=>226, "Dash"=>1, "DashR"=>52, "DashG"=>91, "DashB"=>94);
// //$myPicture->drawFilledRectangle(0,0,$x_global,$y_global,$Settings);
//
// /* Overlay with a gradient */
// $Settings = array("StartR"=>160, "StartG"=>221, "StartB"=>226, "EndR"=>52, "EndG"=>91, "EndB"=>94, "Alpha"=>50);
// $myPicture->drawGradientArea(0,0,$x_global,$y_global,DIRECTION_VERTICAL,$Settings);
// $myPicture->drawGradientArea(0,0,$x_global,30,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));
//
// /* Add a border to the picture */
// $myPicture->drawRectangle(0,0,$x_global-1,$y_global-1,array("R"=>0,"G"=>0,"B"=>0));
//
//
// /* Write the picture title */
// $myPicture->setFontProperties(array("FontName"=>"../../pChart/fonts/verdana.ttf","FontSize"=>10));
// $myPicture->drawText(10,22,"Inventariósñ",array("R"=>255,"G"=>255,"B"=>255));
//
// /* Set the default font properties */
// $myPicture->setFontProperties(array("FontName"=>"../../pChart/fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));
//
// /* Enable shadow computing */
// //$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>50));
//
// /* Create the pPie object */
// $PieChart = new pPie($myPicture,$MyData2);
//
// /* Draw an AA pie chart */
// $PieChart->drawBarChart($x_global/2,$y_global/2,array("WriteValues"=>TRUE,"ValuePosition"=>1,"ValueR"=>0,"ValueG"=>0,"ValueB"=>0,"DataGapAngle"=>10,"DataGapRadius"=>6,"Radius"=>190,"DrawSubTicks"=>TRUE,"DrawArrows"=>TRUE,"ArrowSize"=>3,"DrawLabels"=>TRUE,"LabelStacked"=>TRUE,"Border"=>FALSE));
//
// /* Write the legend box */
// $myPicture->setShadow(FALSE);
// $PieChart->drawPieLegend(20,42,array("Alpha"=>20,"BoxSize"=>22,"FontName"=>"../../pChart/fonts/Forgotte.ttf","FontSize"=>8));
//
// /* Render the picture (choose the best way) */
// $myPicture->autoOutput("pictures/example.draw2DPie.labels.png");
//?>