<?php
session_start();
require 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $teks = mysqli_real_escape_string($conn, $_POST['teks']);
    $nama_kepsek = mysqli_real_escape_string($conn, $_POST['nama_kepsek']);

    // Cek apakah ada gambar baru diunggah
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

        // Update dengan gambar
        $query = "UPDATE sambutan SET teks='$teks', nama_kepsek='$nama_kepsek', gambar='$gambar' WHERE id=1";
    } else {
        // Update tanpa mengganti gambar
        $query = "UPDATE sambutan SET teks='$teks', nama_kepsek='$nama_kepsek' WHERE id=1";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Sambutan berhasil diperbarui!'); window.location='kelola_sambutan.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan!');</script>";
    }
}
?>
