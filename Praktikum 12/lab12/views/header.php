<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Praktikum 11</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">
</head>

<body>
<div class="container">

<header class="header-bar">
    <h1>Manajemen Data Barang</h1>

    <!-- USER INFO -->
    <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
    <div class="user-info">
        👤 <?= htmlspecialchars($_SESSION['username']) ?>
    </div>
<?php endif; ?>
</header>

<nav>
    <a href="<?= BASE_URL ?>/dashboard">Dashboard</a>
    <a href="<?= BASE_URL ?>/user/index">Data Barang</a>
    <a href="<?= BASE_URL ?>/user/add">Tambah Barang</a>
    <a href="<?= BASE_URL ?>/user/profile">Profil</a>
    <a href="<?= BASE_URL ?>/auth/logout">Logout</a>
</nav>

<div class="content">
