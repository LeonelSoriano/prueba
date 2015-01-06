<?php
//
//include_once('./eos/eos.class.php');
//include_once('./db.php');
//
//ini_set('display_errors', 'On');
//ini_set('display_errors', 1);
//
//$equation = '$leonel*2';
//
//
////$eq = new eqEOS();
////
////$result = $eq->solveIF($equation, array(
////    'leonel' => 33,
////    'y' => 3));
//
////echo($result);
//
//
//$variable = array();
//
//$tmp_var = '';
//
//$lock_ini_var = true;
//
//
//for($i = 0; $i < strlen($equation); $i ++){
//
//
//    if(((ord($equation[$i]) > 64 && ord($equation[$i]) < 91) ||
//        (ord($equation[$i]) > 96 && ord($equation[$i]) < 123) ) ){
//
//        if($lock_ini_var == false){
//            $tmp_var = $tmp_var . $equation[$i];
//        }
//    }
//
//    if((ord($equation[$i]) > 0 && ord($equation[$i]) < 65) ||
//        (ord($equation[$i]) > 90 && ord($equation[$i]) < 97) ||(ord($equation[$i]) > 122)||($i == strlen($equation)-1)
//        && $lock_ini_var == false){
//        echo($tmp_var);
//
//        if($tmp_var != '' && !in_array($tmp_var,$variable))
//            array_push($variable,$tmp_var);
//
//        $lock_ini_var = true;
//        $tmp_var = '';
//    }
//    if($equation[$i] == '$'){
//        $lock_ini_var = false;
//
//    }
//
//}
////var_dump($variable);
//
//$array_variables = array();
//
//for($i = 0; $i < count($variable); $i++){
//
//    $sql = "SELECT * FROM mno_new_cosntantes WHERE nombre='$variable[$i]'";
//
//    $result=mysql_query($sql);
//
//    //$test = mysql_fetch_array($result);
//
//    //$array_variables[$test['nombre']] = $test['valor'];
//
//
//}
//
//$eq = new eqEOS();
//
//$result = $eq->solveIF($equation, $array_variables);
//
////echo($result);


function getMondays($year, $month)
{
    $mondays = array();
    # First weekday in specified month: 1 = monday, 7 = sunday
    $firstDay = date('N', mktime(0, 0, 0, $month, 1, $year));
    /* Add 0 days if monday ... 6 days if tuesday, 1 day if sunday
        to get the first monday in month */
    $addDays = (8 - $firstDay) % 7;
    $mondays[] = date('r', mktime(0, 0, 0, $month, 1 + $addDays, $year));

    $nextMonth = mktime(0, 0, 0, $month + 1, 1, $year);

    # Just add 7 days per iteration to get the date of the subsequent week
    for ($week = 1, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year);
         $time < $nextMonth;
         ++$week, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year))
    {
        $mondays[] = date('r', $time);
    }

    return $mondays;
}

var_dump(count(getMondays(2014,8)));