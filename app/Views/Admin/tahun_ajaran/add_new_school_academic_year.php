<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Tambah Tahun Ajaran Baru</h5>
  </div>
  <div class="row">
    <div class="col p-0">
      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('/admin/submit_new_school_academic_year'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="">Tahun Ajaran</label>
              <select name="thn_ajaran" class="form-control">
                <option value="" selected>--Pilih Tahun Ajaran Baru--</option>
                <?php for ($tahun = 2023; $tahun <= date('Y'); $tahun++) : ?>
                  <option value="<?= $tahun . '/' . ($tahun + 1); ?>"><?= $tahun . '/' . ($tahun + 1); ?></option>
                <?php endfor; ?>
              </select>
              <?php if (!empty(session('errors.thn_ajaran'))) :  ?>
                <small class="text-danger"><?= session('errors.thn_ajaran'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Semester</label>
              <input type="text" name="semester" placeholder="Genap" value="<?= old('semester'); ?>" class="form-control <?= !empty(session('errors.semester')) ? 'is-invalid' : ''; ?>">
              <?php if (!empty(session('errors.semester'))) :  ?>
                <small class="text-danger"><?= session('errors.semester'); ?></small>
              <?php endif; ?>
            </div>

            <a class="btn btn-sm btn-warning" href="<?= base_url('/admin/new_school_academic_year'); ?>">Kembali</a>
            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>