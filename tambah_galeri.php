<?php
session_start();
require 'config.php';

// Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date("Y-m-d");

    // Proses Upload Gambar
    $target_dir = "uploads/";
    $file_name = basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi Format File
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_extensions)) {
        echo "<script>alert('Format gambar hanya JPG, JPEG, PNG & GIF!');</script>";
    } else {
        // Simpan ke server
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Simpan ke database
            $query = mysqli_query($conn, "INSERT INTO galeri (nama_file, deskripsi, tanggal_upload) VALUES ('$file_name', '$deskripsi', '$tanggal')");
            if ($query) {
                echo "<script>alert('Gambar berhasil diupload!'); window.location='kelola_galeri.php';</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan!');</script>";
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .container-form {
            width: 40%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            color: #343a40;
            font-weight: bold;
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            margin-bottom: 5px;
        }
        .btn-upload {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            padding: 10px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        .btn-upload:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .preview-container {
            text-align: center;
            margin-top: 15px;
        }
        .preview-container img {
            width: 100%;
            max-width: 250px;
            border-radius: 10px;
            display: none;
        }
        a {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container-form">
    <h2>Tambah Gambar ke Galeri</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="gambar" class="form-label">Pilih Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar" required onchange="previewImage(event)">
        </div>
        <div class="preview-container">
            <img id="image-preview" alt="Preview Gambar">
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-upload w-100"><i class="fas fa-upload"></i> Upload Gambar</button>
        <a href="kelola_galeri.php">Kembali</a>
    </form>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
