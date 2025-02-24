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
    .dg-title {
        font-size: 35px;
        color: #343a40;
        margin-bottom: 25px;
        text-align: center;
        margin-top: 7%;
        font-family: 'montserrat', sans-serif;
        font-weight: bold;
        animation: fadeIn 1.5s ease-in-out;
    }
    .garis-bawah{
        margin: 0 auto;
        width: 30%;
        border: none;
        height: 2px;
        background-color: #E04E4E;
        margin-bottom: 100px;
    }
    #fotoCarousel .carousel-inner {
        max-width: 1200px;
        margin: 0 auto;
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        margin-bottom: 7%;
        animation: fadeIn 1.5s ease-in-out;
    }
    #fotoCarousel .carousel-item img {
        width: 100%;
        height: auto;
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
    .textdg{
        width: 80%;
        max-width: 1100px;
        justify-content: center;
        align-items: center;
        text-align: center;
        background-color: #E04E4E;
        padding: 50px;
        margin-bottom: 6% !important;
        margin: 0 auto;
        font-size: 17px;
        color: white;
        border-radius: 15px;
        animation: fadeIn 1.5s ease-in-out;"
    }

</style>
<body>

<div class="hero-image-container" id="hero" style="animation: fadeIn 1.5s ease-in-out;">
        <img src="image/hero-dg.png" class="img-fluid w-100">
    </div>
<h1 class="dg-title">
   Dewan Galang
</h1>
<hr class="garis-bawah">

<div id="fotoCarousel" class="carousel slide ">
    <div class="carousel-inner">
      <div class="carousel-item active">
          <img src="image/slideshow dg(1).png" class="d-block w-100" alt="foto 1">
      </div>
      <div class="carousel-item">
          <img src="image/slideshow dg (2).png" class="d-block w-100" alt="foto 2">
      </div>
      <div class="carousel-item">
          <img src="image/slideshow dg (3).png" class="d-block w-100" alt="foto 3">
      </div>
      <div class="carousel-item">
          <img src="image/slideshow dg (4).png" class="d-block w-100" alt="foto 4">
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

<div class="textdg">
    <p st><strong>Dewan Galang</strong> adalah organisasi siswa yang bertujuan mengembangkan jiwa kepemimpinan dan kedisiplinan di SMPN 2 Malang. Melalui berbagai kegiatan seperti rapat bulanan, pelatihan kepemimpinan, dan bakti sosial, anggota diajak untuk aktif berkontribusi dalam meningkatkan kualitas sekolah dan masyarakat. Keanggotaan terbuka untuk seluruh siswa, memberikan kesempatan bagi mereka untuk berkolaborasi dan mengekspresikan kreativitas. Dengan semangat kebersamaan, Dewan Galang berkomitmen menciptakan lingkungan sekolah yang lebih baik dan harmonis.</p>
</div>
<div class="textdg">
    <p><strong>Ekstrakulikuler</strong> ini memilikii jadwal pada hari senin sampai jumat pada jam sepulang sekolah. dan pada hari sabtu dilaksanakan pada jam 08.30 WIB. ekstrakulikuler ini adalah ekstrakulikuler yang satu aliran dengan Pramuka. pada ekstrakulikuler ini diajarkan bagaimana membuat pioneering, sandi morse, yel yel, pbb, dan p3k</p>
</div>