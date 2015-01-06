<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 20/11/14
 * Time: 10:46 AM
 */

ini_set('display_errors', 'On');
ini_set('display_errors', 1);



class ReporteDivicionTotal{


    private $_array_money;
    private $_array_total;//este es el q imprime los totales
    private $array_numeros_colum_sum;//este dice que indices son los q se suman



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

    private $_tmp_subtema;
    private $index_sub_tema;

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
    }





    public function exec_sql($sql)
    {


    }


    public function  sanitizar_numero($numero){

        $numero = str_replace('.','',$numero);

        $numero = str_replace(',','.',$numero);

        return $numero;
    }


    public function print_body()
    {

//        if(!$this->responce_db){
//            return;
//        }
//
//        $var_prueba = 0;
//
//        $antes_body = false;
//
//        $ancho_maximo = 186;
//        $tmp_nombre_divcion = '';
//        $this->_pdf->SetMargins(40,10,50,0);
//
//        $ancho_celdas = array();
//
//
//        $cantidad_columnas = (count($this->result_sql[0])-2);
//
//        for($i = 0; $i < $cantidad_columnas;$i++){
//            $ancho_celda = ($ancho_maximo/ $cantidad_columnas) ;
//
//            array_push($ancho_celdas,$ancho_celda);
//
//        }
//
//        /*primera divicion*/
//        if($this->_divicion_index >= 0){
//
//            $tmp_nombre_divcion = $this->result_sql[0][$this->_divicion_index];
//
//            $this->_pdf->SetFont('Times', '', 12);
//            $this->_pdf->Cell(0, 8, $this->prefix_subdivicion . $tmp_nombre_divcion, 0,1,'');
//
//            // (float x, float y, string txt)
//            $this->_pdf->SetFont('Times', '', 11);
//            $this->_pdf->Ln(6);
//
//            $this->_pdf->Text(16,$this->_pdf->GetY()+5,$this->result_sql[0][$this->index_sub_tema]);
//            $this->_tmp_subtema = $this->result_sql[0][$this->index_sub_tema];
//
//            $this->_pdf->SetMargins(10,10,50,0);
//
//
//            unset($this->array_minihead[$this->_divicion_index]);
//            unset($this->array_minihead[$this->index_sub_tema]);
//            $this->array_minihead = array_values($this->array_minihead);
//
//            $this->mini_head_print($ancho_celdas,$this->array_minihead);
//            if($this->_pdf->next_page == true){
//                $this->print_header();
//                $this->_pdf->SetWidths($ancho_celdas);
//                $this->_pdf->next_page = false;
//            }
//
//        }
//
//
//
//        /*for main*/
//        for($i = 0 ; $i < count($this->result_sql);$i++){
//
//
//            if($this->_pdf->next_page == true){
//                $this->print_header();
//                $this->_pdf->SetWidths($ancho_celdas);
//                $this->_pdf->next_page = false;
//            }
//
//
//
//            if($tmp_nombre_divcion != $this->result_sql[$i][$this->_divicion_index]){
//
//                /*segunda sub divicion*/
//
//
//                for($k=1;$k < count($this->_array_total);$k++){
//                    $this->_array_total[$k] = formatear_ve($this->_array_total[$k]);
//
//                }
//
//                if($this->_pdf->next_page == true){
//                    $this->print_header();
//                    $this->_pdf->SetWidths($ancho_celdas);
//                    $this->_pdf->next_page = false;
//                }
//                $this->_pdf->Row($this->_array_total);
//                if($this->_pdf->next_page == true){
//                    $this->print_header();
//                    $this->_pdf->SetWidths($ancho_celdas);
//                    $this->_pdf->next_page = false;
//                }
//                for($k=1;$k < count($this->_array_total);$k++){
//                    $this->_array_total[$k] = 0;
//
//                }
//
//                $tmp_nombre_divcion = $this->result_sql[$i][$this->_divicion_index];
//                $this->_pdf->Ln(12);
//                $this->_pdf->SetFont('Times', '', 12);
//                $this->_pdf->SetMargins(20,10,50,0);
//
//                if($this->_pdf->next_page == true){
//                    $this->print_header();
//                    $this->_pdf->SetWidths($ancho_celdas);
//                    $this->_pdf->next_page = false;
//                }
//                $this->_pdf->Ln(12);
//                $antes_body = true;
//                $this->_tmp_subtema = '';
//                if($this->_pdf->next_page == true){
//                    $this->print_header();
//                    $this->_pdf->SetWidths($ancho_celdas);
//                    $this->_pdf->next_page = false;
//                }
//                // $this->mini_head_print($ancho_celdas,$this->array_minihead);
//            }
//
//            if($this->_tmp_subtema != $this->result_sql[$i][$this->index_sub_tema]){
//                $this->_tmp_subtema = $this->result_sql[$i][$this->index_sub_tema];
//
//                if($antes_body){
//
//                    $antes_body = false;
//                }else{
//                    if($this->_pdf->next_page == true){
//                        $this->print_header();
//                        $this->_pdf->SetWidths($ancho_celdas);
//                        $this->_pdf->next_page = false;
//                    }
//
//
//                    for($k=1;$k < count($this->_array_total);$k++){
//                        $this->_array_total[$k] = formatear_ve($this->_array_total[$k]);
//
//                    }
//
//                    if($this->_pdf->next_page == true){
//                        $this->print_header();
//                        $this->_pdf->SetWidths($ancho_celdas);
//                        $this->_pdf->next_page = false;
//                    }
//                    $this->_pdf->Row($this->_array_total);
//
//                    for($k=1;$k < count($this->_array_total);$k++){
//                        $this->_array_total[$k] = 0;
//
//                    }
//
//                    if($this->_pdf->next_page == true){
//                        $this->print_header();
//                        $this->_pdf->SetWidths($ancho_celdas);
//                        $this->_pdf->next_page = false;
//                    }
//                }
//                $this->_pdf->SetFont('Times', '', 11);
//                $this->_pdf->Ln(4);
//
//
//                if($this->_pdf->next_page == true){
//                    $this->print_header();
//                    $this->_pdf->SetWidths($ancho_celdas);
//                    $this->_pdf->next_page = false;
//                }
//
//                $this->_pdf->Text(16,$this->_pdf->GetY()+5,$this->_tmp_subtema);
//
//                if($this->_pdf->next_page == true){
//                    $this->print_header();
//                    $this->_pdf->SetWidths($ancho_celdas);
//                    $this->_pdf->next_page = false;
//                }
//                $this->mini_head_print($ancho_celdas,$this->array_minihead);
//
//                if($this->_pdf->next_page == true){
//                    $this->print_header();
//                    $this->_pdf->SetWidths($ancho_celdas);
//                    $this->_pdf->next_page = false;
//                }
//            }
//            if($this->_pdf->next_page == true){
//                $this->print_header();
//                $this->_pdf->SetWidths($ancho_celdas);
//                $this->_pdf->next_page = false;
//            }
//            unset($this->result_sql[$i][$this->index_sub_tema]);
//            unset($this->result_sql[$i][$this->_divicion_index]);
//
//            $this->result_sql[$i] = array_values($this->result_sql[$i]);
//
//            $var_prueba = $var_prueba + $this->sanitizar_numero($this->result_sql[$i][1]);
//            if($this->_pdf->next_page == true){
//                $this->print_header();
//                $this->_pdf->SetWidths($ancho_celdas);
//                $this->_pdf->next_page = false;
//            }
//
//            for($j=0;$j < count($this->array_numeros_colum_sum);$j++){
//
//                $this->_array_total[$this->array_numeros_colum_sum[$j]] +=
//                    $this->sanitizar_numero($this->result_sql[$i][$this->array_numeros_colum_sum[$j]]);
//            }
//
//            for($j = 0 ; $j < count($this->result_sql[$i]);$j++){
//                $this->result_sql[$i][$j] = utf8_multiplataforma(utf8_multiplataforma($this->result_sql[$i][$j]));
//
//
//                //$this->sanitizar_numero($this->result_sql[$i][$j])
//
//                //     for($k = 0; $k < count($this->_array_money); $k++){
//                //         if($j == $this->_array_money[$k]){
////                        $this->result_sql[$i][$j] = formatear_ve($this->result_sql[$i][$j]);
//
//                //                  }
//                //            }
//
//            }
//            /*lo de adentro es esto*/
//            $this->_pdf->set_my_color(255,255,255);
//            $this->_pdf->setGlobalAlight('L');
//            $this->_pdf->setBordes(true);
//            $this->_pdf->SetMargins(10,10,50,0);
//            $this->_pdf->SetFont('Times', '', 6);
//            if($this->_pdf->next_page == true){
//                $this->print_header();
//                $this->_pdf->SetWidths($ancho_celdas);
//                $this->_pdf->next_page = false;
//            }
//            $this->_pdf->Row($this->result_sql[$i]);
//            if($this->_pdf->next_page == true){
//                $this->print_header();
//                $this->_pdf->SetWidths($ancho_celdas);
//                $this->_pdf->next_page = false;
//            }
//
//
//        }
//
//        $this->_pdf->Row($this->_array_total);

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


    private function mini_head_print($ancho_celdas,$array_key,$borde=true)
    {

        $this->salto_pagina();

        $this->_pdf->setGlobalAlight('C');
        $this->_pdf->setBordes($borde);
        $this->_pdf->SetMargins(10,10,50,0);

        $this->_pdf->set_my_color(172,172,234);
        $this->_pdf->SetFont('Times', '', 12);
        $this->_pdf->SetWidths($ancho_celdas);
        $this->_pdf->Row($array_key);

        $this->_pdf->set_my_color(255,255,255);


    }



    private function print_sub_title($x,$nombre){

        $this->salto_pagina();


        $this->_pdf->SetMargins(10,10,50,0);

        $this->_pdf->SetFont('Times', '', 12);
        $this->_pdf->Text($x, $this->_pdf->GetY(),$nombre);


    }

    public function  print_celda($ancho_celdas,$array_key,$border=true){

//Table with 20 rows and 4 columns

        $this->salto_pagina();
        $this->_pdf->SetFont('Times', '', 11);
        $this->_pdf->SetWidths($ancho_celdas);
        $this->_pdf->setBordes($border);
        $this->_pdf->Row($array_key);


    }


    private function generar_estandar($codigo_articulo,$orden_hi,$mes,$anhio){


        $codigo_articulo_sql = '  ';

        if( $codigo_articulo !=  '*'){
            $codigo_articulo_sql = "AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        if($mes < 10){
            $mes = '0' . $mes;
        }
        $fecha_valoracion_sql = "   AND min_valoracion_backup.fecha LIKE '$anhio-$mes%'";




        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad

FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
WHERE
	min_productos_servicios.eliminado = 'no' " . $codigo_articulo_sql ;


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(5);
            $this->print_sub_title(20,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(5);


            $sql2 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $nombre_etapa = $test2["nombre"];

                $codigo_etapa = $test2["codigo"];
                $this->_pdf->Ln(8);
                $this->print_sub_title(26,utf8_multiplataforma($nombre_etapa));
                $this->_pdf->Ln(1);


                $sql3 = "SELECT
min_productos_servicios.nombre as nombre,
FORMAT(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.'),'2','de_DE') as cantidad,
FORMAT(min_valoracion_backup.promedio_actual,'2','de_DE') as promedio,
FORMAT(REPLACE(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual,',','.'),'2','de_DE') as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto = '$codigo1'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'
" . $fecha_valoracion_sql;


                $result3=mysql_query($sql3);
                $this->_pdf->Ln(6);
                $this->_pdf->SetAligns('C',2);
                $this->_pdf->SetAligns('C',1);
                $this->_pdf->SetAligns('C',3);
                $this->_pdf->SetAligns('C',0);
                $this->mini_head_print(array(40,40,40,40),array("Insumo","Cantidad Estadar","Precio Estandar","Costo Estandar"));

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_articulo3 = $test3['nombre'];
                    $cantidad3 = $test3['cantidad'];
                    $promedio3 = $test3['promedio'];
                    $costo3 = $test3['costo'];

                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',0);

                    $this->print_celda(array(40, 40, 40, 40),array(utf8_multiplataforma(utf8_multiplataforma($nombre_articulo3)), $cantidad3, $promedio3, $costo3),true);
                }



                $sql4 = "SELECT
FORMAT(sum(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.')),2,'de_DE') as cantidad,
FORMAT(sum(min_valoracion_backup.promedio_actual),2,'de_DE') as promedio,
FORMAT(sum(REPLACE(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual,',','.')),2,'de_DE') as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto = '$codigo1'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'

" . $fecha_valoracion_sql;
                $result4=mysql_query($sql4);

                $test4 = mysql_fetch_array($result4);

                $total = $test4['costo'];
                $cantidad_total = $test4['cantidad'];
                $promedio_total = $test4['promedio'];

                $this->print_celda(array(40, 40, 40, 40),array("Total", $cantidad_total,$promedio_total, $total));
            }





            $this->_pdf->Ln(6);
            $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());

            $this->_pdf->Ln(8);

        }





//        for($i=0;$i<=200;$i++){
//            $this->print_sub_title(20);
//            $this->print_sub_title(30);
//            $this->_pdf->Ln(2);
//            $this->mini_head_print(array(30,39,43,30),array("uno","dos","tres","cuatro"));
//            $this->print_celda(array(30, 50, 30, 40),array("hola", "hola2", "hola3", "hola3"));
//            $this->print_celda(array(30, 50, 30, 40),array("hola", "hola2", "hola3", "hola3"));
//            $this->print_celda(array(30, 50, 30, 40),array("hola", "hola2", "hola3", "hola3"));
//
//            $this->_pdf->Ln(40);
//
//        }
    }



    private  function generar_real($codigo_articulo,$orden_hi){


$this->_pdf->setMargenIzquierdo(10);


        $codigo_articulo_ = '';

        if($codigo_articulo != '*'  ){
            $codigo_articulo_ = " AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $orden_hi_ = '';

        if($orden_hi != '*'  ){
            $orden_hi_ = "  AND prc_orden_trabajo.codigo ='$orden_hi' ";
        }


        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	AND prc_orden_trabajo.eliminada = 'n'" .  $codigo_articulo_ . $orden_hi_;


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(10);
            $this->print_sub_title(20,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(8);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
" . $orden_hi_;
           $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(8);

                $this->print_sub_title(26,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);



                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];
                    $this->_pdf->Ln(8);
                    $this->print_sub_title(32,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);



                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden'
	AND min_uso_consumo.codigo_etapa = '$codigo_etapa'
	AND min_uso_consumo.devolucion = 'n'
	GROUP BY min_productos_servicios.nombre";


                    $result4=mysql_query($sql4);


                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->mini_head_print(array(40,40,40,40),array("Insumo","Cantidad Real","Precio Real","Costo Real"));

                    $despacho_uso_total = 0;
                    $costo_uso_total = 0;
                    $promedio_uso_total = 0;


                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_uso = $test4['nombre'];
                        $despacho_uso = $test4['despacho'];
                        $costo_uso = $test4['costo'];
                        $promedio_uso = $test4['promedio'];

                        $despacho_uso_total += $despacho_uso;
                        $costo_uso_total += $costo_uso;
                        $promedio_uso_total += $promedio_uso;

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40, 40, 40, 40),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_uso)), formatear_ve($despacho_uso), formatear_ve($costo_uso), formatear_ve($promedio_uso)));


                    }//end sql4


                    $this->print_celda(array(40, 40, 40, 40),
                        array(" Total ", formatear_ve($despacho_uso_total), formatear_ve($costo_uso_total), formatear_ve($promedio_uso_total)));
                    $this->_pdf->Ln(6);

                }
                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
            }//end $test2


        }

    }


    private function  generar_valoracion(){




        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad

FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	AND prc_orden_trabajo.eliminada = 'n'";


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(5);
            $this->print_sub_title(20,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(5);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
";
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(5);
                $this->print_sub_title(26,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);


                $sql4 = "SELECT produccion_real FROM prc_orden_trabajo WHERE codigo='$codigo_orden'";

                $result4=mysql_query($sql4);
                $test4 = mysql_fetch_array($result4);

                $produccion_real = $test4['produccion_real'];



                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];
                    $this->_pdf->Ln(8);
                    $this->print_sub_title(32,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);



                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
 min_productos_servicios.codigo as codigo_producto,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden'
	AND min_uso_consumo.codigo_etapa = '$codigo_etapa'
	AND min_uso_consumo.devolucion = 'n'
	GROUP BY min_productos_servicios.nombre";

                    $result4=mysql_query($sql4);

                    $this->_pdf->Ln(6);
                    $this->_pdf->setGlobalAlight('C');
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',5);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',4);
                    $this->_pdf->SetAligns('C',6);
                    $this->mini_head_print(array(40,25,25,25,25,25,25),array("Insumo","Cantidad Real Unidad","Costo Real Unidad","Costo Real","Variacion de Cantidad", utf8_multiplataforma("Variación Costo"),"Indicador de Precio"));


                    $cantidad_real_unidad_total = 0;
                    $costo_real_unidad_total = 0;
                    $variaciom_cantiad_total = 0;
                    $variacion_costo_total = 0;

                    while($test4 = mysql_fetch_array($result4)){


                        $nombre_productos = $test4['nombre'];
                        $despacho = $test4['despacho'];
                        $costo = $test4['costo'];
                        $promedio = $test4['promedio'];
                        $codigo_producto = $test4['codigo_producto'];


                        $sql5 = "SELECT
min_productos_servicios.nombre as nombre,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') as cantidad,
min_valoracion_backup.promedio_actual as promedio,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto_detalle = '$codigo_producto'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'
";

                        $result5=mysql_query($sql5);
                        $test5 = mysql_fetch_array($result5);

                        $cantidad_estandar = $test5['cantidad'];
                        $promedio_estandar = $test5['promedio'];
                        $costo_estandar = $test5['costo'];

                        $cantidad_real_unidad=0;
                        $costo_real_unidad=0;
                        if($produccion_real != 0){
                            $cantidad_real_unidad = $despacho / $produccion_real;
                            $costo_real_unidad = $costo / $produccion_real;
                        }



                        $variaciom_cantiad = $cantidad_estandar - $cantidad_real_unidad  ;



                        $variacion_letra = 'F';

                        if($variaciom_cantiad < 0 ){
                            $variacion_letra = 'D';
                        }

                        //$costo_estandar
                        $variacion_costo = $costo_estandar - $costo_real_unidad;

                        $indicador_precio = 'F';

                        if($variacion_costo < 0){
                            $indicador_precio = 'D';
                        }

                        $cantidad_real_unidad_total += $cantidad_real_unidad;
                        $costo_real_unidad_total += $costo_real_unidad;
                        $variaciom_cantiad_total += $variaciom_cantiad;
                        $variacion_costo_total += $variacion_costo;



                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('R',5);
                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('L',4);
                        $this->_pdf->SetAligns('L',6);


                        $this->print_celda(array(40, 25, 25, 25,25,25,25,25),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_productos)),
                                formatear_ve($cantidad_real_unidad), formatear_ve($costo_real_unidad),
                                formatear_ve($variaciom_cantiad) ,$variacion_letra,formatear_ve($variacion_costo),$indicador_precio));


                    }


                    $variacion_cantidad_final = 'F';

                    if($variaciom_cantiad_total < 0){
                        $variacion_cantidad_final = 'D';
                    }

                    $indicador_precio_total = 'F';

                    if($variacion_costo_total < 0){
                        $indicador_precio_total = 'D';
                    }

                    $this->print_celda(array(40, 25, 25, 25,25,25,25,25),
                        array("total",
                            formatear_ve($cantidad_real_unidad_total), formatear_ve($costo_real_unidad_total),
                            formatear_ve($variaciom_cantiad_total) ,$variacion_cantidad_final,formatear_ve($variacion_costo_total),$indicador_precio_total));

                }

            }//end $test2


        }

    }



    private function generar_estandar_mano($codigo_articulo,$orden_hi,$mes,$anhio)
    {

        $codigo_articulo_sql = '  ';

        if( $codigo_articulo !=  '*'){
            $codigo_articulo_sql = "AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $this->_pdf->setMargenIzquierdo(30);
        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad

FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
WHERE
	min_productos_servicios.eliminado = 'no' " . $codigo_articulo_sql ;


        $result=mysql_query($sql);
        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(5);
            $this->print_sub_title(20,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(5);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
";
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)) {

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(8);
                $this->print_sub_title(26, utf8_multiplataforma('Orden: ' . $codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);



                $sql4 = "SELECT produccion_real,produccion_planificada FROM prc_orden_trabajo WHERE codigo='$codigo_orden'";

                $result4=mysql_query($sql4);
                $test4 = mysql_fetch_array($result4);

                $produccion_real = $test4['produccion_real'];
                $produccion_planificada = $test4['produccion_planificada'];

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                    $cantidad_estandar_semi = $test3["cantidad"];


                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];


                    $codigo_departamento_etapa = $test3['codigo_departamento'];

                    $this->_pdf->Ln(8);
                    $this->print_sub_title(32,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);



                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->mini_head_print(array(40,30,30,30,30,30,30),array("Nombre","Horas Estandar ",utf8_multiplataforma(" Precio Estándar por Hora"),utf8_multiplataforma("Costo Estándar por Unidad ")));




                    $horas_estadar_permitida_total = 0;
                    $precio_estandar_hora_total = 0;
                    $costo_estandar_unidad_total = 0;


                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
";

                    $result5=mysql_query($sql5);


                    while($test5 = mysql_fetch_array($result5)){

                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }
                        //$cantidad_estandar_semi
                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;

                        $horas_estadar_permitida_total += $horas_estadar_permitida;

                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";

                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];


                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;

                        $precio_estandar_hora_total += $precio_estandar_hora;

                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;

                        $costo_estandar_unidad_total += $costo_estandar_unidad;

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40, 30, 30, 30,30),
                        array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                            formatear_ve($horas_estadar_permitida), formatear_ve($precio_estandar_hora),
                            formatear_ve($costo_estandar_unidad) ));

                }

                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',0);
                    $this->print_celda(array(40, 30, 30, 30,30),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total")),
                            formatear_ve($horas_estadar_permitida_total), formatear_ve($precio_estandar_hora_total),
                            formatear_ve($costo_estandar_unidad_total) ));
                    $this->_pdf->Ln(8);
            }
            }

        }

    }


    private function generar_real_mano($codigo_articulo,$orden_hi,$mes,$anhio)
    {


        $codigo_articulo_sql = '  ';

        if( $codigo_articulo !=  '*'){
            $codigo_articulo_sql = "AND min_productos_servicios.codigo ='$codigo_articulo'";
        }

        $this->_pdf->setMargenIzquierdo(30);

        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad

FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
WHERE
	min_productos_servicios.eliminado = 'no' " . $codigo_articulo_sql ;


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(5);
            $this->print_sub_title(20,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(5);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
";
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)) {

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(8);
                $this->print_sub_title(26, utf8_multiplataforma('Orden: ' . $codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);


                $sql4 = "SELECT produccion_real,produccion_planificada FROM prc_orden_trabajo WHERE codigo='$codigo_orden'";

                $result4=mysql_query($sql4);
                $test4 = mysql_fetch_array($result4);

                $produccion_real = $test4['produccion_real'];
                $produccion_planificada = $test4['produccion_planificada'];

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                $cantidad_estandar_semi = $test3["cantidad"];


                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];


                    $codigo_departamento_etapa = $test3['codigo_departamento'];

                    $this->_pdf->Ln(8);
                    $this->print_sub_title(32,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);



                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->mini_head_print(array(40,35,35,35,35,35,35),array("Nombre","Horas Estandar ",utf8_multiplataforma(" Precio Estándar por Hora"),utf8_multiplataforma("Costo Estándar por Unidad ")));




                    $horas_estadar_permitida_total = 0;
                    $precio_estandar_hora_total = 0;
                    $costo_estandar_unidad_total = 0;


                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
";


                    $result5=mysql_query($sql5);


                    $horas_empleado_total = 0;
                    $cosoto_unitario_total = 0;
                    $costo_total_produccion_total = 0;



                    while($test5 = mysql_fetch_array($result5)){

                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];


                        $horas_empleado = $test5['horas'];


                        $horas_empleado_total += $horas_empleado;

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }

                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;



                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";

                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];


                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;


                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;


                        $costo_total_produccion = $horas_estadar_permitida * $precio_estandar_hora + $horas_empleado * $precio_estandar_hora;


                        $costo_total_produccion_total += $costo_total_produccion;

                        $cosoto_unitario = $costo_total_produccion/$horas_empleado ;


                        $cosoto_unitario_total += $cosoto_unitario;



                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);

                        $this->print_celda(array(40, 35, 35, 35,35),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                                formatear_ve($horas_empleado), formatear_ve($cosoto_unitario),
                                formatear_ve($costo_total_produccion) ));


                    }

                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',0);
                    $this->print_celda(array(40, 35, 35, 35,35),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total")),
                            formatear_ve($horas_empleado_total), formatear_ve($cosoto_unitario_total),
                            formatear_ve($costo_total_produccion_total) ));
                    $this->_pdf->Ln(8);
                }
            }

        }


    }



    private function generar_valoracion_mano($codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $codigo_articulo_sql = '  ';

        if( $codigo_articulo !=  '*'){
            $codigo_articulo_sql = "AND min_productos_servicios.codigo ='$codigo_articulo'";
        }

        $this->_pdf->setMargenIzquierdo(30);

        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
WHERE
	min_productos_servicios.eliminado = 'no' " . $codigo_articulo_sql ;


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(5);
            $this->print_sub_title(20,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(5);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
";
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)) {

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(8);
                $this->print_sub_title(26, utf8_multiplataforma('Orden: ' . $codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);



                $sql4 = "SELECT produccion_real,produccion_planificada FROM prc_orden_trabajo WHERE codigo='$codigo_orden'";

                $result4=mysql_query($sql4);
                $test4 = mysql_fetch_array($result4);

                $produccion_real = $test4['produccion_real'];
                $produccion_planificada = $test4['produccion_planificada'];

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                $cantidad_estandar_semi = $test3["cantidad"];


                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];

                    $codigo_departamento_etapa = $test3['codigo_departamento'];

                    $this->_pdf->Ln(8);
                    $this->print_sub_title(32,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);



                    $this->_pdf->Ln(6);


                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',4);
                    $this->_pdf->SetAligns('C',5);
                    $this->_pdf->SetAligns('C',6);


                    $this->mini_head_print(array(40,35,30,28,15,20,15),array("Nombre","Horas reales por unidad",
                        utf8_multiplataforma("Costo Real por Unidad"),utf8_multiplataforma("Horas"),
                        "IE","Costo","IP"));


                    $hors_reales_por_unidad_total = 0;
                    $costo_real_por_unidad_total = 0;
                    $horas_variacion_total = 0;
                    $COSTO_total = 0;

                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado
FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
";


                    $result5=mysql_query($sql5);


                    $horas_empleado_total = 0;
                    $cosoto_unitario_total = 0;
                    $costo_total_produccion_total = 0;



                    while($test5 = mysql_fetch_array($result5)){

                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];


                        $horas_empleado = $test5['horas'];


                        $horas_empleado_total += $horas_empleado;

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }

                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;



                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";

                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];


                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;


                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;


                        $costo_total_produccion = $horas_estadar_permitida * $precio_estandar_hora + $horas_empleado * $precio_estandar_hora;


                        $costo_total_produccion_total += $costo_total_produccion;

                        $cosoto_unitario = $costo_total_produccion/$horas_empleado ;


                        $cosoto_unitario_total += $cosoto_unitario;


                        $hors_reales_por_unidad = $horas_empleado/$produccion_real;

                        $costo_real_por_unidad = $costo_total_produccion/$produccion_real;


                        $horas_variacion = $horas_estadar_permitida - $hors_reales_por_unidad;


                        $IE = "F";

                        if($horas_variacion < 0){
                            $IE = "D";
                        }


                        $COSTO = $costo_estandar_unidad - $costo_real_por_unidad;

                        $IP = "F";

                        if($COSTO < 0){
                            $IP = "D";
                        }


                        $hors_reales_por_unidad_total += $hors_reales_por_unidad;
                        $costo_real_por_unidad_total += $costo_real_por_unidad;


                        $horas_variacion_total += $horas_variacion;

                        $COSTO_total += $COSTO;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',4);
                        $this->_pdf->SetAligns('R',5);
                        $this->_pdf->SetAligns('L',6);



                        $this->print_celda(array(40, 35, 30, 28,15,20,15),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                                formatear_ve($hors_reales_por_unidad), formatear_ve($costo_real_por_unidad),
                                formatear_ve($horas_variacion),$IE,formatear_ve($COSTO),$IP ));


                    }



                    $IE_total_ = "F";

                    if($horas_variacion_total <0){
                        $IE_total_ = "D";
                    }


                    $IP_total = "F";

                    if($COSTO_total < 0){
                        $IP_total = "D";
                    }


                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',4);
                    $this->_pdf->SetAligns('R',5);
                    $this->_pdf->SetAligns('L',6);


                    $this->print_celda(array(40, 35, 30, 28,15,20,15),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total")),
                            formatear_ve($hors_reales_por_unidad_total), formatear_ve($costo_real_por_unidad_total),
                            formatear_ve($horas_variacion_total),$IE_total_,formatear_ve($COSTO_total) ,$IP_total));

                    $this->_pdf->Ln(8);
                }
            }

        }

    }


    private function generar_estandar_primo($codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $codigo_articulo_sql = '  ';



        if( $codigo_articulo !=  '*'){
            $codigo_articulo_sql = "AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad

FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
WHERE
	min_productos_servicios.eliminado = 'no' " . $codigo_articulo_sql ;


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)) {

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(5);
            $this->print_sub_title(20, utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(5);



            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
";
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)) {

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(8);
                $this->print_sub_title(26, utf8_multiplataforma('Orden: ' . $codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);

                $this->_pdf->setMargenIzquierdo(50);

                $sql4 = "SELECT produccion_real,produccion_planificada FROM prc_orden_trabajo WHERE codigo='$codigo_orden'";

                $result4=mysql_query($sql4);
                $test4 = mysql_fetch_array($result4);

                $produccion_real = $test4['produccion_real'];
                $produccion_planificada = $test4['produccion_planificada'];

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                $cantidad_estandar_semi = $test3["cantidad"];


                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)) {

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];


                    $codigo_departamento_etapa = $test3['codigo_departamento'];

                    $this->_pdf->Ln(8);
                    $this->print_sub_title(32, utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);


                    $this->_pdf->Ln(6);

                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);

                    $this->mini_head_print(array(40, 30, 30, 30, 30, 30, 30),array("Insumo","Cantidad Estadar","Precio Estandar","Costo Estandar"));

                    $sql4 = "SELECT
