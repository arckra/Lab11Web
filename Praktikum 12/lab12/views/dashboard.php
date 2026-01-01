<?php
// views/dashboard.php

// Proteksi halaman (login sudah dibuat di Praktikum 11)
if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}

// Database class sudah di-load dari index.php (Front Controller)
$db = new Database();

// Total barang
$q_total = $db->query("SELECT COUNT(*) AS total FROM data_barang");
$total_barang = $q_total ? (int)$q_total->fetch_assoc()['total'] : 0;

// Total stok
$q_stok = $db->query("SELECT SUM(stok) AS total_stok FROM data_barang");
$total_stok = $q_stok ? (int)$q_stok->fetch_assoc()['total_stok'] : 0;

// Total kategori
$q_kategori = $db->query("SELECT COUNT(DISTINCT kategori) AS total_kategori FROM data_barang");
$total_kategori = $q_kategori ? (int)$q_kategori->fetch_assoc()['total_kategori'] : 0;
?>

<div class="dashboard-container">

    <h2>Dashboard</h2>
    <p class="subtitle">Ringkasan data barang pada sistem</p>

    <div class="card-wrapper">

        <div class="card blue">
            <h3><?= $total_barang ?></h3>
            <p>Total Barang</p>
        </div>

        <div class="card green">
            <h3><?= $total_stok ?></h3>
            <p>Total Stok Barang</p>
        </div>

        <div class="card orange">
            <h3><?= $total_kategori ?></h3>
            <p>Jenis Kategori</p>
        </div>

    </div>

    <div class="welcome-box">
        <h3>Selamat Datang!</h3>
        <p>
            Aplikasi ini digunakan untuk mengelola data barang,
            seperti menambah, mengedit, dan menghapus data.
        </p>

        <!-- Routing FULL REWRITE -->
        <a href="<?= BASE_URL ?>/user/index" class="btn-primary">
            Lihat Data Barang
        </a>
    </div>

</div>
