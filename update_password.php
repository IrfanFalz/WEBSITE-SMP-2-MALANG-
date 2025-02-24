<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_admin = $_POST['id_admin'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Ambil password lama dari database
    $query = mysqli_query($conn, "SELECT password FROM admin WHERE id='$id_admin'");
    $admin = mysqli_fetch_assoc($query);

    // Cek apakah password lama sesuai
    if (!password_verify($old_password, $admin['password'])) {
        $_SESSION['error'] = "Password lama salah!";
        header("Location: profil_admin.php");
        exit;
    }

    // Cek apakah password baru dan konfirmasi sama
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Konfirmasi password tidak cocok!";
        header("Location: profil_admin.php");
        exit;
    }

    // Hash password baru dan update ke database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update = mysqli_query($conn, "UPDATE admin SET password='$hashed_password' WHERE id='$id_admin'");

    if ($update) {
        $_SESSION['success'] = "Password berhasil diubah!";
    } else {
        $_SESSION['error'] = "Gagal mengubah password.";
    }

    header("Location: profil_admin.php");
    exit;
}
?>
