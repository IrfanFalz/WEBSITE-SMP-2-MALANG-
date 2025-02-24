<?php
session_start();
require 'config.php';

// Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id_admin = $_SESSION['admin']['id'];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id_admin'");
$data = mysqli_fetch_assoc($query);

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Cek apakah admin mengunggah foto baru
    if (!empty($_FILES['foto_profil']['name'])) {
        $foto_nama = $_FILES['foto_profil']['name'];
        $foto_tmp = $_FILES['foto_profil']['tmp_name'];
        $foto_path = "uploads/" . $foto_nama;

        // Pindahkan file ke folder uploads
        move_uploaded_file($foto_tmp, $foto_path);

        // Update database dengan foto baru
        $query_update = "UPDATE admin SET nama_lengkap='$nama_lengkap', email='$email', foto_profil='$foto_nama' WHERE id='$id_admin'";
    } else {
        // Jika tidak upload foto baru, hanya update nama dan email
        $query_update = "UPDATE admin SET nama_lengkap='$nama_lengkap', email='$email' WHERE id='$id_admin'";
    }

    if (mysqli_query($conn, $query_update)) {
        $_SESSION['admin']['nama_lengkap'] = $nama_lengkap;
        $_SESSION['admin']['email'] = $email;
        header("Location: profil_admin.php");
        exit;
    } else {
        echo "Gagal memperbarui profil!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            text-align: center;
        }
        .edit-profile-container {
            width: 50%;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 50px;
        }
        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #1A237E;
            margin-bottom: 15px;
        }
        .form-group {
            margin: 15px 0;
            text-align: left;
        }
        label {
            font-weight: bold;
            display: block;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background: #1A237E;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="edit-profile-container">
        <h2>Edit Profil Admin</h2>
        <img src="uploads/<?php echo $data['foto_profil']; ?>" class="profile-pic" alt="Foto Profil">
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" required>
            </div>

            <div class="form-group">
                <label for="foto_profil">Foto Profil (opsional)</label>
                <input type="file" id="foto_profil" name="foto_profil">
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
