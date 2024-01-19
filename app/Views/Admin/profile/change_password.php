<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Ubah Password</h5>
  </div>
  <div class="row">
    <div class="col p-0">

      <?php

      if (!empty(session()->getFlashdata('pesan'))) :  ?>
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

      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('/admin/submit_password'); ?>" method="post">
            <?= csrf_field(); ?>

            <div class="form-group">
              <label for="">Password Lama</label>
              <input type="password" class="form-control <?= session('errors.password_lama') ? 'is-invalid' : ''; ?>" name="password_lama" placeholder="Password Lama">
              <?php if (!empty(session('errors.password_lama'))) :  ?>
                <small class="text-danger"><?= session('errors.password_lama'); ?></small>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="">Password Baru</label>
              <input type="password" class="form-control  <?= session('errors.password') ? 'is-invalid' : ''; ?>" name="password" placeholder="Password Baru">
              <?php if (!empty(session('errors.password'))) :  ?>
                <small class="text-danger"><?= session('errors.password'); ?></small>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="">Konfirmasi Lama</label>
              <input type="password" class="form-control <?= session('errors.konfirm_password') ? 'is-invalid' : ''; ?>" name="konfirm_password" placeholder="Konfirmasi Password">
              <?php if (!empty(session('errors.konfirm_password'))) :  ?>
                <small class="text-danger"><?= session('errors.konfirm_password'); ?></small>
              <?php endif; ?>
            </div>

            <a class="btn btn-sm btn-warning" href="<?= base_url('/admin'); ?>">Kembali</a>
            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection(); ?>