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
    <h1>Edit User</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $current_user['nama_user']; ?>" required>

        <label for="password">Password:</label>
        <input type="text" name="password" id="password" value="" placeholder="Isi jika ingin ganti password">

        <label for="idrole">Role:</label>
        <select name="idrole" id="idrole" required>
            <option value="">-- Pilih Role --</option>
            <?php foreach($role_list as $role) { ?>
                <option value="<?php echo $role['nomor_role']; ?>" <?php echo ($role['nomor_role'] == $current_user['nomor_role']) ? 'selected' : ''; ?>>
                    <?php echo $role['nama_role']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
