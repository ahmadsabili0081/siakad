<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use CodeIgniter\I18n\Time;
use App\Models\LoginPenggunaModel;

class Authsiswa extends BaseController
{
    protected $SiswaModel;
    protected $session;
    protected $login_pengguna_model;
    public function __construct()
    {
        helper(['form', 'url']);
        $this->SiswaModel = new SiswaModel();
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->login_pengguna_model = new LoginPenggunaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Auth | Siakad Paud Nurul Iman',
            'no_pendaftaran' => $this->request->getGet('no_pendaftaran'),
        ];
        return view('Auth/pendaftaran_siswa/index', $data);
    }

    public function save_login()
    {
        $rules = [
            'no_pendaftaran' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => "Kolom No.Pendaftaran Harus Terisi!"
                ],
            ],
            'password' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => "Kolom Password Harus Terisi!"
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $noPendaftaran = $this->request->getPost('no_pendaftaran');
            $password = $this->request->getPost('password');
            $UserData = $this->SiswaModel->GetData($noPendaftaran);
            if ($UserData) {
                if (password_verify($password, $UserData['password'])) {
                    if ($UserData['is_active'] == 1) {
                        $dataSessionArray = [
                            'no_pendaftaran' => $UserData['no_pendaftaran'],
                            'nama' => $UserData['nama'],
                            'gambar' => $UserData['gambar'],
                            'id_role' => $UserData['id_role'],
                            'id_siswa' => $UserData['id_siswa'],

                        ];
                        $this->session->set($dataSessionArray);
                        if ($dataSessionArray['id_role'] == 3) {
                            if (empty($UserData['kk_siswa']) || empty($UserData['akte']) || empty($UserData['email_pribadi']) || empty($UserData['no_telp']) || empty($UserData['nama_ayah']) || empty($UserData['nama_ibu'])) {
                                session()->setFlashdata('notification', 'Mohon Lengkapi Data Profile Terlebih Dahulu!');
                            }


                            $this->login_pengguna_model->save([
                                'id_role' => $UserData['id_role'],
                                'id_siswa' => $UserData['id_siswa'],
                                'platform' => $this->request->getUserAgent()->getPlatform(),
                                'browser' => $this->request->getUserAgent()->getBrowser(),
                                'ip_address' => $this->request->getIPAddress(),
                            ]);
                            return redirect()->to('/siswa');
                        }
                    } else {
                        session()->setFlashdata('gagal', 'Akun Anda Di Nonaktifkan! Hubungi Admin Untuk Mengatifkan!');
                        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                    }
                } else {
                    session()->setFlashdata('gagal', 'Password Yang Anda Masukan Tidak Terdaftar!');
                    return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                }
            } else {
                session()->setFlashdata('gagal', 'No.Pendaftaran Yang Anda Masukan Tidak Terdaftar!');
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
        }
    }

    public function register_siswa()
    {
        $data = [
            'title' => 'Auth | Siakad Paud Nurul Iman',
            'noPendaftaran' => $this->SiswaModel->getNomorPendaftaran()
        ];
        return view('Auth/pendaftaran_siswa/register_siswa', $data);
    }

    public function save_registration()
    {
        $rules = [
            'nama_depan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Nama Depan Harus Terisi!",
                ],
            ],
            'nama_belakang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Nama Belakang Harus Terisi!",
                ],
            ],
            'jenis_kel' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Pilih Jenis Kelamin!",
                ],
            ],
            'nik' => [
                'rules' => 'required|min_length[15]',
                'errors' => [
                    'required' => "Kolom NIK Harus Terisi!",
                    'min_length' => "Min Panjang Angka Harus 15!"
                ],
            ],
            'tmp_lahir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Tempat Lahir Harus Terisi!",
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => "Kolom Alamat Harus Terisi!",
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $passwordConvert = Time::parse($tgl_lahir)->format('d-m-Y');
            $data = [
                'no_pendaftaran' => $this->request->getPost('no_pendaftaran'),
                'nama' => $this->request->getPost('nama_depan') . ' ' . $this->request->getPost('nama_belakang'),
                'jenis_kel' => $this->request->getPost('jenis_kel'),
                'nik' => $this->request->getPost('nik'),
                'tmp_lahir'  => $this->request->getPost('tmp_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'kk_siswa' => 'defaultkk.pdf',
                'akte' => 'default_akte.pdf',
                'alamat' => $this->request->getPost('alamat'),
                'password' => password_hash($passwordConvert, PASSWORD_DEFAULT),
                'id_role' => 3
            ];
            $this->SiswaModel->save($data);
            session()->setFlashdata('pesan', 'Anda Berhasil Registrasi! Silahkan Login');
            return redirect()->to(base_url('/authsiswa?no_pendaftaran=' . $this->request->getPost('no_pendaftaran')));
        }
    }

    public function logout()
    {
        $id_siswa = session()->get('id_siswa');
        $this->login_pengguna_model
            ->where('id_siswa', $id_siswa)
            ->where('is_active', true)
            ->set(['is_active' => false])
            ->update();
        $dataSession = [
            'no_pendaftaran',
            'nama',
            'gambar',
            'id_role',
            'id_siswa'
        ];
        $this->session->remove($dataSession);
        session()->setFlashdata('pesan', 'Logout Berhasil Di Lakukan!');
        return redirect()->to(base_url('/authsiswa'));
    }
}
