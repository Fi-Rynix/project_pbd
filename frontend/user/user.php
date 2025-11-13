<?php
  include '../../koneksi.php';
  include '../../query.php';

  $user_list = Query::read_user($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data User</title>
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
      <table>
        <thead>
          <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Id Role</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($user_list as $row){ ?>
            <tr>
              <td><?php echo $row['nomor_user']; ?></td>
              <td><?php echo $row['nama_user']; ?></td>
              <td><?php echo $row['nama_role']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </main>
  </body>
</html>