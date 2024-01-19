<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_pendaftaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '12',
            ],
            'jenis_kel' => [
                'type' => 'ENUM',
                'constraint' => ['Laki-Laki', 'Perempuan']
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'tmp_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'tgl_lahir' => [
                'type'       => 'DATE',
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'default' => 'Islam'
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'default' => 'default.png'
            ],
            'kk_siswa' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'akte' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null' => true
            ],
            'kelurahan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'kabupaten_kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'prov' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'rt_rw' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'null' => true
            ],
            'email_pribadi' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null' => true
            ],
            'nama_ayah' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null' => true
            ],
            'id_pekerjaan_ayah' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true
            ],
            'id_pendidikan_ayah' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true
            ],
            'id_penghasilan_ayah' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true
            ],
            'thn_lahir_ayah' => [
                'type'       => 'INT',
                'constraint' => '11',
                'null' => true
            ],
            'nama_ibu' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null' => true
            ],
            'id_pekerjaan_ibu' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'id_pendidikan_ibu' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'id_penghasilan_ibu' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'thn_lahir_ibu' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'id_role' => [
                'type'       => 'INT',

                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'is_active' => [
                'type'       => 'INT',
                'constraint' => '1',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
            ],

        ]);
        $this->forge->addKey('id_siswa', true);
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}
