<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Tambah Data Pengguna</h5>
  </div>
  <div class="row">
    <div class="col-md col-sm">
      <div class="card">
        <div class="card-body">
          <?php d(session('errors')); ?>
          <form action="<?= base_url('/admin/submit_user'); ?>" enctype="multipart/form-data" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="">Nama Lengkap</label>
              <input type="text" class="form-control <?= session('errors.nama_lengkap') ? 'is-invalid' : ''; ?>" name="nama_lengkap" value="<?= old('nama_lengkap'); ?>" placeholder="Ahmad sabili">
              <?php if (session('errors.nama_lengkap')) :  ?>
                <small class="text-danger"><?= session('errors.nama_lengkap'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="text" class="form-control <?= session('errors.email') ? 'is-invalid' : ''; ?>" name="email" value="<?= old('email'); ?>" placeholder="ahmadsabili0081@gmail.com">
              <?php if (session('errors.email')) :  ?>
                <small class="text-danger"><?= session('errors.email'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Username</label>
              <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username'); ?>" placeholder="ahmdsblii">
              <?php if (session('errors.username')) :  ?>
                <small class="text-danger"><?= session('errors.username'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Alamat</label>
              <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : ''; ?>" name="alamat" placeholder="Jl.Binong Raya"><?= old('alamat'); ?></textarea>
              <?php if (session('errors.alamat')) :  ?>
                <small class="text-danger"><?= session('errors.alamat'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">No Telp</label>
              <input type="text" class="form-control <?= session('errors.no_telp') ? 'is-invalid' : ''; ?>" name="no_telp" value="<?= old('no_telp'); ?>" placeholder="088291416251">
              <?php if (session('errors.no_telp')) :  ?>
                <small class="text-danger"><?= session('errors.no_telp'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : ''; ?>" name="password" placeholder="Password">
              <?php if (session('errors.password')) :  ?>
                <small class="text-danger"><?= session('errors.password'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Pilih Role</label>
              <select name="id_role" class="form-control <?= session('errors.id_role') ? 'is-invalid' : ''; ?>">
                <option value="" selected>--Pilih Role--</option>
                <?php foreach ($get_role as $role) :  ?>
                  <option value="<?= $role['id_role'] ?>"><?= $role['role']; ?></option>
                <?php endforeach; ?>
              </select>
              <?php if (session('errors.id_role')) :  ?>
                <small class="text-danger"><?= session('errors.id_role'); ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="">Foto</label>
              <div class="col mx-0 my-2 px-0">
                <img class="img-thumbnail mx-0 displayedImages" style="width: 100px; height:100px;" src="<?= base_url('gambar/fotoCalonSiswa/default.png'); ?>">
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input inputImages <?= !empty(session('errors.gambar')) ? 'is-invalid' : ''; ?>" name="gambar" id="customFile">
                <label class="custom-file-label imagesStudentLabel" for="customFile">Choose file</label>
              </div>
              <?php if (!empty(session('errors.gambar'))) :  ?>
                <small class="text-danger"><?= session('errors.gambar'); ?></small>
              <?php endif; ?>
            </div>

            <a class="btn btn-sm btn-warning" href="<?= base_url('/admin/users'); ?>">Kembali</a>
            <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>