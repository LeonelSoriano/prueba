<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 20/09/14
 * Time: 02:01 PM
 */

/**

 *
 * @package sicap
 * @author Leonel Soriano
 * @copyright GPL 3
 * @version 1.0
 * @access publichola.php
 */

ini_set('display_errors', 'On');
ini_set('display_errors', 1);





class ReporteLista
{


    private $_config_head;

    private $_pdf;

    private $_nombre_empresa;
    private $_rif;
    private $_imagen_path;
    private $_extras;


    private  $array_money;

    private $sub_divicion;

    public function __construct()
    {

        require_once (__DIR__.'/fpdf/fpdf.php');
        require_once (__DIR__.'/fpdf/mc_table.php');
        require_once (__DIR__.'/funciones.php');
        require_once (__DIR__.'/../db.php');


        $this->_pdf = new PDF_MC_Table();
        $this->array_money = array();

        $this->_config_head = false;
        $this->_config_body = false;

        $extras['Reportes de Turnos '] = "";


        $this->sub_divicion = -1;
//$reporte->add_event("2");

        //$this->_pdf->a($this->config_head("Colchones Silys, C.A.",'j-30598122-1','./../../images/1.jpg',$extras));
        //$this->_pdf->event = create_function('$echo', 'echo $echo;' );

    }


    public function  salto_pagina(){
        if($this->_pdf->next_page == true){
            $this->_pdf->next_page = false;

            //$this->print_header();
        }else{

                $height_of_cell = 60; // mm
                $page_height = 330; // mm (portrait letter)
                $bottom_margin = 0; // mm
                for($i=0;$i<=100;$i++) {
                    $block=floor($i/6);

                    $space_left=$page_height-($this->_pdf->GetY()+$bottom_margin); // space left on page

                    if ($i/6==floor($i/6) && $height_of_cell > $space_left) {
                        //$this->_pdf->AddPage(); // page break

                        $this->print_header();
                    }
                }
        }
    }

