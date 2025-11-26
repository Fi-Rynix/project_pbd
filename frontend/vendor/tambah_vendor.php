<?php
include '../../koneksi.php';
include '../../query.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_vendor = $_POST['nama_vendor'];
    $badan_hukum = isset($_POST['badan_hukum']) ? 'Y' : 'N';
    Query::insert_vendor($conn, $nama_vendor, $badan_hukum);
    echo "<script>alert('Vendor berhasil ditambahkan'); window.location='vendor.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Vendor</title>
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Tambah Vendor</h1>
    <form method="POST">
        <label for="nama_vendor">Nama Vendor:</label>
        <input type="text" name="nama_vendor" id="nama_vendor" required><br><br>

        <label for="badan_hukum">Badan Hukum:</label>
        <input type="checkbox" name="badan_hukum" id="badan_hukum" value="Y"><br><br>

        <button type="submit">Tambah</button>
    </form>
</body>
</html>
