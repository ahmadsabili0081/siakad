<?= $this->extend('Templates/template_auth'); ?>

<?= $this->section('contentAuth'); ?>
<div class="row">
  <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <div class="login-brand">
      <img src="<?= base_url('/gambar/logo_pic.png'); ?>" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>
    <?php if (session()->getFlashdata('pesan')) :  ?>
      <div class="alert alert-success notif" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('gagal')) :  ?>
      <div class="alert alert-danger notif" role="alert">
        <?= session()->getFlashdata('gagal'); ?>
      </div>
    <?php endif; ?>


    <div class="card card-primary">
      <div class="card-header">
        <h4>Login</h4>
      </div>

      <div class="card-body">

        <form action="<?= base_url('/auth/save_login') ?>" method="post">
          <?= csrf_field() ?>

          <div class="form-group">
            <label for="email"><?= lang('Auth.email') ?></label>
            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" value="<?= old('email'); ?>" placeholder="<?= lang('Auth.email') ?>">
            <small class="text-danger"><?= session('errors.email'); ?></small>
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
            <?php if (!empty(session('errors.password'))) :  ?>
              <small class="text-danger"><?= session('errors.password'); ?></small>
            <?php endif; ?>

          </div>
          <br>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </form>
      </div>
      <div class="text-muted text-center">
        <p>Belum Memiliki Akun? <a href="<?= base_url('/auth/registrasi') ?>">Registrasi</a></p>
      </div>
      <div class="simple-footer">
        Copyright &copy; Sistem Informasi Akademik Paud Nurul Iman <?= date('Y'); ?>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>