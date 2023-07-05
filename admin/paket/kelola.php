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
                <th>Paket</th>
                <th>Harga</th>
                <th>Tiket Normal</th>
                <th>Tiket Ekslusif</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $query = $conn->query("SELECT * FROM tb_paket");
            while ($rows = $query->fetch_assoc()) :
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $rows['nama_paket'] ?></td>
                    <td><?= $rows['harga'] ?></td>
                    <td><?= $rows['up_basic'] ?></td>
                    <td><?= $rows['up_gold'] ?></td>
                    <td><?= $rows['deskripsi'] ?></td>
                    <td>Edit | Hapus</td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>

</html>