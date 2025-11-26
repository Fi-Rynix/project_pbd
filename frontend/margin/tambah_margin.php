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
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Tambah Margin Penjualan</h1>
    <form method="POST">
        <label for="persentase">Besaran Persen:</label>
        <input type="number" step="0.01" name="persentase" id="persentase" required><br><br>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>
