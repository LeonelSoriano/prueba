<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/09/14
 * Time: 03:50 PM
 */

if(isset($_POST['codigo'])){

    if($_POST['codigo'] == 'yes'){

        require_once('../../db.php');

        $sql = "TRUNCATE TABLE mco_tabulador_antiguedad";

        mysql_query($sql) or die('reiniciar tabulador_antiguedad'.mysql_error());


    }


}