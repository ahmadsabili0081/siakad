<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\PekerjaanModel;
use App\Models\PendidikanModel;
use App\Models\PenghasilanModel;
use App\Models\UserModel;


class Siswa extends BaseController
{
  protected $SiswaModel;
  protected $pekerjaanModel;
  protected $pendidikanModel;
  protected $penghasilanModel;
  protected $UserModel;

  public function __construct()
  {
    helper(['form', 'url']);
    $this->SiswaModel = new SiswaModel();
    $this->pekerjaanModel = new PekerjaanModel();
    $this->pendidikanModel = new PendidikanModel();
    $this->penghasilanModel = new PenghasilanModel();
    $this->UserModel = new UserModel();
  }

  public function index()
  {
    if (session()->get('id_role') != 3) {
      return redirect()->back();
    }

    $data = [
      'title' => "Siswa | Siakad Paud Nurul Iman"
    ];
    return view('Siswa/index', $data);
  }

  public function profile_student()
  {
    if (session()->get('id_role') != 3) {
      return redirect()->back();
    }
    $data = [
      'title' => 'Profil Siswa | Siakad Paud Nurul Iman',
      'profile_student' => $this->SiswaModel->getDataByIdUser(session()->get('id_siswa')),
      'pekerjaan' => $this->pekerjaanModel->getDataPekerjaan(),
      'penghasilan' => $this->penghasilanModel->getDataPenghasilan(),
      'pendidikan' => $this->pendidikanModel->getDataPendidikan(),
    ];
    return view('Siswa/profile_student', $data);
  }

