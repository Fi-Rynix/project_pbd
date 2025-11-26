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
    <a href="tambah_satuan.php">Tambah Satuan</a>

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
          <?php
            
            foreach($satuan_list as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_satuan']; ?></td>
              <td><?php echo $row['nama_satuan']; ?></td>
              <td><?php echo $row['status_satuan'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
              <td>
                  <a href="edit_satuan.php?idsatuan=<?php echo $row['nomor_satuan']; ?>">Edit</a>
                  <?php if($row['status_satuan'] == 1) { ?>
                      | <a href="hapus_satuan.php?idsatuan=<?php echo $row['nomor_satuan']; ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                  <?php } ?>
              </td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>