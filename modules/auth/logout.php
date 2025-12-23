<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Logout</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>

<body>

<div class="auth-container" style="text-align:center;">
    <h2>Konfirmasi Logout</h2>

    <p style="margin-top:10px; font-size:16px;">
        Apakah Anda yakin ingin keluar dari aplikasi?
    </p>

    <div style="margin-top:20px; display:flex; gap:10px; justify-content:center;">
        <a href="index.php?page=auth/logout_process" class="auth-btn" style="background:#d9534f;">
            Ya, Logout
        </a>

        <a href="index.php?page=dashboard" class="auth-btn" style="background:gray;">
            Batal
        </a>
    </div>
</div>

</body>
</html>
