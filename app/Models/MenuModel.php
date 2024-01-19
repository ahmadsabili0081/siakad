<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menu';
    protected $primaryKey       = 'id_menu';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['is_active'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function joinMenu($id_role)
    {
        $this->select('menu.*, akses_menu .*');
        $this->join('akses_menu', 'akses_menu.id_menu = menu.id_menu');
        $this->where('akses_menu.id_role', $id_role);
        $this->orderBy('menu.id_menu', 'ASC');
        return $this->findAll();
    }

    public function sub_menu_join($id_menu)
    {

        $this->select('menu .*, sub_menu .*');
        $this->join('sub_menu', 'sub_menu.id_menu = menu.id_menu');
        $this->where('sub_menu.id_menu', $id_menu);
        $this->where('sub_menu.is_active', 1);
        $this->where('sub_menu.id_role', session()->get('id_role'));
        return $this->findAll();
    }

    public function get_akses()
    {
        $this->select('menu .*, sub_menu .*,role.*');
        $this->join('sub_menu', 'sub_menu.id_menu = menu.id_menu');
        $this->join('role', 'sub_menu.id_role = role.id_role');
        return $this->findAll();
    }
}
