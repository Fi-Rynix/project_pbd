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
  public static function insert_barang($conn, $jenis, $nama, $harga, $idsatuan, $idvendor) {
    $stmt = $conn->prepare(
      "INSERT INTO barang (jenis, nama, harga, idsatuan, idvendor, status)
      VALUES (?, ?, ?, ?, ?, 1)"
    );
    $stmt->bind_param("ssiii", $jenis, $nama, $harga, $idsatuan, $idvendor);
    $stmt->execute();
    return true;
  }

  public static function update_barang($conn, $idbarang, $jenis, $nama, $harga, $idsatuan, $idvendor) {
    $stmt = $conn->prepare(
      "UPDATE barang
      SET jenis = ?, nama = ?, harga = ?, idsatuan = ?, idvendor = ?
      WHERE idbarang = ?"
    );
    $stmt->bind_param("ssiiii", $jenis, $nama, $harga, $idsatuan, $idvendor, $idbarang);
    $stmt->execute();
    return true;
  }

  public static function soft_delete_barang($conn, $idbarang) {
    $stmt = $conn->prepare(
      "UPDATE barang
      SET status = 0
      WHERE idbarang = ?"
    );
    $stmt->bind_param("i", $idbarang);
    $stmt->execute();
    return true;
  }

  public static function insert_user($conn, $username, $password, $idrole) {
    $stmt = $conn->prepare("INSERT INTO user (username, password, idrole) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $username, $password, $idrole);
    $stmt->execute();
    return true;
  }

  public static function update_user($conn, $iduser, $username, $password, $idrole) {
      $stmt = $conn->prepare(
        "UPDATE user
        SET username = ?, password = ?, idrole = ?
        WHERE iduser = ?"
      );
      $stmt->bind_param("ssii", $username, $password, $idrole, $iduser);
      $stmt->execute();
      return true;
  }

  public static function insert_satuan($conn, $nama_satuan) {
      $stmt = $conn->prepare(
          "INSERT INTO satuan (nama_satuan, status) VALUES (?, 1)"
      );
      $stmt->bind_param("s", $nama_satuan);
      $stmt->execute();
      return true;
  }

  public static function update_satuan($conn, $idsatuan, $nama_satuan) {
      $stmt = $conn->prepare(
          "UPDATE satuan SET nama_satuan = ? WHERE idsatuan = ?"
      );
      $stmt->bind_param("si", $nama_satuan, $idsatuan);
      $stmt->execute();
      return true;
  }

  public static function soft_delete_satuan($conn, $idsatuan) {
      $stmt = $conn->prepare(
          "UPDATE satuan SET status = 0 WHERE idsatuan = ?"
      );
      $stmt->bind_param("i", $idsatuan);
      $stmt->execute();
      return true;
  }

  public static function insert_vendor($conn, $nama_vendor, $badan_hukum) {
      $stmt = $conn->prepare(
          "INSERT INTO vendor (nama_vendor, badan_hukum, status) VALUES (?, ?, 1)"
      );
      $stmt->bind_param("ss", $nama_vendor, $badan_hukum);
      $stmt->execute();
      return true;
  }

  public static function update_vendor($conn, $idvendor, $nama_vendor, $badan_hukum) {
      $stmt = $conn->prepare(
          "UPDATE vendor SET nama_vendor = ?, badan_hukum = ? WHERE idvendor = ?"
      );
      $stmt->bind_param("ssi", $nama_vendor, $badan_hukum, $idvendor);
      $stmt->execute();
      return true;
  }

  public static function soft_delete_vendor($conn, $idvendor) {
      $stmt = $conn->prepare(
          "UPDATE vendor SET status = 0 WHERE idvendor = ?"
      );
      $stmt->bind_param("i", $idvendor);
      $stmt->execute();
      return true;
  }

  public static function insert_margin($conn, $persentase, $iduser) {
    $stmt = $conn->prepare(
        "INSERT INTO margin_penjualan (persen, status, iduser, created_at) VALUES (?, 0, ?, NOW())"
    );
    $stmt->bind_param("di", $persentase, $iduser);
    $stmt->execute();
    return true;
}

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

  public static function batalkan_pengadaan($conn, $idpengadaan) {
    $stmt = $conn->prepare(
      "UPDATE pengadaan
      SET status = 'B'
      WHERE idpengadaan = ?"
    );
    $stmt->bind_param("i", $idpengadaan);
    $stmt->execute();
    return true;
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

  public static function read_detail_penerimaan($conn, $idpenerimaan) {
    $query = $conn->prepare(
      "SELECT pr.nomor_penerimaan, pr.waktu_penerimaan, pr.nomor_user, pr.nama_user, pr.status_penerimaan,
              dpr.iddetail_penerimaan, dpr.harga_satuan_terima AS harga_terima, dpr.jumlah_terima, dpr.sub_total_terima,
              b.nama, b.jenis, s.nama_satuan,
              dp.harga_satuan AS harga_pesan, dp.jumlah AS jumlah_pesan, dp.sub_total AS sub_total_pesan
      FROM penerimaan_vu pr
      JOIN detail_penerimaan dpr ON pr.nomor_penerimaan = dpr.idpenerimaan
      JOIN barang b ON dpr.idbarang = b.idbarang
      JOIN satuan s ON b.idsatuan = s.idsatuan
      JOIN detail_pengadaan dp ON dpr.idbarang = dp.idbarang AND dp.idpengadaan = pr.nomor_pengadaan
      WHERE pr.nomor_penerimaan = ?"
    );

    $query->bind_param("i", $idpenerimaan);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
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

  public static function read_detail_penjualan($conn, $idpenjualan) {
    $query = $conn->prepare(
      "SELECT pj.nomor_penjualan, pj.waktu_penjualan, pj.nomor_user, pj.nama_user, pj.subtotal_penjualan, pj.ppn_penjualan, pj.total_penjualan,
              dp.iddetail_penjualan, dp.harga_satuan, dp.jumlah, dp.sub_total,
              b.nama, b.jenis, s.nama_satuan,
              m.persen
      FROM penjualan_vu pj
      JOIN detail_penjualan dp ON pj.nomor_penjualan = dp.idpenjualan
      JOIN barang b ON dp.idbarang = b.idbarang
      JOIN satuan s ON b.idsatuan = s.idsatuan
      JOIN margin_penjualan m ON pj.nomor_margin = m.idmargin_penjualan
      WHERE pj.nomor_penjualan = ?"
    );
    $query->bind_param("i", $idpenjualan);
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }


// kartu stok
// kartu stok
// kartu stok
  public static function read_kartu_stok($conn) {
    $query = $conn->prepare(
      "SELECT b.nama, b.jenis, s.nama_satuan,
              ks.created_at, ks.jenis_transaksi, ks.masuk, ks.keluar, ks.stock, ks.idtransaksi
      FROM kartu_stok ks
      JOIN barang b ON ks.idbarang = b.idbarang
      JOIN satuan s ON b.idsatuan = s.idsatuan
      ");
    $query->execute();
    $result = $query->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
?>