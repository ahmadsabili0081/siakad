<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPenghasilan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penghasilan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'penghasilan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_penghasilan', true);
        $this->forge->createTable('penghasilan');
    }

    public function down()
    {
        $this->forge->dropTable('penghasilan');
    }
}