min_productos_servicios.nombre as nombre,
FORMAT(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.'),'2','de_DE') as cantidad,
FORMAT(min_valoracion_backup.promedio_actual,'2','de_DE') as promedio,
FORMAT(REPLACE(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual,',','.'),'2','de_DE') as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto = '$codigo1'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'
";



                    $result4=mysql_query($sql4);

                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_articulo3 = $test4['nombre'];
                        $cantidad3 = $test4['cantidad'];
                        $promedio3 = $test4['promedio'];
                        $costo3 = $test4['costo'];


                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);

                        $this->print_celda(array(40, 30, 30, 30),array(utf8_multiplataforma(utf8_multiplataforma($nombre_articulo3)), $cantidad3, $promedio3, $costo3));
                    }






                    $sql4 = "SELECT
FORMAT(sum(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.')),2,'de_DE') as cantidad,
FORMAT(sum(min_valoracion_backup.promedio_actual),2,'de_DE') as promedio,
FORMAT(sum(REPLACE(REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual,',','.')),2,'de_DE') as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto = '$codigo1'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'

";
                    $result4=mysql_query($sql4);

                    $test4 = mysql_fetch_array($result4);

                    $total = $test4['costo'];
                    $cantidad_total = $test4['cantidad'];
                    $promedio_total = $test4['promedio'];



                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 30, 30, 30),array("Total", $cantidad_total,$promedio_total, $total));





