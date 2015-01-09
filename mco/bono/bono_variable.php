<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 08:51 AM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


if(isset($_POST['submit'])){



    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'codigo_empleado_hi',
            'requerida' => true,
        ),

        array('nombre' => 'valor',
            'requerida' => false,
            'regla' => 'number'),



    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $codigo = $_POST['codigo_empleado_hi'];
        $valor = $_POST['valor'];
        $periocidad = $_POST['periocidad'];

        $sql = "SELECT count(*)  total FROM mno_new_bono_variable WHERE codigo_empleado = '$codigo'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        $total =  $test['total'];

        if($total == '0'){
            $sql = "INSERT INTO mno_new_bono_variable(valor,codigo_empleado,periocidad) VALUES ('$valor','$codigo','$periocidad')";

            mysql_query($sql) or die('insert '.mysql_error());
        }else{
            $sql = "UPDATE mno_new_bono_variable SET valor = '$valor',periocidad = '$periocidad' WHERE codigo_empleado = '$codigo'";
            mysql_query($sql) or die('update '.mysql_error());
        }


        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }
}


include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Monto Variable');



$layout->append_to_header(
    <<<EOT
    <script type="text/javascript">

        $(function() {

            $("#buscar_empleado").click(function() {
                var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>
EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8" name="formulario"  id="contact-form">
    <div class="formLayout">
    <fieldset>
 
 <label>Empleado (*)</label>
 <input type="text" name="cedula"  disabled>
 <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
<input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
<br/>

<label>Periocidad</label>

   <select name="periocidad" id="periocidad">
    <option value="7" >Semanal</option>
    <option value="0" >Quinceal</option>
    <option value="1" >Mensual</option>
    <option value="2">Bimestral</option>
    <option value="3">Trimestral</option>
    <option value="4">Cuatrmestral</option>
    <option value="5">Semestral</option>
    <option value="6">Anual</option>
</select>


<br/>

<label > Valor </label>
<input type="text" name="valor"/>

<br/>

<input type="submit" value="Guardar datos" name="submit">
<a href="../../mco_menu.php"><input type="button" value="Atras"></a>




     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);