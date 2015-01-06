<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 03/12/14
 * Time: 12:14 PM
 */



class Seguridad {



    private $_db = null;
    private $token_session;


    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;


    private $nombre_usuario;



    private function  generarPalabraAleatoria()
    {
        $cadena = substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);

        return $cadena;

    }


    public function  __construct(){

        include_once("funciones.php");

        $ini_array = parse_ini_file("conf.ini");


        $this->db_host = $ini_array['db_host'];
        $this->db_name = $ini_array['db_name'];
        $this->db_user = $ini_array['db_user'];
        $this->db_pass = $ini_array['db_pass'];



        try {
            $dsn = "mysql:host=$this->db_host;dbname=$this->db_name";
            $this->_db = new PDO($dsn, $this->db_user, $this->db_pass);


//            $sql = "SELECT * FROM mrh_cargo";
//
//            $query = $this->_db->prepare($sql);
//            $query->execute(array('%son'));
//            $query->setFetchMode(PDO::FETCH_ASSOC);
//
//
//            while ($respuesta = $query->fetch()) {
//            //    echo sprintf('%s <br/>', $respuesta['codigoalias']);
//            }


        }catch(PDOException $e)
        {
            echo $e->getMessage();
        }


    }


    public function  generar_sesion($nombre,$clave)
    {

        $sql = "SELECT count(*) as total FROM seg_usuario
WHERE seg_usuario.clave = '$clave'
AND seg_usuario.nombre = '$nombre'";


        $query = $this->_db->prepare($sql);
        $query->execute(array('%son'));
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $respuesta = $query->fetch();


        if($respuesta['total'] == 1){


            $fecha = new DateTime();
            $fecha_unix = $fecha->getTimestamp();


            $this->token_session = $this->generarPalabraAleatoria() .'-' . $fecha_unix;


//            session_set_cookie_params(0);


            session_start();

            session_set_cookie_params(0);
            ini_set('session.gc_max_lifetime', 0);
            ini_set('session.gc_probability', 1);
            ini_set('session.gc_divisor', 1);


            $_SESSION["token"] = $this->token_session .'-' . $fecha_unix;
            $_SESSION["usuario"] = $nombre;
            $_SESSION['tiempo']=time();


            $sql2 = "UPDATE seg_usuario
SET
token_actual = '$this->token_session'
WHERE seg_usuario.nombre = '$nombre'
AND seg_usuario.clave = '$clave'
";

            $query2 = $this->_db->prepare($sql2);
            $query2->execute(array('%son'));


            $url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . '/sicap/seleccion_sicap.php';

            header('Location: ' .$url);

        }else{

            redireccion_anterior_error(true,"hola");
        }



    }


    public function  terminar_seccion()
    {
        session_unset();

        if ( isset( $_COOKIE[session_name()] ) )
            setcookie( session_name(), "", time()-3600, "/" );

        $_SESSION = array();
        session_destroy();




        var_dump($_SESSION);

    }

    public function chekear_session()
    {
       // session_set_cookie_params(1);

        session_start();


        if(isset( $_SESSION['usuario'])){


            $usuario = $_SESSION["usuario"];

            $sql = "SELECT * FROM seg_usuario WHERE nombre='$usuario'";

            $query = $this->_db->prepare($sql);
            $query->execute(array('%son'));
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $respuesta = $query->fetch();


            $token_actual = $respuesta['token_actual'];


            if(!strcmp($token_actual,$_SESSION["token"])){

                $url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . '/sicap/';
                header('Location: ' .$url);
            }


        }else{
            $url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . '/sicap/';
            header('Location: ' .$url);
        }



    }




    public function __destruct()
    {
        $this->_db = null;
    }



}