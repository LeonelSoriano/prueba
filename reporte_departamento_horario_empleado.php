<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 14/10/14
 * Time: 03:34 PM
 */


ini_set('display_errors', 'On');
ini_set('display_errors', 1);


require_once ('./clases/fpdf/fpdf.php');
require_once ('./clases/fpdf/mc_table.php');
require_once('./db.php');
require_once('./clases/funciones.php');


$mes = 0;

if(isset($_POST['codigomes'])){
    $mes = $_POST['codigomes'];
}

$anhio = 0;

if(isset($_POST['anhio'])){
    $anhio = $_POST['anhio'];
}


$numero_lunes = count( getMondays($anhio,$mes));


$sql = "SELECT * FROM mco_empresa";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$nombre_largo = $test['nombre_largo'];
$rif = $test['rif'];



$pdf = new PDF_MC_Table();

$pdf->SetMargins(40,10,50,0);

$pdf->AddPage();

$pdf->Image('images/empresalogo.jpg',15,5,28,28);

$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 15);

$pdf->Text(65, 25, "Reporte de Seldos por Departamento");
$pdf->Ln(8);

$pdf->SetFont('Arial', '', 14);
//$pdf->Cell(120, 8, "R.I.F  " . $rif, 0,0,'R');
$pdf->setBordes(false);


$pdf->Ln(14);
$pdf->SetFont('Arial', '', 10);
$fecha_Acutual = fecha_sicap();

$pdf->Cell(160, 5, $fecha_Acutual, 0,0,'R');

$pdf->SetMargins(22,0,0,0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);

$pdf->SetMargins(10,15,0,0);




$pdf->Ln(2);
$pdf->Line(10,$pdf->GetY(),$pdf->w - $pdf->lMargin,$pdf->GetY());
$pdf->Ln(4);


$sql = "SELECT * FROM mno_gerencia";

$result=mysql_query($sql);



while($test = mysql_fetch_array($result)){

    $departamento = $test['descripcion'];
    $codigo_departamento = $test['codigo'];

//    $pdf->SetFont('Arial', '', 14);
////    $pdf->Cell(120, 8, "R.I.F  " . $rif, 0,0,'R');
//    $pdf->setBordes(false);


    $pdf->SetWidths(array(160));
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->setGlobalAlight('C');


    $sql2 = "SELECT
    count(*) as total

FROM
    mrh_empleado
        INNER JOIN
    mno_new_concepto_empleado ON mno_new_concepto_empleado.codigo_empleado = mrh_empleado.codigo
        INNER JOIN
    mrh_turnoxempleado ON mrh_turnoxempleado.cedulaempleado = mrh_empleado.codigo
	INNER JOIN mrh_turnos
	ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE
    mrh_empleado.codigo_departamento = '$codigo_departamento'
        AND mno_new_concepto_empleado.codigo_concepto = '58'
        AND mrh_turnoxempleado.eliminado = 'no'
		AND mno_new_concepto_empleado.mes = '$mes'
		AND mno_new_concepto_empleado.anhio = '$anhio'
ORDER BY mrh_empleado.cedula
";



    $result2 = mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);

    $total_dos = $test2['total'];




    $sql2 = "SELECT COUNT(*) as total FROM mrh_empleado WHERE codigo_departamento = '$codigo_departamento'";
    $result2 = mysql_query($sql2);
    $test2 = mysql_fetch_array($result2);

    $total = $test2['total'];

    $pdf->setGlobalAlight('L');

    if($total != '0' && $total_dos != '0'){
        $pdf->Row(array( utf8_multiplataforma($departamento)));
    }






    $sql2 = "SELECT
    mrh_empleado.cedula as cedula,
	mrh_empleado.primernombre as nombre,
	mrh_empleado.primerapellido as apellido,
	mno_new_concepto_empleado.codigo as codigo_concepto,
	mrh_turnos.horaentrada as horaentrada,
	mrh_turnos.descripcion as descripcion,
	mrh_turnos.horadescanso as descanso,
	mrh_turnos.horasalida as salida,
	mrh_turnos.hrslabpermitidas as permitidas,
	mrh_turnos.horatsemana as hora_semana,
	mrh_turnos.totalhrsextra as total_extra

