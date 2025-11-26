<?php
  include '../../koneksi.php';
  include '../../query.php';

  $idpenjualan = $_GET['nomor_penjualan'];

  $detail_penjualan = Query::read_detail_penjualan($conn, $idpenjualan);

  // Ambil info umum (baris pertama)
  $info = $detail_penjualan[0];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Penjualan #<?= htmlspecialchars($info['nomor_penjualan']) ?></title>
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

  <button><a href="penjualan.php">Kembali</a></button>
  <br>

  <h1>Detail Penjualan #<?= htmlspecialchars($info['nomor_penjualan']) ?></h1>

  <div class="info-box">
    <div class="info-row"><span><b>Tanggal:</b></span> <span><?= htmlspecialchars($info['waktu_penjualan']) ?></span></div>
    <div class="info-row"><span><b>User:</b></span> <span><?= htmlspecialchars($info['nama_user']) ?></span></div>
    <div class="info-row"><span><b>Margin Keuntungan:</b></span> <span><?= htmlspecialchars($info['persentase_margin']) ?></span></div>
  </div>

  <h2>Daftar Barang</h2>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jenis</th>
        <th>Harga Satuan (Include Margin)</th>
        <th>Satuan</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($detail_penjualan as $i => $row): ?>
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
        <td>Rp<?= number_format($info['subtotal_penjualan'], 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right;">PPN:</td>
        <td>Rp<?= number_format($info['ppn_penjualan'], 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right;">Total:</td>
        <td>Rp<?= number_format($info['total_penjualan'], 0, ',', '.') ?></td>
      </tr>
    </tfoot>
  </table>

</body>
</html>
