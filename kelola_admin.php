<?php
session_start();
include 'config.php';

$pesan = ""; // Variabel untuk menyimpan pesan

// Pastikan hanya Superadmin yang bisa mengakses halaman ini
if ($_SESSION['admin']['role'] !== 'superadmin') {
    echo "Anda tidak memiliki akses ke halaman ini!";
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Cek apakah username atau email sudah terdaftar
    $checkQuery = "SELECT * FROM admin WHERE username='$username' OR email='$email'";
    $result = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($result) > 0) {
        $pesan = "<div class='alert alert-warning' style='
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ffeeba;
            border-radius: 4px;
            display: flex;
            align-items: center;
            font-size: 16px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        '>
            <i class='fas fa-exclamation-triangle' style='margin-right: 10px; font-size: 20px;'></i>
            Username atau Email sudah digunakan!
        </div>";
    } else {
        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert admin ke database
        $query = "INSERT INTO admin (username, password, email, role) VALUES ('$username', '$hashed_password', '$email', '$role')";
        
        if (mysqli_query($conn, $query)) {
            $pesan = "<div class='alert alert-success' style='
                background-color: #d4edda;
                color: #155724;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid #c3e6cb;
                border-radius: 4px;
                display: flex;
                align-items: center;
                font-size: 16px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            '>
                <i class='fas fa-check-circle' style='margin-right: 10px; font-size: 20px;'></i>
                Admin berhasil ditambahkan!
            </div>";
        } else {
            $pesan = "<div class='alert alert-danger' style='
                background-color: #f8d7da;
                color: #721c24;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid #f5c6cb;
                border-radius: 4px;
                display: flex;
                align-items: center;
                font-size: 16px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            '>
                <i class='fas fa-exclamation-circle' style='margin-right: 10px; font-size: 20px;'></i>
                Gagal menambahkan admin: " . mysqli_error($conn) . "
            </div>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>

.admin-container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.admin-title, .table-title {
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #B82132;
    margin-top: 40px;
}

.admin-form {
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #B82132;
    outline: none;
    box-shadow: 0 0 3px rgba(184, 33, 50, 0.2);
}

.submit-btn {
    background-color: #B82132;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #961b28;
}

.table-wrapper {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th,
.admin-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.admin-table th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
}

.admin-table tr:hover {
    background-color: #f8f9fa;
}

.delete-btn {
    color: #dc3545;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.delete-btn:hover {
    background-color: #ffebee;
}

.role-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.role-badge.admin {
    background-color: #e3f2fd;
    color: #1976d2;
}

.role-badge.superadmin {
    background-color: #fce4ec;
    color: #c2185b;
}

@media (max-width: 768px) {
    .admin-container {
        padding: 10px;
    }
    
    .admin-form {
        padding: 15px;
    }
    
    .table-wrapper {
        overflow-x: auto;
    }
    
    .admin-table th,
    .admin-table td {
        padding: 10px;
    }
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
            <div class="admin-container">
            <?php echo $pesan; ?>
    <div class="table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT id, username, email, role FROM admin");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td><span class='role-badge " . strtolower($row['role']) . "'>" . htmlspecialchars($row['role']) . "</span></td>
                        <td>";
                    if ($row['role'] !== 'superadmin') {
                        echo "<a href='hapus_admin.php?id=" . $row['id'] . "' class='delete-btn'>
                                <i class='fas fa-trash'></i> Hapus
                              </a>";
                    }
                    echo "</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add New Admin Section -->
    <h2 class="admin-title"><i class="fas fa-users-cog"></i> Kelola Admin</h2>
    
    <div class="admin-form">
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <select name="role">
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="submit-btn">
                <i class="fas fa-plus"></i> Tambah Admin
            </button>
        </form>
    </div>

    <h3 class="table-title"><i class="fas fa-list"></i> Daftar Admin</h3>
    
    <!-- Regular Admin Table -->
    <div class="table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM admin WHERE role='admin'ORDER BY id ASC");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td><span class='role-badge admin'>" . htmlspecialchars($row['role']) . "</span></td>
                            <td>
                                <a href='hapus_admin.php?id=" . $row['id'] . "' class='delete-btn'>
                                    <i class='fas fa-trash'></i> Hapus
                                </a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
		
	        </main>
        </div>
    </div>


