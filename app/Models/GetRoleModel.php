<?php

namespace App\Models;

use CodeIgniter\Model;

class GetRoleModel extends Model
{
    protected $table            = 'role';
    protected $primaryKey       = 'id_role';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    public function get_role($data = false)
    {
        if ($data) {
            return  $this->where('id_role', $data)->first();
        }
        $this->whereIn('role', ['Admin', 'Guru']);
        return $this->findAll();
    }
}
