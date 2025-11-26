<?php
include '../../koneksi.php';
include '../../query.php';

if(!isset($_GET['idvendor'])){
    echo "<script>alert('Vendor tidak ditemukan'); window.location='vendor.php';</script>";
    exit;
}

$idvendor = $_GET['idvendor'];
Query::soft_delete_vendor($conn, $idvendor);
echo "<script>alert('Vendor berhasil dihapus'); window.location='vendor.php';</script>";
?>