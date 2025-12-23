<?php
session_start();

$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($baseUrl === '') $baseUrl = '/';
define('BASE_URL', $baseUrl);

// Load config + core class
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/core/Database.php';

// Ambil path hasil rewrite dari .htaccess
$path = $_SERVER['PATH_INFO'] ?? '/dashboard/index';
$path = trim($path, '/');

$segments = $path === '' ? [] : explode('/', $path);

// Tentukan module & page (default dashboard/index)
$folder = $segments[0] ?? 'dashboard';
$file   = $segments[1] ?? 'index';

// Sanitasi sederhana (hindari ../ dll)
$folder = preg_replace('/[^a-zA-Z0-9_-]/', '', $folder);
$file   = preg_replace('/[^a-zA-Z0-9_-]/', '', $file);

// Target file modul
$target = __DIR__ . "/modules/$folder/$file.php";

// AUTH GUARD
$publicRoutes = [
    'auth/login',
    'auth/logout',          // <-- tambahkan jika file logout.php ada
    'auth/logout_process'   // <-- jika Anda memang pakai ini
];

$currentRoute = $folder . '/' . $file;

if (!isset($_SESSION['login']) && !in_array($currentRoute, $publicRoutes, true)) {
    header("Location: " . BASE_URL . "/auth/login"); // <-- FIX: pakai BASE_URL
    exit;
}

// SPECIAL CASE: DASHBOARD
if ($folder === 'dashboard') {
    include __DIR__ . '/views/header.php';
    include __DIR__ . '/views/dashboard.php';
    include __DIR__ . '/views/footer.php';
    exit;
}

// LOGIN PAGE TANPA TEMPLATE
if ($currentRoute === 'auth/login') {
    if (file_exists($target)) {
        include $target;
    } else {
        http_response_code(404);
        echo "<h2>Halaman login tidak ditemukan</h2>";
    }
    exit;
}

// NORMAL PAGE (pakai template)
include __DIR__ . '/views/header.php';

if (file_exists($target)) {
    include $target;
} else {
    http_response_code(404);
    echo "<h2>Halaman tidak ditemukan</h2>";
    echo "<p>Target: <code>modules/$folder/$file.php</code></p>";
}

include __DIR__ . '/views/footer.php';
