<?php
$koneksi = new mysqli("localhost", "root", "", "dashboard_admin");

$id = $_GET["id"];
$result = $koneksi->query("SELECT * FROM prestasi WHERE id=$id");
$data = $result->fetch_assoc();

if ($data) {
    unlink("uploads/" . $data["nama_file"]);
    $koneksi->query("DELETE FROM prestasi WHERE id=$id");
}

header("Location: kelola_prestasi.php");
exit;
?>
