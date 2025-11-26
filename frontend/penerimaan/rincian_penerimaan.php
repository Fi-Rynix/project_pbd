<?php
  include '../../koneksi.php';
  include '../../query.php';

  $idpengadaan = $_GET['nomor_pengadaan'];

  $info_barang = Query::get_barang_by_pengadaan($conn, $idpengadaan);

  $penerimaan = Query::read_penerimaan_by_pengadaan($conn, $idpengadaan);
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
  <button><a href="penerimaan.php?nomor_pengadaan=<?= $idpengadaan ?>">Kembali</a></button>
  <br>
  <h1>Rincian Penerimaan Untuk Pengadaan#<?= htmlspecialchars($idpengadaan) ?></h1>
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

  <button><a href="insert_penerimaan.php?nomor_pengadaan=<?php echo $idpengadaan; ?>">Tambah Penerimaan</a></button>
  
  <h2>Daftar Penerimaan</h2>
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
            foreach($penerimaan as $row){ ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?php echo $row['nomor_penerimaan']; ?></td>
              <td><?php echo $row['waktu_penerimaan']; ?></td>
              <td><?php echo $row['nama_user']; ?></td>
              <td><?php echo $row['status_penerimaan'] === 'P' ? 'Proses' : 'Selesai' ; ?></td>
              <td><a href="detail_penerimaan.php?nomor_penerimaan=<?php echo $row['nomor_penerimaan']; ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
</body>
</html>