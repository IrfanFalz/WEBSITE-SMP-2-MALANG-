<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    
    // Cek apakah username atau email sudah ada
    $check = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Username atau Email sudah digunakan!');</script>";
    } else {
        $query = "INSERT INTO admin (username, email, password, nama_lengkap) VALUES ('$username', '$email', '$password', '$nama_lengkap')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        input, button {
            width: 90%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registrasi Admin</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required><br>
            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
