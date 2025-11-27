<?php
include '../../../koneksi.php';
include '../../../query.php';

if (!isset($_GET['nomor_pengadaan'])) {
    echo "<script>alert('ID Pengadaan tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

$idpengadaan = $_GET['nomor_pengadaan'];

$result = Query::batalkan_pengadaan($conn, $idpengadaan);

if ($result) {
    echo "<script>
            alert('Pengadaan berhasil dibatalkan!');
            window.location='penerimaan.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal membatalkan pengadaan!');
            window.location='penerimaan.php';
          </script>";
}
