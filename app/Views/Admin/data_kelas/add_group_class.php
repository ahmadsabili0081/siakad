<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Tambah Data Kelas</h5>
  </div>
  <div class="row">
    <div class="col p-0">
      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('/admin/submit_group_class'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="">Kelas</label>
              <input type="text" name="kelas" placeholder="A" value="<?= old('kelas'); ?>" class="form-control <?= !empty(session('errors.kelas')) ? 'is-invalid' : ''; ?>">
              <?php if (!empty(session('errors.kelas'))) :  ?>
                <small class="text-danger"><?= session('errors.kelas'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Keterangan</label>
              <input type="text" name="keterangan" placeholder="Apel" value="<?= old('keterangan'); ?>" class="form-control <?= !empty(session('errors.keterangan')) ? 'is-invalid' : ''; ?>">
              <?php if (!empty(session('errors.keterangan'))) :  ?>
                <small class="text-danger"><?= session('errors.keterangan'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Guru</label>
              <select name="id_user" class="form-control <?= !empty(session('errors.id_user')) ? 'is-invalid' : ''; ?>">
                <option value="" selected>--Pilih Guru--</option>
                <?php foreach ($get_data as $data) :  ?>
                  <option value="<?= $data['id_user'] ?>"><?= $data['nama_lengkap']; ?></option>
                <?php endforeach; ?>
              </select>
              <?php if (!empty(session('errors.id_user'))) :  ?>
                <small class="text-danger"><?= session('errors.id_user'); ?></small>
              <?php endif; ?>
            </div>

            <a class="btn btn-sm btn-warning" href="<?= base_url('/admin/group_class'); ?>">Kembali</a>
            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>