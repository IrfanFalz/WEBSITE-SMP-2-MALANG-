<?php
session_start();

// Tambahkan header untuk mencegah caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'config.php';

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['admin']) && isset($_SESSION['admin']['id'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) {
            // Buat session baru dengan semua data yang diperlukan
            $_SESSION['admin'] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'role' => $row['role'],
                'nama_lengkap' => $row['nama_lengkap'],
                'foto' => !empty($row['foto']) ? $row['foto'] : 'default-profile.png'
            ];
            
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Username atau Password salah!";
        }
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #3a54ab;
            --secondary-color: #f8f9fc;
            --text-color: #5a5c69;
            --success-color: #1cc88a;
            --error-color: #e74a3b;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Nunito', 'Segoe UI', Roboto, Arial, sans-serif;
            background: linear-gradient(120deg, #e2e9f0, #c3cfe2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text-color);
        }
        
        .login-container {
            display: flex;
            border-radius: 12px;
            overflow: hidden;
            width: 85%;
            max-width: 900px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            background: white;
            height: 550px;
        }
        
        .banner {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-dark));
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .banner::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            top: -50%;
            left: -50%;
            transform: rotate(30deg);
        }
        
        .banner h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        
        .banner p {
            text-align: center;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }
        
        .banner-icon {
            font-size: 80px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }
        
        .form-container {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            font-size: 26px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #858796;
            font-size: 14px;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #d1d3e2;
        }
        
        .form-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1px solid #d1d3e2;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .form-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            outline: none;
        }
        
        .submit-btn {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .error {
            background-color: rgba(231, 74, 59, 0.1);
            color: var(--error-color);
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
            border-left: 4px solid var(--error-color);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #b7b9cc;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #eaecf4;
        }
        
        .divider span {
            padding: 0 10px;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #858796;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
                width: 90%;
            }
            
            .banner {
                padding: 30px 20px;
            }
            
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
    <script>
        // Prevent going back to dashboard with back button after logout
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });
    </script>
</head>
<body>
    <div class="login-container">
        <div class="banner">
            <div class="banner-icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <h1>Admin login</h1>
            <p>Selamat datang di panel admin. Silahkan masuk untuk mengelola sistem.</p>
        </div>
        
        <div class="form-container">
            <div class="login-header">
                <h2>Login Admin</h2>
                <p>Masukkan username dan password untuk mengakses dashboard</p>
            </div>
            
            <?php if (isset($error)) { echo "<div class='error'><i class='fas fa-exclamation-circle'></i> $error</div>"; } ?>
            
            <form method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" class="form-input" placeholder="Username" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            

            
            <div class="footer">
                &copy; <?php echo date('Y'); ?> Admin System | All Rights Reserved
            </div>
        </div>
    </div>
</body>
</html>