<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
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
include 'config.php';

$admin = $_SESSION['admin'];

$items_per_page = 5;

$current_page_masukan = isset($_GET['masukan_page']) ? (int)$_GET['masukan_page'] : 1;
$offset_masukan = ($current_page_masukan - 1) * $items_per_page;
$total_masukan = $conn->query("SELECT COUNT(*) as count FROM masukan")->fetch_assoc()['count'];
$total_pages_masukan = ceil($total_masukan / $items_per_page);

$masukan = $conn->query("SELECT * FROM masukan ORDER BY id_masukan DESC LIMIT $items_per_page OFFSET $offset_masukan");

if (isset($_GET['delete_masukan'])) {
    $id = $_GET['delete_masukan'];
    $query = $conn->prepare("DELETE FROM masukan WHERE id_masukan = ?");
    $query->bind_param("i", $id);
    $query->execute();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard</title>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       
       .dashboard-container {
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    padding: 2rem;
    margin-bottom: 2rem;
}

.dashboard-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 0.5rem;
    padding-bottom: 1.4rem;
    position: relative;
    left: 20px;
    top: 10px;
}

.dashboard-title i {
    margin-right: 10px;
}

.table-wrapper {
    overflow-x: auto;
    margin: 20px 0;
}

.feedback-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.feedback-table thead {
    background-color: #3498db;
    color: white;
}

.feedback-table th,
.feedback-table td {
    padding: 1rem;
    text-align: left;
}

.feedback-table th i {
    margin-right: 10px;
}

.feedback-table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.feedback-table tbody tr:hover {
    background-color: #f1f1f1;
    transition: background-color 0.3s ease;
}

.delete-btn {
    background-color: #e74c3c;
    color: white;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #c0392b;
}

.delete-btn i {
    margin-right: 8px;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #7f8c8d;
}

.empty-state i {
    font-size: 3em;
    margin-bottom: 1rem;
    display: block;
}

.empty-state h4 {
    margin-bottom: 0.5rem;
}

.pagination-nav {
    margin-top: 2rem;
}

.pagination {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 5px;
}

.pagination li a {
    display: block;
    padding: 8px 16px;
    text-decoration: none;
    color: #3498db;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.pagination li.active a {
    background-color: #3498db;
    color: white;
}

.pagination li:not(.active) a:hover {
    background-color: #edf2f7;
}

hr {
    width: 100%;
    color: rgb(151, 126, 126);
    margin: 1rem 0;
}

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
            <div class="dashboard-container">
    <h2 class="dashboard-title">
        Masukan Pengguna
    </h2>
    <hr> 
    
    <?php if ($masukan->num_rows > 0): ?>
        <div class="table-wrapper">
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $masukan->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['pesan']); ?></td>
                            <td>
                                <a href="?delete_masukan=<?= $row['id_masukan']; ?>" 
                                   class="delete-btn"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus masukan ini?');">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h4>Belum ada masukan</h4>
            <p>Saat ini belum ada masukan dari pengguna.</p>
        </div>
    <?php endif; ?>

    <?php if ($total_pages_masukan > 1): ?>
        <nav class="pagination-nav">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages_masukan; $i++): ?>
                    <li class="<?= $i == $current_page_masukan ? 'active' : '' ?>">
                        <a href="?masukan_page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
		
	        </main>
        </div>
    </div>
