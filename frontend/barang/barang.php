<?php
  include '../../koneksi.php';
  include '../../query.php';

  $jenis_view = ['all', 'aktif'];
  $view = isset($_GET['view']) && in_array($_GET['view'], $jenis_view) ? $_GET['view'] : 'all';

  if ($view === 'aktif') {
    $barang = Query::read_barang_aktif($conn);
  } else {
    $barang = Query::read_barang_all($conn);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
      }
      th {
        background-color: #f2f2f2;
      }
      .view-controls {
        margin: 12px 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .view-controls select {
        padding: 6px 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Tabel Barang</h1>

<a href="tambah_barang.php" 
   style="display:inline-block; padding:8px 12px; background:#4CAF50; 
          color:white; text-decoration:none; border-radius:4px; margin-bottom:10px;">
  + Tambah Barang
</a>

<div class="view-controls">
  <form method="get" id="viewForm">
    <label for="view">Tampilkan: </label>
    <select name="view" id="view" onchange="document.getElementById('viewForm').submit();">
      <option value="all" <?= $view === 'all' ? 'selected' : '' ?>>Semua Barang</option>
      <option value="aktif" <?= $view === 'aktif' ? 'selected' : '' ?>>Barang Aktif</option>
    </select>
  </form>
</div>

<main>
  <table>
    <thead>
      <tr>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Jenis Barang</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Vendor</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($barang as $row): ?>
        <tr>
  <td><?= $row['nomor_barang']; ?></td>
  <td><?= $row['nama_barang']; ?></td>
  <td><?= $row['jenis_barang']; ?></td>
  <td><?= $row['nama_satuan']; ?></td>
  <td><?= $row['harga_barang']; ?></td>
  <td><?= $row['status_barang'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
  <td><?= $row['nama_vendor']; ?></td>
  <td>
  <a href="edit_barang.php?idbarang=<?= $row['nomor_barang']; ?>">Edit</a>
  <?php if ($row['status_barang'] == 1) { ?>
    | <a href="hapus_barang.php?idbarang=<?= $row['nomor_barang']; ?>"
        onclick="return confirm('Yakin hapus barang ini?');">
        Hapus
      </a>
  <?php } ?>
</td>


</tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>