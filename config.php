<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host = "localhost";
$user = "root"; 
$pass = ""; 
$db = "dashboard_admin";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Pastikan $_SESSION['admin'] adalah array
if (!isset($_SESSION['admin']) || !is_array($_SESSION['admin'])) {
    $_SESSION['admin'] = []; // Set sebagai array jika belum ada atau bukan array
}

// Cek apakah ada data user di database sebelum set foto profil
if (!empty($data) && isset($data['foto_profil'])) {
    $_SESSION['admin']['foto'] = !empty($data['foto_profil']) ? "uploads/" . $data['foto_profil'] : "uploads/default.png";
} else {
    $_SESSION['admin']['foto'] = "uploads/default-profile.png"; // Default jika tidak ada foto
}
?>
