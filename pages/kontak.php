<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
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
    .kontak-title {
        font-size: 35px;
        color: #343a40;
        margin-bottom: 25px;
        text-align: center;
        margin-top: 7%;
        font-family: 'montserrat', sans-serif;
        animation: fadeIn 1.5s ease-in-out;
    }
    .garis-bawah {
        margin: 0 auto;
        width: 30%;
        border: none;
        height: 2px;
        background-color: #E04E4E;
        margin-bottom: 100px;
    }
    .input-judul h4 {
        font-family: 'montserrat', sans-serif;
        margin-bottom: 25px;
    }
    .input-judul input {
        margin-bottom: 25px;
    }
    input {
        width: 912px;
        height: 59px;
        border-radius: 15px;
        border: solid #2B384B 1px;
        margin-bottom: 6% !important;
    }
    .input-judul {
        margin: 0 auto;
    }
    .form {
        margin: 0 auto;
        justify-content: center;
        width: 60%;
        animation: fadeIn 1.5s ease-in-out;
    }
    ::placeholder {
        padding-left: 20px;
        font-size: 20px;
        font-family: 'montserrat', sans-serif;
    }
    button {
        width: 144px;
        height: 58px;
        font-family: 'montserrat', sans-serif;
        font-size: 20px;
        border-radius: 10px;
        color: white;
        background-color: #E04E4E;
        border: #E04E4E 2px solid;
        transition: all 0.3s;
        margin-bottom: 5%;
    }
    button:hover {
        color: #E04E4E;
        background-color: white;
    }
    iframe {
        border-radius: 30px;
        animation: slideInLeft 1.5s ease-in-out;
    }
    .ekstra-box {
        display: flex;
        margin-left: auto;
        margin-right: auto;
        justify-content: space-between;
        width: 1013px;
        margin-bottom: 7%;
        
    }
    .card {
        background-color: #E04E4E;
        color: white;
        border: 2px solid #E04E4E;
        border-radius: 10px;
        text-align: center;
        padding: 20px;
        margin: 10px;
        width: 270px;
        height: 270px;
        transition: all 0.3s;
        animation: rollIn 1s ease;
    }
    .card:hover {
        background-color: white;
        border: solid 2px #E04E4E;
        color: #E04E4E;
          
    }
    .card i {
        font-size: 50px;
        margin-bottom: 0px;
        padding-top: 20px; 
    }
    .card-title {
        font-size: 16px;
        font-weight: bold;
        margin-top: 40px;
    }
</style>
<body>

<div class="hero-image-container" id="hero" style= "animation: fadeIn 1.5s ease-in-out;">
        <img src="image/hero-kontak.png" class="img-fluid w-100">
    </div>


    <h1 class="kontak-title">
        Masukan
    </h1>
    <hr class="garis-bawah">

    <form action="pages/proses_masukan.php" method="POST" class="container form">
        <div class="input-judul">
            <h4>Nama</h4>
            <input type="text" name="nama" placeholder="Masukkan nama anda" required style="padding-left: 20px;">
        </div>
        <div class="input-judul">
            <h4>Email</h4>
            <input type="email" name="email" placeholder="Masukkan email anda" required style="padding-left: 20px;">
        </div>
        <div class="input-judul">
            <h4>Pesan Dan Saran</h4>
            <textarea name="pesan" style="width: 912px; height: 263px; border-radius: 15px; margin-bottom: 35px; padding-left: 20px;" placeholder="Masukkan Pesan dan Saran Anda" required></textarea>
        </div>
        <button type="submit" class="submit-form">Kirim</button>
    </form>


    <h1 class="kontak-title">
        Hubungi kami
    </h1>
    <hr class="garis-bawah">

    <div class="container contact-info">
        <div class="row justify-content-center maps mb-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d993.0423831126035!2d112.63067219684397!3d-7.990331584322992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6281078b0efe3%3A0x311b001c2c02c1a8!2sSMP%20Negeri%202%20Malang!5e0!3m2!1sid!2sid!4v1731471134120!5m2!1sid!2sid" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class="container ekstra-box">
    <div class="row justify-content-center">
        <div class="card" style="margin-left: 97px ;">
        <i class="fa fa-envelope" aria-hidden="true" style= "margin-top: 20px"></i>
            <div class="card-title" style="position: absolute; bottom: 83px;">smpn2mlg.medsos@gmail.com</div>
        </div>

        <div class="card" style="margin-left: 20px;">
            <i class="bi bi-house-fill"></i></i>
            <div class="card-title" style="position: absolute; bottom: 20px; right: 4px;">SMP NEGERI 2 MALANG<br>
                Jl. Prof. Moch Yamin No. 60, Sukoharjo, Kec. Klojen, Kota Malang, Jawa Timur 65118
            </div>
        </div>

        <div class="card" style="margin-left: 20px;">
            <i class="bi bi-telephone-fill"></i>
            <div class="card-title">( 0341 ) 325508</div>
        </div>
    </div>
    </div>
