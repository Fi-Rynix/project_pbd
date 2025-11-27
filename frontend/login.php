<?php
session_start();
require_once '../koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $query="SELECT iduser, username, password, idrole
            FROM user
            WHERE username =?";

    $db = $conn->prepare($query);
    if ($db) {
        $db->bind_param('s', $email);
        $db->execute();
        $result = $db->get_result();
        if ($row = $result->fetch_assoc()) {
            if ($password == $row['password']) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = [
                  'id'       => $row['iduser'],
                  'username' => $row['username'],
                  'idrole'   => $row['idrole'],
                ];

                // Redirect berdasarkan role
                switch ($row['idrole']) {
                    case 1:
                        // Admin
                        header('Location: dashboard/dashboard.php');
                        break;
                    case 2:
                        // Staff
                        header('Location: halaman_admin/dashboard/dashboard.php');
                        break;
                    default:
                        // Default ke dashboard umum
                        header('Location: dashboard.php');
                }
                exit;
            } else {
                $error = 'Password salah!';
            }
        } else {
            $error = 'User tidak ditemukan!';
        }
        $db->close();
    } else {
      header('location: login.php?error=' . urlencode('Query error: ' . $conn->error));
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Manajemen Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        background: linear-gradient(135deg, #1436a3 0%, #0d2a7a 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #2c3e50;
        line-height: 1.6;
      }

      .login-container {
        width: 100%;
        max-width: 420px;
        padding: 16px;
      }

      .login-card {
        background: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
      }

      .login-header {
        text-align: center;
        margin-bottom: 32px;
      }

      .login-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1436a3;
        margin-bottom: 8px;
      }

      .login-header p {
        font-size: 14px;
        color: #7f8c8d;
      }

      .form-group {
        margin-bottom: 20px;
      }

      label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1a252f;
        font-size: 14px;
      }

      input[type="text"],
      input[type="password"],
      input[type="email"] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d0d7e0;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
      }

      input[type="text"]:focus,
      input[type="password"]:focus,
      input[type="email"]:focus {
        outline: none;
        border-color: #1436a3;
        box-shadow: 0 0 0 3px rgba(20, 54, 163, 0.1);
      }

      button[type="submit"] {
        width: 100%;
        padding: 11px 18px;
        background-color: #1436a3;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 8px;
      }

      button[type="submit"]:hover {
        background-color: #0d2a7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 54, 163, 0.2);
      }

      button[type="submit"]:active {
        transform: translateY(0);
      }

      .alert {
        padding: 12px 14px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
        border: 1px solid;
      }

      .alert-danger {
        background-color: #fadbd8;
        border-color: #f5b7b1;
        color: #c0392b;
      }

      .alert-success {
        background-color: #d5f4e6;
        border-color: #a9dfbf;
        color: #16a085;
      }

      @media (max-width: 480px) {
        .login-card {
          padding: 28px 20px;
        }

        .login-header h1 {
          font-size: 24px;
        }

        .login-container {
          padding: 12px;
        }
      }
    </style>
</head>
<body>
<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <h1>Masuk</h1>
      <p>Sistem Manajemen Barang</p>
    </div>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <label for="email">Username</label>
        <input type="text" id="email" name="email" required autofocus>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">Masuk</button>
    </form>
  </div>
</div>
</body>
</html>