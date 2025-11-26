<?php
require_once '../../koneksi.php';
require_once '../../query.php';

$data = Query::read_kartu_stok($conn);

// Kelompokkan data berdasarkan barang
$grouped = [];
foreach ($data as $row) {
    $grouped[$row['nama']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Kartu Stok</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<?php include '../Navbar/navbar.php'; ?>
<h1>Kartu Stok</h1>

<table>
    <tr>
        <th>Nomor</th>
        <th>Nama Barang</th>
        <th>Jenis</th>
        <th>Satuan</th>
        <th>Total Stock</th>
        <th>Waktu Transaksi</th>
        <th>Jenis Transaksi</th>
        <th>ID Transaksi</th>
        <th>Masuk</th>
        <th>Keluar</th>
    </tr>

    <?php
    $no = 1;

    foreach ($grouped as $barang => $rows):

        $rowspan = count($rows);  // jumlah transaksi per barang
        $first = true;            // penanda baris pertama
        $total_stock = end($rows)['stock']; // stock terakhir sebagai total
    ?>

        <?php foreach ($rows as $row): ?>
            <tr>
                <?php if ($first): ?>
                    <td rowspan="<?= $rowspan ?>"><?= $no++; ?></td>
                    <td rowspan="<?= $rowspan ?>"><?= $row['nama']; ?></td>
                    <td rowspan="<?= $rowspan ?>"><?= $row['jenis']; ?></td>
                    <td rowspan="<?= $rowspan ?>"><?= $row['nama_satuan']; ?></td>
                    <td rowspan="<?= $rowspan ?>"><?= $total_stock; ?></td>
                <?php $first = false; endif; ?>

                <td><?= $row['created_at']; ?></td>
                <td><?= $row['jenis_transaksi']; ?></td>
                <td><?= $row['idtransaksi']; ?></td>
                <td><?= $row['masuk']; ?></td>
                <td><?= $row['keluar']; ?></td>
            </tr>
        <?php endforeach; ?>

    <?php endforeach; ?>

</table>

</body>
</html>
