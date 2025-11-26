<?php
include '../../koneksi.php';
include '../../query.php';

if(!isset($_GET['idsatuan'])){
    echo "<script>alert('Satuan tidak ditemukan'); window.location='satuan.php';</script>";
    exit;
}

$idsatuan = $_GET['idsatuan'];

$satuan_list = Query::read_satuan_all($conn);
$current_satuan = null;
foreach($satuan_list as $s){
    if($s['nomor_satuan'] == $idsatuan){
        $current_satuan = $s;
        break;
    }
}

if(!$current_satuan){
    echo "<script>alert('Satuan tidak ditemukan'); window.location='satuan.php';</script>";
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama_satuan = $_POST['nama_satuan'];
    Query::update_satuan($conn, $idsatuan, $nama_satuan);
    echo "<script>alert('Satuan berhasil diupdate'); window.location='satuan.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Satuan</title>
</head>
<body>
    <?php include '../Navbar/navbar.php'; ?>
    <h1>Edit Satuan</h1>
    <form method="POST">
        <label for="nama_satuan">Nama Satuan:</label>
        <input type="text" name="nama_satuan" id="nama_satuan" value="<?php echo $current_satuan['nama_satuan']; ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
