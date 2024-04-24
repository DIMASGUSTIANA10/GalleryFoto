<?php
session_start(); 
require_once 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel - Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>

<body>
    <header>
        <div class="container">
            <h1><a href="index.php">Halaman Admin - Gallery Foto</a></h1>
            <nav>
                <ul>
                    <li><a href="index.php">Data Kategori</a></li>
                    <li><a href="keluar.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="section">
    <div class="container">
        <h3>Data Kategori</h3>
        <div class="box">
            <p><a href="tambah-category.php" class="btn tambah">Tambah Kategori</a></p>
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <!-- <th>Nama Kategori</th> -->
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        $no = 1;
                        while($k = mysqli_fetch_array($kategori)){
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $k['category_name'] ?></td>
                            <!-- <td><?php //echo isset($k['category_description']) ? $k['category_description'] : 'Deskripsi tidak tersedia'; ?></td> -->
                            <td>
                                <a href="edit-kategori.php?id=<?php echo $k['category_id'] ?>" class="btn edit">Edit</a>
                                <a href="proses-hapus-kategori.php?id=<?php echo $k['category_id'] ?>" class="btn hapus" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="4">Tidak ada data</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


     <div class="section">
        <div class="container">
            <h3>Data Galeri Foto</h3>
            <div class="box">
                
            <p style="text-align: left;">
                <a href="tambah-image-admin.php">
                    <button style="padding: 10px 20px; background-color: #1201ff; color: white; border: none; border-radius: 4px; cursor: pointer; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; transition-duration: 0.4s;">Tambah Data</button>
                </a>
            </p>
                
                <br>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                           <th width="60px">No</th>
                           <th>Kategori</th>
                           <th>Nama User</th>
                           <th>Nama Foto</th>
                           <th>Deskripsi</th>
                           <th>Tanggal Dibuat</th>
                           <th>Gambar</th>
                           <th>Status</th>
                           <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						    $no = 1;
							if(isset($_SESSION['a_global']) && $_SESSION['a_global'] !== null){
                                // $user = $_SESSION['a_global']['admin_id'];
                                $foto = mysqli_query($conn, "SELECT * FROM tb_image");
                                if (mysqli_num_rows($foto) > 0) {
                                    while ($row = mysqli_fetch_array($foto)) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['admin_name'] ?></td>
                            <td><?php echo $row['image_name'] ?></td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;"><?php echo $row['image_description']?></td>
                            <td><?php echo $row['date_created']?></td>
                            <td><a href="foto/<?php echo $row['image']?>" target="_blank"><img src="foto/<?php echo $row['image']?>" width="50px"></a></td>
                            <td><?php echo ($row['image_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                            <td>
                                <div style="display: flex;">
                                    <a href="edit-image-admin.php?id=<?php echo $row['image_id'] ?>" style="background-color: #007bff; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Edit</a>
                                    <a href="proses-hapus-image.php?idp=<?php echo $row['image_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none; margin-left: 5px;">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else { ?>
                             <tr>
                                <td colspan="8">Tidak ada data</td>
                             </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
                            

    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Dimas gustiana.</small>
        </div>
    </footer>
</body>
</html>
                            