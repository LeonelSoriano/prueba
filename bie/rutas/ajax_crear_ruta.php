<?php



if(isset($_POST['origen_codigo_google']) &&
    isset($_POST['origen_estado']) &&
    isset($_POST['origen_ciudad']) &&
    isset($_POST['distancia']) &&
    isset($_POST['origen_latitud'])){

    require_once('../../db.php');
    require_once('../../clases/Validate.php');


    $validation = array(

        array('nombre' => 'origen_codigo_google',
            'requerida' => true,
        ),

        array('nombre' => 'origen_estado',
            'requerida' => true,
        ),

        array('nombre' => 'origen_ciudad',
            'requerida' => true,
        ),

        array('nombre' => 'distancia',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => '.',
        ),

        array('nombre' => 'distancia',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => '.',
        ),

        array('nombre' => 'origen_latitud',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => '.',
        ),
        array('nombre' => 'origen_longitud',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => '.',
        ),
        array('nombre' => 'llegada_codigo_google',
            'requerida' => true,
        ),
        array('nombre' => 'llegada_estado',
            'requerida' => true,
        ),
        array('nombre' => 'llegada_ciudad',
            'requerida' => true,
        ),
        array('nombre' => 'llegada_latitud',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => '.',
        ),
        array('nombre' => 'llegada_longitud',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => '.',
        ),

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $origen_codigo_google = $_POST['origen_codigo_google'];
        $origen_estado = $_POST['origen_estado'];
        $origen_ciudad = $_POST['origen_ciudad'];
        $origen_zona = $_POST['origen_zona'];
        $distancia = $_POST['distancia'];
        $origen_latitud = $_POST['origen_latitud'];
        $origen_longitud = $_POST['origen_longitud'];
        $llegada_codigo_google = $_POST['llegada_codigo_google'];
        $llegada_estado = $_POST['llegada_estado'];
        $llegada_ciudad = $_POST['llegada_ciudad'];
        $llegada_zona = $_POST['llegada_zona'];
        $llegada_latitud = $_POST['llegada_latitud'];
        $llegada_longitud = $_POST['llegada_longitud'];


        $sql = "INSERT INTO bie_rutas(origen_codigo_google,origen_estado,origen_ciudad,
                origen_zona,distancia,origen_latitud,origen_longitud,llegada_codigo_google,
                llegada_estado,llegada_ciudad,llegada_zona,llegada_latitud,llegada_longitud)
                VALUES
                ('$origen_codigo_google','$origen_estado','$origen_ciudad',
                '$origen_zona','$distancia','$origen_latitud','$origen_longitud',
                '$llegada_codigo_google','$llegada_estado','$llegada_ciudad','$llegada_zona',
                '$llegada_latitud','$llegada_longitud')";

        mysql_query($sql) or die('error agregar bie_asignaciones  '.mysql_error());

        echo("true");

    }else{
        echo("false");
    }

}
