<?php
$koneksi = new mysqli("localhost", "root", "", "dashboard_admin");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi = $_POST["deskripsi"];
    $nama_file = $_FILES["gambar"]["name"];
    $tmp_file = $_FILES["gambar"]["tmp_name"];

    $upload_dir = "uploads/";
    move_uploaded_file($tmp_file, $upload_dir . $nama_file);

    $koneksi->query("INSERT INTO prestasi (nama_file, deskripsi) VALUES ('$nama_file', '$deskripsi')");

    header("Location: kelola_prestasi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Prestasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Prestasi</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" name="gambar" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</body>
</html>
