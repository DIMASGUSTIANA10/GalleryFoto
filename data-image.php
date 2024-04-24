<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
    exit; // tambahkan perintah exit untuk menghentikan eksekusi kode selanjutnya jika status login tidak benar
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="data-image.php">Data Foto</a></li>
                    <li><a href="Keluar.php">Keluar</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- content -->
    <div class="section">
    <div class="container">
        <h3>Data Galeri Foto</h3>
        <div class="box">
            <p><a href="tambah-image.php" class="btn tambah" style="padding: 10px 20px; background-color: #020202; color: white; border: none; border-radius: 6px; cursor: pointer; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 6px 2px; transition-duration: 0.4s;">Tambah Data</a></p>
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th>Nama User</th>
                        <th>Nama Foto</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Status</th>
                        <th width="17%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Periksa apakah 'admin_id' ada dalam sesi sebelum mengaksesnya
                    $user = isset($_SESSION['a_global']['admin_id']) ? $_SESSION['a_global']['admin_id'] : null;
                    // Pastikan $user tidak null sebelum menjalankan query
                    if ($user !== null) {
                        $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE admin_id = '$user' ");
                        if (mysqli_num_rows($foto) > 0) {
                            while ($row = mysqli_fetch_assoc($foto)) {
                    ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['admin_name'] ?></td>
                                    <td><?php echo $row['image_name'] ?></td>
                                    <td><?php echo $row['image_description'] ?></td>
                                    <td><a href="foto/<?php echo $row['image'] ?>" target="_blank"><img src="foto/<?php echo $row['image'] ?>" width="100px"></a></td>
                                    <td><?php echo ($row['image_status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                                    <td class="aksi">
                                        <a href="edit-image.php?id=<?php echo $row['image_id'] ?>" style="padding: 10px 20px; background-color: #020202; color: white; border: none; border-radius: 6px; cursor: pointer; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 6px 2px; transition-duration: 0.4s;">Edit</a>
                                        <a href="proses-hapus.php?idp=<?php echo $row['image_id'] ?>" style="padding: 10px 20px; background-color: #020202; color: white; border: none; border-radius: 6px; cursor: pointer; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 6px 2px; transition-duration: 0.4s;" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else { ?>
                            <tr>
                                <td colspan="8">Tidak ada data</td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Dimas gustiana</small>
        </div>
    </footer>
</body>

</html>