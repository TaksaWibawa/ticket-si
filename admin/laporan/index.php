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
    <table border="1px" width="70%">
      <thead>
        <tr>
          <th>#</th>
          <th>Tiket</th>
          <th>Penjualan Tiket</th>
          <th>Sisa Tiket</th>
          <th>Pendapatan</th>
          <th>Pemilik Tiket</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        // $query = $conn->query("SELECT tb_tiket.*, tb_pengguna.nama_pengguna FROM tb_tiket 
        //   INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_tiket.id_pengguna 
        //   WHERE tb_tiket.status <> '0'");
        $query = $conn->query("SELECT tb_tiket.*, tb_pengguna.nama_pengguna, COALESCE(SUM(tb_transaksi_tiket.qty), 0) AS total_qty_penjualan, COALESCE(SUM(tb_transaksi_tiket.qty * tb_tiket.harga), 0) AS total_pendapatan
        FROM tb_tiket
        LEFT JOIN tb_transaksi_tiket ON tb_tiket.id_tiket = tb_transaksi_tiket.id_tiket
        INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_tiket.id_pengguna
        WHERE tb_tiket.status <> '0'
        GROUP BY tb_tiket.id_tiket, tb_pengguna.nama_pengguna;            
        ");
        // SELECT tiket.judul_tiket, SUM(transaksi_tiket.qty) AS total_qty_penjualan
        // FROM tiket
        // JOIN transaksi_tiket ON tiket.id_tiket = transaksi_tiket.id_tiket
        // WHERE transaksi_tiket.status_bayar = 1
        // GROUP BY tiket.judul_tiket;
        while ($rows = $query->fetch_assoc()) :
        ?>
          <tr>
            <td><?= $i++; ?></td>
            <td><?= $rows['judul_tiket'] ?></td>
            <td><?= $rows['total_qty_penjualan'] ?></td>
            <td><?= $rows['stok'] ?></td>
            <td>Rp. <?= $rows['total_pendapatan'] ?></td>
            <td>
              <?= $rows['nama_pengguna'] ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
</body>
</html>