FROM
    mrh_empleado
        INNER JOIN
    mno_new_concepto_empleado ON mno_new_concepto_empleado.codigo_empleado = mrh_empleado.codigo
        INNER JOIN
    mrh_turnoxempleado ON mrh_turnoxempleado.cedulaempleado = mrh_empleado.codigo
	INNER JOIN mrh_turnos
	ON mrh_turnos.codigo = mrh_turnoxempleado.codigoturno
WHERE
    mrh_empleado.codigo_departamento = '$codigo_departamento'
        AND mno_new_concepto_empleado.codigo_concepto = '58'
        AND mrh_turnoxempleado.eliminado = 'no'
		AND mno_new_concepto_empleado.mes = '$mes'
		AND mno_new_concepto_empleado.anhio = '$anhio'
AND mrh_turnoxempleado.codigomes = '$mes' AND  mrh_turnoxempleado.anhio = '$anhio'

ORDER BY mrh_empleado.cedula
";


//echo($sql2);die;

    $result2 = mysql_query($sql2);
    //$pdf->Ln(6);
    $pdf->setGlobalAlight('L');
   // $pdf->setBordes(true);
    $pdf->SetWidths(array(18,28,21,14,20,20,22,25,20));

    $pdf->SetFont('Arial', '', 7);


    if($total != '0' && $total_dos != '0') {
        $pdf->Row(array('Cedula', 'Nombre', 'Sueldo', 'N Turno', 'Hora Entrada', 'Hora Salida', 'Hora Semanales', 'Horas Permitidas', 'Horas Extras'));
    }
    $semana = 1;

    while($test2 = mysql_fetch_array($result2)){
        //$pdf->Ln(1);

        $nombre =  $test2['nombre'];
        $apellido =  $test2['apellido'];
        $cedula =  $test2['cedula'];
        $codigo_concepto =  $test2['codigo_concepto'];
        $turno =  $test2['descripcion'];
        $horaentrada =  $test2['horaentrada'];
        $salida =  $test2['salida'];
        $hora_semana =  $test2['hora_semana'];
        $total_extra =  $test2['total_extra'];
        $permitidas =  $test2['permitidas'];


        $sql3 = "SELECT * FROM mno_new_concepto_empleado WHERE codigo='$codigo_concepto'";
        $result3=mysql_query($sql3);
        $test3 = mysql_fetch_array($result3);

        $sueldo = $test3['semana_'.$semana];

        $sueldo = formatear_ve($sueldo);


        $pdf->SetFont('Arial', '', 7);
        $pdf->setGlobalAlight('L');



        $pdf->Row(array( utf8_multiplataforma($cedula),
            utf8_multiplataforma($nombre . ' '. $apellido),
            $sueldo ,
            $turno,
            $horaentrada,
            $salida,
            $hora_semana,
            $permitidas,
            $total_extra));


        if($semana == $numero_lunes){
            $semana = 0;
        }
        $semana++;

    }
    if($total != '0' && $total_dos != '0') {
        $pdf->Ln(4);

        $pdf->Line(10, $pdf->GetY(), $pdf->w - $pdf->lMargin, $pdf->GetY());
        $pdf->Ln(4);
    }

}

$pdf->Ln(8);
$pdf->Line(10, $pdf->GetY(), $pdf->w - $pdf->lMargin, $pdf->GetY());


$sql = "SELECT
    sum(mno_new_concepto_empleado.total) as total,
	sum(mno_new_concepto_empleado.semana_1) + sum(mno_new_concepto_empleado.semana_2) +
	sum(mno_new_concepto_empleado.semana_3) + sum(mno_new_concepto_empleado.semana_4) +
	sum(mno_new_concepto_empleado.semana_5) as semana
FROM
    mno_new_concepto_empleado
WHERE
    mno_new_concepto_empleado.mes = '$mes'
        AND mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.codigo_concepto = 58";

$result = mysql_query($sql);
$test = mysql_fetch_array($result);

$total =  $test['total'];
$semana =  $test['semana'];
$pdf->SetWidths(array(100,40,50));
$pdf->Row(array( "",
    "Sueldo Total: ". formatear_ve($total),
    utf8_multiplataforma( "Sueldo Total Según Costos: ") . formatear_ve($semana)));


$pdf->Output();


?>

