<?php
include '../../koneksi.php';
include '../../query.php';

if (isset($_GET['ubah_status'])) {
    $idmargin = intval($_GET['ubah_status']);
    Query::aktifkan_margin($conn, $idmargin);

    header("Location: margin.php?view=" . ($_GET['view'] ?? 'all'));
    exit;
}

$jenis_view = ['all', 'aktif'];
$view = isset($_GET['view']) && in_array($_GET['view'], $jenis_view) ? $_GET['view'] : 'all';

$margin_list = ($view === 'aktif') ? Query::read_margin_aktif($conn) : Query::read_margin_all($conn);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Data Margin Penjualan</title>
<style>
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
  th { background-color: #f2f2f2; }
  .view-controls { margin: 12px 0; display: flex; align-items: center; gap: 8px; }
  .view-controls select { padding: 6px 8px; border-radius: 4px; border: 1px solid #ccc; }
  .btn { padding: 4px 8px; border-radius: 4px; color: white; text-decoration: none; }
  .btn-active { background-color: green; pointer-events: none; }
  .btn-inactive { background-color: red; }
</style>
</head>
<body>
<?php include '../Navbar/navbar.php'; ?>
<h1>Tabel Margin Penjualan</h1>
<a href="tambah_margin.php">Tambah Margin</a>

<div class="view-controls">
  <form method="get" id="viewForm">
    <label for="view">Tampilkan: </label>
    <select name="view" id="view" onchange="document.getElementById('viewForm').submit();">
      <option value="all" <?= ($view === 'all') ? 'selected' : ''; ?>>Semua Margin</option>
      <option value="aktif" <?= ($view === 'aktif') ? 'selected' : ''; ?>>Margin Aktif</option>
    </select>
  </form>
</div>

<main>
<table>
  <thead>
    <tr>
      <th>ID Margin</th>
      <th>Dibuat Pada</th>
      <th>Besaran Persen</th>
      <th>Dibuat Oleh</th>
      <th>Diperbarui Pada</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($margin_list as $row): 
        $status = $row['status_margin'];
        $btn_class = $status ? 'btn-active' : 'btn-inactive';
        $btn_text = $status ? 'Aktif' : 'Nonaktif';
    ?>
    <tr>
      <td><?= $row['nomor_margin']; ?></td>
      <td><?= $row['dibuat_pada']; ?></td>
      <td><?= $row['persentase_margin']; ?></td>
      <td><?= $row['dibuat_oleh']; ?></td>
      <td><?= $row['diupdate_pada']; ?></td>
      <td>
        <?php if ($status): ?>
          <span class="btn <?= $btn_class ?>"><?= $btn_text ?></span>
        <?php else: ?>
          <a href="?ubah_status=<?= $row['nomor_margin']; ?>&view=<?= $view; ?>" class="btn <?= $btn_class ?>">
            <?= $btn_text ?>
          </a>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</main>
</body>
</html>
