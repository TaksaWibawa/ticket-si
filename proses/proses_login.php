<?php

require_once "../config/Database.php";

function redirectWithAlert($location, $status, $message) {
    $location .= '?alert=' . $status . '&message=' . urlencode($message);
    header('Location: ' . $location);
    exit();
}

if (isset($_POST['btn-submit'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($username) && !empty($password)) {

        if (trim($username) && trim($password)) {

            $query = $conn->query("SELECT * FROM tb_akun WHERE username = '$username'");

            if ($query->num_rows == 1) {

                $rows = $query->fetch_assoc();

                if (password_verify($password, $rows['password'])) {

                    $query = $conn->query("SELECT id_pengguna FROM tb_pengguna WHERE id_akun = '{$rows['id_akun']}'");
                    $rows_pengguna = $query->fetch_assoc();

                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['id_pengguna'] = $rows_pengguna['id_pengguna'];
                    $_SESSION['level'] = $rows['level'];

                    if ($rows['level'] == 1) {
                        // pengguna
                        redirectWithAlert('../index.php', 'success', 'Selamat Datang ' . $username);
                    } elseif ($rows['level'] == 2) {
                        // admin
                        redirectWithAlert('../admin/dashboard', 'success', 'Selamat Datang ' . $username);
                    }

                } else {
                    redirectWithAlert('../login.php', 'error', 'Password salah!!');
                }

            } else {
                redirectWithAlert('../login.php', 'error', 'Maaf, Anda tidak terdaftar!');
            }

        } else {
            redirectWithAlert('../login.php', 'warning', 'Data tidak boleh kosong!!!');
        }

    } else {
        redirectWithAlert('../login.php', 'warning', 'Data tidak boleh kosong!!!');
    }

} else {
    header('Location: ../login.php');
    exit();
}
