<?php
  include '../../koneksi.php';
  include '../../query.php';

  $role_list = Query::read_role($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Role</title>
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
    <h1>Tabel Role</h1>
    <main>
      <table>
        <thead>
          <tr>
            <th>ID Role</th>
            <th>Nama Role</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($role_list as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_role']; ?></td>
              <td><?php echo $row['nama_role']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>