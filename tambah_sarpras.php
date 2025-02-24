<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    
    // Upload gambar
    $gambar = $_FILES['gambar']['name'];
    $target = "uploads/" . basename($gambar);
    
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
        $query = "INSERT INTO sarpras (nama, deskripsi, gambar) VALUES ('$nama', '$deskripsi', '$gambar')";
        mysqli_query($conn, $query);
        header("Location: kelola_sarpras.php");
    } else {
        echo "Gagal upload gambar!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sarpras</title>
    <Style>
        body {
    font-family: Arial, sans-serif;
    background: #f0f2f5;
    margin: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    background: white;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
    width: 90%;
    max-width: 400px;
}

h2 {
    color: #1c1e21;
    margin: 0 0 30px;
    text-align: center;
    font-size: 24px;
    position: relative;
    top : -30px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

label {
    font-size: 14px;
    font-weight: 500;
    color: #1c1e21;
}

input[type="text"],
textarea {
    padding: 14px 16px;
    border: 1px solid #dddfe2;
    border-radius: 6px;
    font-size: 15px;
}

input[type="text"]:focus,
textarea:focus {
    outline: none;
    border-color: #1877f2;
    box-shadow: 0 0 0 2px #e7f3ff;
}

textarea {
    min-height: 100px;
    resize: vertical;
}

input[type="file"] {
    padding: 8px 0;
}

button {
    background: #1877f2;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background: #166fe5;
}
svg{
    position: relative;
}
    </Style>
</head>
<body>
    <div class="card">
    <a href="kelola_sarpras.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </a>
    <h2>Tambah Sarpras</h2>
    <form action="proses_tambah_sarpras.php" method="POST" enctype="multipart/form-data">
    <label for="nama">Nama Sarpras:</label>
    <input type="text" name="nama" required>

    <label for="deskripsi">Deskripsi:</label>
    <textarea name="deskripsi" required></textarea>

    <label for="gambar">Upload Gambar:</label>
    <input type="file" name="gambar" accept="image/*" required>

    <label for="style">Pilih Style:</label>
    <select name="style">
        <option value="1">Gambar Kiri, Teks Kanan</option>
        <option value="2">Gambar Kanan, Teks Kiri</option>
    </select>

    <button type="submit" name="submit">Simpan</button>
    </form>

    </div>
</body>
</html>
