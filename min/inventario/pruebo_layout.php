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
            var prettyDate =(myDate.getFullYear()  + "-" +mes) + "-" + myDate.getDate() ;
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