<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM berita WHERE id=$id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Berita berhasil dihapus!'); window.location='kelola_berita.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
