<?php
//ini_set('display_errors', 'On');
//ini_set('display_errors', 2);



require('./fpdf/fpdf.php');
require('./fpdf/mc_table.php');
include("../../db.php");
include_once("../../clases/funciones.php");

$pdf = new PDF_MC_Table();

function calcular_lunes($mes, $anhio)
{

    return count(getMondays($anhio, $mes));
}

function apartado($ref_pdf, $nombre)
{
    $ref_pdf->Ln(2);
    $ref_pdf->SetFont('Times', 'B', 9);
    $ref_pdf->SetFillColor(204, 204, 255);
    $ref_pdf->Cell(35 , 10, $nombre, 1, 0, 'L', true);

    $ref_pdf->SetFillColor(244, 237, 70);
    $ref_pdf->Cell(100+25, 10, '', 1, 0, 'C', true);
}

function total_foot($ref_pdf, $nombre, $ancho_semana, $numero_semana, $array)
{

    $ref_pdf->Ln(10);

    $ref_pdf->SetFont('Times', 'B', 7);
    $ref_pdf->Cell(35, 10, $nombre, 1, 0, 'L');

    $ref_pdf->SetFont('Times', '', 9);
    $ref_pdf->Cell(25, 10, $array[0], 1, 0, 'R');
    $ref_pdf->SetFont('Times', '', 8);


    $ref_pdf->Cell($ancho_semana, 10, $array[1], 1, 0, 'R');
    $ref_pdf->Cell($ancho_semana, 10, $array[2], 1, 0, 'R');
    $ref_pdf->Cell($ancho_semana, 10, $array[3], 1, 0, 'R');
    $ref_pdf->Cell($ancho_semana, 10, $array[4], 1, 0, 'R');

    if ($numero_semana == 5)
        $ref_pdf->Cell($ancho_semana, 10, $array[5], 1, 0, 'R');


    $ref_pdf->SetFont('Times', '', 12);

}


function sub_divicion($ref_pdf, $nombre, $ancho_semana, $numero_semana, $array, &$ref_result, $nombre_divicion)
{

    $ref_pdf->SetFont('Times', '', 9);


    $array_result = [];

    $total_semanas = 0;
    $semana_1 = 0;
    $semana_2 = 0;
    $semana_3 = 0;
    $semana_4 = 0;
    $semana_5 = 0;

    for ($i = 0; $i < count($array); $i++) {
        $array_semana = [];
        $array_semana = explode('&', $array[$i]);

        $total_semanas = $array_semana[0];
        $semana_1 = $array_semana[1];
        $semana_2 = $array_semana[2];
        $semana_3 = $array_semana[3];
        $semana_4 = $array_semana[4];
        $semana_5 = $array_semana[5];

    }

    $result = $semana_1 + $semana_2 + $semana_3 + $semana_4;
    if ($numero_semana == 5)
        $result += $semana_5;


    global $total_sueldo_base;

    if ($nombre == 'Sueldo Base') {
        $total_sueldo_base[0] = $total_semanas;
        $total_sueldo_base[1] = $semana_1;
        $total_sueldo_base[2] = $semana_2;
        $total_sueldo_base[3] = $semana_3;
        $total_sueldo_base[4] = $semana_4;
        if ($numero_semana == 5) {
            $total_sueldo_base[5] = $semana_5;
        }
    }

    //$ref_result[0] += $result;

    array_push($array_result, $nombre);
    array_push($array_result, formatear_ve($total_semanas));
    array_push($array_result, formatear_ve(utf8_decode($semana_1)));
    array_push($array_result, formatear_ve(utf8_decode($semana_2)));
    array_push($array_result, formatear_ve(utf8_decode($semana_3)));
    array_push($array_result, formatear_ve(utf8_decode($semana_4)));


    if (!isset($ref_result[$nombre_divicion])) {
        $ref_result[$nombre_divicion] = [];
    }

    $ref_result[$nombre_divicion][0] += $total_semanas;
    $ref_result[$nombre_divicion][1] += $semana_1;

    $ref_result[$nombre_divicion][2] += $semana_2;
    $ref_result[$nombre_divicion][3] += $semana_3;
    $ref_result[$nombre_divicion][4] += $semana_4;


    if ($numero_semana == 5) {
        array_push($array_result, formatear_ve(utf8_decode($semana_5)));
        $ref_pdf->SetAligns('R', 6);
        $ref_result[$nombre_divicion][5] += $semana_5;
    }


    $ref_pdf->SetAligns('R', 1);
    $ref_pdf->SetAligns('R', 2);
    $ref_pdf->SetAligns('R', 3);
    $ref_pdf->SetAligns('R', 4);
    $ref_pdf->SetAligns('R', 5);

    $ref_pdf->Row($array_result);


}


