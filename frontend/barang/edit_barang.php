<?php
include '../../koneksi.php';
include '../../query.php';

$idbarang = $_GET['idbarang'];

$barang = Query::read_barang_all($conn);
$data = null;

foreach ($barang as $b) {
  if ($b['nomor_barang'] == $idbarang) {
    $data = $b;
    break;
  }
}

if (!$data) {
  echo "Barang tidak ditemukan!";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jenis = $_POST['jenis'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $idsatuan = $_POST['idsatuan'];
  $idvendor = $_POST['idvendor'];

  Query::update_barang($conn, $idbarang, $jenis, $nama, $harga, $idsatuan, $idvendor);

  header("Location: barang.php");
  exit;
}

$satuan = Query::read_satuan_aktif($conn);
$vendor = Query::read_vendor_aktif($conn);
?>

<h2>Edit Barang</h2>

<form method="POST">
  <label>Jenis Barang:</label>
  <input type="text" name="jenis" value="<?= $data['jenis_barang']; ?>" required><br>

  <label>Nama Barang:</label>
  <input type="text" name="nama" value="<?= $data['nama_barang']; ?>" required><br>

  <label>Harga Barang:</label>
  <input type="number" name="harga" value="<?= $data['harga_barang']; ?>" required><br>

  <label>Satuan:</label>
  <select name="idsatuan">
    <?php foreach ($satuan as $s) { ?>
      <option value="<?= $s['idsatuan']; ?>" <?= $s['nama_satuan'] == $data['nama_satuan'] ? 'selected' : ''; ?>>
        <?= $s['nama_satuan']; ?>
      </option>
    <?php } ?>
  </select><br>

  <label>Vendor:</label>
  <select name="idvendor">
    <?php foreach ($vendor as $v) { ?>
      <option value="<?= $v['idvendor']; ?>" <?= $v['nama_vendor'] == $data['nama_vendor'] ? 'selected' : ''; ?>>
        <?= $v['nama_vendor']; ?>
      </option>
    <?php } ?>
  </select><br>

  <button type="submit">Update</button>
</form>
