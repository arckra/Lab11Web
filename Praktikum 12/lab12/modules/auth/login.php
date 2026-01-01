<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "auth.php";

$auth = new Auth();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($auth->login($username, $password)) {
        header("Location: " . BASE_URL . "/dashboard");
        exit;
    } else {
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">
</head>
<body>

<div class="auth-container">
    <!-- POPUP ERROR -->
    <?php if (!empty($error)): ?>
        <div class="popup-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <h2>Login</h2>

    <form method="POST" action="<?= BASE_URL ?>/auth/login">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button name="login" class="auth-btn">Masuk</button>
    </form>
</div>

</body>
</html>
