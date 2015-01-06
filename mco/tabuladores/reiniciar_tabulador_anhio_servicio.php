<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/10/14
 * Time: 02:25 AM
 */

if(isset($_POST['codigo'])){

    if($_POST['codigo'] == 'yes'){

        require_once('../../db.php');

        $sql = "TRUNCATE TABLE mco_tabulador_anhio_servicio";

        mysql_query($sql) or die('reiniciar mco_tabulador_anhio_servicio'.mysql_error());


    }


}