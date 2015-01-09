<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 03:43 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');
require_once("../../clases/funciones.php");



$a = new Seguridad();

$a->chekear_session();


//POST

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Reabrir Orden');



$layout->append_to_header(
    <<<EOT
    <script>

        $(function(){


            var codigo = "";

            $('#inventario').bind('change',function(){
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                codigo = valueSelected;

                var parametros = { codigo : codigo };

                $.ajax({
                    data:  parametros,
                    url:   'ajax_ver_bienes.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#tabla_nueva").html(response);
                    }
                });


            });

        });


    </script>

EOT
);

$layout->get_header();


$select_form = '';

$result=mysql_query("SELECT nombre,codigo FROM bie_tipo_bien");
while($test = mysql_fetch_array($result)){
    $select_form .= "<option value='". $test['codigo'] ."'>". $test['nombre']."</option>";
}




$layout->set_form(

    <<<EOT
 
     <form form method="post" name="inventario_ver"   id="contact-form">
    <div class="formLayout">
    <fieldset>

 <label>Tipo de Activo</label>
 <select id="inventario">
      <option ></option>
   $select_form
 </select>

 <br/><br/>
<table border=none class="tablas-nuevas" id="tabla_nueva">



</table>

<br/>

<a href="../../bie_menu.php"><input type="button" value="Atras"></a>


     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);