  public function submit()
  {
    $id_siswa = $this->request->getPost('id_siswa');

    $rules = [
      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Nama harus terisi!"
        ],
      ],
      'email_pribadi' => [
        'rules' => 'required|trim|valid_email',
        'errors' => [
          'required' => "Kolom Email harus terisi!",
          'valid_email' => "Kolom Email harus Valid!"
        ],
      ],
      'nik' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => "Kolom Nik harus terisi!",
          'numeric' => "Kolom Nik harus Angka"
        ],
      ],
      'tmp_lahir' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Tempat Lahir harus terisi!",
        ],
      ],
      'tgl_lahir' => [
        'rules' => 'required|trim',
        'errors' => [
          'required' => "Kolom Tanggal Lahir harus terisi!",
        ],
      ],
      'alamat' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Alamat harus terisi!",
        ],
      ],
      'rt_rw' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Alamat harus terisi!",
        ],
      ],
      'kelurahan' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Kelurahan harus terisi!",
        ],
      ],
      'kecamatan' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Kecamatan harus terisi!",
        ],
      ],
      'kabupaten_kota' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Kabupaten/Kota harus terisi!",
        ],
      ],
      'prov' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Provinsi harus terisi!",
        ],
      ],
      'no_telp' => [
        'rules' => 'required|numeric',
        'errors' => [
          'required' => "Kolom Telepon harus terisi!",
          'numeric' => "Kolom Telepon harus angka!"
        ],
      ],
      'nama_ayah' => [
        'rules' => 'required|trim',
        'errors' => [
          'required' => "Kolom Nama Ayah  harus terisi!",
        ],
      ],
      'id_pekerjaan_ayah' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Pekerjaan Ayah  harus terisi!",
        ],
      ],
      'id_pendidikan_ayah' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Pendidikan Ayah harus terisi!",
        ],
      ],
      'id_penghasilan_ayah' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Penghasilan Ayah harus terisi!",
        ],
      ],
      'thn_lahir_ayah' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Tahun Lahir Ayah harus terisi!",
        ],
      ],
      'nama_ibu' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Nama Ibu harus terisi!",
        ],
      ],
      'id_pekerjaan_ibu' => [
        'rules' => 'required',
        'errors' => [
          'required' => "kolom Pekerjaan Ibu harus terisi!",
        ],
      ],
      'id_pendidikan_ibu' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Pendidikan Ibu harus terisi!",
        ],
      ],
      'id_penghasilan_ibu' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Penghasilan Ibu harus terisi!",
        ],
      ],
      'thn_lahir_ibu' => [
        'rules' => 'required',
        'errors' => [
          'required' => "Kolom Tahun Lahir Ibu harus terisi!",
        ],
      ],
      'gambar' => [
        'rules' => 'max_size[gambar,2048]|mime_in[gambar,image/png,image/jpg,image/jpeg]|ext_in[gambar,jpg,png,jpeg]',
        'errors' => [
          'max_size' => "Ukuran Tidak boleh lebuh dari 2MB!",
          'mime_in' =>  "Gambar harus bertipe jpg,jpeg,png!",
          'ext_in' => "File gambar harus memiliki .jpg, .png, .jpeg!"
        ],
      ],
      'kk_siswa' => [
        'rules' => 'max_size[kk_siswa,2048]|mime_in[kk_siswa,application/pdf]|ext_in[kk_siswa,pdf]',
        'errors' => [
          'max_size' => "Ukuran File Tidak boleh lebuh dari 2MB!",
          'mime_in' =>  "File harus berupa dokumen PDF.!",
          'ext_in' => "File harus memiliki ekstensi .pdf!"
        ],
      ],
      'akte' => [
        'rules' => 'max_size[akte,2048]|mime_in[akte,application/pdf]|ext_in[akte,pdf]',
        'errors' => [
          'max_size' => "Ukuran File Tidak boleh lebuh dari 2MB!",
          'mime_in' =>  "File harus berupa dokumen PDF.!",
          'ext_in' => "File harus memiliki ekstensi .pdf!"
        ],
      ],
    ];
    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    } else {

      $gambarFoto = $this->request->getFile('gambar');
      if ($gambarFoto->getError() == 4) {
        $namaGambar = $this->request->getPost('gambar_lama');
      } else {
        $namaGambar = $gambarFoto->getRandomName();
        $gambarFoto->move('gambar/fotoCalonSiswa/', $namaGambar);
        if ($this->request->getPost('gambar_lama') != 'default.png') {
          unlink('gambar/fotoCalonSiswa/' . $this->request->getPost('gambar_lama'));
        }
      }

      $gambarFileKK = $this->request->getFile('kk_siswa');
      if ($gambarFileKK->getError() == 4) {
        $namaFileKK = $this->request->getPost('kk_siswa_lama');
      } else {
        $namaFileKK = $gambarFileKK->getRandomName();
        $gambarFileKK->move('file/kk_siswa/', $namaFileKK);
        if ($this->request->getPost('kk_siswa_lama') != 'defaultkk.pdf') {
          unlink('file/kk_siswa/' . $this->request->getPost('kk_siswa_lama'));
        }
      }

      $gambarFileAkte = $this->request->getFile('akte');
      if ($gambarFileAkte->getError() == 4) {

        $namaFileAkte = $this->request->getPost('akte_lama');
      } else {
        $namaFileAkte = $gambarFileAkte->getRandomName();
        $gambarFileAkte->move('file/akte_siswa/', $namaFileAkte);
        if ($this->request->getPost('akte_lama') != 'default_akte.pdf') {
          unlink('file/akte_siswa/' . $this->request->getPost('akte_lama'));
        }
      }

      $this->SiswaModel->save([
        'id_siswa' => $id_siswa,
        'nama' => $this->request->getPost('nama'),
        'jenis_kel' => $this->request->getPost('jenis_kel'),
        'nik' => $this->request->getPost('nik'),
        'tmp_lahir' => $this->request->getPost('tmp_lahir'),
        'tgl_lahir' => $this->request->getPost('tgl_lahir'),
        'agama' => $this->request->getPost('agama'),
        'gambar' => $namaGambar,
        'kk_siswa' => $namaFileKK,
        'akte' => $namaFileAkte,
        'alamat' => $this->request->getPost('alamat'),
        'kelurahan' => $this->request->getPost('kelurahan'),
        'kecamatan' => $this->request->getPost('kecamatan'),
        'kabupaten_kota' => $this->request->getPost('kabupaten_kota'),
        'prov' => $this->request->getPost('prov'),
        'rt_rw' => $this->request->getPost('rt_rw'),
        'no_telp' => $this->request->getPost('no_telp'),
        'email_pribadi' => $this->request->getPost('email_pribadi'),
        'nama_ayah' => $this->request->getPost('nama_ayah'),
        'id_pekerjaan_ayah' => $this->request->getPost('id_pekerjaan_ayah'),
        'id_pendidikan_ayah' => $this->request->getPost('id_pendidikan_ayah'),
        'id_penghasilan_ayah' => $this->request->getPost('id_penghasilan_ayah'),
        'thn_lahir_ayah' => $this->request->getPost('thn_lahir_ayah'),
        'nama_ibu' => $this->request->getPost('nama_ibu'),
        'id_pekerjaan_ibu' => $this->request->getPost('id_pekerjaan_ibu'),
        'id_pendidikan_ibu' => $this->request->getPost('id_pendidikan_ibu'),
        'id_penghasilan_ibu' => $this->request->getPost('id_penghasilan_ibu'),
        'thn_lahir_ibu' => $this->request->getPost('thn_lahir_ibu'),
      ]);
      session()->setFlashdata('pesan', 'Data berhasil diubah');
      return redirect()->to(base_url('/siswa'));
    }
  }

  public function print_student_biodata()
  {
    $data = [
      'title' => "Cetak Pendaftaran | Siakad Paud Nurul Iman",
      'get_data' => $this->SiswaModel->get_data_by_id_for_print_biodata(session()->get('id_siswa')),
      'pekerjaan' => $this->pekerjaanModel->getDataPekerjaan(),
      'penghasilan' => $this->penghasilanModel->getDataPenghasilan(),
      'pendidikan' => $this->pendidikanModel->getDataPendidikan(),
    ];
    return view('Siswa/print_student_biodata', $data);
  }

  public function print($id)
  {
    $data = [
      'title' => "Cetak Bukti Pendaftaran | Siakad Paud Nurul Iman",
      'get_data' => $this->SiswaModel->get_data_by_id_for_print_biodata($id),
      'pekerjaan' => $this->pekerjaanModel->getDataPekerjaan(),
      'penghasilan' => $this->penghasilanModel->getDataPenghasilan(),
      'pendidikan' => $this->pendidikanModel->getDataPendidikan(),
    ];
    return view('Siswa/print', $data);
  }

  public function change_password()
  {
    $data = [
      'title' => 'Rubah Password | Siakad Paud Nurul Iman'
    ];
    return view('Siswa/change_password', $data);
  }

  public function submit_password()
  {
    if (session()->get('id_role') != 3) {
      return redirect()->back();
    }
    $rules = [
      'password_lama' => [
        'rules' => 'required|trim',
        'errors' => [
          'required' => "Kolom Password Lama harus terisi!",
        ],
      ],
      'password' => [
        'rules' => 'required|trim|min_length[3]|matches[konfirm_password]',
        'errors' => [
          'required' => "Kolom Password harus terisi!",
          'min_length' => "Password Panjang karakter min 3!",
          'matches' => "Password baru harus sama dengan password lama!"
        ],
      ],
      'konfirm_password' => [
        'rules' => 'required|trim|min_length[3]|matches[password]',
        'errors' => [
          'required' => "Kolom Konfirmasi password harus terisi!",
          'min_length' => "Password Panjang karakter min 3!",
          'matches' => "Password lama harus sama dengan password password baru!"
        ],
      ],
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    } else {

      $password_lama = $this->request->getPost('password_lama');
      $password_baru = $this->request->getPost('password');

      if ($password_baru == $password_lama) {
        session()->setFlashdata('gagal', 'Password Lama tidak boleh sama dengan password baru!');
      } else {
        $this->SiswaModel->save([
          'id_siswa' => session()->get('id_siswa'),
          'password' => password_hash($password_baru, PASSWORD_DEFAULT),
        ]);
        session()->setFlashdata('pesan', 'Password berhasil diubah!');
      }
      return redirect()->to(base_url('/siswa/change_password'));
    }
  }

  public function report_student()
  {
    $data = [
      'title' => "Rapot Siswa | Siakad Paud Nurul Iman"
    ];

    return view('Siswa/report_student', $data);
  }
}
