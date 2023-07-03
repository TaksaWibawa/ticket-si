<?php

require_once "../../../config/Database.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('location: ../../../login.php');
}

if (isset($_POST['btn-submit'])) {
    $judul_tiket = mysqli_real_escape_string($conn, $_POST['judul_tiket']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $up_tiket = mysqli_real_escape_string($conn, $_POST['up_tiket']);
    $tanggal_akhir = mysqli_real_escape_string($conn, $_POST['tanggal_akhir']);

    if (!empty($judul_tiket) && !empty($stok) && !empty($harga) && !empty($lokasi) && !empty($tanggal_akhir) && !empty($up_tiket)) {

        if (trim($judul_tiket) && trim($stok) && trim($harga)) {

            $nama_foto_baru = 'default.jpg';
            if (!empty($_FILES['file']['name'])) {
                $nama_foto = $_FILES['file']['name'];
                $ukuran_foto = $_FILES['file']['size'];
                $tmp_foto = $_FILES['file']['tmp_name'];

                $ekstensi_dibolehkan = array('png', 'jpg', 'jpeg');
                $x = explode(".", $nama_foto);
                $ekstensi = strtolower(end($x));
                $nama_foto_baru = date('dmYHis') . $nama_foto;

                if (in_array($ekstensi, $ekstensi_dibolehkan)) {
                    if ($ukuran_foto < 1500000) {
                        if (move_uploaded_file($tmp_foto, "./../../up_file/foto_tiket/" . $nama_foto_baru)) {
                            $tanggal_awal = date('Y-m-d');
                            $query = $conn->query("INSERT INTO tb_tiket VALUES('', '$judul_tiket', '$nama_foto_baru', '$stok', '$harga', '$lokasi', '$tanggal_awal', '$tanggal_akhir', '{$_SESSION['id_pengguna']}', '0')");

                            $query = $conn->query("SELECT qty_basic, qty_gold FROM tb_pengguna WHERE id_pengguna = {$_SESSION['id_pengguna']}");
                            $qty_now = $query->fetch_assoc();
                            if ($up_tiket == "basic") {
                                $qty_now['qty_basic'] -= 1;
                            } else if ($up_tiket == "gold") {
                                $qty_now['qty_gold'] -= 1;

                                $query = $conn->query("SELECT id_tiket FROM tb_tiket WHERE id_pengguna = {$_SESSION['id_pengguna']} ORDER BY id_tiket DESC LIMIT 1");
                                $id_tiket = $query->fetch_assoc()['id_tiket'];

                                $nama_foto_ekslusif = 'default.jpg';
                                if (!empty($_FILES['file_ekslusif']['name'])) {
                                    $nama_foto = $_FILES['file_ekslusif']['name'];
                                    $ukuran_foto = $_FILES['file_ekslusif']['size'];
                                    $tmp_foto = $_FILES['file_ekslusif']['tmp_name'];
                                    $ekstensi_dibolehkan = array('png', 'jpg', 'jpeg');
                                    $x = explode(".", $nama_foto);
                                    $ekstensi = strtolower(end($x));
                                    $nama_foto_ekslusif = date('dmYHis') . $nama_foto;

                                    if (in_array($ekstensi, $ekstensi_dibolehkan)) {
                                        if ($ukuran_foto < 1500000) {
                                            if (move_uploaded_file($tmp_foto, "./../../up_file/foto_ekslusif/" . $nama_foto_ekslusif)) {
                                                $query = $conn->query("INSERT INTO tb_tiket_ekslusif VALUES('', '$id_tiket', '$nama_foto_ekslusif')");
                                            } else {
                                                header('location: ../../dashboard?alert=error&message=Foto+Gagal+diupload+:(');
                                                exit();
                                            }
                                        } else {
                                            header('location: ../../dashboard?alert=info&message=Maaf,+Ukuran+foto+terlalu+besar');
                                            exit();
                                        }
                                    } else {
                                        header('location: ../../dashboard?alert=warning&message=Ekstensi+file+tidak+diperbolehkan!!');
                                        exit();
                                    }
                                }

                                $query = $conn->query("UPDATE tb_pengguna SET qty_basic = {$qty_now['qty_basic']}, qty_gold = {$qty_now['qty_gold']} WHERE id_pengguna = {$_SESSION['id_pengguna']}");
                            }

                            if ($query) {
                                header('location: ../../dashboard?alert=success&message=Berhasil+Menambah+Data');
                                exit();
                            } else {
                                header('location: ../../dashboard?alert=error&message=Ada+yang+salah!');
                                exit();
                            }

                        } else {
                            header('location: ../../dashboard?alert=error&message=Foto+Gagal+diupload+:(');
                            exit();
                        }
                    } else {
                        header('location: ../../dashboard?alert=info&message=Maaf,+Ukuran+foto+terlalu+besar');
                        exit();
                    }
                } else {
                    header('location: ../../dashboard?alert=warning&message=Ekstensi+file+tidak+diperbolehkan!!');
                    exit();
                }
            }

        } else {
            header('location: ../../dashboard?alert=warning&message=Data+tidak+boleh+kosong!!!');
            exit();
        }

    } else {
        header('location: ../../dashboard?alert=warning&message=Data+tidak+boleh+kosong!!!');
        exit();
    }

} else {
    header('location: ../../dashboard');
    exit();
}

?>
