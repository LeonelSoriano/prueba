<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../js/jquery-ui-1.11.0.custom/jquery-ui.css" rel="stylesheet">
    <script src="../../js/jquery-ui-1.11.0.custom/external/jquery/jquery.js"></script>
    <script src="../../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>

    <style>
        body{
            font: 62.5% "Trebuchet MS", sans-serif;
            margin: 50px;
        }
        .demoHeaders {
            margin-top: 2em;
        }
        #dialog-link {
            padding: .4em 1em .4em 20px;
            text-decoration: none;
            position: relative;
        }
        #dialog-link span.ui-icon {
            margin: 0 5px 0 0;
            position: absolute;
            left: .2em;
            top: 50%;
            margin-top: -8px;
        }
        #icons {
            margin: 0;
            padding: 0;
        }
        #icons li {
            margin: 2px;
            position: relative;
            padding: 4px 0;
            cursor: pointer;
            float: left;
            list-style: none;
        }
        #icons span.ui-icon {
            float: left;
            margin: 0 4px;
        }
        .fakewindowcontain .ui-widget-overlay {
            position: absolute;
        }
        select {
            width: 200px;
        }

        table.tablas-nuevas {
            border-collapse: collapse;



        }

        table.tablas-nuevas, th.tablas-nuevas, td.tablas-nuevas {
            border: 1px solid black;
        }

        table.tablas-nuevas {
            margin: 0 auto;
            width: 90%;

        }

        table.tablas-nuevas th {
            height: 30px;

            padding-right: 3px;
            padding-left: 3px;
        }


        table.tablas-nuevas td {
            text-align: center;

            vertical-align: bottom;

        }

        table.tablas-nuevas td {
            padding: 6px;
        }

        table.tablas-nuevas ,table.tablas-nuevas td,table.tablas-nuevas th {
            border: 0px solid;

        }



        table.tablas-nuevas td{
            border-right: .5px solid white;
            border-bottom: .1px solid black;
        }


        table.tablas-nuevas th {
            border: 0.5px solid white;
            background-color: #88A3FD;
            font-weight: normal;
            border-top: 5px solid #7A96F9;
            padding-right: 3px;
            padding-left: 3px;
        }


        table.tablas-nuevas tr:nth-child(odd){ background-color:#ECF0FF; }

        table.tablas-nuevas tr:nth-child(even)    { background-color:#C6D1FC; }

        table.tablas-nuevas tr:nth-child(even):hover{
            background-color: #B0C1FA;
        }

        table.tablas-nuevas tr:nth-child(odd):hover{
            background-color: #B0C1FA;
        }

    </style>



</head>
<body class="flickr-com">


<!-- Beginning of compulsory code below -->
<form method="post">

    <table border=none class="tablas-nuevas">
        <tr>
            <th>Nombre Bien</th>
            <th>Código Contable</th>
            <th>Nombre Departamento</th>
            <th>Tipo</th>
            <th>Vida Útil</th>
            <th></th>
        </tr>
        <?php
        include("../../db.php");
        $sql ="(SELECT bie_tipo_basico.codigo as codigo,
bie_tipo_basico.nombre_bien as nombre_bien,
bie_tipo_basico.codigo_contable as codigo_contable,
bie_tipo_basico.codigo_alias as codigo_alias,
mno_gerencia.descripcion as nombre_departamento,
bie_tipo_basico.vida_util as vida_util,
bie_tipo_bien.nombre as tipo_nombre,
bie_tipo_basico.tipo as codigo_tipo
FROM bie_tipo_basico
INNER JOIN bie_tipo_bien
ON bie_tipo_bien.codigo = bie_tipo_basico.tipo
INNER JOIN mno_gerencia
ON bie_tipo_basico.codigo_departamento = mno_gerencia.codigo
WHERE bie_tipo_basico.eliminado = 'n')
UNION
(SELECT bie_tipo_maquinaria.codigo as codigo,
bie_tipo_maquinaria.nombre_bien as nombre_bien,
bie_tipo_maquinaria.codigo_contable as codigo_contable,
bie_tipo_maquinaria.codigo_alias as codigo_alias,
mno_gerencia.descripcion as nombre_departamento,
bie_tipo_maquinaria.vida_util as vida_util,
bie_tipo_bien.nombre as tipo_nombre,
bie_tipo_maquinaria.tipo as codigo_tipo
FROM bie_tipo_maquinaria
INNER JOIN bie_tipo_bien
ON bie_tipo_bien.codigo = bie_tipo_maquinaria.tipo
INNER JOIN mno_gerencia
ON bie_tipo_maquinaria.codigo_departamento = mno_gerencia.codigo
WHERE bie_tipo_maquinaria.eliminado = 'n')
UNION
(SELECT bie_tipo_vehiculo.codigo as codigo,
bie_tipo_vehiculo.nombre_bien as nombre_bien,
bie_tipo_vehiculo.codigo_contable as codigo_contable,
bie_tipo_vehiculo.codigo_alias as codigo_alias,
mno_gerencia.descripcion as nombre_departamento,
bie_tipo_vehiculo.vida_util as vida_util,
bie_tipo_bien.nombre as tipo_nombre,
bie_tipo_vehiculo.tipo as codigo_tipo
FROM bie_tipo_vehiculo
INNER JOIN bie_tipo_bien
ON bie_tipo_bien.codigo = bie_tipo_vehiculo.tipo
INNER JOIN mno_gerencia
ON bie_tipo_vehiculo.codigo_departamento = mno_gerencia.codigo
WHERE bie_tipo_vehiculo.eliminado = 'n') ORDER BY nombre_bien";

        $result=mysql_query($sql);


        while($test = mysql_fetch_array($result))
        {
            //  calculos de horas
            $id = $test['codigo'];
            $nombre_bien = $test['nombre_bien'];
            $codigo_contable = $test['codigo_contable'];
            $nombre_departamento = $test['nombre_departamento'];
            $vida_util = $test['vida_util'];
            $tipo_nombre = $test['tipo_nombre'];
            $codigo_tipo = $test['codigo_tipo'];


            echo "<tr align='center'>";

            echo"<td><font color='black'>". $nombre_bien .  "</font></td>";
            echo"<td><font color='black'>". $codigo_contable . "</font></td>";
            echo"<td><font color='black'>". $nombre_departamento . "</font></td>";
            echo"<td><font color='black'>". $tipo_nombre .  "</font></td>";
            echo"<td><font color='black'>". $vida_util .  "</font></td>";
            echo '<td> <ul onClick="devolver(\''.$id.'\',\''.$nombre_bien.'\',\''.$codigo_tipo.'\')" id="icons" class="ui-widget ui-helper-clearfix"> <li class="ui-state-default ui-corner-all" title=".ui-icon-check"><span class="ui-icon ui-icon-check"></span></li> </ul></td>';
            echo "</tr>";/*     <span onClick="devolvercedula(\''.$codigo_alias.'\',\''.$nombre.'\',\''.$proveedor.'\',\''.$descripcion.'\',\''.$ubicacion.'\',\''.$existencia.'\')" class="ui-icon ui-icon-check"></span>*/
        }
        mysql_close($conn);
        ?>
    </table>

    <!-- / END -->

</form>

</body>
</html>

<script>
    function devolver(id,nombre,codigo_tipo){


        opener.document.formulario.codigo_hi.value = id;
        opener.document.formulario.tipo_hi.value = codigo_tipo;
        opener.document.formulario.nombre_bien.value = nombre;


        //     opener.document.getElementById("medida_campo").innerHTML =
        //       '</td><label>Medida</label></td><td><input type="text" /></td>';
        // opener.document.getElementById("medida_campo").innerHTML =
        //codigo_tipo;

//        if(codigo_tipo == 2){
//            opener.document.getElementById("medida_campo").innerHTML =
//                '</td><label>Unidades</label></td><td><input type="text" name="medida_especial" /></td>';
//        }else if(codigo_tipo == 3){
//            opener.document.getElementById("medida_campo").innerHTML =
//                '</td><label>Kilómetros</label></td><td><input type="text" name="medida_especial" /></td>';
//        }else{
//            opener.document.getElementById("medida_campo").innerHTML = '';
//        }
//
//        opener.document.getElementById("buscar_mantenimiento").disabled = false;
        window.close();

    }
</script>





<?php

mysql_close($conn);

?>