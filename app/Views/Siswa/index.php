<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Dashboard Siswa</h5>
  </div>
  <div class="row">
    <div class="col">

      <div class="col-lg col-md-6 col-sm-6 col-12">
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
</section>
<?= $this->endSection(); ?>