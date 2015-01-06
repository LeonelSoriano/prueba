<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/08/14
 * Time: 08:47 AM
 */

/**
 * Esta clase realiza operaciones para los layout headder footer
 *
 * @author Leonel Soriano <leonelsoriano3@gmail.com>
 * @copyright 2014
 *
 */

class Layout
{

    private $_str_header;

    private $_str_header_close;

    private $_str_footer;


    private $_add_header;

    public function __construct()
    {

        $this->_str_header = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
        <title>SICAP | Sistema Integral de Costos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
        <link href="../../css/htmlDatePicker.css" rel="stylesheet">
        <!-- Beginning of compulsory code below -->
        <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
        ';



        $this->_str_header_close = '<!-- Beginning of compulsory code below --></head>';




    }



    public function  get_header()
    {

    }


    /** @param string tipo que se agregara= css,js,script,link


     * si es css el segundo parametro es el css
     * si es js el segundo parametro es el js
     * si es script el segundo parametro es la direccion al script
     * si es link el segundo parametro es el link a el css

     */
    public function add($tipo)
    {

        if($tipo == "css"){

            //$this->_str_header =
        }elseif($tipo == "js"){

        }elseif($tipo == "script"){

        }elseif($tipo == "link"){

        }

    }


    public function get_footer()
    {

    }
} 