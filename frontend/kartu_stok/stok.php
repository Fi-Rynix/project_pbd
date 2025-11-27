<?php
require_once '../../koneksi.php';
require_once '../../query.php';

$data = Query::read_kartu_stok($conn);

// Kelompokkan data berdasarkan barang
$grouped = [];
foreach ($data as $row) {
    $grouped[$row['nama']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Kartu Stok</title>
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

      th {
        text-align: center !important;
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
        font-size: 14px;
      }

      td[rowspan] {
        font-weight: 600;
        background-color: #f8fafc;
        border-right: 2px solid #d0d7e0;
        text-align: center;
      }

      @media (max-width: 1024px) {
        table {
          font-size: 12px;
        }

        th, td {
          padding: 10px 8px;
        }
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
          font-size: 11px;
        }

        th, td {
          padding: 8px 6px;
        }

        th {
          font-size: 11px;
        }
      }
    </style>
</head>
<body>
  <?php include '../Navbar/navbar.php'; ?>
  <div class="container">
    <h1>Kartu Stok</h1>

    <table>
      <thead>
        <tr>
          <th>Nomor</th>
          <th>Nama Barang</th>
          <th>Jenis</th>
          <th>Satuan</th>
          <th>Total Stock</th>
          <th>Waktu Transaksi</th>
          <th>Jenis Transaksi</th>
          <th>ID Transaksi</th>
          <th>Masuk</th>
          <th>Keluar</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $no = 1;

        foreach ($grouped as $barang => $rows):

            $rowspan = count($rows);  // jumlah transaksi per barang
            $first = true;            // penanda baris pertama
            $total_stock = end($rows)['stock']; // stock terakhir sebagai total
        ?>

            <?php foreach ($rows as $row): ?>
                <tr>
                    <?php if ($first): ?>
                        <td rowspan="<?= $rowspan ?>"><?= $no++; ?></td>
                        <td rowspan="<?= $rowspan ?>"><?= $row['nama']; ?></td>
                        <td rowspan="<?= $rowspan ?>"><?= $row['jenis']; ?></td>
                        <td rowspan="<?= $rowspan ?>"><?= $row['nama_satuan']; ?></td>
                        <td rowspan="<?= $rowspan ?>"><?= $total_stock; ?></td>
                    <?php $first = false; endif; ?>

                    <td><?= $row['created_at']; ?></td>
                    <td><?= $row['jenis_transaksi']; ?></td>
                    <td><?= $row['idtransaksi']; ?></td>
                    <td><?= $row['masuk']; ?></td>
                    <td><?= $row['keluar']; ?></td>
                </tr>
            <?php endforeach; ?>

        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

</body>
</html>
