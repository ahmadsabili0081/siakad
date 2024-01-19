<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Ubah Data Absensi</h5>
  </div>
  <div class="row">
    <div class="col-md col-sm">
      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('/guru/submit_absence'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_absensi" value="<?= $get_data['id_absensi']; ?>">
            <div class="form-group">
              <label for="">Nama Siswa</label>
              <select name="id_siswa" class="form-control <?= session('errors.id_siswa') ? 'is-invalid' : ''; ?>">
                <option value="<?= $get_data['id_siswa'] ?>"><?= $get_data['nama']; ?></option>
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
                  <?php if ($data['id_thn_ajaran'] == $get_data['id_thn_ajaran']) :  ?>
                    <option value="<?= $get_data['id_thn_ajaran'] ?>" selected><?= $get_data['thn_ajaran'] . ' ' . $get_data['semester']; ?></option>
                  <?php else :  ?>
                    <option value="<?= $data['id_thn_ajaran'] ?>"><?= $data['thn_ajaran'] . ' ' . $data['semester']; ?></option>
                  <?php endif; ?>
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
                  <input type="radio" id="customRadioHadir" name="hadir" value="<?= true; ?>" class="custom-control-input" <?= ($get_data['hadir'] == true ? 'checked' : ''); ?>>
                  <label class="custom-control-label" for="customRadioHadir">Hadir</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioIzin" name="izin" value="<?= true; ?>" class="custom-control-input" <?= ($get_data['izin'] == true ? 'checked' : ''); ?>>
                  <label class="custom-control-label" for="customRadioIzin">Izin</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioAlpha" name="alpha" value="<?= true; ?> " class="custom-control-input" <?= ($get_data['alpha'] == true ? 'checked' : ''); ?>>
                  <label class="custom-control-label" for="customRadioAlpha">Alpha</label>
                </div>
              </div>
            </div>

            <a class="btn btn-sm btn-warning" href="<?= base_url('/guru/absence_attendance'); ?>">Kembali</a>
            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>