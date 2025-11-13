<?php
  include '../../koneksi.php';
  include '../../query.php';

  $allowed_views = ['all', 'aktif'];
  $view = isset($_GET['view']) && in_array($_GET['view'], $allowed_views) ? $_GET['view'] : 'all';

  if ($view === 'aktif') {
    $vendor_list = Query::read_vendor_aktif($conn);
  } else {
    $vendor_list = Query::read_vendor_all($conn);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Vendor</title>
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
      .view-controls {
        margin: 12px 0;
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .view-controls select {
        padding: 6px 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Tabel Vendor</h1>
    <div class="view-controls">
      <form method="get" id="viewForm">
        <label for="view">Tampilkan: </label>
        <select name="view" id="view" onchange="document.getElementById('viewForm').submit();">
          <option value="all" <?php echo ($view === 'all') ? 'selected' : ''; ?>>Semua Vendor</option>
          <option value="aktif" <?php echo ($view === 'aktif') ? 'selected' : ''; ?>>Vendor Aktif</option>
        </select>
      </form>
    </div>
    <main>
      <table>
        <thead>
          <tr>
            <th>ID Vendor</th>
            <th>Nama Vendor</th>
            <th>Badan Hukum</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            
            foreach($vendor_list as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_vendor']; ?></td>
              <td><?php echo $row['nama_vendor']; ?></td>
              <td><?php echo $row['badan_hukum'] === 'Y' ? 'Ya' : 'Tidak'; ?></td>
              <td><?php echo $row['status_vendor'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>