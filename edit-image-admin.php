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

// Periksa apakah parameter id ada di URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $image_id = $_GET['id'];
    
    // Lakukan query untuk mendapatkan data foto berdasarkan ID
    $query = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '$image_id'");
    
    // Periksa apakah data ditemukan
    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        // Data ditemukan, Anda dapat menampilkan formulir pengeditan di sini
        // Misalnya:
        ?>
   <!DOCTYPE html>
<html>
<head>
    <title>Edit Foto</title>
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
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 150px;
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
            background-color: #020202;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Foto</h2>
        <form action="proses-edit-image.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="image_id" value="<?php echo $data['image_id']; ?>">
            <label for="image_name">Nama Foto:</label>
            <input type="text" id="image_name" name="image_name" value="<?php echo $data['image_name']; ?>">

            <label for="image_description">Deskripsi:</label>
            <textarea id="image_description" name="image_description"><?php echo $data['image_description']; ?></textarea>

            <input type="submit" value="Simpan">
        </form>
    </div>
</body>
</html>

        <?php
    } else {
        // Data tidak ditemukan, mungkin tindakan penggunaan ID yang tidak valid
        echo "Data tidak ditemukan.";
    }
} else {
    // ID tidak ditemukan dalam parameter URL
    echo "ID tidak ditemukan.";
}
?>
