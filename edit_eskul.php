<?php
include 'config.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM ekstrakurikuler WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama_eskul = $_POST['nama_eskul'];
    
    if ($_FILES['gambar']['name']) {
        // Hapus gambar lama
        unlink("uploads/" . $row['gambar']);

        // Upload gambar baru
        $gambar = $_FILES['gambar']['name'];
        $target = "uploads/" . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
    } else {
        $gambar = $row['gambar'];
    }

    mysqli_query($conn, "UPDATE ekstrakurikuler SET nama_eskul='$nama_eskul', gambar='$gambar' WHERE id=$id");
    header("Location: kelola_eskul.php");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Ekstrakurikuler</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Reset dan style dasar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

body {
    background-color: #f5f6fa;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: start;
    padding: 20px;
}

/* Container utama */
.container {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

/* Style untuk heading */
h2 {
    color: #2c3e50;
    margin-bottom: 30px;
    text-align: center;
    font-size: 28px;
    position: relative;
    padding-bottom: 10px;
}

h2:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: #3498db;
    border-radius: 2px;
}

/* Style untuk form */
form {
    width: 100%;
    margin-bottom: 20px;
}

/* Style untuk label */
label {
    display: block;
    margin-bottom: 8px;
    color: #2c3e50;
    font-weight: bold;
}

/* Style untuk input */
input[type="text"] {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #e2e8f0;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:focus {
    outline: none;
    border-color: #3498db;
}

/* Style untuk input file */
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 2px solid #e2e8f0;
    border-radius: 5px;
    background: #f8f9fa;
}

/* Style untuk button */
button {
    width: 100%;
    padding: 12px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s ease;
    margin-bottom: 15px;
}

button:hover {
    background: #2980b9;
}

/* Style untuk tombol kembali */
.back-button {
    display: inline-block;
    padding: 10px 20px;
    color: #2980b9;
    border-radius: 5px;
    transition: background 0.3s ease;
    text-align: center;
    justify-content: center;
    display: flex;
}
    
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Ekstrakurikuler</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Nama Ekstrakurikuler</label>
            <input type="text" name="nama_eskul" value="<?= $row['nama_eskul']; ?>" required>
            <label>Gambar</label>
            <input type="file" name="gambar">
            <button type="submit">Simpan</button>
        </form>
        <a href="kelola_eskul.php" class="back-button">Kembali</a>
    </div>
</body>
</html>