<?php

namespace App\Models;

use CodeIgniter\Model;


class SiswaModel extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['no_pendaftaran', 'nama', 'password', 'jenis_kel', 'nik', 'tmp_lahir', 'tgl_lahir', 'agama', 'gambar', 'kk_siswa', 'akte', 'alamat', 'kelurahan', 'kecamatan', 'kabupaten_kota', 'prov', 'rt_rw', 'no_telp', 'email_pribadi', 'nama_ayah', 'id_pekerjaan_ayah', 'id_pendidikan_ayah', 'id_penghasilan_ayah', 'thn_lahir_ayah', 'nama_ibu', 'id_pekerjaan_ibu', 'id_pendidikan_ibu', 'id_penghasilan_ibu', 'thn_lahir_ibu', 'is_active', 'id_role', 'id_kelas'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    public function getNomorPendaftaran()
    {
        $totalPendaftaran =  $this->countAllResults();
        $tahun = date('Y');
        $nomor = str_pad($totalPendaftaran + 1, 3, '0', STR_PAD_LEFT);
        $nomorPendaftaran = $nomor . $tahun . 'PPDB';
        return $nomorPendaftaran;
    }

    public function GetData($data = false)
    {
        if ($data) {
            return $this->where('no_pendaftaran', $data)->first();
        }
        $this->select('siswa.*, kelas.*');
        $this->join('kelas', 'siswa.id_kelas = kelas.id_kelas', 'left');
        return $this->findAll();
    }

    public function getDataByIdUser($id)
    {
        $this->where('id_siswa', $id);
        return $this->first();
    }

    public function get_data_by_id_for_print_biodata($id)
    {
        $this->select('siswa.*, 
        pekerjaan_ayah.pekerjaan AS pekerjaan_ayah, 
        pendidikan_ayah.pendidikan AS pendidikan_ayah, 
        penghasilan_ayah.penghasilan AS penghasilan_ayah, 
        pekerjaan_ibu.pekerjaan AS pekerjaan_ibu, 
        pendidikan_ibu.pendidikan AS pendidikan_ibu, 
        penghasilan_ibu.penghasilan AS penghasilan_ibu');
        $this->join('pekerjaan AS pekerjaan_ayah', 'siswa.id_pekerjaan_ayah = pekerjaan_ayah.id_pekerjaan');
        $this->join('pendidikan AS pendidikan_ayah', 'siswa.id_pendidikan_ayah = pendidikan_ayah.id_pendidikan');
        $this->join('penghasilan AS penghasilan_ayah', 'siswa.id_penghasilan_ayah = penghasilan_ayah.id_penghasilan');
        $this->join('pekerjaan AS pekerjaan_ibu', 'siswa.id_pekerjaan_ibu = pekerjaan_ibu.id_pekerjaan');
        $this->join('pendidikan AS pendidikan_ibu', 'siswa.id_pendidikan_ibu = pendidikan_ibu.id_pendidikan');
        $this->join('penghasilan AS penghasilan_ibu', 'siswa.id_penghasilan_ibu = penghasilan_ibu.id_penghasilan');
        $this->where('id_siswa', $id);
        return $this->first();
    }

    public function get_data_by_kelas($id = false)
    {
        $this->select('siswa.*,kelas.*');
        $this->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
        $this->where('siswa.id_kelas', 1);
        return $this->findAll();
    }

    public function get_data_by_kelas_b($id = false)
    {
        $this->select('siswa.*,kelas.*');
        $this->join('kelas', 'siswa.id_kelas = kelas.id_kelas');
        $this->where('siswa.id_kelas', 2);
        return $this->findAll();
    }
}
