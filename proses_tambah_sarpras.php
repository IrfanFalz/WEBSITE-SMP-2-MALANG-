<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $style = $_POST['style'];

    // Cek apakah ada file yang diupload
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target = "uploads/" . basename($gambar);

        // Debugging: Cek apakah file terdeteksi
        var_dump($_FILES); 

        // Coba upload gambar
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            echo "Upload berhasil!"; 
        } else {
            echo "Gagal upload gambar.";
            exit;
        }
    } else {
        echo "Tidak ada gambar yang dipilih!";
        exit;
    }

    // Simpan ke database
    $query = "INSERT INTO sarpras (nama, deskripsi, gambar, style) VALUES ('$nama', '$deskripsi', '$gambar', '$style')";
    if (mysqli_query($conn, $query)) {
        header("Location: kelola_sarpras.php");
    } else {
        echo "Gagal menyimpan ke database: " . mysqli_error($conn);
    }
}
?>
