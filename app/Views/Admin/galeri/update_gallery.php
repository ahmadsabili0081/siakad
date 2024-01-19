<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Edit Foto</h5>
  </div>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <form action="<?= base_url('/admin/submit_galery'); ?>" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <input type="hidden" name="gambar_lama" value="<?= $get_data['galeri']; ?>">
              <input type="hidden" name="id_galeri" value="<?= $get_data['id_galeri']; ?>">
              <div class="form-group">
                <label for="">Foto</label>
                <div class="col mx-0 my-2 px-0">
                  <img class="img-thumbnail mx-0 displayedImages" style="width: 100px; height:100px;" src="<?= base_url('gambar/' . $get_data['galeri']); ?>">
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input inputImages <?= !empty(session('errors.galeri')) ? 'is-invalid' : ''; ?>" name="galeri" id="customFile">
                  <label class="custom-file-label imagesStudentLabel" for="customFile"><?= $get_data['galeri']; ?></label>
                </div>
                <?php if (!empty(session('errors.galeri'))) :  ?>
                  <small class="text-danger"><?= session('errors.galeri'); ?></small>
                <?php endif; ?>
              </div>


              <div class="form-group">
                <label for="">Status</label>
                <select name="is_active" class="form-control">
                  <?php $status = ['1', '0']; ?>
                  <?php foreach ($status as $s) :  ?>
                    <?php if ($s == $get_data['is_active']) :  ?>
                      <option value="<?= $get_data['is_active'] ?>" selected><?= ($get_data['is_active'] == true ? "Aktif"  : "Tidak Aktif"); ?></option>
                    <?php else :  ?>
                      <option value="<?= $s ?>"><?= ($s == '1' ? "Aktif"  : "Tidak Aktif"); ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <a class="btn btn-warning" href="<?= base_url('/admin/group_gallery'); ?>">Tutup</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>