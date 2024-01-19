<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Data Kelas</h5>
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
          <a class="btn btn-sm btn-primary mb-4" href="<?= base_url('/admin/add_group_class'); ?>">Tambah Kelas</a>
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px;">No</th>
                  <th class="text-center">Kelas</th>
                  <th class="text-center">Keterangan</th>
                  <th class="text-center">Guru</th>
                  <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data as $kelas) :  ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center"><?= $kelas['kelas'] ?></td>
                    <td class="text-center"><?= $kelas['keterangan']; ?></td>
                    <td class="text-center"><?= $kelas['nama_lengkap']; ?></td>
                    <td class="text-center">
                      <a class="btn btn-sm btn-warning btnEdit" href="<?= base_url('/admin/edit_group_class/' . $kelas['id_kelas']); ?>"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-sm btn-danger btnDelete" href="<?= base_url('/admin/delete_group_class/' . $kelas['id_kelas']) ?>"><i class="fas fa-trash"></i></a>
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
<?= $this->endSection(); ?>