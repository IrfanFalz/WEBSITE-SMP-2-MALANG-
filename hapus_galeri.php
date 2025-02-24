<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM galeri WHERE id=$id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('gambar berhasil dihapus!'); window.location='kelola_galeri.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>