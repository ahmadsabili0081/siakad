<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $title ?></title>
  <link rel="icon" type="image/x-icon" href="<?= base_url('/gambar/logo_pic_2.png'); ?>">
  <link rel="stylesheet" href="<?= base_url('/stisla/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('/stisla/css/styleCarousel.css'); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>

</head>

<body>
  <div class="container-fluid px-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
      <a class="navbar-brand" href="#"><img class="rounded-circle" style="width: 30px;" src="<?= base_url('/gambar/logo_pic_2.png'); ?>" alt=""> Paud Nurul Iman</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#tentang">Tentang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#lokasi">Lokasi</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Login
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/authsiswa">Login Siswa</a>
              <a class="dropdown-item" href="/authsiswa/register_siswa">Registrasi Siswa</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="main-content">
      <?= $this->renderSection('Home'); ?>
    </div>
    <footer class="footer bg-info text-center p-1 text-light">
      <div class="footer-left">
        Copyright &copy; <?= date('Y'); ?> | Sistem Informasi Akademik Paud Nurul Iman</a>
      </div>
    </footer>
  </div>
  <script src="<?= base_url('/stisla/js/jquery.slim.min.js'); ?>"></script>
  <script src="<?= base_url('/stisla/js/bootstrap.bundle.min.js'); ?>"></script>
  <script>
    $(document).ready(function() {
      $('.dropdown').on('show.bs.dropdown', function() {
        var dropdown = $(this).find('.dropdown-menu');
        var windowHeight = $(window).height();
        var bottomSpace = windowHeight - $(this).offset().top - $(this).height();

        if (bottomSpace < dropdown.height()) {
          $(this).addClass('dropup');
        }
      });
    });
  </script>
</body>

</html>