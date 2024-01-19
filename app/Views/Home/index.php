<?= $this->extend('Templates/template_home'); ?>

<?= $this->section('Home'); ?>
<div class="row" id="home">
  <div class="col-sm-12">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php foreach ($get_data as $index => $galeri) : ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?= $index; ?>" <?= $index === 0 ? 'class="active"' : ''; ?>></li>
        <?php endforeach; ?>
      </ol>
      <div class="carousel-inner absoluteImages">
        <?php foreach ($get_data as $index => $galeri) : ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
            <img class="d-block w-100 img" src="<?= base_url('/gambar/' . $galeri['galeri']); ?>" alt="Slide <?= $index + 1; ?>">
          </div>
        <?php endforeach; ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>
</div>


<div class="row" id="tentang">
  <div class="col-md-12 row p-5">
    <div class="col-md-6">
      <h4 class="text-dark">SEJARAH SINGKAT</h4>
      <p class="text-justify">KB Nurul Iman Cibodas sebagai salah satu Sekolah Paud di wilayah kecamatan
        Cibodas Kota Tangerang Provinsi Banten yang mempunyai nilai histori yang besar.
        Tidak bisa dipisahkan dengan pendirinya yaitu Alm Hj.Munir inilah pada tanggal 23
        Juli 2013. Alm. Haji Munir membangun Sarana pendidikan yang kemudian lebih
        dikenal dengan Sekolah Paud KB Nurul Iman Cibodas telah banyak memberikan
        kontribusi dan sumbangan kepada masyarakat luas baik dalam bidang pendidikan
        maupun pengabdian kepada masyarakat.</p>
    </div>
    <div class="col-md-6">
      <h4>VISI</h4>
      <p>“Membentuk generasi yang sehat, cerdas, kreatif, mandiri, ceria dan berakhlak mulia”</p>

      <h4>MISI</h4>
      <ol type="1" class="ml-3">
        <li>Menyelenggarakan layanan pengembangan holistik integratif.</li>
        <li>Memfasilitasi kegiatan belajar yang aktif dan menyenangkan sesuai dengan
          tahapan perkembangan, minat, dan potensi anak.</li>
        <li>Membangun pembiasaan perilaku hidup bersih, sehat dan berahlak mulia
          secara mandiri.</li>
        <li>Membangun kerja sama dengan orang tua, masyarakat, dan lingkup terkait
          dalam rangka pengelolaan Paud yang profesional, akuntabel, dan bedaya saing
          nasional.</li>
      </ol>
    </div>
  </div>
</div>

<div class="row" id="lokasi">
  <div class="col-md-12  p-5">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.474004508147!2d106.5976838738767!3d-6.201027060744408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69feec78f1027b%3A0xe945ca8ab2036135!2sJl.%20Muhajirin%20II%2C%20RT.002%2FRW.012%2C%20Uwung%20Jaya%2C%20Kec.%20Cibodas%2C%20Kota%20Tangerang%2C%20Banten%2015138!5e0!3m2!1sid!2sid!4v1704118353281!5m2!1sid!2sid" width="600" height="450" style="border:0; width:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</div>

<?= $this->endSection(); ?>