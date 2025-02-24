<?php
include 'config.php'; // Pastikan file ini berisi koneksi ke database

// Cek apakah superadmin sudah ada
$checkSuperadmin = mysqli_query($conn, "SELECT * FROM admin WHERE role='superadmin'");
if (mysqli_num_rows($checkSuperadmin) == 0) {
    // Buat password yang terenkripsi
    $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);

    // Masukkan superadmin ke database
    $query = "INSERT INTO admin (username, password, email, role) 
              VALUES ('superadmin', '$hashed_password', 'superadmin@example.com', 'superadmin')";

    if (mysqli_query($conn, $query)) {
        echo "Superadmin berhasil dibuat! <br>";
        echo "Username: superadmin <br>";
        echo "Password: admin123 <br>";
    } else {
        echo "Gagal membuat superadmin: " . mysqli_error($conn);
    }
} else {
    echo "Superadmin sudah ada!";
}
?>
