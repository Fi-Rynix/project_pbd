<?php
session_start();
require_once '../../koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $query="SELECT iduser, username, password
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
                  'id'    => $row['iduser'],
                  'username'  => $row['username'],
                ];

                header('Location: dashboard.php');
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
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width:400px;">
    <h2 class="mb-4">Login</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>