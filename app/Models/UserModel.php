<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields  = [
        'nama_lengkap', 'email', 'username', 'alamat', 'no_telp', 'password', 'gambar', 'id_role', 'is_active'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getData($data = false)
    {
        if (!$data) {
            $this->select('users .*, role .*');
            $this->join('role', 'users.id_role = role.id_role');
            return $this->findAll();
        }
        return $this->where('email', $data)->first();
    }

    public function get_data_by_id($id)
    {
        $this->select('users .*, role .*');
        $this->join('role', 'users.id_role = role.id_role');
        $this->where('users.id_user', $id);
        $this->where('users.is_active', true);
        return $this->first();
    }
}
