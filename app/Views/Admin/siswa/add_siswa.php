<?= $this->extend('Templates/template'); ?>
<?php


$pekerjaanAyah = $pekerjaan;
$penghasilanAyah = $penghasilan;
$pendidikanAyah = $pendidikan;

$pekerjaanIbu = $pekerjaan;
$penghasilanIbu = $penghasilan;
$pendidikanIbu = $pendidikan;

?>
<?= $this->section('contentPage'); ?>
<section class="section">
  <div class="section-header">
    <h5>Biodata Siswa</h5>
  </div>
  <div class="row">
    <div class="col">

      <div class="card">
        <form action="<?= base_url('/admin/submit'); ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <div class="card-body row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">No Pendaftaran</label>
                <input type="text" class="form-control" value="<?= $no_pendaftaran; ?>" name="no_pendaftaran" readonly>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label for="">Nama Lengkap</label>
                  <input type="text" class="form-control <?= !empty(session('errors.nama')) ? 'is-invalid' : ''; ?>" name="nama" placeholder="Ahmad Sabili" value="<?= old('nama'); ?>">
                  <?php if (!empty(session('errors.nama'))) :  ?>
                    <small class="text-danger"><?= session('errors.nama'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="">Email</label>
                  <input type="text" class="form-control <?= !empty(session('errors.email_pribadi')) ? 'is-invalid' : ''; ?>" name="email_pribadi" placeholder="Ahmad Sabili" value="<?= old('email_pribadi'); ?>">
                  <?php if (!empty(session('errors.email_pribadi'))) :  ?>
                    <small class="text-danger"><?= session('errors.email_pribadi'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <div class="col-md">
                  <div class="custom-control custom-radio custom-control-inline py-0">
                    <input type="radio" id="customRadioInline1" name="jenis_kel" value="Laki-Laki" class="custom-control-input" checked>
                    <label class="custom-control-label" for="customRadioInline1">Laki-Laki</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="jenis_kel" value="Perempuan" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Perempuan</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">NIK</label>
                <input type="text" class="form-control <?= !empty(session('errors.nik')) ? 'is-invalid' : ''; ?>" name="nik" placeholder="3671092812000001" value="<?= old('nik'); ?>">
                <?php if (!empty(session('errors.nik'))) :  ?>
                  <small class="text-danger"><?= session('errors.nik'); ?></small>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label for="">Tempat Lahir</label>
                  <input type="text" class="form-control <?= !empty(session('errors.tmp_lahir')) ? 'is-invalid' : ''; ?>" name="tmp_lahir" placeholder="Jakarta" value="<?= old('tmp_lahir'); ?>">
                  <?php if (!empty(session('errors.tmp_lahir'))) :  ?>
                    <small class="text-danger"><?= session('errors.tmp_lahir'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label for="">Tanggal Lahir</label>
                  <input type="date" class="form-control <?= !empty(session('errors.tgl_lahir')) ? 'is-invalid' : ''; ?>" name="tgl_lahir" value="<?= old('tgl_lahir'); ?>">
                  <?php if (!empty(session('errors.tgl_lahir'))) :  ?>
                    <small class="text-danger"><?= session('errors.tgl_lahir'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control <?= !empty(session('errors.alamat')) ? 'is-invalid' : ''; ?> " placeholder="Jl.Kerta Jaya II"><?= old('alamat'); ?></textarea>
                <?php if (!empty(session('errors.alamat'))) :  ?>
                  <small class="text-danger"><?= session('errors.alamat'); ?></small>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>RT/RW</label>
                <input name="rt_rw" class="form-control <?= !empty(session('errors.rt_rw')) ? 'is-invalid' : ''; ?> " placeholder="001/13" value="<?= old('rt_rw'); ?>">
                <?php if (!empty(session('errors.rt_rw'))) :  ?>
                  <small class="text-danger"><?= session('errors.rt_rw'); ?></small>
                <?php endif; ?>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label>Kelurahan</label>
                  <input type="text" class="form-control <?= !empty(session('errors.kelurahan')) ? 'is-invalid' : ''; ?>" name="kelurahan" placeholder="Uwung Jaya" value="<?= old('kelurahan'); ?>">
                  <?php if (!empty(session('errors.kelurahan'))) :  ?>
                    <small class="text-danger"><?= session('errors.kelurahan'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control <?= !empty(session('errors.kecamatan')) ? 'is-invalid' : ''; ?>" name="kecamatan" placeholder="Cibodas" value="<?= old('kecamatan'); ?>">
                  <?php if (!empty(session('errors.kecamatan'))) :  ?>
                    <small class="text-danger"><?= session('errors.kecamatan'); ?></small>
                  <?php endif; ?>
                </div>

              </div>
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label>Kabupaten/Kota</label>
                  <input type="text" class="form-control <?= !empty(session('errors.kabupaten_kota')) ? 'is-invalid' : ''; ?>" name="kabupaten_kota" placeholder="Tangerang" value="<?= old('kabupaten_kota'); ?>">
                  <?php if (!empty(session('errors.kabupaten_kota'))) :  ?>
                    <small class="text-danger"><?= session('errors.kabupaten_kota'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label>Provinsi</label>
                  <input type="text" class="form-control <?= !empty(session('errors.prov')) ? 'is-invalid' : ''; ?>" name="prov" placeholder="Banten" value="<?= old('prov'); ?>">
                  <?php if (!empty(session('errors.prov'))) :  ?>
                    <small class="text-danger"><?= session('errors.prov'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">No Telepon</label>
                <input type="text" class="form-control <?= !empty(session('errors.no_telp')) ? 'is-invalid' : ''; ?>" name="no_telp" placeholder="088291316251" value="<?= old('no_telp'); ?>">
                <?php if (!empty(session('errors.no_telp'))) :  ?>
                  <small class="text-danger"><?= session('errors.no_telp'); ?></small>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="">Agama</label>
                <input type="text" class="form-control" name="agama" value="Islam" readonly>
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
              <div class="form-group">
                <label for="">Kartu Keluarga(KK)</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input <?= !empty(session('errors.kk_siswa')) ? 'is-invalid' : ''; ?> inputKK" name="kk_siswa">
                  <label class="custom-file-label kklabel" for="customFile">Choose file</label>
                </div>
                <?php if (!empty(session('errors.kk_siswa'))) :  ?>
                  <small class="text-danger"><?= session('errors.kk_siswa'); ?></small>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label for="">Akte Siswa</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input <?= !empty(session('errors.akte')) ? 'is-invalid' : ''; ?> ?> akteSiswa" name="akte" id="customFile">
                  <label class="custom-file-label akteLabel" for="customFile">Choose file</label>
                </div>
                <?php if (!empty(session('errors.akte'))) :  ?>
                  <small class="text-danger"><?= session('errors.akte'); ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label>Nama Ayah</label>
                  <input type="text" class="form-control <?= !empty(session('errors.nama_ayah')) ? 'is-invalid' : ''; ?>" name="nama_ayah" placeholder="Ahmad Ghifari" value="<?= old('nama_ayah'); ?>">
                  <?php if (!empty(session('errors.nama_ayah'))) :  ?>
                    <small class="text-danger"><?= session('errors.nama_ayah'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label>Pekerjaan Ayah</label>
                  <select name="id_pekerjaan_ayah" class="form-control <?= !empty(session('errors.id_pekerjaan_ayah')) ? 'is-invalid' : ''; ?>">
                    <option value="" selected>--Pilih Pekerjaan Ayah--</option>
                    <?php foreach ($pekerjaanAyah as $pekerjaan) :  ?>
                      <option value="<?= $pekerjaan['id_pekerjaan'] ?>"><?= $pekerjaan['pekerjaan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (!empty(session('errors.id_pekerjaan_ayah'))) :  ?>
                    <small class="text-danger"><?= session('errors.id_pekerjaan_ayah'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label>Pendidikan Ayah</label>
                  <select name="id_pendidikan_ayah" class="form-control <?= !empty(session('errors.id_pendidikan_ayah')) ? 'is-invalid' : ''; ?>">
                    <option value="" selected>--Pilih Pendidikan Ayah--</option>
                    <?php foreach ($pendidikan as $pendidikan) :  ?>
                      <option value="<?= $pendidikan['id_pendidikan'] ?>"><?= $pendidikan['pendidikan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (!empty(session('errors.id_pendidikan_ayah'))) :  ?>
                    <small class="text-danger"><?= session('errors.id_pendidikan_ayah'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label>Penghasilan Ayah</label>
                  <select name="id_penghasilan_ayah" class="form-control <?= !empty(session('errors.id_penghasilan_ayah')) ? 'is-invalid' : ''; ?>">
                    <option value="" selected>--Pilih Penghasilan Ayah--</option>
                    <?php foreach ($penghasilan as $penghasilan) :  ?>
                      <option value="<?= $penghasilan['id_penghasilan'] ?>"><?= $penghasilan['penghasilan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (!empty(session('errors.id_penghasilan_ayah'))) :  ?>
                    <small class="text-danger"><?= session('errors.id_penghasilan_ayah'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Tahun Lahir Ayah</label>
                <select name="thn_lahir_ayah" class="form-control <?= !empty(session('errors.thn_lahir_ayah')) ? 'is-invalid' : ''; ?>">
                  <option value="" selected>--Pilih Tahun Lahir--</option>
                  <?php for ($no = 1960; $no <= intval(date('Y')); $no++) :  ?>
                    <option value="<?= $no; ?>"><?= $no; ?></option>
                  <?php endfor; ?>
                </select>
                <?php if (!empty(session('errors.thn_lahir_ayah'))) :  ?>
                  <small class="text-danger"><?= session('errors.thn_lahir_ayah'); ?></small>
                <?php endif; ?>
              </div>


              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label>Nama Ibu</label>
                  <input type="text" class="form-control <?= !empty(session('errors.nama_ibu')) ? 'is-invalid' : ''; ?>" name="nama_ibu" placeholder="Restu Jaidez" value="<?= old('nama_ibu'); ?>">
                  <?php if (!empty(session('errors.nama_ibu'))) :  ?>
                    <small class="text-danger"><?= session('errors.nama_ibu'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label>Pekerjaan Ibu</label>
                  <select name="id_pekerjaan_ibu" class="form-control <?= !empty(session('errors.id_pekerjaan_ibu')) ? 'is-invalid' : ''; ?>">
                    <option value="" selected>--Pilih Pekerjaan Ibu--</option>
                    <?php foreach ($pekerjaanIbu as $pekerjaan) :  ?>
                      <option value="<?= $pekerjaan['id_pekerjaan']; ?>"><?= $pekerjaan['pekerjaan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (!empty(session('errors.id_pekerjaan_ibu'))) :  ?>
                    <small class="text-danger"><?= session('errors.id_pekerjaan_ibu'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label>Pendidikan Ibu</label>
                  <select name="id_pendidikan_ibu" class="form-control <?= !empty(session('errors.id_pendidikan_ibu')) ? 'is-invalid' : ''; ?>">
                    <option value="" selected>--Pilih Pendidikan Ibu--</option>
                    <?php foreach ($pendidikanIbu as $pendidikan) :  ?>
                      <option value="<?= $pendidikan['id_pendidikan']; ?>"><?= $pendidikan['pendidikan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (!empty(session('errors.id_pendidikan_ibu'))) :  ?>
                    <small class="text-danger"><?= session('errors.id_pendidikan_ibu'); ?></small>
                  <?php endif; ?>
                </div>
                <div class="form-group col-md-6 col-12">
                  <label>Penghasilan Ibu</label>
                  <select name="id_penghasilan_ibu" class="form-control  <?= !empty(session('errors.id_penghasilan_ibu')) ? 'is-invalid' : ''; ?>">
                    <option value="" selected>--Pilih Penghasilan Ibu--</option>
                    <?php foreach ($penghasilanIbu as $penghasilan) :  ?>
                      <option value="<?= $penghasilan['id_penghasilan']; ?>"><?= $penghasilan['penghasilan']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (!empty(session('errors.id_penghasilan_ibu'))) :  ?>
                    <small class="text-danger"><?= session('errors.id_penghasilan_ibu'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="">Tahun Lahir Ibu</label>
                <select name="thn_lahir_ibu" class="form-control  <?= !empty(session('errors.thn_lahir_ibu')) ? 'is-invalid' : ''; ?>">
                  <option value="" selected>--Pilih Tahun Lahir--</option>
                  <?php for ($no = 1960; $no <= intval(date('Y')); $no++) :  ?>
                    <option value="<?= $no; ?>"><?= $no; ?></option>
                  <?php endfor; ?>
                </select>
                <?php if (!empty(session('errors.thn_lahir_ibu'))) :  ?>
                  <small class="text-danger"><?= session('errors.thn_lahir_ibu'); ?></small>
                <?php endif; ?>
              </div>

              <div class="form-group">
                <label for="">Kelompok/Kelas</label>
                <select name="id_kelas" class="form-control">
                  <option value="" selected>--Pilih Kelas--</option>
                  <?php foreach ($get_kelas as $kelas) :  ?>
                    <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['kelas'] . ' ' . $kelas['keterangan']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <a class="btn btn-sm btn-warning mr-2" href="<?= base_url('/admin/siswa'); ?>">Kembali</a>
            <button class="btn btn-sm btn-primary" type="submit">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection(); ?>