<?php

namespace App\Models;
use CodeIgniter\Model;

class Personajes_model extends Model
{
    protected $table      = 'personajes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['identificador', 'nombre', 'descripcion'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_registro';
    protected $updatedField  = 'fecha_actualizacion';
    protected $deletedField  = 'id';

    public function obtener_tabla()
    {
       $data = $this->db->query("SELECT * FROM personajes");
       return $data;
    }

    public function obtener_personaje_por_identiicador($id)
    {
       $data = $this->db->query("SELECT * FROM personajes where $id = id");
       return $data;
    }

    public function eliminar_personaje_por_id($id)
    {
       $data = $this->db->query("DELETE FROM personajes where id = $id");
       return $data;
    }
}


