<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_POST['gambar'];
    $tanggal = $_POST['tanggal'];

    if ($id) {
        $stmt = $conn->prepare("UPDATE berita SET judul = ?, deskripsi = ?, gambar = ?, tanggal = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $judul, $deskripsi, $gambar, $tanggal, $id);
    } else {
        $stmt = $conn->prepare("INSERT INTO berita (judul, deskripsi, gambar, tanggal) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $deskripsi, $gambar, $tanggal);
    }
    $stmt->execute();
    $stmt->close();
    header("Location: index.php?page=berita");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM berita WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: berita.php");
}
?>
