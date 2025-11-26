<?php
  include '../../koneksi.php';
  include '../../query.php';

  $pengadaan_list = Query::read_pengadaan($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data pengadaan</title>
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
    <h1>Tabel Pengadaan</h1>
    <main>
      <button><a href="insert_pengadaan.php">Tambah Pengadaan</a></button>
      <table>
        <thead>
          <tr>
            <th>ID Pengadaan</th>
            <th>Waktu Pengadaan</th>
            <th>Penanggung Jawab</th>
            <th>Subtotal</th>
            <th>PPN</th>
            <th>Total</th>
            <th>Vendor Barang</th>
            <th>Status</th>
            <th>Rincian Pengadaan</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($pengadaan_list as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_pengadaan']; ?></td>
              <td><?php echo $row['waktu_pengadaan']; ?></td>
              <td><?php echo $row['nama_user']; ?></td>
              <td><?php number_format($row['subtotal_pengadaan'], 0, ',', '.')?></td>
              <td><?php echo $row['ppn_pengadaan']; ?></td>
              <td><?php number_format($row['total_pengadaan'], 0, ',', '.') ?></td>
              <td><?php echo $row['nama_vendor']; ?></td>
              <td><?php
                switch ($row['status_pengadaan']) {
                  case 'M':
                    echo 'Memesan';
                    break;
                  case 'P':
                    echo 'Proses';
                    break;
                  case 'S':
                    echo 'Selesai';
                    break;
                  case 'B':
                    echo 'Batal';
                    break;
                }
              ?></td>
              <td><a href="detail_pengadaan.php?nomor_pengadaan=<?php echo $row['nomor_pengadaan']; ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>