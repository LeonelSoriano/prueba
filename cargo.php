<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 01:42 PM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');


$layout = new LayoutForm('Módulo de Recursos Humanos | Cargo','.');


if (isset($_POST['submit']))
{
    include 'db.php';
    require_once('./clases/Validate.php');
    require_once('./clases/funciones.php');



    $validation = array(

        array('nombre' => 'codigoalias',
            'requerida' => true,
        ),

        array('nombre' => 'descripcion',
            'requerida' => true,
        )
    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){

        $codigoalias=$_POST['codigoalias'];

        $descripcion= cadena_estetica($_POST['descripcion']);
        $tipo_cargo = $_POST['tipo_cargo'];
        $tipo_cargo_opcion = $_POST['tipo_cargo_opcion'];


        $sql = "SELECT count(*) as total FROM mrh_cargo WHERE codigoalias='$codigoalias' OR descripcion ='$descripcion'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        $total = $test['total'];


        if($total != '0'){
            send_error_redirect(true,'Cargo ya Existe');
            die;
        }



        $sql = "insert into mrh_cargo(codigoalias,descripcion,tipo_cargo,tipo_cargo_opcion)
                                                      values('$codigoalias','$descripcion','$tipo_cargo',$tipo_cargo_opcion)";
        //echo $sql;
        //exit;
        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){
        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }


}


$layout->append_to_header("
    <script type='text/javascript'>

        $(function() {

            $('#tipo_cargo').bind('change',function() {

                var tipo_cargo = $('#tipo_cargo').val();

                if (tipo_cargo == 'produccion') {

                    $('#tipo_cargo_opcion').html(' <option value=". '"'  ."  directa". '"'  .">Directa</option> <option >Indirecta</option>');
                } else if(tipo_cargo == 'operativo'){
                    $('#tipo_cargo_opcion').html(' <option value=". '"'  ."administracion". '"'  .">Administración</option> <option >Venta</option>');

                }


            });

        });


    </script>

 ");

$layout->get_header();


$layout->set_form(

'
    <form id="contact-form" method="post" enctype="multipart/form-data">
    <div class="formLayout">
    <fieldset>

<label>Código</label>
<input type="text" name="codigoalias" id="codigoalias" size="20">
<br/>

<label>Descripción</label>
<input type="text" name="descripcion" id="descripcion" size="20">
<br/>

<label >Tipo Cargo</label>

<select id="tipo_cargo" name="tipo_cargo" id="">
    <option value="produccion">Producción</option>
    <option value="operativo">Operativo</option>
</select>
<br/>
<label></label>
   <select  name="tipo_cargo_opcion" id="tipo_cargo_opcion">
                                            <option value="directo">Directo</option>
                                            <option value="indirecto">Indirecto</option>
                                        </select>
<br/>
<input type="submit" value="Guardar datos" name="submit">
<a href="cargo_ver.php"><input type="button" value="Ver datos"></a>
<a href="mrh_menu.php"><input type="button" value="Atras"></a>

</fieldset>
</div>
</form>

'
);

$layout->get_footer();