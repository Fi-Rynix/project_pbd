<?php
include '../../koneksi.php';
include '../../query.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_vendor = $_POST['nama_vendor'];
    $badan_hukum = isset($_POST['badan_hukum']) ? 'Y' : 'N';
    Query::insert_vendor($conn, $nama_vendor, $badan_hukum);
    echo "<script>alert('Vendor berhasil ditambahkan'); window.location='vendor.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Vendor</title>
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

      input[type="checkbox"] {
        width: auto;
        margin-right: 8px;
      }

      .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
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
            <a href="vendor.php" class="btn-kembali">← Kembali</a>
        </div>

        <h2>Tambah Vendor</h2>

        <form method="POST">
            <div class="form-group">
                <label for="nama_vendor">Nama Vendor:</label>
                <input type="text" name="nama_vendor" id="nama_vendor" required>
            </div>

            <div class="form-group">
                <label>Badan Hukum:</label>
                <div class="checkbox-group">
                    <input type="checkbox" name="badan_hukum" id="badan_hukum" value="Y">
                    <label for="badan_hukum" style="margin: 0; text-transform: none; font-size: 14px; font-weight: normal; color: #2c3e50; text-transform: capitalize;">Ya</label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit">Tambah</button>
            </div>
        </form>
    </div>
</body>
</html>
