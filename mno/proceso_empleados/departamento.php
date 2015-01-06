<?php

$gerencia = $_GET['codigogerencia'];
$unidad = $_GET['codigounidad'];
include("../../db.php");

                                
                $sql = "SELECT * FROM mno_departamento WHERE codigogerencia=$gerencia AND codigounidad=$unidad";
                $consulta = mysql_query($sql);
                $par .= "<option value='0'>-</option>";
                while($testeo = mysql_fetch_array($consulta)){
                        $par .= "<option value='".$testeo['codigo']."'>".$testeo['descripcion']."</option>";
                }
	echo $par;

?>