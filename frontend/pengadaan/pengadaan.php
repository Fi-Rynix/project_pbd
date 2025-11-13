<?php
  include '../../koneksi.php';
  include '../../query.php';

  $query = Query::read_pengadaan($conn);
  $result_arr = $query->fetch_all(MYSQLI_ASSOC);
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
    <h1>Tabel User</h1>
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
            foreach($result_arr as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_pengadaan']; ?></td>
              <td><?php echo $row['waktu_pengadaan']; ?></td>
              <td><?php echo $row['nama_user']; ?></td>
              <td><?php echo $row['subtotal_pengadaan']; ?></td>
              <td><?php echo $row['ppn_pengadaan']; ?></td>
              <td><?php echo $row['total_pengadaan']; ?></td>
              <td><?php echo $row['nama_vendor']; ?></td>
              <td><?php echo $row['status_pengadaan'] === 'P' ? 'Proses' : 'Selesai' ; ?></td>
              <td><a href="detail_pengadaan.php?nomor_pengadaan=<?php echo $row['nomor_pengadaan']; ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>