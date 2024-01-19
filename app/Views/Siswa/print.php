<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link rel="stylesheet" href="<?= base_url('/stisla/modules/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/stisla/modules/fontawesome/css/all.min.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url('/stisla//modules/datatables/datatables.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/stisla//modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css'); ?>">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url('/stisla/css/style.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/stisla/css/components.css'); ?>">
  <style>
    body {
      background-color: #fff;

    }

    header {
      margin-bottom: 20px;
    }


    .container_header {
      padding: 1px 0px 10px 0px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px double #606092;
      color: #606092;
    }

    .container_header .content_header {
      width: 80%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    table tr,
    th,
    td {
      padding: 0px;
    }

    @media print {
      .btn_back {
        display: none;
      }

      body {
        margin: 0;
        /* Hilangkan margin */
        padding: 5mm;
        /* Atur padding sesuai kebutuhan */
        size: A4;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="container_header">
      <div class="logo"><img style="width: 200px;" src="<?= base_url('/gambar/logo_pic.png'); ?>" alt=""></div>
      <div class="content_header">
        <h3 style="line-height: 40px;">PENDIDIKAN ANAK USIA DINI (PAUD)</h3>
        <h1 style="line-height: 20px;">KB PAUD NURUL IMAN CIBODAS</h1>
        <P style="line-height: 25px;">Sekretariat : Jl. Adi Pati Ukur RT.01/12 Kel. Uwung Jaya Kec. Cibodas Kota Tangerang - Banten</P>
        <p style="line-height: 0px;">Nomor Izin : 421.10 / Kep.06 - PAUDPNF / BPMPTSP / 2015</p>
      </div>
    </div>
  </header>
  <h3 class="text-center text-dark">BUKTI PENDAFTARAN ONLINE</h3>
  <h3 class="text-center text-dark">PENERIMAAN PESERTA DIDIK BARU</h3>
  <h3 class="text-center text-dark mb-5">TAHUN AJARAN <?= date('Y'); ?></h3>
  <div class="row">
    <div class="col p-0 text-dark">
      <div class="col print_view_template">
        <div class="col-md-12 col-sm">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td colspan="3"><img style="width : 150px; height:150px; " class="img-thumbnail img-fluid my-2" src="<?= base_url('/gambar/fotoCalonSiswa/' . $get_data['gambar']) ?>"></td>
              </tr>
              <tr>
                <th style="width: 100px;">Tanggal Daftar</th>
                <td style="width: 30px;">:</td>
                <td><?= $get_data['created_at']; ?></td>
              </tr>
              <tr>
                <th style="width: 100px;">No Pendaftaran</th>
                <td style="width: 30px;">:</td>
                <td><?= $get_data['no_pendaftaran']; ?></td>
              </tr>
              <tr>
                <th>Nama Lengkap</th>
                <td>:</td>
                <td><?= $get_data['nama']; ?></td>
              </tr>
              <tr>
                <th>Nomor Induk Kependudukan(NIK)</th>
                <td>:</td>
                <td><?= $get_data['nik']; ?></td>
              </tr>
              <tr>
                <th>Jenis Kelamin</th>
                <td>:</td>
                <td><?= $get_data['jenis_kel']; ?></td>
              </tr>
              <tr>
                <th>Tempat, Tanggal Lahir</th>
                <td>:</td>
                <td><?= $get_data['tmp_lahir'] . ', ' .  date('d-m-Y', strtotime($get_data['tgl_lahir'])); ?></td>
              </tr>
              <tr>
                <th>Agama</th>
                <td>:</td>
                <td><?= $get_data['agama']; ?></td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>:</td>
                <td><?= $get_data['alamat']; ?></td>
              </tr>
              <tr>
                <th>Nama Orang Tua</th>
                <td>:</td>
                <td><?= $get_data['nama_ayah']; ?></td>
              </tr>
              <tr>
                <th>No. Handphone</th>
                <td>:</td>
                <td><?= $get_data['no_telp']; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <b class="mx-5">
        Catatan <span class="text-danger">*</span> :
        <span> Bukti Pendaftaran ini harus dibawa saat registrasi Ulang</span>
      </b>
    </div>

  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      window.print()
    });
  </script>
  <script src="<?= base_url('/stisla/modules/jquery.min.js') ?>"></script>
  <script src="<?= base_url('/stisla/js/main.js') ?>"></script>
  <script src="<?= base_url('/stisla/modules/popper.js'); ?>"></script>
  <script src="<?= base_url('/stisla/modules/tooltip.js'); ?>"></script>
  <script src="<?= base_url('/stisla/modules/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('/stisla/modules/nicescroll/jquery.nicescroll.min.js'); ?>"></script>
  <script src="<?= base_url('/stisla/js/stisla.js'); ?>"></script>
</body>

</html>