<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GaleriModel;
use App\Models\UserModel;
use App\Models\SiswaModel;
use App\Models\PekerjaanModel;
use App\Models\PenghasilanModel;
use App\Models\PendidikanModel;
use App\Models\GetRoleModel;
use App\Models\KelasModel;
use App\Models\MenuModel;
use App\Models\ThnAjaranModel;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
    protected $UserModel;
    protected $SiswaModel;
    protected $pekerjaanModel;
    protected $penghasilanModel;
    protected $pendidikanModel;
    protected $roleModel;
    protected $kelas_model;
    protected $tahun_ajaran_model;
    protected $galeri_model;
    protected $menu_model;
    public function __construct()
    {

        helper(['custom', 'form', 'url']);
        $this->UserModel = new UserModel();
        $this->SiswaModel = new SiswaModel();
        $this->pekerjaanModel = new PekerjaanModel();
        $this->penghasilanModel = new PenghasilanModel();
        $this->pendidikanModel = new PendidikanModel();
        $this->roleModel = new GetRoleModel();
        $this->kelas_model = new KelasModel();
        $this->tahun_ajaran_model = new ThnAjaranModel();
        $this->galeri_model = new GaleriModel();
        $this->menu_model  = new MenuModel();
    }

    public function index()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Dashboard Admin | Siakad Paud Nurul Iman",

        ];
        return view('Admin/index', $data);
    }

    public function Users()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Pengguna | Siakad Paud Nurul Iman",
            'Userdata' => $this->UserModel->getData(),
        ];
        return view('Admin/users/index', $data);
    }

    public function add_user()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Tambah Pengguna | Siakad Paud Nurul Iman",
            'get_role' => $this->roleModel->get_role(),
        ];
        return view('Admin/users/add_user', $data);
    }

    public function edit_user($id)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Ubah Data Pengguna | Siakad Paud Nurul Iman",
            'get_role' => $this->roleModel->get_role(),
            'get_data' => $this->UserModel->get_data_by_id($id)
        ];
        if (!$data['get_data']) {
            session()->setFlashdata('gagal', 'Akun Pengguna tidak ditemukan atau Akun Pengguna di nonaktifkan');
            return redirect()->to(base_url('/admin/users'));
        }
        return view('Admin/users/update_user', $data);
    }

    public function submit_user()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }

        $is_edit = $this->request->getPost('id_user');
        if ($is_edit) {
            $rules_field_email = "required|trim|valid_email";
            $rules_field_username = "required|trim";
        } else {
            $rules_field_email = "required|trim|valid_email|is_unique[users.email]";
            $rules_field_username = "required|trim|is_unique[users.username]";
        }
        $rules = [
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Nama Lengkap harus terisi!"
                ],
            ],
            'email' => [
                'rules' => $rules_field_email,
                'errors' => [
                    'required' => "Kolom Email harus terisi!",
                    'valid_email' => "Kolom Email harus valid!",
                    'is_unique' => 'Email sudah terdaftar!'
                ],
            ],
            'username' => [
                'rules' => $rules_field_username,
                'errors' => [
                    'required' => "Kolom username harus terisi!",
                    'is_unique' => 'Username sudah terdaftar!'
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
                    'required' => "Kolom No Telp harus terisi!",
                    'numeric' => "Kolom No Telp harus angka!"
                ],
            ],
            'password' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => "Kolom Password harus terisi!",
                ],
            ],
            'id_role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Role harus dipilih terlebih dahulu!",
                ],
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,2048]|mime_in[gambar,image/png,image/jpg,image/jpeg]|ext_in[gambar,jpg,png,jpeg]',
                'errors' => [
                    'max_size' => "Ukuran Tidak boleh lebih dari 2MB!",
                    'mime_in' =>  "Gambar harus bertipe jpg,jpeg,png!",
                    'ext_in' => "File gambar harus memiliki .jpg, .png, .jpeg!"
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            if ($is_edit) {
                $image_user = $this->request->getFile('gambar');
                if ($image_user->getError() == 4) {
                    $image_name = $this->request->getPost('gambar_lama');
                } else {
                    $image_name = $image_user->getRandomName();
                    $image_user->move('gambar/admin_gambar/', $image_name);
                    if ($is_edit) {
                        if ($this->request->getPost('gambar_lama') != 'default.png') {
                            unlink('gambar/admin_gambar/' . $this->request->getPost('gambar_lama'));
                        }
                    }
                }

                $this->UserModel->save([
                    'id_user' => $is_edit,
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'email' => $this->request->getPost('email'),
                    'username' => $this->request->getPost('username'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'password' => $this->request->getPost('password'),
                    'gambar' => $image_name,
                    'id_role' => $this->request->getPost('id_role')
                ]);

                session()->setFlashdata('pesan', 'Data Pengguna berhasil di ubah');
            } else {
                $image_user = $this->request->getFile('gambar');
                if ($image_user->getError() == 4) {
                    $image_name = 'default.png';
                } else {
                    $image_name = $image_user->getRandomName();
                    $image_user->move('gambar/admin_gambar/', $image_name);
                }
                $this->UserModel->save([
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'email' => $this->request->getPost('email'),
                    'username' => $this->request->getPost('username'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'gambar' => $image_name,
                    'id_role' => $this->request->getPost('id_role')
                ]);

                session()->setFlashdata('pesan', 'Data Berhasil di tambahkan');
            }
            return redirect()->to(base_url('/admin/users'));
        }
    }

    public function delete_user($id)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data_user = $this->UserModel->get_data_by_id($id);
        if ($data_user['gambar'] != 'default.png') {
            unlink('gambar/admin_gambar/' . $data_user['gambar']);
        }

        $this->UserModel->delete($id);
        session()->setFlashdata('pesan', 'Data Pengguna berhasil dihapus');
        return redirect()->to(base_url('/admin/users'));
    }

    public function access_menu()
    {
        $data = [
            'title' => "Menu Akses | Siakad Paud Nurul Iman",
            'get_data' => $this->menu_model->get_akses(),
        ];
        return view('Admin/menu/index', $data);
    }

    public function access_menu_checked($id)
    {

        $db      = \Config\Database::connect();
        $db->table('sub_menu')
            ->where('id_sub_menu', $id)
            ->set('is_active', false)
            ->update();
        session()->setFlashdata('pesan', 'Merubah akses');
        return redirect()->to(base_url('/admin/access_menu'));
    }

    public function access_menu_checked_aktif($id)
    {

        $db      = \Config\Database::connect();
        $db->table('sub_menu')
            ->where('id_sub_menu', $id)
            ->set('is_active', true)
            ->update();
        session()->setFlashdata('pesan', 'Merubah akses');
        return redirect()->to(base_url('/admin/access_menu'));
    }

    public function siswa()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }

        $data = [
            'title' => 'Siswa | Siakad Paud Nurul Iman',
            'data' => $this->SiswaModel->GetData()
        ];
        return view('Admin/siswa/index', $data);
    }

    public function approve_student($id)
    {
        $this->SiswaModel->save([
            'id_siswa' => $id,
            'is_active' => true
        ]);
        session()->setFlashdata('pesan', 'Menerima data siswa baru');

        // Berikan informasi URL redirect dalam respons JSON
        $response = ['status' => 'success', 'redirect' => base_url('/admin/students')];
        return $this->response->setJSON($response);
    }

    public function tambah_siswa()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Tambah Siswa | Siakad Paud Nurul Iman",
            'no_pendaftaran' => $this->SiswaModel->getNomorPendaftaran(),
            'pekerjaan' => $this->pekerjaanModel->getDataPekerjaan(),
            'penghasilan' => $this->penghasilanModel->getDataPenghasilan(),
            'pendidikan' => $this->pendidikanModel->getDataPendidikan(),
            'get_kelas' => $this->kelas_model->get_kelas_oke(),
        ];
        return view('Admin/siswa/add_siswa', $data);
    }

    public function edit($no_pendaftaran)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Edit Siswa | Siakad Paud Nurul Iman",
            'get_data' => $this->SiswaModel->GetData($no_pendaftaran),
            'pekerjaan' => $this->pekerjaanModel->getDataPekerjaan(),
            'penghasilan' => $this->penghasilanModel->getDataPenghasilan(),
            'pendidikan' => $this->pendidikanModel->getDataPendidikan(),
            'get_kelas' => $this->kelas_model->get_kelas_oke(),
        ];
        return view('Admin/siswa/update_siswa', $data);
    }

    public function submit()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }

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
            $is_edit = $this->request->getPost('id_siswa');

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
                return redirect()->to(base_url('/admin/siswa'));
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
                    'id_kelas' => $this->request->getPost('id_kelas'),
                    'id_role' => 3,
                    'is_active' => true,
                ]);
                session()->setFlashdata('pesan', 'Data Siswa berhasil di tambahkan!');
                return redirect()->to('/admin/siswa');
            }
        }
    }

    public function hapus($no_pendaftaran)
    {
        if (session()->get('id_role') != 1) {
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

        return redirect()->to('/admin/siswa');
    }

    public function group_class()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Data Kelas | Siakad Paud Nurul Iman',
            'data' => $this->kelas_model->get_kelas(),
        ];
        return view('Admin/data_kelas/index', $data);
    }

    public function add_group_class()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Tambah Kelas | Siakad Paud Nurul Iman',
            'get_data' => $this->UserModel->getData(),
        ];
        return view('Admin/data_kelas/add_group_class', $data);
    }

    public function edit_group_class($id)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Edit Data Kelas | Siakad Paud Nurul Iman',
            'get_data' => $this->UserModel->getData(),
            'get_kelas' => $this->kelas_model->get_kelas($id)
        ];
        return view('Admin/data_kelas/update_group_class', $data);
    }

    public function delete_group_class($id)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $this->kelas_model->delete($id);
        session()->setFlashdata('pesan', 'Menghapus data kelas');
        return redirect()->to(base_url('/admin/group_class'));
    }

    public function submit_group_class()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $is_edit =  $this->request->getPost('id_kelas');
        if ($is_edit) {
            $rules = "required";
        } else {
            $rules = "required|is_unique[kelas.kelas]";
        }
        $rules = [
            'kelas' => [
                'rules' => $rules,
                'errors' => [
                    'required' => "Kolom Kelas harus terisi!",
                    'is_unique' => "{value} sudah terdaftar!"
                ],
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Keterangan harus terisi!",
                ],
            ],
            'id_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Guru harus terisi!",
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {

            if ($is_edit) {
                $this->kelas_model->save([
                    'id_kelas' => $is_edit,
                    'kelas' => $this->request->getPost('kelas'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'id_user' => $this->request->getPost('id_user')
                ]);
                session()->setFlashdata('pesan', 'Merubah data kelas');
            } else {
                $this->kelas_model->save([
                    'kelas' => $this->request->getPost('kelas'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'id_user' => $this->request->getPost('id_user')
                ]);
                session()->setFlashdata('pesan', 'Menambahkan data kelas');
            }
            return redirect()->to(base_url('/admin/group_class'));
        }
    }

    public function new_school_academic_year()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Data Tahun Ajaran Baru | Siakad Paud Nurul Iman',
            'data' => $this->tahun_ajaran_model->get_data(),
        ];
        return view('Admin/tahun_ajaran/index', $data);
    }


    public function edit_new_school_academic_year($id)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }

        $data = [
            'title' => 'Ubah Data Tahun Ajaran Baru | Siakad Paud Nurul Iman',
            'get_data' => $this->tahun_ajaran_model->get_data($id)
        ];
        return view('Admin/tahun_ajaran/edit_new_school_academic_year', $data);
    }

    public function delete_new_school_academic_year($id)
    {
        $this->tahun_ajaran_model->delete($id);
        session()->setFlashdata('pesan', 'Menghapus Tahun ajaran baru!');
        return redirect()->to(base_url('/admin/new_school_academic_year'));
    }

    public function submit_new_school_academic_year()
    {
        $is_edit = $this->request->getPost('id_thn_ajaran');
        $rules = [
            'thn_ajaran' => [
                'rules' => "required",
                'errors' => [
                    'required' => "{value} Harus terisi!"
                ],
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            if ($is_edit) {
                $this->tahun_ajaran_model->save([
                    'id_thn_ajaran' => $is_edit,
                    'thn_ajaran' => $this->request->getPost('thn_ajaran'),
                    'semester' => $this->request->getPost('semester'),
                    'is_active' => $this->request->getPost('is_active')
                ]);
                session()->setFlashdata('pesan', 'Mengubah Tahun ajaran baru!');
            } else {
                $this->tahun_ajaran_model->save([
                    'thn_ajaran' => $this->request->getPost('thn_ajaran'),
                    'semester' => $this->request->getPost('semester')
                ]);
                session()->setFlashdata('pesan', 'Menambahkan Tahun ajaran baru!');
            }
            return redirect()->to(base_url('/admin/new_school_academic_year'));
        }
    }

    public function profile()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Profile",
            'data' => $this->UserModel->get_data_by_id(session()->get('id_user')),
        ];
        return view('Admin/profile/index', $data);
    }

    public function submit_profile()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $is_edit = $this->request->getPost('id_user');

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

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
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
            return redirect()->to(base_url('/admin/profile'));
        }
    }

    public function change_password()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Rubah Password | Siakad Paud Nurul Iman"
        ];
        return view('Admin/profile/change_password', $data);
    }

    public function submit_password()
    {
        if (session()->get('id_role') != 1) {
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
                $this->UserModel->save([
                    'id_user' => session()->get('id_user'),
                    'password' => password_hash($password_baru, PASSWORD_DEFAULT),
                ]);
                session()->setFlashdata('pesan', 'Password berhasil diubah!');
            }
            return redirect()->to(base_url('/admin/change_password'));
        }
    }

    public function group_gallery()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Data Gallery | Siakad Paud Nurul Iman",
            'get_data' => $this->galeri_model->get_galeri(),
        ];

        return view('Admin/galeri/index', $data);
    }

    public function edit_galery($id)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $data = [
            'title' => "Edit Data Gallery | Siakad Paud Nurul Iman",
            'get_data' => $this->galeri_model->get_galeri($id),
        ];

        return view('Admin/galeri/update_gallery', $data);
    }

    public function submit_galery()
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $is_edit = $this->request->getPost('id_galeri');

        $rules = [
            'galeri' => [
                'rules' => 'max_size[galeri,2048]|mime_in[galeri,image/png,image/jpg,image/jpeg]|ext_in[galeri,jpg,png,jpeg]',
                'errors' => [
                    'max_size' => "Ukuran Tidak boleh lebih dari 2MB!",
                    'mime_in' =>  "Gambar harus bertipe jpg,jpeg,png!",
                    'ext_in' => "File gambar harus memiliki .jpg, .png, .jpeg!"
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('gagal', 'Mengupload Gambar');
            return redirect()->back()->with('errors', $this->validator->getErrors());
        } else {
            if ($is_edit) {


                $galeri_file = $this->request->getFile('galeri');

                if ($galeri_file->getError() == 4) {
                    $nama_galeri = $this->request->getPost('gambar_lama');
                } else {
                    $nama_galeri = $galeri_file->getRandomName();
                    $galeri_file->move('gambar/', $nama_galeri);
                    if ($this->request->getPost('gambar_lama') != 'default.jpg') {
                        unlink('gambar/' . $this->request->getPost('gambar_lama'));
                    }
                }


                $this->galeri_model->save([
                    'id_galeri' => $is_edit,
                    'galeri' => $nama_galeri,
                    'is_active' => $this->request->getPost('is_active') == '0' ? false  : true

                ]);
                session()->setFlashdata('pesan', 'Mengubah Foto');
            } else {
                $galeri_file = $this->request->getFile('galeri');
                if ($galeri_file->getError() == 4) {
                    $nama_galeri = 'default.jpg';
                } else {
                    $nama_galeri = $galeri_file->getRandomName();
                    $galeri_file->move('gambar/', $nama_galeri);
                }
                $this->galeri_model->save([
                    'galeri' => $nama_galeri
                ]);
                session()->setFlashdata('pesan', 'Menambahkan Foto');
            }
            return redirect()->to(base_url('/admin/group_gallery'));
        }
    }

    public function delete_galery($id)
    {
        if (session()->get('id_role') != 1) {
            return redirect()->back();
        }
        $galeri_lama =   $this->galeri_model->get_galeri($id);
        if ($galeri_lama['galeri'] != 'default.jpg') {
            unlink('gambar/' . $galeri_lama['galeri']);
        }
        $this->galeri_model->delete($id);
        session()->setFlashdata('pesan', 'Menghapus Foto');
        return redirect()->to(base_url('/admin/group_gallery'));
    }
}
