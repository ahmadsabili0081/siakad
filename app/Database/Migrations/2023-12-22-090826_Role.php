<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_role' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_role', true);
        $this->forge->createTable('role');
    }

    public function down()
    {
        $this->forge->dropTable('role');
    }
}
