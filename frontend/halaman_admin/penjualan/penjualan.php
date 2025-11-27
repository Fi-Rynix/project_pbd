<?php
  include '../../../koneksi.php';
  include '../../../query.php';

  $penjualan_list = Query::read_penjualan($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Penjualan</title>
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
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 14px;
        border-radius: 4px;
        display: inline-block;
        transition: all 0.2s ease;
        background-color: #1436a3;
        border: none;
        cursor: pointer;
        font-size: 13px;
      }

      a:hover {
        background-color: #0d2a7a;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(20, 54, 163, 0.2);
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

      td:nth-child(5),
      td:nth-child(6),
      td:nth-child(7) {
        text-align: right;
        font-variant-numeric: tabular-nums;
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
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <div class="container">
      <h1>Tabel Penjualan</h1>
      <div class="button-group">
        <a href="insert_penjualan.php" class="btn">+ Tambah Penjualan</a>
      </div>
      <table>
        <thead>
          <tr>
            <th>ID Penjualan</th>
            <th>Waktu Penjualan</th>
            <th>Penanggung Jawab</th>
            <th>Margin Keuntungan</th>
            <th>Subtotal</th>
            <th>PPN</th>
            <th>Total</th>
            <th>Rincian Penjualan</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($penjualan_list as $row){ ?>
            <tr>
              <td><?= htmlspecialchars($row['nomor_penjualan']); ?></td>
              <td><?= htmlspecialchars($row['waktu_penjualan']); ?></td>
              <td><?= htmlspecialchars($row['nama_user']); ?></td>
              <td><?= htmlspecialchars($row['persen_margin']); ?>%</td>
              <td>Rp<?= number_format((double)$row['subtotal_penjualan'], 0, ',', '.') ?></td>
              <td><?= number_format((double)$row['ppn_penjualan'], 0, ',', '.') ?>%</td>
              <td>Rp<?= number_format((double)$row['total_penjualan'], 0, ',', '.') ?></td>
              <td><a href="detail_penjualan.php?nomor_penjualan=<?= htmlspecialchars($row['nomor_penjualan']); ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </body>
</html>