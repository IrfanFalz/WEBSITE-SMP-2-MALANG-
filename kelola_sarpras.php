<?php
include 'config.php'; // Koneksi database

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

// Ambil data sarpras dari database
$query = "SELECT * FROM sarpras";
$result = mysqli_query($conn, $query);

$admin = $_SESSION['admin'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Sarpras</title>
    
    <style>

.sarpras-container {
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    padding: 2rem;
    margin: 20px;
}

.sarpras-header {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 30px;
}

.sarpras-header h2 {
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.add-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    width: fit-content;
}

.add-btn:hover {
    background-color: #45a049;
    transform: translateY(-2px);
}

.add-btn i {
    margin-right: 5px;
}

.sarpras-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.sarpras-table th,
.sarpras-table td {
    padding: 15px;
    text-align: left;
    border: 1px solid #e0e0e0;
}

.sarpras-table thead tr {
    background-color: #2980b9;
    color: white;
}

.sarpras-table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.sarpras-table tbody tr:hover {
    background-color: #f1f1f1;
    transition: background-color 0.3s ease;
}

.sarpras-table img {
    border-radius: 4px;
    object-fit: cover;
    display: block;
}

.action-buttons {
    display: flex;
    gap: 10px;
}

.edit-btn, .delete-btn {
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    color: white;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.edit-btn {
    background-color: #f39c12;
}

.edit-btn:hover {
    background-color: #d68910;
    transform: translateY(-2px);
}

.delete-btn {
    background-color: #e74c3c;
}

.delete-btn:hover {
    background-color: #c0392b;
    transform: translateY(-2px);
}

.action-buttons i {
    margin-right: 4px;
}
    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            margin-right: 0.75rem;
            color: #1a56db;
        }

        .activity-time {
            color: #6b7280;
            font-size: 0.875rem;
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
            <div class="sarpras-container">
    <div class="sarpras-header">
        <h2>Kelola Sarpras</h2>
        <a href="tambah_sarpras.php" class="add-btn">
            <i class="fas fa-plus-circle"></i> Tambah Sarpras
        </a>
    </div>
    
    <table class="sarpras-table">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Style</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM sarpras");
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <tr>
                    <td><img src="uploads/<?php echo $row['gambar']; ?>" width="100"></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['deskripsi']; ?></td>
                    <td><?php echo ($row['style'] == 1) ? "Gambar Kiri" : "Gambar Kanan"; ?></td>
                    <td class="action-buttons">
                        <a href="edit_sarpras.php?id=<?php echo $row['id']; ?>" class="edit-btn">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="hapus_sarpras.php?id=<?php echo $row['id']; ?>" 
                           class="delete-btn" 
                           onclick="return confirm('Hapus data?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
            </div>
    
		
	        </main>
        </div>
    </div>
