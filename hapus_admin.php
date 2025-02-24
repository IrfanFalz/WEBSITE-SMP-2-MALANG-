<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin']['role'] != 'superadmin') {
    die("Akses ditolak!");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM admin WHERE id=$id");
}

header("Location: kelola_admin.php");
exit();
?>
