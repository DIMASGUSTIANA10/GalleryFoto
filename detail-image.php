<?php
include 'db.php';

// Mendapatkan informasi kontak admin
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
$a = mysqli_fetch_object($kontak);

// Mendapatkan informasi detail gambar
$produk = mysqli_query($conn, "SELECT tb_image.*, tb_category.category_name FROM tb_image INNER JOIN tb_category ON tb_image.category_id = tb_category.category_id WHERE tb_image.image_id = '" . $_GET['id'] . "'");
$p = mysqli_fetch_object($produk);

// Mengambil jumlah komentar
$result = mysqli_query($conn, "SELECT COUNT(*) AS total_comments FROM tb_image_comments WHERE image_id = '" . $_GET['id'] . "'");
$total_comments = mysqli_fetch_assoc($result)['total_comments'];

// Query untuk mendapatkan jumlah like
$result_likes = mysqli_query($conn, "SELECT likes FROM tb_image WHERE image_id = '" . $_GET['id'] . "'");
$likes = mysqli_fetch_assoc($result_likes)['likes'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WEB Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Gaya untuk tombol Like */
        .like-button {
            background-color:  #747474;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        /* Gaya untuk tombol Komentar */
        .comment-button {
            background-color: #747474;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Gaya untuk container komentar */
        .comments-container {
            display: ; /* Awalnya disembunyikan */
            margin-top: 20px;
        }

        /* Gaya untuk setiap komentar */
        .comment {
            background-color: #f2f2f2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        /* Gaya untuk form komentar */
        form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        /* Gaya untuk tombol Kirim Komentar */
        .submit-button {
            background-color: #474747;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .button-container {
            display: flex;
            align-items: center;
        }
        .button-container button {
            margin-right: 10px;
        }
    </style>
    <script>
        function toggleComments() {
            var commentsContainer = document.getElementById('comments-container');
            commentsContainer.classList.toggle('show');
        }
    </script>
</head>


<body>
    <header>
        <div class="container">
            <h1><a href="index.php">WEB GALERI FOTO</a></h1>
            <nav>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="galeri.php">Gallery</a></li>
                    <li><a href="registrasi.php">Registrasi</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
                <input type="hidden" name="kat" value="<?php echo isset($_GET['kat']) ? $_GET['kat'] : ''; ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- product detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                    <img src="foto/<?php echo $p->image ?>" width="100%" />
                </div>
                <div class="col-2">
                    <h3><?php echo $p->image_name ?><br />Kategori : <?php echo $p->category_name  ?></h3>
                    <h4>Nama User : <?php echo $p->admin_name ?><br />
                        Upload Pada Tanggal : <?php echo $p->date_created  ?></h4>
                    <p>Deskripsi :<br />
                        <?php echo $p->image_description ?>
                    </p>


                    <!-- Menampilkan jumlah like -->
                    <p>Jumlah Like: <span id="likes-count"><?php echo $likes; ?></span></p>

                    <!-- Menampilkan jumlah komentar -->
                    <p>Jumlah Komentar: <?php echo $total_comments; ?></p>
                    
                    <!-- Tombol Like -->
                    <div class="button-container">
                    <form action="addlike.php" method="post">
                        <input type="hidden" name="image_id" value="<?php echo $p->image_id; ?>">
                        <button type="submit" name="submit" class="like-button"><i class="fas fa-heart"></i></button>
                    </form>

                    <!-- Tombol yang memunculkan daftar komentar -->
                    <button onclick="toggleComments()" class="comment-button"><i class="fas fa-comment"></i></button>
                    </div>

                    <!-- Daftar komentar (awalnya disembunyikan) -->
                    <div id="comments-container" class="comments-container">
                        <?php
                        // Query untuk mendapatkan daftar komentar
                        $query_comments = mysqli_query($conn, "SELECT * FROM tb_image_comments WHERE image_id = '" . $_GET['id'] . "'");
                        while ($comment = mysqli_fetch_assoc($query_comments)) {
                        ?>
                            <div class="comment">
                                <p><?php echo $comment['comment']; ?></p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    

                    <!-- Form komentar -->
                    <form action="addcomment.php" method="post">
                        <input type="hidden" name="image_id" value="<?php echo $p->image_id; ?>">
                        <textarea name="comment" placeholder="Tambahkan komentar Anda"></textarea>
                        <button type="submit" name="submit" class="submit-button">Kirim Komentar</button>
                    </form>

                </div>
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