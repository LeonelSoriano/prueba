<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/12/14
 * Time: 12:27 PM
 */

include_once('clases/Seguridad.php');



$a = new Seguridad();


$a->generar_sesion($_POST['LOGIN'],$_POST['CLAVE']);

