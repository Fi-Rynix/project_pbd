
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Data Master</title>
    <link rel="stylesheet" href="../../CSS/datamaster.css">
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #fff;
      }
      main {
        max-width: 1400px;
        margin: 30px auto 0 auto;
        padding: 0 20px;
        display: flex;
        gap: 30px;
        justify-content: center;
      }
      .button-container {
        display: flex;
        gap: 30px;
        justify-content: center;
      }
      .menu-box {
        width: 200px;
        height: 200px;
        border: 2px solid #1436a3;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
        transition: background-color 0.3s, color 0.3s;
      }
      .menu-box a {
        text-decoration: none;
        color: #1436a3;
        font-weight: bold;
        font-size: 16px;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
      }
      .menu-box:hover {
        background-color: #1436a3;
      }
      .menu-box:hover a {
        color: #fff;
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <main>
      <div class="button-container">
        <div class="menu-box">
          <a href="../role/role.php">Role</a>
        </div>
        <div class="menu-box">
          <a href="../role/user.php">User</a>
        </div>
        <div class="menu-box">
          <a href="../role/vendor.php">Vendor</a>
        </div>
        <div class="menu-box">
          <a href="../role/satuan.php">Satuan</a>
        </div>
        <div class="menu-box">
          <a href="../role/barang.php">Barang</a>
        </div>
      </div>
    </main>
  </body>