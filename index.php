<?php
session_start();
include 'config.php'; // Pastikan koneksi database sudah ada

$tanggal = date('Y-m-d');

// Cek apakah pengguna sudah dihitung hari ini
if (!isset($_SESSION['pengunjung_dihitung']) || $_SESSION['pengunjung_dihitung'] !== $tanggal) {
    $query = $conn->query("SELECT * FROM pengunjung WHERE tanggal = '$tanggal'");
    if ($query->num_rows > 0) {
        // Jika sudah ada, update jumlahnya
        $conn->query("UPDATE pengunjung SET jumlah = jumlah + 1 WHERE tanggal = '$tanggal'");
    } else {
        // Jika belum ada, tambahkan data baru
        $conn->query("INSERT INTO pengunjung (tanggal, jumlah) VALUES ('$tanggal', 1)");
    }

    // Set session agar tidak dihitung lagi hari ini
    $_SESSION['pengunjung_dihitung'] = $tanggal;
}
if (isset($_GET['search_page'])) {
    $input = strtolower(trim($_GET['search_page']));
    $pages = [
        'beranda' => 'index.php?page=beranda',
        'berita' => 'index.php?page=berita',
        'prestasi' => 'index.php?page=prestasi',
        'kontak' => 'index.php?page=kontak',
        'galeri' => 'index.php?page=galeri',
        'kesiswaan' => 'index.php?page=kesiswaan',
        'sarpras' => 'index.php?page=sarpras',
        'sarana prasarana' => 'index.php?page=sarpras',
        'dg' => 'index.php?page=ekstra',
        'guru' => 'index.php?page=guru',
        'profil' => 'index.php?page=profil',
    ];

    if (array_key_exists($input, $pages)) {
        header("Location: " . $pages[$input]);
        exit();
    } else {
        echo "<script>alert('Halaman tidak ditemukan!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMPN 2 Malang</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $page = isset($_GET['page'])?$_GET['page'] : 'home';
    ?>

<nav class="navbar navbar-expand-lg bg-light sticky-top">
        <div class="container">
        <a class="navbar-brand" href="index.php?page=beranda">
            <img src="image/logo merah.png" alt="Logo">
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link <?= ($page == 'beranda') ? 'active' : '' ?>" href="index.php?page=beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'profil') ? 'active' : '' ?>" href="index.php?page=profil">Profil</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'prestasi') ? 'active' : '' ?>" href="index.php?page=prestasi">Prestasi</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'kesiswaan') ? 'active' : '' ?>" href="index.php?page=kesiswaan">Kesiswaan</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'galeri') ? 'active' : '' ?>" href="index.php?page=galeri">Galeri</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'sarpras') ? 'active' : '' ?>" href="index.php?page=sarpras">Sarpras</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'berita') ? 'active' : '' ?>" href="index.php?page=berita">Berita</a></li>
                <li class="nav-item"><a class="nav-link <?= ($page == 'kontak') ? 'active' : '' ?>" href="index.php?page=kontak">Kontak</a></li>
                <li class="nav-item ms-3">
                <a class="nav-link p-0" href="#">
                    <div class="search-icon" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="bi bi-search"></i>
                    </div>
                </a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <?php
    switch ($page) {
        case 'beranda':
            include 'pages/beranda.php';
            break;
        case 'profil':
            include 'pages/profil.php';
            break;
        case 'prestasi':
            include 'pages/prestasi.php';
            break;
        case 'kesiswaan':
            include 'pages/kesiswaan.php';
            break;
        case 'galeri':
            include 'pages/galeri.php';
            break;
        case 'sarpras':
            include 'pages/sarpras.php';
            break;
        case 'berita':
            include 'pages/berita.php';
            break;
        case 'guru':
            include 'pages/guru.php';
            break;
        case 'ekstra':
            include 'pages/ekstra.php';
            break;
        case 'kontak':
            include 'pages/kontak.php';
            break;
        default:
            echo"<p>Halaman tidak ditemukan</p>";
            break;
    }
    ?>

    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Cari Halaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="GET">
                    <div class="modal-body">
                        <input type="text" class="form-control" name="search_page" placeholder="Masukkan nama halaman (e.g., berita)" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-3 mb-3 header-foot">
                    <a href="index.php?page=beranda"><img src="image.png"></a><br><br>
                    <p class="vismi">Unggul Dalam Imtaq dan Iptek, Berkarakter, Serta Peduli dan Berbudaya Lingkungan</p>
                </div>
                <div class="col-md-3 mb-3 header-foot">
                    <h5>Alamat</h5><br><br>
                    <p style="left: 50px; position: relative;">Jl. Prof. Moch Yamin No. 60, Sukoharjo, Kec. Klojen,</p>
                    <p style="left: 50px; position: relative;"> Kota Malang, Jawa Timur</p>
                    <p style="left: 50px; position: relative;">65118</p>
                </div>
                <div class="col-md-3 mb-3 header-foot">
                    <h5>Kontak</h5><br><br>
                    <p style="left: 50px; position: relative;">(0341) 325508</p>
                    <p style="left: 50px; position: relative;">smpn2mlg.medsos@gmail.com</p>
                </div>
                <div class="col-md-3 mb-3 header-foot">
                    <h5>Kantor</h5><br><br>
                    <p class="dino">Senin - Jumat</p>
                    <p class="dino">07.00 - 16.00</p>
                </div>
            </div>
            <div class="row bottom-row">
                <div class="col-md-6 d-flex justify-content-start">
                    <div class="social-icons">
                    <a href="https://www.facebook.com/osis.satwimaba.1"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.youtube.com/channel/UCwuOyXafaSoxICVCQKu1BQg"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.instagram.com/smpnegeri2mlg/?igshid=13omrlhk8pdjp"><i class="bi bi-instagram"></i></a>
                    <a href="https://x.com/smpn2mlg"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <p class="copyright">&copy; 2024 All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>