<?php

namespace App\Models;

use CodeIgniter\Model;

class PenghasilanModel extends Model
{
    protected $table            = 'penghasilan';
    protected $primaryKey       = 'id_penghasilan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];




    public function getDataPenghasilan()
    {
        return $this->findAll();
    }
}
