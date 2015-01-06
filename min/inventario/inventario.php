<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 04:25 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/LayoutForm.php');
include_once('../../db.php');


if (isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');
    include_once("../until/SubirFoto.php");


    $validation = array(

        array('nombre' => 'nombre',
            'requerida' => true
        ),

        array('nombre' => 'existencia_minima',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'existencia_maxima',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),


        array('nombre' => 'precio_inicial',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),



        array('nombre' => 'cantidad_inicial',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),


    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $subirFoto = new SubirFoto($_FILES['imagen'],'../img_articulos/');
        $subirFoto->cargarFoto();

        $codigoalias =  $_POST['codigoalias'];
        $nombre = $_POST['nombre'];
        $tipo_inventario = $_POST['inventario'];
        $unidad_medida = explode("(",$_POST['unidad_medida'])[0];

        $existencia_minima = 0;
        if($_POST['existencia_minima'] != ''){
            $existencia_minima = str_replace(',','.',$_POST['existencia_minima']);
        }

        $existencia_maxima = 0;
        if($_POST['existencia_maxima'] != ''){
            $existencia_maxima = str_replace(',','.',$_POST['existencia_maxima']);
        }

        $precio_inicial = 0;
        if($_POST['precio_inicial'] != ''){
            $precio_inicial = str_replace(',','.',$_POST['precio_inicial']);
        }

        $cantidad_inicial = 0;
        if($_POST['cantidad_inicial'] != ''){
            $cantidad_inicial = str_replace(',','.',$_POST['cantidad_inicial']);
        }

        $fecha_vencimiento = $_POST['fecha_venciminto'];
        $fecha_adquisicion = $_POST['fecha_adquisicion'];
        $imagen = $subirFoto->getNombreSubir();
        $ubicacion = $_POST['ubicacion'];
        $observacion = $_POST['observacion'];


        $sql ="SELECT codigo FROM mco_unidad where descripcion='" . $unidad_medida . "'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de unudades");
        }

        $unidad_medida_tmp = $test['codigo'];


        $sql ="SELECT codigo FROM min_tipo_inventario where tipo='" . $tipo_inventario . "'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found.. de tipo inventario");
        }
        $tipo_inventario_tmp = $test['codigo'];



        $sql = "INSERT INTO min_productos_servicios(codigo_alias,nombre,existencia_minima,existencia_maxima,fecha_vencimiento,fecha_adquisicion,ubicacion,observacion,mco_unidad,inventario,foto_articulo) VALUES
        ('$codigoalias','$nombre','$existencia_minima','$existencia_maxima',
        '$fecha_vencimiento','$fecha_adquisicion','$ubicacion','$observacion','$unidad_medida_tmp','$tipo_inventario_tmp',
        '$imagen');";


        mysql_query($sql) or die('No se pudo guardar la información. min_productos_servicios'.mysql_error());


        /* coloco datos en la tabla valoracion */

        $ultimo_ID = mysql_insert_id();


        if($tipo_inventario_tmp == '12'){
            $cantidad_inicial = 0;
        }

        $promedio_actual = 0;

        if($cantidad_inicial != 0){
            $promedio_actual = $precio_inicial/$cantidad_inicial;
        }

        $sql = "INSERT INTO min_valoracion(codigo_producto,unidades,costo_total,promedio_actual) VALUES ('$ultimo_ID','$cantidad_inicial','".$precio_inicial."','$promedio_actual')";


        $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones '.mysql_error());



        require_once('../../clases/funciones.php');
        $fecha = fecha_sicap();
        $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha )
