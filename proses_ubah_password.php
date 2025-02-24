<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_admin = $_POST['id_admin'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Ambil password lama dari database
    $query = mysqli_query($conn, "SELECT password FROM admin WHERE id='$id_admin'");
    $data = mysqli_fetch_assoc($query);
    
    if (!$data) {
        $_SESSION['error'] = "Akun tidak ditemukan!";
        header("Location: profil_admin.php");
        exit;
    }

    // Cek apakah password lama benar
    if (!password_verify($password_lama, $data['password'])) {
        $_SESSION['error'] = "Password lama salah!";
        header("Location: profil_admin.php");
        exit;
    }

    // Cek apakah password baru dan konfirmasi cocok
    if ($password_baru !== $konfirmasi_password) {
        $_SESSION['error'] = "Konfirmasi password tidak cocok!";
        header("Location: profil_admin.php");
        exit;
    }

    // Hash password baru
    $password_baru_hashed = password_hash($password_baru, PASSWORD_DEFAULT);

    // Update password di database
    $update = mysqli_query($conn, "UPDATE admin SET password='$password_baru_hashed' WHERE id='$id_admin'");

    if ($update) {
        $_SESSION['success'] = "Password berhasil diubah!";
    } else {
        $_SESSION['error'] = "Gagal mengubah password!";
    }

    // Redirect kembali ke profil_admin.php
    header("Location: profil_admin.php");
    exit;
}
?>
