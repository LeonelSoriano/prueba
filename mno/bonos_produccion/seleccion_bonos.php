<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 10:17 AM
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

        array('nombre' => 'kilometros',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'codigo_bien_hi',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'agua',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'frenos',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'aceite',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'filtro',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'cauchos',
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $kilometros = $_POST['kilometros'];
        $observacion = $_POST['observacion'];
        $codigo_bien_hi = $_POST['codigo_bien_hi'];
        $caucho = $_POST['cauchos'];
        $filtro = $_POST['filtro'];
        $aceite = $_POST['aceite'];
        $agua = $_POST['agua'];
        $frenos = $_POST['frenos'];
        $fecha_actual = fecha_sicap();



        $sql = "SELECT kilometros FROM bie_tipo_vehiculo WHERE codigo = '$codigo_bien_hi'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $kilometros_anteror = $test['kilometros'];

        $nuevos_kilometros =$kilometros - $kilometros_anteror ;



        $sql = "INSERT INTO bie_revicion_diaria_vhiculo
          (cod_vehiculo,agua,aceite,filtro,caucho,frenos,observacion,fecha,kilometros)
          VALUES
          ('$codigo_bien_hi','$agua','$aceite','$filtro','$caucho','$frenos','$observacion','$fecha_actual','$nuevos_kilometros')";



        mysql_query($sql) or die('error agregar revicion de vehiculo'.mysql_error());



        $sql = "UPDATE bie_tipo_vehiculo SET kilometros = '$kilometros' WHERE codigo = '$codigo_bien_hi'";

        mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());

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

            $("#buscar_bono").click(function() {
                var win = window.open("bono_buscar.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>
EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form method="get" accept-charset="UTF-8" name="formulario" action="bono_tabulador.php"   id="contact-form">
    <div class="formLayout">
    <fieldset>

 <label>Bono</label>
 <input type="text" name="nombre_bono"  disabled>
 <input type="button" name="buscar_bono" id="buscar_bono" value="Buscar"/>
 <input type="hidden" name="codigo_bono_hi" id="codigo_bono_hi"/>
 <br/>
<br/>

 <input type="submit" value="Crear Tabulador" name="submit">
 <a href="../../mno_menu2.php"><input type="button" value="Atras"></a>

 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);