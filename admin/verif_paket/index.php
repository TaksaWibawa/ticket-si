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
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/tiketHistory.css">
</head>

<body>
    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th width="100px">Bukti Pembayaran</th>
                <th>Paket</th>
                <th>Pengguna</th>
                <th>Harga</th>
                <th>Tanggal Beli</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $query = $conn->query("SELECT tb_transaksi_paket.*, tb_paket.nama_paket, tb_pengguna.nama_pengguna FROM tb_transaksi_paket 
                INNER JOIN tb_paket ON tb_paket.id_paket = tb_transaksi_paket.id_paket
                INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_transaksi_paket.id_pengguna
                WHERE status_bayar = '0'");
            while ($rows = $query->fetch_assoc()) :
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td>
                        <img src="<?= SITE_URL ?>/general/up_file/bukti_paket/<?= $rows['foto_bukti'] ?>" alt="Foto Bayar Paket" width="100%">
                    </td>
                    <td><?= $rows['nama_paket'] ?></td>
                    <td><?= $rows['nama_pengguna'] ?></td>
                    <td><?= $rows['harga'] ?></td>
                    <td><?= $rows['tanggal'] ?></td>
                    <td>
                        <a href="verif_paket/proses/verif.php?id=<?= $rows['id_transaksi_paket'] ?>" id="verif">Verifikasi</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>