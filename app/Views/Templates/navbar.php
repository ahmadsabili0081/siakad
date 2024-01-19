<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <?php
    $siswa_model = new App\Models\SiswaModel();
    $user_model  = new App\Models\UserModel();

    if (session()->get('id_role') == 3) {
      $data = $siswa_model->where('id_siswa', session()->get('id_siswa'))->first();
    } else {
      $data = $user_model->where('id_user', session()->get('id_user'))->first();
    }

    ?>

    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="<?= (session()->get('id_role') == 3 ? base_url('/gambar/fotoCalonSiswa/' . $data['gambar']) : base_url('/gambar/admin_gambar/' . $data['gambar'])); ?>" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block"><?= (session()->get('id_role') == 3 ? session()->get('nama') : $data['nama_lengkap']); ?></div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?= (session()->get('id_role') == 3 ? base_url('/siswa/profile') : ''); ?>" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?= (session()->get('id_role') == 3 ? base_url('/authsiswa/logout') : base_url('/auth/logout')); ?>" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>