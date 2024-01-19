<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPendidikan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pendidikan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_pendidikan', true);
        $this->forge->createTable('pendidikan');
    }

    public function down()
    {
        $this->forge->dropTable('pendidikan');
    }
}
