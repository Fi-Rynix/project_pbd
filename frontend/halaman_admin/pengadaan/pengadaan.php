<?php
  include '../../../koneksi.php';
  include '../../../query.php';

  $pengadaan_list = Query::read_pengadaan($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Pengadaan</title>
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

      main {
        margin-bottom: 32px;
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

      .badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
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

      .badge-red {
        background-color: #fadbd8;
        color: #c0392b;
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
          font-size: 13px;
        }

        th, td {
          padding: 10px 8px;
        }

        .button-group {
          flex-direction: column;
        }

        button, a.btn {
          width: 100%;
          text-align: center;
        }
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <div class="container">
      <h1>Tabel Pengadaan</h1>
      <div class="button-group">
        <a href="insert_pengadaan.php" class="btn">+ Tambah Pengadaan</a>
      </div>
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
              <td>Rp<?php echo number_format($row['subtotal_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $row['ppn_pengadaan']; ?>%</td>
              <td>Rp<?php echo number_format($row['total_pengadaan'], 0, ',', '.'); ?></td>
              <td><?php echo $row['nama_vendor']; ?></td>
              <td>
                <?php
                  $statusClass = '';
                  $statusText = '';
                  switch ($row['status_pengadaan']) {
                    case 'M':
                      $statusClass = 'badge-gray';
                      $statusText = 'Memesan';
                      break;
                    case 'P':
                      $statusClass = 'badge-yellow';
                      $statusText = 'Proses';
                      break;
                    case 'S':
                      $statusClass = 'badge-green';
                      $statusText = 'Selesai';
                      break;
                    case 'B':
                      $statusClass = 'badge-red';
                      $statusText = 'Batal';
                      break;
                  }
                ?>
                <span class="badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
              </td>
              <td><a href="detail_pengadaan.php?nomor_pengadaan=<?php echo $row['nomor_pengadaan']; ?>" class="link-btn">Detail</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      </main>
    </div>
  </body>
</html>