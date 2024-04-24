<?php
session_start();
include 'db.php';

// Periksa apakah pengguna masuk atau tidak
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true) {
    echo '<script>window.location="login.php"</script>';
    exit; // Hentikan proses eksekusi script
}

// Inisialisasi variabel $where
$where = '';

// Periksa apakah variabel $_GET['search'] dan $_GET['kat'] sudah didefinisikan
if(isset($_GET['search']) && isset($_GET['kat'])) {
    // Gunakan filter_var untuk mencegah SQL Injection
    $search = filter_var($_GET['search'], FILTER_SANITIZE_STRING);
    $kat = filter_var($_GET['kat'], FILTER_SANITIZE_STRING);
    
    // Jika $_GET['search'] dan $_GET['kat'] tidak kosong, tambahkan ke kondisi $where
    if(!empty($search) && !empty($kat)) {
        $where = "AND image_name LIKE '%$search%' AND category_id LIKE '%$kat%' ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="dashboard.php">WEB GALERI FOTO</a></h1>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-image.php">Data Foto</a></li>
                <li><a href="Keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="box">
                <?php if(isset($_SESSION['a_global']) && is_object($_SESSION['a_global'])) : ?>
                    <h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?> di Website Galeri Foto</h4>
                <?php else : ?>
                    <h4>Selamat Datang di Website Galeri Foto</h4>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="search">
            <form action="galeri.php" method="GET">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
                <input type="hidden" name="kat" value="<?php echo isset($_GET['kat']) ? $_GET['kat'] : ''; ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>Galeri Foto</h3>
            <div class="box">
                <?php
                // Lakukan query dengan kondisi $where
                $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 $where ORDER BY image_id DESC");
                if($foto && mysqli_num_rows($foto) > 0){
                    while($p = mysqli_fetch_array($foto)){
                ?>
                    <a href="detail-image.php?id=<?php echo $p['image_id'] ?>">
                        <div class="col-4">
                            <img src="foto/<?php echo $p['image'] ?>" height="150px" />
                            <p class="nama"><?php echo isset($p['image_name']) ? substr($p['image_name'], 0, 30) : ''; ?></p>
                            <p class="harga"><?php echo isset($p['admin_name']) ? substr($p['admin_name'], 0, 30) : ''; ?></p>
                            <p class="admin">Nama User : <?php echo isset($p['admin_name']) ? $p['admin_name'] : ''; ?></p>
                            <p class="nama"><?php echo isset($p['date_created']) ? $p['date_created'] : ''; ?></p>
                        </div>
                    </a>
                <?php 
                    }
                } else { 
                    echo "<p>Foto tidak ada</p>";
                }
                ?>
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
