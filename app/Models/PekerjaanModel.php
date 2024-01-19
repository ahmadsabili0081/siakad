<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table            = 'pekerjaan';
    protected $primaryKey       = 'id_pekerjaan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [];

    public function getDataPekerjaan()
    {
        return $this->findAll();
    }
}
