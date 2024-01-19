<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_menu' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_role' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'menu' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sub_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'is_active' => [
                'type'       => 'INT',
                'constraint' => 1,
            ],
        ]);
        $this->forge->addKey('id_menu', true);
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
