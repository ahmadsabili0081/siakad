<?php

namespace App\Models;

use CodeIgniter\Model;

class ThnAjaranModel extends Model
{
    protected $table            = 'thn_ajaran';
    protected $primaryKey       = 'id_thn_ajaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['thn_ajaran', 'semester', 'is_active'];


    public function get_data($id = false)
    {
        if ($id) {
            return $this->where('id_thn_ajaran', $id)->first();
        }
        return $this->findAll();
    }
}
