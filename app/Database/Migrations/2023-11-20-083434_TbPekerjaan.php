<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPekerjaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pekerjaan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_pekerjaan', true);
        $this->forge->createTable('pekerjaan');
    }

    public function down()
    {
        $this->forge->dropTable('pekerjaan');
    }
}
