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
  <title></title>
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
          <a href="<?= SITE_URL ?>/admin/paket">Tambah Paket</a>
        </li>
        <li class="menu-item">
          <a href="<?= SITE_URL ?>/admin/paket/kelola.php">Kelola Paket</a>
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
        <li class="menu-item">
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
      <div class="content"></div>
    </div>
  </div>
  <div id="alert-msg" class="alert-msg" aria-disabled="true"></div>
  <a href="https://api.whatsapp.com/send?phone=6287781390370" class="whatsapp-button" target="_blank">
    <div class="whatsapp-logo">
      <img src="../../assets/img/whatsapp.png" alt="WhatsApp Logo">
      <div class="chat-circle"></div>
    </div>
  </a>
  <script src="js/tiket.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/searchBar.js"></script>
  <script src="js/img-preview.js"></script>
  <script src="js/alert.js"></script>
</body>

</html>