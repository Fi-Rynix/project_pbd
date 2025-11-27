<?php
  include '../../../koneksi.php';
  include '../../../query.php';

  $idpenerimaan = $_GET['nomor_penerimaan'];

  $detail = Query::read_detail_penerimaan($conn, $idpenerimaan);

  $info = $detail[0];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Penerimaan #<?= htmlspecialchars($info['nomor_penerimaan']) ?></title>
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

    h2 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 16px;
      color: #2c3e50;
      border-bottom: 2px solid #1436a3;
      padding-bottom: 8px;
      display: inline-block;
    }

    .info-box {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 32px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      border-left: 4px solid #1436a3;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
      padding-bottom: 12px;
      border-bottom: 1px solid #ecf0f1;
    }

    .info-row:last-child {
      border-bottom: none;
      margin-bottom: 0;
      padding-bottom: 0;
    }

    .info-row b {
      color: #1436a3;
      font-weight: 600;
      min-width: 140px;
    }

    .info-row span:last-child {
      text-align: right;
      font-weight: 500;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
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

    th:nth-child(2),
    th:nth-child(3),
    th:nth-child(4) {
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

    td:nth-child(2),
    td:nth-child(3),
    td:nth-child(4) {
      text-align: left;
    }

    tfoot td {
      font-weight: 600;
      background-color: #f8fafc;
      padding: 14px 12px;
      border-top: 2px solid #1436a3;
    }

    .text-green {
      color: #27ae60;
      font-weight: 600;
    }

    .text-red {
      color: #e74c3c;
      font-weight: 600;
    }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }      h1 {
        font-size: 22px;
        margin-bottom: 16px;
      }

      .info-row {
        flex-direction: column;
        align-items: flex-start;
      }

      .info-row b {
        margin-bottom: 4px;
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
    <h1>Detail Penerimaan #<?= htmlspecialchars($info['nomor_penerimaan']) ?></h1>

  <div class="info-box">
    <div class="info-row"><span><b>Tanggal:</b></span> <span><?= htmlspecialchars($info['waktu_penerimaan']) ?></span></div>
    <div class="info-row"><span><b>Penanggung Jawab:</b></span> <span><?= htmlspecialchars($info['nama_user']) ?></span></div>
    <div class="info-row"><span><b>Status:</b></span> <span><?= htmlspecialchars($info['status_penerimaan']) ?></span></div>
  </div>

  <h2>Daftar Barang</h2>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jenis</th>
        <th>Satuan</th>
        <th>Harga Pesan</th>
        <th>Harga Terima</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Selisih</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($detail as $i => $row):
        $selisih = $row['harga_terima'] - $row['harga_pesan'];
        $warna = $selisih > 0 ? 'text-red' : 'text-green';
      ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($row['nama']) ?></td>
          <td><?= htmlspecialchars($row['jenis']) ?></td>
          <td><?= htmlspecialchars($row['nama_satuan']) ?></td>

          <td>Rp<?= number_format($row['harga_pesan'], 0, ',', '.') ?></td>
          <td>Rp<?= number_format($row['harga_terima'], 0, ',', '.') ?></td>

          <td><?= htmlspecialchars($row['jumlah_terima']) ?></td>
          <td>Rp<?= number_format($row['sub_total_terima'], 0, ',', '.') ?></td>

          <td class="<?= $warna ?>">
            Rp<?= number_format($selisih, 0, ',', '.') ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>
  </div>
</body>
</html>
