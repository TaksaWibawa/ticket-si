<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/register.css">
    <title>Daftar</title>
  </head>
  <body>
    <div class="container">
        <div class="left-column">
            <form action="proses/proses_register.php" method="POST">
                <h1>Sign Up</h1>
                <input type="text" name="nama_pengguna" placeholder="Full Name" required>
                <input type="text" name="telp" placeholder="Phone Number" required>
                <input type="text" name="alamat" id="alamat" placeholder="Address" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="btn-submit" value="Sign Up">

                <p>Dengan login kamu menyetujui <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> UniTix.</p>

                <p>Sudah punya akun? <a href="login.php">Log In aja</a></p>
            </form>
            <div id="credit">
                <img src="assets/img/credential.png" alt="logo">
                <p>
                    © 2011-2023 PT.UniTix. All Rights Reserved
                </p>
            </div>
        </div>
        <div class="right-column">
            <div class="bg"></div>
            <div class="content">
                <h1>
                    Bisa liburan ala <span>Sultan</span>, tapi <span>dompet</span> tetap <span>aman</span>!
                </h1>
                <p>Buat akun untuk dapet harga lebih hemat, diskon ekstra, & asuransi gratis.</p>
                <!-- tambah logo nanti disini -->
            </div>
        </div>
        <div id="alert-msg" class="alert-msg" aria-disabled="true"></div>
    </div>
</body>
<script src="general/js/alert.js"></script>
</html>