<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 28/10/14
 * Time: 11:07 AM
 */

class Paginador {


    private $_name_table;

    private $MAX;

    private $_paso;

    private $_paso_actual;

    private $_post_sql;


    public function  __construct($name_table,$paso_actual,$post_sql = ''){
        //include_once("../db.php");
        $this->_post_sql = $post_sql;
        $this->_name_table = $name_table;
        $this->_paso = 50;
        $this->_paso_actual = $paso_actual;
        $this->MAX =  $this->get_max();




    }

    public function   print_sql_limit(){

        $paso =  $_GET['paso'];
//        $paso


        return "LIMIT ". $paso * $this->_paso ."," .
        (($paso * $this->_paso) + $this->_paso) ;
    }


    public function print_sql_foot(){


        $salida = '';

        $paso =  $_GET['paso'];

        $paso_anterior = 0;

        $indice = 1;

        if($paso - 1 < 0) {
            $paso_anterior = 0;
        }else{
            $paso_anterior = $paso - 1;
        }

        $paso_maximo = ceil($this->MAX/$this->_paso);


        $paso_siguiente = 0;

        if($paso > $paso_maximo-2) {

            $paso_siguiente = $paso_maximo-1;
        }else{
            $paso_siguiente = $paso +1;
        }



        $salida .= '  <a href="'.$this->get_actual_page().'?paso='.($paso_anterior).'" style="font-size: 1.3em;margin-right: 20px;a:text-decoration:none, a:hover"> atras</a>';

        for($i = $paso -3 ; $i < $paso + 4; $i++){
            if($i <= $paso_maximo && $i > 0 ){

                if($i-1 == $paso){
                    $salida .= ' <a href="'.$this->get_actual_page().'?paso='.($i-1).'" style="font-size: 1.5em;margin-right: 10px;color:#3C4668;"> '.$i.'</a>';

                }else{
                    $salida .= ' <a href="'.$this->get_actual_page().'?paso='.($i-1).'" style="font-size: 1.3em;margin-right: 10px"> '.$i.'</a>';

                }
            }
        }

        $salida .= ' <a href="'.$this->get_actual_page().'?paso='.($paso_siguiente).'" style="font-size: 1.3em;margin-left: 10px"> Mas</a>';

        return $salida;
    }

    private function get_actual_page(){
        $pagina =explode("?", $_SERVER['REQUEST_URI'])[0];
        return ;
    }


    private function get_max(){



        $sql = "SELECT count(*) AS total from " . $this->_name_table . '  ' . $this->_post_sql  ;

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        return  $test['total'];
    }

}