<?php
  include '../../koneksi.php';
  include '../../query.php';

  $jenis_view = ['all', 'aktif'];
  $view = isset($_GET['view']) && in_array($_GET['view'], $jenis_view) ? $_GET['view'] : 'all';

  if ($view === 'aktif') {
    $query = Query::read_satuan_aktif($conn);
  } else {
    $query = Query::read_satuan_all($conn);
  }
  if (!$query) {
    $result_arr = [];
  } else {
    $result_arr = $query->fetch_all(MYSQLI_ASSOC);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Satuan</title>
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
    <h1>Tabel Satuan</h1>
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
          </tr>
        </thead>
        <tbody>
          <?php
            
            foreach($result_arr as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_satuan']; ?></td>
              <td><?php echo $row['nama_satuan']; ?></td>
              <td><?php echo $row['status_satuan'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>