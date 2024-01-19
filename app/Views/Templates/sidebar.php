<?php
$uri = service('uri');
$menuModel  = new App\Models\MenuModel();
$id_role = session()->get('id_role');
$menu = $menuModel->joinMenu($id_role);
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img style="width: 30px;" src="<?= base_url('/gambar/logo_pic.png'); ?>" alt="">
      <a style="vertical-align: middle;" href="index.html">Siakad Nurul Iman</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">SNI</a>
    </div>
    <ul class="sidebar-menu">
      <?php foreach ($menu as $m_title) :  ?>
        <li class="menu-header"><?= $m_title['menu']; ?></li>
        <?php
        $id_menu = $m_title['id_menu'];
        $sub_menu = $menuModel->sub_menu_join($id_menu);
        $uri_title = $uri->getSegment(2);
        ?>

        <?php foreach ($sub_menu as $sub_m) :  ?>
          <?php if ($uri_title === $sub_m['nama_sub']) :  ?>
            <li class="nav-item active">
            <?php else :  ?>
              <?php if ($sub_m['nama_sub'] == "Kelas" || $sub_m['nama_sub'] == "Master Data") :  ?>
            <li class="dropdown">
            <?php else :  ?>
            <li class="nav-item">
            <?php endif; ?>

          <?php endif; ?>
          <?php if ($sub_m['nama_sub'] == "Kelas" || $sub_m['nama_sub'] == "Master Data") :  ?>
            <a href="#" class="nav-link has-dropdown"><i class="<?= $sub_m['icon']; ?>"></i> <span><?= $sub_m['nama_sub']; ?></span></a>
            <?php if ($sub_m['nama_sub'] == "Kelas") :  ?>
              <ul class="dropdown-menu">
                <li><a href="gmaps-advanced-route.html">Kelas A</a></li>
                <li><a href="gmaps-draggable-marker.html">Kelas B</a></li>
              </ul>
            <?php else :  ?>
              <ul class="dropdown-menu">
                <?php
                $url_user = $uri->getSegment(1);
                ?>
                <li><a href="<?= base_url('/' . $url_user . '/group_class'); ?>">Data Kelas</a></li>
                <li><a href="<?= base_url('/' . $url_user . '/group_gallery');; ?>">Data Galeri</a></li>
                <li><a href="<?= base_url('/' . $url_user . '/new_school_academic_year'); ?>">Data Tahun Ajaran</a></li>
                <li><a href="<?= base_url('/' . $url_user . '/access_menu'); ?>">Menu Akses</a></li>
              </ul>
            <?php endif; ?>
            </li>
          <?php else : ?>
            <a class="nav-link" href="<?= $sub_m['url']; ?>">
              <i class="<?= $sub_m['icon']; ?>"></i> <span><?= $sub_m['nama_sub']; ?></span>
            </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </ul>
  </aside>
</div>