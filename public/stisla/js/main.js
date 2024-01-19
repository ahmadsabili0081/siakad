$(document).ready(function () {

  // input handler password

  $('#toggleIcon').on('click', function () {
    let icon = $(this).find("i");
    let password_input = $('#password');
    if (password_input.attr('type') === "password") {
      password_input.attr("type", "text");
      icon.removeClass("fas fa-eye-slash").addClass("fas fa-eye");
    } else {
      password_input.attr("type", "password");
      icon.removeClass("fas fa-eye").addClass("fas fa-eye-slash");
    }
  });

  // approve_student

  $('.approve_student').on('click', function (e) {
    e.preventDefault(); // Mencegah aksi default dari tautan
    let get_url = $(this).attr('href');
    // Lakukan permintaan AJAX

    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Ingin Menyetujui data siswa baru!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Terima!",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.value == true) {
        $.ajax({
          url: get_url, // Sesuaikan dengan URL yang sesuai
          method: 'GET', // Sesuaikan dengan metode HTTP yang digunakan
          success: function (response) {
            if (response.status === 'success' && response.redirect) {
              // Redirect pengguna ke URL yang ditentukan dalam respons
              window.location.href = response.redirect;
            }
          },
          error: function (error) {
            // Tanggapan gagal, lakukan sesuatu jika diperlukan
            console.error(error);
          }
        });
      }
    });
  });


  // handler button modal edit and delete
  $('.btnEdit').on('click', function (e) {
    e.preventDefault();
    let targetUrl = $(this).attr('href');

    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Ingin Merubah Data!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Edit!",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.value == true) {
        window.location.href = targetUrl;
      }
    });
  });

  $('.btnDelete').on('click', function (e) {
    e.preventDefault();
    let targetUrl = $(this).attr('href');

    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Ingin Menghapus Data!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.value == true) {
        window.location.href = targetUrl;
      }
    });
  });


  $('.btn_print').on('click', function (e) {
    e.preventDefault();
    let targetUrl = $(this).attr('href');

    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Ingin mencetak bukti Pendaftaran Ini!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Cetak!",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.value == true) {
        window.open(targetUrl, '_blank');
      }
    });
  });

  // handler input images file

  $('.inputImages').on('change', function () {
    let inputImagesValue = $('.inputImages').val().split('\\').pop();
    $('.imagesStudentLabel').text(inputImagesValue);
    if (this.files.length > 0) {
      let fileImages = this.files[0];
      let fileImagesReader = new FileReader();

      fileImagesReader.onload = function (e) {
        $('.displayedImages').attr('src', e.target.result);
      }
      fileImagesReader.readAsDataURL(fileImages);
    }
  });

  // handler input file kk

  $('.inputKK').on('change', function () {
    let inputKKValue = $('.inputKK').val().split('\\').pop();
    $('.kklabel').text(inputKKValue);
    if (this.files.length > 0) {
      let fileKK = this.files[0];
      let fileKKReader = new FileReader();

      fileKKReader.onload = function (e) {
        $('.displayedKK').attr('src', e.target.result);
      }
      fileKKReader.readAsDataURL(fileKK);
    }

  });

  // handler input file akte siswa
  $('.akteSiswa').on('change', function () {
    let input_akte_value = $('.akteSiswa').val().split('\\').pop();
    $('.akteLabel').text(input_akte_value);
    if (this.files.length > 0) {
      let file_akte = this.files[0];
      let file_akter_reader = new FileReader();

      file_akter_reader.onload = function (e) {
        $('.displayedImagesAkte').attr('src', e.target.result);
      }
      file_akter_reader.readAsDataURL(file_akte);
    }

  });

  // handler radio button

  $('#customRadioHadir').on('click', function () {
    $('#customRadioIzin').prop('checked', false);
    $('#customRadioAlpha').prop('checked', false);
  });

  $('#customRadioIzin').on('click', function () {
    $('#customRadioHadir').prop('checked', false);
    $('#customRadioAlpha').prop('checked', false);
  });

  $('#customRadioAlpha').on('click', function () {
    $('#customRadioHadir').prop('checked', false);
    $('#customRadioIzin').prop('checked', false);
  });

  // handler b

  $('#customRadioHadirB').on('click', function () {
    $('#customRadioIzinB').prop('checked', false);
    $('#customRadioAlphaB').prop('checked', false);
  });

  $('#customRadioIzinB').on('click', function () {
    $('#customRadioHadirB').prop('checked', false);
    $('#customRadioAlphaB').prop('checked', false);
  });

  $('#customRadioAlphaB').on('click', function () {
    $('#customRadioHadirB').prop('checked', false);
    $('#customRadioIzinB').prop('checked', false);
  });


  $('.non_aktif').on('click', function (e) {
    e.preventDefault();
    let targetUrl = $(this).attr('href');

    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Ingin Menonaktifkan Menu!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Nonaktifkan!",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.value == true) {
        window.location.href = targetUrl;
      }
    });
  });


  $('.aktif').on('click', function (e) {
    e.preventDefault();
    let targetUrl = $(this).attr('href');

    Swal.fire({
      title: "Apakah Anda Yakin?",
      text: "Ingin Mengaktifkan Menu!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Aktifkan!",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.value == true) {
        window.location.href = targetUrl;
      }
    });
  });


});


