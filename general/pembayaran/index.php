<?php
    require_once "../../config/Database.php";

    session_start();
    if(!isset($_SESSION['username'])) { 
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
    <link rel="stylesheet" href="../../assets/css/tiketHistory.css">
</head>
<body>
    <table border="1px" width="70%">
        <thead>
            <tr>
                <th>#</th>
                <th width="100px">Gambar</th>
                <th>Tiket</th>
                <th>Tanggal Beli</th>
                <th>Bayar Sampai</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            $id = $_SESSION['id_pengguna'];
            $query = $conn->query("SELECT tb_transaksi_tiket.*, tb_transaksi_tiket.tanggal_beli + INTERVAL '30' MINUTE AS tanggal_bayar, tb_tiket.judul_tiket, tb_tiket.foto_tiket FROM tb_transaksi_tiket 
                INNER JOIN tb_tiket ON tb_tiket.id_tiket = tb_transaksi_tiket.id_tiket 
                WHERE tb_transaksi_tiket.id_pengguna = '$id' AND status_bayar = 0;");
            while($rows = $query->fetch_assoc()):
        ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" alt="Foto Tiket" width="100%"></td>
                <td><?= $rows['judul_tiket'] ?></td>
                <td><?= $rows['tanggal_beli'] ?></td>
                <td>
                    <?php if($rows['tanggal_bayar'] > date('Y-m-d H:i:s')): ?>
                        <span style="color: green"><?= $rows['tanggal_bayar'] ?></span>
                    <?php else: ?>
                        <span style="color: red"><?= $rows['tanggal_bayar'] ?></span>
                    <?php endif; ?>
                </td>
                <td><?= $rows['qty'] ?></td>
                <td>Rp. <?= $rows['harga'] ?></td>
                <td>
                    <?php if(date('Y-m-d H:i:s') <= $rows['tanggal_bayar']) : ?>
                        <a href="pembayaran/bayar.php?id=<?= $rows['id_transaksi_tiket'] ?>" id="verif">Bayar</a>
                    <?php else : ?>
                        <a href="#" onclick="alert('Maaf, tanggal pembayaran sudah lewat!')" id="verif">Bayar</a>
                    <?php endif; ?>
                </td>
            </tr>  
        <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>