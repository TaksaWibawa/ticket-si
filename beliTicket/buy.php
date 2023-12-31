<?php
require_once "./../config/Database.php";

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
                <img width="70%" class="mobileLogo" src="../../assets/logoMobile.svg" alt="">
            </a>
            <a class="navbar-brand" href="#"><img class="deskLogo" width="70%" src="../../assets//Logo.svg" alt="" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="<?= SITE_URL ?>/proses/logout.php">Beranda</a>
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

    <!-- Buy Section -->
    <?php include "./ticketDetail/ticketPicture.php" ?>
    <!-- End Buy Section -->

    <!-- Desc Section -->
    <?php include "./descTicket/descTicket.php" ?>
    <!-- End Desc Section -->

    <!-- Desc Section -->
    <?php include "./ticketPrice/price.php" ?>
    <!-- End Desc Section -->

    <!-- Footer -->
    <?php include '../../Components/footer.php' ?>
    <!-- End Footer -->

    <!--JS BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--END JS BOOTSTRAP-->
</body>

</html>