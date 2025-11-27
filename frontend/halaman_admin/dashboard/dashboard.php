<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../CSS/datamaster.css">
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
        max-width: 1200px;
        margin: 0 auto;
      }

      h1 {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 24px;
        color: #1a252f;
      }

      .welcome {
        font-size: 18px;
        color: #555;
        line-height: 1.8;
      }

      .welcome-card {
        background: white;
        padding: 32px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }

        h1 {
          font-size: 24px;
        }

        .welcome-card {
          padding: 20px;
        }
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <div class="container">
      <div class="welcome-card">
        <?php if (isset($_SESSION['user'])): ?>
          <h1>Selamat Datang, <?= htmlspecialchars($_SESSION['user']['username']); ?></h1>
          <p class="welcome">Anda telah login sebagai admin. Silakan gunakan menu di atas untuk mengelola data sistem.</p>
        <?php else: ?>
          <h1>Anda belum login</h1>
          <p class="welcome">Silakan login terlebih dahulu untuk mengakses sistem.</p>
        <?php endif; ?>
      </div>
    </div>
  </body>

