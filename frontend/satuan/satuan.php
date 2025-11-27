<?php
  include '../../koneksi.php';
  include '../../query.php';

  $jenis_view = ['all', 'aktif'];
  $view = isset($_GET['view']) && in_array($_GET['view'], $jenis_view) ? $_GET['view'] : 'all';

  if ($view === 'aktif') {
    $satuan_list = Query::read_satuan_aktif($conn);
  } else {
    $satuan_list = Query::read_satuan_all($conn);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Satuan</title>
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
      th:nth-child(2) {
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
      td:nth-child(2) {
        text-align: left;
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
        margin: 0 4px;
      }

      a.link-btn:hover {
        background-color: #0d2a7a;
        transform: translateY(-1px);
        box-shadow: 0 2px 6px rgba(20, 54, 163, 0.2);
      }

      a.link-btn.delete {
        background-color: #e74c3c;
      }

      a.link-btn.delete:hover {
        background-color: #c0392b;
        box-shadow: 0 2px 6px rgba(231, 76, 60, 0.2);
      }

      .view-controls {
        margin: 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .view-controls select {
        padding: 10px 12px;
        border: 1px solid #d0d7e0;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
      }

      .view-controls select:focus {
        outline: none;
        border-color: #1436a3;
        box-shadow: 0 0 0 3px rgba(20, 54, 163, 0.1);
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
      <h1>Tabel Satuan</h1>
      <div class="button-group">
        <a href="tambah_satuan.php" class="btn">+ Tambah Satuan</a>
      </div>

      <div class="view-controls">
        <form method="get" id="viewForm">
          <label for="view">Tampilkan: </label>
          <select name="view" id="view" onchange="document.getElementById('viewForm').submit();">
            <option value="all" <?php echo ($view === 'all') ? 'selected' : ''; ?>>Semua Satuan</option>
            <option value="aktif" <?php echo ($view === 'aktif') ? 'selected' : ''; ?>>Satuan Aktif</option>
          </select>
        </form>
      </div>

      <main>
        <table>
          <thead>
            <tr>
              <th>ID Satuan</th>
              <th>Nama Satuan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($satuan_list as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_satuan']; ?></td>
              <td><?php echo $row['nama_satuan']; ?></td>
              <td>
                <?php if ($row['status_satuan']): ?>
                  <span style="color: #16a085; font-weight: 600;">Aktif</span>
                <?php else: ?>
                  <span style="color: #7f8c8d; font-weight: 600;">Tidak Aktif</span>
                <?php endif; ?>
              </td>
              <td>
                  <a href="edit_satuan.php?idsatuan=<?php echo $row['nomor_satuan']; ?>" class="link-btn">Edit</a>
                  <?php if($row['status_satuan'] == 1) { ?>
                      <a href="hapus_satuan.php?idsatuan=<?php echo $row['nomor_satuan']; ?>" class="link-btn delete" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                  <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </main>
    </div>
  </body>
</html>