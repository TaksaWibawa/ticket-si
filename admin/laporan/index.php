<?php
require_once "../../config/Database.php";

session_start();
if (!isset($_SESSION['username'])) {
  header('location: ../../login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="<?= SITE_URL ?>/assets/css/dashboard.css" rel="stylesheet" />
  <title>Selamat Datang!</title>
  <script>
    // Disable right-click on sidebar links
    document.addEventListener("DOMContentLoaded", function() {
      var sidebarLinks = document.querySelectorAll(".menu-item a");

      sidebarLinks.forEach(function(link) {
        link.addEventListener("contextmenu", function(event) {
          event.preventDefault();
        });
      });
    });
  </script>
</head>

<body>
  <div class="dashboard-container">
    <div class="sidebar">
      <div class="logo">
        <img src="../../assets/img/Logo Sidebar.png" alt="logo" />
        <div class="line"></div>
      </div>
      <ul class="menu">
        <li class="menu-item">
          <a href="<?= SITE_URL ?>/admin/paket">Kelola Paket</a>
        </li>
        <li class="menu-item">
          <a href="<?= SITE_URL ?>/admin/tiket">Kelola Event</a>
        </li>
        <li class="menu-item">
          <a href="<?= SITE_URL ?>/admin/verif_paket">Verifikasi Paket</a>
        </li>
        <li class="menu-item">
          <a href="<?= SITE_URL ?>/admin/verif_tiket">Verifikasi Tiket</a>
        </li>
        <li class="menu-item active">
          <a href="<?= SITE_URL ?>/admin/laporan">Laporan</a>
        </li>
        <li class="menu-item logout">
          <a href="../../index.php">Kembali ke Halaman Utama</a>
        </li>
      </ul>
    </div>
    <div class="main-content">
      <div class="navbar">
        <h2 class="title" id="navbar-title">Menu Paket</h2>
        <div class="search">
          <input type="text" id="search-input" placeholder="Cari" class="search-input" oninput="search()" autocomplete="off" />
          <button class="search-button" onclick="search()">
            <img src="../../assets/img/search.svg" alt="search" />
          </button>
        </div>
      </div>

      <div class="content">
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
      </div>

    </div>
  </div>
  <div id="alert-msg" class="alert-msg" aria-disabled="true"></div>
  <script src="js/tiket.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/searchBar.js"></script>
  <script src="js/img-preview.js"></script>
  <script src="js/alert.js"></script>
</body>

</html>