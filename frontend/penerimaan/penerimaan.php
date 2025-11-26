<?php
  include '../../koneksi.php';
  include '../../query.php';

  $pengadaan_aktif = Query::read_pengadaan_aktif($conn);
  $pengadaan_proses = Query::read_pengadaan_proses($conn);
  $pengadaan_selesai = Query::read_pengadaan_selesai($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data penerimaan</title>
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
    <h1>Kelola Penerimaan</h1>
    <h2>Pengadaan Aktif</h2>
    <main>
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
            <th>Kelola Penerimaan / Batalkan</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($pengadaan_aktif as $a){ ?>
            <tr>
              <td><?php echo $a['nomor_pengadaan']; ?></td>
              <td><?php echo $a['waktu_pengadaan']; ?></td>
              <td><?php echo $a['nama_user']; ?></td>
              <td><?php number_format($a['subtotal_pengadaan'], 0, ',', '.')?></td>
              <td><?php echo $a['ppn_pengadaan']; ?></td>
              <td><?php echo $a['total_pengadaan']; ?></td>
              <td><?php echo $a['nama_vendor']; ?></td>
              <td><?php
              switch ($a['status_pengadaan']) {
                  case 'M':
                    echo 'Memesan';
                    break;
              } ?></td>
              <td><a href="rincian_penerimaan.php?nomor_pengadaan=<?php echo $a['nomor_pengadaan']; ?>">Tambah</a><a href="">Batal</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>

    <h2>Penerimaan Berangsur</h2>
    <main>
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
            <th>Kelola Penerimaan</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($pengadaan_proses as $p){ ?>
            <tr>
              <td><?php echo $p['nomor_pengadaan']; ?></td>
              <td><?php echo $p['waktu_pengadaan']; ?></td>
              <td><?php echo $p['nama_user']; ?></td>
              <td><?php echo $p['subtotal_pengadaan']; ?></td>
              <td><?php echo $p['ppn_pengadaan']; ?></td>
              <td><?php echo $p['total_pengadaan']; ?></td>
              <td><?php echo $p['nama_vendor']; ?></td>
              <td><?php
              switch ($p['status_pengadaan']) {
                  case 'P':
                    echo 'Proses';
                    break;
              } ?></td>
              <td><a href="rincian_penerimaan.php?nomor_pengadaan=<?php echo $p['nomor_pengadaan']; ?>">Tambah</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>

    <h2>Penerimaan Selesai</h2>
    <main>
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
            <th>Rincian Penerimaan</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($pengadaan_selesai as $s){ ?>
            <tr>
              <td><?php echo $s['nomor_pengadaan']; ?></td>
              <td><?php echo $s['waktu_pengadaan']; ?></td>
              <td><?php echo $s['nama_user']; ?></td>
              <td><?php echo $s['subtotal_pengadaan']; ?></td>
              <td><?php echo $s['ppn_pengadaan']; ?></td>
              <td><?php echo $s['total_pengadaan']; ?></td>
              <td><?php echo $s['nama_vendor']; ?></td>
              <td><?php
              switch ($s['status_pengadaan']) {
                  case 'S':
                    echo 'Selesai';
                    break;
              } ?></td>
              <td><a href="rincian_penerimaan.php?nomor_pengadaan=<?php echo $s['nomor_pengadaan']; ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>