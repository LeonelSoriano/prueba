<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 11:01 AM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


$cedulaempleado ="";
$nombre="";
$apellido="";

require_once('./clases/funciones.php');

include_once('./clases/LayoutForm.php');

include("db.php");
//$cedulaempleado =$_REQUEST['cedulaempleado'];

if (isset($_POST['submit']))
{
    header("Content-Type: text/html;charset=utf-8");
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
    include('./clases/funciones.php');
    include('./clases/Validate.php');
    require_once('./min/until/SubirFoto.php');


    include 'db.php';

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
        ),

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
        $direccionhabitacion=$_POST['direccionhabitacion'];

        $nacionalidad = $_POST['nacionalidad'];

        $departamento=$_POST['departamento'];

        $vehiculo = $_POST['vehiculo'];

        $tipo_trabajador = $_POST['tipo_trabajador'];



        /*iMAGEN*/
        $imagen = $_POST['imagen'];





//        $subirFoto = new SubirFoto($_FILES['imagen'],'./img_empleados/');
//        $subirFoto->cargarFoto();
//        $imagen = $subirFoto->getNombreSubir();


        $id = $_POST['id'];


        $sql = '';
        if($imagen == ''  ){
            $sql = "UPDATE mrh_empleado SET  cedula='$cedula',
            ficha='$ficha',primernombre='$primernombre',segundonombre='$segundonombre',
            primerapellido='$primerapellido',segundoapellido='$segundoapellido',
            fechanacimiento='$fechanacimiento',telefono='$telefono',celular='$celular',
             estadocivil='$estadocivil',becado='$becado',sexo='$sexo',fechaingreso='$fechaingreso',
             fechaegreso='$fechaegreso',codigocargo='$codigocargo',estatus='$estatus',
             condicion='$condicion',codigoperioricidad='$codigoperioricidad',direccionhabitacion='$direccionhabitacion',
             codigo_departamento='$departamento',vehiculo='$vehiculo',nacionalidad='$nacionalidad',tipo_trabajador='$tipo_trabajador'
             WHERE codigo='$id'";
        }else{

            $subirFoto = new SubirFoto($_FILES['imagen'],'./img_empleados/');
            $subirFoto->cargarFoto();
            $imagen = $subirFoto->getNombreSubir();


            $sql = "UPDATE mrh_empleado SET  cedula='$cedula',
            ficha='$ficha',primernombre='$primernombre',segundonombre='$segundonombre',
            primerapellido='$primerapellido',segundoapellido='$segundoapellido',
            fechanacimiento='$fechanacimiento',telefono='$telefono',celular='$celular',
             estadocivil='$estadocivil',becado='$becado',sexo='$sexo',fechaingreso='$fechaingreso',
             fechaegreso='$fechaegreso',codigocargo='$codigocargo',estatus='$estatus',
             condicion='$condicion',codigoperioricidad='$codigoperioricidad',direccionhabitacion='$direccionhabitacion',
             codigo_departamento='$departamento',vehiculo='$vehiculo',nacionalidad='$nacionalidad',tipo_trabajador='$tipo_trabajador',foto='$imagen'
             WHERE codigo='$id'";
        }




        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');

        die;
    }else if($validated->getIsError()){

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;

    }




}



$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mrh_empleado WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$cedula=$test['cedula'];
$ficha=$test['ficha'];
$primernombre=$test['primernombre'];
$segundonombre=$test['segundonombre'];
$primerapellido=$test['primerapellido'];
$segundoapellido=$test['segundoapellido'];
$fechanacimiento=$test['fechanacimiento'];
$telefono=$test['telefono'];
$celular=$test['celular'];
$estadocivil=$test['estadocivil'];
$becado=$test['becado'];
$sexo=$test['sexo'];
$fechaingreso=$test['fechaingreso'];
$fechaegreso=$test['fechaegreso'];
$codigocargo=$test['codigocargo'];
$estatus=$test['estatus'];
$condicion=$test['condicion'];
$codigoperioricidad=$test['codigoperioricidad'];
$direccionhabitacion=$test['direccionhabitacion'];
$departamento = $test['codigo_departamento'];
$vehiculo = $test['vehiculo'];
$nacionalidad = $test['nacionalidad'];
$tipo_trabajador = $test['tipo_trabajador'];



$layout = new LayoutForm('Módulo de Recursos Humanos | Empleado Modificar','.');

