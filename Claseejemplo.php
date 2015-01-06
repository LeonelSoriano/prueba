<?php

/**
 * Esta clase realiza operaciones para los layout headder footer
 *
 * @author Leonel Soriano <leonelsoriano3@gmail.com>
 * @copyright 2014
 *
 */

include_once("clases/funciones.php");

class Claseejemplo
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


    public function __construct($semanas)
    {

        // estas las utilizo con setter

        $this->_nombre_de_salario = "Sueldo Base";
        $this->_total_horas_trabajadas = 40;

        $this->_horas_turno = array(8,8,8,8,8);


        // -.-.--.-..-.-.-.-..-.--


        $this->_actual_index = 0;
        $this->_semanas = $semanas;


        $this->_array_information = [];


        //.-.-.-.--..-- para el arra de variables
        $this->_data = [];
        $this->_data[0] = ' var data = [
        ["", "Mensual", "Semana 1", "Semana 2", "Semana 3", "Semana 4"';

        if($semanas == 5){
            $this->_data[0] .= ',"Semana 5"';
        }

        $this->_data[0] .= '],';


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
                    background: '#ABABEE'
                });
            };


            var totalRenderer = function (instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                $(td).css('font-weight','bold')
            };

            var amarilloRenderer = function (instance, td, row, col, prop, value, cellProperties) {
                Handsontable.renderers.TextRenderer.apply(this, arguments);
                $(td).css({
                    background: '#FFF744'
                });
            };";


       $this->_hansontable = [];
       $this->_hansontable[0] = " $('#handsontable').handsontable({
                data: data,
                minSpareRows: 1,
                readOnly: true,
                fillHandle: false,
                columnSorting: true,
                currentRowClassName: 'currentRow',
                currentColClassName: 'currentCol',
                cells: function (row, col, prop) {
                                 if (row === 0 && col === 1) {
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
                }";

       $this->_hansontable[2] = '}
            });';

    }

    public function  add_info($array_info = array())
    {
        $this->_array_information = $array_info;
    }


    public function hola()
    {
        foreach($this->_array_information as $key => $value){

            foreach($value as $key2 => $value2){
                echo( $key.'->'.$key2  . '</br>');
                print_r($value2);
            }
        }
    }

    public function procesar()
    {
        $tmp_nombre = '';
        $tmp_sumaface = [];
        $tmp_sumatotal = [];
        $tmp_salario_base = [];

        $mensual_sueldo_base = 0;
        $mensual_costo_empleado = 0;

        foreach($this->_array_information as $key => $value){


            $this->_actual_index++;
            $this->_data[1] .= '["'. $key .'", "", "", "", "", "",""],';



            $this->_hansontable[1] .= '
            if (row === '.$this->_actual_index.' && col === 0) {
                this.renderer = grisRenderer;
            }
            if (row === '.$this->_actual_index.' && col === 1) {
                this.renderer = amarilloRenderer;
            }
            if (row === '.$this->_actual_index.' && col === 2) {
                this.renderer = amarilloRenderer;
            }
            if (row === '.$this->_actual_index.' && col === 3) {
                this.renderer = amarilloRenderer;
            }
            if (row === '.$this->_actual_index.' && col === 4) {
                this.renderer = amarilloRenderer;
            }
            if (row === '.$this->_actual_index.' && col === 5) {
                this.renderer = amarilloRenderer;
            }
            if (row === '.$this->_actual_index.' && col === 6) {
                this.renderer = amarilloRenderer;
            }';

            $this->_actual_index++;


            foreach($value as $key2 => $value2){

                $tmp_nombre = $key;

                $this->_actual_index++;

                $resultado = 0;

                for($i=0;  $i <= count($value2);$i++  ){
                    $resultado += $value2[$i];
                }

                $this->_data[1] .= '["'.utf8_decode($key2).'",'.round( $resultado,2).', '.round($value2[0],2).', '.round($value2[1],2).', '.round($value2[2],2).', '.round($value2[3],2).'';

                $tmp_sumaface[0] += $value2[0];
                $tmp_sumaface[1] += $value2[1];
                $tmp_sumaface[2] += $value2[2];
                $tmp_sumaface[3] += $value2[3];


                if(count($value2) == 5){
                    $this->_data[1] .= ", '$value2[4]'";
                    $tmp_sumaface[4] += $value2[4];
                }

                $this->_data[1] .= "],";

                if($key2== $this->_nombre_de_salario){
                    $tmp_salario_base = $value2;
                    $mensual_sueldo_base = $resultado;

                }

            }



            $resultado = 0;
            for($i=0;  $i <= count($tmp_sumaface);$i++  ){
                $resultado += $tmp_sumaface[$i];
            }


            $this->_hansontable[1] .= '
             if (row === '.$this->_actual_index.' && col === 0) {
                this.renderer = totalRenderer;
            }';

            $this->_data[1] .= '["Total '. $tmp_nombre .'", '.round($resultado,2).', '.round($tmp_sumaface[0],2).', '.round($tmp_sumaface[1],2).'
                , '.round($tmp_sumaface[2],2).', '.round($tmp_sumaface[3],2).' ';

            if($this->_semanas == 5){
                $this->_data[1] .= ",$tmp_sumaface[4]";
                $tmp_sumatotal[4] += round($tmp_sumaface[4],2);
                $tmp_sumaface[4] = 0;
            }

            $this->_data[1] .="],";


            $tmp_sumatotal[0] += $tmp_sumaface[0];
            $tmp_sumatotal[1] += $tmp_sumaface[1];
            $tmp_sumatotal[2] += $tmp_sumaface[2];
            $tmp_sumatotal[3] += $tmp_sumaface[3];

            $tmp_sumaface[0] = 0;
            $tmp_sumaface[1] = 0;
            $tmp_sumaface[2] = 0;
            $tmp_sumaface[3] = 0;
        }


        $this->_data[1] .= '["", "", "", "", "", "",""],';
        $this->_actual_index++;

        $resultado = 0;
        for($i=0;  $i <= count($tmp_sumatotal);$i++){
            $resultado += $tmp_sumatotal[$i];
        }

        $mensual_costo_empleado = $resultado;

        $this->_data[1] .= '["Total Costo Empleado(s)", "'.round($resultado,2).'", "'.round($tmp_sumatotal[0],2).'", "'.round($tmp_sumatotal[1],2).'"
            , "'.round($tmp_sumatotal[2],2).'", "'.round($tmp_sumatotal[3],2).'"';

        if($this->_semanas == 5){
            $this->_data[1] .= ',"'. round( $tmp_sumatotal[4],2).'"';
        }

        $this->_actual_index++;
        $this->_hansontable[1] .= '
             if (row === '.$this->_actual_index.' && col === 0) {
                this.renderer = totalRenderer;
            }';
        $this->_data[1] .="],";


        $save_costo = $tmp_sumatotal;

        $total_costo = [];
        for($i=0;  $i <= count($tmp_salario_base);$i++){
                $total_costo[$i] += ($save_costo[$i]/$tmp_salario_base[$i])* 100;
        }

        $resultado = ($mensual_costo_empleado/$mensual_sueldo_base)*100;


        $this->_data[1] .= '["Total Carga Laboral %", "'.rendondear($resultado).'%'.'", "'. rendondear($total_costo[0]).'%' .'", "'.rendondear($total_costo[1]).'%'.'", "'.rendondear($total_costo[2]).'%'.'"
                , "'.rendondear($total_costo[3]).'%'.'"';

        if($this->_semanas == 5){

            $this->_data[1] .= ','.rendondear($total_costo[4]).'%'.'';
        }

        $this->_data[1] .= "],";

        $this->_actual_index++;

        $this->_hansontable[1] .= '
             if (row === '.$this->_actual_index.' && col === 0) {
                this.renderer = totalRenderer;
            }';


        $total_carga_laboral_veces = [];

        for($i=0;  $i <= count($tmp_salario_base);$i++){
            $total_carga_laboral_veces[$i] = ($save_costo[$i] -$tmp_salario_base[$i]) / $tmp_salario_base[$i] ;
        }

        $resultado = ($mensual_costo_empleado - $mensual_sueldo_base) /$mensual_sueldo_base;


        $this->_data[1] .= '["Total Carga Laboral Veces", "'.rendondear($resultado).'", "'.rendondear($total_carga_laboral_veces[0]).'"
            , "'.rendondear($total_carga_laboral_veces[1]).'", "'.rendondear($total_carga_laboral_veces[2]).'"
            , "'.rendondear($total_carga_laboral_veces[3]).'"';


        if($this->_semanas == 5){

            $this->_data[1] .= ','.rendondear($total_carga_laboral_veces[4]).'';
        }

        $this->_data[1] .= "],";


        $this->_actual_index++;
        $this->_hansontable[1] .= '
             if (row === '.$this->_actual_index.' && col === 0) {
                this.renderer = totalRenderer;
            }';


        $total_hora_hombre_efectivo = [];

        for($i=0;  $i <= count($save_costo);$i++){
            $total_hora_hombre_efectivo[$i] = $save_costo[$i] / $this->_total_horas_trabajadas;
        }

        $resultado = $mensual_costo_empleado / $this->_total_horas_trabajadas;

        $this->_data[1] .= '["Costo Hora Hombre Efectivo", "'.rendondear($resultado).'", "'.rendondear($total_hora_hombre_efectivo[0]).'"
            , "'.rendondear($total_hora_hombre_efectivo[1]).'", "'.rendondear($total_hora_hombre_efectivo[2]).'"
            , "'.rendondear($total_hora_hombre_efectivo[3]).'"';

        if($this->_semanas == 5){

            $this->_data[1] .= ','.rendondear($total_hora_hombre_efectivo[4]).'';
        }

        $this->_data[1] .= "],";


        $this->_actual_index++;


        $this->_hansontable[1] .= '
             if (row === '.$this->_actual_index.' && col === 0) {
                this.renderer = totalRenderer;
            }';


        $total_costo_hora_pagado  = [];
        for($i=0;  $i <= count($save_costo);$i++){
            $total_costo_hora_pagado[$i] = $save_costo[$i] / 30 / 8;
        }


        $acum_hora_turnos = 0;
        for($i=0;  $i <= $this->_semanas ;$i++){

            $acum_hora_turnos += $this->_horas_turno[$i];
        }

        $acum_hora_turnos = $acum_hora_turnos / $this->_semanas;

        $resultado = $mensual_costo_empleado / 30 / 8;

        $this->_data[1] .= '["Costo Hora Hombre Pagado", "'.rendondear($resultado).'", "'.rendondear($total_costo_hora_pagado[0]).'",
            "'.rendondear($total_costo_hora_pagado[1]).'", "'.rendondear($total_costo_hora_pagado[2]).'"
            , "'.rendondear($total_costo_hora_pagado[3]).'"';


        if($this->_semanas == 5){

            $this->_data[1] .= ','.rendondear($total_costo_hora_pagado[4]).'';
        }

        $this->_data[1] .= "],";


        $this->_actual_index++;
        $this->_hansontable[1] .= '
             if (row === '.$this->_actual_index.' && col === 0) {
                this.renderer = totalRenderer;
            }';

    }



    public function  print_colores()
    {
        echo($this->_data[0]);
        echo($this->_data[1]);
        echo($this->_data[2]);
        echo($this->_register);
        echo($this->_hansontable[0]);
        echo($this->_hansontable[1]);
        echo($this->_hansontable[2]);

    }


    public function set_name_salario($nuevo_nombre)
    {
        $this->_nombre_de_salario = $nuevo_nombre;
    }


    /**
     * @param array $horas_turno
     */
    public function setHorasTurno($horas_turno)
    {
        $this->_horas_turno = $horas_turno;
    }



    /**
     * @param mixed $total_horas_trabajadas
     */
    public function setTotalHorasTrabajadas($total_horas_trabajadas)
    {
        $this->_total_horas_trabajadas = $total_horas_trabajadas;
    }


}