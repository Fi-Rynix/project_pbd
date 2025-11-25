<?php
session_start();
include '../../koneksi.php';
include '../../query.php';

$iduser = $_SESSION['user']['id'];
$idpengadaan = $_GET['nomor_pengadaan'];

$barang = Query::get_barang_by_pengadaan($conn, $idpengadaan);

// ==========================================================
// 1. Bentuk stok sementara dari pengadaan (sekali per sesi)
// ==========================================================
if (!isset($_SESSION['stok_penerimaan'][$idpengadaan])) {

    $_SESSION['stok_penerimaan'][$idpengadaan] = [];

    foreach ($barang as $b) {
        $_SESSION['stok_penerimaan'][$idpengadaan][$b['idbarang']] = [
            "nama"   => $b['nama'],
            "jumlah" => $b['jumlah'],        // jumlah yang didapat dari pengadaan
            "satuan" => $b['nama_satuan']
        ];
    }
}

// stok untuk pengadaan ini
$stok = $_SESSION['stok_penerimaan'][$idpengadaan];


// ==========================================================
// 2. Proses simpan penerimaan → kurangi stok session
// ==========================================================
if (isset($_POST['simpan_penerimaan'])) {

    $conn->begin_transaction();

    $tempStok = $_SESSION['stok_penerimaan'][$idpengadaan];

    try {
        if (!Query::insert_penerimaan($conn, $iduser, $idpengadaan)) {
            throw new Exception("Insert penerimaan gagal");
        }

        foreach ($_POST['idbarang'] as $i => $idbarang) {
            $jumlah_terima = (int) $_POST['jumlah'][$i];
            $harga_satuan  = (int) $_POST['harga'][$i];

            $tempStok[$idbarang]['jumlah'] -= $jumlah_terima;
            if ($tempStok[$idbarang]['jumlah'] < 0) {
                $tempStok[$idbarang]['jumlah'] = 0;
            }

            $result = Query::insert_detail_penerimaan($conn, $idbarang, $jumlah_terima, $harga_satuan);

            if ($result !== true) {
                throw new Exception($result);
            }
        }

        $conn->commit();

        $_SESSION['stok_penerimaan'][$idpengadaan] = $tempStok;

        header("Location: rincian_penerimaan.php?nomor_pengadaan=$idpengadaan");
        exit;

    } catch (Exception $e) {

        echo "<script>alert('".$e->getMessage()."'); history.back();</script>";
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

<h2>Tambah Penerimaan Barang</h2>

<form method="POST">

    <div id="barang-container">

        <div class="barang-row">
            <label>Barang:</label>
            <select name="idbarang[]" class="barang-select" required onchange="updateDropdowns()">
                <option value="">-- Pilih Barang --</option>

                <?php foreach ($stok as $idb => $s): ?>
                    <?php if ($s['jumlah'] > 0): ?>
                        <option value="<?= $idb ?>">
                            <?= $s['nama'] ?> — (Sisa: <?= $s['jumlah'] . ' ' . $s['satuan'] ?>)
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>

            </select>

            <label>Jumlah:</label>
            <input type="number" name="jumlah[]" min="1" required>

            <label>Harga: Rp.</label>
            <input type="number" name="harga[]" min="0" required>

            <button type="button" onclick="hapusRow(this)">Hapus</button>
        </div>

    </div>

    <button type="button" onclick="tambahRow()">+ Tambah Barang</button>
    <br><br>

    <button type="submit" name="simpan_penerimaan">Simpan Penerimaan</button>
</form>


<script>
// =========================================
// Duplikasi row
// =========================================
function tambahRow() {
    const container = document.getElementById('barang-container');
    const firstRow = container.children[0];
    const newRow = firstRow.cloneNode(true);

    // reset nilai
    newRow.querySelectorAll('input').forEach(el => el.value = '');
    newRow.querySelectorAll('select').forEach(el => el.selectedIndex = 0);

    container.appendChild(newRow);

    updateDropdowns();
}

// =========================================
// Hapus row
// =========================================
function hapusRow(btn) {
    const container = document.getElementById('barang-container');
    if (container.children.length > 1) {
        btn.parentElement.remove();
        updateDropdowns();
    } else {
        alert('Minimal 1 baris barang harus ada.');
    }
}

// =========================================
// Cegah barang yang sama dipilih 2 kali
// =========================================
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
</script>

</body>
</html>
