<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table            = 'pendidikan';
    protected $primaryKey       = 'id_pendidikan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];



    public function getDataPendidikan()
    {
        return $this->findAll();
    }
}
