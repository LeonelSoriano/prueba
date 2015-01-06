<?php

$id_gerencia = $_GET['codigogerencia'];
include("../../db.php");

                $sql = "SELECT * FROM mno_unidadadm WHERE codigogerencia =$id_gerencia";
                $consulta = mysql_query($sql);
                $sem .= "<option value='0'>-</option>";
                while($testeo = mysql_fetch_array($consulta)){
                        $sem .= "<option value='".$testeo['codigo']."'>".$testeo['descripcion']."</option>";
                }

echo $sem;                    

?>