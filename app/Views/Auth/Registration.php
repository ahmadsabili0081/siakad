<?= $this->extend('Templates/template_auth'); ?>

<?= $this->section('contentAuth'); ?>
<div class="row">
  <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
    <div class="login-brand">
      <img src="<?= base_url('/gambar/logo_pic.png'); ?>" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>

    <div class="card card-primary">
      <div class="card-header">
        <h4>Registrasi</h4>
      </div>

      <div class="card-body">

        <form action="<?= base_url('/auth/save_register'); ?>" method="post">
          <?= csrf_field() ?>
          <div class="form-group">
            <label for="username">Nama Lengkap</label>
            <input type="text" class="form-control <?php if (session('errors.nama_lengkap')) : ?>is-invalid<?php endif ?>" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= old('nama_lengkap') ?>">
            <small class="text-danger"><?= session('errors.nama_lengkap'); ?></small>
          </div>
          <div class="form-group">
            <label for="email"><?= lang('Auth.email') ?></label>
            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
            <small class="text-danger"><?= session('errors.email'); ?></small>
          </div>

          <div class="form-group">
            <label for="username"><?= lang('Auth.username') ?></label>
            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
            <small class="text-danger"><?= session('errors.username'); ?></small>
          </div>

          <div class="form-group">
            <label for="alamat_user">Alamat Lengkap</label>
            <textarea name="alamat" class="form-control <?= (session('errors.alamat') ? old('value')  : ''); ?>" placeholder="Jl.Kerta Jaya II No.2 RT.002/13"><?= !empty(session('errors.alamat')) ? old('alamat') : ''; ?></textarea>
            <small class="text-danger"><?= session('errors.alamat'); ?></small>
          </div>
          <div class="form-group">
            <label for="username">No. Telephone</label>
            <input type="text" class="form-control <?php if (session('errors.no_telp')) : ?>is-invalid<?php endif ?>" name="no_telp" placeholder="No. Telephone" value="<?= old('no_telp') ?>">
            <small class="text-danger"><?= session('errors.no_telp'); ?></small>
          </div>
          <div class="form-group">
            <label for="password"><?= lang('Auth.password') ?></label>
            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
            <small class="text-danger"><?= session('errors.password'); ?></small>
          </div>

          <div class="form-group">
            <label for="pass_confirm">Konfirmasi Password</label>
            <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="Konfirmasi Password" autocomplete="off">
            <small class="text-danger"><?= session('errors.pass_confirm'); ?></small>
          </div>

          <br>

          <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
        </form>
      </div>
      <div class="text-muted text-center">
        <p>Sudah Memiliki Akun? <a href="<?= base_url('/auth'); ?>">Login</a></p>
      </div>
    </div>
    <div class="simple-footer">
      Copyright &copy; Sistem Informasi Akademik Paud Nurul Iman <?= date('Y'); ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>