function total($ref_pdf, $nombre, $ancho_semana, $numero_semana, &$array_totales)
{


    //$ref_pdf->Cell(35, 10,'Total '.  $nombre,1,0,'C');


    //$ref_pdf->Cell(25, 10, $array[0],1,0,'R');
    // $ref_pdf->SetFont('Times', '', 8);


    $array_result = [];
    $ref_pdf->SetFont('Times', 'B', 8);
    array_push($array_result, 'Total ' . $nombre);

    array_push($array_result, formatear_ve($array_totales[$nombre][0]));
    array_push($array_result, formatear_ve($array_totales[$nombre][1]));
    array_push($array_result, formatear_ve($array_totales[$nombre][2]));
    array_push($array_result, formatear_ve($array_totales[$nombre][3]));
    array_push($array_result, formatear_ve($array_totales[$nombre][4]));

    if ($numero_semana == 5)
        array_push($array_result, formatear_ve($array_totales[$nombre][5]));
    //$ref_pdf->Cell($ancho_semana, 10, $array[5],1,0,'C');

    $ref_pdf->Row($array_result);


}






function generar($codigo_cedula){
    $anhio = $_GET['anhio'];


    $cedula_empleado = $codigo_cedula;


    $result = mysql_query("SELECT mrh_empleado.codigo  as codigo,
 mrh_empleado.cedula  as cedula,
 mrh_empleado.primernombre as primernombre,
 mrh_empleado.primerapellido as primerapellido,
 mno_gerencia.descripcion  as cargo
 FROM mrh_empleado
INNER JOIN mno_gerencia ON mno_gerencia.codigo = mrh_empleado.codigo_departamento
WHERE mrh_empleado.codigo ='$cedula_empleado'
");

    $test = mysql_fetch_array($result);

    $codigo_empleado = $test['codigo'];
    $cedula = $test['cedula'];
    $primer_nombre = $test['primernombre'];
    $primer_apellido = $test['primerapellido'];
    $cargo = $test['cargo'];

    if($cedula == ''){
        return;
    }
    $nombre_completo = $primer_apellido . '  ' . $primer_nombre;
//-.-.-..-


//$result_=mysql_query("SELECT * FROM    WHERE codigoempleado='$codigo_empleado'");
//
//$test_ = mysql_fetch_array($result_);


    $codigomes = $_GET['mes'];


    $mes_get = $_GET['mes'];
//$result_=mysql_query("SELECT MIN(codigosemana) AS menor  FROM mrh_semana WHERE codigomes='$mes_get'");
//$test_ = mysql_fetch_array($result_);
//$semana_menor = $test_['menor'];

//-.-.-.-.-.-..--.-.


    $sql = "SELECT * FROM mco_empresa";
    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);
    $nombre_empresa = $test['nombre_largo'];
    $rif_empresa = $test['rif'];


    /*busco el deparmento*/

    $sql = "SELECT * from mno_proceso_empleados WHERE  codigoempleado='$codigo_cedula'";

    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);

    $codigo_departamento = $test['codigodepartamento'];


    $sql = "SELECT
    *
FROM
    mno_gerencia
INNER JOIN mrh_empleado_backup
ON mrh_empleado_backup.codigo_departamento = mno_gerencia.codigo
WHERE mrh_empleado_backup.codigo_empleado = '$codigo_cedula' AND
mrh_empleado_backup.fecha LIKE '$anhio-$codigomes%'";



    $result = mysql_query($sql);
    $test = mysql_fetch_array($result);

    $nombre_cargo = $test['descripcion'];

//_________________________________________________


    $numero_semana = calcular_lunes($mes_get, $anhio);
