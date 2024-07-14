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
        $reglas = [
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

    public function edit($id = null)
    {
        if ($id == null) {
            return redirect()->to('crud');
        }

        $modelo = $this->personajes;
        $query = $modelo->obtener_personaje_por_identiicador($id);
        $personaje = $query->getRowArray();

        $data['personaje'] = $personaje;

        echo view('_layouts/header');
        echo view('crud/editar', $data);
        echo view('_layouts/footer');
    }

    public function update($id = null)
    {
        if (!$this->request->is('PUT') || $id == null) { //Si es GET O POST retorna a view crud
            return redirect()->to('crud');
        }

        // Establecer validaciones
        $reglas = [
            'nombre' => 'required|max_length[240]',
            'descripcion' => 'required',
        ];

        //Si las validaciones son incorrectas se manda un mensaje de error
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', 'Los datos son incorrectos (1)');
        }

        $fecha_actualizacion = date("Y-m-d H:i:s");

        // Preparar los datos a insertar
        $data = array(
            'nombre' => $this->request->getPost("nombre"),
            'descripcion' => $this->request->getPost("descripcion"),
            'fecha_actualizacion' => $fecha_actualizacion,
        );

        if ($this->personajes->update($id, $data)) {
            return redirect()->to(base_url('crud'))->with('exito', 'Su personaje se edito correctamente');
        }

        // Si algo falla regresar a la vista de crud
        return redirect()->to(base_url('crud'));
        // }
    }

    public function delete($id)
    {
        if (!$this->request->is('delete') || $id == null) { //Si no es delete retorna a view crud
            return redirect()->to('crud');
        }

        // $personajes = new Personajes_model();
        // $personajes->delete($id);

        $modelo = $this->personajes;
        $eliminar = $modelo->eliminar_personaje_por_id($id);

        if ($eliminar) {
            return redirect()->to('crud')->with('exito', 'Su personaje se elimino correctamente');
        }

        return redirect()->to('crud');
    }
}
