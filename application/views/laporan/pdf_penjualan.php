<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: calibri;
        }
    </style>
</head><body>
    <h2 align="center">Laporan Penjualan Dari Tanggal <?= $tgl_awal ?> Sampai Tanggal <?= $tgl_akhir ?></h2>
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th>No.</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Jual</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Keuntungan</th>
        </tr>
        <?php $no = 1;

        $totalpenjualan = 0;
        $totalprofit = 0;
        foreach ($rows as $row) : ?>
            <?php $profit2 = $row->profit * $row->jumlah; ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->kode_barang; ?></td>
                <td><?= $row->nama; ?></td>
                <td>Rp. <?= number_format($row->harga_jual, 0, ',', '.'); ?></td>
                <td><?= $row->jumlah; ?></td>
                <td>Rp. <?= number_format($row->total, 0, ',', '.'); ?></td>
                <td>Rp. <?= number_format($profit2, 0, ',', '.'); ?></td>
            </tr>
        <?php
            $totalpenjualan += $row->total;
            $totalprofit += $row->profit * $row->jumlah;
        endforeach; ?>
        <tr>
            <th colspan="5" align="right">Total Penjualan dan Keuntungan</th>
            <th align="left">Rp. <?= number_format($totalpenjualan, 0, ',', '.'); ?></th>
            <th align="left">Rp. <?= number_format($totalprofit, 0, ',', '.'); ?></th>
        </tr>
    </table>

</body></html>