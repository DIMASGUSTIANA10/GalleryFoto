<?php
    include 'db.php';
    session_start(); // Mulai session

    // Cek jika form registrasi telah disubmit
    if(isset($_POST['submit'])){
        $nama = ucwords($_POST['nama']);
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $telpon = $_POST['tlp'];
        $mail = $_POST['email'];
        $alamat = ucwords($_POST['almt']);
        
        // Masukkan data user ke dalam database
        $insert = mysqli_query($conn, "INSERT INTO tb_admin (admin_name, username, password, admin_telp, admin_email, admin_address, role) VALUES (
            '$nama',
            '$username',
            '$password',
            '$telpon',
            '$mail',
            '$alamat',
            'user'
        )");

        // Jika registrasi berhasil
        if($insert){
            echo '<script>alert("Registrasi berhasil")</script>';
            // Set session untuk data user yang baru saja diregistrasi
            $_SESSION['nama'] = $nama;
            $_SESSION['username'] = $username;
            $_SESSION['telpon'] = $telpon;
            $_SESSION['email'] = $mail;
            $_SESSION['alamat'] = $alamat;
            // Redirect ke halaman profil
            echo '<script>window.location="profil.php"</script>';
        }else{
            echo 'gagal '.mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrasi Akun</title>
<link rel="stylesheet" type="text/css" href="css/registrasi.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-LqIh+1LhpFZdF0h2xaLJwu2CtvLa8K37ifpyW5I15Lz+HvDzd2eXtdZvmfLSsB4LpULM5vysSMf3Z4RNo4IWXQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<header class="header">
  <div class="container header-content">
    <h1><a href="index.php" style="color: #fff;">WEB GALERI FOTO</a></h1>
    <div class="nav-links">
        <ul>
           <li><a href="galeri.php" style="color: #fff;">Galeri</a></li>
           <li><a href="registrasi.php" style="color: #fff;">Registrasi</a></li>
           <li><a href="login.php" style="color: #fff;">Login</a></li>
        </ul>
    </div>
  </div>
</header>

<div class="section">
  <div class="container">
    <div class="form-group">
      <h3>Registrasi Akun</h3>
      <form action="" method="POST">  
        <div class="group-3101">
          <i class="fas fa-user icon"></i>
          <input type="text" name="nama" placeholder="Nama User" class="input-control" required>
        </div>
        <div class="group-3101">
          <i class="fas fa-user icon"></i>
          <input type="text" name="user" placeholder="Username" class="input-control" required>
        </div>
        <div class="group-3101">
          <i class="fas fa-lock icon"></i>
          <input type="password" name="pass" placeholder="Password" class="input-control" required>
        </div>
        <div class="group-3101">
          <i class="fas fa-phone icon"></i>
          <input type="text" name="tlp" placeholder="Nomor Telpon" class="input-control" required>
        </div>
        <div class="group-3101">
          <i class="fas fa-envelope icon"></i>
          <input type="text" name="email" placeholder="E-mail" class="input-control" required>
        </div>
        <div class="group-3101">
          <i class="fas fa-map-marker-alt icon"></i>
          <input type="text" name="almt" placeholder="Alamat" class="input-control" required>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn">
      </form>
      <?php
      if(isset($_POST['submit'])){
          $nama = ucwords($_POST['nama']);
          $username = $_POST['user'];
          $password = $_POST['pass'];
          $telpon = $_POST['tlp'];
          $mail = $_POST['email'];
          $alamat = ucwords($_POST['almt']);
          
          $insert = mysqli_query($conn, "INSERT INTO tb_admin VALUES (
          null,
          '".$nama."',
          '".$username."',
          '".$password."',
          '".$telpon."',
          '".$mail."',
          '".$alamat."',
          'user'
          )
          
          ");
          if($insert){
            echo '<script>alert("Registrasi berhasil")</script>';
            echo '<script>window.location="login.php"</script>';
          }else{
              echo 'gagal '.mysqli_error($conn);
          }
          
         }
      ?>
    </div>
  </div>
</div>
<footer class="footer">
  <div class="container">
    <small>&copy; 2024 - Dimas gustiana</small>
  </div>
</footer>
</body>
</html>
