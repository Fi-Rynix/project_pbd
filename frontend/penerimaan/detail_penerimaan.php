<?php
  include '../../koneksi.php';
  include '../../query.php';

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
    .text-green { color: green; font-weight: bold; }
    .text-red { color: red; font-weight: bold; }
  </style>
</head>
<body>

  <?php include '../Navbar/navbar.php'; ?>
  <br>

  <h1>Detail Penerimaan #<?= htmlspecialchars($info['nomor_penerimaan']) ?></h1>

  <div class="info-box">
    <div class="info-row"><span><b>Tanggal:</b></span> <span><?= htmlspecialchars($info['waktu_penerimaan']) ?></span></div>
    <div class="info-row"><span><b>User:</b></span> <span><?= htmlspecialchars($info['nama_user']) ?></span></div>
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

</body>
</html>
