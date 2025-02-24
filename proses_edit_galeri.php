<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    // Cek apakah ada file gambar yang diupload
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

        // Pastikan folder upload tersedia
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Upload gambar baru
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Update database dengan gambar baru
            $query = "UPDATE galeri SET nama_file = ?, deskripsi = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $_FILES["gambar"]["name"], $deskripsi, $id);
        } else {
            echo "Gagal mengupload gambar!";
            exit;
        }
    } else {
        // Update hanya deskripsi jika tidak ada gambar baru
        $query = "UPDATE galeri SET deskripsi = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $deskripsi, $id);
    }

    // Eksekusi query update
    if (mysqli_stmt_execute($stmt)) {
        header("Location: kelola_galeri.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
