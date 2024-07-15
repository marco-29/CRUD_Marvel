<?php
namespace App\Libraries;

use CodeIgniter\HTTP\CURLRequest;
use Config\Services; //Esto para hacer uso de los servicios y utilizarlos en la variable curl que est en el constructor
use CodeIgniter\I18n\Time; //Esto se usa para la variable ts

class ApiMarvel
{
    protected $curl;
    protected $ts;
    protected $hash;

    // Se arma contructor para crear las variables para los parametros de la API
    public function __construct() 
    {
        $this->curl = Services::curlrequest(['baseURI' => 'https://gateway.marvel.com:443/v1/public/']); // Se usa CURLREQUEST la cual ya nos la brinda codeigniter  y ademas se crea un array donde se almacena el endpoint principal de marvel con ayuda de baseURI el cual nos lo brinda codeigniter4
        $this->ts = Time::now()->getTimestamp(); //timestamp tare fecha y hora exacta 
        $this->hash = hash('md5', $this->ts. config('MarvelApi')->privatekey. config('MarvelApi')->publickey); //cifrar de tipo md5 concatenando ts+ privaekey + publickey las cuales las mandamos a traer de .env
    }

    // Crear metodo para obtener personajes
    public function obtener_personajes() {
        //Se crean parametros necesarios para la consulta 
        $params = [
            'ts' => $this->ts,
            'apikey' => config('MarvelApi')->publickey,
            'hash' => $this->hash,
        ];

        $query = http_build_query($params);

        $result = $this->curl->get('characters?'.$query); //Se hace la solicitud con metodo GET ya que la API solo permite este metodo.

        $json_body = json_decode($result->getBody(), true); //Se decifra el json de los personajes que nos devuelve la API 

        //Aqui extraigo el solo el result del json ya que es lo unico que se utilizara, el results esta dentro de data entonces primero se extrae data y despues results
        $results = $json_body['data']['results'];

        //Aqui se crea un arreglo vacio para los persoanjes
        $personajes = [];

        //Se recorre el results por medio de foreach para almacenar el id y nombre de los personajes en el arreglo personajes
        foreach ($results as $key => $personaje) {
            $personajes[] = [
                'id' => $personaje['id'],
                'name' => $personaje['name'],
                'description' => $personaje['description'],
            ];
        }

        return $personajes; //Se hace retorno del arreglo para verificar si funciona, esto en el controlador crud
    }
}