<?php
// views/dashboard.php

// Proteksi halaman dashboard
if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}

// Database class sudah di-load dari index.php root
$db = new Database();

// Total barang
$q_total = $db->query("SELECT COUNT(*) AS total FROM data_barang");
$total_barang = $q_total ? ($q_total->fetch_assoc()['total'] ?? 0) : 0;

// Total stok
$q_stok = $db->query("SELECT SUM(stok) AS total_stok FROM data_barang");
$total_stok = $q_stok ? ($q_stok->fetch_assoc()['total_stok'] ?? 0) : 0;

// Total kategori
$q_kategori = $db->query("SELECT COUNT(DISTINCT kategori) AS kategori FROM data_barang");
$total_kategori = $q_kategori ? ($q_kategori->fetch_assoc()['kategori'] ?? 0) : 0;
?>

<!-- CSS jangan ditaruh di sini jika sudah ada di views/header.php.
     Jika Anda tetap ingin khusus dashboard, pakai BASE_URL agar tidak salah path -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">

<div class="dashboard-container">

    <h2>Dashboard</h2>
    <p class="subtitle">Ringkasan data barang pada sistem</p>

    <div class="card-wrapper">

        <div class="card blue">
            <h3><?= htmlspecialchars((string)$total_barang) ?></h3>
            <p>Total Barang</p>
        </div>

        <div class="card green">
            <h3><?= htmlspecialchars((string)$total_stok) ?></h3>
            <p>Total Stok Barang</p>
        </div>

        <div class="card orange">
            <h3><?= htmlspecialchars((string)$total_kategori) ?></h3>
            <p>Jenis Kategori</p>
        </div>

    </div>

    <div class="welcome-box">
        <h3>Selamat Datang!</h3>
        <p>
            Aplikasi ini digunakan untuk mengelola data barang, seperti menambah,
            mengedit, dan menghapus data.
        </p>

        <!-- FULL REWRITE: menuju module user index -->
        <a href="<?= BASE_URL ?>/user/index" class="btn-primary">
            Lihat Data Barang
        </a>
    </div>

</div>
