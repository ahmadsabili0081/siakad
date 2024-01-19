<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Tambah Absensi</h5>
  </div>
  <div class="row">
    <div class="col-md col-sm">
      <div class="card">
        <div class="card-body">

          <form action="<?= base_url('/guru/submit_absence'); ?>" method="post">
            <?= csrf_field(); ?>

            <div class="table-responsive">
              <table class="table table-striped" id="table-2">
                <thead>
                  <tr>
                    <th class="text-center">Aspek</th>
                    <th class="text-center">Sub-Aspek</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">BM</th>
                    <th class="text-center">MM</th>
                    <th class="text-center">SM</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Motorik</td>
                    <td>Motorik Kasar</td>
                    <td>Motorik Halus</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>

          </form>
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