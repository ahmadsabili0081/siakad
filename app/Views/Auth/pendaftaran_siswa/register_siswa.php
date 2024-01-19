<?= $this->extend('Templates/template_auth'); ?>

<?= $this->section('contentAuth'); ?>
<div class="row">
  <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
    <div class="login-brand">
      <img src="<?= base_url('/gambar/logo_pic.png'); ?>" alt="logo" width="100">
    </div>

    <div class="card card-primary">
      <div class="card-header">
        <h4>Register</h4>
      </div>

      <div class="card-body">
        <form action="<?= base_url('/authsiswa/save_registration'); ?>" method="POST">
          <?= csrf_field(); ?>
          <div class="form-group">
            <label>No.Pendaftaran</label>
            <input id="no pendaftaran" type="text" value="<?= $noPendaftaran; ?>" class="form-control" name="no_pendaftaran" readonly>
          </div>
          <div class="row">
            <div class="form-group col-6">
              <label>Nama Depan <span class="text-danger">*</span></label>
              <input type="text" class="form-control <?= session('errors.nama_depan') ? 'is-invalid' : ''; ?>" name="nama_depan" placeholder="Ahmad sabili">
              <small class="text-danger"><?= session('errors.nama_depan'); ?></small>
            </div>
            <div class="form-group col-6">
              <label>Nama Belakang <span class="text-danger">*</span></label>
              <input type="text" class="form-control <?= session('errors.nama_belakang') ? 'is-invalid' : ''; ?>" name="nama_belakang" placeholder="Alghifari">
              <small class="text-danger"><?= session('errors.nama_belakang'); ?></small>
            </div>
          </div>
          <div class="form-group">
            <label for="">Jenis Kelamin <span class="text-danger">*</span></label>
            <select name="jenis_kel" class="form-control <?= session('errors.jenis_kel') ? 'is-invalid' : '';  ?>">
              <option value="" selected>--Pilih Jenis Kelamin--</option>
              <option value="Laki-Laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            <small class="text-danger"><?= session('errors.jenis_kel'); ?></small>
          </div>
          <div class="form-group">
            <label for="no pendaftaran">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nik') ? 'is-invalid' : ''; ?>" name="nik" placeholder="3671092812000003">
            <small class="text-danger"><?= session('errors.nik'); ?></small>
          </div>
          <div class="row">
            <div class="form-group col-6">
              <label for="frist_name">Tempat Lahir <span class="text-danger">*</span></label>
              <input type="text" class="form-control <?= session('errors.tmp_lahir') ? 'is-invalid' : ''; ?>" name="tmp_lahir" placeholder="Jakarta">
              <small class="text-danger"><?= session('errors.tmp_lahir'); ?></small>
            </div>
            <div class="form-group col-6">
              <label for="last_name">Tanggal Lahir <span class="text-danger">*</span></label>
              <input type="date" class="form-control" name="tgl_lahir">
            </div>
          </div>
          <div class="form-group">
            <label for="">Alamat</label>
            <textarea name="alamat" class="form-control <?= session('errors.tmp_lahir') ? 'is-invalid' : ''; ?>"></textarea>
            <small class="text-danger"><?= session('errors.alamat'); ?></small>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="mt-5 text-muted text-center">
      Sudah Memiliki Akun? <a href="<?= base_url('/authsiswa'); ?>">Login</a>
    </div>
    <div class="simple-footer">
      Copyright &copy; Auth Siswa Sistem Informasi Akademik Paud Nurul Iman <?= date('Y'); ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>