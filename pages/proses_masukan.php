<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    $query = $conn->prepare("INSERT INTO masukan (nama, email, pesan) VALUES (?, ?, ?)");
    $query->bind_param("sss", $nama, $email, $pesan);

    if ($query->execute()) {
        echo "<script>
            alert('Masukan berhasil terkirim!');
            window.location.href = '../index.php?page=kontak';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi kesalahan. Masukan tidak terkirim.');
            window.location.href = '../index.php?page=kontak';
        </script>";
    }
}
?>
