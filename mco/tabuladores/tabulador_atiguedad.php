<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 08:35 AM
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

        array('nombre' => 'valor',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'paso',
            'requerida' => true,
            'regla' => 'number'),


        array('nombre' => 'hasta',
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $valor = $_POST['valor'];
        $paso = $_POST['paso'];
        $hasta = $_POST['hasta'];


        $sql = "INSERT INTO  mco_tabulador_antiguedad(paso,valor,referencia) VALUES
        ('$paso','$valor','$hasta')";

        mysql_query($sql) or die('error agregar revicion de vehiculo'.mysql_error());


        send_error_redirect(false);
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true);
    }
}

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Tabulador Antiguedad');



$layout->append_to_header(
    <<<EOT

        <script type="text/javascript">
        $(function () {



        $("#reiniciar").click(function() {

            $("#dialog").dialog({
                modal: true,
                title: 'Reinicar Tabulador',
                resizable: true,
                autoOpen: true,
                width: 'auto',

                buttons: {
                    Yes: function () {
                        // $(obj).removeAttr('onclick');
                        // $(obj).parents('.Parent').remove();

                        $(this).dialog("close");

                        var parametros = { codigo : 'yes' };

                        $.ajax({
                            data:  parametros,
                            url:   'reiniciar_tabulador_antiguedad.php',
                            type:  'post',
                            beforeSend: function () {

                            },
                            success:  function (response) {
                                location.reload();
                            }
                        });
                    },
                    No: function () {
                        $(this).dialog("close");

                    }
                }

            });

        });//end  dalogo
        });


    </script>

EOT
);

$layout->get_header();


$tabla_from = '';

$sql = "SELECT COUNT(*) as cuenta FROM mco_tabulador_antiguedad";
$result=mysql_query($sql);
$test = mysql_fetch_array($result);

$cuenta =  $test['cuenta'];

if($cuenta != 0){

}


$sql = "SELECT * FROM mco_tabulador_antiguedad ORDER BY paso*1 ASC ";

$result=mysql_query($sql);
while( $test = mysql_fetch_array($result)){

    $tabla_from .= "<tr>";

    $tabla_from .= "<td>".$test['paso']. "&nbsp;&nbsp;&nbsp;  A &nbsp;&nbsp;&nbsp;"  .$test['referencia']. "</td>";
    $tabla_from .= "<td>".$test['valor']."</td>";

    $tabla_from .= "</tr>";
}



$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 

 <label > Condición </label>
 <br/>

 <label > Desde </label>
 <input type="text" name="paso"/>
 <br/>

 <label > Hasta </label>
  <input type="text" name="hasta"/>
  <br/>


  <label > Valor </label>
  <input type="text" name="valor"/>
  <br/>


  <table border=none class="tablas-nuevas" style="margin-left: 0px">

    <tr id="tmp" style="text-align: center">
        <th>Condiciones</th>
        <th>Valor</th>
    </tr>
$tabla_from
</table>

<br/>
<br/>

<input type="submit" value="Agregar Paso" name="submit">
<input type="button" value="Reiniciar Tabulador" id="reiniciar">
<a href="../../mco_menu.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);