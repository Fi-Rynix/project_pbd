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
        flex-direction: column;
        align-items: center;
        gap: 30px;
      }
      .title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
      }
      .welcome {
        font-size: 18px;
      }
    </style>
  </head>

  <body>
    <?php include '../Navbar/navbar.php'; ?>
    <main>
      <?php if (isset($_SESSION['user'])): ?>
        <h1 class="title">Selamat Datang, <?= $_SESSION['user']['username']; ?></h1>
        <p class="welcome">Anda telah login sebagai admin.</p>
      <?php else: ?>
        <h1 class="title">Anda belum login.</h1>
        <p class="welcome">Silakan login terlebih dahulu.</p>
      <?php endif; ?>
    </main>
  </body>

