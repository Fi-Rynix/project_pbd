<!DOCTYPE html>
<html>
  <head>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 28px;
        background: linear-gradient(135deg, #1436a3 0%, #0d2a7a 100%);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        position: sticky;
        top: 0;
        z-index: 100;
      }

      header img {
        height: 48px;
        transition: transform 0.2s ease;
      }

      header img:hover {
        transform: scale(1.05);
      }

      nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 8px;
        align-items: center;
      }

      nav ul li {
        margin: 0;
      }

      nav ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: block;
        background-color: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
      }

      nav ul li a:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      }

      .dropdown {
        position: relative;
        display: inline-block;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #0d2a7a;
        min-width: 180px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
        z-index: 1;
        border-radius: 8px;
        top: 100%;
        margin-top: 0;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
      }

      .dropdown-content a {
        color: #fff;
        padding: 12px 18px;
        text-decoration: none;
        display: block;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
      }

      .dropdown-content a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffd600;
        border-left-color: #ffd600;
        padding-left: 24px;
      }

      .dropdown:hover .dropdown-content {
        display: block;
        animation: slideDown 0.2s ease;
      }

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-8px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      @media (max-width: 768px) {
        header {
          padding: 12px 16px;
          flex-wrap: wrap;
        }

        header img {
          height: 40px;
        }

        nav ul {
          gap: 4px;
          flex-wrap: wrap;
        }

        nav ul li a {
          padding: 8px 12px;
          font-size: 13px;
        }

        .dropdown-content {
          min-width: 150px;
        }

        .dropdown-content a {
          padding: 10px 14px;
          font-size: 13px;
        }
      }
    </style>
  </head>

  <body>
    <header>
      <img src="../../../Assets/logouner.png" alt="logouner">
      <nav>
        <ul>
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
              <a href="../margin/margin.php">Data Margin Penjualan</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
  </body>
</html>
