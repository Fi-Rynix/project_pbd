<?php
include '../../koneksi.php';
include '../../query.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_satuan = $_POST['nama_satuan'];
    Query::insert_satuan($conn, $nama_satuan);
    echo "<script>alert('Satuan berhasil ditambahkan'); window.location='satuan.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Satuan</title>
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Tambah Satuan</h1>
    <form method="POST">
        <label for="nama_satuan">Nama Satuan:</label>
        <input type="text" name="nama_satuan" id="nama_satuan" required>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>
