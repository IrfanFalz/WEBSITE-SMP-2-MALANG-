<?php
include 'config.php';
$query = "SELECT * FROM sarpras";
$result = mysqli_query($conn, $query);
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
        margin-bottom: 90px;
    }
    .garis-bawah{
        margin: 0 auto;
        width: 30%;
        border: none;
        height: 2px;
        background-color: #E04E4E;
        margin-bottom: 90px;
    }
    .kotak {
        width: 157px; 
        height: 157px; 
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid #E04E4E;
        border-radius: 10px;
        transition: all 0.3s;
        animation: rollIn 1s ease;
    }
    .kotak:hover{
        background-color: #E04E4E;
        border: 2px solid white;
    }
    .kotak svg {
        color: #E04E4E;
        width: 50px; 
        height: 50px;
        transition: all 0.3s;
    }
    .kotak svg:hover{
        color: white;
        background-color: #E04E4E;
    }
    .kotak-icon {
        display: flex;
        flex-wrap: wrap; 
        gap: 20px; 
        justify-content: center;
        align-items: center;
        margin-bottom: 10%;
    }
    .text-sarpras1 {
        background-color: #E04E4E;
        border-radius: 20px;
        animation: fadeIn 1.5s ease-in-out;
    }
    .text-sarpras1 .judulsarpras{
        font-family:'montserrat', sans-serif;
        color: white;
        font-size: 25px;
        position: relative;
        top: 50px;
        padding-left: 20px;
        padding-right: 20px;
    }
    .text-sarpras1 .isi{
        font-family:'montserrat', sans-serif;
        color: white;
        font-size: 16px;
        position: relative;
        top: 50px;
        padding-left: 20px;
        padding-right: 20px;
    }
    .text-sarpras2 {
        background-color: #E04E4E;
        border-radius: 20px;
        animation: fadeIn 1.5s ease-in-out;
    }
    .text-sarpras2 .judulsarpras{
        font-family:'montserrat', sans-serif;
        color: white;
        font-size: 25px;
        position: relative;
        top: 50px;
        padding-left: 20px;
        padding-right: 20px;
    }
    .text-sarpras2 .isi{
        font-family:'montserrat', sans-serif;
        color: white;
        font-size: 16px;
        position: relative;
        top: 50px;
        padding-left: 20px;
        padding-right: 20px;
    }
    .grup.sarpras{
        margin-bottom: 30%;
    }
    .fotosarpras img{
        border-radius: 20px;
    }
