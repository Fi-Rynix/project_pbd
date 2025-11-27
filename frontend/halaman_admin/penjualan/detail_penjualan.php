<?php
  include '../../../koneksi.php';
  include '../../../query.php';

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
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
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
      margin: 24px 0 16px 0;
      color: #1436a3;
    }

    h2 {
      font-size: 18px;
      font-weight: 600;
      margin: 24px 0 16px 0;
      color: #1436a3;
    }

    .button-group {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      padding: 10px 18px;
      font-size: 14px;
      font-weight: 500;
      background-color: #1436a3;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background-color: #0d2a7a;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(20, 54, 163, 0.3);
    }

    .btn:active {
      transform: translateY(0);
    }

    .info-box {
      background-color: white;
      border: 1px solid #e0e6ed;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 24px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 12px;
      padding-bottom: 12px;
      border-bottom: 1px solid #f0f2f5;
    }

    .info-row:last-child {
      margin-bottom: 0;
      padding-bottom: 0;
      border-bottom: none;
    }

    .info-row span:first-child {
      font-weight: 600;
      color: #1436a3;
      min-width: 150px;
    }

    .info-row span:last-child {
      color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      border-radius: 8px;
      overflow: hidden;
      margin-top: 16px;
    }

    thead tr {
      background: linear-gradient(135deg, #1436a3 0%, #0d2a7a 100%);
    }

    th {
      padding: 12px 16px;
      text-align: center;
      color: white;
      font-weight: 600;
      font-size: 14px;
      border: none;
    }

    th:first-child,
    th:nth-child(2),
    th:nth-child(3) {
      text-align: left;
    }

    td {
      padding: 12px 16px;
      border-bottom: 1px solid #f0f2f5;
      text-align: center;
      font-size: 14px;
    }

    td:first-child,
    td:nth-child(2),
    td:nth-child(3) {
      text-align: left;
    }

    tbody tr:hover {
      background-color: #f8fafc;
      transition: background-color 0.2s ease;
    }

    tfoot tr {
      background-color: #f8fafc;
      font-weight: 600;
    }

    tfoot td {
      border-top: 2px solid #1436a3;
      border-bottom: none;
      padding: 12px 16px;
      text-align: right;
      color: #1436a3;
    }

    tfoot tr:last-child td {
      border-bottom: none;
      font-size: 15px;
    }

    @media (max-width: 768px) {
      .container {
        padding: 16px;
      }

      h1 {
        font-size: 22px;
      }

      table {
        font-size: 12px;
      }

      th, td {
        padding: 8px;
      }

      .button-group {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>

  <?php include '../Navbar/navbar.php'; ?>
  <div class="container">
    <div class="button-group">
      <a href="penjualan.php" class="btn">← Kembali</a>
    </div>

    <h1>Detail Penjualan #<?= htmlspecialchars($info['nomor_penjualan']) ?></h1>

    <div class="info-box">
      <div class="info-row"><span>Tanggal:</span> <span><?= htmlspecialchars($info['waktu_penjualan']) ?></span></div>
      <div class="info-row"><span>User:</span> <span><?= htmlspecialchars($info['nama_user']) ?></span></div>
      <div class="info-row"><span>Margin Keuntungan:</span> <span><?= htmlspecialchars($info['persen']) ?>%</span></div>
    </div>

    <h2>Daftar Barang</h2>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Jenis</th>
          <th>Harga Satuan</th>
          <th>Satuan</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detail_penjualan as $i => $row): ?>
          <?php
          $jenisLabel = '';
          switch ($row['jenis']) {
            case 'S': $jenisLabel = 'ATK'; break;
            case 'E': $jenisLabel = 'Elektronik'; break;
            case 'B': $jenisLabel = 'Bahan Bangunan'; break;
            default: $jenisLabel = htmlspecialchars($row['jenis']);
          }
          ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= $jenisLabel ?></td>
            <td>Rp<?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($row['nama_satuan']) ?></td>
            <td><?= htmlspecialchars($row['jumlah']) ?></td>
            <td>Rp<?= number_format($row['sub_total'], 0, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>

      <tfoot>
        <tr>
          <td colspan="6">Subtotal:</td>
          <td>Rp<?= number_format($info['subtotal_penjualan'], 0, ',', '.') ?></td>
        </tr>
        <tr>
          <td colspan="6">PPN:</td>
          <td><?= number_format($info['ppn_penjualan'], 0, ',', '.') ?>%</td>
        </tr>
        <tr>
          <td colspan="6">Total:</td>
          <td>Rp<?= number_format($info['total_penjualan'], 0, ',', '.') ?></td>
        </tr>
      </tfoot>
    </table>
  </div>

</body>
</html>
