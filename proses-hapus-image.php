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

// Periksa apakah parameter idp ada di URL
if(isset($_GET['idp']) && !empty($_GET['idp'])) {
    $image_id = $_GET['idp'];
    
    // Hapus data foto dari database berdasarkan ID
    $query = mysqli_query($conn, "DELETE FROM tb_image WHERE image_id='$image_id'");

    // Periksa apakah query berhasil dijalankan
    if($query) {
        // Jika berhasil, alihkan pengguna ke halaman lain atau tampilkan pesan berhasil
        header("Location: admin.php"); // Ganti data-foto.php dengan halaman yang sesuai
        exit();
    } else {
        // Jika gagal, tampilkan pesan error atau alihkan pengguna ke halaman lain
        echo "Gagal menghapus foto.";
    }
} else {
    // ID tidak ditemukan dalam parameter URL
    echo "ID tidak ditemukan.";
}
?>
