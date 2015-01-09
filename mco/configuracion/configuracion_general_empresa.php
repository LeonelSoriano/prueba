<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 08:20 AM
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



    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){



        if(isset($_POST['diferencia_salario'])){
            $sql = "UPDATE configuracion_general  SET valor = 'si' WHERE nombre = 'diferencia_de_salario'";

            mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());
        }else{
            $sql = "UPDATE configuracion_general  SET valor = 'no' WHERE nombre = 'diferencia_de_salario'";

            mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());
        }


        if(isset($_POST['bono_antiguedad'])){
            $sql = "UPDATE configuracion_general  SET valor = 'si' WHERE nombre = 'bono_antiguedad_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad  '.mysql_error());
        }else{
            $sql = "UPDATE configuracion_general  SET valor = 'no' WHERE nombre = 'bono_antiguedad_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad'.mysql_error());
        }


        if(isset($_POST['anhio_servicios'])){
            $sql = "UPDATE configuracion_general  SET valor = 'si' WHERE nombre = 'anhio_servicios_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad  '.mysql_error());
        }else{
            $sql = "UPDATE configuracion_general  SET valor = 'no' WHERE nombre = 'anhio_servicios_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad'.mysql_error());
        }

        send_error_redirect(false);
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true);
    }
}


$sql = "SELECT * FROM configuracion_general WHERE nombre='diferencia_de_salario' ";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$diferencia_salario = $test['valor'];

$sql = "SELECT * FROM configuracion_general WHERE nombre='bono_antiguedad_fijo' ";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$bono_antiguedad = $test['valor'];


$sql = "SELECT * FROM configuracion_general WHERE nombre='anhio_servicios_fijo' ";

$result=mysql_query($sql);

$test = mysql_fetch_array($result);

$anhio_servicios = $test['valor'];




include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Configuracion General');



$layout->append_to_header(
    <<<EOT


EOT
);

$layout->get_header();



$diferenia_salario_form = '';
if($diferencia_salario == 'si') $diferenia_salario_form = "checked";


$bono_antiguedad_from = '';
if($bono_antiguedad == 'si')$bono_antiguedad_from ="checked";

$anhio_servicios_form = '';
if($anhio_servicios == 'si') $anhio_servicios_form ="checked";


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 
 <label >Diferencia de Salario</label>
 <input type="checkbox" style="margin-right:15%;margin-top: 8px" type="radio" name="diferencia_salario" $diferenia_salario_form>
 <br/>

 <label >Bono Antigüedad es Fijo?</label>
 <input type="checkbox" style="margin-right:15%;margin-top: 8px" type="radio" name="bono_antiguedad" $bono_antiguedad_from >
 <br/>

 <label >Años de Servicios es Fijo?</label>
  <input type="checkbox" style="margin-right:15%;margin-top: 8px" type="radio" name="anhio_servicios" $anhio_servicios_form >
<br/>

<input type="submit" value="Guardar datos" name="submit">
<a href="../../mco_menu.php"><input type="button" value="Atras">

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);