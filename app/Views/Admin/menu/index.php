<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Akses Pengguna</h5>
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
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px;">No</th>
                  <th class="text-center">Menu</th>
                  <th class="text-center">Nama Sub Menu</th>
                  <th class="text-center">Role</th>
                  <th class="text-center" style="width: 50px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no  = 1; ?>
                <?php foreach ($get_data as $data) :  ?>
                  <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $data['menu'] ?></td>
                    <td class="text-center"><?= $data['nama_sub'] ?></td>
                    <td class="text-center"><?= $data['role']; ?></td>
                    <td class="text-center">
                      <div class="form-group">
                        <?php if ($data['is_active'] == true) :  ?>
                          <a class="btn btn-sm btn-danger non_aktif" href="<?= base_url('/admin/access_menu_checked/' . $data['id_sub_menu']); ?>"><i class="fas fa-x"></i></a>
                        <?php else : ?>
                          <a class="btn btn-sm btn-success aktif" href="<?= base_url('/admin/access_menu_checked_aktif/' . $data['id_sub_menu']); ?>"><i class="fas fa-check"></i></a>
                        <?php endif; ?>
                      </div>
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