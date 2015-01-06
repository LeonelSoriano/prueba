<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/10/14
 * Time: 10:02 AM
 */

ini_set('display_errors', 'On');
ini_set('display_errors', 1);



class ReporteDivicion{


    private $_array_money;


    private $_pdf;

    //array_minihead
    private $array_minihead;
    private $result_sql;


    //configurarion de header
    private $_nombre_empresa;
    private $_rif;
    private $_imagen_path;
    private $_extras;
    private $_configurado_header;

    private $prefix_subdivicion;



    private $divicion_index;


    private $responce_db;


    public function  __construct()
    {
        require_once (__DIR__.'/fpdf/fpdf.php');
        require_once (__DIR__.'/fpdf/mc_table.php');
        require_once (__DIR__.'/funciones.php');


        $this->_pdf = new PDF_MC_Table();

        $this->_configurado_header;

        $this->array_minihead = array();

        $this->result_sql = array();

        $this->_array_money = array();

        $this->_divicion_index = -1;
        $this->prefix_subdivicion = '';

        $this->responce_db = false;

    }



    public function configure_header($nombre_empresa,$rif,$imagen_path,$extras = null)
    {
        $this->_nombre_empresa = $nombre_empresa;
        $this->_rif = $rif;
        $this->_imagen_path = $imagen_path;
        $extras = $extras;
        $this->_configurado_header = true;;

    }


    public function print_header()
    {


        if(!$this->_configurado_header){
            throw new Exception('Configura el header primero');
        }
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
                //echo($key);

            }
        }

        $fecha_Acutual = fecha_sicap();

        $this->_pdf->Cell(175, 5, $fecha_Acutual . '   ' . utf8_multiplataforma('Página: ') . $this->_pdf->pagina, 0,0,'R');
        $this->_pdf->Ln(8);
        $this->_pdf->SetMargins(20,10,50,0);
        $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin+8,$this->_pdf->GetY()); $this->_pdf->SetMargins(10,10,50,0);
        $this->_pdf->Ln(6);
    }


    public function exec_sql($sql)
    {

        $jump = false;//para saltar el nuero en el array de mysql

        $result=mysql_query($sql);

        $primera_entrada = true;

        $array_infornmacion_tmp =null;
        $index = 0;


//        if($result != false){
//            $this->responce_db = true;
//        }

        while($test = mysql_fetch_array($result)){

            $array_infornmacion_tmp = array();
            foreach($test as $key => $value){
                if(!$jump){
                    $jump = true;
                    continue;
                }else if($jump){
                    $jump =false;
                }

                if($primera_entrada){
                    array_push($this->array_minihead,$key);
                }
                array_push($array_infornmacion_tmp,$value);
            }

            $this->result_sql[$index] = $array_infornmacion_tmp;
            $index++;
            $primera_entrada = false;
            $this->responce_db = true;

        }




    }


    public function print_body()
    {

        if(!$this->responce_db){
            return;
        }

        $ancho_maximo = 186;
        $tmp_nombre_divcion = '';
        $this->_pdf->SetMargins(40,10,50,0);

        $ancho_celdas = array();


        $cantidad_columnas = (count($this->result_sql[0])-1);

        for($i = 0; $i < $cantidad_columnas;$i++){
            $ancho_celda = ($ancho_maximo/ $cantidad_columnas) ;

            array_push($ancho_celdas,$ancho_celda);

        }

//
        if($this->_divicion_index >= 0){
            $tmp_nombre_divcion = $this->result_sql[0][$this->_divicion_index];

            $this->_pdf->SetFont('Times', '', 14);
            $this->_pdf->Cell(0, 8, $this->prefix_subdivicion . $tmp_nombre_divcion, 0,0,'');

            unset($this->array_minihead[$this->_divicion_index]);
            $this->array_minihead = array_values($this->array_minihead);

            $this->mini_head_print($ancho_celdas,$this->array_minihead);

        }




        for($i = 0 ; $i < count($this->result_sql);$i++){


            if($this->_pdf->next_page == true){
                $this->print_header();
                $this->_pdf->SetWidths($ancho_celdas);
                $this->_pdf->next_page = false;
            }


            if($tmp_nombre_divcion != $this->result_sql[$i][$this->_divicion_index]){


                $tmp_nombre_divcion = $this->result_sql[$i][$this->_divicion_index];
                $this->_pdf->Ln(4);
                $this->_pdf->SetFont('Times', '', 14);
                $this->_pdf->SetMargins(20,10,50,0);
                $this->_pdf->Cell(0, 8,$this->prefix_subdivicion . $tmp_nombre_divcion, 0,0,'');


                $this->mini_head_print($ancho_celdas,$this->array_minihead);
            }


            unset($this->result_sql[$i][$this->_divicion_index]);

            $this->result_sql[$i] = array_values($this->result_sql[$i]);



            for($j = 0 ; $j < count($this->result_sql[$i]);$j++){
                $this->result_sql[$i][$j] = utf8_multiplataforma(utf8_multiplataforma($this->result_sql[$i][$j]));

                for($k = 0; $k < count($this->_array_money); $k++){
                    if($j == $this->_array_money[$k]){
                        $this->result_sql[$i][$j] = formatear_ve($this->result_sql[$i][$j]);
                    }
                }

            }

            $this->_pdf->set_my_color(255,255,255);
            $this->_pdf->setGlobalAlight('L');
            $this->_pdf->setBordes(true);
            $this->_pdf->SetMargins(10,10,50,0);
            $this->_pdf->SetFont('Times', '', 6);
            $this->_pdf->Row($this->result_sql[$i]);

        }

    }


    public function  exec()
    {
        $this->_pdf->Output();
    }


    private function mini_head_print($ancho_celdas,$array_key)
    {
        if($this->_pdf->next_page == true){
            $this->_pdf->next_page = false;
        }

        $this->_pdf->SetMargins(10,10,50,0);
        $this->_pdf->Ln(11);
        $this->_pdf->setBordes(true);
        $this->_pdf->set_my_color(172,172,234);
        $this->_pdf->SetFont('Times', '', 6);
        $this->_pdf->SetWidths($ancho_celdas);
        $this->_pdf->Row($array_key);


    }
    /**
     * @param int $divicion_index
     */
    public function setDivicionIndex($divicion_index)
    {
        $this->_divicion_index = $divicion_index;
    }

    /**
     * @param string $prefix_subdivicion
     */
    public function setPrefixSubdivicion($prefix_subdivicion)
    {
        $this->prefix_subdivicion = $prefix_subdivicion;
    }


    public function addMoney($index){
        array_push($this->_array_money,$index);
    }


    public function alinght($letra,$numero){
        $this->_pdf->SetAligns($letra,$numero);
    }
}

