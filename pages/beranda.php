<?php
include 'config.php'; // Pastikan file koneksi database sudah benar

$query = mysqli_query($conn, "SELECT * FROM sambutan LIMIT 1");
$sambutan = mysqli_fetch_assoc($query);

// Ambil 5 berita terbaru
$query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 5");
$berita = [];
while ($row = mysqli_fetch_assoc($query)) {
    $berita[] = $row;
}

// Ambil 3 prestasi terbaru
$query = mysqli_query($conn, "SELECT nama_file FROM prestasi ORDER BY id DESC LIMIT 3");
$prestasi = [];
while ($row = mysqli_fetch_assoc($query)) {
    $prestasi[] = $row;
}
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
  .img-kepsek {
    
    border-radius: 30px;
  }
  .smb{
    font-size: 1.5rem;
  }
  .sambutan-section{
    margin-top: 100px;
    margin-bottom: 75px;
    margin-left: 70px;
    font-family: 'montserrat', sans-serif;
    animation: fadeIn 1.5s ease-in-out;
  }
  .sambutan-section h1{
    color: #E04E4E;
  }
  .program-title {
    font-size: 35px;
    color: #fff;
    margin-bottom: 20px;
    text-align: center;
    margin-top: 5%;
    font-family: 'montserrat', sans-serif;
    animation: fadeIn 1.5s ease-in-out;
  }
  .program-card {
    background-color: #fff;
    color: #333;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    animation: rollIn 1s ease;
  }
  .program-card:hover{
    background-color: #E04E4E;
    color: white;
    border: solid 1px white;
  }
  .program-card h5{
    font-family: 'montserrat', sans-serif;
  }
  .program-card p{
    font-family: 'open sans', sans-serif;
  }
  .icon {
    font-size: 36px;
    color: #E04E4E;
    margin-bottom: 10px;
    transition: all 0.3s;
  }
  .icon:hover{
    color: white;
  }
  .berita-header hr{
    width: 30%;
    border-top: 2px solid black;
    margin: 0 auto;
    margin-top: 25px;
  }
  .program{
    background-color: #E04E4E;
    padding: 50PX;
  }
  .program hr{
    width: 30%;
    height: 2px;
    color: white;
    margin: 0 auto;
    margin-bottom: 35px;
  }
  .news-title {
    text-align: center;
    font-size: 35px;
    color: #333;
    margin-top: 10%;
    font-family: 'montserrat', sans-serif; 
    animation: fadeIn 1.5s ease-in-out;     
  }
  .news-title::after {
    content: '';
    display: block;
    height: 1px;
    background-color: #E04E4E;
    margin: 20px auto;
    width: 30%;
    margin-bottom: 35px;
  }
  .news-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
    animation: slideInLeft 1.5s ease-in-out;
  }
  .news-item {
    position: relative;
    width: 700px;
    height: 400px;
    border-radius: 8px;
    overflow: hidden;
  }
  .news-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
  }
  .news-caption {
    position: absolute;
    bottom: 10px;
    color: #fff;
    width: 100%;
    padding: 10px;
    font-size: 14px;
    text-align: center;
    font-size: 20px;
    font-family: 'montserrat', sans-serif;
  }
  .small-news-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 10px;
  }
  .small-news-item {
    width: 220px;
    height: 125px;
    overflow: hidden;
    border-radius: 8px;
  }
  .small-news-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .vertical-news-item {
    position: relative;
    width: 300px;
    height: 535px;
    overflow: hidden;
    border-radius: 8px;
  }
  .vertical-news-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .news-item img,
  .vertical-news-item img,
  .small-news-item img {
    transition: transform 0.3s ease;
  }
  .news-item:hover img,
  .vertical-news-item:hover img,
  .small-news-item:hover img {
    transform: scale(1.05);
  }
  .title-prestasi {
    font-size: 35px;
    color: #343a40;
    margin-bottom: 20px;
    text-align: center;
    margin-top: 70px;
    font-family: 'montserrat', sans-serif;
    animation: fadeIn 1.5s ease-in-out;
  }
  .garis {
    width: 30%;
    height: 2px;
    background-color: #dc3545;
    margin: 0 auto 40px;
  }
  .card {
    border-radius: 15px;
    margin-bottom: 60px;
    overflow: hidden;
    animation: rollIn 1s ease;
    width: 300px;
    height: 250px;
  }
  .card img {
    border-radius: 15px;
    width: 100%;
    height: 250px;
    transition: transform 0.3s ease;
  }
  .card:hover img {
    transform: scale(1.1);
  }
  .card img {
    object-fit: cover;
  }
  
</style>

