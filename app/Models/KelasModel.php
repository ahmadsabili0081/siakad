<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table            = 'kelas';
    protected $primaryKey       = 'id_kelas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['kelas', 'keterangan', 'id_user', 'is_active'];

    public function get_kelas($data = false)
    {
        if ($data) {
            $this->select('kelas.*, users.*');
            $this->join('users', 'kelas.id_user = users.id_user');
            $this->where('id_kelas', $data);
            $this->where('kelas.is_active', true);
            return $this->first();
        }
        $this->select('kelas.*, users.*');
        $this->join('users', 'kelas.id_user = users.id_user');
        $this->where('kelas.is_active', true);
        return $this->findAll();
    }

    public function get_kelas_oke()
    {
        $this->where('kelas.is_active', true);
        return $this->findAll();
    }
}
