<?php
include 'config.php';

$id = $_POST['id'];
$nama_kepsek = mysqli_real_escape_string($conn, $_POST['nama_kepsek']);
$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

// Jika ada gambar baru diunggah
if ($_FILES['gambar']['name']) {
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);

    // Update dengan gambar baru
    $query = "UPDATE sambutan SET nama_kepsek='$nama_kepsek', deskripsi='$deskripsi', gambar='$gambar' WHERE id=$id";
} else {
    // Update tanpa mengubah gambar
    $query = "UPDATE sambutan SET nama_kepsek='$nama_kepsek', deskripsi='$deskripsi' WHERE id=$id";
}

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Sambutan berhasil diperbarui!'); window.location='kelola_sambutan.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui sambutan!'); window.location='kelola_sambutan.php';</script>";
}
?>
