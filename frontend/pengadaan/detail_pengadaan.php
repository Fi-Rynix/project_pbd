<?php
  include '../../koneksi.php';
  include '../../query.php';

  $idpengadaan = $_GET['idpengadaan'];

  $query = Query::read_detail_pengadaan($conn, $idpengadaan);
  $result_arr = $query->fetch_all(MYSQLI_ASSOC);
?>