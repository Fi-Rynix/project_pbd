<?php
  include '../../koneksi.php';
  include '../../query.php';

  $idpengadaan = $_GET['nomor_pengadaan'];

  $detail_pengadaan = Query::read_detail_pengadaan($conn, $idpengadaan);

  $info = $detail_pengadaan[0];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Pengadaan #<?= htmlspecialchars($info['nomor_pengadaan']) ?></title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 32px;
      color: #333;
    }
    h1, h2 {
      margin-bottom: 0.3em;
    }
    .info-box {
      border: 1px solid #ccc;
      padding: 12px 16px;
      border-radius: 6px;
      margin-bottom: 24px;
      background-color: #f9f9f9;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 6px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 16px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px 10px;
      text-align: left;
    }
    th {
      background-color: #efefef;
    }
    tfoot td {
      font-weight: bold;
      background-color: #fafafa;
    }
  </style>
</head>
<body>
  <?php include '../Navbar/navbar.php'; ?>
  <button><a href="pengadaan.php">Kembali</a></button>
  <br>
  <h1>Detail Pengadaan #<?= htmlspecialchars($info['nomor_pengadaan']) ?></h1>

  <div class="info-box">
    <div class="info-row"><span><b>Tanggal:</b></span> <span><?= htmlspecialchars($info['waktu_pengadaan']) ?></span></div>
    <div class="info-row"><span><b>Vendor:</b></span> <span><?= htmlspecialchars($info['nama_vendor']) ?></span></div>
    <div class="info-row"><span><b>User:</b></span> <span><?= htmlspecialchars($info['nama_user']) ?></span></div>
    <div class="info-row"><span><b>Status:</b></span> <span><?= htmlspecialchars($info['status_pengadaan']) ?></span></div>
  </div>

  <h2>Daftar Barang</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jenis</th>
        <th>Harga</th>
        <th>Per-Satuan</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($detail_pengadaan as $i => $row): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['jenis']) ?></td>
          <td>Rp<?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
          <td><?= htmlspecialchars($row['nama_satuan']) ?></td>
          <td><?= htmlspecialchars($row['jumlah']) ?></td>
          <td>Rp<?= number_format($row['sub_total'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6" style="text-align:right;">Subtotal:</td>
        <td>Rp<?= number_format($info['subtotal_pengadaan'], 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right;">PPN (<?= htmlspecialchars($info['ppn_pengadaan']) ?>%):</td>
        <td>Rp<?= number_format(($info['subtotal_pengadaan'] * $info['ppn_pengadaan'] / 100), 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right;">Total:</td>
        <td>Rp<?= number_format($info['total_pengadaan'], 0, ',', '.') ?></td>
      </tr>
    </tfoot>
  </table>
</body>
</html>