<?php
if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}

$db = new Database();

$id = $_GET['id'] ?? '';
if ($id === '' || !ctype_digit($id)) {
    header("Location: " . BASE_URL . "/user/index");
    exit;
}

$idEsc = $db->escape($id);

// Ambil gambar untuk dihapus dari folder
$res = $db->query("SELECT gambar FROM data_barang WHERE id_barang='$idEsc' LIMIT 1");
$row = $res ? $res->fetch_assoc() : null;

$db->query("DELETE FROM data_barang WHERE id_barang='$idEsc'");

// Hapus file gambar jika ada
$gambar = $row['gambar'] ?? '';
if (!empty($gambar)) {
    $path = __DIR__ . '/../../assets/gambar/' . $gambar;
    if (is_file($path)) @unlink($path);
}

header("Location: " . BASE_URL . "/user/index");
exit;
