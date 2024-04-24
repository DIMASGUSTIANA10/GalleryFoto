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
    <title>Tambah Kategori Foto</title>
    <link rel="stylesheet" type="text/css" href="css/tambah-category.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-LqIh+1LhpFZdF0h2xaLJwu2CtvLa8K37ifpyW5I15Lz+HvDzd2eXtdZvmfLSsB4LpULM5vysSMf3Z4RNo4IWXQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- header -->
    <header class="header"
        <div class="container header-content">
            <h1><a href="dashboard.php" style="color: #fff;"> <center>WEB GALERI FOTO</center></a></h1>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="form-group">
                <h3>Tambah Data Kategori Foto</h3>
                <div class="box">

                    <form action="" method="POST">

                        <input type="text" name="nama_kategori" class="input-control" placeholder="Nama Kategori"
                            required>

                        <textarea class="input-control" name="deskripsi"
                            placeholder="Deskripsi"></textarea><br />

                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>
                    <?php
                        if(isset($_POST['submit'])){
                            
                            // menampung inputan dari form
                            $nama_kategori = $_POST['nama_kategori'];
                            $deskripsi = $_POST['deskripsi'];
                            
                            // insert data kategori ke database
                            $insert = mysqli_query($conn, "INSERT INTO tb_category (category_name) VALUES (
                                '".$nama_kategori."'
                            ) ");
                                                
                            if($insert){
                                echo '<script>alert("Tambah Kategori berhasil")</script>';
                                echo '<script>window.location="admin.php"</script>';
                            }else{
                                echo 'gagal'.mysqli_error($conn);
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
</body>
</html>