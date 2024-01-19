<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'HomeController::index');

$routes->group('auth', ['filter' => 'AuthFilter'], static function ($routes) {
  $routes->get('/', 'Auth::index');
  $routes->get('/auth', 'Auth::index');
  $routes->get('registrasi', 'Auth::registrasi');
  $routes->post('save_register', 'Auth::save_register');
  $routes->post('save_login', 'Auth::save_login');
});

$routes->group('admin', ['filter' => 'AuthFilterRoleFilter'], static function ($routes) {
  $routes->get('/', 'Admin::index');
  $routes->get('admin', 'Admin::index');
  $routes->get('users', 'Admin::Users');
  $routes->get('add_user', 'Admin::add_user');
  $routes->post('submit_user', 'Admin::submit_user');
  $routes->get('edit_user/(:any)', 'Admin::edit_user/$1');
  $routes->get('delete_user/(:any)', 'Admin::delete_user/$1');


  $routes->get('students', 'Admin::siswa');
  $routes->get('tambah_siswa', 'Admin::tambah_siswa');
  $routes->get('edit/(:segment)', 'Admin::edit/$1');
  $routes->get('hapus/(:segment)', 'Admin::hapus/$1');
  $routes->get('submit', 'Admin::submit');

  $routes->get('group_class', 'Admin::group_class');
  $routes->get('add_group_class', 'Admin::add_group_class');
  $routes->get('edit_group_class/(:num)', 'Admin::edit_group_class/$1');
  $routes->get('delete_group_class/(:num)', 'Admin::delete_group_class/$1');

  $routes->get('new_school_academic_year', 'Admin::new_school_academic_year');
  $routes->get('edit_new_school_academic_year/(:num)', 'Admin::edit_new_school_academic_year/$1');
  $routes->get('delete_new_school_academic_year/(:num)', 'Admin::delete_new_school_academic_year/$1');
  $routes->post('submit_new_school_academic_year', 'Admin::submit_new_school_academic_year');

  $routes->get('profile', 'Admin::profile');
  $routes->post('submit_profile', 'Admin::submit_profile');
  $routes->get('change_password', 'Admin::change_password');
  $routes->get('submit_password', 'Admin::submit_password');

  $routes->get('group_gallery', 'Admin::group_gallery');
  $routes->post('submit_galery', 'Admin::submit_galery');
  $routes->get('edit_galery/(:num)', 'Admin::edit_galery/$1');
  $routes->get('delete_galery/(:num)', 'Admin::delete_galery/$1');
});

$routes->group('guru', ['filter' => 'AuthFilterRoleFilter'], static function ($routes) {
  $routes->get('/', 'GuruController::index');
  $routes->get('students', 'GuruController::students');
  $routes->get('add_student', 'GuruController::add_student');
  $routes->get('edit_student/(:segment)', 'GuruController::edit_student/$1');
  $routes->get('delete_student/(:segment)', 'GuruController::delete_student/$1');
  $routes->post('submit_student', 'GuruController::submit_student');

  $routes->get('absence_attendance', 'GuruController::absence_attendance');
  $routes->get('add_absence_attendance', 'GuruController::add_absence_attendance');
  $routes->get('edit_absence_attendance/(:num)', 'GuruController::edit_absence_attendance/$1');
  $routes->get('delete_absence_attendance/(:num)', 'GuruController::delete_absence_attendance/$1');
  $routes->post('submit_absence', 'GuruController::submit_absence');

  $routes->get('profile', 'GuruController::profile');
  $routes->post('submit_profile', 'GuruController::submit_profile');
  $routes->get('change_password', 'GuruController::change_password');

  $routes->get('report_student', 'GuruController::report_student');
  $routes->get('add_report_student', 'GuruController::add_report_student');
  $routes->post('submit_report', 'GuruController::submit_report');
});




$routes->group('authsiswa', ['filter' => 'AuthFilterSiswa'],  function ($routes) {
  $routes->get('/', 'Authsiswa::index');
  $routes->get('authsiswa', 'Authsiswa::index');
  $routes->get('register_siswa', 'Authsiswa::register_siswa');
  $routes->post('save_registration', 'Authsiswa::save_registration');
  $routes->post('save_login', 'Authsiswa::save_login');
});

$routes->group('siswa', ['filter' => 'AuthFilterRoleSiswa'],  function ($routes) {
  $routes->get('', 'Siswa::index');
  $routes->get('/', 'Siswa::index');
  $routes->get('siswa', 'Siswa::index');
  $routes->get('profile', 'Siswa::profile_student');
  $routes->get('print_student_biodata', 'Siswa::print_student_biodata');
  $routes->get('print/(:num)', 'Siswa::print/$1');
  $routes->get('submit', 'Siswa::submit');

  $routes->get('change_password', 'Siswa::change_password');
  $routes->post('submit_password', 'Siswa::submit_password');

  $routes->get('report_student', 'Siswa::report_student');
});

$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/authsiswa/logout', 'Authsiswa::logout');
