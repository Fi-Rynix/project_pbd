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
    <title>Tambah Penerimaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        select, input { margin-right: 10px; padding: 6px; }
        .barang-row { margin-bottom: 10px; }
        button { padding: 6px 10px; }
    </style>
</head>
<body>

<?php include '../navbar/navbar.php'; ?>
<button><a href="penjualan.php">Kembali</a></button>
<h2>Tambah Penerimaan Barang</h2>

<form method="POST">

    <div id="barang-container">

        <div class="barang-row">
            <label>Barang:</label>
            <select name="idbarang[]" class="barang-select" required onchange="updateDropdowns()">
                <option value="">-- Pilih Barang --</option>
                  <?php foreach ($barang as $b): ?>
                    <option value="<?= $b['nomor_barang'] ?>">
                      <?= $b['nama_barang'] ?> - Rp<?= $b['harga_jual'] ?> || Stok: <?= $b['stock_terakhir'] ?>
                    </option>
                  <?php endforeach; ?>
            </select>

            <label>Jumlah:</label>
            <input type="number" name="jumlah[]" min="1" required>

            <button type="button" onclick="hapusRow(this)">Hapus</button>
        </div>

    </div>

    <button type="button" onclick="tambahRow()">+ Tambah Barang</button>
    <br><br>

    <button type="submit" name="simpan_penjualan">Simpan Penjualan</button>
</form>


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