</style>
<body>
    <div class="hero-image-container" id="hero" style= "animation: fadeIn 1.5s ease-in-out;">
        <img src="image/hero-sarpras.png" class="img-fluid w-100">
    </div>

    <h1 class="sarpras-title">
        Sarana & Prasarana
    </h1>
    <hr class="garis-bawah">

    <div class="kotak-icon">
    <div class="kotak">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 14 14"><path fill="currentColor" fill-rule="evenodd" d="M7 .05a.75.75 0 0 0-.75.75v2.305L2.963 5.27a.5.5 0 0 0-.204.561l.001.002h8.644v-.002a.5.5 0 0 0-.203-.561L7.75 2.997V1.551h.621a.75.75 0 0 0 0-1.5zm6.242 8.51h-.196v3.934h.196a.75.75 0 0 1 0 1.5H.922a.75.75 0 0 1 0-1.5h.196V8.559H.922a.75.75 0 1 1 0-1.5h12.32a.75.75 0 0 1 0 1.5Zm-2.106 0h-1.25v3.934h1.25V8.559Zm-7.022 0h-1.25v3.934h1.25V8.559Zm3.843 3.934v-2.11a.93.93 0 1 0-1.862 0v2.11z" clip-rule="evenodd"/></svg>
        
    </div>
    <div class="kotak">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512"><path fill="currentColor" d="M169 57v430h78V57zM25 105v190h46V105zm158 23h18v320h-18zm128.725 7.69l-45.276 8.124l61.825 344.497l45.276-8.124zM89 153v270h62V153zm281.502 28.68l-27.594 11.773l5.494 12.877l27.594-11.773zm12.56 29.433l-27.597 11.772l5.494 12.877l27.593-11.772l-5.492-12.877zm12.555 29.434l-27.594 11.77l99.674 233.628l27.594-11.773zM25 313v30h46v-30zm190 7h18v128h-18zM25 361v126h46V361zm64 80v46h62v-46z"/></svg>
        
    </div>
    <div class="kotak">
       
        <svg xmlns="http://www.w3.org/2000/svg" width="0.96em" height="1em" viewBox="0 0 23 24"><path fill="currentColor" d="M22.171 19.68L14.819 8.369V2.962h1.708V0H6.098v2.965H7.82v5.407L.454 19.68A2.792 2.792 0 0 0 2.791 24h17.034a2.8 2.8 0 0 0 2.34-4.331l.007.011zm-.905 2.302a1.63 1.63 0 0 1-1.434.854H2.791a1.635 1.635 0 0 1-1.37-2.531l-.004.006l7.549-11.6V2.96h4.686v5.754l7.541 11.6c.17.251.272.561.272.895c0 .285-.074.553-.204.785l.004-.008z"/><path fill="currentColor" d="M14.412 12.351H8.221l-5.655 8.698a.29.29 0 0 0-.012.299l-.001-.001c.05.087.142.145.248.146h17.032a.28.28 0 0 0 .247-.145l.001-.001a.28.28 0 0 0-.013-.298l.001.001z"/></svg>
        
    </div>
    <div class="kotak">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6.95 8.05q-.525 0-.737-.213T6 7.1q0-1 .475-1.85t1.275-1.4L12 1l4.25 2.85q.8.55 1.275 1.4T18 7.1q0 .525-.213.738t-.737.212zM1 21V8.725Q.55 8.45.275 8.013T0 7t.6-1.4T2 4q.8.775 1.4 1.6T4 7t-.275 1.013T3 8.724V13h2v-2q0-.625.4-1.2t1.15-.75h10.9q.75.175 1.15.75T19 11v2h2V8.725q-.45-.275-.725-.712T20 7t.6-1.4T22 4q.8.775 1.4 1.6T24 7t-.275 1.013t-.725.712V21h-9v-4q0-.825-.587-1.412T12 15t-1.412.588T10 17v4z"/></svg>
        
    </div>
    <div class="kotak">
       
        <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1em" viewBox="0 0 640 512"><path fill="currentColor" d="M384 96v224H64V96zM64 32C28.7 32 0 60.7 0 96v224c0 35.3 28.7 64 64 64h117.3l-10.7 32H96c-17.7 0-32 14.3-32 32s14.3 32 32 32h256c17.7 0 32-14.3 32-32s-14.3-32-32-32h-74.7l-10.7-32H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm464 0c-26.5 0-48 21.5-48 48v352c0 26.5 21.5 48 48 48h64c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm16 64h32c8.8 0 16 7.2 16 16s-7.2 16-16 16h-32c-8.8 0-16-7.2-16-16s7.2-16 16-16m-16 80c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16s-7.2 16-16 16h-32c-8.8 0-16-7.2-16-16m32 160a32 32 0 1 1 0 64a32 32 0 1 1 0-64"/></svg>
        </a>
    </div>
    <div class="kotak">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M4 4c-1.11 0-2 .89-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 2h7v2.13c-1.76.46-3 2.05-3 3.87a4.01 4.01 0 0 0 3 3.87V18H4v-2h3V8H4zm9 0h7v2h-3v8h3v2h-7v-2.13c1.76-.46 3-2.05 3-3.87a4.01 4.01 0 0 0-3-3.87zm-9 4h1v4H4zm15 0h1v4h-1zm-6 .27c.62.36 1 1.02 1 1.73s-.38 1.37-1 1.73zm-2 0v3.46c-.62-.36-1-1.02-1-1.73s.38-1.37 1-1.73"/></svg>
     
    </div>
    </div>

    <div class="container">
    <div class="row justify-content-center">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <?php if ($row['style'] == 1) : ?>
                <!-- Gambar Kiri -->
                <div class="col-md-5 mb-5 fotosarpras">
                    <img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama']; ?>" class="img-fluid" style="animation: fadeIn 1.5s ease-in-out;">
                </div>
                <div class="col-md-6 mb-5 text-sarpras1">
                    <p class="judulsarpras"><strong><?php echo $row['nama']; ?></strong></p>
                    <p class="isi"><?php echo $row['deskripsi']; ?></p>
                </div>
            <?php else : ?>
                <!-- Gambar Kanan -->
                <div class="col-md-6 mb-5 text-sarpras2">
                    <p class="judulsarpras"><strong><?php echo $row['nama']; ?></strong></p>
                    <p class="isi"><?php echo $row['deskripsi']; ?></p>
                </div>
                <div class="col-md-5 mb-5 fotosarpras">
                    <img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama']; ?>" class="img-fluid" style="animation: fadeIn 1.5s ease-in-out;">
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</div>