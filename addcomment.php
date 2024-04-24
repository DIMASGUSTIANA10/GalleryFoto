<?php
include 'db.php';

// Ambil data komentar yang ditambahkan
$image_id = $_POST['image_id'];
$comment = $_POST['comment'];

// Tambahkan komentar ke database
mysqli_query($conn, "INSERT INTO tb_image_comments (image_id, comment) VALUES ('$image_id', '$comment')");

// Redirect kembali ke halaman detail gambar
header("Location: detail-image.php?id=$image_id");
?>
