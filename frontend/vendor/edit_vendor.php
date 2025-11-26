<?php
include '../../koneksi.php';
include '../../query.php';

if(!isset($_GET['idvendor'])){
    echo "<script>alert('Vendor tidak ditemukan'); window.location='vendor.php';</script>";
    exit;
}

$idvendor = $_GET['idvendor'];

// Ambil data vendor
$vendor_list = Query::read_vendor_all($conn);
$current_vendor = null;
foreach($vendor_list as $v){
    if($v['nomor_vendor'] == $idvendor){
        $current_vendor = $v;
        break;
    }
}

if(!$current_vendor){
    echo "<script>alert('Vendor tidak ditemukan'); window.location='vendor.php';</script>";
    exit;
}

// Handle form submit
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama_vendor = $_POST['nama_vendor'];
    $badan_hukum = isset($_POST['badan_hukum']) ? 'Y' : 'N';
    Query::update_vendor($conn, $idvendor, $nama_vendor, $badan_hukum);
    echo "<script>alert('Vendor berhasil diupdate'); window.location='vendor.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Vendor</title>
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Edit Vendor</h1>
    <form method="POST">
        <label for="nama_vendor">Nama Vendor:</label>
        <input type="text" name="nama_vendor" id="nama_vendor" value="<?php echo $current_vendor['nama_vendor']; ?>" required><br><br>

        <label for="badan_hukum">Badan Hukum:</label>
        <input type="checkbox" name="badan_hukum" id="badan_hukum" value="Y" <?php echo $current_vendor['badan_hukum'] === 'Y' ? 'checked' : ''; ?>><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
