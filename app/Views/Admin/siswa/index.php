<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Data Siswa</h5>
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
          <a class="btn btn-sm btn-primary mb-4" href="<?= base_url('/admin/tambah_siswa'); ?>">Tambah Siswa</a>
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px;">No</th>
                  <th class="text-center">No Pendaftaran</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Jenis Kelamin</th>
                  <th class="text-center">Nik</th>
                  <th class="text-center">Kelas/Kelompok</th>
                  <th class="text-center">Gambar</th>
                  <th class="text-center">Kartu Keluarga (KK)</th>
                  <th class="text-center">Akte</th>
                  <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data as $siswa) :  ?>

                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center"><?= $siswa['no_pendaftaran']; ?></td>
                    <td class="text-center"><?= $siswa['nama']; ?></td>
                    <td class="text-center"><?= $siswa['jenis_kel']; ?></td>
                    <td class="text-center"><?= $siswa['nik']; ?></td>
                    <td class="text-center">
                      <?php if (empty($siswa['id_kelas'])) :  ?>
                        <span class="badge badge-danger">Belum di pilih</span>
                      <?php else :  ?>
                        <?= $siswa['kelas'] . ' ' . $siswa['keterangan']; ?>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <img style="width: 100px;" src="<?= base_url('/gambar/fotoCalonSiswa/' . $siswa['gambar']); ?>" class="img-thumbnail">
                    </td>
                    <td class="text-center">
                      <?php if ($siswa['kk_siswa'] == 'defaultkk.pdf' || $siswa['kk_siswa'] == '') :  ?>
                        <span class="badge badge-danger">Belum Upload</span>
                      <?php else :  ?>
                        <a target="_blank" class="btn btn-md btn-primary" href="<?= base_url('file/akte_siswa/' . $siswa['kk_siswa']); ?>"><i class="fas fa-eye"></i></a>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <?php if ($siswa['akte'] == 'default_akte.pdf' || $siswa['akte'] == '') :  ?>
                        <span class="badge badge-danger">Belum Upload</span>
                      <?php else :  ?>
                        <a target="_blank" class="btn btn-md btn-primary" href="<?= base_url('file/akte_siswa/' . $siswa['akte']); ?>"><i class="fas fa-eye"></i></a>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <a class="btn btn-sm btn-warning btnEdit" href="<?= base_url('admin/edit/' . $siswa['no_pendaftaran']); ?>" title="Ubah Siswa"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-sm btn-danger btnDelete" href="<?= base_url('admin/hapus/' . $siswa['no_pendaftaran']); ?>" title="Hapus Siswa"><i class="fas fa-trash"></i></a>
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