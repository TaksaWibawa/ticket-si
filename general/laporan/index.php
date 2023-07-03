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
    <title>Tiket History</title>
    <link rel="stylesheet" href="../../assets/css/tiketHistory.css">
</head>

<body>
    <?php
    $query = $conn->query("SELECT tb_transaksi_tiket.*, tb_tiket.judul_tiket, tb_tiket.foto_tiket FROM tb_transaksi_tiket 
                INNER JOIN tb_tiket ON tb_tiket.id_tiket = tb_transaksi_tiket.id_tiket 
                WHERE tb_transaksi_tiket.id_pengguna = {$_SESSION['id_pengguna']} AND status_bayar = '1'");
    $rowCount = $query->num_rows;

    if ($rowCount > 0) {
    ?>
        <table border="1px" width="70%">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="150px">Gambar</th>
                    <th>Tiket</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Tanggal Beli</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($rows = $query->fetch_assoc()) :
                ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" alt="Foto Tiket" width="100%"></td>
                        <td><?= $rows['judul_tiket'] ?></td>
                        <td><?= $rows['qty'] ?></td>
                        <td><?= $rows['harga'] ?></td>
                        <td><?= $rows['tanggal_beli'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br />
    <?php } else {
        echo "<p>No data available</p>";
    } ?>

</body>
</html>