//TODO NUEVO
                    $this->_pdf->Ln(6);

                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->mini_head_print(array(40, 30, 30, 30, 30, 30, 30), array("Nombre", "Horas Estandar ", utf8_multiplataforma(" Precio Estándar por Hora"), utf8_multiplataforma("Costo Estándar por Unidad ")));




                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
";
                    $horas_estadar_permitida_total = 0;
                    $precio_estandar_hora_total = 0;
                    $costo_estandar_unidad_total= 0;

                    $result5=mysql_query($sql5);


                    while($test5 = mysql_fetch_array($result5)){

                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }
                        //$cantidad_estandar_semi
                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;

                        $horas_estadar_permitida_total += $horas_estadar_permitida;

                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";

                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];


                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;

                        $precio_estandar_hora_total += $precio_estandar_hora;

                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;

                        $costo_estandar_unidad_total += $costo_estandar_unidad;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);
                        $this->print_celda(array(40, 30, 30, 30,30),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                                formatear_ve($horas_estadar_permitida), formatear_ve($precio_estandar_hora),
                                formatear_ve($costo_estandar_unidad) ));


                }
                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 30, 30, 30,30),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total")),
                            formatear_ve($horas_estadar_permitida_total), formatear_ve($precio_estandar_hora_total),
                            formatear_ve($costo_estandar_unidad_total) ));
                    $this->_pdf->Ln(8);



                    $this->mini_head_print(array(40, 30, 30, 30, 30, 30, 30), array("", "Horas Estandar ", utf8_multiplataforma(" Precio Estándar por Hora"), utf8_multiplataforma("Costo Estándar por Unidad ")));





                }
                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
                }
        }

    }



    public function generar_real_primo($codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $codigo_articulo_ = '';

        if($codigo_articulo != '*'  ){
            $codigo_articulo_ = " AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $orden_hi_ = '';

        if($orden_hi != '*'  ){
            $orden_hi_ = "  AND prc_orden_trabajo.codigo ='$orden_hi' ";
        }




        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	AND prc_orden_trabajo.eliminada = 'n'" .  $codigo_articulo_ . $orden_hi_ . "
	AND prc_orden_trabajo.fecha_culminacion LIKE '$anhio-$mes-%' ";


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(10);
            $this->print_sub_title(20,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(8);




            $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

            $result3=mysql_query($sql3);
            $test3 = mysql_fetch_array($result3);
            $cantidad_estandar_semi = $test3["cantidad"];


            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
" . $orden_hi_  ." 	AND prc_orden_trabajo.fecha_culminacion LIKE '$anhio-$mes%' ";

            $result2=mysql_query($sql2);
            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(8);
                $this->print_sub_title(26,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);



                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];
                    $this->_pdf->Ln(8);
                    $this->print_sub_title(32,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);



                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden'
	AND min_uso_consumo.codigo_etapa = '$codigo_etapa'
	AND min_uso_consumo.devolucion = 'n'
	GROUP BY min_productos_servicios.nombre";


                    $result4=mysql_query($sql4);


                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->mini_head_print(array(40,40,40,40),array("Insumo","Cantidad Real","Precio Real","Costo Real"));

                    $despacho_uso_total = 0;
                    $costo_uso_total = 0;
                    $promedio_uso_total = 0;


                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_uso = $test4['nombre'];
                        $despacho_uso = $test4['despacho'];
                        $costo_uso = $test4['costo'];
                        $promedio_uso = $test4['promedio'];

                        $despacho_uso_total += $despacho_uso;
                        $costo_uso_total += $costo_uso;
                        $promedio_uso_total += $promedio_uso;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);
                        $this->print_celda(array(40, 40, 40, 40),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_uso)), formatear_ve($despacho_uso), formatear_ve($costo_uso), formatear_ve($promedio_uso)));


                    }//end sql4

                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 40, 40, 40),
                        array(" Total Insumo ", formatear_ve($despacho_uso_total), formatear_ve($costo_uso_total), formatear_ve($promedio_uso_total)));
                    $this->_pdf->Ln(6);



                    //segundo llamada

                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->mini_head_print(array(40,40,40,40,40,40,40),array("Nombre","Horas Estandar ",utf8_multiplataforma(" Precio Estándar por Hora"),utf8_multiplataforma("Costo Estándar por Unidad ")));

                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
