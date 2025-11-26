<?php
include '../../koneksi.php';
include '../../query.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jenis = $_POST['jenis'];
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $idsatuan = $_POST['idsatuan'];
  $idvendor = $_POST['idvendor'];

  Query::insert_barang($conn, $jenis, $nama, $harga, $idsatuan, $idvendor);

  header("Location: barang.php");
  exit;
}

$satuan = Query::read_satuan_aktif($conn);
$vendor = Query::read_vendor_aktif($conn);
?>

<h2>Tambah Barang</h2>

<form method="POST">
  <label>Jenis Barang:</label>
  <input type="text" name="jenis" required><br>

  <label>Nama Barang:</label>
  <input type="text" name="nama" required><br>

  <label>Harga Barang:</label>
  <input type="number" name="harga" required><br>

  <label>Satuan:</label>
  <select name="idsatuan" required>
    <?php foreach ($satuan as $s) { ?>
      <option value="<?= $s['nomor_satuan']; ?>"><?= $s['nama_satuan']; ?></option>
    <?php } ?>
  </select><br>

  <label>Vendor:</label>
  <select name="idvendor" required>
    <?php foreach ($vendor as $v) { ?>
      <option value="<?= $v['nomor_vendor']; ?>"><?= $v['nama_vendor']; ?></option>
    <?php } ?>
  </select><br>

  <button type="submit">Simpan</button>
</form>
