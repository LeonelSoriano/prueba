<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 09:11 AM
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

        array('nombre' => 'bono_codigo',
            'requerida' => true,
            'regla' => 'number'),


        array('nombre' => 'valor',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => '.')

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $bono_codigo = $_POST['bono_codigo'];
        $valor = $_POST['valor'];


        $sql = "UPDATE mno_new_variables SET valor = '$valor'
                  WHERE codigo  = '$bono_codigo'";

        mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());

        send_error_redirect(false);
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true);
    }
}


include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Variables de Sistema');



$layout->append_to_header(
    <<<EOT
  <script type="text/javascript">

        $(function() {


            $('#bono').bind('change',function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var codigo = valueSelected;


                var parametros = { codigo : codigo};

                $.ajax({
                    data:  parametros,
                    url:   'ajax_variable.php',
                    type:  'post',
                    dataType: "json",
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        //$("#respuesta").html(response);
                        //$("#valor").val(response);
                        //alert(response['valor']);
                        $("#valor").val(response['valor']);


                    }
                });


            });



            var codigo = $("#bono").val();
            var parametros = { codigo : codigo};



            $.ajax({
                data:  parametros,
                url:   'ajax_variable.php',
                type:  'post',
                dataType: "json",
                beforeSend: function () {
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {
                    //$("#respuesta").html(response);
                    $("#valor").val(response['valor']);





                }
            });



        });

    </script>
EOT
);

$layout->get_header();

$select_bono_from = '';


$consulta_mysql="SELECT * FROM mno_new_variables WHERE fijo = 'no'
                                    ORDER BY nombre";
$resultado_consulta_mysql=mysql_query($consulta_mysql);

$select_bono_from .= "<select name='bono_codigo' id='bono' >";
while($fila=mysql_fetch_array($resultado_consulta_mysql)){
    $select_bono_from .= "<option value='".$fila['codigo']."'>".$fila['nombre']."</option>";
}
$select_bono_from .= "</select>";





$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8" name="formulario"   id="contact-form">
    <div class="formLayout">
    <fieldset>

 <label>Bono</label>
 $select_bono_from
 <br/>

 <label >Valor</label>
 <input type="text" name="valor" id="valor" />
 <br/><br/>

  <div id="respuesta">
  </div>

 <br/>

 <input type="submit" value="Guardar datos" name="submit">
 <a href="./variable_ver.php"><input type="button" value="Ver">
 <a href="../../mco_menu.php"><input type="button" value="Atras">

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);