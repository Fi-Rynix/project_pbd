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
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        background-color: #f5f7fa;
        color: #2c3e50;
        line-height: 1.6;
        margin: 0;
        padding: 0;
      }

      .container {
        padding: 24px;
        max-width: 100%;
      }

      h1 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 24px;
        color: #1a252f;
      }

      main {
        margin-bottom: 32px;
      }

      .button-group {
        margin-bottom: 16px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }

      button, a.btn {
        background-color: #1436a3;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
      }

      button:hover, a.btn:hover {
        background-color: #0d2a7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 54, 163, 0.2);
      }

      button:active, a.btn:active {
        transform: translateY(0);
      }

      a {
        color: inherit;
        text-decoration: none;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 16px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      }

      thead {
        background: linear-gradient(135deg, #1436a3 0%, #0d2a7a 100%);
        color: white;
      }

      th {
        padding: 14px 12px;
        text-align: center;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
      }

      th:nth-child(1),
      th:nth-child(2),
      th:nth-child(3) {
        text-align: left;
      }

      tbody tr {
        border-bottom: 1px solid #ecf0f1;
        transition: background-color 0.2s ease;
      }

      tbody tr:hover {
        background-color: #f8fafc;
      }

      tbody tr:last-child {
        border-bottom: none;
      }

      td {
        padding: 12px;
        text-align: center;
        border: none;
      }

      td:nth-child(1),
      td:nth-child(2),
      td:nth-child(3) {
        text-align: left;
      }

      a.link-btn {
        display: inline-block;
        background-color: #1436a3;
        color: white;
        font-weight: 600;
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 13px;
        transition: all 0.2s ease;
        margin: 0 4px;
      }

      a.link-btn:hover {
        background-color: #0d2a7a;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(20, 54, 163, 0.2);
      }

      .view-controls {
        margin: 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .view-controls select {
        padding: 10px 12px;
        border: 1px solid #d0d7e0;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
      }

      .view-controls select:focus {
        outline: none;
        border-color: #1436a3;
        box-shadow: 0 0 0 3px rgba(20, 54, 163, 0.1);
      }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }

        h1 {
          font-size: 22px;
          margin-bottom: 16px;
        }

        table {
          font-size: 13px;
        }

        th, td {
          padding: 10px 8px;
        }

        .button-group {
          flex-direction: column;
        }

        button, a.btn {
          width: 100%;
          text-align: center;
        }
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <div class="container">
      <h1>Tabel Barang</h1>

      <div class="button-group">
        <a href="tambah_barang.php" class="btn">+ Tambah Barang</a>
      </div>

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
  <td>Rp<?= number_format($row['harga_barang'], 0, ',', '.'); ?></td>
  <td>
    <?php if ($row['status_barang']): ?>
      <span style="color: #16a085; font-weight: 600;">Aktif</span>
    <?php else: ?>
      <span style="color: #7f8c8d; font-weight: 600;">Tidak Aktif</span>
    <?php endif; ?>
  </td>
  <td><?= $row['nama_vendor']; ?></td>
  <td>
    <a href="edit_barang.php?idbarang=<?= $row['nomor_barang']; ?>" class="link-btn">Edit</a>
    <?php if ($row['status_barang'] == 1): ?>
      <a href="hapus_barang.php?idbarang=<?= $row['nomor_barang']; ?>" class="link-btn" style="background-color: #e74c3c;" onclick="return confirm('Yakin hapus barang ini?');">Hapus</a>
    <?php endif; ?>
  </td>
</tr>
      <?php endforeach; ?>
    </tbody>
  </table>
      </main>
    </div>
  </body>
</html>