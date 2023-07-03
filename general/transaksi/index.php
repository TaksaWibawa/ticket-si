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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--CSS-->
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/buy.css" />
    <!--END CSS-->

    <!--CSS BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!--END CSS BOOTSTRAP-->

    <title>Buy Ticket</title>
</head>

<body>
    <!-- Navbar  -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark py-3">
        <div class="container">
            <a href="" class="navbar-brand">
                <img width="70%" class="mobileLogo" src="<?= SITE_URL ?>/assets/img/logoMobile.svg" alt="">
            </a>
            <a class="navbar-brand" href="#"><img class="deskLogo" width="70%" src="<?= SITE_URL ?>/assets/img/Logo.svg" alt="" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    <a class="nav-link" href="#">Event Trending</a>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <a class="nav-link" href="<?php
                                                    if ($_SESSION['level'] == 2) {
                                                        echo SITE_URL . '/admin/dashboard';
                                                    } else {
                                                        echo SITE_URL . '/general/dashboard';
                                                    }
                                                    ?>">Dashboard</a>
                        <a class="nav-link" href="<?= SITE_URL ?>/proses/logout.php"><button id="daftar" class="border">Logout</button></a>
                    <?php else : ?>
                        <a class="nav-link" href="<?= SITE_URL ?>/registrasi.php"><button id="daftar" class="border">Daftar</button></a>
                        <a class="nav-link" href="<?= SITE_URL ?>/login.php"><button>Masuk</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- END Navbar  -->

    <div style="margin-top: 120px;" class="container">
        <div class="row">
            <?php
            $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket WHERE id_tiket = {$_GET['id']}");
            $rows = $query->fetch_assoc()
            ?>

            <div class="col-lg-8 col-md-12">
                <div class="imgBuyTick">
                    <img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $rows['foto_tiket'] ?>" alt="Foto Tiket" width="100%" style="border-radius: 40px;">
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="wrapContentDetail shadow">
                    <h3><?= $rows['judul_tiket'] ?></h3>
                    <p>Sisa Tiket : <?= $rows['stok'] ?></p>
                    <p>Rp. <?= $rows['harga'] ?></p>
                    <p><?= $rows['lokasi'] ?></p>
                    <div class="waktuDanTempat">
                        <div class="tanggal">
                            <img src="../../assets/loc.svg" alt=""> <span class="ms-2">Tanggal Even : <?= $rows['tanggal_akhir'] ?></span><br>
                        </div>
                    </div>
                </div>
                <div class="wrapButton shadow mt-4">
                    <form action="proses/create.php" method="post">
                        <input type="hidden" name="id_tiket" value="<?= $_GET['id'] ?>" />
                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Tiket DiBeli" />
                        <input type="submit" class="btn btn-dark w-100 mt-3" style="border-radius: 17px; padding: 13px;" value="Beli Sekarang" name="btn-submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Buy Section -->

    <!-- <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h3>Deskripsi</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, fugit nam? Laudantium vero quidem explicabo iure assumenda nemo sit dolor eligendi laboriosam labore voluptatibus doloremque, suscipit natus repudiandae sequi molestias. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia corrupti reiciendis hic minus? Similique saepe, iste maxime asperiores blanditiis labore, et, laborum veniam modi possimus alias magnam rem quasi corporis.</p>
                <h5>Syarat Dan Ketuentuan</h5>
                <ul>
                    <li>Kids >6 Tahun, teens & adults, untuk bayi tidak di rekomendasikan karena ruangan memiliki light sensitive.</li>
                    <li>Tidak boleh membawa makanan & minuman dalam bentuk apapun selama memasuki experience room</li>
                    <li>Ticket wajib ditukarkan di hari H, dengan jenjang waktu paling lambat 30 menit sebelum jam/kategori yang sudah dipilih dan ditentukan.</li>
                    <li>Setiap penukaran tiket harus menunjukkan identitas diri yang sesuai dengan data dari Loket.com</li>
                    <li>1 ticket berlaku untuk 1 pengunjung</li>
                    <li>Pembayaran hanya bisa menggunakan BCA Debit/Credit, Mastercard/Visa, Bank Transfer BCA dan BCA Virtual Account</li>
                    <li>1 ticket yang sudah di redeem TIDAK BISA DIGUNAKAN LAGI.</li>
                    <li>Setiap pengunjung harus memakai wristband yang sudah diberikan dan tidak boleh membawa pulang (akan dipotong saat selesai dengan experience room).</li>
                    <li>Show berlangsung selama 30 menit, dengan masing2 ruangan memiliki durasi 2-3 menit</li>
                    <li>Para pengunjung yang mengikuti tour guide diwajibkan TERTIB dan TAAT atas peraturan selama berada di area Ghostival.</li>
                    <li>Para pengunjung harus mengikuti tour guide sesuai dengan warna wristband dan kategori jam, tidak diperbolehkan untuk kembali ke ruangan sebelumnya.</li>
                    <li>Para pengunjung yang sudah keluar dari experience room TIDAK DIPERBOLEHKAN untuk masuk ke dalam experience room KECUALI jika pengunjung memiliki tiket untuk masuk di kategori selanjutnya.</li>
                    <li>Para pengunjung diharapkan tidak memegang CUTOUTS / MECHATRONICS / SCULPTURES yang tersedia di dalam experience room.</li>
                </ul>
            </div>
        </div>
    </div> -->

    <div class="container mt-3 pt-1 py-5">
        <div class="row">
            <div class="col-12">
                <h3>Ticket Price</h3>
            </div>
            <div class="col-lg-8 col-md-12 ">
                <?php
                $i = 1;
                $query = $conn->query("SELECT tb_tiket.* FROM tb_tiket 
                    LEFT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket 
                    WHERE tb_tiket_ekslusif.id_tiket IS NULL AND status = 1 AND id_pengguna = {$rows['id_pengguna']};");
                while ($rows_rel = $query->fetch_assoc()) :
                ?>
                    <div class="wrapTicket mt-3">
                        <h5><?= $rows_rel['judul_tiket'] ?></h5>
                        <p><?= $rows_rel['lokasi'] ?></p>
                        <p>Berakhir pada <?= date('d F Y', strtotime($rows_rel['tanggal_akhir'])); ?></p>
                        <hr>
                        <div class="PriceTicket">
                            <h5>Rp. <?= number_format($rows_rel['harga'], 2); ?></h5>
                            <a href="<?= SITE_URL ?>/general/transaksi/?id=<?= $rows_rel['id_tiket'] ?>" class="btn btn-dark">
                                Beli Ticket
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-footer py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <h4>Tentang Unitix</h4>
                        <a href="<?= SITE_URL ?>/login.php">
                            <p class="mt-4">Masuk</p>
                        </a>
                        <a href="">
                            <p>Biaya</p>
                        </a>
                        <a href="">
                            <p>Lihat Event</p>
                        </a>
                        <a href="">
                            <p>FAQ</p>
                            <a href="">
                                <p>Syarat dan Ketentuan</p>
                            </a>
                            <a href="">
                                <p>Laporan Kesalahan</p>
                            </a>
                            <a href="">
                                <p>Sistem</p>
                            </a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4>Rayakan Eventmu</h4>
                        <a href="">
                            <p class="mt-4">Cara Mempersiapkan Event</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event Agar Sukses</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event Lomba</p>
                        </a>
                        <a href="">
                            <p>Cara Mempublikasikan Event</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event Musik</p>
                        </a>
                        <a href="">
                            <p>Cara Mengelola Event</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Konsep Acara yang Menarik</p>
                        </a>
                        <a href="">
                            <p>Cara Membuat Event di Co-Working Space</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4>Lokasi Event</h4>
                        <a href="">
                            <p class="mt-4">Universitas Udayana</p>
                        </a>
                        <a href="">
                            <p>Universitas Airlangga</p>
                        </a>
                        <a href="">
                            <p>Universitas Gadjah Mada</p>
                        </a>
                        <a href="">
                            <p>Institut Teknologi Bandung</p>
                        </a>
                        <a href="">
                            <p>Universitas Indonesia</p>
                        </a>
                        <a href="">
                            <p>Universitas Trisakti</p>
                        </a>
                        <a href="">
                            <p>Universitas Pendidikan Ganesha</p>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h4>Kategori Event</h4>
                        <a href="">
                            <p class="mt-4">Event Webinar</p>
                        </a>
                        <a href="">
                            <p>Event Lomba</p>
                        </a>
                        <a href="">
                            <p>Event Konser</p>
                        </a>
                        <a href="">
                            <p>Event Workshop</p>
                        </a>
                        <a href="">
                            <p>Event Kompetisi</p>
                        </a>
                        <a href="">
                            <p>Event Kesenian</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <div id="success-msg" class="success-msg" aria-disabled="true"></div>

</body>

</html>