<?php
session_start();

// Hapus semua data session
session_unset();

// Hancurkan session
session_destroy();

// Hancurkan cookie session jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Tambahkan header untuk mencegah caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect ke login dengan tambahan random string untuk mencegah cache
header("Location: login.php?logout=".rand(1000,9999));
exit();
?>