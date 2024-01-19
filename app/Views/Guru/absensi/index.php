<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Data Absensi</h5>
  </div>
  <div class="row">
    <div class="col p-0">

      <?php if (!empty(session()->getFlashdata('pesan'))) :  ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Berhasil</strong> <?= session()->getFlashdata('pesan'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if (!empty(session()->getFlashdata('gagal'))) :  ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Gagal</strong> <?= session()->getFlashdata('gagal'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
      <?php
      // Fungsi untuk mengembalikan nama hari dalam bahasa Indonesia
      function getNamaHari($index)
      {
        $namaHari = [
          'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
        ];

        return $namaHari[$index + 1];
      }

      // Mendapatkan indeks hari untuk hari ini (0 untuk Minggu, 1 untuk Senin, dst.)
      $indexHari = date('w');

      // Mendapatkan nama hari dalam bahasa Indonesia
      $namaHariIni = getNamaHari($indexHari);
      ?>

      <div class="card">
        <div class="card-body">
          <button type="button" class="btn btn-sm btn-primary my-4" data-toggle="modal" data-target="#exampleModal">
            Tambah Absensi Kelas A
          </button>
          <button type="button" class="btn btn-sm btn-warning ml-3 my-4" data-toggle="modal" data-target="#exampleModal_kelas_b">
            Tambah Absensi Kelas B
          </button>
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px;">No</th>
                  <th class="text-center">Nama Siswa</th>
                  <th class="text-center">Hari</th>
                  <th class="text-center">Hadir</th>
                  <th class="text-center">Izin</th>
                  <th class="text-center">Alpha</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($get_data as $data) :  ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center"><?= $data['nama']; ?></td>
                    <td class="text-center"><?= $data['hari']; ?></td>
                    <td class="text-center">
                      <?php if ($data['hadir'] == 1) :  ?>
                        <span class="text-success"><i class="fas fa-check"></i></span>
                      <?php else :  ?>
                        <span class="text-danger"><i class="fas fa-x"></i></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <?php if ($data['izin'] == 1) :  ?>
                        <span class="text-success"><i class="fas fa-check"></i></span>
                      <?php else :  ?>
                        <span class="text-danger"><i class="fas fa-x"></i></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <?php if ($data['alpha'] == 1) :  ?>
                        <span class="text-success"><i class="fas fa-check"></i></span>
                      <?php else :  ?>
                        <span class="text-danger"><i class="fas fa-x"></i></span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center"><?= $data['tanggal']; ?></td>
                    <td class="text-center">
                      <a class="btn btn-sm btn-warning btnEdit" href="<?= base_url('/guru/edit_absence_attendance/' . $data['id_absensi']); ?>"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-sm btn-danger btnDelete" href=" <?= base_url('/guru/delete_absence_attendance/' . $data['id_absensi']) ?>"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Absen Kelas A</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/guru/submit_absence'); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Hari</label>
            <input type="text" class="form-control" name="hari" value="<?= $namaHariIni; ?>" placeholder="Senin">
          </div>
          <div class="form-group">
            <label for="">Nama Siswa</label>
            <select name="id_siswa" class="form-control <?= session('errors.id_siswa') ? 'is-invalid' : ''; ?>">
              <option value="" selected>--Pilih Siswa--</option>
              <?php foreach ($get_data_kelas_a as $data) :  ?>
                <option value="<?= $data['id_siswa'] ?>"><?= $data['nama']; ?></option>
              <?php endforeach; ?>
            </select>
            <?php if (session('errors.id_siswa')) :  ?>
              <small class="text-danger"><?= session('errors.id_siswa'); ?></small>
            <?php endif; ?>
          </div>


          <div class="form-group">
            <label for="">Tahun Ajaran</label>
            <select name="id_thn_ajaran" class="form-control <?= session('errors.id_thn_ajaran') ? 'is-invalid' : ''; ?>">
              <option value="" selected>--Pilih Tahun Ajaran--</option>
              <?php foreach ($get_thn_ajaran as $data) :  ?>
                <option value="<?= $data['id_thn_ajaran'] ?>"><?= $data['thn_ajaran'] . ' ' . $data['semester']; ?></option>
              <?php endforeach; ?>
            </select>
            <?php if (session('errors.id_thn_ajaran')) :  ?>
              <small class="text-danger"><?= session('errors.id_thn_ajaran'); ?></small>
            <?php endif; ?>
          </div>


          <div class="form-group">
            <label for="kehadiran">Kehadiran</label>

            <div class="col">
              <div class="custom-control custom-radio custom-control-inline py-0">
                <input type="radio" id="customRadioHadir" name="hadir" value="<?= true; ?>" class="custom-control" checked> Hadir
              </div>

              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioIzin" name="izin" value="<?= true; ?>" class="custom-control"> Izin
              </div>

              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioAlpha" name="alpha" value="<?= true; ?>" class="custom-control"> Alpha
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>





<div class="modal fade" id="exampleModal_kelas_b" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Absen Kelas B</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/guru/submit_absence') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Hari</label>
            <input type="text" class="form-control" name="hari" value="<?= $namaHariIni; ?>" placeholder="Senin">
          </div>
          <div class="form-group">
            <label for="">Nama Siswa</label>
            <select name="id_siswa" class="form-control <?= session('errors.id_siswa') ? 'is-invalid' : ''; ?>">
              <option value="" selected>--Pilih Siswa--</option>
              <?php foreach ($get_data_kelas_b as $data) :  ?>
                <option value="<?= $data['id_siswa'] ?>"><?= $data['nama']; ?></option>
              <?php endforeach; ?>
            </select>
            <?php if (session('errors.id_siswa')) :  ?>
              <small class="text-danger"><?= session('errors.id_siswa'); ?></small>
            <?php endif; ?>
          </div>


          <div class="form-group">
            <label for="">Tahun Ajaran</label>
            <select name="id_thn_ajaran" class="form-control <?= session('errors.id_thn_ajaran') ? 'is-invalid' : ''; ?>">
              <option value="" selected>--Pilih Tahun Ajaran--</option>
              <?php foreach ($get_thn_ajaran as $data) :  ?>
                <option value="<?= $data['id_thn_ajaran'] ?>"><?= $data['thn_ajaran'] . ' ' . $data['semester']; ?></option>
              <?php endforeach; ?>
            </select>
            <?php if (session('errors.id_thn_ajaran')) :  ?>
              <small class="text-danger"><?= session('errors.id_thn_ajaran'); ?></small>
            <?php endif; ?>
          </div>


          <div class="form-group">
            <label for="kehadiran">Kehadiran</label>

            <div class="col">
              <div class="custom-control custom-radio custom-control-inline py-0">
                <input type="radio" id="customRadioHadirB" name="hadir" value="<?= true; ?>" class="custom-control" checked> Hadir
              </div>

              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioIzinB" name="izin" value="<?= true; ?>" class="custom-control"> Izin
              </div>

              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioAlphaB" name="alpha" value="<?= true; ?>" class="custom-control"> Alpha
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>