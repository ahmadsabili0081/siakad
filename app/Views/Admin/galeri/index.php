<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Data Galeri</h5>
  </div>
  <div class="row">
    <div class="col">



      <?php

      if (!empty(session()->getFlashdata('pesan'))) :  ?>
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
            Tambah Foto
          </button>
          <div class="table-responsive">
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center" style="width: 30px;">No</th>
                  <th class="text-center">Foto</th>
                  <th class="text-center">Status</th>
                  <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($get_data as $galeri) :  ?>
                  <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center">
                      <img class="img-thumbnail" style="width: 100px; height: 100px;" src="<?= base_url('/gambar/' . $galeri['galeri']); ?>" alt="">
                    </td>
                    <td class="text-center"><?= $galeri['is_active'] == true ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Tidak Aktif</span>"; ?></td>
                    <td>
                      <a class="btn btn-sm btn-warning btnEdit" href="<?= base_url('/admin/edit_galery/' . $galeri['id_galeri']); ?>"><i class="fas fa-edit"></i></a>
                      <a class="btn btn-sm btn-danger btnDelete" href="<?= base_url('/admin/delete_galery/' . $galeri['id_galeri']); ?>"><i class="fas fa-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/admin/submit_galery'); ?>" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="">Foto</label>
            <div class="col mx-0 my-2 px-0">
              <img class="img-thumbnail mx-0 displayedImages" style="width: 100px; height:100px;" src="<?= base_url('gambar/fotoCalonSiswa/default.png'); ?>">
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input inputImages <?= !empty(session('errors.galeri')) ? 'is-invalid' : ''; ?>" name="galeri" id="customFile">
              <label class="custom-file-label imagesStudentLabel" for="customFile">Choose file</label>
            </div>
            <?php if (!empty(session('errors.galeri'))) :  ?>
              <small class="text-danger"><?= session('errors.galeri'); ?></small>
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