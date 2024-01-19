<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GaleriModel;

class HomeController extends BaseController
{

    protected $galeri_model;
    public function __construct()
    {
        if (session()->get('id_role')) {
            if (session()->get('id_role') == 1 || session()->get('id_role') == 2 || session()->get('id_role') == 3) {
                return redirect()->back();
            }
        }
        $this->galeri_model = new GaleriModel();
    }

    public function index()
    {
        if (session()->get('id_role')) {
            if (session()->get('id_role') == 1 || session()->get('id_role') == 2 || session()->get('id_role') == 3) {
                return redirect()->back();
            }
        }
        $data = [
            'title' => "Home | Siakad Nurul Iman",
            'get_data' => $this->galeri_model->get_galeri_aktif(),
        ];
        return view('Home/index', $data);
    }
}
