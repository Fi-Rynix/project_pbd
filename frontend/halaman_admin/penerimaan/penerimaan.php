<?php
  include '../../../koneksi.php';
  include '../../../query.php';

  $pengadaan_aktif = Query::read_pengadaan_aktif($conn);
  $pengadaan_proses = Query::read_pengadaan_proses($conn);
  $pengadaan_selesai = Query::read_pengadaan_selesai($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Penerimaan</title>
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
        margin-top: 32px;
        color: #2c3e50;
        border-bottom: 2px solid #1436a3;
        padding-bottom: 8px;
        display: inline-block;
      }

      main {
        margin-bottom: 32px;
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

      td:nth-child(4),
      td:nth-child(5),
      td:nth-child(6) {
        text-align: right;
        font-variant-numeric: tabular-nums;
      }

      a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        padding: 8px 14px;
        border-radius: 4px;
        display: inline-block;
        transition: all 0.2s ease;
        margin-right: 6px;
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

      a[href*="batalkan"] {
        background-color: #e74c3c;
      }

      a[href*="batalkan"]:hover {
        background-color: #c0392b;
        box-shadow: 0 2px 6px rgba(231, 76, 60, 0.2);
      }

      .badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
      }

      .badge-red {
        background-color: #fadbd8;
        color: #c0392b;
      }

      .badge-gray {
        background-color: #ecf0f1;
        color: #7f8c8d;
      }

      .badge-yellow {
        background-color: #fdebd0;
        color: #d68910;
      }

      .badge-green {
        background-color: #d5f4e6;
        color: #16a085;
      }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }

        h1 {
          font-size: 22px;
          margin-bottom: 16px;
        }

        h2 {
          font-size: 16px;
          margin-top: 24px;
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
              <td>Rp<?php echo number_format($a['subtotal_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $a['ppn_pengadaan']; ?>%</td>
              <td>Rp<?php echo number_format($a['total_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $a['nama_vendor']; ?></td>
              <td><span class="badge badge-gray"><?php
              switch ($a['status_pengadaan']) {
                  case 'M':
                    echo 'Memesan';
                    break;
              } ?></span></td>
              <td>
                <a href="rincian_penerimaan.php?nomor_pengadaan=<?php echo $a['nomor_pengadaan']; ?>">Tambah</a>
                <a href="batalkan_pengadaan.php?nomor_pengadaan=<?php echo $a['nomor_pengadaan']; ?>">Batal</a>
              </td>
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
              <td>Rp<?php echo number_format($p['subtotal_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $p['ppn_pengadaan']; ?>%</td>
              <td>Rp<?php echo number_format($p['total_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $p['nama_vendor']; ?></td>
              <td><span class="badge badge-yellow"><?php
              switch ($p['status_pengadaan']) {
                  case 'P':
                    echo 'Proses';
                    break;
              } ?></span></td>
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
              <td>Rp<?php echo number_format($s['subtotal_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $s['ppn_pengadaan']; ?>%</td>
              <td>Rp<?php echo number_format($s['total_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $s['nama_vendor']; ?></td>
              <td><span class="badge badge-green"><?php
              switch ($s['status_pengadaan']) {
                  case 'S':
                    echo 'Selesai';
                    break;
              } ?></span></td>
              <td><a href="rincian_penerimaan.php?nomor_pengadaan=<?php echo $s['nomor_pengadaan']; ?>">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
    </div>
  </body>
</html>