//    $numero_semana = 4;


    $ancho_semana = 100 / $numero_semana;

    $margen_izquierdo = 25;




    $total_sueldo_base = [];




    $_array_information = [];


    $conceptos = '';

    $candado_de_coma = false;

    if (isset($_GET['1'])) {

        $conceptos = ' AND  (';


        $conceptos .= " mno_new_concepto.tipo_concepto ='1' ";
        $candado_de_coma = true;
    }

    if (isset($_GET['2'])) {


        if (!$candado_de_coma) {
            $conceptos .= ' AND  (';
        } else {
            $conceptos .= ' OR ';
        }

        $conceptos .= " mno_new_concepto.tipo_concepto ='2' ";


        $candado_de_coma = true;
    }


    if (isset($_GET['3'])) {


        if (!$candado_de_coma) {
            $conceptos .= ' AND (';
        } else {
            $conceptos .= ' OR ';
        }

        $conceptos .= " mno_new_concepto.tipo_concepto ='3' ";


        $candado_de_coma = true;
    }

    if (isset($_GET['4'])) {


        if (!$candado_de_coma) {
            $conceptos .= ' AND (';
        } else {
            $conceptos .= ' OR ';
        }

        $conceptos .= " mno_new_concepto.tipo_concepto ='4' ";


        $candado_de_coma = true;
    }

    if (isset($_GET['5'])) {


        if (!$candado_de_coma) {
            $conceptos .= ' AND ( ';
        } else {
            $conceptos .= ' OR ';
        }

        $conceptos .= " mno_new_concepto.tipo_concepto ='5' ";


        $candado_de_coma = true;
    }


    if (isset($_GET['6'])) {


        if (!$candado_de_coma) {
            $conceptos .= ' AND ( ';
        } else {
            $conceptos .= ' OR ';
        }

        $conceptos .= " mno_new_concepto.tipo_concepto ='6' ";


        $candado_de_coma = true;
    }


    if (isset($_GET['7'])) {


        if (!$candado_de_coma) {
            $conceptos .= ' AND ( ';
        } else {
            $conceptos .= ' OR ';
        }

        $conceptos .= " mno_new_concepto.tipo_concepto ='7' ";


        $candado_de_coma = true;
    }


    if($candado_de_coma){
        $conceptos[strlen($conceptos)] = ')';
    }


    $departamento_sql = '';

    if($_GET['codigo_departamento_hi'] != '-1' && $_GET['codigo_departamento_hi'] != ''){

        $codigo_departamento = $_GET['codigo_departamento_hi'];

        $departamento_sql = "AND mrh_empleado.codigo_departamento = '$codigo_departamento'";
    }


    $sql = "SELECT
    mno_new_concepto_empleado.total as total,
mno_new_concepto.nombre as nombre,
mno_new_concepto.tipo_concepto as codigo_tipo,
mno_new_concepto_empleado.semana_1 as semana1,
mno_new_concepto_empleado.semana_2 as semana2,
mno_new_concepto_empleado.semana_3 as semana3,
mno_new_concepto_empleado.semana_4 as semana4,
mno_new_concepto_empleado.semana_5 as semana5
FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto.codigo = mno_new_concepto_empleado.codigo_concepto
INNER JOIN
	mrh_empleado ON mrh_empleado.codigo = mno_new_concepto_empleado.codigo_empleado
WHERE  mes = '$codigomes' AND codigo_empleado = '$codigo_cedula' AND mno_new_concepto.codigo <> '58'  AND  anhio = '$anhio'    $departamento_sql " . $conceptos . "ORDER BY mno_new_concepto.tipo_concepto";


    $result = mysql_query($sql);

    while ($test = mysql_fetch_array($result)) {


        $descripcion = $test['nombre'];
        $resultado = $test['total'];
        $codigo_tipo = $test['codigo_tipo'];
        $semana1 = $test['semana1'];
        $semana2 = $test['semana2'];
        $semana3 = $test['semana3'];
        $semana4 = $test['semana4'];
        $semana5 = $test['semana5'];

        $resultado = $resultado . '&' . $semana1 . '&' . $semana2 . '&' . $semana3 . '&' . $semana4 . '&' . $semana5 . '&';

        $sql2 = "select nombre from mno_new_concepto_tipo where codigo = '$codigo_tipo'";


        $result2 = mysql_query($sql2);
        $test2 = mysql_fetch_array($result2);

        $nombre_divicion = $test2['nombre'];


        if (!isset($_array_information[$nombre_divicion][$descripcion])) {
            $_array_information[$nombre_divicion][my_encode($descripcion)] = [];
        }
        array_push($_array_information[$nombre_divicion][my_encode($descripcion)], $resultado);


    }

    /** aca cargare la informacion de la bd */

    /**-.-.-.-.-.-..-.-.-.-..-.-.*/


    $totales;
    if(count($_array_information) == 0){
        return;
    }



    global $pdf;


    if ($numero_semana == 5) {
        $pdf->SetWidths(array(35, 25, 20, 20, 20, 20, 20));
    } else {
        $pdf->SetWidths(array(35, 25, 25, 25, 25, 25));
    }

    $pdf->SetMargins($margen_izquierdo, 15, 0, 0);

    $pdf->AddPage();



    $pdf->Image('../../images/empresalogo.jpg',15,5,28,28);
    $pdf->Ln(1);

