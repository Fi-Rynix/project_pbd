<?php
  include '../../koneksi.php';
  include '../../query.php';

  $penjualan_list = Query::read_penjualan($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Penjualan</title>
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
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Tabel Penjualan</h1>
    <main>
      <button><a href="insert_penjualan.php">Tambah Penjualan</a></button>
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
              <td><?= htmlspecialchars($row['persen_margin']); ?></td>
              <td>Rp.<?= number_format((double)$row['subtotal_penjualan'], 2, ',', '.') ?></td>
              <td><?= htmlspecialchars($row['ppn_penjualan']); ?></td>
              <td>Rp.<?= number_format((double)$row['total_penjualan'], 2, ',', '.') ?></td>
              <td><a href="detail_penjualan.php?nomor_penjualan=<?= htmlspecialchars($row['nomor_penjualan']); ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>