<?php
  include '../../../koneksi.php';
  include '../../../query.php';

  $idpengadaan = $_GET['nomor_pengadaan'];

  $info_barang = Query::get_barang_by_pengadaan($conn, $idpengadaan);

  $penerimaan = Query::read_penerimaan_by_pengadaan($conn, $idpengadaan);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rincian Pengadaan #<?= htmlspecialchars($idpengadaan) ?></title>
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
      margin-top: 16px;
      color: #1a252f;
    }

    h2 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 16px;
      margin-top: 28px;
      color: #2c3e50;
      border-bottom: 2px solid #1436a3;
      padding-bottom: 8px;
      display: inline-block;
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

    td:nth-child(2),
    td:nth-child(3) {
      text-align: left;
    }

    tbody tr td:last-child {
      text-align: center;
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
    }

    a.link-btn:hover {
      background-color: #0d2a7a;
      transform: translateY(-1px);
      box-shadow: 0 2px 6px rgba(20, 54, 163, 0.2);
    }

    tfoot td {
      font-weight: 600;
      background-color: #f8fafc;
      padding: 14px 12px;
      border-top: 2px solid #1436a3;
    }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }      h1 {
        font-size: 22px;
        margin-bottom: 16px;
      }

      h2 {
        font-size: 16px;
        margin-top: 20px;
      }

      .button-group {
        flex-direction: column;
      }

      button, a.btn {
        width: 100%;
        text-align: center;
      }

      table {
        font-size: 13px;
      }

      th, td {
        padding: 10px 8px;
      }

      .info-row {
        flex-direction: column;
        align-items: flex-start;
      }

      .info-row b {
        margin-bottom: 4px;
      }
    }
  </style>
</head>
<body>
  <?php include '../Navbar/navbar.php'; ?>
  <div class="container">
    <div class="button-group">
      <a href="penerimaan.php?nomor_pengadaan=<?= $idpengadaan ?>" class="btn">← Kembali</a>
    </div>
    <h1>Rincian Penerimaan Untuk Pengadaan #<?= htmlspecialchars($idpengadaan) ?></h1>
  
  <h2>Rincian Barang yang Diadakan</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Harga Pesan</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($info_barang as $i => $b): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($b['nama']) ?></td>
          <td>Rp<?= number_format($b['harga_satuan'], 0, ',', '.') ?> / <?= htmlspecialchars($b['nama_satuan']) ?></td>
          <td><?= htmlspecialchars($b['jumlah']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  
  
  <h2>Daftar Penerimaan</h2>
  <div class="button-group">
    <a href="insert_penerimaan.php?nomor_pengadaan=<?php echo $idpengadaan; ?>" class="btn">+ Tambah Penerimaan</a>
  </div>
  <table>
        <thead>
          <tr>
            <th>No</th>
            <th>ID Penerimaan</th>
            <th>Waktu Penerimaan</th>
            <th>Penanggung Jawab</th>
            <th>Status</th>
            <th>Detail Penerimaan</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($penerimaan as $idx => $row){ ?>
            <tr>
              <td><?= $idx + 1 ?></td>
              <td><?php echo $row['nomor_penerimaan']; ?></td>
              <td><?php echo $row['waktu_penerimaan']; ?></td>
              <td><?php echo $row['nama_user']; ?></td>
              <td><?php echo $row['status_penerimaan'] === 'P' ? 'Proses' : 'Selesai' ; ?></td>
              <td><a href="detail_penerimaan.php?nomor_penerimaan=<?php echo $row['nomor_penerimaan']; ?>" class="link-btn">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
  </div>
</body>
</html>