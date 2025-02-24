<?php
$koneksi = new mysqli("localhost", "root", "", "dashboard_admin");

$id = $_GET["id"];
$result = $koneksi->query("SELECT * FROM prestasi WHERE id=$id");
$data = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi = $_POST["deskripsi"];
    $nama_file = $data['nama_file'];

    if (!empty($_FILES["gambar"]["name"])) {
        $nama_file = $_FILES["gambar"]["name"];
        $tmp_file = $_FILES["gambar"]["tmp_name"];
        move_uploaded_file($tmp_file, "uploads/" . $nama_file);
    }

    $koneksi->query("UPDATE prestasi SET nama_file='$nama_file', deskripsi='$deskripsi' WHERE id=$id");

    header("Location: kelola_prestasi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Prestasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Prestasi</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Saat Ini</label><br>
                <img src="uploads/<?= $data['nama_file']; ?>" width="150">
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Ubah Gambar</label>
                <input type="file" class="form-control" name="gambar">
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required><?= $data['deskripsi']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
