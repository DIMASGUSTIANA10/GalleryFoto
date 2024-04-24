<?php
session_start(); // Mulai sesi
require_once 'db.php';

// Pastikan parameter 'id' terdefinisi dan bukan null
if(isset($_GET['id'])){
    $id_foto = $_GET['id'];
    
    // Melakukan sanitasi input untuk mencegah SQL injection
    $id_foto = mysqli_real_escape_string($conn, $id_foto);
    
    // Query untuk mengambil nama file foto yang akan dihapus
    $query_select_foto = mysqli_query($conn, "SELECT image FROM tb_image WHERE image_id = '$id_foto'");
    
    // Memastikan foto ditemukan sebelum mencoba menghapusnya
    if(mysqli_num_rows($query_select_foto) > 0) {
        $foto = mysqli_fetch_assoc($query_select_foto);
        $nama_foto = $foto['image'];
        
        // Hapus file foto dari direktori
        unlink("foto/".$nama_foto);
        
        // Query untuk menghapus data foto dari database
        $hapus_foto = mysqli_query($conn, "DELETE FROM tb_image WHERE image_id = '$id_foto'");
        
        // Cek apakah penghapusan berhasil
        if($hapus_foto){
            // Redirect ke halaman admin dengan pesan sukses
            header("Location: admin.php?pesan=hapus_sukses");
            exit(); // Menghentikan eksekusi skrip
        } else {
            // Jika gagal, redirect ke halaman admin dengan pesan error
            header("Location: admin.php?pesan=hapus_gagal");
            exit(); // Menghentikan eksekusi skrip
        }
    } else {
        // Jika foto tidak ditemukan, redirect ke halaman admin dengan pesan error
        header("Location: admin.php?pesan=foto_tidak_ditemukan");
        exit(); // Menghentikan eksekusi skrip
    }
} else {
    // Jika parameter 'id' tidak terdefinisi, redirect ke halaman admin dengan pesan error
    header("Location: admin.php?pesan=id_tidak_ditemukan");
    exit(); // Menghentikan eksekusi skrip
}
?>