//
//    $pdf->SetFont('Times', 'B', 16);
//    $pdf->Cell(80, 10, "Empresa", 1, 0, 'C');
//    $pdf->Cell(81, 10, $nombre_empresa, 1, 0, 'C');
//    $pdf->Ln(15);
    $pdf->SetFont('Times', '', 11);
    //$pdf->Cell(80, 10, '    RIF', 0);
    //$pdf->Cell(80, 10, $rif_empresa, 0);
    $pdf->Ln(18);

//$pdf->underline = true;
    $pdf->Cell(20, 10, ' Nombre:', 0, 0);
    $pdf->Cell(70, 10, $nombre_completo, 0, 0);
    $pdf->Ln(7);
    $pdf->Cell(20, 10, 'Cedula', 0, 0);
    $pdf->Cell(70, 10, $cedula, 0, 0);
    $pdf->Ln(7);
    $pdf->Cell(20, 10, 'Departamento                  ', 0, 0);
    $pdf->Cell(20, 10,'           ' .utf8_multiplataforma($cargo), 20, 0);
    $pdf->Ln(12);


    include_once('../../clases/funciones.php');

    $fecha_Acutual = fecha_sicap();

    $pdf->Cell(155, -14, $fecha_Acutual , 0,0,'R');


    $pdf->Line($margen_izquierdo, $pdf->GetY()+2, $pdf->w - $pdf->lMargin, $pdf->GetY()+2);

    $pdf->Ln(8);


    $sql = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.mes = '$codigomes'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_cedula'
		AND (
		 mno_new_concepto_empleado.codigo_concepto = '58'
)";


    $pdf->SetFont('Times', '', 10);
    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $sueldo_base_real = $test['total'];

    $pdf->Cell(50, 10, utf8_multiplataforma('Sueldo Base (Real):'), 0, 0, 'L');
    $pdf->Cell(40, 10, formatear_ve($sueldo_base_real) . '   Bs', 0, 1, 'R');


    $sql = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.mes = '$codigomes'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_cedula'
		AND (
		 mno_new_concepto_empleado.codigo_concepto = '1'
)";


    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $sueldo_base = $test['total'];

    $pdf->Cell(50, 10, utf8_multiplataforma('Sueldo Base (Según Costo):'), 0, 0, 'L');
    $pdf->Cell(40, 10, formatear_ve($sueldo_base) . '   Bs', 0, 1, 'R');




    $sql = "SELECT
    SUM(mno_new_concepto_empleado.total) as total

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.mes = '$codigomes'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_cedula'
		AND (
		 mno_new_concepto_empleado.codigo_concepto = '1'
		OR  mno_new_concepto_empleado.codigo_concepto = '9'
		OR  mno_new_concepto_empleado.codigo_concepto = '10'
		OR  mno_new_concepto_empleado.codigo_concepto = '11'
		OR  mno_new_concepto_empleado.codigo_concepto = '12'
		OR  mno_new_concepto_empleado.codigo_concepto = '13'
		OR  mno_new_concepto_empleado.codigo_concepto = '14'
		OR  mno_new_concepto_empleado.codigo_concepto = '60'
		OR  mno_new_concepto_empleado.codigo_concepto = '62')";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $salario_normal = $test['total'];


    $pdf->Cell(50, 10, utf8_multiplataforma('Salario Normal:'), 0, 0, 'L');
    $pdf->Cell(40, 10, formatear_ve($salario_normal) . '   Bs', 0, 1, 'R');




    $sql = "SELECT
    SUM(mno_new_concepto_empleado.total) as total
FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.mes = '$codigomes'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_cedula'
		AND (
		 mno_new_concepto_empleado.codigo_concepto = '1'
		OR  mno_new_concepto_empleado.codigo_concepto = '9'
		OR  mno_new_concepto_empleado.codigo_concepto = '10'
		OR  mno_new_concepto_empleado.codigo_concepto = '11'
		OR  mno_new_concepto_empleado.codigo_concepto = '12'
		OR  mno_new_concepto_empleado.codigo_concepto = '13'
		OR  mno_new_concepto_empleado.codigo_concepto = '14'
		OR  mno_new_concepto_empleado.codigo_concepto = '15'
		OR  mno_new_concepto_empleado.codigo_concepto = '60'
		OR  mno_new_concepto_empleado.codigo_concepto = '54'
		OR  mno_new_concepto_empleado.codigo_concepto = '59'
		OR  mno_new_concepto_empleado.codigo_concepto = '21'
		OR  mno_new_concepto_empleado.codigo_concepto = '22'
		OR  mno_new_concepto_empleado.codigo_concepto = '23'
		OR  mno_new_concepto_empleado.codigo_concepto = '24'
		OR  mno_new_concepto_empleado.codigo_concepto = '55'
		OR  mno_new_concepto_empleado.codigo_concepto = '56'
		OR  mno_new_concepto_empleado.codigo_concepto = '62'
)

";//19


    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $salario_integral = $test['total'];


    $pdf->Cell(50, 10, utf8_multiplataforma('Salario Integral:'), 0, 0, 'L');
    $pdf->Cell(40, 10, formatear_ve($salario_integral) . '   Bs', 0, 1, 'R');



    $pdf->Ln(8);

    $pdf->Cell(35, 10, '   ', 0, 0, 'C');

    $pdf->SetFillColor(172, 172, 234);




    $pdf->Cell(25, 10, 'Mensual', 1, 0, 'C', true);

    $pdf->SetFillColor(172, 172, 234);
    $pdf->Cell(100, 10, ' Numero de Semanas ', 1, 0, 'C', true);


//numero semanas


    $pdf->Ln(10);

    $pdf->Cell(35, 10, '', 1, 0, 'C');
    $pdf->Cell(25, 10, '', 1, 0, 'C');


    $pdf->Cell($ancho_semana, 10, '1', 1, 0, 'C');
    $pdf->Cell($ancho_semana, 10, '2', 1, 0, 'C');
    $pdf->Cell($ancho_semana, 10, '3', 1, 0, 'C');
    $pdf->Cell($ancho_semana, 10, '4', 1, 0, 'C');

    if ($numero_semana == 5)
        $pdf->Cell($ancho_semana, 10, '5', 1, 0, 'C');

    $pdf->Ln(8);
//contruccion




    foreach ($_array_information as $key => $value) {


        if ($key == '') {
            continue;
        }

        apartado($pdf, $key);

        $pdf->Ln(10);

        foreach ($value as $key2 => $value2) {

            if ($key2 != '')
                sub_divicion($pdf,utf8_decode(my_decode($key2)), $ancho_semana, $numero_semana, $value2, $totales, $key);

        }

        total($pdf, $key, $ancho_semana, $numero_semana, $totales);


    }

    $pdf->Ln(10);
    $pdf->Cell(35, 10, '', 1);
    $pdf->Cell(25, 10, '', 1, 0, 'C');

    $pdf->Cell($ancho_semana, 10, '', 1, 0, 'C');
    $pdf->Cell($ancho_semana, 10, '', 1, 0, 'C');
    $pdf->Cell($ancho_semana, 10, '', 1, 0, 'C');
    $pdf->Cell($ancho_semana, 10, '', 1, 0, 'C');

    if ($numero_semana == 5)
        $pdf->Cell($ancho_semana, 10, '', 1, 0, 'C');

    $total_costo = [];

    foreach ($totales as $key => $value) {
        if ($key != '') {
            $total_costo[0] += $value[0];
            $total_costo[1] += $value[1];
            $total_costo[2] += $value[2];
            $total_costo[3] += $value[3];
            $total_costo[4] += $value[4];
            if ($numero_semana == 5) {
                $total_costo[5] += $value[5];
            } else {
                $total_costo[5] += 0;
            }
        }
    }


    total_foot($pdf, "Total Costo Empleado(s)", $ancho_semana, $numero_semana, array(formatear_ve($total_costo[0]), formatear_ve($total_costo[1]), formatear_ve($total_costo[2]),
        formatear_ve($total_costo[3]), formatear_ve($total_costo[4]), formatear_ve($total_costo[5])));


    $total_carga_laboral = [];

