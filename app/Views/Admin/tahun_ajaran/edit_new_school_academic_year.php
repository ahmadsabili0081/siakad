<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Ubah Tahun Ajaran Baru</h5>
  </div>
  <div class="row">
    <div class="col p-0">
      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('/admin/submit_new_school_academic_year'); ?>" method="post">
            <input type="hidden" name="id_thn_ajaran" value="<?= $get_data['id_thn_ajaran']; ?>">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="">Kelas</label>
              <select name="thn_ajaran" class="form-control">
                <option value="" selected>--Pilih Tahun Ajaran Baru--</option>
                <?php for ($tahun = 2023; $tahun <= date('Y'); $tahun++) : ?>
                  <?php if ($get_data['thn_ajaran'] == $tahun . '/' . ($tahun + 1)) :  ?>
                    <option value="<?= $tahun . '/' . ($tahun + 1); ?>" selected><?= $tahun . '/' . ($tahun + 1); ?></option>

                  <?php else :  ?>
                    <option value="<?= $tahun . '/' . ($tahun + 1); ?>"><?= $tahun . '/' . ($tahun + 1); ?></option>

                  <?php endif; ?>
                <?php endfor; ?>
              </select>
              <?php if (!empty(session('errors.thn_ajaran'))) :  ?>
                <small class="text-danger"><?= session('errors.thn_ajaran'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Semester</label>
              <input type="text" name="semester" placeholder="Genap" value="<?= $get_data['semester'] ? $get_data['semester'] : old('semester'); ?>" class="form-control <?= !empty(session('errors.semester')) ? 'is-invalid' : ''; ?>">
              <?php if (!empty(session('errors.semester'))) :  ?>
                <small class="text-danger"><?= session('errors.semester'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Status</label>
              <?php $status = ['1', '0']; ?>
              <select name="is_active" class="form-control">
                <?php foreach ($status as $s) :  ?>
                  <?php if ($s == $get_data['is_active']) :  ?>
                    <option value="<?= $s ?>"><?= $s == '1' ? "Aktif" : 'Tidak Aktif' ?></option>
                  <?php else :  ?>
                    <option value="<?= $s ?>"><?= $s == '1' ? "Aktif" : 'Tidak Aktif' ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
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