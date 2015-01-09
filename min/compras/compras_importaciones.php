<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 12:17 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


//POST

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Reabrir Orden');



$layout->append_to_header(
    <<<EOT
 <script>

function SumComa()
{



    var pila_sum = new Array();
    var acum_sum = 0;

    this.add = function(str){

        var tmp = str.replace(",",".");

        pila_sum.push(tmp);
    }




    this.print = function(){

        for(var i = 0 ; i < pila_sum.length ; i++)
            console.log(pila_sum[i] + " -> "+ typeof(pila_sum[i]));
    }

    this.getSum = function(){

        for(var i = 0 ; i < pila_sum.length ; i++){

            if(pila_sum[i].length == 0){
                pila_sum[i] = 0;
            }
            acum_sum = parseFloat(acum_sum) + parseFloat( pila_sum[i]);



        }

        acum_sum =  Math.round(acum_sum*100)/100

        acum_sum = acum_sum.toString();
        acum_sum = acum_sum.replace(".",",");





        var rtn = acum_sum;
        acum_sum = 0;

        pila_sum.length = 0;

        return rtn;
    }


    this.divComa = function(num,div){
        var div = div.replace(",",".");
        var num = num.replace(",",".");

        div = parseFloat(div);
        num = parseFloat(num);


        var resultado = num / div;


        resultado = Math.round(resultado*100)/100;


        resultado = resultado.toString();
        resultado = resultado.replace(".",",");


        return resultado;

    }


    this.getMul = function(){

        if(acum_sum == 0 ){
            acum_sum = 1;
        }
        for(var i = 0 ; i < pila_sum.length ; i++){

            if(pila_sum[i].length == 0){
                pila_sum[i] = 0;
            }
            acum_sum = parseFloat(acum_sum) * parseFloat( pila_sum[i]);

        }

        acum_sum =  Math.round(acum_sum*100)/100

        acum_sum = acum_sum.toString();
        acum_sum = acum_sum.replace(".",",");


        var rtn = acum_sum;
        acum_sum = 0;

        pila_sum.length = 0;

        return rtn;
    }



}


        var  costo_aduanales;
        var gastos_importacion;
        var gastos_arancelarios;
        var gasto_nacionalizacion;

        $(function() {


            $("input[name=opcion_importacion][value=" + opener.document.compras.check_importacion.value + "]").prop('checked', true);
            $("input[name=opcion_aduanales][value=" + opener.document.compras.check_aduanales.value + "]").prop('checked', true);
            $("input[name=opcion_arancelarios][value=" + opener.document.compras.check_arancelarios.value + "]").prop('checked', true);
            $("input[name=opcion_nacionalizacion][value=" + opener.document.compras.check_nacionalizacion.value + "]").prop('checked', true);


            var sumComa = new SumComa();

            $( "#gasto_importacion").val(opener.document.compras.gasto_importacion.value);
            $( "#gasto_aduanales").val(opener.document.compras.gasto_aduanales.value);
            $( "#gastos_arancelarios").val(opener.document.compras.gasto_arancelarios.value);
            $( "#gasto_nacionalizacion").val(opener.document.compras.gasto_nacionalizacion.value);
            $( "#tasa_cambio").val(opener.document.compras.tasa_cambio.value);

            $( "#CONCEX" ).click(function() {
                $( "#tasa_cambio").val("6,3");

            });

            $( "#SICAD" ).click(function() {
                $( "#tasa_cambio").val("11,00");
            });

            $( "#SICAD_II" ).click(function() {
                $( "#tasa_cambio").val("49,98");
            });


            $("#boton_submit").click(function() {


                var opcion_importacion = $('input[name=opcion_importacion]:checked', '#myForm').val();
                var opcion_aduanales = $('input[name=opcion_aduanales]:checked', '#myForm').val();
                var opcion_arancelarios = $('input[name=opcion_arancelarios]:checked', '#myForm').val();
                var opcion_nacionalizacion = $('input[name=opcion_nacionalizacion]:checked', '#myForm').val();



                if(opcion_importacion != "bs"){

                    sumComa.add($( "#gasto_importacion").val());
                    sumComa.add($( "#tasa_cambio").val());

                    gastos_importacion = sumComa.getMul();
                }else{
                    sumComa.add($( "#gasto_importacion").val());
                    gastos_importacion = sumComa.getSum();
                }

                /*..-.-.-.-..-.-.-.-.-.*/
                if(opcion_aduanales != "bs"){


                    sumComa.add($( "#gasto_aduanales").val());
                    sumComa.add($( "#tasa_cambio").val());

                    costo_aduanales = sumComa.getMul();
                }else{
                    sumComa.add($( "#gasto_aduanales").val());
                    costo_aduanales = sumComa.getSum();
                }

                /*..-.-.-.-..-.-.-.-.-.*/
                if(opcion_aduanales != "bs"){


                    sumComa.add($( "#gastos_arancelarios").val());
                    sumComa.add($( "#tasa_cambio").val());

                    gastos_arancelarios = sumComa.getMul();
                }else{

                    sumComa.add($( "#gastos_arancelarios").val());
                    gastos_arancelarios = sumComa.getSum();
                }


                /*..-.-.-.-..-.-.-.-.-.*/
                if(opcion_nacionalizacion != "bs"){


                    sumComa.add($( "#gasto_nacionalizacion").val());
                    sumComa.add($( "#tasa_cambio").val());

                    gasto_nacionalizacion = sumComa.getMul();
                }else{

                    sumComa.add($( "#gasto_nacionalizacion").val());
                    gasto_nacionalizacion = sumComa.getSum();
                }

                sumComa.add(costo_aduanales);
                sumComa.add(gastos_importacion);
                sumComa.add(gastos_arancelarios);
                sumComa.add(gasto_nacionalizacion);


                var  suma_total_importacion = sumComa.getSum();



                opener.document.compras.gasto_importacion.value = $( "#gasto_importacion").val();
                opener.document.compras.gasto_aduanales.value = $( "#gasto_aduanales").val();
                opener.document.compras.gasto_arancelarios.value = $( "#gastos_arancelarios").val();
                opener.document.compras.gasto_nacionalizacion.value = $( "#gasto_nacionalizacion").val();
                opener.document.compras.tasa_cambio.value = $( "#tasa_cambio").val();
                opener.document.compras.valor_importacion.value = suma_total_importacion;



                opener.document.compras.check_importacion.value = opcion_importacion;
                opener.document.compras.check_aduanales.value = opcion_aduanales;
                opener.document.compras.check_arancelarios.value = opcion_arancelarios;
                opener.document.compras.check_nacionalizacion.value = opcion_nacionalizacion;




                window.close();
            });
            //Dólar ($)
            //alert(opener.document.compras.unidad_medida.value);




        });
    </script>


    <style>
        #tabla{

            width: 95%;
        }
    </style>


EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form method="post"  accept-charset="UTF-8"   id="contact-form" id="myForm">
    <div class="formLayout">
    <fieldset>

    <label>Gasto de Importación </label>
    <input type="text" id="gasto_importacion" name="gasto_importacion" />
    <br/>

    <input type="radio"  name="opcion_importacion" value="bs" checked/>&nbsp; Bol&iacute;var
    <br/>

    <input type="radio"  name="opcion_importacion" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
    <br/>
     <br/>

    <label>Gastos Aduanales</label>
    <input type="text" name="" id="gasto_aduanales" />
    <br/>

    <input type="radio"  name="opcion_aduanales" value="bs" checked/>&nbsp; Bol&iacute;var
     <br/>
    <input type="radio"  name="opcion_aduanales" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
    <br/>
     <br/>

    <label>Gastos Arancelarios</label>
    <input type="text" name="gastos_arancelarios" id="gastos_arancelarios">
    <br/>

    <input type="radio" name="opcion_arancelarios" value="bs" checked/>&nbsp; Bol&iacute;var
    <br/>
     <input type="radio" name="opcion_arancelarios" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
      <br/>
 <br/>

 <label >Gasto de Nacionalizacion</label>
 <input type="text" name="gasto_nacionalizacion" id="gasto_nacionalizacion" />
 <br/>

 <input type="radio"  name="opcion_nacionalizacion" value="bs" checked/>&nbsp; Bol&iacute;var
 <br/>
 <input type="radio" name="opcion_nacionalizacion" value="moneda_extranjera"/>&nbsp; Moneda Extranjera
 <br/>
 <br/>

 <label >Tasa de Cambio</label>
 <input type="text" name="tasa_cambio" id="tasa_cambio"/>
 <br/>

 <input type="button" name="CONCEX" value="CONCEX" id="CONCEX"/>
 <input type="button" name="SICAD" value="SICAD" id="SICAD"/>
 <input type="button" name="SICAD_II" value="SICAD II" id="SICAD_II"/>

 <br/>
 <br/>
 <input type="button" id="boton_submit" value="Guardar datos" name="boton_submit" />

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);