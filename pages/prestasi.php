<?php
$koneksi = new mysqli("localhost", "root", "", "dashboard_admin");
$result = $koneksi->query("SELECT * FROM prestasi ORDER BY tanggal_upload DESC");
?>

<style>
    @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
    }
    @keyframes rollIn {
    from { opacity: 0; transform: translateX(-200%) rotate(-120deg); }
    to { opacity: 1; transform: translateX(0) rotate(0); }
    }
    .foto-prestasi{
        margin: 5% auto; /* Diubah dari 10% menjadi 3% */
        animation: fadeIn 1.5s ease-in-out;
    }
    .prestasi{
        position: relative;
        margin-left: 35px;
    }
    .prestasi img {
        width: 100%;
        height: auto;
        border-radius: 20px; 
    }
    .prestasi-caption {
        position: absolute;
        bottom: 0;
        left: 12px;
        width: 95.7%; 
        padding: 10px;
        color: white;
        background-color: rgba(0, 0, 0, 0.6); 
        text-align: center;
        font-size: 15px;
        border-radius: 0 0 20px 20px;
        font-family: 'Montserrat', sans-serif;
    }
    .video-title {
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        margin-top: 30px;
        animation: fadeIn 1.5s ease-in-out;
    }
    .video-title h1 {
        font-size: 35px;
       
    }
    .video-title::after {
        content: '';
        display: block;
        width: 30%;
        height: 1px;
        background-color: #E04E4E;
        margin: 30px auto 70px auto;
    }
    #videoCarousel .carousel-inner {
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        margin-bottom: 15%;
        animation: fadeIn 1.5s ease-in-out;
    }
    #videoCarousel .carousel-item img {
        width: 100%;
        height: auto;
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
        left: 10%;
    }
    .carousel-control-next {
        right: 10%;
    }
    .sarpras-title {
        font-size: 35px;
        color: #343a40;
        margin-bottom: 20px;
        text-align: center;
        margin-top: 5%;
        font-family: 'montserrat', sans-serif;
        animation: fadeIn 1.5s ease-in-out;
    }
    .garis-bawah{
        margin: 0 auto;
        width: 30%;
        border: none;
        height: 2px;
        background-color: #E04E4E;
        margin-bottom: 40px; /* Diubah dari 90px menjadi 40px */
    }
</style>
</head>
<body>

<div class="hero-image-container" id="hero" style="animation: fadeIn 1.5s ease-in-out;">
    <img src="image/prestasi.png" class="img-fluid w-100" alt="Hero Image">
  </div>

  <h1 class="sarpras-title">
        Prestasi Siswa
  </h1>
  <hr class="garis-bawah">

  <div class="container foto-prestasi">
    <div class="row justify-content-center">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="col-md-5 mb-5 prestasi">
                <img src="uploads/<?= $row['nama_file']; ?>" alt="Prestasi">
                <div class="prestasi-caption"><?= $row['deskripsi']; ?></div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

 <div class="container video">
  <div class="video-title">
    <h1>Video Karya Siswa</h1>
  </div>
</div>

<div id="videoCarousel" class="carousel slide ">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="https://youtu.be/oefce7-8VwE?si=Y4eAHxY8wt2s9bjr" target="_blank">
        <img src="image/thumbnail prestasi (1).png" class="d-block w-100" alt="Video 1">
        <i class="bi bi-play-circle-fill play-icon"></i>
      </a>
    </div>
    <div class="carousel-item">
      <a href="https://youtu.be/w36G_CZKir4?si=_mL63DNg_1gwm5mr">
        <img src="image/thumbnail prestasi (2).png" class="d-block w-100" alt="Video 2">
        <i class="bi bi-play-circle-fill play-icon"></i>
      </a>
    </div>
    <div class="carousel-item">
      <a href="https://youtu.be/iSaUeqGY0cE?si=bfGVTLr7IkppSCZ2">
        <img src="image/thumbnail prestasi (3).png" class="d-block w-100" alt="Video 3">
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