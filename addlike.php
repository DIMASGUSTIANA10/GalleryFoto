<?php
include 'db.php';
session_start();

if (isset($_POST['submit'])) {
    $image_id = $_POST['image_id'];
    $user_id = $_SESSION['user_id']; // Pastikan user sudah login sebelum menambahkan like

    // Periksa apakah user sudah melakukan like sebelumnya
    $query_check_like = mysqli_query($conn, "SELECT * FROM tb_image_likes WHERE image_id = '$image_id' AND user_id = '$user_id'");
    if (mysqli_num_rows($query_check_like) == 0) {
        // Jika belum, tambahkan like ke dalam database
        mysqli_query($conn, "INSERT INTO tb_image_likes (image_id, user_id) VALUES ('$image_id', '$user_id')");
        
        // Update jumlah like di tabel tb_image
        mysqli_query($conn, "UPDATE tb_image SET likes = likes + 1 WHERE image_id = '$image_id'");
    } else {
        // Jika sudah, hapus like dari database
        mysqli_query($conn, "DELETE FROM tb_image_likes WHERE image_id = '$image_id' AND user_id = '$user_id'");
        
        // Update jumlah like di tabel tb_image
        mysqli_query($conn, "UPDATE tb_image SET likes = likes - 1 WHERE image_id = '$image_id'");
    }

    // Redirect kembali ke halaman detail gambar
    header("Location: detail-image.php?id=$image_id");
}
?>
