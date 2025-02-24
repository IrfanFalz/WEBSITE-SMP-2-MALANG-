<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $style = $_POST['style'];

    // Ambil gambar lama dari database
    $query = "SELECT gambar FROM sarpras WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $gambarLama = $data['gambar'];

    // Cek apakah ada gambar baru yang diupload
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target = "uploads/" . basename($gambar);

        // Upload gambar baru
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            // Jika berhasil upload, pakai gambar baru
        } else {
            echo "Gagal upload gambar.";
            exit;
        }
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $gambar = $gambarLama;
    }

    // Update data di database
    $updateQuery = "UPDATE sarpras SET nama='$nama', deskripsi='$deskripsi', gambar='$gambar', style='$style' WHERE id='$id'";
    mysqli_query($conn, $updateQuery);

    header("Location: kelola_sarpras.php");
}
?>
