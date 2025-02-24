<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date("Y-m-d");

    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $folder = "uploads/" . $gambar;

    if (move_uploaded_file($tmp_name, $folder)) {
        $sql = "INSERT INTO berita (judul, deskripsi, tanggal, gambar) VALUES ('$judul', '$deskripsi', '$tanggal', '$gambar')";
        if (mysqli_query($conn, $sql)) {
            header("Location: kelola_berita.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal upload gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Berita</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Judul</label>
            <input type="text" name="judul" required>
            
            <label>Deskripsi</label>
            <textarea name="deskripsi" required style="width: 98%; height: 100px;"></textarea>
            
            <label>Gambar</label>
            <input type="file" name="gambar" required>
            
            <button type="submit">Tambah</button>
        </form>
        <a href="kelola_berita.php">Kembali</a>
    </div>
</body>
</html>
