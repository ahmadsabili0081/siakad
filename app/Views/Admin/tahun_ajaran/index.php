<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Data Tahun Ajaran Baru</h5>
  </div>
  <div class="row">
    <div class="col p-0">

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

      <div class="card">
        <div class="card-body">
          <button type="button" class="btn btn-sm btn-primary my-4" data-toggle="modal" data-target="#exampleModal">
            Tambah Tahun Ajaran Baru
          </button>
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px;">No</th>
                  <th class="text-center">Tahun Ajaran</th>
                  <th class="text-center">Semester</th>
                  <th class="text-center">Status</th>
                  <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data as $tahun) :  ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center"><?= $tahun['thn_ajaran'] ?></td>
                    <td class="text-center"><?= $tahun['semester']; ?></td>
                    <td class="text-center"><?= $tahun['is_active'] == 1 ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Tidak Aktif</span>"; ?></td>
                    <td class="text-center">
                      <a class="btn btn-sm btn-warning btnEdit" href="<?= base_url('/admin/edit_new_school_academic_year/' . $tahun['id_thn_ajaran']); ?>"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-sm btn-danger btnDelete" href="<?= base_url('/admin/delete_new_school_academic_year/' . $tahun['id_thn_ajaran']) ?>"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/admin/submit_new_school_academic_year'); ?>" method="post">
        <div class="modal-body">
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

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>