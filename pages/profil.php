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
    .welcome-section {
      padding: 40px 20px;
      border-radius: 8px;
      animation: fadeIn 1.5s ease-in-out;
    }
    .welcome-text h1 {
      font-weight: bold;
      font-size: 2rem;
      color: #333;
      margin-bottom: 20px;
      font-family: 'montserrat', sans-serif;
    }
    .welcome-text p {
      font-size: 1.2rem;
      color: #555;
      font-family: 'open sans', sans-serif;
    }
    .hero-image {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }  
    .text1-profil {
      background-color: #E04E4E;
      color: white;
      border-radius: 20px;
      padding: 36px;
      margin: 25px;
      font-size: 17px;
      max-width: 1100px;
      border: 1px solid #E04E4E; 
      box-shadow: 0px 10px 8px rgba(0, 0, 0, 0.2);
      font-family: 'montserrat', sans-serif;
      animation: slideInLeft 1.5s ease-in-out;
    }
    .text1-profil strong {
      padding-left: 50px;
    }
    .text2-profil span {
      padding-left: 50px;
    }
    .text2-profil {
      border-radius: 20px;
      padding: 36px;
      font-size: 17px;
      margin-bottom: 25px;
      max-width: 1100px;
      font-family: 'montserrat', sans-serif;
      border: 1px solid white;
      box-shadow: 0px 7px 5px rgba(0, 0, 0, 0.2);
      animation: slideInLeft 1.5s ease-in-out;
    }
    .visi-misi-container {
      max-width: 800px;
      margin: 80px auto;
      animation: fadeIn 1.5s ease-in-out;
    }
    .visi-section {
      background-color: #E04E4E; 
      color: white;
      padding: 20px;
      border-radius: 20px 0 0 20px;
      font-family: 'montserrat', sans-serif;
    }
    .visi-section h3{
      font-weight: bold;
    }
    .misi-section {
      background-color: #F4B158; 
      display: flex;
      align-items: stretch;
      padding: 0; 
      border-radius: 0 20px 20px 0;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }
    .misi-section img {
      width: 100%;
      height: 100%;
      object-fit: cover; 
      border-radius: 0 15px 15px 0;
    }
  .text1-sejarah{
      background-color: #E04E4E;
      color: white;
      border-radius: 20px;
      padding: 36px;
      margin: 25px;
      font-size: 17px;
      max-width: 1100px;
      border: 1px solid #E04E4E; 
      box-shadow: 0px 10px 8px rgba(0, 0, 0, 0.2);
      font-family: 'montserrat', sans-serif;
      animation: slideInLeft 1.5s ease-in-out;
    }
    .text1-sejarah .text2-sejarah .text3-sejarah span{
      padding-left: 50px;
    }
    .text2-sejarah{
      border-radius: 20px;
      padding: 36px;
      font-size: 17px;
      max-width: 1100px;
      margin-bottom: 25px;
      font-family: 'montserrat', sans-serif;
      border: 1px solid white;
      box-shadow: 0px 7px 5px rgba(0, 0, 0, 0.2);
      animation: slideInLeft 1.5s ease-in-out;
    }
    .text3-sejarah{
      background-color: #E04E4E;
      color: white;
      border-radius: 20px;
      padding: 36px;
      margin: 25px;
      margin-bottom: 15%;
      font-size: 17px;
      max-width: 1100px;
      border: 1px solid #E04E4E; 
      box-shadow: 0px 10px 8px rgba(0, 0, 0, 0.2);
      font-family: 'montserrat', sans-serif;
      animation: slideInLeft 1.5s ease-in-out;
    }
    .struktur-guru {
      position: relative;
      width: 100%;
      margin: auto;
      max-width: 1200px;
      overflow: hidden;
      margin-bottom: 10%;
      animation: slideInLeft 1.5s ease-in-out;
    }
    .struktur-guru img {
      width: 100%;
      height: auto;
      filter: brightness(70%);
      display: block;
      border-radius: 20px;
    }
    .textguru-overlay {
      position: absolute;
      top: 60px; 
      left: 40px; 
      color: white;
      font-size: 1.5em; 
      font-weight: bold;
      text-align: left; 
      padding: 10px;
      font-family: 'montserrat', sans-serif;
      font-size: 40px;
    }
    .button {
      position: absolute;
      bottom: 60px; 
      left: 30px;   
      align-items: center;
      background-color: #E04E4E;
      color: white;
      padding: 12px 24px;
      font-size: 18px;
      font-family: 'Montserrat', sans-serif;
      font-weight: bold;
      text-decoration: none;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      margin-top: 15px;
    }
    .button i {
      margin-left: 8px;
      font-size: 20px;
    }
    .button:hover {
      background-color: white;
      color: #E04E4E;
      border: 2px solid #E04E4E;
      transition: all 0.4s;
    }
