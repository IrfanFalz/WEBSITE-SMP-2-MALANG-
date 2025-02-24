<?php
include 'config.php';

$berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
?>
<head>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
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
        .berita-container {
            display: grid;
            grid-template-rows: auto 1fr;
            gap: 30px;
            margin-top: 30px;
        }
        .berita-header {
            text-align: center;
        }
        .berita-title {
            font-size: 35px;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
            margin-top: 5%;
            font-family: 'montserrat', sans-serif;
            animation: fadeIn 1.5s ease-in-out;
            
        }
        .gtw { width: 80%; margin: auto; background: white; padding: 20px; border-radius: 10px; }
        .berita-item { margin-bottom: 20px; padding: 10px; }
        .berita-item img { width: 300px; height: auto; margin-bottom: 30px; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.40); float: right; margin-left: 60px; }
        .berita-item h3 { margin-bottom: 5%; font-size: 30px; font-family: montserrat;}
        .berita-item {font-family: montserrat; font-size: 18px;}
        .garis-bawah {
            margin: 0 auto;
            width: 30%;
            border: none;
            height: 2px;
            background-color: #E04E4E;
            margin-bottom: 50px;
        }
        .grs-bawah {
            margin: 0 auto;
            width: 100%;
            border: none;
            height: 2px;
            background-color: #E04E4E;
            margin-bottom: 50px;
        }
        .berita {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            max-width: 100%;
            animation: fadeIn 1.5s ease-in-out;
        }
        .berita .image-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 275px;
            overflow: hidden;
        }
        .berita .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .berita .text-berita {
            background-color: #E04E4E;
            color: white;
            border-radius: 8px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-wrap: break-word;
        }
        .berita .text-berita h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .berita .text-berita p {
            font-size: 13px;
            margin-bottom: 8px;
            text-align: justify;
        }
        .berita .text-berita .berita-tanggal {
            font-size: 15px;
            color: #ffd1d1;
            margin-top: auto;
        }
        @media (max-width: 768px) {
            .berita {
                grid-template-columns: 1fr;
            }

            .berita .image-container {
                height: auto;
            }

            .berita .image-container img {
                height: auto;
            }
        }
    </style>
</head>

<body>
<div class="hero-image-container" id="hero" style= "animation: fadeIn 1.5s ease-in-out;">
        <img src="image/hero-berita.png" class="img-fluid w-100" alt="Hero Image">
    </div>

    <div class="mb-5 container berita-container">
        <div class="berita-header">
            <h1 class="berita-title">Berita</h1>
            <div class="garis-bawah"></div>
        </div>

        <div class="gtw">
            <?php while ($row = mysqli_fetch_assoc($berita)) { ?>
                <div class="berita-item">
                    <h3><?php echo $row['judul']; ?></h3>
                    <img src="uploads/<?php echo $row['gambar']; ?>" width="150">
                    <p><?php echo $row['deskripsi']; ?></p><br><br>
                    <p><small><?php echo $row['tanggal']; ?></small></p>
        </div>
        <hr class="grs-bawah">
    <?php } ?>
</div>
    </div>

    <script>
        function editBerita(id, judul, deskripsi, gambar, tanggal) {
            document.getElementById('id').value = id;
            document.getElementsByName('judul')[0].value = judul;
            document.getElementsByName('deskripsi')[0].value = deskripsi;
            document.getElementsByName('gambar')[0].value = gambar;
            document.getElementsByName('tanggal')[0].value = tanggal;
        }
    </script>