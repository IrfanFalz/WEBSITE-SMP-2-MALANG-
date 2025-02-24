<?php
session_start();
require 'config.php';

// Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id_admin = $_SESSION['admin']['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Jika ada file yang diupload
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "uploads/";
        $foto_name = basename($_FILES['foto']['name']);
        $target_file = $target_dir . $foto_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");

        // Periksa apakah file adalah gambar yang valid
        if (in_array($imageFileType, $allowed_types)) {
            // Pindahkan file ke folder uploads
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                // Update database
                $update = mysqli_query($conn, "UPDATE admin SET foto_profil='$foto_name' WHERE id='$id_admin'");

                if ($update) {
                    $_SESSION['admin']['foto_profil'] = $foto_name;
                    header("Location: profil_admin.php");
                    exit;
                } else {
                    echo "Terjadi kesalahan saat menyimpan ke database.";
                }
            } else {
                echo "Gagal mengupload gambar.";
            }
        } else {
            echo "Format gambar tidak valid (hanya JPG, JPEG, PNG, GIF).";
        }
    } else {
        echo "Pilih gambar terlebih dahulu.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Foto Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            text-align: center;
        }
        .container {
            width: 40%;
            margin: 50px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-submit {
            padding: 10px 15px;
            background: #1A237E;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background: #0D144A;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ubah Foto Profil</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="foto" required>
            <br><br>
            <button type="submit" class="btn-submit">Upload Foto</button>
        </form>
        <br>
        <a href="dashboard.php">Kembali ke dashboard</a>
    </div>
</body>
</html>
