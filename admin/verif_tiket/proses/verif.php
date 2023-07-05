<?php 

	require_once "../../../config/Database.php";
	session_start();
    if(!isset($_SESSION['username'])) { 
        header('location: ../../../login.php');
    }

	if (isset($_GET['id'])) {

		$query = $conn->query("UPDATE tb_tiket SET status = 1 WHERE id_tiket = {$_GET['id']}");

		if ($query) {
			header('location: ../../dashboard?alert=success&message=Berhasil Memverifikasi');
			exit();
		} else {
			header('location: ../../dashboard?alert=error&message=Ada yang Salah!');
			exit();
		}

	} else {
		header('location: ../index.php');
	}