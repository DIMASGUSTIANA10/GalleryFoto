<?php
session_start(); // Mulai sesi
require_once 'db.php';

// Pastikan parameter 'id' terdefinisi dan bukan null
if(isset($_GET['id'])){
    $id_kategori = $_GET['id'];
    
    // Melakukan sanitasi input untuk mencegah SQL injection
    $id_kategori = mysqli_real_escape_string($conn, $id_kategori);
    
    // Query untuk menghapus kategori
    $hapus_kategori = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '$id_kategori'");
    
    // Cek apakah penghapusan berhasil
    if($hapus_kategori){
        // Redirect ke halaman kategori dengan pesan sukses
        header("Location: admin.php?pesan=hapus_sukses");
        exit(); // Menghentikan eksekusi skrip
    } else {
        // Jika gagal, redirect ke halaman kategori dengan pesan error
        header("Location: admin.php?pesan=hapus_gagal");
        exit(); // Menghentikan eksekusi skrip
    }
} else {
    // Jika parameter 'id' tidak terdefinisi, redirect ke halaman kategori dengan pesan error
    header("Location: admin.php?pesan=id_tidak_ditemukan");
    exit(); // Menghentikan eksekusi skrip
}
?>