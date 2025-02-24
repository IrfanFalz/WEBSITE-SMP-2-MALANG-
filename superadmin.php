<?php
include 'config.php';

$result = mysqli_query($conn, "SELECT * FROM admin WHERE username='superadmin'");
if ($row = mysqli_fetch_assoc($result)) {
    if (!$row['role']) {
        mysqli_query($conn, "UPDATE admin SET role='superadmin' WHERE username='superadmin'");
        echo "Role superadmin berhasil diperbaiki!";
    } else {
        echo "Superadmin sudah memiliki role!";
    }
} else {
    $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO admin (username, password, role) VALUES ('superadmin', '$hashed_password', 'superadmin')");
    echo "Superadmin berhasil dibuat!";
}
?>
