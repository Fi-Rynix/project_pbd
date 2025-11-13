<?php
session_start();
include '../../koneksi.php';
include '../../query.php';

$iduser = $_SESSION['user']['id'];

$vendor_list = Query::read_vendor_aktif($conn);

$idvendor = $_POST['idvendor'] ?? null;
$idpengadaan = null;
$barang = [];

if (!empty($idvendor)) {
    $barang = Query::get_barang_by_vendor($conn, $idvendor);
}


if (isset($_POST['simpan_pengadaan'])) {
    $idvendor = $_POST['idvendor'];
    $idbarangArr = $_POST['idbarang'] ?? [];
    $jumlahArr = $_POST['jumlah'] ?? [];

    if (!$idvendor) {
        die("Vendor belum dipilih!");
    }


    if (Query::insert_pengadaan($conn, $iduser, $idvendor)) {
        $idpengadaan = Query::get_last_idpengadaan($conn);

        for ($i = 0; $i < count($idbarangArr); $i++) {
            $idbarang = $idbarangArr[$i];
            $jumlah = $jumlahArr[$i];
            if (!empty($idbarang) && !empty($jumlah)) {
                Query::insert_detail_pengadaan($conn, $idpengadaan, $idbarang, $jumlah);
            }
        }

        Query::hitung_value_pengadaan($conn, $idpengadaan);

        header("Location: pengadaan.php");
        exit;
    } else {
        echo "Gagal insert pengadaan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengadaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        select, input { margin-right: 10px; padding: 6px; }
        .barang-row { margin-bottom: 10px; }
        button { padding: 6px 10px; }
    </style>
</head>
<body>
    <?php include '../navbar/navbar.php'; ?>

    <h2>Tambah Pengadaan Baru</h2>

    <form method="POST">
        <label>Vendor:</label>
        <select name="idvendor" required onchange="this.form.submit()">
            <option value="">-- Pilih Vendor --</option>
            <?php
            $vendor_list->data_seek(0);
            while ($v = $vendor_list->fetch_assoc()) {
                $sel = ($idvendor == $v['nomor_vendor']) ? 'selected' : '';
                echo "<option value='{$v['nomor_vendor']}' $sel>{$v['nama_vendor']}</option>";
            }
            ?>
        </select>
        <noscript><button type="submit">Tampilkan Barang</button></noscript>
    </form>

<?php if (!empty($idvendor) && count($barang) > 0): ?>
        <h3>Daftar Barang</h3>
        <form method="POST">
            <input type="hidden" name="idvendor" value="<?= htmlspecialchars($idvendor) ?>">

            <div id="barang-container">
                <div class="barang-row">
                    <label>Barang:</label>
                    <select name="idbarang[]" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php foreach ($barang as $b): ?>
                            <option value="<?= $b['nomor_barang'] ?>">
                                <?= $b['nama_barang'] ?> - Rp<?= $b['harga_barang'] ?>
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
            <button type="submit" name="simpan_pengadaan">Simpan Pengadaan</button>
        </form>
    <?php elseif (!empty($idvendor)): ?>
        <p><i>Tidak ada barang aktif untuk vendor ini.</i></p>
    <?php endif; ?>

    <script>
    function tambahRow() {
        const container = document.getElementById('barang-container');
        const firstRow = container.children[0];
        const newRow = firstRow.cloneNode(true);

        newRow.querySelectorAll('input').forEach(el => el.value = '');
        newRow.querySelectorAll('select').forEach(el => el.selectedIndex = 0);
        container.appendChild(newRow);
    }

    function hapusRow(btn) {
        const container = document.getElementById('barang-container');
        if (container.children.length > 1) {
            btn.parentElement.remove();
        } else {
            alert('Minimal 1 baris barang harus ada.');
        }
    }
    </script>
</body>
</html>