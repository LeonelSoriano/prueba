<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 10:08 AM
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


        array('nombre' => 'tipo_pago',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'periocidad',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'nombre',
            'requerida' => true
        ),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $nombre = $_POST['nombre'];
        $fijo = 'no';
        if(isset($_POST['fijo'])){
            $fijo = 'si';
        }

        $periocidad = $_POST['periocidad'];

        $tipo_pago = $_POST['tipo_pago'];

        $valor = $_POST['valor'];

        $formula = str_replace(' ', '',$nombre);
        $formula = lcfirst($formula);


        $sql = "INSERT INTO mno_new_bonos_produccion
                (nombre,tipo_concepto,codigo_formula,valor,tipo_forma_pago,tipo_periocidad,fijo)
              VALUES
              ('$nombre','2','$formula','$valor','$tipo_pago','$periocidad','$fijo')" ;



        mysql_query($sql) or die('error agregar bono nuevo'.mysql_error());

        send_error_redirect(false);
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true);
    }
}




include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Reabrir Orden');



$layout->append_to_header(
    <<<EOT
    <script type="text/javascript">

        $(function() {

            $("#buscar_vehiculo").click(function() {
                var win = window.open("buscar_vehiculo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>
EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form  method="post" accept-charset="UTF-8" name="formulario"  id="contact-form">
    <div class="formLayout">
    <fieldset>
     <div>Nota: El nombre solo puede contener letras</div>
     <br/>

 <label>Nombre</label>
  <input id="nombre" name="nombre" type="text"/>
  <br/>

  <label>Fijo?</label>
  <input id="fijo" name="fijo" type="checkbox"/>
  <br/>

  <label>Periocidad</label>
  <select name="periocidad" id="periocidad">
    <option value="0">Mes</option>
    <option value="1">Quinceal</option>
    <option value="2">Mensual</option>
    <option value="3">Bimestral</option>
    <option value="4">Trimestral</option>
    <option value="5">Cuatrmestral</option>
    <option value="6">Semestral</option>
    <option value="7">Anual</option>
</select>

<br/>

 <label>Forma de Pago</label>
  <select name="tipo_pago" id="tipo_pago">
    <option value="0">Monto Fijo</option>
    <option value="1">% Salario Base</option>
    <option value="2">% Salario Normal</option>
    <option value="3">% Salario Integral</option>
    <option value="4">Unidad Tributaria</option>
</select>
 <br/>


   <label>Valor</label>
    <input id="valor" name="valor" type="text"/>

    <br/>

    <input type="submit" value="Guardar datos" name="submit">
    <a href="./bono_produccion_ver.php"><input type="button" value="Ver datos">
    <a href="../../mno_menu2.php"><input type="button" value="Atras"></a>
 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);