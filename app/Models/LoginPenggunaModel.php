<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginPenggunaModel extends Model
{
    protected $table            = 'login_pengguna';
    protected $primaryKey       = 'id_login';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_role', 'id_siswa', 'browser', 'platform', 'ip_address', 'is_active'];
}
