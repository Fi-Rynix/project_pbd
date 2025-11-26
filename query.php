<?php

class Query {


// tabel master
// tabel master
// tabel master
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
    return $result->fetch_all(MYSQLI_ASSOC);
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


// crud
// crud
// crud
  public static function aktifkan_margin($conn, $idmargin) {
    $stmt = $conn->prepare("CALL aktifkan_margin(?)");
    $stmt->bind_param("i", $idmargin);
    $stmt->execute();
    return true;
  }



// pengadaan
// pengadaan
// pengadaan
  public static function read_pengadaan($conn) {
    $query = $conn->prepare("SELECT * FROM pengadaan_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_detail_pengadaan($conn, $idpengadaan) {
    $query = $conn->prepare(
      "SELECT p.nomor_pengadaan, p.waktu_pengadaan, p.nomor_user, p.nama_user, p.subtotal_pengadaan, p.ppn_pengadaan, p.total_pengadaan, p.nomor_vendor, p.nama_vendor, p.status_pengadaan,
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

  // public static function get_last_idpengadaan($conn) {
  //   $result = $conn->query("SELECT MAX(idpengadaan) AS idpengadaan FROM pengadaan");
  //   $data = $result->fetch_assoc();
  //   return $data['idpengadaan'];
  // }

  public static function insert_detail_pengadaan($conn, $idbarang, $jumlah) {
    $stmt = $conn->prepare("CALL insert_detail_pengadaan(?, ?)");
    $stmt->bind_param("ii", $idbarang, $jumlah);
    $stmt->execute();
    return true;
  }

  public static function hitung_value_pengadaan($conn) {
    $stmt = $conn->prepare("CALL hitung_value_pengadaan()");
    $stmt->execute();
    return true;
  }



// penerimaan
// penerimaan
// penerimaan
  public static function read_pengadaan_aktif($conn) {
    $query = $conn->prepare("SELECT * FROM pengadaan_vu WHERE status_pengadaan = 'M'");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_pengadaan_proses($conn) {
    $query = $conn->prepare("SELECT * FROM pengadaan_vu WHERE status_pengadaan = 'P'");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_pengadaan_selesai($conn) {
    $query = $conn->prepare("SELECT * FROM pengadaan_vu WHERE status_pengadaan = 'S'");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function read_penerimaan_by_pengadaan($conn, $idpengadaan) {
    $query = $conn->prepare("SELECT * FROM penerimaan_vu WHERE nomor_pengadaan = ?"
    );
    $query->bind_param("i", $idpengadaan);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function get_barang_by_pengadaan($conn, $idpengadaan) {
    $query = $conn->prepare(
      "SELECT dp.idbarang, b.nama, dp.harga_satuan, s.nama_satuan, dp.jumlah
      FROM detail_pengadaan dp
      JOIN barang b ON dp.idbarang = b.idbarang
      JOIN satuan s ON b.idsatuan = s.idsatuan
      WHERE dp.idpengadaan = ?"
    );
    $query->bind_param("i", $idpengadaan);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function insert_penerimaan($conn, $iduser, $idpengadaan) {
    $stmt = $conn->prepare("INSERT INTO penerimaan (iduser, idpengadaan) VALUES (?, ?)");
    $stmt->bind_param("ii", $iduser, $idpengadaan);
    $stmt->execute();
    return true;
  }

  public static function insert_detail_penerimaan($conn, $idbarang, $jumlah_terima, $harga_satuan) {
    try {
        $stmt = $conn->prepare("CALL insert_detail_penerimaan(?, ?, ?)");
        $stmt->bind_param("iii", $idbarang, $jumlah_terima, $harga_satuan);
        $stmt->execute();
        return true;
    } catch (mysqli_sql_exception $e) {
        return $e->getMessage();
    }
}







// penjualan
// penjualan
// penjualan
  public static function read_penjualan($conn) {
    $query = $conn->prepare("SELECT * FROM penjualan_vu");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function get_id_margin_aktif($conn) {
    $query = $conn->prepare("SELECT nomor_margin FROM margin_penjualan_aktif_vu LIMIT 1");
    $query->execute();
    $result = $query->get_result();
    $data = $result->fetch_assoc();
    return $data['nomor_margin'];
  }

  public static function get_barang_from_stok_tambah_margin($conn) {
    $query = $conn->prepare(
      "SELECT b.nomor_barang, b.nama_barang,
              b.harga_barang + (b.harga_barang * (SELECT persentase_margin / 100 FROM margin_penjualan_aktif_vu LIMIT 1)) AS harga_jual,
              (SELECT ks.stock
              FROM kartu_stok ks
              WHERE ks.idkartu_stok = (SELECT MAX(idkartu_stok)
                                      FROM kartu_stok
                                      WHERE idbarang = b.nomor_barang)) AS stock_terakhir
      FROM barang_aktif_vu b
      WHERE (SELECT ks.stock
            FROM kartu_stok ks
            WHERE ks.idkartu_stok = (SELECT MAX(idkartu_stok)
                                    FROM kartu_stok
                                    WHERE idbarang = b.nomor_barang)) > 0
      GROUP BY b.nomor_barang, b.nama_barang, harga_jual;
      ");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public static function insert_penjualan($conn, $iduser, $idmargin) {
    $stmt = $conn->prepare("INSERT INTO penjualan (iduser, idmargin_penjualan) VALUES (?, ?)");
    $stmt->bind_param("ii", $iduser, $idmargin);
    $stmt->execute();
    return true;
  }

  public static function insert_detail_penjualan($conn, $idbarang, $jumlah) {
    $stmt = $conn->prepare("CALL insert_detail_penjualan(?, ?)");
    $stmt->bind_param("ii", $idbarang, $jumlah);
    $stmt->execute();
    return true;
  }

  public static function hitung_value_penjualan($conn) {
    $stmt = $conn->prepare("CALL hitung_value_penjualan()");
    $stmt->execute();
    return true;
  }

}
?>