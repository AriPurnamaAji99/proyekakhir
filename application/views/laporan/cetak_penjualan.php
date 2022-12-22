<?php
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "01";
            break;
        case 2:
            return "02";
            break;
        case 3:
            return "03";
            break;
        case 4:
            return "04";
            break;
        case 5:
            return "05";
            break;
        case 6:
            return "06";
            break;
        case 7:
            return "07";
            break;
        case 8:
            return "08";
            break;
        case 9:
            return "09";
            break;
        case 10:
            return "10";
            break;
        case 11:
            return "11";
            break;
        case 12:
            return "12";
            break;
    }
}
?>
<?php $tglAwal = Tgl_indo($tgl_awal);
$tglAkhir = Tgl_indo($tgl_akhir); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan <?= $tglAwal ?> s.d. <?= $tglAkhir ?></title>
    <style>
        body {
            font-family: calibri;
        }
    </style>
</head>

<body onload="window.print()">
    <h2 align="center">Laporan Penjualan<br>
        <?= $tglAwal ?> s.d. <?= $tglAkhir ?></h2>
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th>No.</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <!-- <th>Kategori</th> -->
            <th>Harga Jual</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Keuntungan</th>
        </tr>
        <?php if (!empty($rows)) : ?>
            <?php
            $no = 1;
            $totalpenjualan = 0;
            $totalprofit = 0;
            foreach ($rows as $row) :
                $profit2 = $row->profit * $row->jumlah_beli; ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row->kode_barang; ?></td>
                    <td><?= $row->nama_barang; ?></td>
                    <td>Rp <?= number_format($row->harga_jual, 0, ',', '.') . ' / ' . $row->nama_satuan; ?></td>
                    <td><?= $row->jumlah_beli . ' ' . $row->nama_satuan; ?></td>
                    <td>Rp <?= number_format($row->total_beli, 0, ',', '.'); ?></td>
                    <td>Rp <?= number_format($profit2, 0, ',', '.'); ?></td>
                </tr>
            <?php
                $totalpenjualan += $row->total_beli;
                $totalprofit += $row->profit * $row->jumlah_beli;
            endforeach; ?>
            <tr>
                <th colspan="5" align="right">Total Penjualan dan Keuntungan</th>
                <th align="left">Rp <?= number_format($totalpenjualan, 0, ',', '.'); ?></th>
                <th align="left">Rp <?= number_format($totalprofit, 0, ',', '.'); ?></th>
            </tr>
        <?php else : ?>
            <tr>
                <td colspan="7" align="center"><i style="color: crimson;">data tidak ditemukan</i></td>
            </tr>
        <?php endif; ?>
    </table>

</body>

</html>