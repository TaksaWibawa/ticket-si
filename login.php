<?php
    session_start();
    if(isset($_SESSION['username'])) { 
        header('location: general/index.php');
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Masuk</title>
  </head>
  <body>
    <div class="container">
        <div class="left-column">
            <div class="bg"></div>
            <div class="content">
                <h1>
                    Mari <span>Log In</span> dan nikmati semua <span>keuntungannya!</span>
                </h1>
                <p>Kamu cukup masukkan nomor ponsel atau email aja, kok.</p>
                <!-- tambah logo nanti disini -->
            </div>
        </div>
        <div class="right-column">
            <form action="proses/proses_login.php" method="POST">
                <h1>Log In</h1>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="btn-submit" value="Log In">

                <p>Dengan login kamu menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> UniTix.</p>

                <p>Belum punya akun? <a href="registrasi.php">Buat Akun yuk!</a></p>
            </form>
            <div id="credit">
                <img src="assets/img/credential.png" alt="logo">
                <p>
                    © 2011-2023 PT.UniTix. All Rights Reserved
                </p>
            </div>
        </div>
        <div id="alert-msg" class="alert-msg" aria-disabled="true"></div>
    </div>
</body>
<script src="general/js/alert.js"></script>
</html>