VALUES('$ultimo_ID','$cantidad_inicial','".$precio_inicial."','$promedio_actual', '$fecha');
";

        $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());


        /*--.--.-.--.-.-.-.-..--..-*/
        /*guardar a la table de fotos*/
        $sql = "SELECT codigo FROM min_productos_servicios where foto_articulo='".$imagen."'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result)
        {
            die("Error: Data not found..");
        }

        $codigo_articulo = $test['codigo'];
        $imagen_nombre = $subirFoto->getName();
        $imagen_tipo = $subirFoto->getType();
        $imagen_tamano = $subirFoto->getSize();


        $sql = "insert into min_imagen(nombre_subir,codigo_min_articulos,name,type,size) values ('$imagen','$codigo_articulo',
        '$imagen_nombre','$imagen_tipo','$imagen_tamano')";

        $result = mysql_query($sql) or die('No se pudo guardar la información. min_imagen'.mysql_error());


        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true, "Problemas al cargar Información");
        die;
    }



    //echo('<div id="done_app"><marquee scrolldelay="100">Datos Guardados Correctamente</marquee></div>');

}





$layout = new LayoutForm('Módulo de Inventario | Productos y Servicios');

$layout->append_to_header('


   <script>
        $(function() {
            $( "#datepicker1" ).datepicker({ dateFormat: "yy-mm-dd" });
            $( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd" });
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth()<9){
                mes = myDate.getMonth() +1;
                mes = "0" + mes;
            }else{
                mes = myDate.getMonth() + 1;
            }

            var dia = myDate.getDate();
            if(dia < 9){
                dia = "0" + dia;
            }
            var prettyDate =(myDate.getFullYear()  + "-" +mes) + "-" + dia ;
            $("#datepicker1").val(prettyDate);
            $("#datepicker2").val(prettyDate);


         
        });
    </script>

');

$layout->get_header();


$select_inventario = "";

$result=mysql_query("SELECT tipo FROM min_tipo_inventario");
while($test = mysql_fetch_array($result)){

    $select_inventario .= "<option>". $test["tipo"]."</option>";

}

$unidad_medida = "";

$result=mysql_query("SELECT descripcion,sigla FROM mco_unidad");
while($test = mysql_fetch_array($result)){

    $unidad_medida .= "<option>".$test['descripcion']." (". $test['sigla'].")". "</option>";
}


$layout->set_form(

    '
                                <form id="contact-form" method="post" enctype="multipart/form-data">
                                <div class="formLayout">
                                <fieldset>

                            <label>Código</label>
                            <p><input type="text" name="codigoalias" size="20"></p>

<br/>

                          <label>Nombre de Artículo(*)</label>
                        <input type="text" name="nombre" size="20">
                        <br/>
                            <label>Tipo de Inventario</label>

                                    <select name="inventario">
                                '.$select_inventario.'

                                    </select>
<br/>


<tr>

                                <label >Unidad de Medida</label>


                                    <select name="unidad_medida" >

                                        '.$unidad_medida.'

                                    </select>
<br/>





<br/>
                            <label for="">Existencia Mínima</label>

                             <input type="text" name="existencia_minima"/>


<br/>
                                <label for="">Existencia Maxima</label>
                                <input type="text" name="existencia_maxima"/>


<br/>
                                <label >Fecha de Vencimiento</label>

                                    <input type="text" id="datepicker1" name="fecha_venciminto">


<br/>
                                <label >Fecha de Adquisición</label>

                                    <input type="text" id="datepicker2" name="fecha_adquisicion">


<br/>
                                <label>Foto del Artículo</label>

                                    <input type="file" name="imagen" >


<br/>
                                <label >Ubicación</label>
                                <input type="text" name="ubicacion"/>


<br/>

                            <label >Costo</label>
                            <input type="text" name="precio_inicial" value="1"/>
<br/>
                            <label >Cantidad Inicial</label>
                            <input type="text" name="cantidad_inicial" value="0"/>
<br/>
                                <label >Observación</label>

                                <textarea rows="4" cols="18" name="observacion">

                                </textarea>
 <br/>


<br/>
<br/>
    <input type="submit" value="Guardar datos" name="submit">
     <a href="articulo_ver.php?paso=0"><input type="button" value="Ver datos"></a>
     <a href="../../min_menu.php"><input type="button" value="Atras"></a>
                                </div>

                                </fieldset>
                            </form>


    '




);


$layout->get_footer();