";


                    $result5=mysql_query($sql5);


                    $horas_empleado_total = 0;
                    $cosoto_unitario_total = 0;
                    $costo_total_produccion_total = 0;



                    while($test5 = mysql_fetch_array($result5)){


                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];


                        $horas_empleado = $test5['horas'];


                        $horas_empleado_total += $horas_empleado;

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }



                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;


                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";



                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];

                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = 0;
                        if( $horas_semanales != 0){
                            $precio_estandar_hora = $sueldo_total / $horas_semanales;
                        }



                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;


                        $costo_total_produccion = $horas_estadar_permitida * $precio_estandar_hora + $horas_empleado * $precio_estandar_hora;


                        $costo_total_produccion_total += $costo_total_produccion;

                        $cosoto_unitario = $costo_total_produccion/$horas_empleado ;


                        $cosoto_unitario_total += $cosoto_unitario;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);

                        $this->print_celda(array(40, 40, 40, 40,40),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                                formatear_ve($horas_empleado), formatear_ve($cosoto_unitario),
                                formatear_ve($costo_total_produccion) ));


                    }

                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 40, 40, 40,40),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total Mano de Obra")),
                            formatear_ve($horas_empleado_total), formatear_ve($cosoto_unitario_total),
                            formatear_ve($costo_total_produccion_total) ));


                }
                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
            }//end $test2


        }
    }



    private function generar_materiales_usados($codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $paso = 10;


        $total_gasto_primo = 0;
        $total_mano_obra = 0;

        $codigo_articulo_ = '';

        if($codigo_articulo != '*'  ){
            $codigo_articulo_ = " AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $orden_hi_ = '';

        if($orden_hi != '*'  ){
            $orden_hi_ = "  AND prc_orden_trabajo.codigo ='$orden_hi' ";
        }



        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	AND prc_orden_trabajo.eliminada = 'n'" .  $codigo_articulo_ . $orden_hi_;


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma("Fecha: " . $anhio  . "-" . $mes));
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(8);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
" . $orden_hi_;
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(6);

                $this->print_sub_title($paso*2,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                $cantidad_estandar_semi = $test3["cantidad"];




                    $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];


                    $codigo_departamento_etapa = $test3['codigo_departamento'];


                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*3,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);

                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*4,utf8_multiplataforma("Materiales Directos"));
                    $this->_pdf->Ln(1);

                    $this->_pdf->setMargenIzquierdo($paso*6);

                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
			INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden'
	AND min_uso_consumo.codigo_etapa = '$codigo_etapa'
	AND min_uso_consumo.devolucion = 'n'
	AND (min_tipo_inventario.codigo = '1' OR min_tipo_inventario.codigo = '11')
	GROUP BY min_productos_servicios.nombre";


                    $result4=mysql_query($sql4);


                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->mini_head_print(array(40,60),array("Insumos",utf8_multiplataforma("Bolívares")),false);

                    $despacho_uso_total = 0;
                    $costo_uso_total = 0;
                    $promedio_uso_total = 0;


                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_uso = $test4['nombre'];
                        $despacho_uso = $test4['despacho'];
                        $costo_uso = $test4['costo'];
                        $promedio_uso = $test4['promedio'];

                        $despacho_uso_total += $despacho_uso;
                        $costo_uso_total += $costo_uso;
                        $promedio_uso_total += $promedio_uso;

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);

                        $this->print_celda(array(40, 60),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_uso)),  formatear_ve($costo_uso)),false);


                    }//end sql4


                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);
                    $this->_pdf->Line($paso*7,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40, 60),
                        array(" Total ", formatear_ve($costo_uso_total)),false);
                    $total_gasto_primo +=$costo_uso_total;
                    $this->_pdf->Ln(6);
                    $this->_pdf->set_my_color(255,255,255);


                    $this->_pdf->setBordes(false);
                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*4,utf8_multiplataforma("Materiales Indirectos"));
                    $this->_pdf->Ln(1);



                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
			INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden'
	AND min_uso_consumo.codigo_etapa = '$codigo_etapa'
	AND min_uso_consumo.devolucion = 'n'
	AND min_tipo_inventario.codigo = '2'
	GROUP BY min_productos_servicios.nombre";


                    $result4=mysql_query($sql4);


                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);
                    $this->_pdf->setMargenIzquierdo($paso*6);
                    $this->mini_head_print(array(40,60),array("Insunos", utf8_multiplataforma("Bolívares")),false);

                    $despacho_uso_total_in = 0;
                    $costo_uso_total_in = 0;
                    $promedio_uso_total_in = 0;


                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_uso = $test4['nombre'];
                        $despacho_uso = $test4['despacho'];
                        $costo_uso = $test4['costo'];
                        $promedio_uso = $test4['promedio'];

                        $despacho_uso_total_in += $despacho_uso;
                        $costo_uso_total_in += $costo_uso;
                        $promedio_uso_total_in += $promedio_uso;

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40, 60),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_uso)), formatear_ve($costo_uso)),false);


                    }//end sql4






                    $this->_pdf->setMargenIzquierdo($paso*6);


                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);
                    $this->_pdf->Line($paso*7,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);


                    $this->_pdf->setBordes(false);


                    $this->_pdf->setMargenIzquierdo($paso*5-(3));
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',0);
                    $this->print_celda(array(40, 120),
                        array(" Total ", formatear_ve($costo_uso_total_in)),false);
                    $total_gasto_primo += $costo_uso_total_in;
                    $this->_pdf->Ln(6);

                    $this->print_sub_title($paso*4,utf8_multiplataforma("Mano de Obra Directa"));
                    $this->_pdf->Ln(6);

                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->_pdf->setMargenIzquierdo($paso*6);
                    $this->_pdf->Ln(3);
                    $this->mini_head_print(array(40,60),array("Nombre",utf8_multiplataforma("Bolívares")),false);




                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
