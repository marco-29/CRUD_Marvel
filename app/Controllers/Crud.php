<?php

namespace App\Controllers;

use App\Libraries\ApiMarvel; //Se hace llamado a la libreria donde se obtinene los personajes
use App\Controllers\BaseController;
use App\Models\Personajes_model;

class Crud extends BaseController
{
    //Variabel para gestionar nuestra API
    protected $api;
    protected $personajes;

    public function __construct()
    {
        $this->api = new ApiMarvel(); //se crea constructor para hacer la instancia de ApiMarvel
        $this->personajes = new Personajes_model();
    }

    public function index()
    {

        //Se almacena el array de persnajes en la variable personajes ya si manipular mas facil los datos
        $personajes = $this->api->obtener_personajes();

        //Se obtiene datos de DB para despues verificar si ya esta llena
        $modelo = $this->personajes;
        $query = $modelo->obtener_tabla();
        $db_llena = $query->getResultArray();

        //Validacion de que si la DB ya esta llena, si no es asi almacena los datos del API si ya esta llena ya no lo hara, esto se hizo con la finalidad de que solo una vez se agreguen los datos de la API.
        if (!$db_llena) {
            foreach ($personajes as $key => $personaje) {
                $data = [
                    'identificador' => $personaje['id'],
                    'nombre'    => $personaje['name'],
                    'descripcion'    => $personaje['description'],
                    'fecha_registro'    => date('Y'),
                ];
    
                $this->personajes->insert($data);
            }
        }

        //Data para despues mostrarla en la vista
        $data['db_llena'] = $db_llena;
        $data['personajes'] = $personajes;

        //Se dirige a la view home para mostrar los personajes los culaes se obtienen de la instancia api que esta en ApiMarvel en el metodo obtener_personajes 
        echo view('_layouts/header');
        // return view('crud', [
        //     'personajes' => $this->api->obtener_personajes(),
        // ]);
        echo view('crud', $data);
        echo view('_layouts/footer');
    }
}