$layout->append_to_header('
  <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: "yy-mm-dd",changeYear: true, yearRange: "-100:+0"});
        $( "#datepicker2" ).datepicker({ dateFormat: "yy-mm-dd",changeYear: true, yearRange: "-100:+0"  });
        $( "#datepicker3" ).datepicker({ dateFormat: "yy-mm-dd",changeYear: true, yearRange: "-100:+0" });
    });
</script>

 ');


$nacionalidad_form = '';
if($nacionalidad == 'E'){$nacionalidad_form ='selected';}

$becado_from = '';
if($becado == '0'){$becado_from = 'selected';}

$sexo_from = "";
if($sexo == 'F'){$sexo_from  = 'selected';};


$layout->get_header();


$consulta_mysql='select * from mrh_cargo';
$resultado_consulta_mysql=mysql_query($consulta_mysql);





$cargo_form = '';

while($fila=mysql_fetch_array($resultado_consulta_mysql)){
    if($fila['codigo'] == $codigocargo){

        $cargo_form .= "<option value='".$fila['codigo']."'selected>".utf8_multiplataforma( $fila['descripcion'])."</option>";
    }else{
        $cargo_form .= "<option value='".$fila['codigo']."'>".utf8_multiplataforma( $fila['descripcion'])."</option>";
    }
}


$gerencia_form = '';
$sql = "SELECT mno_gerencia.codigo,mno_gerencia.descripcion FROM mno_gerencia";
$test = mysql_query($sql);

while($fila=mysql_fetch_array($test)){
    if($departamento == $fila['codigo']){
       $gerencia_form .= "<option value='".utf8_multiplataforma($fila['codigo'])."'selected>".$fila['descripcion']."</option>";
    }else{
        $gerencia_form .= "<option value='".utf8_multiplataforma($fila['codigo'])."'>".$fila['descripcion']."</option>";

    }
}


$estatus_from = '';

if($estatus == '0'){$estatus_from = 'selected';}



$condicion_N = '';
$condicion_J = '';
$condicion_D = '';

if($condicion == "N"){$condicion_N = 'selected';}
if($condicion == "J"){$condicion_J = 'selected';}
if($condicion == "D"){$condicion_D = 'selected';}


$tipo_trabajador_obr = '';
$tipo_trabajador_emp = '';

if($tipo_trabajador == 'OBR'){$tipo_trabajador_obr = 'selected';}
if($tipo_trabajador == 'EMP'){$tipo_trabajador_emp = 'selected';}

$estadocivil_c = '';
$estadocivil_s = '';
$estadocivil_d = '';
$estadocivil_v = '';
if($estadocivil == 'C'){$estadocivil_c = 'selected';}
if($estadocivil == 'S'){$estadocivil_s = 'selected';}
if($estadocivil == 'D'){$estadocivil_d = 'selected';}
if($estadocivil == 'V'){$estadocivil_v = 'selected';}

$codigoperioricidad_o = "";
$codigoperioricidad_h = '';
$codigoperioricidad_s = '';
$codigoperioricidad_q = '';
$codigoperioricidad_m = '';

if($codigoperioricidad == '0'){$codigoperioricidad_o = 'selected';}
if($codigoperioricidad == 'H'){$codigoperioricidad_h = 'selected';}
if($codigoperioricidad == 'S'){$codigoperioricidad_s = 'selected';}
if($codigoperioricidad == 'Q'){$codigoperioricidad_q = 'selected';}
if($codigoperioricidad == 'M'){$codigoperioricidad_m = 'selected';}


$vehiculo_si = '';
$vehiculo_no = '';

if($vehiculo == 'si'){  $vehiculo_si = 'selected'; }
if($vehiculo == 'no'){  $vehiculo_no = 'selected'; }


