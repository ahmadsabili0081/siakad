<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Profil</h5>
  </div>
  <div class="row">
    <div class="col p-0">

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
          <form action="<?= base_url('/guru/submit_profile'); ?>" enctype="multipart/form-data" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">
            <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">
            <div class="form-group">
              <label for="">Nama Lengkap</label>
              <input class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : '';  ?>" type="text" name="nama_lengkap" value="<?= $data['nama_lengkap'] ? $data['nama_lengkap'] : old('nama_lengkap'); ?>" placeholder="Ahmad sabili alghifari">
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input class="form-control <?= session('errors.email') ? 'is-invalid' : '';  ?>" type="text" name="email" value="<?= $data['email'] ? $data['email'] : old('email'); ?>" placeholder="ahmad@gmail.com">
            </div>

            <div class="form-group">
              <label for="">Alamat</label>
              <textarea name="alamat" class="form-control <?= session('errors.alamat') ? 'is-invalid' : '';  ?>" placeholder="Jl.Kerta Jaya II"><?= $data['alamat'] ? $data['alamat'] : old('alamat'); ?></textarea>
            </div>

            <div class="form-group">
              <label for="">No. Telepon</label>
              <input class="form-control <?= session('errors.no_telp') ? 'is-invalid' : '';  ?>" type="text" name="no_telp" value="<?= $data['no_telp'] ? $data['no_telp'] : old('no_telp'); ?>" placeholder="088291411273">
            </div>

            <div class="form-group">
              <label for="">Foto</label>
              <div class="col mx-0 my-2 px-0">
                <img class="img-thumbnail mx-0 displayedImages" style="width: 100px; height:100px;" src="<?= base_url('gambar/admin_gambar/default.png'); ?>">
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input inputImages <?= !empty(session('errors.gambar')) ? 'is-invalid' : ''; ?>" name="gambar" id="customFile">
                <label class="custom-file-label imagesStudentLabel" for="customFile"><?= $data['gambar'] != 'default.png' ? $data['gambar'] : 'Choose file'; ?></label>
              </div>
              <?php if (!empty(session('errors.gambar'))) :  ?>
                <small class="text-danger"><?= session('errors.gambar'); ?></small>
              <?php endif; ?>
            </div>

            <a class="btn btn-sm btn-warning" href="<?= base_url('/guru'); ?>">Kembali</a>
            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection(); ?>