";


                    $result5=mysql_query($sql5);


                    $horas_empleado_total = 0;
                    $cosoto_unitario_total = 0;
                    $costo_total_produccion_total = 0;

                    while($test5 = mysql_fetch_array($result5)){

                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];


                        $horas_empleado = $test5['horas'];


                        $horas_empleado_total += $horas_empleado;

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }

                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;



                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";

                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];


                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;


                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;


                        $costo_total_produccion = $horas_estadar_permitida * $precio_estandar_hora + $horas_empleado * $precio_estandar_hora;


                        $costo_total_produccion_total += $costo_total_produccion;

                        $cosoto_unitario = $costo_total_produccion/$horas_empleado ;


                        $cosoto_unitario_total += $cosoto_unitario;



                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);

                        $this->print_celda(array(40, 60),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),

                                formatear_ve($costo_total_produccion) ),false);

                    }

                    $this->_pdf->Ln(3);
                    $this->_pdf->Line($paso*7,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40, 60),
                        array(" Total ", formatear_ve($costo_total_produccion_total)),false);

                    $total_mano_obra += $costo_total_produccion_total;

                }



                /*hola*/


                $this->_pdf->setMargenIzquierdo($paso*5-(3));
                $this->_pdf->Ln(10);

                $this->_pdf->SetAligns('L',0);
                $this->_pdf->SetAligns('R',1);


                $this->_pdf->setMargenIzquierdo($paso);
                $this->_pdf->setMargenIzquierdo($paso*6);
                $this->print_celda(array(40, 60),
                    array(" Total Costo Primo ", formatear_ve($total_gasto_primo+$total_mano_obra)),false);
                $this->_pdf->Ln(6);

                $total_mano_obra = 0;



                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
            }//end $test2


        }
    }


    private function generar_tarjeta_estandar($codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $paso = 10;



        $total_gasto_primo = 0;
        $total_mano_obra = 0;
        $total_directos = 0;
        $total_indirectos = 0;
        $total_costo_primo = 0;

        $codigo_articulo_ = '';

        if($codigo_articulo != '*'  ){
            $codigo_articulo_ = " AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $orden_hi_ = '';

        if($orden_hi != '*'  ){
            $orden_hi_ = "  AND prc_orden_trabajo.codigo ='$orden_hi' ";
        }


        if($mes < 10){
            $mes = '0' . $mes;
        }
        $fecha_valoracion_sql = "   AND min_valoracion_backup.fecha LIKE '$anhio-$mes%'";

        $fecha_sql_orden = " AND  prc_orden_trabajo.fecha_culminacion LIKE '$anhio-$mes%'";

        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	AND prc_orden_trabajo.eliminada = 'n'" .  $codigo_articulo_ . $orden_hi_ . $fecha_sql_orden
        ."  ORDER BY min_productos_servicios.nombre ";


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma("Fecha: " . $anhio  . "-" . $mes));
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(8);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
" . $orden_hi_;
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(6);

                $this->print_sub_title($paso*2,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                $cantidad_estandar_semi = $test3["cantidad"];




                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];

                    $codigo_departamento_etapa = $test3['codigo_departamento'];


                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*3,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);

                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*4,utf8_multiplataforma("Materiales Directos"));
                    $this->_pdf->Ln(1);

                    $this->_pdf->setMargenIzquierdo($paso*6);



                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);



                    $sql4 = "SELECT
min_productos_servicios.nombre as nombre,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') as cantidad,
min_valoracion_backup.promedio_actual as promedio,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto = '$codigo1'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND (min_productos_servicios.inventario = '1' OR min_productos_servicios.inventario = '11')
AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'

 " . $fecha_valoracion_sql  . "ORDER BY min_productos_servicios.nombre"  ;

                    $result4=mysql_query($sql4);

//** directos */

                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);

                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->mini_head_print(array(40,35,30,30),array("Insumo","Cantidad Estadar","Precio Estandar","Costo Estandar"),false);
                    $this->_pdf->Ln(4);

                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_articulo4 = $test4['nombre'];
                        $cantidad4 = $test4['cantidad'];
                        $promedio4 = $test4['promedio'];
                        $costo4 = $test4['costo'];

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40,35,30,30),array(utf8_multiplataforma(utf8_multiplataforma($nombre_articulo4)), formatear_ve($cantidad4), formatear_ve($promedio4), formatear_ve($costo4)),false);
                        $total_directos += $costo4;

                    }



                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);
                    $this->_pdf->Line($paso*5,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40,35,30,30),
                        array(" Total ","","",formatear_ve($total_directos)),false);
                    $total_costo_primo += $total_directos;
                    $total_directos = 0;

                    $this->_pdf->Ln(6);
                    $this->_pdf->set_my_color(255,255,255);


                    $this->_pdf->setBordes(false);
                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*4,utf8_multiplataforma("Materiales Indirectos"));
                    $this->_pdf->Ln(1);



                    $sql4 = "SELECT
min_productos_servicios.nombre as nombre,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') as cantidad,
min_valoracion_backup.promedio_actual as promedio,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto = '$codigo1'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND min_productos_servicios.inventario = '2'
AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'

" . $fecha_valoracion_sql   . "  ORDER BY min_productos_servicios.nombre";

                    $result4=mysql_query($sql4);

