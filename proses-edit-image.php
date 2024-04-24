<?php
// Mulai sesi PHP
session_start();

// Periksa apakah pengguna masuk atau tidak
if(!isset($_SESSION['a_global']) || $_SESSION['a_global'] === null){
    // Jika tidak, alihkan pengguna ke halaman login atau halaman lain yang sesuai
    header("Location: login.php"); // Ganti login.php dengan halaman login yang sesuai
    exit(); // Hentikan proses eksekusi script
}

// Sambungkan ke database atau gunakan file konfigurasi database yang sudah ada
include "db.php"; // Ganti koneksi.php dengan file koneksi yang sesuai

// Periksa apakah pengguna mengirimkan data melalui formulir
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirim dari formulir
    $image_id = $_POST['image_id'];
    $image_name = $_POST['image_name'];
    $image_description = $_POST['image_description'];

    // Update data foto dalam database
    $query = mysqli_query($conn, "UPDATE tb_image SET image_name='$image_name', image_description='$image_description' WHERE image_id='$image_id'");

    // Periksa apakah query berhasil dijalankan
    if($query) {
        // Jika berhasil, alihkan pengguna ke halaman lain atau tampilkan pesan berhasil
        header("Location: admin.php"); // Ganti data-foto.php dengan halaman yang sesuai
        exit();
    } else {
        // Jika gagal, tampilkan pesan error atau alihkan pengguna ke halaman lain
        echo "Gagal menyimpan perubahan.";
    }
}
?>
