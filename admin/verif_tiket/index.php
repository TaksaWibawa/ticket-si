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
    <link rel="stylesheet" href="../../assets/css/tiketHistory.css">
</head>

<body>
    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th>Tiket</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Lokasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket WHERE status = '0'");
            while ($rows = $query->fetch_assoc()) :
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $rows['judul_tiket'] ?></td>
                    <td><?= $rows['tanggal_buat'] ?></td>
                    <td><?= $rows['tanggal_akhir'] ?></td>
                    <td><?= $rows['stok'] ?></td>
                    <td><?= $rows['harga'] ?></td>
                    <td><?= $rows['lokasi'] ?></td>
                    <td>
                        <a href="verif_tiket/proses/verif.php?id=<?= $rows['id_tiket'] ?>" id="verif">Verifikasi</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>