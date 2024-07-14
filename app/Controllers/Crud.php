<?php

namespace App\Controllers;

use App\Libraries\ApiMarvel; //Se hace llamado a la libreria donde se obtinene los personajes
use App\Controllers\BaseController;
use App\Models\Personajes_model;

class Crud extends BaseController
{
    protected $helpers = ['form'];    
    
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
        // return view('crud', [
        //     'personajes' => $this->api->obtener_personajes(),
        // ]);
        echo view('_layouts/header');
        echo view('crud/index', $data);
        echo view('_layouts/footer');
    }

    public function create()
    {
        // Establecer validaciones
        $reglas= [
            'nombre' => 'required|max_length[240]',
            'descripcion' => 'required',
        ];

        //Si las validaciones son incorrectas se manda un mensaje de error
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', 'Los datos son incorrectos (1)');
        }

        $fecha_registro = date("Y-m-d H:i:s");
        $key_1 = "personajes-" . date("Y-m-d-H-i-s", strtotime($fecha_registro));
        $identificador_1 = hash("crc32b", $key_1);

        // Preparar los datos a insertar
        $data = array(
            'identificador' => $identificador_1,
            'nombre' => $this->request->getPost("nombre"),
            'descripcion' => $this->request->getPost("descripcion"),
            'fecha_registro' => $fecha_registro,
        );

        if ($this->personajes->insert($data)) {
            return redirect()->to(base_url('crud'))->with('exito', 'Su personaje se agrego correctamente');
        }

        // Si algo falla regresar a la vista de crud
        return redirect()->to(base_url('crud'));
        // }
    }

    public function edit($identificador = null)
    {
        // Establecer validaciones
        // $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        // $this->form_validation->set_rules('descripcion', 'Descripción', 'required');

        // if ($this->form_validation->run() == false) {
        //     echo view('_layouts/header');
        //     echo view('crud/index');
        //     echo view('_layouts/footer');
        // } else {

        $modelo = $this->personajes;
        $query = $modelo->obtener_personaje_por_identiicador($identificador);
        $personaje = $query->getResultArray();

        $data['personaje'] = $personaje;

        if ($personaje) {
            echo view('_layouts/header');
            echo view('crud/editar', $data);
            echo view('_layouts/footer');
        } else {
            return redirect()->to(base_url('crud'));
        }

        $nombre = $this->request->getPost("nombre");
        $des = $this->request->getPost("descripcion");

        if ($nombre != null AND $des != null) {
            $fecha_actualizacion = date("Y-m-d H:i:s");
    
            // Preparar los datos a insertar
            $data = array(
                'nombre' => $this->request->getPost("nombre"),
                'descripcion' => $this->request->getPost("descripcion"),
                'fecha_actualizacion' => $fecha_actualizacion,
            );
    
            if ($this->personajes->insert($data)) {
                return redirect()->to(base_url('crud'));
            }
        }

        // Si algo falla regresar a la vista de crud
        $this->index();
        // }
    }
}