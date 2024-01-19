<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table            = 'absensi';
    protected $primaryKey       = 'id_absensi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['hari', 'id_siswa', 'id_thn_ajaran', 'tanggal', 'hadir', 'izin', 'alpha'];

    public function get_check($id_siswa, $id_thn_ajaran, $tanggal)
    {
        // Set zona waktu ke Indonesia jika diperlukan
        date_default_timezone_set('Asia/Jakarta');

        // Ubah format tanggal menjadi "YYYY-MM-DD"
        $formattedDate = date('Y-m-d', strtotime($tanggal));

        // Gunakan DATE_FORMAT untuk membandingkan hanya tanggal
        $this->where('id_siswa', $id_siswa);
        $this->where('id_thn_ajaran', $id_thn_ajaran);
        $this->where("DATE_FORMAT(tanggal, '%Y-%m-%d')", $formattedDate);

        // Eksekusi query dan kembalikan hasil
        return $this->first();
    }

    public function get_absence_data($id = false)
    {
        if ($id) {
            $this->select('absensi .* ,thn_ajaran.*, siswa.*');
            $this->join('thn_ajaran', 'absensi.id_thn_ajaran = thn_ajaran.id_thn_ajaran');
            $this->join('siswa', 'absensi.id_siswa = siswa.id_siswa');
            $this->where("id_absensi", $id);
            return $this->first();
        }
        $this->select('absensi .* ,thn_ajaran.*, siswa.*');
        $this->join('thn_ajaran', 'absensi.id_thn_ajaran = thn_ajaran.id_thn_ajaran');
        $this->join('siswa', 'absensi.id_siswa = siswa.id_siswa');
        return $this->findAll();
    }
}
