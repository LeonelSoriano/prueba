<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 10/09/14
 * Time: 12:47 PM
 */


if($_POST['codigo']){

    $codigo = $_POST['codigo'];

    require_once("../../db.php");
    require_once("../../clases/funciones.php");

    $str_result = "";


    if($codigo == 1){

        $sql = "SELECT bie_tipo_basico.codigo as codigo, mno_gerencia.descripcion as nombre_departamento,
         bie_tipo_basico.nombre_bien as nombre_bien, bie_tipo_basico.codigo_alias as codigo_alias,
         bie_tipo_basico.vida_util as vida_util, bie_tipo_basico.fecha_adquisicion as fecha_adquisicion,
         bie_tipo_basico.valor_rescate as rescate,bie_tipo_basico.costo_adquisicion as costo_adquisicion,
          bie_tipo_basico.valor_mercado as mercado
         FROM bie_tipo_basico
         INNER JOIN mno_gerencia ON bie_tipo_basico.codigo_departamento = mno_gerencia.codigo WHERE bie_tipo_basico.eliminado = 'n'";

        $result=mysql_query($sql);


        $str_result .='<tr style="text-align: center;">
            <th >Nombre</th>
            <th>Código</th>
            <th>Nombre Departamento</th>
            <th>Vida Útil</th>
            <th>Fecha Adquisición</th>
             <th>Costo Adquisición</th>
            <th>Valor de Rescate</th>
            <th>Valor de Mercado</th>
            <th>Modificar</th>
            <th>Eliminar</th>
                </tr>
            <tr>';



        while($test = mysql_fetch_array($result)){

            $id = $test['codigo'];
            $nombre_bien = $test['nombre_bien'];
            $codigo_alias = $test['codigo_alias'];
            $nombre_departamento = $test['nombre_departamento'];
            $vida_util = $test['vida_util'];
            $fecha_adquisicion = $test['fecha_adquisicion'];
            $costo_adquisicion = $test['costo_adquisicion'];
            $rescate = $test['rescate'];
            $mercado = $test['mercado'];


            $str_result .= "<tr align='center'>";
            $str_result .= "<td><font color='black'>". $nombre_bien . "</font></td>";
            $str_result .= "<td><font color='black'>". $codigo_alias . "</font></td>";
            $str_result .= "<td><font color='black'>". $nombre_departamento . "</font></td>";
            $str_result .= "<td><font color='black'>". $vida_util . "</font></td>";
            $str_result .= "<td><font color='black'>". $fecha_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $costo_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $rescate . "</font></td>";
            $str_result .= "<td><font color='black'>". $mercado . "</font></td>";
            $str_result .= "<td> <a href ='bienes_basico_mod.php?id=$id'>Modificar</a>";
            $str_result .= "<td> <a href ='bienes_basico_del.php?id=$id'>Borrar</a>";
            $str_result .= "</tr>";

        }


    }else if($codigo == 2){

        $str_result .='<tr style="text-align: center;">
            <th >Nombre</th>
            <th>Código</th>
            <th>Código Departamento</th>
            <th>Vida Útil</th>
            <th>Fecha Adquisición</th>
             <th>Costo Adquisición</th>
            <th>Valor de Rescate</th>
            <th>Valor de Mercado</th>
            <th>Unidades Producidas</th>
            <th>Modificar</th>
            <th>Eliminar</th>
                </tr>
            <tr>';



        $sql = "SELECT bie_tipo_maquinaria.codigo as codigo, mno_gerencia.descripcion as nombre_departamento,
         bie_tipo_maquinaria.nombre_bien as nombre_bien, bie_tipo_maquinaria.codigo_alias as codigo_alias,
         bie_tipo_maquinaria.vida_util as vida_util, bie_tipo_maquinaria.fecha_adquisicion as fecha_adquisicion,
         bie_tipo_maquinaria.valor_rescate as rescate,bie_tipo_maquinaria.costo_adquisicion as costo_adquisicion,
          bie_tipo_maquinaria.valor_mercado as mercado, bie_tipo_maquinaria.unidades_producidas as unidades_producidas
         FROM bie_tipo_maquinaria
         INNER JOIN mno_gerencia ON bie_tipo_maquinaria.codigo_departamento = mno_gerencia.codigo WHERE bie_tipo_maquinaria.eliminado = 'n'";

        $result=mysql_query($sql);


        while($test = mysql_fetch_array($result)){

            $id = $test['codigo'];
            $nombre_bien = $test['nombre_bien'];
            $codigo_alias = $test['codigo_alias'];
            $nombre_departamento = $test['nombre_departamento'];
            $vida_util = $test['vida_util'];
            $fecha_adquisicion = $test['fecha_adquisicion'];
            $costo_adquisicion = $test['costo_adquisicion'];
            $rescate = $test['rescate'];
            $mercado = $test['mercado'];
            $unidades_producidas = $test['unidades_producidas'];


            $str_result .= "<tr align='center'>";
            $str_result .= "<td><font color='black'>". $nombre_bien . "</font></td>";
            $str_result .= "<td><font color='black'>". $codigo_alias . "</font></td>";
            $str_result .= "<td><font color='black'>". $nombre_departamento . "</font></td>";
            $str_result .= "<td><font color='black'>". $vida_util . "</font></td>";
            $str_result .= "<td><font color='black'>". $fecha_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $costo_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $rescate . "</font></td>";
            $str_result .= "<td><font color='black'>". $mercado . "</font></td>";
            $str_result .= "<td><font color='black'>". $unidades_producidas . "</font></td>";
            $str_result .= "<td> <a href ='bienes_maquinaria_mod.php?id=$id'>Modificar</a>";
            $str_result .= "<td> <a href ='bienes_maquinaria_del.php?id=$id'>Borrar</a>";
            $str_result .= "</tr>";

        }



    }else if($codigo == 3){

        $str_result .='<tr style="text-align: center;">
            <th >Nombre</th>
            <th>Código</th>
            <th>Código Departamento</th>
            <th>Vida Útil</th>
            <th>Fecha Adquisición</th>
             <th>Costo Adquisición</th>
            <th>Valor de Rescate</th>
            <th>Valor de Mercado</th>
            <th>Kilómetros</th>
            <th>Modelo Vehículo</th>
            <th>Marca Vehículo</th>
            <th>Placa Vehículo</th>
            <th>Tipo de Licencia</th>
            <th>Modificar</th>
            <th>Eliminar</th>
                </tr>
            <tr>';


        $sql = "SELECT bie_tipo_vehiculo.codigo as codigo, mno_gerencia.descripcion as nombre_departamento,
         bie_tipo_vehiculo.nombre_bien as nombre_bien, bie_tipo_vehiculo.codigo_alias as codigo_alias,
         bie_tipo_vehiculo.vida_util as vida_util, bie_tipo_vehiculo.fecha_adquisicion as fecha_adquisicion,
         bie_tipo_vehiculo.valor_rescate as rescate,bie_tipo_vehiculo.costo_adquisicion as costo_adquisicion,
          bie_tipo_vehiculo.valor_mercado as mercado, bie_tipo_vehiculo.kilometros as kilometros,
          bie_tipo_vehiculo.modelo_vehculo as modelo, bie_tipo_vehiculo.marca_vehculo as marca,
          bie_tipo_vehiculo.placa_vehculo as placa, bie_tipo_licencia.nombre as licencia_nombre
         FROM bie_tipo_vehiculo
         INNER JOIN mno_gerencia ON bie_tipo_vehiculo.codigo_departamento = mno_gerencia.codigo
         INNER JOIN bie_tipo_licencia ON bie_tipo_licencia.codigo = bie_tipo_vehiculo.tipo_licencia
          WHERE bie_tipo_vehiculo.eliminado = 'n'";

        $result=mysql_query($sql);


        while($test = mysql_fetch_array($result)){

            $id = $test['codigo'];
            $nombre_bien = $test['nombre_bien'];
            $codigo_alias = $test['codigo_alias'];
            $nombre_departamento = $test['nombre_departamento'];
            $vida_util = $test['vida_util'];
            $fecha_adquisicion = $test['fecha_adquisicion'];
            $costo_adquisicion = $test['costo_adquisicion'];
            $rescate = $test['rescate'];
            $mercado = $test['mercado'];
            $kilometros = $test['kilometros'];
            $modelo = $test['modelo'];
            $marca = $test['marca'];
            $placa = $test['placa'];
            $licencia_nombre = $test['licencia_nombre'];


            $str_result .= "<tr align='center'>";
            $str_result .= "<td><font color='black'>". $nombre_bien . "</font></td>";
            $str_result .= "<td><font color='black'>". $codigo_alias . "</font></td>";
            $str_result .= "<td><font color='black'>". $nombre_departamento . "</font></td>";
            $str_result .= "<td><font color='black'>". $vida_util . "</font></td>";
            $str_result .= "<td><font color='black'>". $fecha_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $costo_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $rescate . "</font></td>";
            $str_result .= "<td><font color='black'>". $mercado . "</font></td>";
            $str_result .= "<td><font color='black'>". $kilometros . "</font></td>";
            $str_result .= "<td><font color='black'>". $modelo . "</font></td>";
            $str_result .= "<td><font color='black'>". $marca . "</font></td>";
            $str_result .= "<td><font color='black'>". $placa . "</font></td>";
            $str_result .= "<td><font color='black'>". $licencia_nombre . "</font></td>";
            $str_result .= "<td> <a href ='bienes_vehiculo_mod.php?id=$id'>Modificar</a>";
            $str_result .= "<td> <a href ='bienes_vehiculo_del.php?id=$id'>Borrar</a>";
            $str_result .= "</tr>";

        }




    }else if($codigo == 4){

        $str_result .='<tr style="text-align: center;">
            <th >Nombre</th>
            <th>Código</th>
            <th>Vida Útil</th>
            <th>Fecha Adquisición</th>
             <th>Costo Adquisición</th>
            <th>Valor de Rescate</th>
            <th>Valor de Mercado</th>
            <th> Metros<sup>2</sup> </th>
            <th>Modificar</th>
            <th>Eliminar</th>
                </tr>
            <tr>';


        $sql = "SELECT bie_tipo_activo_principal.codigo as codigo,
              bie_tipo_activo_principal.nombre_bien as nombre_bien,
               bie_tipo_activo_principal.codigo_alias as codigo_alias,
                bie_tipo_activo_principal.vida_util as vida_util,
                 bie_tipo_activo_principal.fecha_adquisicion as fecha_adquisicion,
                  bie_tipo_activo_principal.valor_rescate as rescate,
                  bie_tipo_activo_principal.costo_adquisicion as costo_adquisicion,
                   bie_tipo_activo_principal.valor_mercado as mercado,
                    bie_tipo_activo_principal.mts_edificacion as mts_edificacion
                     FROM bie_tipo_activo_principal WHERE bie_tipo_activo_principal.eliminado = 'n' ";

        $result=mysql_query($sql);


        while($test = mysql_fetch_array($result)){

            $id = $test['codigo'];
            $nombre_bien = $test['nombre_bien'];
            $codigo_alias = $test['codigo_alias'];
            $vida_util = $test['vida_util'];
            $fecha_adquisicion = $test['fecha_adquisicion'];
            $costo_adquisicion = $test['costo_adquisicion'];
            $rescate = $test['rescate'];
            $mercado = $test['mercado'];
            $kilometros = $test['kilometros'];
            $modelo = $test['modelo'];
            $marca = $test['marca'];
            $placa = $test['placa'];
            $licencia_nombre = $test['licencia_nombre'];
            $mts_edificacion = $test['mts_edificacion'];


            $str_result .= "<tr align='center'>";
            $str_result .= "<td><font color='black'>". $nombre_bien . "</font></td>";
            $str_result .= "<td><font color='black'>". $codigo_alias . "</font></td>";
            $str_result .= "<td><font color='black'>". $vida_util . "</font></td>";
            $str_result .= "<td><font color='black'>". $fecha_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $costo_adquisicion . "</font></td>";
            $str_result .= "<td><font color='black'>". $rescate . "</font></td>";
            $str_result .= "<td><font color='black'>". $mercado . "</font></td>";
            $str_result .= "<td><font color='black'>". $mts_edificacion . "</font></td>";

            $str_result .= "<td> <a href ='activo_principal_mod.php?id=$id'>Modificar</a>";
            $str_result .= "<td> <a href ='activo_principal_del.php?id=$id'>Borrar</a>";
            $str_result .= "</tr>";

        }


    }


    echo($str_result);


}
