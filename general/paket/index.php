<?php
require_once "../../config/Database.php";

session_start();
if (!isset($_SESSION['username'])) {
    header('location: ../../login.php');
}

$query = $conn->query("SELECT qty_basic, qty_gold FROM tb_pengguna WHERE id_pengguna = '{$_SESSION['id_pengguna']}'");
$qty_up = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="<?= SITE_URL ?>/assets/css/packet.css" rel="stylesheet" />
    <script src="js/dashboard.js"></script>
</head>

<body>
    <div class="content-section" id="paket">
        <div class="cards-container">
            <?php
            $query = $conn->query("SELECT * FROM tb_paket");
            while ($rows = $query->fetch_assoc()) :
                echo "<div class='card'>";
                echo "<h3 class='card-title'>" . $rows['nama_paket'] . "</h3>";
                echo "<p class='card-description'>" . $rows['deskripsi'] . "</p>";
                echo "<p class='card-description'> Jumlah Tiket Basic" . str_repeat('&nbsp;', 1) . ": " . $rows['up_basic'] . "</p>";
                echo "<p class='card-description'> Jumlah Tiket Gold" . str_repeat('&nbsp;', 2) . ": " . $rows['up_gold'] . "</p>";
                echo "<div class='card-footer'>";
                echo "<span class='card-price'>Harga : Rp" . $rows['harga'] . "</span>";
                echo "<a href='paket/beli.php?id=" . $rows['id_paket'] . "' class='card-button'>Pilih Paket</a>";
                echo "</div>";
                echo "</div>";
            endwhile;
            ?>
        </div>
    </div>
</body>

</html>