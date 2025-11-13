<?php
  include '../../koneksi.php';
  include '../../query.php';

  $jenis_view = ['all', 'aktif'];
  $view = isset($_GET['view']) && in_array($_GET['view'], $jenis_view) ? $_GET['view'] : 'all';

  if ($view === 'aktif') {
    $margin_list = Query::read_margin_aktif($conn);
  } else {
    $margin_list = Query::read_margin_all($conn);
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
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
    <h1>Tabel Margin Penjualan</h1>
    <div class="view-controls">
      <form method="get" id="viewForm">
        <label for="view">Tampilkan: </label>
        <select name="view" id="view" onchange="document.getElementById('viewForm').submit();">
          <option value="all" <?php echo ($view === 'all') ? 'selected' : ''; ?>>Semua Margin</option>
          <option value="aktif" <?php echo ($view === 'aktif') ? 'selected' : ''; ?>>Margin Aktif</option>
        </select>
      </form>
    </div>
    <main>
      <table>
        <thead>
          <t>
            <th>ID Margin</th>
            <th>Dibuat Pada</th>
            <th>Besaran Persen (desimal)</th>
            <th>Status</th>
            <th>Dibuat Oleh</th>
            <th>Diperbarui Pada</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($margin_list as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_margin']; ?></td>
              <td><?php echo $row['dibuat_pada']; ?></td>
              <td><?php echo $row['persentase_margin']; ?></td>
              <td><?php echo $row['status_margin'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
              <td><?php echo $row['dibuat_oleh']; ?></td>
              <td><?php echo $row['diupdate_pada']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>