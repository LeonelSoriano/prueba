<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 31/10/14
 * Time: 12:38 PM
 */





class  EtapaHorasClase
{


    public $_final_render_head;


    private $_data ;

    private $_semanas;


    private $_register;
    private $_hansontable;

    private $_array_information;


    private $_nombre_de_salario;


    private $_total_horas_trabajadas;
    private $_horas_turno;

    private $_pre_script;
    private $_post_script;


    private $_idjs;



    public function __construct()
    {

        // estas las utilizo con setter

        // -.-.--.-..-.-.-.-..-.--


        $this->_pre_script = '<script type="text/javascript">  $(function() '.'{';

        $this->_post_script = "});</script>";



        $this->_actual_index = 0;



        $this->_array_information = [];


        $this->_idjs =  '';

        //.-.-.-.--..-- para el arra de variables
        $this->_data = [];
        $this->_data[0] = ' var data = [
        ["Empleados", "He P/U:", "Ps P/H", "Cs P/U","Ht", "C/U h","CTP:",
            "Cantidad real por Unidad","Costo Real por Unidad","Horas","IE","Var C",
             "IP"] ';


        $this->_data[2] = '];';


        $this->_register = "   var grisRenderer = function (instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                $(td).css({
                    background: '#CCCCFF'
                });
            };

            var gris2Renderer = function (instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                $(td).css({
                    background: '#ABABEE',

                });
            };

            var totalRenderer = function (instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                $(td).css('font-weight','bold');
                $(td).css('background','#ABABEE');

            };

             var comentario = function (instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                $(td).css(  'width', '200');
                $(td).css('background','#ABABEE');

            };

            var amarilloRenderer = function (instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                $(td).css({
                    background: '#FFF744'
                });
            };";

        // colWidths: [100, 83, 83, 83,83,83,83,83,115,85,85,85,85],
        $this->_hansontable = [];

        $this->_hansontable[0] = " $('#handsontable". $this->_idjs ."').handsontable({
                data: data,

                readOnly: true,
                fillHandle: false,
                columnSorting: true,
                currentRowClassName: 'currentRow',
                currentColClassName: 'currentCol',


                cells: function (row, col, prop) {
                                 if (row === 0 && col === 1) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 0) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 2) {
                    this.renderer = gris2Renderer;
                }
                if (row === 10 && col === 20) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 3) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 4) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 5) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 6) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 7) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 8) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 9) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 10) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 11) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 12) {

                    this.renderer = comentario;
                }";

        $this->_hansontable[2] = '}
            });';

    }


    public function  add_info($nombre,$cantidad_estandar,$cantidad_real,$costo_real_unidad,$costo_ral_total,
                              $produccion_total,$precio_estandar,$costo_standar,$estandar_planificado,
                              $costo_real_servicio,$IE,$variacion_unitaria,$variacion_total)
    {


        $this->_data[1] .= ',[" '.$nombre.' ", "'.$cantidad_estandar.'", "'.$precio_estandar.'", "'.$costo_standar.'","'.$estandar_planificado.'", "'.$cantidad_real.'","'.$costo_real_unidad.'",
            "'.$costo_ral_total.'","'.$produccion_total.'","'.$costo_real_servicio.'","' .$IE. '","'  .$variacion_unitaria.'",
             "'.$variacion_total.'"] ';
    }


    public function  print_colores()
    {
        $str_rturn = '';

        //$str_rturn .= $this->_pre_script;
        $str_rturn .= $this->_data[0];
        $str_rturn .=$this->_data[1];
        $str_rturn .= $this->_data[2];
        $str_rturn .= $this->_register;
        $str_rturn .= $this->_hansontable[0];
        //$str_rturn .= '["", "", "", "", "", "","","","","","","",""],';
        $str_rturn .= $this->_hansontable[2];

        //$str_rturn .= $this->_post_script;

        return $str_rturn;
    }


    /**
     * @param string $idjs
     */
    public function setIdjs($idjs)
    {
        $this->_idjs = $idjs;

        $this->_hansontable[0] = " $('#handsontable". $this->_idjs ."').handsontable({
                data: data,

                readOnly: true,
                fillHandle: false,
                columnSorting: true,
                currentRowClassName: 'currentRow',
                currentColClassName: 'currentCol',


                cells: function (row, col, prop) {
                                 if (row === 0 && col === 1) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 0) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 2) {
                    this.renderer = gris2Renderer;
                }
                if (row === 10 && col === 20) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 3) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 4) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 5) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 6) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 7) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 8) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 9) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 10) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 11) {
                    this.renderer = gris2Renderer;
                }
                 if (row === 0 && col === 12) {

                    this.renderer = comentario;
                }";
    }


}