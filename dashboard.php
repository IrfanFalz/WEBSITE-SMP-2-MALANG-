<?php
session_start();

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

// Simpan data ke session secara aman
$_SESSION['admin']['nama_lengkap'] = $data['nama_lengkap'] ?? 'Admin';
$_SESSION['admin']['foto'] = (!empty($data['foto'])) ? $data['foto'] : 'default-profile.png';

// Pastikan role admin valid
if (!isset($admin['role'])) {
    $admin['role'] = $data['role'] ?? 'admin';
    $_SESSION['admin']['role'] = $admin['role'];
}

// Ambil jumlah berita
$query_berita = mysqli_query($conn, "SELECT COUNT(*) AS total FROM berita");
$data_berita = mysqli_fetch_assoc($query_berita);
$total_berita = $data_berita['total'] ?? 0;

// Ambil jumlah ekstrakurikuler
$query_ekstra = mysqli_query($conn, "SELECT COUNT(*) AS total FROM ekstrakurikuler");
$data_ekstra = mysqli_fetch_assoc($query_ekstra);
$total_ekstra = $data_ekstra['total'] ?? 0;

// Ambil jumlah masukan
$query_masukan = mysqli_query($conn, "SELECT COUNT(*) AS total FROM masukan");
$total_masukan = mysqli_fetch_assoc($query_masukan)['total'] ?? 0;

//jumlah pengunjung
$query = "SELECT tanggal, jumlah FROM pengunjung ORDER BY tanggal ASC";
$result = mysqli_query($conn, $query);

$data_tanggal = [];
$data_jumlah = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data_tanggal[] = $row['tanggal'];
        $data_jumlah[] = $row['jumlah'];
    }
}

// Konversi ke format JSON agar bisa digunakan di Chart.js
$data_tanggal_json = json_encode($data_tanggal);
$data_jumlah_json = json_encode($data_jumlah);

// Ambil parameter page dari URL, default ke 'dashboard'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Tambahkan header untuk mencegah caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
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
            transition: transform 0.3s;
        }

        .stat-card:hover{
            transform: translateY(-5px);
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
                <h1 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">
                    Selamat Datang, <?php echo isset($_SESSION['admin']['nama_lengkap']) ? htmlspecialchars($_SESSION['admin']['nama_lengkap']) : 'Admin'; ?>!
                </h1>

               <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3 style="color: #6b7280; font-size: 0.875rem;">Total Berita</h3>
                        <p style="font-size: 1.875rem; font-weight: bold; margin-top: 0.5rem;"><?php echo $total_berita; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3 style="color: #6b7280; font-size: 0.875rem;">Total Ekstrakurikuler</h3>
                        <p style="font-size: 1.875rem; font-weight: bold; margin-top: 0.5rem;"><?php echo $total_ekstra; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3 style="color: #6b7280; font-size: 0.875rem;">Total Masukan</h3>
                        <p style="font-size: 1.875rem; font-weight: bold; margin-top: 0.5rem;"><?php echo $total_masukan; ?></p>
                    </div>
                </div>
                <div class="recent-activity">
                    <h2>Jumlah Pengunjung</h2>
                 </div>
                <canvas id="grafikPengunjung" style="width: 100%; height: 400px;"></canvas>
            </main>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById("grafikPengunjung").getContext("2d");

    var grafikPengunjung = new Chart(ctx, {
        type: "line",
        data: {
            labels: <?php echo $data_tanggal_json ?: '[]'; ?>,
            datasets: [{
                label: "Jumlah Pengunjung",
                data: <?php echo $data_jumlah_json ?: '[]'; ?>,
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // Prevent back button from working after logout
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>

</body>
</html>