//($tmp_salario_base[$i]/$save_costo[$i])* 100;

    $total_carga_laboral[0] = ($total_costo[0] / $total_sueldo_base[0]) * 100;
    $total_carga_laboral[1] = ($total_costo[1] / $total_sueldo_base[1]) * 100;
    $total_carga_laboral[2] = ($total_costo[2] / $total_sueldo_base[2]) * 100;
    $total_carga_laboral[3] = ($total_costo[3] / $total_sueldo_base[3]) * 100;
    $total_carga_laboral[4] = ($total_costo[4] / $total_sueldo_base[4]) * 100;
    if ($numero_semana == 5) {
        $total_carga_laboral[5] += ($total_costo[5] / $total_sueldo_base[5]) * 100;
    }


    $sql6 = "SELECT
    mno_new_concepto_empleado.total as total,
    mno_new_concepto_empleado.semana_1 as semana_1,
    mno_new_concepto_empleado.semana_2 as semana_2,
    mno_new_concepto_empleado.semana_3 as semana_3,
    mno_new_concepto_empleado.semana_4 as semana_4,
    mno_new_concepto_empleado.semana_5 as semana_5

FROM
    mno_new_concepto_empleado
INNER JOIN mno_new_concepto
ON mno_new_concepto_empleado.codigo_concepto = mno_new_concepto.codigo
WHERE
    mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.mes = '$codigomes'
        AND mno_new_concepto_empleado.eliminado = 'no'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_cedula'
		AND (
		 mno_new_concepto_empleado.codigo_concepto = '1'
)
    ";


    $result6 = mysql_query($sql6);

    $test6 = mysql_fetch_array($result6);

    $semana_1_sueldo_base = $test6['semana_1'];
    $semana_2_sueldo_base = $test6['semana_2'];
    $semana_3_sueldo_base = $test6['semana_3'];
    $semana_4_sueldo_base = $test6['semana_4'];
    $semana_5_sueldo_base = $test6['semana_5'];
    $total_sueldo_base = $test6['total'];

    $total_carga_laboral_total = $total_costo[0] /  $total_sueldo_base;
    $total_carga_laboral_semaman1 = $total_costo[1] /  $semana_1_sueldo_base;
    $total_carga_laboral_semaman2 = $total_costo[2] /  $semana_2_sueldo_base;
    $total_carga_laboral_semaman3 = $total_costo[3] /  $semana_3_sueldo_base;
    $total_carga_laboral_semaman4 = $total_costo[4] /  $semana_4_sueldo_base;
    $total_carga_laboral_semaman5 = $total_costo[5] /  $semana_5_sueldo_base;

        total_foot($pdf, "Total Carga Laboral %", $ancho_semana, $numero_semana, array(formatear_ve($total_carga_laboral_total) . '%', formatear_ve($total_carga_laboral_semaman1) . '%',
        formatear_ve($total_carga_laboral_semaman2) . '%', formatear_ve($total_carga_laboral_semaman3) . '%', formatear_ve($total_carga_laboral_semaman4) . '%', formatear_ve($total_carga_laboral_semaman5) . '%'));


    $total_carga_laboral_veces = [];

