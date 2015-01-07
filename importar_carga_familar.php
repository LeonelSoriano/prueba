<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 01:17 PM
 */



include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');

require_once('./db.php');


if(isset($_POST['submit'])){

    //

    //$target_dir = "uploads/";
    //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file =  basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

//        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//        if($check !== false) {
//            echo "File is an image - " . $check["mime"] . ".";
//            $uploadOk = 1;
//        } else {
//            echo "File is not an image.";
//            $uploadOk = 0;
//        }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
//    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//        && $imageFileType != "gif" ) {
//        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//        $uploadOk = 0;
//    }
// Check if $uploadOk is set to 0 by an error


    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], 'import_'. $target_file)) {

            // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


            $tmp_file = 'import_'. $target_file;
            include_once('importar_empleado_exxel.php');


        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (file_exists('import_'. $target_file)) {
        unlink('import_'. $target_file);
    }


    //  mysql_close($conn);
}

$layout = new LayoutForm('Módulo de Recursos Humanos | Carga Familiar','.');


$layout->get_header();


$layout->set_form(

    '
            <form id="contact-form" method="post" enctype="multipart/form-data">
            <div class="formLayout">
            <fieldset>

<label>Importar</label>
 <input type="file" name="fileToUpload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
 <br/>


 <input type="submit" value="Importar Datos" name="submit" >
 <a href="./mrh_menu.php"><input type="button" value="Atras"></a>


             </div>
            </fieldset>
        </form>


    '



);

$layout->get_footer();
