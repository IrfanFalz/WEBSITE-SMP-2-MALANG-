<?php
include 'config.php';
$data = mysqli_query($conn, "SELECT * FROM ekstrakurikuler");
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kesiswaan SMPN 2 Malang</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
  }
  @keyframes rollIn {
    from { opacity: 0; transform: translateX(-200%) rotate(-120deg); }
    to { opacity: 1; transform: translateX(0) rotate(0); }
  }
    .organisasi{
        margin: 6% auto 10% auto ;
        animation: slideInLeft 1.5s ease-in-out;
    }
    .organisasi-card{
        gap: 20px;
        justify-content: center;
    }
    .organisasi-title {
        font-size: 35px;
        color: #343a40;
        margin-bottom: 20px;
        text-align: center;
        margin-top: 10%;
        font-family: 'montserrat', sans-serif;
        animation: fadeIn 1.5s ease-in-out;
    }
    .garis-bawah{
        margin: 0 auto;
        width: 30%;
        border: none;
        height: 2px;
        background-color: #E04E4E;
        margin-bottom: 60px;
    }
    #fotoCarousel .carousel-inner {
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        margin-bottom: 15%;
        animation: fadeIn 1.5s ease-in-out;
    }
    #fotoCarousel .carousel-item img {
        width: 100%;
        height: auto;
    }
    .caption-ekstra {
        position: absolute;
        bottom: 50px;
        left: 50%; 
        transform: translateX(-50%); 
        color: white;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        font-size: 35px;
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
    .ekstra-box {
    display: flex;
    flex-wrap: wrap;
    row-gap: 40px;    
    column-gap: 130px;  
    justify-content: center;
    max-width: 1100px;  
    margin: 0 auto 7% auto;
    animation: fadeIn 1.5s ease-in-out;
}

.card {
    position: relative;
    background-color: #E04E4E;
    color: white;
    border: 2px solid #E04E4E;
    border-radius: 10px;
    text-align: center;
    overflow: hidden;
    width: 250px;
    height: 250px;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    font-family: 'montserrat', sans-serif;
    margin: 0; /* Menghapus semua margin */
    flex: 0 0 250px; /* Memastikan ukuran tetap */
}
.card img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    transition: transform 0.3s ease;
}

.card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(224, 78, 78, 0.5); 
    z-index: 2;
}

.card-title {
    font-size: 16px;
    font-weight: bold;
    margin: 0 10px 10px 10px;
    z-index: 3;
    position: relative;
    color: white;
    transition: color 0.3s ease;
}

.card:hover img {
    transform: scale(1.2); 
}

.card:hover {
    background-color: white;
    border: solid 2px #E04E4E;
}

.card:hover .card-title {
    color: #D3D3D3; 
}


.card:nth-last-child(1) {
    margin: auto; 
}
</style>
<body>

<div class="hero-image-container" id="hero" style="animation: fadeIn 1.5s ease-in-out;">
        <img src="image/hero (5).png" class="img-fluid w-100">
    </div>

    <h1 class="organisasi-title">
        Organisasi Siswa 
    </h1>
    <hr class="garis-bawah">

    <div class="container organisasi">
        <div class="row justify-content-left organisasi-card">
            <div class="col-md-5 osis">
                <img src="image/organisasi (1).png" alt="osis">
            </div>
            <div class="col-md-5 polisi">
                <img src="image/organisasi (2).png" alt="polisi disiplin">
            </div>
        </div>
    </div>

    <h1 class="organisasi-title ekskul">
        Ekstrakulikuler
    </h1>
    <hr class="garis-bawah">

    <div id="fotoCarousel" class="carousel slide ">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="image/slideshow ekstra (1).png" class="d-block w-100" alt="foto 1">
                <p class="caption-ekstra">Basket</p>
            </div>
            <div class="carousel-item">
                <img src="image/slideshow ekstra (2).png" class="d-block w-100" alt="foto 2">
                <p class="caption-ekstra">Dewan Galang</p>
            </div>
            <div class="carousel-item">
                <img src="image/slideshow ekstra (3).png" class="d-block w-100" alt="foto 3">
                <p class="caption-ekstra">Paskibra</p>
            </div>
            <div class="carousel-item">
                <img src="image/slideshow ekstra (4).png" class="d-block w-100" alt="foto 4">
                <p class="caption-ekstra">Palang Merah Remaja</p>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#fotoCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#fotoCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
        </button>
      </div>

    <div class="container ekstra-box">
    <?php while ($row = mysqli_fetch_assoc($data)): ?>
        <div class="card">
            <img src="uploads/<?= $row['gambar']; ?>" alt="<?= $row['nama_eskul']; ?>">
            <div class="card-title"><?= $row['nama_eskul']; ?></div>
    </div>
    <?php endwhile; ?>
    </div>
    </div>