//($tmp_salario_base[$i]/$save_costo[$i])* 100;
//$total_carga_laboral_veces[$i] = ($save_costo[$i] -$tmp_salario_base[$i]) / $tmp_salario_base[$i] ;
    $total_carga_laboral_veces[0] = ( $total_costo[0] - $total_sueldo_base)/$total_sueldo_base;
    $total_carga_laboral_veces[1] = ($total_costo[1] - $semana_1_sueldo_base) / $semana_1_sueldo_base;
    $total_carga_laboral_veces[2] = ($total_costo[2] - $semana_2_sueldo_base) / $semana_2_sueldo_base;
    $total_carga_laboral_veces[3] = ($total_costo[3] - $semana_3_sueldo_base) / $semana_3_sueldo_base;
    $total_carga_laboral_veces[4] = ($total_costo[4] - $semana_4_sueldo_base) / $semana_4_sueldo_base;
    if ($numero_semana == 5) {
        $total_carga_laboral_veces[5] += ($total_costo[5] - $semana_5_sueldo_base) / $semana_5_sueldo_base;
    }


    total_foot($pdf, "Total Carga Laboral Veces", $ancho_semana, $numero_semana, array(formatear_ve($total_carga_laboral_veces[0]),
        formatear_ve($total_carga_laboral_veces[1]),
        formatear_ve($total_carga_laboral_veces[2]),
        formatear_ve($total_carga_laboral_veces[3]),
        formatear_ve($total_carga_laboral_veces[4]),
        formatear_ve($total_carga_laboral_veces[5])));


    $total_horas_trabajadas = 40;
    $total_costohora_efectivo = [];

    $total_costohora_efectivo[0] = $total_costo[0] / $total_horas_trabajadas;
    $total_costohora_efectivo[1] = $total_costo[1] / $total_horas_trabajadas;
    $total_costohora_efectivo[2] = $total_costo[2] / $total_horas_trabajadas;
    $total_costohora_efectivo[3] = $total_costo[3] / $total_horas_trabajadas;
    $total_costohora_efectivo[4] = $total_costo[4] / $total_horas_trabajadas;
    if ($numero_semana == 5) {
        $total_costohora_efectivo[5] += $total_costo[5] / $total_horas_trabajadas;;
    }


    total_foot($pdf, "Costo Hora Hombre Efectivo", $ancho_semana, $numero_semana, array(formatear_ve($total_costohora_efectivo[0]),
        formatear_ve($total_costohora_efectivo[1]),
        formatear_ve($total_costohora_efectivo[2]),
        formatear_ve($total_costohora_efectivo[3]),
        formatear_ve($total_costohora_efectivo[4]),
        formatear_ve($total_costohora_efectivo[5])));

//$total_costo_hora_pagado[$i] = $save_costo[$i] / 30 / $this->_horas_turno[$i];

    $total_costohora_hombre = [];
    $hora_dia = 8;

    $total_costohora_efectivo[0] = $total_costo[0] / 30 / $hora_dia;
    $total_costohora_efectivo[1] = $total_costo[1] / 30 / $hora_dia;
    $total_costohora_efectivo[2] = $total_costo[2] / 30 / $hora_dia;
    $total_costohora_efectivo[3] = $total_costo[3] / 30 / $hora_dia;
    $total_costohora_efectivo[4] = $total_costo[4] / 30 / $hora_dia;

    if ($numero_semana == 5) {
        $total_costohora_efectivo[5] = $total_costo[5] / 30 / $hora_dia;
    }

//$total_costohora_efectivo[1] += $total_costo[1] / $total_horas_trabajadas;
//$total_costohora_efectivo[2] += $total_costo[2] / $total_horas_trabajadas;
//$total_costohora_efectivo[3] += $total_costo[3] / $total_horas_trabajadas;
//$total_costohora_efectivo[4] += $total_costo[4] / $total_horas_trabajadas;
//if($numero_semana == 5){
//    $total_costohora_efectivo[5] += $total_costo[5] / $total_horas_trabajadas;;
//}


    total_foot($pdf, "Costo Hora Hombre Pagado", $ancho_semana, $numero_semana, array(formatear_ve($total_costohora_efectivo[0]),
        formatear_ve($total_costohora_efectivo[1]),
        formatear_ve($total_costohora_efectivo[2]),
        formatear_ve($total_costohora_efectivo[3]),
        formatear_ve($total_costohora_efectivo[4]),
        formatear_ve($total_costohora_efectivo[5])));

}





if($_GET['cedulaempleado'] == '-1'){

    $sql_c = "SELECT * FROM mrh_empleado";

    $result_c = mysql_query($sql_c);

    while($test_c = mysql_fetch_array($result_c)){


         $codigo_c =  $test_c['codigo'];


        generar($codigo_c);


    }

    $pdf->Output();
    /*termino forma colectva*/
}else {
/*empiezo forma individual*/





    generar($_GET['cedulaempleado']);


    $pdf->Output();




}