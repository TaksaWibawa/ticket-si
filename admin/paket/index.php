<?php
require_once "../../config/Database.php";

session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../../assets/css/buyTicket.css">
</head>

<body>
    <div class="container">
        <form action="paket/proses/create.php" method="post">
            <label for="nama_paket">Nama Paket : </label>
            <input type="text" name="nama_paket" id="nama_paket">
            <br />
            <label for="harga">Harga : </label>
            <input type="number" name="harga" id="harga">
            <br />
            <label for="up_basic">Tiket Normal : </label>
            <input type="number" name="up_basic" id="up_basic">
            <br />
            <label for="up_gold">Tiket Ekslusif : </label>
            <input type="number" name="up_gold" id="up_gold">
            <br />
            <label for="deskripsi">Deskripsi : </label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea>
            <br />
            <input type="submit" value="Submit" name="btn-submit" />
            <br /><br />
        </form>
    </div>
</body>

</html>