//** directos */

                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);

                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->mini_head_print(array(40,35,30,30),array("Insumo","Cantidad Estadar","Precio Estandar","Costo Estandar"),false);
                    $this->_pdf->Ln(4);

                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_articulo4 = $test4['nombre'];
                        $cantidad4 = $test4['cantidad'];
                        $promedio4 = $test4['promedio'];
                        $costo4 = $test4['costo'];

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40,35,30,30),array(utf8_multiplataforma(utf8_multiplataforma($nombre_articulo4)), formatear_ve($cantidad4), formatear_ve($promedio4), formatear_ve($costo4)));
                        $total_indirectos += $costo4;

                    }


                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);
                    $this->_pdf->Line($paso*5,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40,35,30,30),
                        array(" Total ","","",formatear_ve($total_indirectos)),false);
                    $total_costo_primo +=$total_indirectos;
                    $total_indirectos = 0;
                    // $total_gasto_primo +=$costo_uso_total;
                    $this->_pdf->Ln(6);
                    $this->_pdf->set_my_color(255,255,255);


                    $this->_pdf->setMargenIzquierdo($paso*6);


                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);

                    //$total_gasto_primo += $costo_uso_total_in;
                    $this->_pdf->Ln(6);

                    $this->print_sub_title($paso*4,utf8_multiplataforma("Mano de Obra Directa"));
                    $this->_pdf->Ln(6);

                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->_pdf->Ln(3);
                    $this->mini_head_print(array(40,35,30,30),array("Nombre","Horas Estandar ",utf8_multiplataforma(" Precio Estándar por Hora"),utf8_multiplataforma("Costo Estándar por Unidad ")),false);

                    $this->_pdf->Ln(2);
                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
   ORDER BY mrh_empleado.primernombre,mrh_empleado.primerapellido";


                    $result5=mysql_query($sql5);


                    while($test5 = mysql_fetch_array($result5)){

                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }
                        //$cantidad_estandar_semi
                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;

                       // $horas_estadar_permitida_total += $horas_estadar_permitida;


                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";

                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];


                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;

      //                  $precio_estandar_hora_total += $precio_estandar_hora;

                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;

            //            $costo_estandar_unidad_total += $costo_estandar_unidad;

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40, 30, 30, 30,30),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                                formatear_ve($horas_estadar_permitida), formatear_ve($precio_estandar_hora),
                                formatear_ve($costo_estandar_unidad) ),false);

                        $total_mano_obra += $costo_estandar_unidad;
                    }

                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->_pdf->Ln(3);
                    $this->_pdf->Line($paso*5,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-12,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40, 30, 30, 30,30),
                        array("Total","","", formatear_ve($total_mano_obra)),false);
                    $total_costo_primo += $total_mano_obra;
                    $total_mano_obra = 0;
                    $this->_pdf->Ln(6);


                }

                $this->_pdf->Ln(6);

                /*hola*/


                $this->_pdf->setMargenIzquierdo($paso*5-(3));


                $this->_pdf->SetAligns('L',0);
                $this->_pdf->SetAligns('R',1);



                $this->_pdf->setMargenIzquierdo($paso*4);
                $this->print_celda(array(40, 30, 30, 30,30),
                    array(" Total Costo Primo ","","", formatear_ve($total_costo_primo)),false);
                $this->_pdf->Ln(6);
                $total_costo_primo = 0;
                $total_mano_obra = 0;



                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
            }//end $test2


        }
    }


    private function generar_reporte_materiales($codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $paso = 10;



        $total_gasto_primo = 0;
        $total_mano_obra = 0;
        $total_directos = 0;
        $total_indirectos = 0;
        $total_costo_primo = 0;

        $total_materiales_etapas = 0;

        $codigo_articulo_ = '';

        if($codigo_articulo != '*'  ){
            $codigo_articulo_ = " AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $orden_hi_ = '';

        if($orden_hi != '*'  ){
            $orden_hi_ = "  AND prc_orden_trabajo.codigo ='$orden_hi' ";
        }


        if($mes < 10){
            $mes = '0' . $mes;
        }
        $fecha_valoracion_sql = "   AND min_valoracion_backup.fecha LIKE '$anhio-$mes%'";


        $fecha_sql_orden = " AND  prc_orden_trabajo.fecha_culminacion LIKE '$anhio-$mes%'";

        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	AND prc_orden_trabajo.eliminada = 'n'" .  $codigo_articulo_ . $orden_hi_ . $fecha_sql_orden
            ."  ORDER BY min_productos_servicios.nombre ";


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma("Fecha: " . $anhio  . "-" . $mes));
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(8);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
" . $orden_hi_;
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(6);

                $this->print_sub_title($paso*2,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                $cantidad_estandar_semi = $test3["cantidad"];




                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];

                    $codigo_departamento_etapa = $test3['codigo_departamento'];


                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*3,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);

                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*4,utf8_multiplataforma("Materiales Directos"));
                    $this->_pdf->Ln(1);

                    $this->_pdf->setMargenIzquierdo($paso*6);



                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);



                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden' AND
	(min_productos_servicios.inventario = 1 OR min_productos_servicios.inventario = 6)
    AND min_uso_consumo.codigo_etapa = '$codigo_etapa'
    AND min_uso_consumo.devolucion = 'n'
	GROUP BY min_productos_servicios.nombre  ";

                    $result4=mysql_query($sql4);

//** directos */

                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);

                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->mini_head_print(array(40,35,30,30),array("Insumo","Cantidad Usada","Unidad","Costo"),false);
                    $this->_pdf->Ln(4);

                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_uso = $test4['nombre'];
                        $despacho_uso = $test4['despacho'];
                        $costo_uso = $test4['costo'];
                        $promedio_uso = $test4['promedio'];



                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40, 35, 30, 30),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_uso)), formatear_ve($despacho_uso),formatear_ve($promedio_uso), formatear_ve($costo_uso)),false);

                        $total_directos += $costo_uso;
                    }



                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);
                    $this->_pdf->Line($paso*5,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40,35,30,30),
                        array(" Total ","","",formatear_ve($total_directos)),false);
                    $total_materiales_etapas += $total_directos;
                    $total_costo_primo += $total_directos;
                    $total_directos = 0;

                    $this->_pdf->Ln(6);
                    $this->_pdf->set_my_color(255,255,255);


                    $this->_pdf->setBordes(false);
                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*4,utf8_multiplataforma("Materiales Indirectos"));
                    $this->_pdf->Ln(1);



                    $sql4 = "SELECT
min_productos_servicios.nombre as nombre,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') as cantidad,
min_valoracion_backup.promedio_actual as promedio,
REPLACE(prc_detalle_etapa.cantidad_estandar,',','.') * min_valoracion_backup.promedio_actual as costo
FROM prc_detalle_etapa
INNER JOIN min_productos_servicios
ON min_productos_servicios.codigo = prc_detalle_etapa.codigo_producto_detalle
INNER JOIN min_valoracion_backup
ON min_valoracion_backup.codigo_producto = min_productos_servicios.codigo
WHERE prc_detalle_etapa.codigo_producto = '$codigo1'
AND
prc_detalle_etapa.codigo_etapa = '$codigo_etapa'
AND min_productos_servicios.inventario = '2'

AND prc_detalle_etapa.desactivo = 'n'
AND prc_detalle_etapa.cantidad_estandar <> '0'

" . $fecha_valoracion_sql   . "  ORDER BY min_productos_servicios.nombre";

                    $result4=mysql_query($sql4);