</style>
<body>
<div class="hero-image-container" id="hero" style="animation: fadeIn 1.5s ease-in-out;">
    <img src="image/hero-profil.png" class="img-fluid w-100" alt="Hero Image">
  </div>

   <div class="container my-5 align-items-center">
    <div class="row justify-content-center align-items-center welcome-section">
      <div class="col-md-5 welcome-text">
        <h1>Profil</h1>
        <p>Profil SMPN 2 Malang</p>
      </div>
      <div class="col-md-3 text-center">
        <img src="image/Logo satwimaba.png" alt="Gambar Hero" class="hero-image img-fluid" width="530" height="450">
      </div>
    </div>
  </div>

  <div class="container profil1">
    <div class="row justify-content-center">
      <div class="col-md-12 text1-profil">
        <p><strong>SMP Negeri 2 Malang</strong>adalah salah satu lembaga pendidikan formal di bawah naungan Dinas Pendidikan dan Kebudayaan Kota Malang. Lembaga ini beralamat di Jl. Prof. Moh. Yamin, 60, Sukoharjo, Kec. Klojen, Kota Malang. Secara strategis, SMP Negeri 2 Malang terletak di salah satu wilayah pusat perekonomian Kota Malang, tepatnya di selatan Pasar Besar Kota Malang. Saat ini, SMP Negeri 2 Malang memiliki dari 12 (duabelas) rombel belajar pada jenjang kelas 8 dan 9, sedangkan kelas 7 memiliki 10 rombel belajar. Masing-masing kelas rata-rata berjumlah 30 (tiga puluh) peserta didik. Total jumlah peserta didik adalah 1064 siswa. Adapun untuk jumlah pendidik dan tenaga kependidikan berjumlah 85 (delapan puluh lima) orang, yang terbagi atas guru mata pelajaran dan karyawan pada bidangnya masing-masing.</p>
      </div>
      <div class="col-md-12 text2-profil">
        <p><span>SMP Negeri 2 Malang</span> termasuk salah satu Sekolah Standar Nasional berpredikat Adiwiyata Mandiri pada tahun 2021 dan saat ini tengah menuju Asean Eco School. SMPN 2 Malang ditetapkan sebagai Sekolah Adiwiyata Mandiri mulai tahun 2021. Pengembangan budaya ramah/peduli lingkungan digalakkan melalui kegiatan pembiasaan, intrakurikuler, kokurikuler maupun ekstrakurikuler secara berkesinambungan semua disinergikan untuk kepentingan seluruh warga sekolah di SMP Negeri 2 Malang</p>
      </div>
    </div>
  </div>

  <div class="text-center" style="animation: fadeIn 1.5s ease-in-out;">
    <h1 style="font-family: 'montserrat', sans-serif; font-weight: bold; margin-top: 100px;">Visi & Misi</h1>
    <p style="font-family: 'montserrat', sans-serif;">Visi Dan Misi SMPN 2 Malang</p>
  </div>
  <div class="visi-misi-container row">
    <div class="col-md-6 visi-section">
      <h3>VISI SEKOLAH</h3>
      <p>“UNGGUL IMTAQ DAN IPTEK, BERKARAKTER PANCASILA, SERTA PEDULI DAN BERBUDAYA LINGKUNGAN”</p>
      <h4>MISI SEKOLAH</h4>
      <ol>
        <li>Meningkatkan keterlaksanaan iman dan taqwa;</li>
        <li>Meningkatkan keterlaksanaan pembelajaran bermutu;</li>
        <li>Memanfaatkan dan mengembangkan teknologi informasi serta komunikasi dalam pembelajaran;</li>
        <li>Meningkatkan keterlaksanaan pendidikan karakter Pancasila dan budaya;</li>
        <li>Melakukan pencegahan pencemaran lingkungan hidup;</li>
        <li>Melakukan pencegahan kerusakan lingkungan hidup;</li>
        <li>Melakukan upaya pelestarian lingkungan hidup;</li>
        <li>Memanfaatkan lingkungan sekitar sebagai salah satu sumber belajar.</li>
      </ol>
    </div>
    <div class="col-md-6 misi-section">
      <img src="image/image visi misi.png" alt="Ilustrasi tangga dan ide">
    </div>
  </div>

  <div class="text-center" style="animation: fadeIn 1.5s ease-in-out;">
    <h1 style="font-family: 'montserrat', sans-serif; font-weight: bold; margin-top: 70px;">Sejarah</h1>
    <p style="font-family: 'montserrat', sans-serif;">Sejarah SMPN 2 Malang</p>
  </div>
  <div class="container sejarah">
    <div class="row justify-content-center">
      <div class="col-md-12 text1-sejarah">
        <p> <span>SMP Negeri 2 Malang</span>, sejarahnya merupakan sebuah tangsi (markas) Belanda dan Jepang. Setelah deklarasi kemerdekaan, tempat tersebut digunakan untuk sekolah jenjang SMP yang dikelola oleh sebuah yayasan PGI (Persatuan Guru Indonesia) sehingga diberi nama SMP PGI. Berdasarkan SK Menteri Pendidikan Pengajaran dan Kebudayaan No. 3957 B, tanggal 3 Juni 1950 dan untuk menyempurnakan penyelenggaraan pelajaran maka pengelolanya diambil alih oleh Kementerian Pendidikan Pengajaran dan Kebudayaan, yang selanjutnya diberi nama SMP Negeri II Malang. Pada saat pertama kali beroperasi, SMP ini diresmikan dan dipimpin oleh Pjs Mochammad Soekarto yang sekaligus merupakan Kepala Sekolah pertama.</p>
      </div>
      <div class="col-md-12 text2-sejarah">
        <p><span> Selama kurun waktu 65 tahun</span>keberadaan SMP Negeri 2 Malang telah beberapa kali mengalami estafet kepemimpinan. Hal tersebut disebabkan kepala sekolah purna tugas atau mutasi tempat kerja. Namun, selama beberapa kali pergantian kepala sekolah, kualitas SMP Negeri 2 Malang tetaplah bagus dan cenderung meningkat, serta mampu menjadi lembaga pendidikan yang mengantarkan peserta didiknya berprestasi.</p>
      </div>
      <div class="col-md-12 text3-sejarah">
        <p><span> Berdasarkan</span> dari jumlah gedung pada saat SMP 2 ini berdiri, ada 16 ruang belajar. Seiring berjalannya waktu, SMP Negeri 2 Malang sudah memiliki 30 ruangkelas belajar dan 15 ruang pendukung kegiatan belajar mengajar. Adapun ruang pendukung kegiatan belajar mengajar tersebut, meliputi: perpustakaan, laboratorium biologi, laboratorium fisika, laboratorium komputer, laboratorium boga, lapangan olahraga, ruang pojok baca, studio musik dan gamelan, panggung pertunjukan, sanggar pramuka, ruang OSIS, ruang paskibra, ruang UKS dan masjid. Selain itu, SMP Negeri 2 Malang termasuk Sekolah Standar Nasional (SSN) berdasarkan SK dengan No. 960/C3/Kp/2005 tentang Penetapan Sekolah Menengah Pertama Standar Nasional tahun Anggaran 2005.</p>
      </div>
    </div>
  </div>

  <div class="container struktur-guru">
    <img src="image/bapak ibu guru.png" alt="Struktur Organisasi">
    <div class="textguru-overlay">
      Struktur Organisasi
    </div>
    <a <?= ($page == 'guru') ? 'active' : '' ?>" href="index.php?page=guru" class="button">
      Baca Selengkapnya <span><i class="bi bi-arrow-right"></i></span>
    </a>
  </div>
</body>