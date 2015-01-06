<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 18/12/14
 * Time: 02:19 PM
 */

class ChartFactory {


    private $x_global;
    private $y_global;
    private $MyData;
    private $chart_name;

    function  __construct($nombre)
    {

        include_once(__DIR__ .'/../pChart/class/pData.class.php');
        include_once(__DIR__ .'/../pChart/class/pDraw.class.php');
        include_once(__DIR__ .'/../pChart/class/pPie.class.php');
        include_once(__DIR__ .'/../pChart/class/pImage.class.php');
        include_once(__DIR__ .'/../clases/funciones.php');

        $this->x_global = 1170;
        $this->y_global = 550;
        $this->MyData = new pData();

        $this->chart_name = $nombre;

    }

    public function create_chart($tipo,$nombres,$valores,$barra_horisontal='',$barra_vertical='')
    {

        if($tipo == 0){
            $this->pie_chart(1,$nombres,$valores);
        }else if($tipo == 1){
            $this->pie_chart(2,$nombres,$valores);
        }else if($tipo == 2){
            $this->bar_chart(4,$nombres,$valores,$barra_horisontal,$barra_vertical);
        }else if($tipo == 3){
            $this->bar_chart(3,$nombres,$valores,$barra_horisontal,$barra_vertical);
        }
    }