//** directos */

                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);

                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->mini_head_print(array(40,35,30,30),array("Insumo","Cantidad Usada","Unidad","Costo"),false);
                    $this->_pdf->Ln(4);

                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_articulo4 = $test4['nombre'];
                        $cantidad4 = $test4['cantidad'];
                        $promedio4 = $test4['promedio'];
                        $costo4 = $test4['costo'];

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40,35,30,30),array(utf8_multiplataforma(utf8_multiplataforma($nombre_articulo4)), formatear_ve($cantidad4), formatear_ve($costo4), formatear_ve($promedio4)));
                        $total_indirectos += $costo4;

                    }


                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);
                    $this->_pdf->Line($paso*5,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40,35,30,30),
                        array(" Total ","","",formatear_ve($total_indirectos)),false);
                    $total_materiales_etapas += $total_indirectos;

                    $total_costo_primo +=$total_indirectos;
                    $total_indirectos = 0;
                    // $total_gasto_primo +=$costo_uso_total;
                    $this->_pdf->Ln(6);
                    $this->_pdf->set_my_color(255,255,255);


                    $this->_pdf->setMargenIzquierdo($paso*6);


                    $this->_pdf->set_my_color(237,197,194);
                    $this->_pdf->Ln(5);

                    //$total_gasto_primo += $costo_uso_total_in;
                    $this->_pdf->Ln(6);



                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->_pdf->Ln(3);
                    $this->_pdf->Line($paso*5,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-12,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40, 30, 30, 30,30),
                        array("Sub Total Etapa","","", formatear_ve($total_materiales_etapas)),false);
                    $total_materiales_etapas = 0;
                    $total_costo_primo += $total_mano_obra;

                    $this->_pdf->Ln(6);


                }

                $this->_pdf->Ln(6);


                $this->_pdf->setMargenIzquierdo($paso*5-(3));


                $this->_pdf->SetAligns('L',0);
                $this->_pdf->SetAligns('R',1);



                $this->_pdf->setMargenIzquierdo($paso*4);
                $this->print_celda(array(40, 30, 30, 30,30),
                    array(" Total Materiales Utilizados ","","", formatear_ve($total_costo_primo)),false);
                $this->_pdf->Ln(6);
                $total_costo_primo = 0;
                $total_mano_obra = 0;



                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
            }//end $test2


        }
    }


    private function generar_reporte_mano_obra($codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $paso = 10;

        $total_gasto_primo = 0;
        $total_mano_obra = 0;
        $total_directos = 0;
        $total_indirectos = 0;
        $total_costo_primo = 0;

        $codigo_articulo_ = '';

        if($codigo_articulo != '*'  ){
            $codigo_articulo_ = " AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $orden_hi_ = '';

        if($orden_hi != '*'  ){
            $orden_hi_ = "  AND prc_orden_trabajo.codigo ='$orden_hi' ";
        }


        if($mes < 10){
            $mes = '0' . $mes;
        }
        $fecha_valoracion_sql = "   AND min_valoracion_backup.fecha LIKE '$anhio-$mes%'";

        $fecha_sql_orden = " AND  prc_orden_trabajo.fecha_culminacion LIKE '$anhio-$mes%'";

        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	AND prc_orden_trabajo.eliminada = 'n'" .  $codigo_articulo_ . $orden_hi_ . $fecha_sql_orden
            ."  ORDER BY min_productos_servicios.nombre ";


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma("Fecha: " . $anhio  . "-" . $mes));
            $this->_pdf->Ln(10);
            $this->print_sub_title($paso*1,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(8);

            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
" . $orden_hi_;
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(6);

                $this->print_sub_title($paso*2,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);

                $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

                $result3=mysql_query($sql3);
                $test3 = mysql_fetch_array($result3);
                $cantidad_estandar_semi = $test3["cantidad"];




                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,prc_etapas.horas_estandar as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];

                    $codigo_etapa = $test3["codigo"];

                    $horas_estandar = $test3['horas_estandar'];

                    $codigo_departamento_etapa = $test3['codigo_departamento'];


                    $this->_pdf->Ln(8);
                    $this->print_sub_title($paso*3,utf8_multiplataforma($nombre_etapa));
                    $this->_pdf->Ln(1);

                    $this->_pdf->setMargenIzquierdo($paso*6);



                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);


                    $this->_pdf->Ln(6);
                    $this->_pdf->set_my_color(255,255,255);


                    $this->_pdf->setMargenIzquierdo($paso*6);



                    $this->print_sub_title($paso*4,utf8_multiplataforma("Mano de Obra Directa"));
                    $this->_pdf->Ln(6);

                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',3);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->setBordes(false);
                    $this->_pdf->SetFont('Times', '', 12);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->_pdf->Ln(3);
                    $this->mini_head_print(array(40,35,30,30),array("Nombre","Horas Estandar ",utf8_multiplataforma(" Precio Estándar por Hora"),utf8_multiplataforma("Costo Estándar por Unidad ")),false);

                    $this->_pdf->Ln(2);
                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	prc_orden_trabajador.horas as horas,
	prc_orden_trabajador.codigo_etapa as etapa,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden' AND prc_orden_trabajo_etapas.codigo = '$codigo_etapa'
   ORDER BY mrh_empleado.primernombre,mrh_empleado.primerapellido";


                    $result5=mysql_query($sql5);


                    while($test5 = mysql_fetch_array($result5)){

                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }
                        //$cantidad_estandar_semi
                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;

                        // $horas_estadar_permitida_total += $horas_estadar_permitida;


                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";

                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];


                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;

                        //                  $precio_estandar_hora_total += $precio_estandar_hora;

                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;

                        //            $costo_estandar_unidad_total += $costo_estandar_unidad;

                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('L',0);
                        $this->print_celda(array(40, 30, 30, 30,30),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                                formatear_ve($horas_estadar_permitida), formatear_ve($precio_estandar_hora),
                                formatear_ve($costo_estandar_unidad) ),false);

                        $total_mano_obra += $costo_estandar_unidad;
                    }

                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',3);
                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->setMargenIzquierdo($paso*4);
                    $this->_pdf->Ln(3);
                    $this->_pdf->Line($paso*5,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-12,$this->_pdf->GetY());
                    $this->_pdf->Ln(1);
                    $this->print_celda(array(40, 30, 30, 30,30),
                        array("Total","","", formatear_ve($total_mano_obra)),false);
                    $total_costo_primo += $total_mano_obra;
                    $total_mano_obra = 0;
                    $this->_pdf->Ln(6);


                }

                $this->_pdf->Ln(6);

                /*hola*/


                $this->_pdf->setMargenIzquierdo($paso*5-(3));


                $this->_pdf->SetAligns('L',0);
                $this->_pdf->SetAligns('R',1);



                $this->_pdf->setMargenIzquierdo($paso*4);
                $this->print_celda(array(40, 30, 30, 30,30),
                    array(" Total Mano de Obra ","","", formatear_ve($total_costo_primo)),false);
                $this->_pdf->Ln(6);
                $total_costo_primo = 0;
                $total_mano_obra = 0;



                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
            }//end $test2


        }
    }


    private function  generar_estructura_costo($codigo_articulo,$orden_hi,$mes,$anhio)
    {  $codigo_articulo_ = '';
        $paso = 10;

        $total_estructura_costo = 0;




        if($codigo_articulo != '*'  ){
            $codigo_articulo_ = " AND min_productos_servicios.codigo ='$codigo_articulo'";
        }


        $orden_hi_ = '';
        $total_indirectos = 0;

        if($orden_hi != '*'  ){
            $orden_hi_ = "  AND prc_orden_trabajo.codigo ='$orden_hi' ";
        }



        if($mes < 10){
            $mes = '0' . $mes;
        }
        $fecha_valoracion_sql = "   AND prc_orden_trabajo.fecha_culminacion LIKE '$anhio-$mes%'";


        $this->_pdf->SetAligns('L',0);
        $this->_pdf->SetAligns('R',1);
        $this->_pdf->SetAligns('R',2);
        $this->_pdf->SetAligns('R',3);
        $this->_pdf->SetAligns('R',4);

        $sql = "SELECT DISTINCT
    (min_productos_servicios.codigo) as codigo,
	min_productos_servicios.nombre as nombre,
	min_tipo_inventario.tipo as inventario,
	mco_unidad.descripcion as unidad
FROM
    min_productos_servicios
        right JOIN
    prc_etapas ON min_productos_servicios.codigo = prc_etapas.codigo_producto
		INNER JOIN
	min_tipo_inventario ON min_tipo_inventario.codigo = min_productos_servicios.inventario
		INNER JOIN
	mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
		INNER JOIN
		prc_orden_trabajo ON prc_orden_trabajo.codigo_producto = min_productos_servicios.codigo
WHERE
	min_productos_servicios.eliminado = 'no'
	AND prc_orden_trabajo.fecha_culminacion <> 'n'
	".$fecha_valoracion_sql."
	AND prc_orden_trabajo.eliminada = 'n'" .  $codigo_articulo_ . $orden_hi_;


        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $nombre_articulo = $test["nombre"];
            $codigo1 = $test["codigo"];
            $this->_pdf->Ln(5);

            $this->print_sub_title($paso,codigo_to_mes($mes) . '-' . $anhio);
            $this->_pdf->Ln(8);
            $this->print_sub_title($paso*2,utf8_multiplataforma($nombre_articulo));
            $this->_pdf->Ln(5);


            $sql3 ="SELECT
    *
FROM
    prc_semielaborados
WHERE
    codigo_producto = '$codigo1'";

            $result3=mysql_query($sql3);
            $test3 = mysql_fetch_array($result3);
            $cantidad_estandar_semi = $test3["cantidad"];


            $sql2 = "SELECT
	prc_orden_trabajo.fecha_culminacion as fecha_culminacion,
	prc_orden_trabajo.codigo_alias as codigo_alias,
	prc_orden_trabajo.codigo as codigo
	FROM prc_orden_trabajo
WHERE prc_orden_trabajo.codigo_producto = '$codigo1'
AND prc_orden_trabajo.fecha_culminacion <> 'n'
" . $orden_hi_;
            $result2=mysql_query($sql2);

            while($test2 = mysql_fetch_array($result2)){

                $fecha_culminacion_orden = $test2["fecha_culminacion"];
                $codigo_alias_orden = $test2["codigo_alias"];
                $codigo_orden = $test2["codigo"];
                $this->_pdf->Ln(8);
                $this->print_sub_title(26,utf8_multiplataforma('Orden: ' .$codigo_alias_orden . '  ' . $fecha_culminacion_orden));
                $this->_pdf->Ln(5);



                $sql3 = "SELECT  prc_etapas.codigo as codigo,mno_gerencia.descripcion as nombre,prc_etapas.codigo_departamento  as codigo_departamento,sum(prc_etapas.horas_estandar) as horas_estandar  FROM prc_etapas
INNER JOIN mno_gerencia
ON mno_gerencia.codigo = prc_etapas.codigo_departamento WHERE codigo_producto= '$codigo1'";

                $result3=mysql_query($sql3);

                while($test3 = mysql_fetch_array($result3)){

                    $nombre_etapa = $test3["nombre"];


                    $horas_estandar = $test3['horas_estandar'];



                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden'
  AND (min_productos_servicios.inventario = '1' OR min_productos_servicios.inventario = '6')
	AND min_uso_consumo.devolucion = 'n'
	GROUP BY min_productos_servicios.nombre";


                    $result4=mysql_query($sql4);


                    $this->_pdf->Ln(6);
                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->mini_head_print(array(40,32,32,32,32),array("Materiales Directos","","","","Total"),false);

                    $despacho_uso_total = 0;
                    $costo_uso_total = 0;
                    $promedio_uso_total = 0;


                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_uso = $test4['nombre'];
                        $despacho_uso = $test4['despacho'];
                        $costo_uso = $test4['costo'];
                        $promedio_uso = $test4['promedio'];

                        $despacho_uso_total += $despacho_uso;
                        $costo_uso_total += $costo_uso;
                        $promedio_uso_total += $promedio_uso;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);
                        $this->print_celda(array(40, 32, 32, 32,32),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_uso)), "", formatear_ve($costo_uso), "",""),false);


                    }//end sql4

                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 32, 32, 32,32),
                        array(" Total Meteriales Directos ", "", "", "",formatear_ve($costo_uso_total)),false);
                    $total_estructura_costo += $costo_uso_total;

                    //segundo llamada


                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->mini_head_print(array(40,32,32,32,32,32),array("Mano de Obra Directa","","","",""),false);

                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	sum(prc_orden_trabajador.horas) as horas,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden'
    GROUP BY mrh_empleado.codigo
