<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 10:17 AM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');

if (isset($_POST['submit']))
{


    header("Content-Type: text/html;charset=utf-8");
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
    include('./clases/funciones.php');
    require_once('./min/until/SubirFoto.php');
    include('./clases/Validate.php');



    $validation = array(

        array('nombre' => 'primernombre',
            'requerida' => true,
            'regla' => 'letter'),

        array('nombre' => 'segundonombre',
            'requerida' => false,
            'regla' => 'letter'),

        array('nombre' => 'primerapellido',
            'requerida' => true,
            'regla' => 'letter'),

        array('nombre' => 'segundoapellido',
            'requerida' => false,
            'regla' => 'letter'),

        array('nombre' => 'fechaingreso',
            'requerida' => true),

        array('nombre' => 'cedula',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'fechanacimiento',
            'requerida' => true
        )

    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){
        $cedula=$_POST['cedula'];
        $ficha=$_POST['ficha'];
        $primernombre=  cadena_estetica($_POST['primernombre']);
        $segundonombre= cadena_estetica($_POST['segundonombre']);
        $primerapellido= cadena_estetica($_POST['primerapellido']);
        $segundoapellido= cadena_estetica($_POST['segundoapellido']);
        $fechanacimiento= $_POST['fechanacimiento'];
        $telefono=$_POST['telefono'];
        $celular=$_POST['celular'];
        $estadocivil=$_POST['estadocivil'];
        $becado=$_POST['becado'];
        $sexo=$_POST['sexo'];
        $fechaingreso=$_POST['fechaingreso'];
        $fechaegreso=$_POST['fechaegreso'];
        $codigocargo=$_POST['codigocargo'];
        $estatus=$_POST['estatus'];
        $condicion=$_POST['condicion'];
        $codigoperioricidad=$_POST['codigoperioricidad'];
        $direccionhabitacion=$_POST['direccion'];

        $tipo_trabajador = $_POST['tipo_trabajador'];


        $nacionalidad = $_POST['nacionalidad'];

        $departamento=$_POST['departamento'];

        $vehiculo = $_POST['vehiculo'];


        $subirFoto = new SubirFoto($_FILES['imagen'],'./img_empleados/');
        $subirFoto->cargarFoto();
        $imagen = $subirFoto->getNombreSubir();


        $sql = "SELECT count(*) as total FROM mrh_empleado WHERE  mrh_empleado.cedula = '$cedula' AND mrh_empleado.nacionalidad = '$nacionalidad'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if( strcmp($test['total'],'0')  ){
            $a = $test['total'];
            send_error_redirect(true, "El Empleado ya Existe");
            die;
        }


        $sql = "insert into mrh_empleado(cedula,ficha,primernombre,segundonombre,primerapellido,segundoapellido,
					fechanacimiento,telefono,celular,estadocivil,becado,sexo,fechaingreso,fechaegreso,
						codigocargo,estatus,condicion,codigoperioricidad,direccionhabitacion,codigo_departamento,vehiculo,nacionalidad,tipo_trabajador,foto)
                                                      values('$cedula','$ficha','$primernombre','$segundonombre','$primerapellido','$segundoapellido','$fechanacimiento',
							'$telefono','$celular','$estadocivil','$becado','$sexo','$fechaingreso','$fechaegreso','$codigocargo','$estatus','$condicion',
								'$codigoperioricidad','$direccionhabitacion','$departamento','$vehiculo','$nacionalidad','$tipo_trabajador','$imagen')";
        //echo $sql;
        //exit;
        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }


}



$layout = new LayoutForm('Módulo de Recursos Humanos | Agregar Empleado','.');

$layout->append_to_header('
  <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: "yy-mm-dd",changeYear: true, yearRange: "-100:+0"});
        $( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd",changeYear: true, yearRange: "-100:+0"  });
        $( "#datepicker3" ).datepicker({ dateFormat: "yy-mm-dd",changeYear: true, yearRange: "-100:+0" });
    });
</script>

 ');


include_once("./clases/funciones.php");
$cargos = '';

$consulta_mysql='select * from mrh_cargo ORDER BY descripcion';
$resultado_consulta_mysql=mysql_query($consulta_mysql);

$cargos .= "<select name='codigocargo' id='codigocargo' >";
while($fila=mysql_fetch_array($resultado_consulta_mysql)){
    $cargos .= "<option value='".$fila['codigo']."'>".utf8_multiplataforma($fila['descripcion'])."</option>";
}
$cargos .= "</select>";



$gerencia = '';

