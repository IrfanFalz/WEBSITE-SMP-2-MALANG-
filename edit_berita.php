<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include "config.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM berita WHERE id='$id'");
$berita = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $folder = "uploads/" . $gambar;

        if (move_uploaded_file($tmp_name, $folder)) {
            $sql = "UPDATE berita SET judul='$judul', deskripsi='$deskripsi', gambar='$gambar' WHERE id='$id'";
        }
    } else {
        $sql = "UPDATE berita SET judul='$judul', deskripsi='$deskripsi' WHERE id='$id'";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: kelola_berita.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Berita</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Judul</label>
            <input type="text" name="judul" value="<?= $berita['judul']; ?>" required>
            
            <label>Deskripsi</label>
            <textarea name="deskripsi" required><?= $berita['deskripsi']; ?></textarea>
            
            <label>Gambar</label>
            <input type="file" name="gambar">
            <p>Gambar saat ini: <img src="uploads/<?= $berita['gambar']; ?>" width="100"></p>
            
            <button type="submit">Update</button>
        </form>
        <a href="kelola_berita.php">Kembali</a>
    </div>
</body>
</html>
