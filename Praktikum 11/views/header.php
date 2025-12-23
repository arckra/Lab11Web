<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Praktikum 11</title>

    <!-- CSS pakai BASE_URL agar aman di semua route -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">
</head>

<body>
<div class="container">

<header>
    <h1>Manajemen Data Barang</h1>
</header>

<nav>
    <!-- FULL REWRITE LINKS -->
    <a href="<?= BASE_URL ?>/">Dashboard</a>
    <a href="<?= BASE_URL ?>/user/index">Data Barang</a>
    <a href="<?= BASE_URL ?>/user/add">Tambah Barang</a>
    <a href="<?= BASE_URL ?>/auth/logout">Logout</a>
</nav>

<div class="content">
