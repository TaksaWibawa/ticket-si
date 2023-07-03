<?php
    require_once "../../config/Database.php";

    session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../login.php');
    }

    $query = $conn->query("SELECT qty_basic, qty_gold FROM tb_pengguna WHERE id_pengguna = {$_SESSION['id_pengguna']}");
    $qty_up = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket History</title>
    <link rel="stylesheet" href="../../assets/css/eventHistory.css">
</head>
<body>
    <div class="container">
        <?php
            $i = 1;
            $id = $_SESSION['id_pengguna'];
            $query = $conn->query("SELECT tb_tiket.*, tb_tiket_ekslusif.foto_ekslusif FROM tb_tiket 
                RIGHT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket 
                WHERE id_pengguna = $id;");
            $basicQuery = $conn->query("SELECT * FROM tb_tiket
                LEFT JOIN tb_tiket_ekslusif ON tb_tiket.id_tiket = tb_tiket_ekslusif.id_tiket
                WHERE id_pengguna = $id AND tb_tiket_ekslusif.id_tiket IS NULL");
            
            $hasData = false;

            if ($query->num_rows > 0 || $basicQuery->num_rows > 0) {
                $hasData = true;
        ?>
        <table border="1px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe</th>
                    <th width="150px">Gambar</th>
                    <th>Tiket</th>
                    <th>Tanggal Awal</th>
                    <th>Tanggal Akhir</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($rows = $query->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td>Gold</td>
                    <td><img src="<?= SITE_URL ?>/general/up_file/foto_ekslusif/<?= $rows['foto_ekslusif'] ?>" alt="Foto Tiket Ekslusif" width="100%"></td>
                    <td><?= $rows['judul_tiket'] ?></td>
                    <td><?= $rows['tanggal_buat'] ?></td>
                    <td><?= $rows['tanggal_akhir'] ?></td>
                    <td><?= $rows['stok'] ?></td>
                    <td><?= $rows['harga'] ?></td>
                    <td><?= $rows['lokasi'] ?></td>
                    <td>
                        <?php if($rows['status'] == 0) :?>
                            <span style="color: red">Menunggu Verifikasi</span>
                        <?php else: ?>
                            <span style="color: green">Terverifikasi</span>
                        <?php endif; ?>
                    </td>
                </tr>  
            <?php endwhile; ?>

            <?php
                while($basicRows = $basicQuery->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td>Basic</td>
                    <td><img src="<?= SITE_URL ?>/general/up_file/foto_tiket/<?= $basicRows['foto_tiket'] ?>" alt="Foto Tiket" width="100%"></td>
                    <td><?= $basicRows['judul_tiket'] ?></td>
                    <td><?= $basicRows['tanggal_buat'] ?></td>
                    <td><?= $basicRows['tanggal_akhir'] ?></td>
                    <td><?= $basicRows['stok'] ?></td>
                    <td><?= $basicRows['harga'] ?></td>
                    <td><?= $basicRows['lokasi'] ?></td>
                    <td>
                        <?php if($basicRows['status'] == 0) :?>
                            <span style="color: red">Menunggu Verifikasi</span>
                        <?php else: ?>
                            <span style="color: green">Terverifikasi</span>
                        <?php endif; ?>
                    </td>
                </tr>  
            <?php endwhile; ?>
            </tbody>
        </table>
        <?php
            }

            if (!$hasData) {
                echo "<p>No data available.</p>";
            }
        ?>
    </div>
</body>
</html>
