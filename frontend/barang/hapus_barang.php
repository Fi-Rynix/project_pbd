<?php
include '../../koneksi.php';
include '../../query.php';

$idbarang = $_GET['idbarang'];

Query::soft_delete_barang($conn, $idbarang);

header("Location: barang.php");
exit;
?>
