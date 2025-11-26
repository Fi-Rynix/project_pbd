<?php
include '../../koneksi.php';
include '../../query.php';

if(!isset($_GET['idsatuan'])){
    echo "<script>alert('Satuan tidak ditemukan'); window.location='satuan.php';</script>";
    exit;
}

$idsatuan = $_GET['idsatuan'];
Query::soft_delete_satuan($conn, $idsatuan);
echo "<script>alert('Satuan berhasil dihapus'); window.location='satuan.php';</script>";
