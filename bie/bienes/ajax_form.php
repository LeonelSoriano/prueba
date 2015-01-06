<?php



if(isset($_POST['codigo'])){

    $codigo = $_POST['codigo'];


    echo("<tr>
        <td><label>Nombre del Bien</label></td>
        <td><input type='text' name='nombre_bien'/></td>
        </tr>");

    echo("<tr>
        <td><label>Código</label></td>
        <td><input type='text' name='codigo' name='codigo'/></td>
        </tr>");


    echo("<tr>
        <td><label>Código Contable</label></td>
        <td><input type='text' name='codigo_contable' name='codigo_contable'/></td>
        </tr>");



    if($codigo != 4){

        echo("<tr>
            <td><label>Departamento</label></td>
            <td><input type='text' name='departamento' disabled/></td>
            <td><input type='button' name='departamento_buscar' id='departamento_buscar' value='Buscar'/></td>
            <td><input type='hidden' name='departamento_hi' name='departamento_hi'/></td>
            </tr>");


        echo(" <script>
                    $( '#departamento_buscar' ).click(function() {
                    var win = window.open('departamento_buscar.php', 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');
                    win.focus();
                });

        </script>

        ");
    }

    echo("<tr>
        <td><label>Vida Útil (Años)</label></td>
        <td><input type='text' name='vida_util'/></td>
        </tr>");


    echo("<tr>
              <td>
                   <label >Fecha de Adquisición</label>
              </td>
                   <td>
                       <p>
                           <input type='text' id='datepicker1' name='fecha_adquisicion'>
                       </p>
                   </td>
             </tr>");


    echo("<tr>
        <td><label>Costo de Adquisición</label></td>
        <td><input type='text' name='costo_adquisicion'/></td>
        </tr>");




    echo(" <script>
        $(function(){
           $('#datepicker1' ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: '-100:+0'});
            $('#datepicker2' ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: '-100:+0'});
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth()<10){
                mes = myDate.getMonth() +1;
                mes = '0' + mes;
            }else{
                mes = myDate.getMonth() + 1;
            }
            var dia = 0;
            if(myDate.getDate()  < 10){
                dia = myDate.getDate();
                dia = '0' + dia;
            }else{
                dia = myDate.getDate();
            }

            var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + dia ;
            $('#datepicker1').val(prettyDate);
            $('#datepicker2').val(prettyDate);

        });
    </script>

");

echo("<tr>
    <td><label>Valor de Rescate</label></td>
    <td><input type='text' name='valor_rescate'/></td>
    </tr>");


echo("<tr>
<td><label>Monto a depreciar</label></td>
<td><input type='text' name='monto_depreciar'/></td>
</tr>");










    if($codigo == 1){ // basico

        echo("<tr>
            <td><label>Horas Trabajadas</label></td>
            <td><input type='text' name='horas'/></td>
            </tr>");


        echo("<input type='hidden' name='codigo_tipo' value='1'/>");

        echo("<tr>
<td><label>Metodo de Depreciacion</label></td>
<td><select name='metodo_depreciacion'>

        <option value='1'>Linea Recta</option>
      <!--  <option value='2'>Unidades Producidas</option> -->
       <!-- <option value='3'>Ktms. Recoridos</option> -->
       <!-- <option value='4'>Digito Creciente</option> -->
       <!-- <option value='5'>Digito Decreciente</option> -->
       <!-- <option value='6'>% Fijo</option> -->
        <option value='7'>Horas Trabajadas</option>
 </select><td>
</tr>");


    }else if($codigo == 2){//maquinaria

        echo("<tr>
            <td><label>Unidades Producidas</label></td>
            <td><input type='text' name='unidades_producidas'/></td>
            </tr>");

        echo("<tr>
            <td><label>Horas Trabajadas</label></td>
            <td><input type='text' name='horas'/></td>
            </tr>");

        echo("<input type='hidden' name='codigo_tipo' value='2'/>");

        echo("<tr>
<td><label>Metodo de Depreciacion</label></td>
<td><select name='metodo_depreciacion'>

        <option value='1'>Linea Recta</option>
        <option value='2'>Unidades Producidas</option>
       <!-- <option value='3'>Ktms. Recoridos</option> -->
       <!-- <option value='4'>Digito Creciente</option> -->
       <!-- <option value='5'>Digito Decreciente</option> -->
       <!-- <option value='6'>% Fijo</option> -->
        <option value='7'>Horas Trabajadas</option>
 </select><td>
</tr>");




    }else if($codigo == 3){//vehiculo

        echo("<tr>
            <td><label>Kilómetros</label></td>
            <td><input type='text' name='kilometros'/></td>
            </tr>");


        echo("<tr>
        <td><label>Modelo</label></td>
        <td><input type='text' name='modelo_vehculo'/></td>
        </tr>");

        echo("<tr>
        <td><label>Marca</label></td>
        <td><input type='text' name='marca_vehculo'/></td>
        </tr>");


        echo("<tr>
        <td><label>Tipo</label></td>
        <td><input type='text' name='tipo_vehculo'/></td>
        </tr>");


        echo("<tr>
        <td><label>Placa</label></td>
        <td><input type='text' name='placa_vehculo'/></td>
        </tr>");



        echo("<tr>
        <td><label>Serial</label></td>
        <td><input type='text' name='serial_vehculo'/></td>
        </tr>");



        echo("<tr>
            <td><label>Tipo de Licencia</label></td>
            <td><select name='tipo_licencia'>
                    <option value='1'>Tercera</option>
                    <option value='2'>Cuarta</option>
                    <option value='3'>Quinta</option>
             </select><td>
        </tr>");

        echo("<input type='hidden' name='codigo_tipo' value='3'/>");

        echo("<tr>
<td><label>Metodo de Depreciacion</label></td>
<td><select name='metodo_depreciacion'>

        <option value='1'>Linea Recta</option>
       <!-- <option value='2'>Unidades Producidas</option>  -->
        <option value='3'>Ktms. Recoridos</option>
       <!-- <option value='4'>Digito Creciente</option> -->
       <!-- <option value='5'>Digito Decreciente</option> -->
       <!-- <option value='6'>% Fijo</option> -->
      <!--  <option value='7'>Horas Trabajadas</option> -->
 </select><td>
</tr>");

    }else if($codigo == 4){//activo principal

        echo("<tr>
            <td><label>Mts<sup>2</sup>. de la Edificación</label></td>
            <td><input type='text' name='mts_edificacion'/></td>
            </tr>");

        echo("<input type='hidden' name='codigo_tipo' value='4'/>");

    }else{
        echo("ERROR EN ENVIO DE PRAMETROS");
    }


    echo("<tr>
        <td><label>Valor del Mercado</label></td>
        <td><input type='text' name='valor_mercado'/></td>
        </tr>");

    echo("<tr>
        <td><label>Valor Actualizado</label></td>
        <td><input type='text' name='valor_actualizado'/></td>
        </tr>");




}