    public function print_header()
    {


//        if(!$this->_configurado_header){
//            throw new Exception('Configura el header primero');
//        }
        $this->_pdf->setBordes(false);
        $this->_pdf->SetMargins(40,10,50,0);

        $this->_pdf->AddPage();
        $this->_pdf->Image($this->_imagen_path,15,5,28,28);
        $this->_pdf->Ln(1);
        $this->_pdf->SetFont('Arial', 'B', 18);

        //$this->_pdf->Cell(120, 8, $this->_nombre_empresa, 1,0);
        $this->_pdf->Ln(8);
        $this->_pdf->SetMargins(10,10,50,0);

        $this->_pdf->SetFont('Arial', '', 12);
        $this->_pdf->Text(77, 25,$this->_nombre_empresa );


        $this->_pdf->SetFont('Arial', '', 10);



        $letra = utf8_multiplataforma("Dirección Fiscal:  ") . $this->_rif;
        $cantidad = strlen($letra);


        //strlen(utf8_multiplataforma("Dirección Fiscal:  ") . $this->_rif)



        $this->_pdf->Text(15, 38,$letra);

        $this->_pdf->setBordes(true);



        //Table with 20 rows and 4 columns
//Table with 20 rows and 4 columns
        $this->_pdf->Ln(15);
        $this->_pdf->SetFont('Arial', '', 10);
        $this->_pdf->SetWidths(array(50, 80));

        if($this->_extras != null){
            foreach($this->_extras as $key => $value){

                $this->_pdf->Row(array($key, $value ));

            }
        }

        $fecha_Acutual = fecha_sicap();

        $this->_pdf->Cell(175, 5, $fecha_Acutual . '   ' . utf8_multiplataforma('Página: ') . $this->_pdf->PageNo(), 0,0,'R');
        $this->_pdf->Ln(8);
        $this->_pdf->SetMargins(20,10,50,0);
        $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin+8,$this->_pdf->GetY()); $this->_pdf->SetMargins(10,10,50,0);
        $this->_pdf->Ln(6);
    }


    public function  print_celda($ancho_celdas,$array_key,$border=true){

//Table with 20 rows and 4 columns

        $this->salto_pagina();

        $this->_pdf->SetWidths($ancho_celdas);
        $this->_pdf->setBordes($border);
        $this->_pdf->Row($array_key);


    }


    //$imagen_path,$nombre_empresa,$rif,$extras = null
    public function  config_head($nombre_empresa,$rif,$imagen_path,$extras = null)
    {
        if($this->_config_head == false){
            $this->_nombre_empresa = $nombre_empresa;
            $this->_rif = $rif;
            $this->_imagen_path = $imagen_path;
            $this->_extras = $extras;
        }
        $this->_config_head = true;


        $this->_pdf->SetMargins(40,10,50,0);

        $this->_pdf->AddPage();
        $this->_pdf->Image($imagen_path,15,5,28,28);
        $this->_pdf->Ln(1);
        $this->_pdf->SetFont('Arial', 'B', 12);

        //$this->_pdf->Cell(120, 8, $nombre_empresa, 1,0);
        $this->_pdf->Ln(8);

        $this->_pdf->Text(75, 20, $this->_nombre_empresa);
        $this->_pdf->SetFont('Arial', '', 10);
        $this->_pdf->SetX(1);





        $letra = utf8_multiplataforma("Dirección Fiscal:  ") . $this->_rif;
        $cantidad = strlen($letra);

        $this->_pdf->Text(18, 38, $letra);
        //$this->_pdf->Cell(2, 35, 'hola', 0,0,'R');
        $this->_pdf->setBordes(false);


        //Table with 20 rows and 4 columns
//Table with 20 rows and 4 columns

        $this->_pdf->SetMargins(22,0,0,0);
        $this->_pdf->Ln(15);
        $this->_pdf->SetFont('Arial', '', 10);
//        $this->_pdf->SetWidths(array(50, 80));
//        if($extras != null){
//            foreach($extras as $key => $value){
//
//                $this->_pdf->Row(array($key, $value ));
//                //echo($key);
//
//            }
//        }


        $fecha_Acutual = fecha_sicap();

        $this->_pdf->SetFont('Arial', '', 10);
        $this->_pdf->Cell(175, 5, $fecha_Acutual . '   ' . utf8_multiplataforma('Página: ') . $this->_pdf->pagina, 0,0,'R');
        $this->_pdf->Ln(8);
        $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin+8,$this->_pdf->GetY());
        $this->_pdf->Ln(5   );


    }

    public function config_body($sql)
    {
        $this->_config_body = true;

        $result=mysql_query($sql);

        $jump = false;//para saltar el nuero en el array de mysql
        $get_ancho = false;//candodo para ver cuatas columnas trae el sq
        $ancho_itenes = []; //esto es para calcular cada ancho en el item de mysql

        /** el acho maximo de el reporte es de 168 */
        $ancho_maximo = 186;

        $this->_pdf->SetMargins(10,20,0,0);
        $this->_pdf->setBordes(true);

        $this->_pdf->Ln(1);

        $array_key  = [];




        while($test = mysql_fetch_array($result)){

            if($this->_pdf->next_page == true){



                /*empieza*/
                $this->_pdf->SetMargins(40,10,50,0);

                $this->_pdf->AddPage();
                $this->_pdf->Image($this->_imagen_path,15,5,28,28);
                $this->_pdf->Ln(1);
                $this->_pdf->SetFont('Arial', 'B', 12);

                //$this->_pdf->Cell(120, 8, $nombre_empresa, 1,0);
                $this->_pdf->Ln(8);

                $this->_pdf->Text(75, 20, $this->_nombre_empresa);
                $this->_pdf->SetFont('Arial', '', 10);
                $this->_pdf->SetX(1);





                $letra = utf8_multiplataforma("Dirección Fiscal:  ") . $this->_rif;
                $cantidad = strlen($letra);

                $this->_pdf->Text(18, 38, $letra);
                //$this->_pdf->Cell(2, 35, 'hola', 0,0,'R');
                $this->_pdf->setBordes(false);


                //Table with 20 rows and 4 columns
//Table with 20 rows and 4 columns

                $this->_pdf->SetMargins(10,0,0,0);
                $this->_pdf->Ln(15);
                $this->_pdf->SetFont('Arial', '', 10);
//        $this->_pdf->SetWidths(array(50, 80));
//        if($extras != null){
//            foreach($extras as $key => $value){
//
//                $this->_pdf->Row(array($key, $value ));
//                //echo($key);
//
//            }
//        }


                $fecha_Acutual = fecha_sicap();

                $this->_pdf->SetFont('Arial', '', 10);
                $this->_pdf->Cell(185, 5, $fecha_Acutual . '   ' . utf8_multiplataforma('Página: ') . $this->_pdf->pagina, 0,0,'R');
                $this->_pdf->Ln(8);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-2,$this->_pdf->GetY());
                $this->_pdf->Ln(5   );





                /*temrina*/

                /*         $this->_pdf->SetMargins(40,10,50,0);

                         $this->_pdf->AddPage();
                         $this->_pdf->Image($this->_imagen_path,15,5,28,28);
                         $this->_pdf->Ln(1);
                         $this->_pdf->SetFont('Arial', 'B', 18);

                         $this->_pdf->Cell(120, 8, $this->_nombre_empresa, 1,0);
                         $this->_pdf->Ln(8);

                         $this->_pdf->SetFont('Arial', '', 14);
                         $this->_pdf->Cell(120, 8, "R.I.F  " . $this->_rif, 0,0,'R');
                         $this->_pdf->setBordes(false);


                         //Table with 20 rows and 4 columns
         //Table with 20 rows and 4 columns
                         $this->_pdf->SetMargins(15,0,0,0);

                         $this->_pdf->Ln(15);
                         $this->_pdf->SetFont('Arial', '', 10);
                         $this->_pdf->SetWidths(array(50, 80));
                         if($this->_extras != null){
                             foreach($this->_extras as $key => $value){

                                 $this->_pdf->Row(array($key, $value ));
                                 //echo($key);

                             }
                         }
                         $fecha_Acutual = fecha_sicap();

                         $this->_pdf->Cell(175, 5, $fecha_Acutual . '   ' . utf8_multiplataforma('Página: ') . $this->_pdf->pagina, 0,0,'R');
                         $this->_pdf->Ln(6);
                         $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin+8,$this->_pdf->GetY());
                         $this->_pdf->Ln(4);
                         $this->_pdf->SetWidths($ancho_itenes);
                         $this->_pdf->SetMargins(15,0,0,0);*/
            }//head

            $array_value = [];

            $index = 0;
            foreach($test as $key => $value){


                if(!$jump){
                    $jump = true;
                    continue;
                }else if($jump){
                    $jump =false;
                }

                if(!$get_ancho){
                    //esto da la parte de los nombres
                    array_push($array_key,utf8_decode( $key));

                }


                if(count($this->array_money) > 0){

                    $exist = false;
                    for($i = 0;$i < count($this->array_money);$i++){


                        if($this->array_money[$i] == $index){
                            $exist = true;
                            array_push( $array_value, utf8_decode(utf8_decode( formatear_ve($value))));
                        }
                    }
                    if(!$exist){
                        array_push( $array_value, utf8_decode(utf8_decode( $value)));
                    }
                }else{
                    array_push( $array_value, utf8_decode(utf8_decode( $value)));

                }


                $index ++;

            }

            if(!$get_ancho){
                $get_ancho = true;
                $ancho = count($test)/2;
                for($i = 0; $i < $ancho;$i++){
                    $ancho_celda = ($ancho_maximo/ $ancho) ;

                    array_push($ancho_itenes,$ancho_celda);

                }
                $this->_pdf->SetWidths($ancho_itenes);
                $this->_pdf->setGlobalAlight('C');
                $this->_pdf->setBordes(true);
                $this->_pdf->SetWidths($ancho_itenes);
                ///  $this->_pdf->SetFillColor(172,172,234);
                $this->_pdf->set_my_color(172,172,234);
                $this->_pdf->SetFont('Arial', 'B', 7);


                $this->print_celda($ancho_itenes,$array_key);

            }
            /// $this->_pdf->SetFillColor(255,255,255);
            $this->_pdf->set_my_color(255,255,255);
            $this->_pdf->setGlobalAlight('L');
            $this->_pdf->setBordes(true);


            $this->_pdf->SetFont('Times', '', 6);
            $this->print_celda($ancho_itenes,$array_value);




        }



    }




    public function  add_money_format($val){
        array_push($this->array_money,$val);
    }



    public function  exec()
    {
        $this->_pdf->Output();
    }


    public function  sub_divicion($value){
        $this->sub_divicion = $value;
    }

}