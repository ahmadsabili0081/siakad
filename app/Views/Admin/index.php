<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Dashboard</h5>
  </div>
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Data Siswa</h4>
              </div>
              <?php
              $model_data_siswa = new \App\Models\SiswaModel();
              $result_siswa = $model_data_siswa->countAllResults();
              ?>
              <div class="card-body">
                <?= $result_siswa; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-users-line"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Karyawan</h4>
              </div>
              <?php
              $user_model = new \App\Models\UserModel();
              $result_user = $user_model->countAllResults();
              ?>
              <div class="card-body">
                <?= $result_user; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Pengguna Online</h4>
              </div>
              <?php
              $get_data_online = new \App\Models\LoginPenggunaModel();
              $result = $get_data_online->where('is_active', true)->countAllResults();
              ?>
              <div class="card-body">
                <?= $result; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
    </div>
  </div>
</section>
<?= $this->endSection(); ?>