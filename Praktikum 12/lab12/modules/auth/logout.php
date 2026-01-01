<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika klik "Ya, Logout"
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    session_destroy();
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Logout</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">
</head>

<body>

<div class="auth-container" style="text-align:center;">
    <h2>Konfirmasi Logout</h2>

    <p style="margin-top:10px; font-size:16px;">
        Apakah Anda yakin ingin keluar dari aplikasi?
    </p>

    <div style="margin-top:20px; display:flex; gap:10px; justify-content:center;">
        <!-- YA LOGOUT -->
        <a href="<?= BASE_URL ?>/auth/logout?confirm=yes"
            class="auth-btn"
            style="background:#d9534f;">
            Ya, Logout
        </a>

        <!-- BATAL -->
        <a href="<?= BASE_URL ?>/dashboard"
            class="auth-btn"
            style="background:gray;">
            Batal
        </a>
    </div>
</div>

</body>
</html>
