<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASE_URL', 'http://localhost/lab12');

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/core/Database.php';

/**
 * Ambil path dari rewrite (PATH_INFO) atau fallback dari REQUEST_URI.
 * Dengan .htaccess RewriteRule ^(.+)$ index.php/$1 [L]
 * maka PATH_INFO biasanya terisi.
 */
$path = $_SERVER['PATH_INFO'] ?? '';
$path = trim($path, '/');

if ($path === '') {
    // Default halaman ketika akses /lab12
    $path = isset($_SESSION['login']) ? 'dashboard' : 'auth/login';
}

$segments = explode('/', $path);
$folder   = $segments[0] ?? 'dashboard';
$file     = $segments[1] ?? 'index';

// White-list folder yang boleh diakses (lebih aman)
$allowedFolders = ['auth', 'user', 'dashboard'];
if (!in_array($folder, $allowedFolders, true)) {
    http_response_code(404);
    echo "404 - Page not found";
    exit;
}

// Tentukan target file
if ($folder === 'dashboard') {
    $target = __DIR__ . '/views/dashboard.php';
} else {
    $target = __DIR__ . "/modules/{$folder}/{$file}.php";
}

// Jika file tidak ada → 404
if (!file_exists($target)) {
    http_response_code(404);
    echo "404 - Page not found";
    exit;
}

// Halaman yang boleh diakses tanpa login
$isPublic = ($folder === 'auth' && in_array($file, ['login'], true));

// Proteksi: selain public, wajib login
if (!$isPublic && !isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}

/**
 * Render:
 * - login: biasanya tanpa header/footer (opsional)
 * - lainnya: pakai layout header/footer
 */
if ($folder === 'auth' && $file === 'login') {
    include $target;
    exit;
}

include __DIR__ . '/views/header.php';
include $target;
include __DIR__ . '/views/footer.php';
