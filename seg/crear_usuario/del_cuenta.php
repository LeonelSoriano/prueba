<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/12/14
 * Time: 03:59 PM
 */


include("../../db.php");

$id =$_REQUEST['codigo'];



mysql_query("DELETE FROM seg_usuario WHERE codigo = '$id'")
or die(mysql_error());

header("Location: ver_cuentas.php?paso=0");

?>