$sql = "SELECT mno_gerencia.codigo,mno_gerencia.descripcion FROM mno_gerencia ORDER BY descripcion";
$test = mysql_query($sql);



while($fila=mysql_fetch_array($test)){
   $gerencia .= "<option value='".utf8_multiplataforma($fila['codigo'])."'>".$fila['descripcion']."</option>";

}



$layout->get_header();


$layout->set_form(

    '
            <form id="contact-form" method="post" enctype="multipart/form-data">
            <div class="formLayout">
            <fieldset>

                           <label>Cédula (*)</label>
                            <input type="text" name="cedula" id="cedula" >

<br/>

                         <label>Nacionalidad</label>
                       <select id="nacionalidad" name="nacionalidad">
				<option value="V">Venezolano</option>
				<option value="E">Extranjero</option>
			</select>
                        <br/>

             <label>Becado</label>
              <select id="becado" name="becado">
             <option value="1">Sí</option>
             <option value="0">No</option>
         </select>

         <br/>

         <label>Ficha</label>
         <input type="text" name="ficha" id="ficha" size="20">

         <br/>

         <label>Sexo</label>

         <select id="genero" name="sexo">
				<option value="M">Masculino</option>
				<option value="F">Femenino</option>
			</select>

			<br/>



			<label>Fec. de Ingr.(*)</label>
			<input type="text" id="datepicker1" name="fechaingreso">
			<br/>

            <label>Primer Nombre(*)</label>
			<input type="text" name="primernombre" id="primernombre" >
			<br/>

			<label>Segundo Nombre(*)</label>
			<input type="text" name="segundonombre" id="segundonombre" size="20">

			<br/>

			            <label>Primer Apellido(*)</label>
			<input type="text" name="primerapellido" id="primerapellido" size="20">

			<br/>


			<label>Segundo Apellido(*)</label>
			<input type="text" name="segundoapellido" id="segundoapellido" size="20">

			<br/>

			<label>Fec. de Egreso</label>
			<input type="text" id="datepicker2" name="fechaegreso">

			<br/>



			<label>Cargo</label>

			'.$cargos.'

			<br/>

			<label >Departamento</label>

			<select name="departamento" >

			'.$gerencia.'

			 </select>

			 <br/>

			 <label>Estatus</label>
			 <select id="estatus" name="estatus">
				<option value="1">Activo</option>
				<option value="0">Inactivo</option>
			</select>
			<br/>

			<label>Fecha de Nacimiento(*)</label>
			<input type="text" id="datepicker3" name="fechanacimiento">

			<br/>

			<label>Condición</label>

			<select id="condicion" name="condicion">
				<option value="N">Normal</option>
				<option value="J">Jubilad@s</option>
                                <option value="D">Discapacitad@s</option>
			</select>

			<br/>

			<label>Telefono</label>
			<input type="text" name="telefono" id="telefono" size="20">
			<br/>

			<label>Tipo de Trabajador</label>

			 <select id="tipo_trabajador" name="tipo_trabajador">
                 <option value="EMP">Empleado</option>
                 <option value="OBR">Obrero</option>

             </select>

             <br/>

             <label>Celular</label>
             <input type="text" name="celular" id="celular" size="20">

             <br/>

             <label>Estado Civil</label>
             <select id="estadocivil" name="estadocivil">
                                <option value="0">--------</option>
				<option value="C">Casado(a)</option>
				<option value="S">Soltero(a)</option>
				<option value="D">Divorciado(a)</option>
				<option value="V">Viudo(a)</option>
				<option value="O">Concubino(a)</option>
			</select>

			<br/>


			<label>Perioricidad</label>

			<select id="perioricidad" name="codigoperioricidad">
				<option value="0">---------</option>
				<option value="H">Horaria</option>
				<option value="S">Semanal</option>
                <option value="Q">Quincenal</option>
                <option value="M">Mensual</option>
			</select>
			<br/>

			<label>Dirección de Habitación</label>
			<input type="text" name="direccion" id="direccion" size="15">
			<br/>

			 <label >Vehiculo</label>
			 <select name="vehiculo" id="">
                    <option value="si" >si</option>
                    <option value="no" selected>no</option>
                </select>
             <br/>

              <label>Foto de Empleado </label>
               <input type="file" name="imagen" >

              <br/>


<br/>
<br/>
     <input type="submit" name="submit" value="Guardar datos" >
      <a href="empleados_ver.php"><input type="button" value="Ver datos"></a>
        <a href="mrh_menu.php"><input type="button" value="Atras"></a>
                                </div>

                                </fieldset>
                            </form>


    '




);

$layout->get_footer();
