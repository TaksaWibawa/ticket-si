<?php 

	require_once "../../../config/Database.php";
	session_start();
    if($_SESSION['level'] != '2') { 
        header('location: ../../../login.php');
    }

	if (isset($_POST['btn-submit'])) {

		$nama_paket = mysqli_real_escape_string($conn, $_POST['nama_paket']);
		$up_basic = mysqli_real_escape_string($conn, $_POST['up_basic']);
		$up_gold = mysqli_real_escape_string($conn, $_POST['up_gold']);
        $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
		$harga = mysqli_real_escape_string($conn, $_POST['harga']);
		
		if (!empty($nama_paket) && !empty($deskripsi) && !empty($harga)) {
						
			if (trim($nama_paket) && trim($deskripsi) && trim($harga)) {

				$query = $conn->query("INSERT INTO tb_paket VALUES('', '$nama_paket', '$harga', '$up_basic', '$up_gold', '$deskripsi')");

				if ($query) {
					header('location: ../../dashboard?alert=success&message=Berhasil Memverifikasi');
					exit();
				} else {
					header('location: ../../dashboard?alert=danger&message=Gagal Memverifikasi');
					exit();
				}

			} else {
				header('location: ../../dashboard?alert=danger&message=Data tidak boleh mengandung spasi!!!');
				exit();
			}
			
		} else {
			header('location: ../../dashboard?alert=danger&message=Data tidak boleh kosong!!!');
			exit();
		}

	} else {
		header('location: ../../dashboard?alert=danger&message=Silahkan masukkan data terlebih dahulu!!!');
		exit();
	}