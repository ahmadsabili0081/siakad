<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Pengguna</h5>
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
          <a class="btn btn-sm btn-primary mb-4" href="<?= base_url('/admin/add_user'); ?>">Tambah User</a>
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px;">No</th>
                  <th class="text-center">Nama Lengkap</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">Alamat</th>
                  <th class="text-center">Role</th>
                  <th class="text-center">Gambar</th>
                  <th class="text-center" style="width: 50px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($Userdata as $user) :  ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center"><?= $user['nama_lengkap']; ?></td>
                    <td class="text-center"><?= $user['email']; ?></td>
                    <td class="text-center"><?= $user['username']; ?></td>
                    <td class="text-center"><?= $user['alamat']; ?></td>
                    <td class="text-center"><?= $user['role']; ?></td>
                    <td class="text-center"><img style="width: 50px;" src="<?= base_url('/gambar/admin_gambar/' . $user['gambar']); ?>" class="img-thumbnail" alt=""></td>
                    <td>
                      <a class="btn btn-sm btn-warning btnEdit" href="<?= base_url('/admin/edit_user/' . $user['id_user']); ?>"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-sm btn-danger btnDelete" href="<?= base_url('/admin/delete_user/' . $user['id_user']); ?>"><i class="fas fa-trash"></i></a>
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