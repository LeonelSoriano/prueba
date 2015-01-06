<?php

/**

 *
 * @package sicap
 * @author Leonel Soriano
 * @copyright GPL 3
 * @version 1.0
 * @access public
 */

class Validate
{


    /*
     *  opciones:
     *
     *
     *
     * */



    /**$validations = array(
    'bool' => 'orden_trabajo'

     * error -> salidad personalizada de error
     * nombre   -> nombre variable post     (obligatorio)
     * nombre_salida -> nombre que dara en la salida al campo
     * saneado (bool)-> dira se se tiene que sanear la variable o no
     * requerida (bool) -> dira si es requerido el campo
     * regla (opciones reglas) -> para saber que operacion de validacion realizar en ella
     *
     *
     * si has enviado como regla que es un numero puedes enviar max y min para ver si esta entre los valores
     *
    );*/


    /**  reglas
     *
     *  letter -> si solo contiene letras
     *
     *   bool -> comprueba si es bool
     *
     *   number -> comprueba si es numero(que sea entero)
     *
     *   email -> valida email
     *
     *   float -> valida coma flotante   tipo(para lo literales las ociones son) (, .) defaul (,)  ambas (*)
     *
     *   ip -> valida ip   tipo ipv4 ipv6   default ipv4
     *
     *   url -> valida direccion web
     *
     *   youtobe -> valida que sea un video de youtobe
     *
     *   clave_segura -> De esta forma comprobaremos:
     *          Contraseñas que contengan al menos una letra mayúscula.
     *          Contraseñas que contengan al menos una letra minúscula.
     *          Contraseñas que contengan al menos un número o caracter especial.
     *          Contraseñas cuya longitud sea como mínimo 8 caracteres.
     *          Contraseñas cuya longitud máxima no debe ser arbitrariamente limitada.
     *
     *   tel -> telefono
     *
     *   tarjeta -> tejeta de credito
     *
     *   codigo_postal -> codigo postal
     *
     *   clave_segura -> una clave segura
     *
     *   cedula_identidad -> cedula
     *
     *   celular_ve -> celular venezuela
     *
     *   fecha -> validar fecha del tipo que se esta utlizando en sicap
     *
     *   range -> valida si unj numero esta dentor de dos rangos ejemplo de uso  range,1,10  donde el minimo debe ser priemro y el mayor segundo
     *
     */



    //regñas de validacion
    private $_validations;
    //el post o get
    private $_datos;

    //array de los errores
    private $_errors;


    private $_sanados;


    //mensaje estandar para el error
    private $_msg_error;


    //para recordar que hubo error
    private $is_error;






