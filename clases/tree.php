<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 28/12/14
 * Time: 01:52 AM
 */

class Tree
{
    private $_dbh;
    private $_elements = array();


    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;


    private $val_macth = array();

    public function __construct()
    {


        $ini_array = parse_ini_file("conf.ini");


        $this->db_host = $ini_array['db_host'];
        $this->db_name = $ini_array['db_name'];
        $this->db_user = $ini_array['db_user'];
        $this->db_pass = $ini_array['db_pass'];


        try{
            $this->_dbh = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
            $this->_dbh->exec("SET CHARACTER SET utf8");
            $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (PDOException $e)
        {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public function get()
    {
        $query = $this->_dbh->prepare("SELECT * FROM mno_gerencia ");
        $query->execute();
        $this->_elements["masters"] = $this->_elements["childrens"] = array();

        if($query->rowCount() > 0)
        {
            foreach($query->fetchAll() as $element)
            {
                if($element["codigo_depende"] == 0)
                {
                    array_push($this->_elements["masters"], $element);
                }
                else
                {
                    array_push($this->_elements["childrens"], $element);
                }
            }
        }
        return $this->_elements;
    }

    public static function nested($rows = array(), $parent_id = 7)
    {
        $html = "";
        if(!empty($rows))
        {

            foreach($rows as $row)
            {
                if($row["codigo_depende"] == $parent_id)
                {

                    $html.="<span><i class='glyphicon glyphicon-folder-open'></i></span>";
//                    $html.="<a href='#' data-status='{$row["have_childrens"]}' style='margin: 5px 6px' class='btn btn-warning btn-xs btn-folder'>";
                    if(true)
                    {
                        $html.="<span class='glyphicon glyphicon-minus-sign'></span>".$row['descripcion']."</a>";
                    }
                    else
                    {
                        $html.="<span class='glyphicon glyphicon-plus-sign'></span>".$row['descripcion']."</a>";
                    }
                    $html.=self::nested($rows, $row["codigo"]);

                }
            }

        }
        return $html;
    }


    public function get_depende($rows = array(),$codigo)
    {

        array_push($this->val_macth,$codigo);

        $nombres = array();
        $valores = array();

        if(!empty($rows))
        {
            foreach($rows as $row){
                if (in_array($row['codigo'],$this->val_macth)) {
                    array_push($nombres,array($row['descripcion']
                    ,$row['codigo']
                    ,$row['profundidad'],
                        $row['etapa']));
                }
            }



            foreach($rows as $row){


                if (in_array($row['codigo_depende'], $this->val_macth)) {
                    array_push($this->val_macth,$row['codigo']);
                    array_push($nombres,array($row['descripcion']
                                        ,$row['codigo']
                                        ,$row['profundidad'],
                                        $row['etapa']));
                }





            }


        }

        return $nombres;
    }
}