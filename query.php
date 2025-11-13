<?php

class Query {

  public static function read_barang_all($conn) {
    $query = $conn->prepare("SELECT * FROM barang_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_barang_aktif($conn) {
    $query = $conn->prepare("SELECT * FROM barang_aktif_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_margin_all($conn) {
    $query = $conn->prepare("SELECT * FROM margin_penjualan_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_margin_aktif($conn) {
    $query = $conn->prepare("SELECT * FROM margin_penjualan_aktif_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_satuan_all($conn) {
    $query = $conn->prepare("SELECT * FROM satuan_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_satuan_aktif($conn) {
    $query = $conn->prepare("SELECT * FROM satuan_aktif_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_vendor_all($conn) {
    $query = $conn->prepare("SELECT * FROM vendor_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_vendor_aktif($conn) {
    $query = $conn->prepare("SELECT * FROM vendor_aktif_vu");
    $query->execute();
    $result = $query->get_result();
    return $result;
  }

  public static function read_role($conn) {
    $query = $conn->prepare("SELECT * FROM role_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_user($conn) {
    $query = $conn->prepare("SELECT * FROM user_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }



  public static function read_pengadaan($conn) {
    $query = $conn->prepare("SELECT * FROM pengadaan_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_detail_pengadaan($conn, $idpengadaan) {
    $query = $conn->prepare("
      SELECT p.nomor_pengadaan, p.waktu_pengadaan, p.nomor_user, p.nama_user, p.subtotal_pengadaan, p.ppn_pengadaan, p.total_pengadaan, p.nomor_vendor, p.nama_vendor, p.status_pengadaan,
              dp.iddetail_pengadaan, dp.harga_satuan, dp.jumlah, dp.sub_total,
              b.nama, b.jenis, s.nama_satuan
      FROM pengadaan_vu p
      JOIN detail_pengadaan dp ON p.nomor_pengadaan = dp.idpengadaan
      JOIN barang b ON dp.idbarang = b.idbarang
      JOIN satuan s ON b.idsatuan = s.idsatuan
      WHERE p.nomor_pengadaan = ?"
    );
    $query->bind_param("i", $idpengadaan);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function get_barang_by_vendor($conn, $idvendor) {
    $query = $conn->prepare("
      SELECT nomor_barang, nama_barang, harga_barang
      FROM barang_aktif_vu
      WHERE nomor_vendor = ?"
    );
    $query->bind_param("i", $idvendor);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

  public static function insert_pengadaan($conn, $iduser, $idvendor) {
    $stmt = $conn->prepare("INSERT INTO pengadaan (iduser, idvendor) VALUES (?, ?)");
    $stmt->bind_param("ii", $iduser, $idvendor);
    $stmt->execute();
    return true;
  }

  public static function get_last_idpengadaan($conn) {
      $result = $conn->query("SELECT MAX(idpengadaan) AS idpengadaan FROM pengadaan");
      $data = $result->fetch_assoc();
      return $data['idpengadaan'];
  }

  public static function insert_detail_pengadaan($conn, $idpengadaan, $idbarang, $jumlah) {
      $stmt = $conn->prepare("CALL insert_detail_pengadaan(?, ?, ?)");
      $stmt->bind_param("iii", $idpengadaan, $idbarang, $jumlah);
      $stmt->execute();
      return true;
  }

  public static function hitung_value_pengadaan($conn, $idpengadaan) {
      $stmt = $conn->prepare("CALL hitung_value_pengadaan(?)");
      $stmt->bind_param("i", $idpengadaan);
      $stmt->execute();
      return true;
  }



  

}
?>