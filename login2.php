<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Web Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<style>
	  body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .box-login {
        width: 300px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .box-login h2 {
        text-align: center;
    }
    .box-login form {
        margin-top: 20px;
    }
</style>

<body id="bg-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php
        session_start();
        if(isset($_POST['submit'])){
            include 'db.php';

            // Validasi input
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pass = mysqli_real_escape_string($conn, $_POST['pass']);

            // Query untuk mencari pengguna dengan username dan password yang cocok
            $query = mysqli_prepare($conn, "SELECT admin_id, username, role FROM tb_admin WHERE username = ? AND password = ?");
            mysqli_stmt_bind_param($query, "ss", $user, $pass);
            mysqli_stmt_execute($query);

            // Bind result
            mysqli_stmt_bind_result($query, $admin_id, $username, $role);

            // Store result
            mysqli_stmt_store_result($query);

            if(mysqli_stmt_num_rows($query) > 0){
                mysqli_stmt_fetch($query);

                // Simpan informasi admin dalam sesi
                $_SESSION['status_login'] = true;
                $_SESSION['a_global'] = [
                    'admin_id' => $admin_id,
                    'username' => $username,
                    'role' => $role
                ];

                // Alihkan ke halaman admin
                if($role == 'user'){
                    header('Location: dashboard.php');
                }else{
                    header('Location: admin.php');
                }
                exit();
            } else {
                echo '<p style="color:red;">Username atau password Anda salah.</p>';
            }
        }
        ?><br>
        <p>Belum punya akun? Daftar <a style="color:#00C;" href="registrasi.php">DISINI</a></p>
        <p>atau klik <a style="color:#00C;" href="index.php">Kembali</a></p>
    </div>
</body>
</html>