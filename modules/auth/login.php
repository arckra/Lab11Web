<?php
require_once "auth.php";

// Jika sudah login
if (isset($_SESSION['login'])) {
    header("Location: /lab11_ari/index.php?page=dashboard");
    exit;
}

$auth = new Auth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">

</head>
<body>

<div class="auth-container">
    <h2>Login</h2>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button name="login" class="auth-btn">Masuk</button>
    </form>
</div>

<script src="../../assets/js/script.js"></script>

<?php
if (isset($_POST['login'])) {

    if ($auth->login($_POST['username'], $_POST['password'])) {

        echo "<script>
            showAlert('Login berhasil', 'success');
            setTimeout(() => {
                window.location='../../index.php?page=dashboard';
            }, 1200);
        </script>";

    } else {
        echo "<script>
            showAlert('Username atau password salah!', 'error');
        </script>";
    }
}
?>

</body>
</html>
