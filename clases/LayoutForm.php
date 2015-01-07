<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 04:22 AM
 */


class LayoutForm
{

    private $title;
    private $append_to_header;
    private $pre_pend_path;


    public function __construct($title,$pre_pend = '../..')
    {
        $this->title = $title;
        $this->append_to_header = '';
        $this->pre_pend_path = $pre_pend;

    }

    public function  errores(){

        $error = '';

        if(isset($_GET['msg'])){
            $error =  $_GET['error'];

            $msg = $_GET['msg'];

            if($error == 'true'){
                $error = '<div id="error_app"><marquee scrolldelay="100">'.$msg.'</marquee></div></br>';
            }else if($error == 'false'){
                $error = '<div id="done_app"><marquee scrolldelay="100">'.$msg.'</marquee></div> </br>';

            }

        }
        return $error;
    }


    public function append_to_header($append)
    {
        $this->append_to_header .= $append;
    }

    public function get_header()
    {

        $header = '<!DOCTYPE html>
<html lang="es" >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="'.$this->pre_pend_path.'/css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="'.$this->pre_pend_path.'/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="'.$this->pre_pend_path.'/css/style_new.css" type="text/css" media="screen">
    <link rel="stylesheet" href="'.$this->pre_pend_path.'/css/zerogrid.css" type="text/css" media="all">
    <link rel="stylesheet" href="'.$this->pre_pend_path.'/css/responsive.css" type="text/css" media="all">
    <link rel="stylesheet" href="'.$this->pre_pend_path.'/css/responsive_form.css" type="text/css" media="all">

    <script src="'.$this->pre_pend_path.'/js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="'.$this->pre_pend_path.'/js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="'.$this->pre_pend_path.'/css/htmlDatePicker.css" rel="stylesheet">
    <script type="text/javascript" src="'.$this->pre_pend_path.'/js/css3-mediaqueries.js"></script>
<script src="'.$this->pre_pend_path.'/js/jquery-1.10.2.js"></script>
 <script src="'.$this->pre_pend_path.'/js/jquery-ui-1.10.4.custom.js"></script>
    <script type="text/javascript" src="'.$this->pre_pend_path.'/js/html5.js"></script>
    <link href="'.$this->pre_pend_path.'/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
'.$this->append_to_header .'
</head>
<body id="page5" class="bg"     >
<div  style="margin-top: 110px">
    <!-- header -->
    <header >
        <div class="menu-row">
            <div class="main">
                <div class="zerogrid">
                    <div class="row" >

                        <h1  id="header_nombre" style="margin-bottom: 10px">

                            <div   style=" display: table-cell;
vertical-align: middle;line-height: 120px;font-size: 35px;">
                               <a href="'.$this->pre_pend_path.'/seleccion_sicap.php" style="text-decoration: none">    <img src="'.$this->pre_pend_path.'/images/index.png"  style="vertical-align: top;max-height: 130px;"/> </a>
                                 <a href="'.$this->pre_pend_path.'/seleccion_sicap.php" style="text-decoration: none">    <img src="'.$this->pre_pend_path.'/images/index2.png"  style="float:right;max-height: 130px;"/> </a>

                                 '.$this->title.'
                            </div> </h1>

                        </div>
                </div>
            </div>
        </div>
    </header>

    <!-- content -->
    <section id="content" style="min-height: 280px">
        <div class="main">
            <div class="zerogrid">
                <div class="row">
                    <article class="col-2-3"><div class="wrap-col">

                    '.$this->errores().'

                    ';


        echo($header);
    }

    public function get_footer(){

        $footer = '</div></article>

                </div>
            </div>
        </div>
    </section>


<!-- footer -->
<footer    style="
    left: 0;
    bottom: 0;

    width: 100%;
    Height: 180px" >
    <div class="main">
        <div class="zerogrid" id="mi_footer">


            <div class="zerogrid">
                <div class="row" id="mi-footer">
                    <article class="col-1-2"><div class="wrap-col">

                        <p class="indent-bot">
                            <span class="letra-verde"> Gupo SICAP</span> Barquisimeto Estado Lara 2014 <br/>
                            Avenida Vargas Esquina Carera 24 Cámara de comercio segundo piso oficina numero 4

                    </div></article>
                    <article class="col-1-2"><div class="wrap-col">
                        <div class="indent-left3">

                            <p class="indent-bot"> Teléfonos: (0251)233 3367 <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;(0412)641 5861</p>


                        </div>
                    </div></article>

                </div>
            </div>


        </div>
    </div>
</footer>
</div>
</body>
</html>';



        echo($footer);

    }


    public function set_form($contenido){
        echo($contenido);
    }
}