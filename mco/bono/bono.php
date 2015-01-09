<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 09:04 AM
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
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){

        $bono_codigo = $_POST['bono_codigo'];
        $valor = $_POST['valor'];
        $tipo_pago = $_POST['tipo_pago'];
        $periocidad = $_POST['periocidad'];

        $sql = "UPDATE mno_new_concepto SET valor = '$valor', tipo_forma_pago = '$tipo_pago',
                  tipo_periocidad = '$periocidad'
                  WHERE codigo  = '$bono_codigo'";

        mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());

        send_error_redirect(false);
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true);
    }
}

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm(' Módulo de Configuración | Bonos');



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
                    url:   'ajax_bono.php',
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

                        $("#tipo_pago").val(response['tipo_pago']);
                        $("#periocidad").val(response['tipo_periocidad']);

                    }
                });


            });



            var codigo = $("#bono").val();
            var parametros = { codigo : codigo};



            $.ajax({
                data:  parametros,
                url:   'ajax_bono.php',
                type:  'post',
                dataType: "json",
                beforeSend: function () {
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {
                    //$("#respuesta").html(response);
                    $("#valor").val(response['valor']);

                    $("#tipo_pago").val(response['tipo_pago']);

                    $("#periocidad").val(response['tipo_periocidad']);



                }
            });



        });

    </script>
EOT
);

$layout->get_header();


$select_from = '';

$consulta_mysql='SELECT * FROM mno_new_concepto WHERE
  codigo = 19 OR codigo = 20 OR codigo = 37 OR codigo = 38 OR codigo = 39 OR codigo = 40 OR
  codigo = 41 OR codigo = 43 OR codigo = 44 OR codigo = 45 OR codigo = 46 OR codigo = 42 OR codigo = 47 OR codigo = 48  OR
  codigo = 49 OR codigo = 50 OR codigo = 51 OR codigo = 49 OR codigo = 11 OR codigo = 12 OR codigo = 17 OR codigo = 18 ORDER BY mno_new_concepto.nombre' ;
$resultado_consulta_mysql=mysql_query($consulta_mysql);

$select_from .= "<select name='bono_codigo' id='bono' >";
while($fila=mysql_fetch_array($resultado_consulta_mysql)){
    $select_from .= "<option value='".$fila['codigo']."'>".$fila['nombre']."</option>";
}
$select_from .=  "</select>";



$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8" name="formulario"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 <label>Bono</label>
 $select_from
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

 <label>Forma de Pago</label>
<select name="tipo_pago" id="tipo_pago">
    <option value="0" >Monto Fijo</option>
    <option value="1">% Salario Base</option>
    <option value="2">Unidad Tributaria</option>
</select>
<br/>


<label >Valor</label>
<input type="text" name="valor" id="valor" />
<br/>
<br/>

 <div id="respuesta">

</div>

<br/>
<br/>
<a href="../../mco_menu.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);