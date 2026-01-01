<?php
// modules/user/index.php

if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}

$db = new Database();
$result = $db->query("SELECT * FROM data_barang");
?>

<div class="container">
  <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">

    <!-- KIRI: Judul -->
    <h1>Data Barang</h1>

    <!-- KANAN: Tombol Navigasi -->
    <div style="display:flex;gap:10px;">
        <a class="btn" href="<?= BASE_URL ?>/">⬅ Dashboard</a>
        <a class="btn add" href="<?= BASE_URL ?>/user/add">+ Tambah Barang</a>
    </div>

  </div>

  <div class="main">
    <table>
      <tr>
        <th>Gambar</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Harga Jual</th>
        <th>Harga Beli</th>
        <th>Stok</th>
        <th>Aksi</th>
      </tr>

      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td>
              <?php if (!empty($row['gambar'])): ?>
                <img
                  src="<?= BASE_URL ?>/assets/gambar/<?= htmlspecialchars($row['gambar']); ?>"
                  alt="<?= htmlspecialchars($row['nama']); ?>"
                  width="80"
                >
              <?php else: ?>
                <span>-</span>
              <?php endif; ?>
            </td>

            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= htmlspecialchars($row['kategori']); ?></td>
            <td><?= htmlspecialchars($row['harga_jual']); ?></td>
            <td><?= htmlspecialchars($row['harga_beli']); ?></td>
            <td><?= htmlspecialchars($row['stok']); ?></td>

            <td>
              <a class="btn edit" href="<?= BASE_URL ?>/user/edit?id=<?= urlencode($row['id_barang']); ?>">
                Edit
              </a>
              <a class="btn delete"
                  href="<?= BASE_URL ?>/user/delete?id=<?= urlencode($row['id_barang']); ?>"
                  onclick="return confirm('Hapus data?')">
                Hapus
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="7">Belum ada data</td>
        </tr>
      <?php endif; ?>
    </table>
  </div>
</div>
