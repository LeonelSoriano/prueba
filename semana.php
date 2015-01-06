<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php

$id_mes = $_GET['codigomes'];
$anhio = $_GET['anhio'];

include("db.php");
include_once("./clases/funciones.php");

    $sem = '';

    $sem.= "<option value='".(0)."'>".('-')."</option>";
    $sem.= "<option value='".(1)."'>".(1)."</option>";
    $sem.= "<option value='".(2)."'>".(2)."</option>";
    $sem.= "<option value='".(3)."'>".(3)."</option>";
    $sem.= "<option value='".(4)."'>".(4)."</option>";

    if(count(getMondays($anhio,$id_mes)) == 5){
        $sem.= "<option value='".(5)."'>".(5)."</option>";
    }

//                $sql = "SELECT * FROM mrh_semana WHERE codigomes =$id_mes";
//                $consulta = mysql_query($sql);
//                $sem .= "<option value='0'>-</option>";
//                while($testeo = mysql_fetch_array($consulta)){
//                        $sem.= "<option value='".$testeo['codigosemana']."'>".$testeo['codigosemana']."</option>";
//                        //$descripcionturno = $testeo['descripcion'];
//                }

echo $sem;

?>
