<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class MarvelApi extends BaseConfig
{
    // Se declara variables public para obtener las key de la API de mrvel, se obtienen de .env
    public $publickey;
    public $privatekey;
}