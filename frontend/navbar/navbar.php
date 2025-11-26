<!DOCTYPE html>
<html>
  <head>
    <style>
      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #1436a3;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }
      header img {
        height: 50px;
      }
      nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 15px;
      }
      nav ul li {
        margin: 0;
      }
      nav ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 4px;
      }
      nav ul li a:hover {
        color: #ffd600;
        background: rgba(255, 255, 255, 0.1);
      }
      .dropdown {
        position: relative;
        display: inline-block;
      }
      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #1436a3;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 4px;
      }
      .dropdown-content a {
        color: #fff;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }
      .dropdown-content a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffd600;
      }
      .dropdown:hover .dropdown-content {
        display: block;
      }
    </style>
  </head>

  <body>
    <header>
    <img src="../../Assets/logouner.png" alt="logouner">
      <nav>
        <ul>
          <li>
            <a href="../kartu_stok/stok.php">Kartu Stok</a>
          </li>
          <li class="dropdown">
            <a href="#">Transaksi</a>
            <div class="dropdown-content">
              <a href="../pengadaan/pengadaan.php">Pengadaan</a>
              <a href="../penerimaan/penerimaan.php">Penerimaan</a>
              <a href="../retur/retur.php">Retur</a>
              <a href="../penjualan/penjualan.php">Penjualan</a>
            </div>
          </li>
          <li class="dropdown">
            <a href="#">Data Master</a>
            <div class="dropdown-content">
              <a href="../barang/barang.php">Data Barang</a>
              <a href="../role/role.php">Data Role</a>
              <a href="../satuan/satuan.php">Data Satuan</a>
              <a href="../user/user.php">Data User</a>
              <a href="../vendor/vendor.php">Data Vendor</a>
              <a href="../margin/margin.php">Data Margin Penjualan</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
  </body>
</html>
