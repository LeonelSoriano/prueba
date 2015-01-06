<?php
header("Content-Type: text/html;charset=utf-8");


include("../../db.php");
require_once("../../clases/funciones.php");
require_once("../../clases/Validate.php");




if(isset($_POST['submit'])){


    var_dump($_POST);die;


    $tipo = $_POST['codigo_tipo'];

    if($tipo == 1){//basico

        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true
            ),

             array('nombre' => 'costo_adquisicion',
                 'requerida' => true,
                 'regla' => 'float',
                 'tipo' => ','
             ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number',
                'tipo' => ','
            )

        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();


        if(!$validated->getIsError()){

            $nombre_bien = $_POST['nombre_bien'];
            $codigo_alias = $_POST['codigo'];
            $codigo_contable = $_POST['codigo_contable'];
            $departamento_hi = $_POST['departamento_hi'];
            $vida_util = $_POST['vida_util'];
            $fecha_adquisicion = $_POST['fecha_adquisicion'];
            $costo_adquisicion = $_POST['costo_adquisicion'];
            $valor_rescate = $_POST['valor_rescate'];
            $monto_depreciar = $_POST['monto_depreciar'];
            $metodo_depreciacion = $_POST['metodo_depreciacion'];
            $valor_mercado = $_POST['valor_mercado'];
            $valor_actualizado = $_POST['valor_actualizado'];
            $valor_actualizado = $_POST['valor_actualizado'];
            $horas = $_POST['horas'];


            $sql = "INSERT INTO bie_tipo_basico(nombre_bien,codigo_alias,codigo_contable,codigo_departamento,
            vida_util,fecha_adquisicion,costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,
            valor_mercado,valor_actualizado,horas_trabajadas)
            VALUES
            ('$nombre_bien','$codigo_alias','$codigo_contable','$departamento_hi','$vida_util',
            '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion',
            '$valor_mercado','$valor_actualizado','$horas') ";


            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

            send_error_redirect(false,'Datos Guardados Exitosamente(Basico)');
            die;
        }else if($validated->getIsError()){
            send_error_redirect(true,"Hay Errores en la Información del formulario(Basico)");die;
        }


    }else if($tipo == 2){//maquinaria


        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true
            ),

            array('nombre' => 'costo_adquisicion',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),
            array('nombre' => 'unidades_producidas',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number',
                'tipo' => ','
            ),

        );

        $validated = new Validate($validation,$_POST);
        $validated->validate();


        if(!$validated->getIsError()){

            $nombre_bien = $_POST['nombre_bien'];
            $codigo_alias = $_POST['codigo'];
            $codigo_contable = $_POST['codigo_contable'];
            $departamento_hi = $_POST['departamento_hi'];
            $vida_util = $_POST['vida_util'];
            $fecha_adquisicion = $_POST['fecha_adquisicion'];
            $costo_adquisicion = $_POST['costo_adquisicion'];
            $valor_rescate = $_POST['valor_rescate'];
            $monto_depreciar = $_POST['monto_depreciar'];
            $metodo_depreciacion = $_POST['metodo_depreciacion'];
            $valor_mercado = $_POST['valor_mercado'];
            $valor_actualizado = $_POST['valor_actualizado'];
            $unidades_producidas = $_POST['unidades_producidas'];
            $horas= $_POST['horas'];


            $sql = "INSERT INTO bie_tipo_maquinaria(nombre_bien,codigo_alias,codigo_contable,codigo_departamento,
            vida_util,fecha_adquisicion,costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,
            valor_mercado,valor_actualizado,unidades_producidas,horas_trabajadas)
            VALUES
            ('$nombre_bien','$codigo_alias','$codigo_contable','$departamento_hi','$vida_util',
            '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion',
            '$valor_mercado','$valor_actualizado','$unidades_producidas','$horas')";

            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


            send_error_redirect(false,'Datos Guardados Exitosamente(Maquinaria)');
            die;

        }else if($validated->getIsError()){
            send_error_redirect(true,"Hay Errores en la Información del formulario(Maquinaria)");die;
        }


    }else if($tipo == 3){//vehiculo


        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true
            ),

            array('nombre' => 'costo_adquisicion',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),


            array('nombre' => 'kilometros',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'kilometros',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'placa_vehculo',
                'requerida' => true
            ),

            array('nombre' => 'departamento_hi',
                'requerida' => true,
                'regla' => 'number',
                'tipo' => ','
            ),

        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();


        if(!$validated->getIsError()){


            $nombre_bien = $_POST ['nombre_bien'];
            $codigo_alias = $_POST['codigo'];
            $codigo_contable = $_POST['codigo_contable'];
            $codigo_departamento = $_POST['departamento_hi'];
            $vida_util = $_POST['vida_util'];
            $fecha_adquisicion = $_POST['fecha_adquisicion'];
            $costo_adquisicion = $_POST['costo_adquisicion'];
            $valor_rescate = $_POST['valor_rescate'];
            $monto_depreciar = $_POST['monto_depreciar'];
            $metodo_depreciacion = $_POST['metodo_depreciacion'];
            $kilometros = $_POST['kilometros'];
            $modelo_vehculo = $_POST['modelo_vehculo'];
            $marca_vehculo = $_POST['marca_vehculo'];
            $tipo_vehculo = $_POST['tipo_vehculo'];
            $placa_vehculo = $_POST['placa_vehculo'];
            $serial_vehculo = $_POST['serial_vehculo'];
            $tipo_licencia = $_POST['tipo_licencia'];
            $valor_mercado = $_POST['valor_mercado'];
            $valor_actualizado = $_POST['valor_actualizado'];


            $sql = "INSERT INTO bie_tipo_vehiculo
                (nombre_bien,codigo_alias,codigo_contable,codigo_departamento,vida_util,fecha_adquisicion,
                costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,kilometros,modelo_vehculo,
                marca_vehculo,tipo_vehculo,placa_vehculo,serial_vehculo,tipo_licencia,valor_mercado,valor_actualizado)
                VALUES
                ('$nombre_bien','$codigo_alias','$codigo_contable','$codigo_departamento','$vida_util',
                '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion','$kilometros',
                '$modelo_vehculo','$marca_vehculo','$tipo_vehculo','$placa_vehculo','$serial_vehculo','$tipo_licencia',
                '$valor_mercado','$valor_actualizado')";


            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


            send_error_redirect(false,'Datos Guardados Exitosamente (Vehiculos)');
            die;
        }else if($validated->getIsError()){
            send_error_redirect(true,"Hay Errores en la Información del formulario (Vehiculos)");die;
        }


    }else if($tipo == 4){//activo principal

        $validation = array(

            array('nombre' => 'codigo_contable',
                'requerida' => true),

            array('nombre' => 'nombre_bien',
                'requerida' => true),

            array('nombre' => 'vida_util',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'costo_adquisicion',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_rescate',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'monto_depreciar',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'fecha_adquisicion',
                'requerida' => true,
                'regla' => 'fecha'),

            array('nombre' => 'metodo_depreciacion',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'valor_mercado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

            array('nombre' => 'valor_actualizado',
                'requerida' => false,
                'regla' => 'float',
                'tipo' => ','
            ),

        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();

        if(!$validated->getIsError()){

            $nombre_bien = $_POST['nombre_bien'];
            $codigo_alias = $_POST['codigo'];
            $codigo_contable = $_POST['codigo_contable'];
            $vida_util = $_POST['vida_util'];
            $fecha_adquisicion = $_POST['fecha_adquisicion'];
            $costo_adquisicion = $_POST['costo_adquisicion'];
            $valor_rescate = $_POST['valor_rescate'];
            $monto_depreciar = $_POST['monto_depreciar'];
            $metodo_depreciacion = $_POST['metodo_depreciacion'];
            $valor_mercado = $_POST['valor_mercado'];
            $valor_actualizado = $_POST['valor_actualizado'];
            $metros2 = $_POST['mts_edificacion'];


            $sql = "INSERT INTO bie_tipo_activo_principal(nombre_bien,codigo_alias,codigo_contable,
            vida_util,fecha_adquisicion,costo_adquisicion,valor_rescate,monto_depreciar,codigo_depreciacion,
            valor_mercado,valor_actualizado,mts_edificacion)
            VALUES
            ('$nombre_bien','$codigo_alias','$codigo_contable','$vida_util',
            '$fecha_adquisicion','$costo_adquisicion','$valor_rescate','$monto_depreciar','$metodo_depreciacion',
            '$valor_mercado','$valor_actualizado','$metros2') ";


            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

            $ultimo_ID = mysql_insert_id();

            header('Location: ./agregar_departamento_activo_principal.php?id='.$ultimo_ID.'');


        }else if($validated->getIsError()){
            send_error_redirect(true);
        }


    }


}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>


    <!-- / END -->

    <script>

        $(function(){



            var codigo = "";

            $('#tipo_bien').bind('change',function(){
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                codigo = valueSelected;

                var parametros = { codigo : codigo };

                $.ajax({
                    data:  parametros,
                    url:   'ajax_form.php',
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



            var parametros = { codigo : 1 };

            $.ajax({
                data:  parametros,
                url:   'ajax_form.php',
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

    </script>


</head>
<body class="flickr-com">

<form method="post" name="agregar_bienes">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" style="width: 80%">
                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes y Propiedades | Agregar Bien </strong></h1>


                            <br/>

                            <?php

                            if(isset($_GET['msg'])){
                                $error =  $_GET['error'];

                                $msg = $_GET['msg'];

                                if($error == 'true'){
                                    echo('<div id="error_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');
                                }else if($error == 'false'){
                                    echo('<div id="done_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');

                                }

                            }

                            ?>


                            <br/>
                            <p style="margin-left: 40px">
                                <label>Tipo de Bien</label>&nbsp;&nbsp;&nbsp;

                                <select id="tipo_bien">
                                    <?php
                                    $result=mysql_query("SELECT * FROM bie_tipo_bien");
                                    while($test = mysql_fetch_array($result)){

                                        echo"<option value='".$test['codigo']."'>". $test['nombre']."</option>";
                                    }

                                    ?>
                                </select>
                            </p>


                            <br/><br/>
                            <table BORDER="0" CELLSPACING="4" WIDTH="380"  id="tabla_nueva">



                            </table>
                            <br/><br/><br/>
                            <input type="submit" name="submit" value="Guardar"/>
                            <a href="../../bie_menu.php"><input type="button" value="Atras"></a>
                            <p></p>
                        </div>
                    </div><!--end firefoxbug-->
                </div><!--end left_bgd-->

            </div>
            <p>
                <!--end right_col-->
            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>

    <!-- / END -->

</form>

</body>
</html>