<div class="hero-image" id="hero" style= "animation: fadeIn 1.5s ease-in-out;">
    <img src="uploads/hero (4).png" class="img-fluid w-100" alt="Hero Image">
</div>

<div class="container sambutan-section">
    <div class="row align-items-center">
        <div class="col-md-7 sambutan-text">
            <p class="smb">Sambutan</p>
            <h1>Kepala Sekolah</h1>
            <p>Assalamualaikum Warahmatullahi Wabarakatuh</p>
            <p><?php echo nl2br($sambutan['deskripsi']); ?></p>
            <p><strong>~ <?php echo $sambutan['nama_kepsek']; ?></strong></p>
        </div>
        <div class="col-md-5 text-center">
            <img src="uploads/<?php echo $sambutan['gambar']; ?>" alt="Gambar Kepala Sekolah" class="img-kepsek">
        </div>
    </div>
</div>

<div class="program">
  <h2 class="program-title">Program</h2>
  <hr style="border: none; height: 2px; background-color: #fff;">
  <div class="row justify-content-center">

    <div class="col-md-3 mx-3">
      <div class="program-card text-center">
        <div class="icon"><i class="bi bi-person-circle"></i></div>
        <h5>SIMBA ASIA</h5><br>
        <p>( Sinau Mandiri Bersama Anak Satwimaba Istimewa )</p>
        <p>Sebuah inovasi pendidikan yang memberdayakan anak berkebutuhan khusus agar dapat mengakses pendidikan secara optimal</p>
      </div>
    </div>

    <div class="col-md-3 mx-3">
      <div class="program-card text-center">
        <div class="icon"><i class="bi bi-journal-bookmark-fill"></i></div>
        <h5>ACTIYA SATWIMABA</h5><br>
        <p>Actiya Satwimaba adalah perpustakaan di SMP Negeri 2 Malang yang memiliki koleksi pustaka yang beragam. Koleksi berbagai jenis buku, fiksi maupun non fiksi. Selain itu juga terdapat karya guru dan peserta didik yang dibukukan</p>
      </div>
    </div>

    <div class="col-md-3 mx-3">
      <div class="program-card text-center">
        <div class="icon"><i class="bi bi-tree-fill"></i></div>
        <h5>ADIWIYATA</h5><br>
        <p>Pengembangan budaya ramah / peduli lingkungan digalakkan melalui kegiatan pembiasaan, intrakurikuler, kokurikuler maupun ekstrakurikuler secara berkesinambungan semua disinergikan untuk kepentingan seluruh warga sekolah</p>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="news-title">
   <h1>Berita</h1>
  </div>
  <div class="news-container">
    <div>
        <!-- Berita utama -->
        <?php if (!empty($berita)) { ?>
            <div class="news-item">
                <a href="index.php?page=berita&id=<?= $berita[0]['id']; ?>">
                    <img alt="<?= $berita[0]['judul']; ?>" height="300" src="uploads/<?= $berita[0]['gambar']; ?>" width="500"/>
                    <div class="news-caption">
                        <?= $berita[0]['judul']; ?>
                    </div>
                    <p><?= substr($berita[0]['deskripsi'], 0, 100); ?>...</p> <!-- Potongan deskripsi -->
                </a>
            </div>
        <?php } ?>

        <!-- Berita kecil (3 berita selanjutnya) -->
        <div class="small-news-container">
            <?php for ($i = 1; $i < 4 && $i < count($berita); $i++) { ?>
                <div class="small-news-item">
                    <a href="index.php?page=berita&id=<?= $berita[$i]['id']; ?>">
                        <img alt="<?= $berita[$i]['judul']; ?>" height="100" src="uploads/<?= $berita[$i]['gambar']; ?>" width="150"/>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Berita samping (berita ke-5 jika ada) -->
    <?php if (count($berita) >= 5) { ?>
        <div class="vertical-news-item">
            <a href="index.php?page=berita&id=<?= $berita[4]['id']; ?>">
                <img alt="<?= $berita[4]['judul']; ?>" height="410" src="uploads/<?= $berita[4]['gambar']; ?>" width="300"/>
                <div class="news-caption">
                    <?= $berita[4]['judul']; ?>
                </div>
                <p><?= substr($berita[4]['deskripsi'], 0, 100); ?>...</p> <!-- Potongan deskripsi -->
            </a>
        </div>
    <?php } ?>
</div>
</div>

<h1 class="title-prestasi">
  Prestasi
 </h1>
  <div class="garis">
 </div>
 <div class="container">
    <div class="row justify-content-center">
        <?php foreach ($prestasi as $p) { ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <a href="index.php?page=prestasi">
                        <img src="uploads/<?= $p['nama_file']; ?>" class="card-img-top" alt="Prestasi">
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</body>



