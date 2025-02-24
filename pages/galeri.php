<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "dashboard_admin");

// Pastikan koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari database dengan urutan dari yang terlama ke terbaru
$result = $koneksi->query("SELECT * FROM galeri ORDER BY id ASC");

?>

<style>
    .nav-link {
        position: relative;
        transition: color 0.3s, transform 0.3s;
    }
    .nav-link:hover {
        color: #E04E4E;
        transform: scale(1.1);
    }
    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -5px;
        width: 0;
        height: 2px;
        background: #E04E4E;
        transition: width 0.3s ease;
    }
    .nav-link:hover::after {
        width: 100%;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .galeri-title {
        font-size: 35px;
        color: #343a40;
        margin-bottom: 20px;
        text-align: center;
        margin-top: 5%;
        font-family: 'Montserrat', sans-serif;
        animation: fadeIn 1.5s ease-in-out;
    }
    .gallery-item img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 20px;
        margin-bottom: 40px;
    }
    .garis-bawah {
        margin: 0 auto;
        width: 30%;
        border: none;
        height: 2px;
        background-color: #E04E4E;
        margin-bottom: 90px;
    }
    #videoCarousel .carousel-inner {
        max-width: 1100px;
        margin: 0 auto;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        margin-bottom: 15%;
        animation: fadeIn 1.5s ease-in-out;
    }
    .play-icon {
        font-size: 3rem;
        color: white;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        transition: color 0.3s;
    }
    .play-icon:hover {
        color: #E04E4E;
    }
    .carousel-control-prev,
    .carousel-control-next {
        width: auto;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: black;
        font-size: 1.5rem;
        padding: 10px;
    }
    .carousel-control-prev {
        left: 13%;
    }
    .carousel-control-next {
        right: 13%;
    }
</style>

<body>

<div class="hero-image-container" id="hero" style="animation: fadeIn 1.5s ease-in-out;">
    <img src="image/hero-galeri.png" class="img-fluid w-100 mb-4">
</div>

<h1 class="galeri-title">Galeri Foto</h1>
<hr class="garis-bawah">

<div class="container gallery-container">
    <div class="row justify-content-center">
        <?php
        while ($row = $result->fetch_assoc()) {
            $gambarPath = "uploads/" . $row['nama_file'];
            echo "<div class='col-md-5 gallery-item'>
                    <img src='$gambarPath' class='img-fluid' alt='Gambar Galeri'>
                  </div>";
        }
        ?>
    </div>
</div>

<h1 class="galeri-title">Galeri Video</h1>
<hr class="garis-bawah">

<div id="videoCarousel" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="https://youtu.be/cOkSZ17gm5k?si=9ObQT-696s8QLUzR" target="_blank">
                <img src="image/thumbnail galeri.png" class="d-block w-100" alt="Video 1">
                <i class="bi bi-play-circle-fill play-icon"></i>
            </a>
        </div>
        <div class="carousel-item">
            <a href="https://youtu.be/tHej61IUL58?si=qNmdtUelhiaq7g6C" target="_blank">
                <img src="image/thumbnail galeri (1).png" class="d-block w-100" alt="Video 2">
                <i class="bi bi-play-circle-fill play-icon"></i>
            </a>
        </div>
        <div class="carousel-item">
            <a href="https://youtu.be/QBW5-ainqbo?si=C8scTmlJLTKi_LcZ" target="_blank">
                <img src="image/thumbnail galeri (2).png" class="d-block w-100" alt="Video 3">
                <i class="bi bi-play-circle-fill play-icon"></i>
            </a>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

</body>