    private $_regex = array(

        'url' => "#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie",

        'youtube' => '~
    ^(?:https?://)?              # Optional protocol
     (?:www\.)?                  # Optional subdomain
     (?:youtube\.com|youtu\.be)  # Mandatory domain name
     /watch\?v=([^&]+)           # URI with video id as capture group 1
     ~x',

        'tel' => '(^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$)',

        'tarjeta' => '(^((67\d{2})|(4\d{3})|(5[1-5]\d{2})|(6011))(-?\s?\d{4}){3}|(3[4,7])\ d{2}-?\s?\d{6}-?\s?\d{5}$)',

        'codigo_postal' => '(^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$)',

        'clave_segura' => '((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)',

        'cedula_identidad' => '(^([V|E|J|G|v|e|j|g])(-?)([0-9]{5,8})$)',

        'celular_ve' => '(^0[0-9]{3}-[0-9]{7}$)',

        'fecha' => '(^((((0[13578]|10|12)([-./])(0[1-9]|[12][0-9]|3[01])([-./])(\d{4}))|((0[469]|1­1)([-./])([0][1-9]|[12][0-9]|30)([-./])(\d{4}))|((2)([-./])(0[1-9]|1[0-9]|2­[0-8])([-./])(\d{4}))|((2)(\.|-|\/)(29)([-./])([02468][048]00))|((2)([-./])­(29)([-./])([13579][26]00))|((2)([-./])(29)([-./])([0-9][0-9][0][48]))|((2)­([-./])(29)([-./])([0-9][0-9][2468][048]))|((2)([-./])(29)([-./])([0-9][0-9­][13579][26]))))$)'

    );



    public function __construct($validations = array(),$datos)
    {


        if(!is_array($validations)){
            throw new Exception('Las validaciones deben ser array.');
        }



        if(!is_array($datos)){
            throw new Exception('Los datos deben ser array.');
        }

//TODO agregar q sea obligatorio el nombre
//        foreach(validations as $key=>$val){
//            if(!isset($validations['nombre'])){
//                throw new Exception('El campo name en validaciones es obligatorio.');
//            }
//        }
        $this->_validations = $validations;
        $this->_datos = $datos;


        $this->_errors = array();
        $this->_sanados = array();


        $this->_msg_error = "Verifique el Campo";


        $this->is_error =  false;



    }

    public function validate()
    {


        for($i=0;$i < count($this->_validations);$i++){

            if(array_key_exists($this->_validations[$i]['nombre'],$this->_datos)){

                $tmp_nombre = $this->_validations[$i]['nombre'];


                $saneado = false;
                if(isset($this->_validations[$i]['saneado'])){
                    $saneado  = $this->_validations[$i]['saneado'];
                }


                $requerida = false;
                if(isset($this->_validations[$i]['requerida'])){
                    $requerida  = $this->_validations[$i]['requerida'];
                }



                if(isset($this->_validations[$i]['error'])){
                    $this->_msg_error = $this->_validations[$i]['error'];
                }


                $tipo ='';
                if(isset($this->_validations[$i]['tipo'])){
                    $tipo = $this->_validations[$i]['tipo'];
                }


                $nombre_salida = $this->_validations[$i]['nombre'];
                if(isset($this->_validations[$i]['nombre_salida'])){
                    $nombre_salida = $this->_validations[$i]['nombre_salida'];
                }


                if(isset($this->_validations[$i]['regla'])){

                    $regla = $this->_validations[$i]['regla'];
                    self::do_reglas($this->_datos[$tmp_nombre],$saneado,$requerida,$regla,$tmp_nombre,$tipo,$nombre_salida);


                }else{

                    self::do_reglas($this->_datos[$tmp_nombre],$saneado,$requerida,'',$tmp_nombre,$tipo,$nombre_salida);

                }



            }

        }

    }


    private function do_reglas($campo,$saneado,$requerida,$regla,$tmp_nombre,$tipo,$nombre_salida)
    {

        if($requerida && strlen($campo) == 0){
            $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
            return;
        }

        if($requerida == false && strlen($campo) == 0){
            return;
        }

         $save_regla = $regla;

        if(substr($regla,0,5) == 'range'){ $regla = substr($regla,0,5); }

        switch($regla)
        {
            /* TODO bool tiene un bug de php que no marca bien los false* deajre el bool para cuando sepa como arrelarlo*/
            case "bool":
                if($saneado){
                    $campo =  filter_var($campo, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

                }else{

                }

                break;
            case "number":

                if($saneado){
                    $campo =filter_var($campo, FILTER_SANITIZE_NUMBER_INT);
                    $this->_sanados = array_merge($this->_sanados,array( $tmp_nombre =>$campo));
                }

                if(filter_var($campo, FILTER_VALIDATE_INT) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }

                break;


            case "email":
                if($saneado){
                    $campo =filter_var($campo, FILTER_SANITIZE_EMAIL);
                    $this->_sanados = array_merge($this->_sanados,array( $tmp_nombre =>$campo));

                }

                if(filter_var($campo, FILTER_VALIDATE_EMAIL) === false){

                    $this->pront_errorr($campo,$tmp_nombre,$regla,$nombre_salida);
                }

                break;


            case "float":

                if($saneado){

                    $campo =filter_var($campo, FILTER_SANITIZE_NUMBER_FLOAT);
                    $this->_sanados = array_merge($this->_sanados,array( $tmp_nombre =>$campo));

                }

                if($tipo == ',' || $tipo == ''){

                    $separador = array('options' => array('decimal' => ','));
                    if(filter_var($campo, FILTER_VALIDATE_FLOAT,$separador) === false){

                        $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                    }

                }else if($tipo == '.' ){
                    $separador = array('options' => array('decimal' => '.'));

                    if(filter_var($campo, FILTER_VALIDATE_FLOAT,$separador) === false){

                        $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                    }
                }

                break;

            case "ip":
                if($tipo == "ipv4" || $tipo == ""){
                    if(filter_var($campo, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false){

                        $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);

                    }

                }elseif($tipo == "ipv6"){
                    if(filter_var($campo,FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false){

                        $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                    }
                }
                break;

            case "url":

                $opcion = array("options" => array("regexp" => $this->_regex['url']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){



                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

            case "youtube":

                $opcion = array("options" => array("regexp" => $this->_regex['youtobe']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }

                break;

            case "tel":

                $opcion = array("options" => array("regexp" => $this->_regex['tel']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

            case "tarjeta":
                $opcion = array("options" => array("regexp" => $this->_regex['tarjeta']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;
            case "codigo_postal":

                $opcion = array("options" => array("regexp" => $this->_regex['codigo_postal']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

            case "clave_segura":

                $opcion = array("options" => array("regexp" => $this->_regex['clave_segura']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

            case "cedula_identidad":

                $opcion = array("options" => array("regexp" => $this->_regex['cedula_identidad']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

            case "celular_ve":

                $opcion = array("options" => array("regexp" => $this->_regex['celular_ve']));
                if(filter_var($campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

            case "fecha":
                $token_fecha = explode('-' ,$campo);

                $tpm_campo = $token_fecha[1] . '-' . $token_fecha[2] . '-' . $token_fecha[0];

                $opcion = array("options" => array("regexp" => $this->_regex['fecha']));
                if(filter_var($tpm_campo,FILTER_VALIDATE_REGEXP, $opcion) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

            case "range":

               $token_limites = explode(',' ,$save_regla);
                $min = $token_limites[1];
                $max = $token_limites[2];

                $options =array("options"=>array("min_range"=>$min, "max_range"=>$max));

                if(filter_var($campo,FILTER_VALIDATE_INT, $options) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;


            case "letter":

                $campo = str_replace(' ','',$campo);
                $campo = str_replace('Ñ','',$campo);
                $campo = str_replace('ñ','',$campo);
                if(ctype_alpha($campo) === false){

                    $this->pront_error($campo,$tmp_nombre,$regla,$nombre_salida);
                }
                break;

        }


    }


    private function  pront_error($campo,$tmp_nombre,$regla,$nombre_salida)
    {
        $this->_errors[$tmp_nombre]= (array(
            "campo" => $campo,
            "nombre_alias" => $tmp_nombre,
            "tipo" => $regla,
            "mensaje" => $this->_msg_error,
            "nombre_salida" => $nombre_salida
        ));

        $this->_errors["sdasd"]= (array(
            "campo" => $campo,
            "nombre_alias" => $tmp_nombre,
            "tipo" => $regla,
            "mensaje" => $this->_msg_error,
            "nombre_salida" => $nombre_salida
        ));



        $this->is_error = true;
    }

    public function get_msg_error()
    {



        //$error_salida = '';

  //      for($i=0;$i < count($this->_errors);$i++){
 //           $error_salida .= $this->_msg_error . ' ' .
//        }

  //          foreach ($this->_errors as $clave => $valor) {
   //         echo "Clave: $clave; Valor: $valor<br />\n";
    //    }
    }


    /**
     * @return boolean
     */
    public function getIsError()
    {
        return $this->is_error;
    }

}