<?php
if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}

$db = new Database();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama       = trim($_POST['nama'] ?? '');
    $kategori   = trim($_POST['kategori'] ?? '');
    $harga_beli = trim($_POST['harga_beli'] ?? '');
    $harga_jual = trim($_POST['harga_jual'] ?? '');
    $stok       = trim($_POST['stok'] ?? '');

    if ($nama === '' || $kategori === '' || $harga_beli === '' || $harga_jual === '' || $stok === '') {
        $error = "Semua field wajib diisi.";
    } elseif (!is_numeric($harga_beli) || !is_numeric($harga_jual) || !is_numeric($stok)) {
        $error = "Harga beli, harga jual, dan stok harus berupa angka.";
    } else {
        // Upload file (opsional)
        $gambarNama = '';

        if (!empty($_FILES['file_gambar']['name'])) { // <-- konsisten dengan name input
            $allowed = ['jpg','jpeg','png','webp'];
            $ext = strtolower(pathinfo($_FILES['file_gambar']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed, true)) {
                $error = "Format gambar harus: jpg/jpeg/png/webp.";
            } elseif ($_FILES['file_gambar']['error'] !== UPLOAD_ERR_OK) {
                $error = "Upload gambar gagal. Error: " . $_FILES['file_gambar']['error'];
            } else {
                $gambarNama = 'barang_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;

                $destDir = __DIR__ . '/../../assets/gambar/';
                if (!is_dir($destDir)) {
                    mkdir($destDir, 0777, true);
                }

                $destPath = $destDir . $gambarNama;
                if (!move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destPath)) {
                    $error = "Gagal menyimpan file gambar.";
                }
            }
        }

        if ($error === '') {
            $namaEsc       = $db->escape($nama);
            $kategoriEsc   = $db->escape($kategori);
            $hargaBeliEsc  = $db->escape($harga_beli);
            $hargaJualEsc  = $db->escape($harga_jual);
            $stokEsc       = $db->escape($stok);
            $gambarEsc     = $db->escape($gambarNama);

            $sql = "INSERT INTO data_barang (nama, kategori, harga_beli, harga_jual, stok, gambar)
                    VALUES ('$namaEsc','$kategoriEsc','$hargaBeliEsc','$hargaJualEsc','$stokEsc','$gambarEsc')";

            if ($db->query($sql)) {
                header("Location: " . BASE_URL . "/user/index");
                exit;
            } else {
                $error = "Gagal menyimpan data ke database.";
            }
        }
    }
}
?>

<h2>Tambah Data Barang</h2>

<?php if ($error): ?>
  <div style="padding:10px;border:1px solid #f5c2c7;background:#f8d7da;color:#842029;margin-bottom:12px;">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="form">
    <label>Nama Barang</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>

    <label>Kategori</label>
    <select name="kategori" required>
        <option value="Komputer">Komputer</option>
        <option value="Elektronik">Elektronik</option>
        <option value="Hand Phone">Hand Phone</option>
    </select>

    <label>Harga Jual</label>
    <input type="number" name="harga_jual" value="<?= htmlspecialchars($_POST['harga_jual'] ?? '') ?>" required>

    <label>Harga Beli</label>
    <input type="number" name="harga_beli" value="<?= htmlspecialchars($_POST['harga_beli'] ?? '') ?>" required>

    <label>Stok</label>
    <input type="number" name="stok" value="<?= htmlspecialchars($_POST['stok'] ?? '') ?>" required>

    <label>Gambar</label>

    <img id="preview-gambar" class="img-preview" style="display:none;">
    <input type="file" name="file_gambar" accept="image/*" onchange="previewGambar(this)">

    <button class="btn add" type="submit">Simpan</button>
    <a class="btn" href="<?= BASE_URL ?>/user/index">Batal</a>
</form>

<script>
function previewGambar(input) {
  const preview = document.getElementById('preview-gambar');
  const file = input.files[0];
  if (file) {
    preview.src = URL.createObjectURL(file);
    preview.style.display = "block";
  }
}
</script>
