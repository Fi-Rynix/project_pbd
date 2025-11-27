<?php
include '../../koneksi.php';
include '../../query.php';

// Misal user login ID 1, nanti bisa diganti sesuai session
$iduser = 1;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $persentase = floatval($_POST['persentase']);
    Query::insert_margin($conn, $persentase, $iduser);
    echo "<script>alert('Margin berhasil ditambahkan'); window.location='margin.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Margin Penjualan</title>
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
      }

      .container {
        padding: 24px;
        max-width: 100%;
      }

      h1 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 24px;
        color: #1a252f;
      }

      form {
        background: white;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        max-width: 500px;
        margin: 0 auto;
        text-align: center;
      }

      .form-group {
        margin-bottom: 20px;
        margin-left: auto;
        margin-right: auto;
        max-width: 100%;
      }

      label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1a252f;
        font-size: 14px;
        text-align: center;
      }

      input[type="number"],
      input[type="text"],
      input[type="password"],
      select,
      textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d0d7e0;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
      }

      input:focus,
      select:focus,
      textarea:focus {
        outline: none;
        border-color: #1436a3;
        box-shadow: 0 0 0 3px rgba(20, 54, 163, 0.1);
      }

      .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 24px;
        padding-top: 16px;
        border-top: 1px solid #ecf0f1;
        justify-content: center;
      }

      button {
        background-color: #1436a3;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      button:hover {
        background-color: #0d2a7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 54, 163, 0.2);
      }

      button:active {
        transform: translateY(0);
      }

      a.btn-kembali {
        background-color: #7f8c8d;
        color: white;
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-block;
        font-weight: 500;
        transition: all 0.3s ease;
      }

      a.btn-kembali:hover {
        background-color: #6c7a7b;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(127, 140, 141, 0.2);
      }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }

        h1 {
          font-size: 22px;
          margin-bottom: 16px;
        }

        form {
          padding: 16px;
        }

        .form-actions {
          flex-direction: column;
        }

        button,
        a.btn-kembali {
          width: 100%;
          text-align: center;
        }
      }
    </style>
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <div class="container">
      <h1>Tambah Margin Penjualan</h1>
      <form method="POST">
        <div class="form-group">
          <label for="persentase">Besaran Persen:</label>
          <input type="number" step="0.01" name="persentase" id="persentase" required>
        </div>

        <div class="form-actions">
          <button type="submit">Tambah Margin</button>
          <a href="margin.php" class="btn-kembali">Kembali</a>
        </div>
      </form>
    </div>
</body>
</html>