";


                    $result5=mysql_query($sql5);


                    $horas_empleado_total = 0;
                    $cosoto_unitario_total = 0;
                    $costo_total_produccion_total = 0;



                    while($test5 = mysql_fetch_array($result5)){


                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];


                        $horas_empleado = $test5['horas'];


                        $horas_empleado_total += $horas_empleado;

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }

                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;


                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";



                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];

                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;


                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;


                        $costo_total_produccion = $horas_estadar_permitida * $precio_estandar_hora + $horas_empleado * $precio_estandar_hora;


                        $costo_total_produccion_total += $costo_total_produccion;

                        $cosoto_unitario = $costo_total_produccion/$horas_empleado ;


                        $cosoto_unitario_total += $cosoto_unitario;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('R',4);

                        $this->print_celda(array(40, 32, 32, 32,32,32),
                            array(utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),
                                "", formatear_ve($costo_total_produccion),
                                "","" ),false);


                    }

                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 32, 32, 32,32,32),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total Mano de Obra Directa")),
                            "",
                            "","",formatear_ve($costo_total_produccion_total) ),false);

                    $total_estructura_costo += $costo_total_produccion_total;
                    //indirectos



                    $sql4 = "SELECT
 min_productos_servicios.nombre as nombre,
	sum(min_uso_consumo.cantidad_despacho) as despacho,
	sum(min_uso_consumo.costo_real) as costo,
	sum(min_uso_consumo.costo_real)/sum(min_uso_consumo.cantidad_despacho) as promedio
	FROM min_uso_consumo
	INNER JOIN
	min_productos_servicios ON min_productos_servicios.codigo = min_uso_consumo.cod_articulo
WHERE
	min_uso_consumo.codigo_orden_produccion = ' $codigo_orden'
  AND (min_productos_servicios.inventario = '2')
	AND min_uso_consumo.devolucion = 'n'
	GROUP BY min_productos_servicios.nombre";


                    $result4=mysql_query($sql4);


                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->mini_head_print(array(40,32,32,32,32),array("Materiales Indirectos","","","",""),false);

                    $despacho_uso_total = 0;
                    $costo_uso_total = 0;
                    $promedio_uso_total = 0;


                    while($test4 = mysql_fetch_array($result4)){

                        $nombre_uso = $test4['nombre'];
                        $despacho_uso = $test4['despacho'];
                        $costo_uso = $test4['costo'];
                        $promedio_uso = $test4['promedio'];

                        $despacho_uso_total += $despacho_uso;
                        $costo_uso_total += $costo_uso;
                        $promedio_uso_total += $promedio_uso;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);
                        $this->print_celda(array(40, 32, 32, 32,32),
                            array("", utf8_multiplataforma(utf8_multiplataforma($nombre_uso)), "", formatear_ve($costo_uso),""),false);


                    }//end sql4

                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 32, 32, 32,32),
                        array(" Total Meteriales Indirectos", "", "", "",formatear_ve($costo_uso_total)),false);


                    //mano_de_obraindirecta

                    $this->_pdf->SetAligns('C',0);
                    $this->_pdf->SetAligns('C',1);
                    $this->_pdf->SetAligns('C',2);
                    $this->_pdf->SetAligns('C',3);
                    $this->mini_head_print(array(40,32,32,32,32,32),array("Mano de Obra Indirecta","","","",""),false);

                    $sql5 = " SELECT
    CONCAT_WS(' ',mrh_empleado.primernombre,mrh_empleado.primerapellido) as nombre,
	mrh_empleado.cedula as cedula,
	sum(prc_orden_trabajador.horas) as horas,
	mno_gerencia.descripcion as descripcion,
	mrh_empleado.codigo as codigo_empleado

FROM
    prc_orden_trabajo
        INNER JOIN
    prc_orden_trabajador ON prc_orden_trabajo.codigo = prc_orden_trabajador.codigo_orden_produccion
		INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = prc_orden_trabajador.codigo_trabajador
		INNER JOIN
	prc_orden_trabajo_etapas on prc_orden_trabajador.codigo_etapa = prc_orden_trabajo_etapas.codigo
		INNER JOIN
	mno_gerencia ON mno_gerencia.codigo = prc_orden_trabajo_etapas.codigo_departamento
WHERE
    prc_orden_trabajo.codigo = '$codigo_orden'
    GROUP BY mrh_empleado.codigo
";


                    $result5=mysql_query($sql5);


                    $horas_empleado_total = 0;
                    $cosoto_unitario_total = 0;
                    $costo_total_produccion_total = 0;



                    while($test5 = mysql_fetch_array($result5)){


                        $nombre_sql = $test5['nombre'];

                        $codigo_empleado = $test5['codigo_empleado'];


                        $horas_empleado = $test5['horas'];


                        $horas_empleado_total += $horas_empleado;

                        $mes_anterior = 0;
                        $anhio_anterior = 0;

                        if($mes == 1){
                            $mes_anterior = 12;
                            $anhio_anterior = $anhio - 1;
                        }else{
                            $anhio_anterior = $anhio;
                            $mes_anterior = $mes - 1;
                        }

                        $horas_estadar_permitida = $cantidad_estandar_semi/$horas_estandar;


                        $sql6 = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio_anterior'
        AND mno_new_concepto_empleado.mes = '$mes_anterior'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado'
		AND mno_new_concepto_empleado.codigo_concepto <> '58'";



                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $sueldo_total = $test5['total'];

                        $sql6 = "SELECT sum(mrh_turnos.horatsemana) as sum_semana FROM mrh_turnoxempleado
INNER JOIN mrh_turnos
ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE mrh_turnoxempleado.cedulaempleado = '$codigo_empleado'
AND mrh_turnoxempleado.anhio = '$anhio_anterior'
AND mrh_turnoxempleado.codigomes = '$mes_anterior'";


                        $result6=mysql_query($sql6);
                        $test5 = mysql_fetch_array($result6);
                        $horas_semanales = $test5['sum_semana'];


                        $horas_semanales = $test5['sum_semana'];


                        $precio_estandar_hora = $sueldo_total / $horas_semanales;


                        $costo_estandar_unidad = $precio_estandar_hora * $horas_estadar_permitida;


                        $costo_total_produccion = $horas_estadar_permitida * $precio_estandar_hora + $horas_empleado * $precio_estandar_hora;


                        $costo_total_produccion_total += $costo_total_produccion;

                        $cosoto_unitario = $costo_total_produccion/$horas_empleado ;


                        $cosoto_unitario_total += $cosoto_unitario;

                        $this->_pdf->SetAligns('L',0);
                        $this->_pdf->SetAligns('R',1);
                        $this->_pdf->SetAligns('R',2);
                        $this->_pdf->SetAligns('R',3);
                        $this->_pdf->SetAligns('R',4);

                        $this->print_celda(array(40, 32, 32, 32,32,32),
                            array("",
                                utf8_multiplataforma(utf8_multiplataforma($nombre_sql)),"",
                                formatear_ve($costo_total_produccion),"" ),false);


                    }

                    $this->_pdf->SetAligns('L',0);
                    $this->_pdf->SetAligns('R',1);
                    $this->_pdf->SetAligns('R',2);
                    $this->_pdf->SetAligns('R',3);
                    $this->print_celda(array(40, 32, 32, 32,32,32),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total Mano de Obra Indirecta")),
                            "",
                            "","",formatear_ve($costo_total_produccion_total) ),false);

                    $total_estructura_costo += $costo_total_produccion_total;
                    //FINAL


                    //otros costos

                    $this->mini_head_print(array(40,32,32,32,32,32),array("Otros Costos","","","",""),false);

                    $this->print_celda(array(40, 32, 32, 32,32,32),
                        array("A",
                            "","",
                            "0","" ),false);

                    $this->print_celda(array(40, 32, 32, 32,32,32),
                        array(utf8_multiplataforma(utf8_multiplataforma("Total Otros Costos")),
                            "",
                            "","","0" ),false);

                    $total_estructura_costo += 0;
                }


                $this->print_celda(array(40, 32, 32, 32,32,32),
                    array(utf8_multiplataforma(utf8_multiplataforma("Total Costos")),
                        "",
                        "","",formatear_ve($total_estructura_costo)),false);

                $total_estructura_costo = 0;
                $this->_pdf->Ln(6);
                $this->_pdf->Line(10,$this->_pdf->GetY(),$this->_pdf->w - $this->_pdf->lMargin-8,$this->_pdf->GetY());
                $this->_pdf->Ln(10  );
            }//end $test2


        }
    }



    public function  generar($tipo,$codigo_articulo,$orden_hi,$mes,$anhio)
    {
        $this->print_header();

        if($tipo == 'real'){
            $this->generar_real($codigo_articulo,$orden_hi);

        }else if($tipo == 'estandar'){
            $codigo_articulo = $codigo_articulo;
            $this->generar_estandar($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'variacion'){
            $this->generar_valoracion();
        }else if($tipo == 'estandar_mano'){
            $this->generar_estandar_mano($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'real_mano'){
            $this->generar_real_mano($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'variacion_mano'){
            $this->generar_valoracion_mano($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'estandar_primo'){
            $this->generar_estandar_primo($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'real_primo'){
            $this->generar_real_primo($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'materiales_usados'){
            $this->generar_materiales_usados($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'tarjeta_estandar'){
            $this->generar_tarjeta_estandar($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'reporte_materiales'){
            $this->generar_reporte_materiales($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'reporte_mano_obra'){
            $this->generar_reporte_mano_obra($codigo_articulo,$orden_hi,$mes,$anhio);
        }else if($tipo == 'reporte_estructura_costo'){
            $this->generar_estructura_costo($codigo_articulo,$orden_hi,$mes,$anhio);
        }



    }
}