    private function pie_chart( $tipo,$nombres,$valores,$money = false)
    {
        for($i = 0; $i < count($valores);$i++){
            if($money){
                $valores[$i] = $valores[$i] . ' ' . formatear_ve($nombres[$i]);
            }else{
                $valores[$i] = $valores[$i] . ' ' . $nombres[$i];
            }

        }


        $this->MyData->addPoints($nombres,"ScoreA");

        $this->MyData->setSerieDescription("ScoreA","Application A");

        $this->MyData->loadPalette(__DIR__ ."/../pChart/palettes/leonel.color", TRUE);

        ///* Define the absissa serie */
        $this->MyData->addPoints($valores,"Labels");
        $this->MyData->setAbscissa("Labels");

         $myPicture = new pImage($this->x_global,$this->y_global,$this->MyData);

         /* Draw a solid background */
         $Settings = array("R"=>221, "G"=>221, "B"=>226, "Dash"=>1, "DashR"=>52, "DashG"=>91, "DashB"=>94);
         //$myPicture->drawFilledRectangle(0,0,$x_global,$y_global,$Settings);

         /* Overlay with a gradient */
         $Settings = array("StartR"=>160, "StartG"=>221, "StartB"=>226, "EndR"=>52, "EndG"=>91, "EndB"=>94, "Alpha"=>50);
         $myPicture->drawGradientArea(0,0,$this->x_global,$this->y_global,DIRECTION_VERTICAL,$Settings);
         $myPicture->drawGradientArea(0,0,$this->x_global,30,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

         /* Add a border to the picture */
         $myPicture->drawRectangle(0,0,$this->x_global-1,$this->y_global-1,array("R"=>0,"G"=>0,"B"=>0));


         /* Write the picture title */
         $myPicture->setFontProperties(array("FontName"=>"../../pChart/fonts/verdana.ttf","FontSize"=>10));
         $myPicture->drawText(10,22,$this->chart_name,array("R"=>255,"G"=>255,"B"=>255));

         /* Set the default font properties */
         $myPicture->setFontProperties(array("FontName"=>"../../pChart/fonts/Forgotte.ttf","FontSize"=>11,"R"=>80,"G"=>80,"B"=>80));

         /* Create the pPie object */
         $PieChart = new pPie($myPicture,$this->MyData);

         /* Draw an AA pie chart */
        if($tipo == 1) {
            $PieChart->draw2DPie($this->x_global / 2, $this->y_global / 2, array("WriteValues" => TRUE, "ValuePosition" => 1, "ValueR" => 0, "ValueG" => 0, "ValueB" => 0, "DataGapAngle" => 10, "DataGapRadius" => 6, "Radius" => 190, "DrawSubTicks" => TRUE, "DrawArrows" => TRUE, "ArrowSize" => 3, "DrawLabels" => TRUE, "LabelStacked" => TRUE, "Border" => FALSE));
        }else if($tipo == 2){
            $PieChart->draw3DPie($this->x_global / 2, $this->y_global / 2, array("WriteValues" => TRUE, "ValuePosition" => 1, "ValueR" => 0, "ValueG" => 0, "ValueB" => 0, "DataGapAngle" => 10, "DataGapRadius" => 6, "Radius" => 190, "DrawSubTicks" => TRUE, "DrawArrows" => TRUE, "ArrowSize" => 3, "DrawLabels" => TRUE, "LabelStacked" => TRUE, "Border" => FALSE));
        }
         /* Write the legend box */
         $myPicture->setShadow(FALSE);
         $PieChart->drawPieLegend(20,42,array("Alpha"=>20,"BoxSize"=>22,"FontName"=>"../../pChart/fonts/Forgotte.ttf","FontSize"=>8));

         /* Render the picture (choose the best way) */
         //$myPicture->autoOutput("pictures/example.draw2DPie.labels.png");


        $myPicture->render("image_name.png");

        $this->get_html();

    }


    private function  bar_chart( $tipo,$nombres,$valores,$barra_horisontal,$barra_vertical)
    {

        if($tipo == 3) {
            $cantidad_total = 0;


            if ($tipo == 3) {
                for ($i = 0; $i < count($nombres); $i++) {
                    $cantidad_total += $nombres[$i];
                }
            }


            for ($i = 0; $i < count($nombres); $i++) {

                $nombres[$i] = floor((($nombres[$i] * 100) / $cantidad_total) * 100) / 100;
            }
        }else{
            for ($i = 0; $i < count($nombres); $i++) {
                $nombres[$i] = floor($nombres[$i] )* 100 / 100;
            }
        }


        $MyData = new pData();
        $MyData->addPoints($nombres,$barra_horisontal);

        //$MyData->addPoints($valores,$barra_vertical);
        //$MyData->setAxisName(0,$barra_vertical);
        //$MyData->setSerieDescription($barra_vertical,$barra_vertical);
        $MyData->setAbscissa($barra_vertical);
        $MyData->setAbscissa($barra_vertical);
        $MyData->setAbscissa($barra_vertical);
        $MyData->setAbscissa($barra_vertical);


        if($tipo == 3){
        $MyData->leonel(100,'%');
        }
        //$MyData->leonel(100);
        //$MyData->setAxisDisplay(1,'%');
        //$MyData->setAxisDisplay(0,AXIS_FORMAT_CUSTOM,"YAxisFormat");
        /* Create the pChart object */
        $myPicture = new pImage($this->x_global,550,$MyData);
        $myPicture->setFontProperties(array("FontName"=>"../../pChart/fonts/verdana.ttf","FontSize"=>10));

        $myPicture->drawGradientArea(0,0,$this->x_global,550,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
        $myPicture->drawGradientArea(0,0,$this->x_global,550,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));

        $myPicture->drawGradientArea(0,0,$this->x_global,30,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));
        $myPicture->drawText(10,22,$this->chart_name,array("R"=>255,"G"=>255,"B"=>255));
        /* Draw the chart scale */
        $myPicture->setGraphArea(300,60,1130,480);
        $myPicture->setFontProperties(array("FontName"=>"../../pChart/fonts/verdana.ttf","FontSize"=>6));
        $myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

        /* Turn on shadow computing */
        $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

        /* Create the per bar palette */
        $Palette = array("0"=>array("R"=>74,"G"=>192,"B"=>242,"Alpha"=>100),
            "1"=>array("R"=>72,"G"=>198,"B"=>42,"Alpha"=>100),
            "2"=>array("R"=>184,"G"=>0,"B"=>40,"Alpha"=>100),
            "3"=>array("R"=>51,"G"=>42,"B"=>198,"Alpha"=>100),
            "4"=>array("R"=>227,"G"=>195,"B"=>38,"Alpha"=>100),
            "5"=>array("R"=>185,"G"=>106,"B"=>154,"Alpha"=>100),
            "6"=>array("R"=>0,"G"=>39,"B"=>94,"Alpha"=>100),
            "7"=>array("R"=>224,"G"=>176,"B"=>46,"Alpha"=>100),
            "8"=>array("R"=>74,"G"=>192,"B"=>242,"Alpha"=>100),
            "9"=>array("R"=>72,"G"=>198,"B"=>42,"Alpha"=>100),
            "10"=>array("R"=>184,"G"=>0,"B"=>40,"Alpha"=>100),
            "11"=>array("R"=>51,"G"=>42,"B"=>198,"Alpha"=>100),
            "12"=>array("R"=>227,"G"=>195,"B"=>38,"Alpha"=>100),
            "13"=>array("R"=>185,"G"=>106,"B"=>154,"Alpha"=>100),
            "14"=>array("R"=>0,"G"=>39,"B"=>94,"Alpha"=>100),
            "15"=>array("R"=>224,"G"=>176,"B"=>46,"Alpha"=>100),
            "16"=>array("R"=>74,"G"=>192,"B"=>242,"Alpha"=>100),
            "17"=>array("R"=>72,"G"=>198,"B"=>42,"Alpha"=>100),
            "18"=>array("R"=>184,"G"=>0,"B"=>40,"Alpha"=>100),
            "19"=>array("R"=>51,"G"=>42,"B"=>198,"Alpha"=>100),
            "20"=>array("R"=>227,"G"=>195,"B"=>38,"Alpha"=>100),
            "21"=>array("R"=>185,"G"=>106,"B"=>154,"Alpha"=>100),
            "22"=>array("R"=>0,"G"=>39,"B"=>94,"Alpha"=>100),
            "23"=>array("R"=>224,"G"=>176,"B"=>46,"Alpha"=>100),
            "24"=>array("R"=>74,"G"=>192,"B"=>242,"Alpha"=>100),
            "25"=>array("R"=>72,"G"=>198,"B"=>42,"Alpha"=>100),
            "26"=>array("R"=>184,"G"=>0,"B"=>40,"Alpha"=>100),
            "27"=>array("R"=>51,"G"=>42,"B"=>198,"Alpha"=>100),
            "28"=>array("R"=>227,"G"=>195,"B"=>38,"Alpha"=>100),
            "29"=>array("R"=>185,"G"=>106,"B"=>154,"Alpha"=>100),
            "30"=>array("R"=>0,"G"=>39,"B"=>94,"Alpha"=>100),
            "31"=>array("R"=>224,"G"=>176,"B"=>46,"Alpha"=>100),

        );

        /* Draw the chart */
        $myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>30,"OverrideColors"=>$Palette));

//        $PieChart->drawPieLegend(20,42,array("Alpha"=>20,"BoxSize"=>22,"FontName"=>"../../pChart/fonts/Forgotte.ttf","FontSize"=>8));


//$myPicture->drawLegend(570,215,array("Alpha"=>20,"BoxSize"=>22,"FontName"=>"../../pChart/fonts/Forgotte.ttf","FontSize"=>8));
$myPicture->my_leyenda(15,50,$valores);
        /* Render the picture (choose the best way) */
        //$myPicture->autoOutput("./ejemplo.png");
        $myPicture->render("image_name.png");

        $this->get_html();
    }



    private function get_html(){
        echo(

            "
                <!doctype html>
                <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <title>Document</title>
                </head>
                <body>
                <img src='./image_name.png?".rand()."' alt='no esta'/>
                </body>
                </html>



                "
        );
    }



}

