<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php


ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('./db.php');




$array = [];

$array_resul = [];



$i = 1;
$indice_tmp =7;

{
    $i = $i+1;
    $sql = "SELECT * FROM mno_gerencia WHERE codigo_depende = '$indice_tmp'";
echo($sql);
    $result=mysql_query($sql);

    while( $test = mysql_fetch_array($result)){

    if(isset($test['codigo_depende'])){
         array_push($array,$test['codigo']);
        array_push($array_resul,$test['codigo']);
    }
//    $sql1 = "SELECT * FROM mno_gerencia WHERE codigo_depende = 7";
//    $result1=mysql_query($sql1);
//    while( $test1 = mysql_fetch_array($result1)){
//        echo($test1['codigo']);
//    }

}


    $indice_tmp = array_shift($array);echo($indice_tmp);

}while($indice_tmp != null)

print_r($array_resul);
mysql_close($conn);