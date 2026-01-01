<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../../core/Database.php";

if (!isset($_SESSION['login'], $_SESSION['user_id'])) {
    echo "User tidak ditemukan.";
    exit;
}

$user_id = (int) $_SESSION['user_id'];

$db = new Database();
$result = $db->query("SELECT * FROM users WHERE id_user = $user_id");

if (!$result || $result->num_rows === 0) {
    echo "User tidak ditemukan di database.";
    exit;
}

$users = $result->fetch_assoc();

// Ganti password
if (isset($_POST['change_password'])) {
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    if ($old !== $users['password']) {
        die("Password lama salah.");
    }

    if (strlen($new) < 6) {
        die("Password baru minimal 6 karakter.");
    }

    if ($db->query("UPDATE users SET password='$new' WHERE id_user=$user_id")) {
        echo "Password berhasil diubah.";
    } else {
        echo "Gagal mengubah password.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Profil Saya</h2>

    <p><strong>Username:</strong> <?= htmlspecialchars($users['username']) ?></p>

    <form method="POST">
        <h3>Ganti Password</h3>

        <label>Password Lama</label>
        <input type="password" name="old_password" required>

        <label>Password Baru</label>
        <input type="password" name="new_password" required>

        <button type="submit" name="change_password">Ubah Password</button>
    </form>
</div>
</body>
</html>
