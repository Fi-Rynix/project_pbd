<?php
include '../../koneksi.php';
include '../../query.php';

$role_list = Query::read_role($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $idrole = $_POST['idrole'];

    $result = Query::insert_user($conn, $username, $password, $idrole);

    if ($result) {
        echo "<script>
                alert('User berhasil ditambahkan!');
                window.location='user.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan user!');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <style>
        form {
            max-width: 400px;
            margin: 20px auto;
        }
        label, input, select, button {
            display: block;
            width: 100%;
            margin-bottom: 12px;
        }
        button {
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Tambah User</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="idrole">Role:</label>
        <select name="idrole" id="idrole" required>
            <option value="">-- Pilih Role --</option>
            <?php foreach($role_list as $role) { ?>
                <option value="<?php echo $role['nomor_role']; ?>">
                    <?php echo $role['nama_role']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Simpan User</button>
    </form>
</body>
</html>
