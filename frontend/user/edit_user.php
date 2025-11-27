<?php
include '../../koneksi.php';
include '../../query.php';

if (!isset($_GET['iduser'])) {
    echo "<script>alert('User tidak ditemukan!'); window.location='user.php';</script>";
    exit;
}

$iduser = $_GET['iduser'];

$user_list = Query::read_user($conn);
$current_user = null;
foreach($user_list as $u){
    if($u['nomor_user'] == $iduser){
        $current_user = $u;
        break;
    }
}

if (!$current_user) {
    echo "<script>alert('User tidak ditemukan!'); window.location='user.php';</script>";
    exit;
}

$role_list = Query::read_role($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $idrole = $_POST['idrole'];

    $result = Query::update_user($conn, $iduser, $username, $password, $idrole);

    if ($result) {
        echo "<script>
                alert('User berhasil diupdate!');
                window.location='user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal update user!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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
            <a href="user.php" class="btn-kembali">← Kembali</a>
        </div>

        <h2>Edit User</h2>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($current_user['nama_user']); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" name="password" id="password" value="" placeholder="Isi jika ingin ganti password">
            </div>

            <div class="form-group">
                <label for="idrole">Role:</label>
                <select name="idrole" id="idrole" required>
                    <option value="">-- Pilih Role --</option>
                    <?php foreach($role_list as $role) { ?>
                        <option value="<?php echo $role['nomor_role']; ?>" <?php echo ($role['nomor_role'] == $current_user['nomor_role']) ? 'selected' : ''; ?>>
                            <?php echo $role['nama_role']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit">Update User</button>
            </div>
        </form>
    </div>
</body>
</html>
