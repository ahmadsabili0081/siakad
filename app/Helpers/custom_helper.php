<?php

function cek_login()
{
  $uri = service('uri');
  $db = \Config\Database::connect();
  $builder = $db->table('menu');

  $id_role = session()->get('id_role');
  $email = session()->get('email');

  if (!$id_role || !$email) {
    return redirect()->to('/auth');
  } else {
    $menu = $uri->getSegment(1);
    $menuData = $builder->getWhere(['menu' => ucwords($menu)])->getRow();

    if (!$menuData) {
      // Handle the case where the menu is not found
      return redirect()->to(base_url('block'));
    }

    $allowedMenuIds = array_column(
      $db->table('akses_menu')->getWhere(['id_role' => $id_role])->getResultArray(),
      'id_menu'
    );


    // Check if the accessed menu is allowed
    if (!in_array($menuData->id_menu, $allowedMenuIds)) {
      // User does not have access to the accessed menu
      return redirect()->to(base_url('block'));
    }
  }
}
