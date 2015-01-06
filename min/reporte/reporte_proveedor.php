<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/12/14
 * Time: 01:14 PM
 */


ini_set('display_errors', 'On');
ini_set('display_errors', 1);



class ReporteDivicionTotal{


    private $_array_money;



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
            if($tipo == 'reporte_estructura_costo'){
            $this->generar_estructura_costo($codigo_articulo,$orden_hi,$mes,$anhio);
        }


    }


    public  function  prueba($prueba){ $prueba; }
}


include_once('../../db.php');
$tipo_post = '1';

$a = new ReporteDivicionTotal();

$extras = array();
$extras['Historial de Compra'] = "";


$codigo_articulo_hi = '*';
$orden_h = '*';
if(isset($_POST['codigo_articulo_hi'])){
    $codigo_articulo_hi = $_POST['codigo_articulo_hi'];
    $orden_hi = $_POST['orden_hi'];
}

$a->configure_header("Reporte de Proveedor"  ,"asd",'./../../images/empresalogo.jpg');
$ej = function($a){

    $codigo_articulo_ = '';
    $paso = 10;

    $total_estructura_costo = 0;

   $a->print_header();


    $sql = "SELECT * FROM min_empresa";

    $a->_pdf->setMargenIzquierdo(3);
    $a->_pdf->SetAligns('C',0);
    $a->_pdf->SetAligns('C',1);
    $a->_pdf->SetAligns('C',2);
    $a->_pdf->SetAligns('C',3);
    $a->_pdf->SetAligns('C',4);
    $a->_pdf->SetAligns('C',5);
    $a->_pdf->SetFont('Times', '', 8);

    $a->mini_head_print(array(32,30,30,35,30,30),array("Codigo","Nombre","R.I.F",utf8_multiplataforma('Dirección'),"Correo","Telefono"),true);

    $result=mysql_query($sql);

    while($test = mysql_fetch_array($result)){
        $codigo_alias = $test['codigo_alias'];
        $descripcion = $test['descripcion'];
        $correo = $test['correo'];
        $direccion = $test['direccion'];
        $telefono = $test['telefono'];
        $rif = $test['rif'];

        $a->_pdf->SetAligns('L',0);
        $a->_pdf->SetAligns('L',1);
        $a->_pdf->SetAligns('L',2);
        $a->_pdf->SetAligns('L',3);
        $a->_pdf->SetAligns('L',4);
        $a->_pdf->SetAligns('L',5);


        $a->print_celda(array(32,30,30,35,30,30),
            array(utf8_multiplataforma(utf8_multiplataforma($codigo_alias)),
                utf8_multiplataforma(utf8_multiplataforma($descripcion)),utf8_multiplataforma(utf8_multiplataforma($rif)),
                utf8_multiplataforma(utf8_multiplataforma($direccion)),utf8_multiplataforma(utf8_multiplataforma($correo)),utf8_multiplataforma(utf8_multiplataforma($telefono)) ),true);
    }

};

$a->prueba($ej($a));
$a->exec();
