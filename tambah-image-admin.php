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
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $image_name = $_POST['image_name'];
    $image_description = $_POST['image_description'];
    $image_status = $_POST['image_status'];
    $admin_id = $_SESSION['a_global']['admin_id'];

    // Folder tempat menyimpan gambar
    $target_dir = "foto/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Periksa apakah file gambar atau bukan
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File adalah gambar - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }
    }

    // Periksa apakah file sudah ada
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Batasi jenis file yang diizinkan
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Periksa jika $uploadOk bernilai 0
    if ($uploadOk == 0) {
        echo "Maaf, file tidak terunggah.";
    // Jika semuanya baik, coba untuk mengunggah file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Simpan informasi gambar ke dalam database
            $query = mysqli_query($conn, "INSERT INTO tb_image (admin_id, image_name, image_description, image, image_status) VALUES ('$admin_id', '$image_name', '$image_description', '".basename($_FILES["image"]["name"])."', '$image_status')");
            if($query) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            } else {
                echo "Maaf, terjadi kesalahan saat menyimpan data ke database.";
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Foto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type=text],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type=file] {
            margin-top: 5px;
        }

        input[type=submit] {
            background-color: #020202;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Foto</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="image_name">Nama Foto:</label>
            <input type="text" id="image_name" name="image_name">

            <label for="image_description">Deskripsi:</label>
            <textarea id="image_description" name="image_description"></textarea>

            <label for="image_status">Status:</label>
            <select id="image_status" name="image_status">
                <option value="0">Tidak Aktif</option>
                <option value="1">Aktif</option>
            </select>

            <label for="image">Pilih Gambar:</label>
            <input type="file" id="image" name="image">

            <input type="submit" value="Upload Image" name="submit">
        </form>
    </div>
</body>
</html>

