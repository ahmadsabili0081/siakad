<?= $this->extend('Templates/template_auth'); ?>

<?= $this->section('contentAuth'); ?>
<div class="row">
  <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <div class="login-brand">
      <img src="<?= base_url('/gambar/logo_pic.png'); ?>" alt="logo" width="100">
    </div>

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

    <div class="card card-primary">
      <div class="card-header">
        <h4>Login</h4>
      </div>

      <div class="card-body">
        <form method="POST" action="<?= base_url('/authsiswa/save_login'); ?>">
          <?= csrf_field(); ?>

          <div class="form-group">
            <label for="email">No.Pendaftaran</label>
            <input type="text" class="form-control <?= session('errors.no_pendaftaran') ? 'is-invalid' : ''; ?>" name="no_pendaftaran" value="<?= isset($no_pendaftaran) ? $no_pendaftaran :  old('no_pendaftaran'); ?>" placeholder="No Pendaftaran">
            <small class="text-danger"><?= session('errors.no_pendaftaran') ? session('errors.no_pendaftaran') : '<i>Gunakan No.Pendaftaran untuk Login!</i>'; ?></small>
          </div>

          <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password">
              <div class="input-group-append">
                <span style="cursor: pointer;" class="input-group-text" id="toggleIcon">
                  <i class="fas fa-eye-slash"></i>
                </span>
              </div>
            </div>
            <small class="text-danger"><?= session('errors.password') ? session('errors.password') : '<i>Gunakan Tahun Tanggal Lahir 28-12-2000.</i>'; ?></small>
          </div>


          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="mt-5 text-muted text-center">
      Belum Memiliki Akun? <a href="<?= base_url('/authsiswa/register_siswa'); ?>">Registrasi</a>
    </div>
    <div class="simple-footer">
      Copyright &copy; Auth Siswa Sistem Informasi Akademik Paud Nurul Iman <?= date('Y'); ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>