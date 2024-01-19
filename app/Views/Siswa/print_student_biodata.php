<?= $this->extend('Templates/template'); ?>

<?= $this->section('contentPage'); ?>

<section class="section">
  <div class="section-header">
    <h5>Biodata Pendaftaran Siswa</h5>
  </div>
  <?php if (empty($get_data['kelurahan']) || empty($get_data['kecamatan']) || empty($get_data['prov']) || empty($get_data['rt_rw']) || empty($get_data['no_telp']) || empty($get_data['nama_ayah']) || empty($get_data['id_pekerjaan_ayah']) || empty($get_data['id_pendidikan_ayah']) || empty($get_data['id_penghasilan_ayah']) || empty($get_data['nama_ibu']) || empty($get_data['id_pekerjaan_ibu']) || empty($get_data['id_pendidikan_ibu']) || empty($get_data['id_penghasilan_ibu'])) :  ?>
    <h3 class="text-center">Lengkap Profile terlebih dahulu!</h3>
  <?php else :  ?>
    <div class="row">
      <div class="col p-0">
        <div class="col print_view_template p-0">
          <div class="col-md-12 col-sm p-0">
            <div class="card">
              <div class="card-body">
                <div class="col-sm-3 mb-3 px-0">
                  <img style="width : 150px; height:150px; " class="img-thumbnail img-fluid" src="<?= base_url('/gambar/fotoCalonSiswa/' . $get_data['gambar']) ?>">
                </div>

                <a class="btn btn-md btn-primary btn_print mb-3" href="<?= base_url('/siswa/print/' . $get_data['id_siswa']); ?>" target="_blank"><i class="fas fa-print"></i> Cetak Pendaftaran</a>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th style="width: 100px;">Tanggal Daftar</th>
                      <td>:</td>
                      <td><?= $get_data['created_at']; ?></td>
                    </tr>
                    <tr>
                      <th style="width: 100px;">No Pendaftaran</th>
                      <td>:</td>
                      <td><?= $get_data['no_pendaftaran']; ?></td>
                    </tr>
                    <tr>
                      <th>Nama Lengkap</th>
                      <td>:</td>
                      <td><?= $get_data['nama']; ?></td>
                    </tr>
                    <tr>
                      <th>Nomor Induk Kependudukan(NIK)</th>
                      <td>:</td>
                      <td><?= $get_data['nik']; ?></td>
                    </tr>
                    <tr>
                      <th>Jenis Kelamin</th>
                      <td>:</td>
                      <td><?= $get_data['jenis_kel']; ?></td>
                    </tr>
                    <tr>
                      <th>Tempat, Tanggal Lahir</th>
                      <td>:</td>
                      <td><?= $get_data['tmp_lahir'] . ', ' .  date('d-m-Y', strtotime($get_data['tgl_lahir'])); ?></td>
                    </tr>
                    <tr>
                      <th>Agama</th>
                      <td>:</td>
                      <td><?= $get_data['agama']; ?></td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td>:</td>
                      <td><?= $get_data['alamat']; ?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col row p-0 ml-1">
            <div class="col-md-6 col-sm p-0">
              <div class="card">
                <div class="card-header">
                  <h4>Biodata Ayah</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                        <th>Nama Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['nama_ayah']; ?></td>
                      </tr>
                      <tr>
                        <th>Pendidikan Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['pendidikan_ayah']; ?></td>
                      </tr>
                      <tr>
                        <th>Pekerjaan Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['pekerjaan_ayah']; ?></td>
                      </tr>
                      <tr>
                        <th>Penghasilan Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['penghasilan_ayah']; ?></td>
                      </tr>
                      <tr>
                        <th>Tahun Lahir Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['thn_lahir_ayah']; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm p-0">
              <div class="card">
                <div class="card-header">
                  <h4>Biodata Ibu</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                        <th>Nama Ibu</th>
                        <td>:</td>
                        <td><?= $get_data['nama_ibu']; ?></td>
                      </tr>
                      <tr>
                        <th>Pendidikan Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['pendidikan_ibu']; ?></td>
                      </tr>
                      <tr>
                        <th>Pekerjaan Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['pekerjaan_ibu']; ?></td>
                      </tr>
                      <tr>
                        <th>Penghasilan Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['penghasilan_ibu']; ?></td>
                      </tr>
                      <tr>
                        <th>Tahun Lahir Ayah</th>
                        <td>:</td>
                        <td><?= $get_data['thn_lahir_ibu']; ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>
<?= $this->endSection(); ?>