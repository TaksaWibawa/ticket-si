<?php
    require_once "../../config/Database.php";

    session_start();
    if (!isset($_SESSION['username'])) { 
        header('location: ../../login.php');
    }

    $query = $conn->query("SELECT qty_basic, qty_gold FROM tb_pengguna WHERE id_pengguna = {$_SESSION['id_pengguna']}");
    $qty_up = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tiket</title>
    <link rel="stylesheet" href="../../assets/css/buyTicket.css">
</head>
<body>
    <div class="container">
        <form action="tiket/proses/create.php" method="post" enctype="multipart/form-data" role="form" onchange>
            <label for="judul_tiket">Tiket:</label>
            <input type="text" name="judul_tiket" id="judul_tiket">
            <br/>
            <div class="form-upload">
                <label for="foto_tiket">Foto Tiket:</label>
                <input type="file" name="file" id="foto_tiket" onchange="handleFileUpload(this)">
                <label for="foto_tiket" class="custom-file-upload">Choose File</label>
            </div>
            <br/>
            <label for="stok">Stok:</label>
            <input type="number" name="stok" id="stok">
            <br/>
            <label for="harga">Harga:</label>
            <input type="number" name="harga" id="harga">
            <br/>
            <label for="lokasi">Lokasi:</label>
            <textarea name="lokasi" id="lokasi" cols="30" rows="10"></textarea>
            <br/>
            <label for="tanggal_akhir">Tanggal Berakhir:</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir">

            <?php if ($qty_up['qty_basic'] > 0) : ?>
                <input type="radio" name="up_tiket" value="basic" id="" required/> Basic (<?= $qty_up['qty_basic'] ?>)
            <?php else : ?>
                <input type="radio" name="up_tiket" id="" disabled/> Basic (<?= $qty_up['qty_basic'] ?>)
            <?php endif ?>

            <?php if ($qty_up['qty_gold'] > 0) : ?>
                <input type="radio" name="up_tiket" value="gold" id="tiket_gold" required/> Gold (<?= $qty_up['qty_gold'] ?>)
                <p id="label" style="color: green">
                  Jika Menggunakan Tiket Gold, silahkan Upload Gambar dibawah ini:
                </p>
                <div class="form-upload">
                  <input type="file" name="file_ekslusif" id="foto_ekslusif" onchange="handleFileUpload(this)">
                  <label for="foto_ekslusif" class="custom-file-upload">Choose File</label>
                </div>
            <?php else : ?>
                <input type="radio" name="up_tiket" id="tiket_gold" disabled/> Gold (<?= $qty_up['qty_gold'] ?>)
            <?php endif ?>

            <input type="submit" value="Buat Tiket" name="btn-submit"/>
        </form>
        <div id="upload-status" class="alert" aria-disabled="true"></div>
        <img id="image-preview" class="image-preview" src="" alt="Image Preview">
    </div>
</body>
<script src="js/tiket.js"></script>
<script src="js/img-preview.js"></script>
</html>
