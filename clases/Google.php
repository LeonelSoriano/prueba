<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/09/14
 * Time: 06:56 PM
 */
//Autor: Damián Aguilar
//Website: http://www.damianaguilar.es

class Google
{
    public $origen;
    public $destino;
    public $idioma  = "es";
    public $sensor  = "false";
    public $region  = "es";
    public $country = "ES";

    private function parseJSON($url)
    {
        //Limpiamos los espacios en blanco
        $url = str_replace (" ", "+", $url);

        //Obtenemos los datos del archivo
        $file = file_get_contents($url);

        //Decodificamos el archivo en formato json
        $json = json_decode($file, true);

        //Devolvemos el resultado
        return $json;
    }

    private function getGPS()
    {
        //Definimos variables: provincia y pais
        $components = "&components=administrative_area:" . $provincia . "|country:". $this->country;

        //Enviamos la solicitud JSON
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address .
            "&sensor=" . $this->sensor . $components;

        //Parseamos el archivo usando la función anterior
        $gps = self::parseJSON($url);

        //Establecemos el GPS y delvovemos los valores de latitud y longitud
        return $gps['results'][0]['geometry']['location']['lat'] . "," . $gps['results'][0]['geometry']['location']['lng'];
    }

    public function gps()
    {
        //Calculamos gps, a partir de las variables de la clase: $this->origen.
        $origen = self::getGPS($this->origen[0], $this->origen[1]);

        //Calculamos gps, a partir de las variables de la clase: $this->destino.
        $destino = self::getGPS($this->destino[0], $this->destino[1]);

        //Consulta Google
        $url = "http://maps.googleapis.com/maps/api/distancematrix/json?"
            . "origins=" . $origen . "&destinations=" . $destino . ""
            . "&mode=driving&"
            . "language=" . $this->idioma . "&"
            . "sensor=" . $this->sensor ."&region=es";

        //Parseamos los datos
        $data = self::parseJSON($url);

        //devolvemos el resultado
        return $data;
    }
}