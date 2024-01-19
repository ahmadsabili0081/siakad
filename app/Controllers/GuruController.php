<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\PekerjaanModel;
use App\Models\PenghasilanModel;
use App\Models\PendidikanModel;
use App\Models\ThnAjaranModel;
use App\Models\KelasModel;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class GuruController extends BaseController
{
    protected $SiswaModel;
    protected $pekerjaanModel;
    protected $penghasilanModel;
    protected $pendidikanModel;
    protected $thn_ajaran;
    protected $absensi_model;
    protected $kelas_model;
    protected $UserModel;


    public function __construct()
    {
        helper(['custom', 'form', 'url']);
        $this->SiswaModel = new SiswaModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->penghasilanModel = new PenghasilanModel();
        $this->pendidikanModel = new PendidikanModel();
        $this->thn_ajaran = new ThnAjaranModel();
        $this->absensi_model = new AbsensiModel();
        $this->kelas_model = new KelasModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }

        $db = \Config\Database::connect();

        $result = $db->table('penilaian')
            ->select('penilaian.*, aspek.*, sub_aspek.*')
            ->join('aspek', 'penilaian.id_aspek = aspek.id_aspek')
            ->join('sub_aspek', 'penilaian.id_sub_aspek = sub_aspek.id_sub_aspek')
            ->get()
            ->getResultArray();
        $data = [
            'title' => "Dashboard Guru | Siakad Paud Nurul Iman",
            'result' => $result
        ];
        return view('Guru/index', $data);
    }

    public function students()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $data = [
            'title' => "Siswa | Siakad Paud Nurul Iman",
            'data' => $this->SiswaModel->GetData()
        ];
        return view('Guru/siswa/index', $data);
    }

    public function add_student()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $data = [
            'title' => "Tambah Data Siswa | Siakad Paud Nurul Iman",
            'no_pendaftaran' => $this->SiswaModel->getNomorPendaftaran(),
            'pekerjaan' => $this->pekerjaanModel->getDataPekerjaan(),
            'penghasilan' => $this->penghasilanModel->getDataPenghasilan(),
            'pendidikan' => $this->pendidikanModel->getDataPendidikan(),
            'get_kelas' => $this->kelas_model->get_kelas(),
        ];
        return view('Guru/siswa/add_student', $data);
    }

    public function edit_student($no_pendaftaran)
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $data = [
            'title' => "Ubah Data Siswa | Siakad Paud Nurul Iman",
            'get_data' => $this->SiswaModel->GetData($no_pendaftaran),
            'pekerjaan' => $this->pekerjaanModel->getDataPekerjaan(),
            'penghasilan' => $this->penghasilanModel->getDataPenghasilan(),
            'pendidikan' => $this->pendidikanModel->getDataPendidikan(),
            'get_kelas' => $this->kelas_model->get_kelas(),
        ];
        return view('Guru/siswa/update_student', $data);
    }

    public function submit_student()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $is_edit = $this->request->getPost('id_siswa');

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
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Kelompok/Kelas harus terisi!",
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
                if ($is_edit) {
                    $namaGambar = $this->request->getPost('gambar_lama');
                } else
                    $namaGambar = 'default.png';
            } else {
                $namaGambar = $gambarFoto->getRandomName();
                $gambarFoto->move('gambar/fotoCalonSiswa/', $namaGambar);
                if ($is_edit) {
                    if ($this->request->getPost('gambar_lama') != 'default.png') {
                        unlink('gambar/fotoCalonSiswa/' . $this->request->getPost('gambar_lama'));
                    }
                }
            }

            $gambarFileKK = $this->request->getFile('kk_siswa');
            if ($gambarFileKK->getError() == 4) {
                if ($is_edit) {
                    $namaFileKK = $this->request->getPost('kk_siswa_lama');
                } else
                    $namaFileKK = 'defaultkk.pdf';
            } else {
                $namaFileKK = $gambarFileKK->getRandomName();
                $gambarFileKK->move('file/kk_siswa/', $namaFileKK);
                if ($is_edit) {
                    if ($this->request->getPost('kk_siswa_lama') != 'defaultkk.pdf') {
                        unlink('file/kk_siswa/' . $this->request->getPost('kk_siswa_lama'));
                    }
                }
            }

            $gambarFileAkte = $this->request->getFile('akte');
            if ($gambarFileAkte->getError() == 4) {
                if ($is_edit) {
                    $namaFileAkte = $this->request->getPost('akte_lama');
                } else
                    $namaFileAkte = 'default_akte.pdf';
            } else {
                $namaFileAkte = $gambarFileAkte->getRandomName();
                $gambarFileAkte->move('file/akte_siswa/', $namaFileAkte);
                if ($is_edit) {
                    if ($this->request->getPost('akte_lama') != 'default_akte.pdf') {
                        unlink('file/akte_siswa/' . $this->request->getPost('akte_lama'));
                    }
                }
            }
            if ($is_edit) {
                $this->SiswaModel->save([
                    'id_siswa' => $is_edit,
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
                    'id_kelas' => $this->request->getPost('id_kelas'),
                ]);
                session()->setFlashdata('pesan', 'Data Siswa berhasil diubah');
                return redirect()->to(base_url('/guru/students'));
            } else {
                $tglLahirPass = $this->request->getPost('tgl_lahir');
                $passwordConvert = Time::parse($tglLahirPass)->format('d-m-Y');
                $this->SiswaModel->insert([
                    'no_pendaftaran' => $this->request->getPost('no_pendaftaran'),
                    'nama' => $this->request->getPost('nama'),
                    'password' => password_hash($passwordConvert, PASSWORD_DEFAULT),
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
                    'id_role' => 3,
                    'id_kelas' => $this->request->getPost('id_kelas'),
                ]);
                session()->setFlashdata('pesan', 'Data Siswa berhasil di tambahkan!');
                return redirect()->to('/guru/students');
            }
        }
    }

    public function delete_student($no_pendaftaran)
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }

        $data_lama = $this->SiswaModel->GetData($no_pendaftaran);

        $this->SiswaModel->where('no_pendaftaran', $no_pendaftaran)->delete();
        if ($data_lama['gambar'] != 'default.png') {
            unlink('gambar/fotoCalonSiswa/' . $data_lama['gambar']);
        }

        if ($data_lama['kk_siswa'] != 'defaultkk.pdf') {
            unlink('file/kk_siswa/' . $data_lama['kk_siswa']);
        }

        if ($data_lama['akte'] != 'default_akte.pdf') {
            unlink('file/akte_siswa/' . $data_lama['akte']);
        }

        session()->setFlashdata('pesan', 'Data Siswa dihapus');

        return redirect()->to('/guru/students');
    }

    public function absence_attendance()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $data = [
            'title' => "Absensi | Siakad Paud Nurul Iman",
            'get_data' => $this->absensi_model->get_absence_data(),
            'get_data_kelas_a' => $this->SiswaModel->get_data_by_kelas(),
            'get_data_kelas_b' => $this->SiswaModel->get_data_by_kelas_b(),
            'get_thn_ajaran' => $this->thn_ajaran->get_data(),
        ];
        return view('Guru/absensi/index', $data);
    }

    public function add_absence_attendance()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $data = [
            'title' => "Tambah Data Absensi | Siakad Paud Nurul Iman",
        ];
        return view('Guru/absensi/add_absence_attendance', $data);
    }

    public function edit_absence_attendance($id)
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $data = [
            'title' => "Tambah Data Absensi | Siakad Paud Nurul Iman",
            'get_data' => $this->absensi_model->get_absence_data($id),
            'get_thn_ajaran' => $this->thn_ajaran->get_data(),
        ];

        return view('Guru/absensi/update_absence_attendance', $data);
    }

    public function submit_absence()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $is_edit = $this->request->getPost('id_absensi');
        $rules = [
            'id_siswa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Siswa harus dipilih terlebih dahulu!"
                ],
            ],
            'id_thn_ajaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Tahun Ajaran harus dipilih terlebih dahulu!"
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        } else {

            $id_siswa = $this->request->getPost('id_siswa');
            $id_thn_ajaran = $this->request->getPost('id_thn_ajaran');

            if ($is_edit) {
                $this->absensi_model->save([
                    'id_absensi' => $is_edit,
                    'id_siswa' => $this->request->getPost('id_siswa'),
                    'id_thn_ajaran' => $this->request->getPost('id_thn_ajaran'),
                    'hadir' => $this->request->getPost('hadir'),
                    'izin' => $this->request->getPost('izin'),
                    'alpha' => $this->request->getPost('alpha'),
                ]);
                session()->setFlashdata('pesan', 'Data Absensi berhasil diubah');
                return redirect()->to(base_url('/guru/absence_attendance'));
            } else {
                date_default_timezone_set('Asia/Jakarta');

                if ($this->cekAbsensi($id_siswa, $id_thn_ajaran, date('Y-m-d'))) {
                    session()->setFlashdata('gagal', "Ditambahkan! karena data hari ini sudah di masukan");
                    return redirect()->to(base_url('/guru/absence_attendance'));
                } else {
                    $this->absensi_model->insert([
                        'hari' => $this->request->getPost('hari'),
                        'id_siswa' => $this->request->getPost('id_siswa'),
                        'id_thn_ajaran' => $this->request->getPost('id_thn_ajaran'),
                        'hadir' => $this->request->getPost('hadir'),
                        'izin' => $this->request->getPost('izin'),
                        'alpha' => $this->request->getPost('alpha'),
                    ]);
                    session()->setFlashdata('pesan', 'Data Absensi berhasil ditambahkan');
                }
                return redirect()->to(base_url('/guru/absence_attendance'));
            }
        }
    }

    private function cekAbsensi($id_siswa, $id_thn_ajaran, $tanggal)
    {

        $result = $this->absensi_model->get_check($id_siswa, $id_thn_ajaran, $tanggal);

        // Mengembalikan nilai true jika absensi sudah ada, false jika belum
        return $result !== null;
    }

    public function delete_absence_attendance($id)
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }

        $this->absensi_model->delete($id);
        session()->setFlashdata('pesan', 'Dihapus Data Absensi');

        return redirect()->to(base_url('/guru/absence_attendance'));
    }

    public function profile()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Profile | Siakad Paud Nurul Iman',
            'data' => $this->UserModel->get_data_by_id(session()->get('id_user')),
        ];

        return view('Guru/profile/index', $data);
    }

    public function change_password()
    {
        $data = [
            'title' => "Rubah Password | Siakad Paud Nurul Iman"
        ];

        return view('Guru/profile/change_password', $data);
    }

    public function submit_profile()
    {
        if (session()->get('id_role') != 2) {
            return redirect()->back();
        }
        $is_edit = $this->request->getPost('id_user');
        $change_password  = $this->request->getPost('password');

        if ($change_password) {
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
        } else {
            $rules = [
                'nama_lengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Kolom Nama Lengkap harus terisi!",
                    ],
                ],
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => "Kolom Email harus terisi!",
                        'valid_email' => "Kolom Email harus valid!"
                    ],
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => "Kolom Alamat harus terisi!",
                    ],
                ],
                'no_telp' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => "Kolom No.Telp harus terisi!",
                        'numeric' => "Kolom harus bertipe angka"
                    ],
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {

            if ($change_password) {
                $password_lama = $this->request->getPost('password_lama');

                if ($change_password == $password_lama) {
                    session()->setFlashdata('gagal', 'Password Lama tidak boleh sama dengan password baru!');
                } else {
                    $this->UserModel->save([
                        'id_user' => session()->get('id_user'),
                        'password' => password_hash($change_password, PASSWORD_DEFAULT),
                    ]);
                    session()->setFlashdata('pesan', 'Password berhasil diubah!');
                }
                return redirect()->to(base_url('/guru/change_password'));
            } else {
                $file_gambar = $this->request->getFile('gambar');

                if ($file_gambar->getError() == 4) {
                    $nama_gambar = $this->request->getPost('gambar_lama');
                } else {
                    $nama_gambar = $file_gambar->getRandomName();
                    $file_gambar->move('gambar/admin_gambar/', $nama_gambar);

                    if ($this->request->getPost('gambar_lama') != 'default.png') {
                        unlink('gambar/admin_gambar/' . $nama_gambar['gambar']);
                    }
                }

                $this->UserModel->save([
                    'id_user' => $is_edit,
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'email' => $this->request->getPost('email'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'gambar' => $nama_gambar,
                ]);
                session()->setFlashdata('pesan', 'Mengubah data profile');
                return redirect()->to(base_url('/guru/profile'));
            }
        }
    }

    public function report_student()
    {
        $db = \Config\Database::connect();

        $result = $db->table('penilaian')
            ->select('penilaian.*, aspek.*, sub_aspek.*')
            ->join('aspek', 'penilaian.id_aspek = aspek.id_aspek')
            ->join('sub_aspek', 'penilaian.id_sub_aspek = sub_aspek.id_sub_aspek')
            ->get()
            ->getResultArray();
        $data = [
            'title' => "Rapot | Siakad Paud Nurul Iman",
            'result' =>  $result
        ];

        return view('Guru/rapot/index', $data);
    }

    public function submit_report()
    {
        dd($this->request->getPost());
    }
}
