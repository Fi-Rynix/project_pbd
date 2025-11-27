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
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 24px;
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
      min-width: 100px;
    }

    .info-row span:last-child {
      color: #555;
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }

    .status-badge {
      display: inline-block;
      font-size: 13px;
      font-weight: 500;
      color: #1436a3;
    }

    .badge-gray {
      color: #7f8c8d;
    }

    .badge-yellow {
      color: #d68910;
    }

    .badge-green {
      color: #16a085;
    }

    .badge-red {
      color: #c0392b;
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

    th:first-child {
      text-align: center;
    }

    td {
      padding: 12px 16px;
      border-bottom: 1px solid #f0f2f5;
      text-align: center;
      font-size: 14px;
    }

    td:first-child {
      text-align: center;
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

    tfoot td:last-child {
      text-align: right;
    }

    tfoot tr:last-child td {
      border-bottom: none;
      color: #1436a3;
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
      <a href="pengadaan.php" class="btn">← Kembali</a>
    </div>

    <h1>Detail Pengadaan #<?= htmlspecialchars($info['nomor_pengadaan']) ?></h1>

    <div class="info-box">
      <div class="info-row">
        <span>Tanggal:</span>
        <span><?= htmlspecialchars($info['waktu_pengadaan']) ?></span>
      </div>
      <div class="info-row">
        <span>Vendor:</span>
        <span><?= htmlspecialchars($info['nama_vendor']) ?></span>
      </div>
      <div class="info-row">
        <span>User:</span>
        <span><?= htmlspecialchars($info['nama_user']) ?></span>
      </div>
      <div class="info-row">
        <span>Status:</span>
        <span>
          <?php
          $statusClass = '';
          $statusText = '';
          switch ($info['status_pengadaan']) {
            case 'M': $statusClass = 'badge-gray'; $statusText = 'Memesan'; break;
            case 'P': $statusClass = 'badge-yellow'; $statusText = 'Proses'; break;
            case 'S': $statusClass = 'badge-green'; $statusText = 'Selesai'; break;
            case 'B': $statusClass = 'badge-red'; $statusText = 'Batal'; break;
            default: $statusText = htmlspecialchars($info['status_pengadaan']);
          }
          ?>
          <span class="status-badge <?= $statusClass; ?>"><?= $statusText; ?></span>
        </span>
      </div>
    </div>

    <h2>Daftar Barang</h2>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Jenis</th>
          <th>Harga</th>
          <th>Satuan</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($detail_pengadaan as $i => $row): ?>
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
          <td>Rp<?= number_format($info['subtotal_pengadaan'], 0, ',', '.') ?></td>
        </tr>
        <tr>
          <td colspan="6">PPN (<?= htmlspecialchars($info['ppn_pengadaan']) ?>%):</td>
          <td>Rp<?= number_format(($info['subtotal_pengadaan'] * $info['ppn_pengadaan'] / 100), 0, ',', '.') ?></td>
        </tr>
        <tr>
          <td colspan="6">Total:</td>
          <td>Rp<?= number_format($info['total_pengadaan'], 0, ',', '.') ?></td>
        </tr>
      </tfoot>
    </table>
  </div>
</body>
</html>