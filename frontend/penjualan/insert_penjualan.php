<?php
session_start();
include '../../koneksi.php';
include '../../query.php';

$iduser = $_SESSION['user']['id'];

$margin_aktif = Query::get_id_margin_aktif($conn);
$idmargin = $margin_aktif;

$barang = Query::get_barang_from_stok_tambah_margin($conn);

if (isset($_POST['simpan_penjualan'])) {

    $idbarangArr = $_POST['idbarang'] ?? [];
    $jumlahArr   = $_POST['jumlah'] ?? [];

    $conn->begin_transaction();

    try {

        if (!Query::insert_penjualan($conn, $iduser, $idmargin)) {
            throw new Exception("Gagal membuat penjualan.");
        }

        for ($i = 0; $i < count($idbarangArr); $i++) {

            $idbarang = $idbarangArr[$i];
            $jumlah   = $jumlahArr[$i];

            if (!empty($idbarang) && !empty($jumlah)) {

                $result = Query::insert_detail_penjualan($conn, $idbarang, $jumlah);

                if ($result !== true) {
                    throw new Exception($result);
                }
            }
        }

        Query::hitung_value_penjualan($conn);

        $conn->commit();

        header("Location: penjualan.php");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Gagal: " . addslashes($e->getMessage()) . "'); history.back();</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Penjualan</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        background-color: #f5f7fa;
        color: #2c3e50;
        line-height: 1.6;
        margin: 0;
        padding: 0;
      }

      .container {
        padding: 24px;
        max-width: 100%;
      }

      h2 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 24px;
        margin-top: 16px;
        color: #1a252f;
      }

      .button-group {
        margin-bottom: 16px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
      }

      a {
        color: white;
        text-decoration: none;
        font-weight: 500;
      }

      a.btn-kembali {
        background-color: #1436a3;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
      }

      a.btn-kembali:hover {
        background-color: #0d2a7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 54, 163, 0.2);
      }

      form {
        background: white;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        max-width: 1000px;
      }

      .barang-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 12px;
        margin-bottom: 16px;
        padding: 16px;
        background-color: #f8fafc;
        border-radius: 6px;
        border: 1px solid #ecf0f1;
        align-items: end;
      }

      label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #1436a3;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      select, input {
        padding: 10px 12px;
        border: 1px solid #d0d7e0;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        transition: all 0.2s ease;
        width: 100%;
      }

      select:focus, input:focus {
        outline: none;
        border-color: #1436a3;
        box-shadow: 0 0 0 3px rgba(20, 54, 163, 0.1);
        background-color: white;
      }

      button {
        padding: 10px 18px;
        background-color: #1436a3;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
      }

      button:hover {
        background-color: #0d2a7a;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(20, 54, 163, 0.2);
      }

      button[type="button"] {
        background-color: #7f8c8d;
      }

      button[type="button"]:hover {
        background-color: #5d6d7b;
      }

      button[type="button"].hapus {
        background-color: #e74c3c;
        padding: 10px 18px;
        font-size: 14px;
      }

      button[type="button"].hapus:hover {
        background-color: #c0392b;
      }

      .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 24px;
        padding-top: 24px;
        border-top: 2px solid #ecf0f1;
      }

      #barang-container {
        margin-bottom: 16px;
      }

      @media (max-width: 1024px) {
        .barang-row {
          grid-template-columns: 1fr 1fr;
        }

        label {
          grid-column: 1 / -1;
          margin-bottom: 0;
        }
      }

      @media (max-width: 768px) {
        .container {
          padding: 16px;
        }

        h2 {
          font-size: 20px;
          margin-bottom: 16px;
        }

        form {
          padding: 16px;
        }

        .barang-row {
          grid-template-columns: 1fr;
          gap: 12px;
          padding: 12px;
        }

        .form-actions {
          flex-direction: column;
        }

        button, a.btn-kembali {
          width: 100%;
          text-align: center;
        }
      }
    </style>
</head>
<body>

<?php include '../navbar/navbar.php'; ?>
<div class="container">
  <div class="button-group">
    <a href="penjualan.php" class="btn-kembali">← Kembali</a>
  </div>

  <h2>Tambah Penjualan Barang</h2>

  <form method="POST">

      <div id="barang-container">

          <div class="barang-row">
              <div>
                <label>Barang</label>
                <select name="idbarang[]" class="barang-select" required onchange="updateDropdowns()">
                    <option value="">-- Pilih Barang --</option>
                      <?php foreach ($barang as $b): ?>
                        <option value="<?= $b['nomor_barang'] ?>">
                          <?= $b['nama_barang'] ?> - Rp<?= $b['harga_jual'] ?> || Stok: <?= $b['stock_terakhir'] ?>
                        </option>
                      <?php endforeach; ?>
                </select>
              </div>

              <div>
                <label>Jumlah</label>
                <input type="number" name="jumlah[]" min="1" required>
              </div>

              <button type="button" onclick="hapusRow(this)" class="hapus">Hapus</button>
          </div>

      </div>

      <button type="button" onclick="tambahRow()">+ Tambah Barang</button>

      <div class="form-actions">
        <button type="submit" name="simpan_penjualan">Simpan Penjualan</button>
      </div>
  </form>
</div>


<script>

function tambahRow() {
    const container = document.getElementById('barang-container');
    const firstRow = container.children[0];
    const newRow = firstRow.cloneNode(true);

    newRow.querySelectorAll('input').forEach(el => el.value = '');
    newRow.querySelectorAll('select').forEach(el => el.selectedIndex = 0);

    container.appendChild(newRow);

    updateDropdowns();
}

function hapusRow(btn) {
    const container = document.getElementById('barang-container');
    if (container.children.length > 1) {
        btn.parentElement.remove();
        updateDropdowns();
    } else {
        alert('Minimal 1 baris barang harus ada.');
    }
}

function updateDropdowns() {
    const selects = document.querySelectorAll('.barang-select');

    const selectedValues = Array.from(selects)
        .map(s => s.value)
        .filter(v => v !== "");

    selects.forEach(select => {
        const currentValue = select.value;

        Array.from(select.options).forEach(opt => {
            if (opt.value === "") return;

            opt.style.display = "block";

            if (selectedValues.includes(opt.value) && opt.value !== currentValue) {
                opt.style.display = "none";
            }
        });
    });
}

document.addEventListener("change", function(e) {
    if (e.target.classList.contains('barang-select')) {

        const row = e.target.closest('.barang-row');
        const hargaInput = row.querySelector('input[name="harga[]"]');
        const selectedOption = e.target.options[e.target.selectedIndex];

        const harga = selectedOption.getAttribute("data-harga") || 0;
        hargaInput.value = harga;
    }
});


</script>

</body>
</html>
