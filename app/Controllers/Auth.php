<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LoginPenggunaModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;
    protected $login_pengguna_model;
    protected $request;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->userModel = new UserModel();
        $this->login_pengguna_model = new LoginPenggunaModel();
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data = [
            'title' => "Auth | Siakad Nurul Iman",
        ];

        return view('Auth/index', $data);
    }

    public function save_login()
    {
        $rules = [
            'email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => "Kolom Email Harus Terisi!",
                    'valid_email' => "Kolom Email Harus Valid!"
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
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $dataUser = $this->userModel->getData($email);

            if (!empty($dataUser['email'])) {
                if (password_verify($password, $dataUser['password'])) {
                    $dataUserLogin = [
                        'email' => $dataUser['email'],
                        'id_role' => $dataUser['id_role'],
                        'gambar' => $dataUser['gambar'],
                        'nama_lengkap' => $dataUser['nama_lengkap'],
                        'id_user' => $dataUser['id_user'],
                    ];
                    $this->session->set($dataUserLogin);
                    if (!$dataUser['is_active'] == 1) {
                        return redirect()->back()->withInput()->with('gagal', 'Akun Anda Belum Di Aktifkan!');
                    } else {


                        $this->login_pengguna_model->save([
                            'id_user' => $dataUser['id_user'],
                            'id_role' => $dataUser['id_role'],
                            'browser' => $this->request->getUserAgent()->getBrowser(),
                            'platform' => $this->request->getUserAgent()->getPlatform(),
                            'ip_address' => $this->request->getIPAddress(),
                        ]);

                        if ($dataUser['id_role'] == 1) {
                            return redirect()->to('/admin');
                        } else if ($dataUser['id_role'] == 2) {
                            return redirect()->to('/guru');
                        } else {
                            return redirect()->to('/siswa');
                        }
                    }
                } else {
                    return redirect()->back()->withInput()->with('gagal', 'Password Yang Anda Masukan Tidak Terdaftar!');
                }
            } else {
                return redirect()->back()->withInput()->with('gagal', 'Email Yang Anda Masukan Tidak Terdaftar!');
            }
        }
    }


    public function registrasi()
    {
        $data = [
            'title' => "Auth | Siakad Nurul Iman",
        ];
        return  view('Auth/Registration', $data);
    }


    public function save_register()
    {
        $rules = [
            'nama_lengkap' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kolom Nama Lengkap Harus Terisi!',
                ],
            ],
            'username' => [
                'rules'  => 'required|is_unique[users.username]|trim',
                'errors' => [
                    'required' => 'Kolom Username Harus Terisi!',
                    'is_unique' => 'Username Yang Anda Masukan Sudah Terdaftar!'
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email]|trim',
                'errors' => [
                    'required' => 'Kolom Email Harus Terisi!',
                    'valid_email' => "Kolom Email Harus Valid!",
                    'is_unique' => 'Email Yang Anda Masukan Sudah Terdaftar!'
                ],
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kolom Alamat Harus Terisi!',
                ],
            ],
            'no_telp' => [
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom No.Telepon Harus Terisi!',
                    'numeric' => 'Kolom No.Telepon Harus Angka!',
                ],
            ],
            'password' => [
                'rules'  => 'required|trim|min_length[5]|matches[pass_confirm]',
                'errors' => [
                    'required' => 'Kolom Password Harus Terisi!',
                    'min_length' => 'Kolom Password Min 5 Karakter!',
                    'matches' => 'Kolom Password Harus Sama Dengan Konfirmasi Password!'
                ],
            ],
            'pass_confirm' => [
                'rules'  => 'required|trim|min_length[5]|matches[password]',
                'errors' => [
                    'required' => 'Kolom Konfirmasi Password Harus Terisi!',
                    'min_length' => 'Kolom Konfirmasi Password Min 5 Karakter!',
                    'matches' => 'Kolom Konfirmasi Password Harus Sama Dengan Password!'
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        } else {
            $data = [
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'alamat' => $this->request->getPost('alamat'),
                'no_telp' => $this->request->getPost('no_telp'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'gambar' => 'default.jpg',
                'is_active' => 1,
                'id_role' => 2
            ];
            $this->userModel->save($data);
            session()->setFlashdata('pesan', 'Registrasi Berhasil! Silahkan Login!');
            return redirect()->to('/auth');
        }
    }


    public function logout()
    {
        // Mengambil ID Role dari sesi
        $id_user = session()->get('id_user');
        $this->login_pengguna_model
            ->where('id_user', $id_user)
            ->where('is_active', true)
            ->set(['is_active' => false])
            ->update();

        // Pastikan ID Role tidak kosong

        $dataUserLogout = [
            'email',
            'id_role',
            'gambar',
            'nama_lengkap',
            'id_user'
        ];
        $this->session->remove($dataUserLogout);
        session()->setFlashdata('pesan', 'Logout Berhasil Di Lakukan!');
        return redirect()->to('/auth');
    }
}
