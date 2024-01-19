<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table            = 'galeri';
    protected $primaryKey       = 'id_galeri';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['galeri', 'is_active'];

    public function get_galeri($id = false)
    {
        if ($id) {
            return $this->where('id_galeri', $id)->first();
        }
        return $this->findAll();
    }

    public function get_galeri_aktif()
    {
        $this->where('galeri.is_active', true);
        return $this->findAll();
    }
}
