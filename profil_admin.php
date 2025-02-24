<?php
session_start();
require 'config.php';

// Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil data admin dari database
$id_admin = $_SESSION['admin']['id'];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id_admin'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .profile-container {
            width: 50%;
            margin: 50px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-pic {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #1A237E;
            margin-bottom: 20px;
        }
        .profile-info {
            width: 80%;
            text-align: justify;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        .profile-info p {
            font-size: 16px;
            margin: 10px 0;
            padding: 8px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);
        }
        .profile-info strong {
            color: #1A237E;
        }
        .btn-edit, .btn-password {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #1A237E;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .btn-edit:hover, .btn-password:hover {
            background: #0D144A;
        }
        svg{
            color: blue;
            position: relative;
            left: -350px !important   ;
        }
    </style>
</head>
<body>

   <!-- Notifikasi Pesan -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success text-center"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger text-center"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="profile-container">
    <a href="dashboard.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="auto" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
    </a>
    <h2>Profil Admin</h2>
    <img src="uploads/<?php echo $data['foto_profil'] ? $data['foto_profil'] : 'default.jpg'; ?>" class="profile-pic" alt="Foto Profil">
    
    <div class="profile-info">
        <p><strong>Nama:</strong> <?php echo $data['username']; ?></p>
        <p><strong>Nama Lengkap:</strong> <?php echo $data['nama_lengkap']; ?></p>
        <p><strong>Email:</strong> <?php echo $data['email']; ?></p>
    </div>

    <!-- Tombol Edit Profil -->
    <a href="edit_profil.php" class="btn-edit">Edit Profil</a>

    <!-- Tombol Ubah Password -->
    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#ubahPasswordModal">Ubah Password</button>

</div>

<!-- Modal Ubah Password -->
<div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ubahPasswordModalLabel">Ubah Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses_ubah_password.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>">
          <div class="mb-3">
            <label for="password_lama" class="form-label">Password Lama</label>
            <input type="password" class="form-control" id="password_lama" name="password_lama" required>
          </div>
          <div class="mb-3">
            <label for="password_baru" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password_baru" name="password_baru" required>
          </div>
          <div class="mb-3">
            <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Agar Modal Berfungsi) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