$layout->set_form('

   <form id="contact-form" method="post" enctype="multipart/form-data">
                                <div class="formLayout">
                                <fieldset>
<label>Cédula</label>

<input type="text" name="cedula" id="cedula" size="20" value="'.$cedula.'">

<br/>
    <label>Nacionalidad</label>
     <select id="nacionalidad" name="nacionalidad">
                  <option value="V">Venezolano</option>
                 <option value="E" '.$nacionalidad_form.' >Extranjero</option>
             </select>

<br/>
    <label>Becado</label>
 <select id="becado" name="becado" value="<?php echo $becado?>">
                 <option value="1">Sí</option>
                 <option value="0" '.$becado_from.' >No</option>
             </select>
<br/>

<label>Ficha</label>
<input type="text" name="ficha" id="ficha" size="20" value="'.$ficha.'">

<br>

<label>Sexo</label>

<select id="genero" name="sexo" >
    <option value="M">Masculino</option>
    <option value="F" '.$sexo_from.'>Femenino</option>
</select>

<br/>

<label>Primer Nombre</label>
<input type="text" name="primernombre" id="primernombre" size="20" value="'.$primernombre.'">
<br/>

<label>Fecha de Ingreso</label>
<input type="text" id="datepicker1" name="fechaingreso" value="'.$fechaingreso.'">
<br/>

<label>Segundo Nombre</label>
<input type="text" name="segundonombre" id="segundonombre" size="20" value="'.$segundonombre.'">
<br/>

<label>Fecha de Egreso</label>
<input type="text" id="datepicker2" name="fechaegreso" value="'.$fechaegreso.'">
<br/>


<label>Primer Apellido</label>
<input type="text" name="primerapellido" id="primerapellido" size="20" value="'.$primerapellido.'">
<br/>


<label>Cargo</label>

<select name="codigocargo" id="mes" >

'.$cargo_form.'

</select>
<br/>

<label >Departamento</label>

 <select name="departamento" >
'.$gerencia_form.'
 </select>
 <br/>

 <label>Segundo Apellido</label>
 <input type="text" name="segundoapellido" id="segundoapellido" size="20" value="'.$segundoapellido.'">
<br/>

<label>Estatus</label>
<select id="estatus" name="estatus" ">
<option value="1">Activo</option>
				<option value="0" '.$estatus_from.' >Inactivo</option>
			</select>
<br/>


<label>Fecha de Nacimiento</label>
<input type="text" id="datepicker3" name="fechanacimiento" value="'.$fechanacimiento.'">
<br/>

<TD><label>Condición</label></TD>
<select id="condicion" name="condicion" ">

<option value="N" '.$condicion_N.'>Normal</option>
				<option value="J" '.$condicion_J.'>Jubilad@s</option>
                <option value="D" '.$condicion_D.'>Discapacitad@s</option>
			</select>
<br/>
<TD><label>Telefono</label>
<input type="text" name="telefono" id="telefono" size="20" value="'.$telefono.'">
<br/>


<label>Tipo de Trabajador</label>

<select id="tipo_trabajador" name="tipo_trabajador" >
 <option value="OBR" '.$tipo_trabajador_obr.'>Obrero</option>
 <option value="EMP" '.$tipo_trabajador_emp.'>Empleado</option>
 </select>

 <br/>

 <label>Celular</label>

 <input type="text" name="celular" id="celular" size="20" value="'.$celular.'">
<br/>

<label>Estado Civil</label>

<select id="estadocivil" name="estadocivil" >
	<option value="C"  '.$estadocivil_c.'>Casado(a)</option>
    <option value="S" '.$estadocivil_c.'>Soltero(a)</option>
    <option value="D" '.$estadocivil_d.'>Divorciado(a)</option>
    <option value="V" '.$estadocivil_v.' >Viudo(a)</option>
</select>
<br>

<label>Perioricidad</label>

<select id="perioricidad" name="codigoperioricidad" ">
				<option value="0" '.$codigoperioricidad_o.'>---------</option>
				<option value="H" '.$codigoperioricidad_h.'>Horaria</option>
				<option value="S" '.$codigoperioricidad_h.'>Semanal</option>
                <option value="Q" '.$codigoperioricidad_q.'>Quincenal</option>
                <option value="M" '.$codigoperioricidad_m.'>Mensual</option>

</select>

<br/>
<label>Dirección de Habitación</label>
<input type="text" name="direccionhabitacion" id="direccion" size="40" value="'.$direccionhabitacion.'">
<br/>

<label >Vehiculo</label>
<select name="vehiculo" id="">
     <option value="si" '.$vehiculo_si.'>si</option>
     <option value="no" '.$vehiculo_no.'>no</option>
 </select>

 <br/>

 <label>Foto de Empleado </label>
 <input type="file" name="imagen" >

 <br/>

  <input type="hidden" value="'.$id.'" name="id"/>

 <input type="submit" name="submit" value="Guardar datos" >
  <a href="empleados_ver.php"><input type="button" value="Atras"></a>

   </fieldset>
   </div>
   </form>

');

$layout->get_footer();