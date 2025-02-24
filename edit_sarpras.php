<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #4A90E2;
            --gray-light: #f8f9fa;
            --shadow: rgba(0, 0, 0, 0.1);
        }

        body {
            background: linear-gradient(135deg, #f6f8fd 0%, #f1f4f9 100%);
            margin: 0;
            padding: 2rem;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px var(--shadow);
            padding: 2rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--gray-light);
        }

        h1 {
            color: var(--primary);
            font-size: 2rem;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 500;
            color: #2c3e50;
        }

        input[type="text"],
        textarea,
        select {
            width: 95%;
            padding: 1rem;
            border: 2px solid var(--gray-light);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--primary);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .img-preview {
            background: var(--gray-light);
            padding: 1rem;
            border-radius: 8px;
            display: inline-block;
        }

        .img-preview img {
            border-radius: 4px;
        }

        input[type="file"] {
            padding: 0.5rem 0;
        }

        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow);
        }
        svg{
            position: relative;
            top: 40px;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    $id = $_GET['id'];
    $query = "SELECT * FROM sarpras WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    ?>

    <div class="container">
        <div class="card">
        <a href="kelola_sarpras.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </a>
            <div class="header">
                <h1>Edit Sarana & Prasarana</h1>
            </div>
            
            <form action="proses_sarpras.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                
                <div class="form-group">
                    <label for="nama">Nama Sarpras:</label>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Gambar Saat Ini:</label>
                    <div class="img-preview">
                        <img src="uploads/<?php echo $data['gambar']; ?>" width="100">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="gambar">Ganti Gambar (Opsional):</label>
                    <input type="file" name="gambar" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="style">Pilih Style:</label>
                    <select name="style">
                        <option value="1" <?php echo ($data['style'] == 1) ? "selected" : ""; ?>>Gambar Kiri, Teks Kanan</option>
                        <option value="2" <?php echo ($data['style'] == 2) ? "selected" : ""; ?>>Gambar Kanan, Teks Kiri</option>
                    </select>
                </div>

                <button type="submit" name="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>