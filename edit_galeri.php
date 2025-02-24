<?php
include 'config.php'; // Pastikan koneksi ke database sudah benar

// Cek apakah ID tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data galeri berdasarkan ID
    $query = "SELECT * FROM galeri WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Jika data ditemukan, simpan dalam array $data
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
        }
        textarea {
            width: 100%;
            height: 150px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            resize: none;
        }
        input[type="file"] {
            display: block;
            margin-bottom: 15px;
        }
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="card">
    <a href="kelola_galeri.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </a>
        <h2>Edit Galeri</h2>
        <form action="proses_edit_galeri.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Saat Ini:</label><br>
                <?php if (!empty($data['nama_file'])): ?>
                    <img src="uploads/<?= htmlspecialchars($data['nama_file']); ?>" class="image-preview" alt="Gambar Galeri">
                <?php else: ?>
                    <p>Tidak ada gambar.</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Pilih Gambar Baru:</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control"><?= isset($data['deskripsi']) ? htmlspecialchars($data['deskripsi']) : '' ?></textarea>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn-custom">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>
</html>
