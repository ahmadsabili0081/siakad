<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' =>  100,
                'null'       => true
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' =>  50,
                'null'       => true
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' =>  50,
                'null'       => true
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' =>  15,
                'null'       => true
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' =>  15,
                'null'       => true
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' =>  50,
                'default'    => 'default.jpg'
            ],
            'id_role' => [
                'type'       => 'INT',
                'constraint' =>  11,
                'unsigned'       => true,
                'null'       => true
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
