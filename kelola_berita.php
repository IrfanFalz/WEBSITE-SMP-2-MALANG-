<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Pengecekan session yang lebih aman
if (!isset($_SESSION['admin']) || !is_array($_SESSION['admin']) || 
    !isset($_SESSION['admin']['id']) || !isset($_SESSION['admin']['role'])) {
    // Hapus session dan redirect ke login
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

require 'config.php';

// Pastikan admin adalah array yang valid sebelum digunakan
$admin = $_SESSION['admin'];
$id_admin = $admin['id'] ?? 0;

if ($id_admin <= 0) {
    // ID admin tidak valid, hapus session dan redirect
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM admin WHERE id='$id_admin'");
if (!$query || mysqli_num_rows($query) === 0) {
    // Admin tidak ditemukan di database, hapus session dan redirect
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$data = mysqli_fetch_assoc($query);

$admin = $_SESSION['admin'];

$berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Berita</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
                * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .flex {
            display: flex;
        }

        .h-screen {
            height: 100vh;
        }

        .bg-gray-100 {
            background-color: #f3f4f6;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 256px;
            background-color: white;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 1rem;
            display: flex;
            align-items: center;
        }

        .sidebar-header h2 {
            margin-left: 0.5rem;
            font-size: 1.25rem;
            color: #1a56db;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s;
        }

        .nav-link:hover {
            background-color: #f3f4f6;
            color: #1a56db;
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.75rem;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        .header {
            height: 64px;
            background-color: white;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 1.5rem;
        }

        .profile-link {
            color: #4b5563;
            text-decoration: none;
            margin-right: 1rem;
            display: flex;
            align-items: center;
        }

        .logout-btn {
            background-color: #ef4444;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background-color: #dc2626;
        }

        /* Dashboard Content Styles */
        .dashboard-content {
            padding: 1.5rem;
            flex: 1;
            overflow: auto;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .recent-activity {
            border-radius: 0.5rem;
        }

        .activity-item {
            padding: 1rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .container {  background: white; padding: 20px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; border-radius: 10px; }
        th, td { padding: 20px; border-bottom: 1px solid #ddd; text-align: left; }
        th{ background-color: #3498db; color: white; }
        .btn { padding: 8px 12px; text-decoration: none; color: white; border-radius: 5px; }
        .btn-add { background: green;  }
        .btn-edit { background: orange; }
        .btn-danger {
            background-color: #e74c3c;
            border: none;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 20px;
            text-decoration: none;
            color: #1A237E;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }
        .back-button i {
            margin-right: 8px;
        }
        .back-button:hover {
            color: #0D144A;
        }

        /* Menggunakan Flexbox untuk memisahkan tombol */
        .aksi-btns {
            display: flex;
            gap: 10px; /* Jarak antar tombol */
        }
    </style>
</head>
<body>
<div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
               <img src="image/logo merah.png" width="200px" height="auto" style="margin: 5% 3%;">
            </div><br>
            <nav class="mt-6">
                <a href="dashboard.php" class="nav-link">
                    <i class="fas fa-home" style="color: #E04E4E"></i>
                    <span style="color: #E04E4E">Dashboard</span>
                </a>
                <a href="kelola_berita.php" class="nav-link">
                    <i class="fas fa-newspaper" style= "color: #E04E4E"></i>
                    <span style= "color: #E04E4E">Kelola Berita</span>
                </a>
                <a href="kelola_galeri.php" class="nav-link">
                    <i class="fas fa-images" style="color: #E04E4E"></i>
                    <span  style="color: #E04E4E">Kelola Galeri</span>
                </a>
                <a href="lihat_masukan.php" class="nav-link">
                    <i class="fas fa-comment" style="color: #E04E4E"></i>
                    <span style="color: #E04E4E">Melihat Masukan Form</span>
                </a>
                <a href="kelola_prestasi.php" class="nav-link">
                    <i class="fas fa-medal" style="color: #E04E4E"></i>
                    <span style="color: #E04E4E">Kelola Prestasi</span>
                </a>
                <a href="kelola_sarpras.php" class="nav-link">
                    <i class="fas fa-mosque" style="color: #E04E4E"></i>
                    <span style="color: #E04E4E">Kelola Sarpras</span>
                </a>
                <a href="kelola_eskul.php" class="nav-link">
                    <i class="fas fa-futbol" style="color: #E04E4E"></i>
                    <span style="color: #E04E4E">Kelola Ekstrakurikuler</span>
                </a>
                <a href="kelola_sambutan.php" class="nav-link">
                    <i class="fas fa-comment-dots" style="color: #E04E4E"></i>
                    <span style="color: #E04E4E">Kelola Sambutan</span>
                </a>
                <?php if (isset($admin['role']) && $admin['role'] == 'superadmin') : ?>
                    <a href="kelola_admin.php" class="nav-link">
                        <i class="fas fa-user-shield" style="color: #E04E4E"></i>
                        <span style="color: #E04E4E">Kelola Admin</span>
                    </a>
                <?php endif; ?>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <a href="profil_admin.php" class="profile-link" style="margin: 0 40px 0 0;">
                <i class="fas fa-user"style="margin: 0 10px 0 0; color: #578FCA;"></i>
                <h4 style="color: #578FCA; marign-right: 50px">Profil</h4>
                </a>
                <form action="logout.php" method="POST" style="display:inline;">
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </header>

            <!-- Dashboard Content -->
            <main class="dashboard-content">
            <div class="container">
    <h2 style="margin: 2% 0;">Kelola Berita</h2>
    <a href="tambah_berita.php" class="btn btn-add">Tambah Berita</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($berita)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><img src="uploads/<?php echo $row['gambar']; ?>" width="100"></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo substr($row['deskripsi'], 0, 50) . '...'; ?></td>
            <td><?php echo $row['tanggal']; ?></td>
            <td class="aksi-btns">
                <a href="edit_berita.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">Edit</a>
                <a href="hapus_berita.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus berita ini?');"></i>Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html> 

		    </main>
        </div>
    </div>


