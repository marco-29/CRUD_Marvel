<?php

namespace App\Controllers;

use App\Libraries\ApiMarvel; //Se hace llamado a la libreria donde se obtinene los personajes

class Documentacion extends BaseController
{
    //Variabel para gestionar nuestra API
    protected $api;

    public function __construct()
    {
    }

    public function index()
    {
        // return view('welcome_message');
        //Se dirige a la view home para mostrar los personajes los culaes se obtienen de la instancia api que esta en ApiMarvel en el metodo obtener_personajes 
        echo view('_layouts/header');
        echo view('documentacion/index');
        echo view('_layouts/footer');
    }
}
