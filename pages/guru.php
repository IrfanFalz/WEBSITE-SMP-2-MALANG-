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
    .foto-guru-container {
        position: relative;
        width: 100%;
        max-width: 1200px; 
        margin: 10% auto; 
        border-radius: 15px;
        animation: fadeIn 1.5s ease-in-out;
    }
    .foto-guru-container img {
        width: 100%;
        display: block;
    }
    .foto-guru-caption {
        position: absolute;
        bottom: 10px;
        width: 1194px;
        background: rgba(0, 0, 0, 0.6); 
        color: white;
        text-align: center;
        padding: 25px;
        font-size: 1.2em;
        border-radius: 0 0 50px 50px;
        font-family: 'montserrat', sans-serif;
        font-weight: bold;
    }
    .kepsek{
        justify-content: center;
        display: flex;
        margin-bottom: 13%;
    }
    .title-struktur{
        text-align: center;
        font-family: 'montserrat', sans-serif;
        font-size: 35px;
        margin-bottom: 35px;
        animation: fadeIn 1.5s ease-in-out;
    }
    .title-struktur::after{
        content: '';
        display: block;
        width: 30%;
        height: 1px;
        background-color: #E04E4E;
        margin: 20px auto 50px auto;
    }
    .waka{
        display: flex;
        justify-content: space-evenly;
        margin-bottom: 15%;
    }
    .footer h5 {
        font-size: 1.25rem;
        margin-bottom: 20px;
    }
    .footer p {
        margin: 0;
        font-size: 1rem;
    }
    .footer .social-icons a {
        color: #FFFFFF;
        font-size: 1.5rem;
        margin-right: 15px;
    }
    .footer .copyright {
        text-align: right;
        margin-top: 20px;
        font-size: 1rem;
    }
    .footer .row > div {
        margin-bottom: 30px;
    }
    .footer {
        background-color: #2B384B;
        color: white;
        padding: 20px 0;
        text-align: left;
    }
    .header-foot h5{
        font-family: 'montserrat', sans-serif;
        font-weight: bold;
        font-size: 28px;
        position: relative;
        left: 50px;
    }
    .header-foot p{
        font-family: 'open sans', sans-serif;
    }
    .dino{
        position: relative;
        left: 50px;
    }
    .vismi{
        position: relative;
        top: 30px;
    }
    .struktur{
        text-align: center;
        justify-content: center;
        margin-bottom: 10%;
    }
  </style>
</head>
<body>
<div class="hero-image-container" id="hero" style="animation: fadeIn 1.5s ease-in-out;">
    <img src="image/hero-guru.png" class="img-fluid w-100" alt="Hero Image">
  </div>

  <!--foto bapak ibu guru-->
  <div class="foto-guru-container">
    <img src="image/foto bersama guru.png" alt="Foto Bapak Ibu Guru">
    <div class="foto-guru-caption">Bapak Ibu Guru SMP Negeri 2 Malang</div>
  </div>

    <h1 class="title-struktur">
       Struktur organisasi
    </h1>
    <div class="container">
        <div class="struktur" style="animation: fadeIn 1.5s ease-in-out;">
            <img src="image/struktur-organisasi.png" alt="">
        </div>
    </div>