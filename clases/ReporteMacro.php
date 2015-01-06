<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/12/14
 * Time: 10:20 AM
 */


ini_set('display_errors', 'On');
ini_set('display_errors', 1);



class ReporteMacro{


    private $_array_money;



    private $tipo_letra;
    private $ancho_letra;
    private $tamanhio_letra;

    public $_pdf;

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

    private $_tmp_subtema;
    private $index_sub_tema;

    private $divicion_index;


    private $responce_db;


    public function  __construct()
    {
        require_once ('../../clases/fpdf/fpdf.php');
        require_once ('../../clases/fpdf/mc_table.php');
        require_once ('../../clases/funciones.php');


        $this->_pdf = new PDF_MC_Table();

        $this->_configurado_header;

        $this->array_minihead = array();

        $this->result_sql = array();

        $this->_array_money = array();
        //$this->_array_total = array();

        $this->_divicion_index = -1;
        $this->index_sub_tema = -1;
        $this->prefix_subdivicion = '';

        $this->responce_db = false;

    }



    public function configure_header($nombre_empresa,$rif,$imagen_path,$extras = null)
    {
        $this->_nombre_empresa = $nombre_empresa;
        $this->_rif = $rif;
        $this->_imagen_path = $imagen_path;
        $extras = $extras;
        $this->_configurado_header = true;

    }


    public function  print_line($derecho,$izquierdo)
    {


        $this->_pdf->Line(10 + $derecho,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin,$this->_pdf->GetY());

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

            }
        }

        $fecha_Acutual = fecha_sicap();

        $this->_pdf->Cell(175, 5, $fecha_Acutual . '   ' . utf8_multiplataforma('Página: ') . $this->_pdf->PageNo(), 0,0,'R');
        $this->_pdf->Ln(8);
        $this->_pdf->SetMargins(20,10,50,0);
        $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin+8,$this->_pdf->GetY()); $this->_pdf->SetMargins(10,10,50,0);
        $this->_pdf->Ln(6);


        $this->_pdf->SetFont($this->tipo_letra, $this->ancho_letra, $this->tamanhio_letra);
    }


    public function  sanitizar_numero($numero){

        $numero = str_replace('.','',$numero);

        $numero = str_replace(',','.',$numero);

        return $numero;
    }




    public function  salto_pagina(){
        if($this->_pdf->next_page == true){
            $this->_pdf->next_page = false;
            $this->print_header();
        }

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

    public function  exec()
    {
        $this->_pdf->Output();
    }


    public function mini_head_print($ancho_celdas,$array_key,$borde=true)
    {

        $this->salto_pagina();

        $this->_pdf->setGlobalAlight('C');
        $this->_pdf->setBordes($borde);
        $this->_pdf->SetMargins(10,10,50,0);

        $this->_pdf->set_my_color(172,172,234);

        $this->_pdf->SetWidths($ancho_celdas);
        $this->_pdf->Row($array_key);

        $this->_pdf->set_my_color(255,255,255);

    }



    public function print_sub_title($x,$nombre){

        $this->salto_pagina();


        $this->_pdf->SetMargins(10,10,50,0);

        //$this->_pdf->SetFont('Times', '', 12);
        $this->_pdf->Text($x, $this->_pdf->GetY(),$nombre);


    }

    public function  print_celda($ancho_celdas,$array_key,$border=true){

//Table with 20 rows and 4 columns

        $this->salto_pagina();
        //$this->_pdf->SetFont('Times', '', 11);
        $this->_pdf->SetWidths($ancho_celdas);
        $this->_pdf->setBordes($border);
        $this->_pdf->Row($array_key);


    }




    public function setLetra($tipo,$ancho,$tamanhio){

        $this->tipo_letra = $tipo;
        $this->ancho_letra = $ancho;
        $this->tamanhio_letra = $tamanhio;

        $this->_pdf->SetFont($this->tipo_letra, $this->ancho_letra, $this->tamanhio_letra);
    }



    //ejecuta una funcion anonima con el reporte esto me proporciona algo de polimorfismo

    public  function  interfaz($fun){ $fun; }
}
