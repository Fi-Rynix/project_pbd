<?php
include '../../koneksi.php';
include '../../query.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jenis = $_POST['jenis'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $idsatuan = $_POST['idsatuan'];
  $idvendor = $_POST['idvendor'];

  Query::insert_barang($conn, $jenis, $nama, $harga, $idsatuan, $idvendor);

  header("Location: barang.php");
  exit;
}

$satuan = Query::read_satuan_aktif($conn);
$vendor = Query::read_vendor_aktif($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
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

      h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 24px;
        margin-top: 16px;
        color: #1a252f;
      }

      .button-group {
        margin-bottom: 16px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }

      a {
        color: white;
        text-decoration: none;
        font-weight: 500;
      }

      a.btn-kembali {
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

      a.btn-kembali:hover {
        background-color: #0d2a7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 54, 163, 0.2);
      }

      form {
        background: white;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
      }

      .form-group {
        margin-bottom: 16px;
        margin-left: auto;
        margin-right: auto;
        max-width: 100%;
      }

      label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #1436a3;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: center;
      }

      input, select {
        padding: 10px 12px;
        border: 1px solid #d0d7e0;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
        width: 100%;
      }

      input:focus, select:focus {
        outline: none;
        border-color: #1436a3;
        box-shadow: 0 0 0 3px rgba(20, 54, 163, 0.1);
        background-color: white;
      }

      button {
        padding: 10px 18px;
        background-color: #1436a3;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
      }

      button:hover {
        background-color: #0d2a7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 54, 163, 0.2);
      }

      .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 2px solid #ecf0f1;
        justify-content: center;
      }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }

        h2 {
          font-size: 20px;
          margin-bottom: 16px;
        }

        form {
          padding: 16px;
        }

        .form-actions {
          flex-direction: column;
        }

        button, a.btn-kembali {
          width: 100%;
          text-align: center;
        }
      }
    </style>
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <div class="container">
        <div class="button-group">
            <a href="barang.php" class="btn-kembali">← Kembali</a>
        </div>

        <h2>Tambah Barang</h2>

        <form method="POST">
            <div class="form-group">
                <label for="jenis">Jenis Barang:</label>
                <input type="text" name="jenis" id="jenis" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Barang:</label>
                <input type="text" name="nama" id="nama" required>
            </div>

            <div class="form-group">
                <label for="harga">Harga Barang:</label>
                <input type="number" name="harga" id="harga" required>
            </div>

            <div class="form-group">
                <label for="idsatuan">Satuan:</label>
                <select name="idsatuan" id="idsatuan" required>
                    <option value="">-- Pilih Satuan --</option>
                    <?php foreach ($satuan as $s): ?>
                      <option value="<?= $s['nomor_satuan']; ?>"><?= $s['nama_satuan']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="idvendor">Vendor:</label>
                <select name="idvendor" id="idvendor" required>
                    <option value="">-- Pilih Vendor --</option>
                    <?php foreach ($vendor as $v): ?>
                      <option value="<?= $v['nomor_vendor']; ?>"><?= $v['nama_vendor']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
