<?php
    session_start();
    include 'db.php';
    if ($_SESSION['status_login'] != true) {
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-LqIh+1LhpFZdF0h2xaLJwu2CtvLa8K37ifpyW5I15Lz+HvDzd2eXtdZvmfLSsB4LpULM5vysSMf3Z4RNo4IWXQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- header -->
    <header class="header">
        <div class="container header-content">
            <h1><a href="dashboard.php" style="color: #fff;">WEB GALERI FOTO</a></h1>
            <div class="nav-links">
                <ul>
                    <li><a href="dashboard.php" style="color: #fff;">Dashboard</a></li>
                    <li><a href="profil.php" style="color: #fff;">Profil</a></li>
                    <li><a href="data-image.php" style="color: #fff;">Data Foto</a></li>
                    <li><a href="Keluar.php" style="color: #fff;">Keluar</a></li>
                </ul>
            </div>
        </div>
    </header>
    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="form-group">
                <h3>Tambah Data Foto</h3>
                <div class="box">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <select class="input-control" name="kategori" required>
                            <option value="">-Pilih Kategori Foto-</option>
                            <?php   
                                $result = mysqli_query($conn,"SELECT * FROM tb_category");   
                                while ($row = mysqli_fetch_array($result)) {  
                                    echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';  
                                }
                            ?>
                        </select>
                        <input type="hidden" name="nama_kategori" id="prd_name">
                        <input type="hidden" name="adminid"
                            value="<?php echo $_SESSION['a_global']['admin_id'] ?>">
                        <input type="text" name="namaadmin" class="input-control"
                            value="<?php echo $_SESSION['a_global']['username'] ?>" readonly="readonly">
                        <input type="text" name="nama" class="input-control" placeholder="Nama Foto" required>
                        <textarea class="input-control" name="deskripsi"
                            placeholder="Deskripsi"></textarea><br />
                        <input type="file" name="gambar" class="input-control" required>
                        <select class="input-control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>
                    <?php
                        if(isset($_POST['submit'])){
                            // Tangkap inputan dari form
                            $kategori  = $_POST['kategori'];
                            $nama_kategori   = $_POST['nama_kategori'];
                            $admin_id       = $_POST['adminid'];
                            $user_name      = $_POST['namaadmin'];
                            $nama_foto      = $_POST['nama'];
                            $deskripsi      = $_POST['deskripsi'];
                            $status         = $_POST['status'];
                            // Tangkap data file yang diupload
                            $filename = $_FILES['gambar']['name'];
                            $tmp_name = $_FILES['gambar']['tmp_name'];
                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];
                            $newname = 'foto'.time().'.'.$type2;
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
                            // Validasi format file
                            if(!in_array($type2, $tipe_diizinkan)){
                                // Jika format file tidak ada di dalam tipe diizinkan
                                echo '<script>alert("Format file tidak diizinkan")</script>';
                            }else{
                                // Jika format file sesuai dengan yang ada di dalam array tipe diizinkan
                                // Proses upload file sekaligus insert ke database
                                move_uploaded_file($tmp_name, './foto/'.$newname);
                                $insert = mysqli_query($conn, "INSERT INTO tb_image (category_id, category_name, admin_id, admin_name, image_name, image_description, image, date_created) VALUES (
                                    '$kategori',
                                    '$nama_kategori',
                                    '$admin_id',
                                    '$user_name',
                                    '$nama_foto',
                                    '$deskripsi',
                                    '$newname',
                                    NOW()
                                )");
                                
                                
                                if($insert){
                                    echo '<script>alert("Tambah Foto berhasil")</script>';
                                    echo '<script>window.location="data-image.php"</script>';
                                }else{
                                    echo 'Gagal'.mysqli_error($conn);
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <small>Copyright &copy; 2024 - Dimas gustiana</small>
        </div>
    </footer>
    <script>
        CKEDITOR.replace('deskripsi');  
    </script>
</body>
</html>
