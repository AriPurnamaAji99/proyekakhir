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
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th>No.</th>
            <th>Kode Barang</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
        <?php $no = 1;

        $totalpenjualan = 0;
        $totalprofit = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->kode_barang; ?></td>
                <td><?= $row->jumlah; ?></td>
                <td>Rp. <?= number_format($row->total, 0, ',', '.'); ?></td>
            </tr>
        <?php
            $totalpenjualan += $row->total;
        endforeach; ?>
        <tr>
            <th colspan="3" align="right">Total Penjualan dan Keuntungan</th>
            <th align="left">Rp. <?= number_format($totalpenjualan, 0, ',', '.'); ?></th>
        </tr>
    </table>

</body></html>