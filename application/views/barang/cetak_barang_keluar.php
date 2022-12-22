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
            return "Desember";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <style>
        body {
            font-family: calibri;
        }
    </style>
</head>

<body onload="window.print()">
    <?php $tglAwal = Tgl_indo($tgl_awal);
    $tglAkhir = Tgl_indo($tgl_akhir); ?>
    <h2 align="center">Laporan Barang Keluar <br> <?= $tglAwal ?> s.d. <?= $tglAkhir ?></h2>
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th>No</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Satuan</th>
        </tr>
        <?php if (!empty($rows)) : ?>
            <?php $no = 1;
            $totalpenjualan = 0;
            $totalprofit = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <th><?= $no++; ?></th>
                    <?php $tanggalMasuk = Tgl_indo($row->tanggal_masuk); ?>
                    <td><?= $tanggalMasuk; ?></td>
                    <?php $tanggalKeluar = Tgl_indo($row->tanggal); ?>
                    <td><?= $tanggalKeluar; ?></td>
                    <td><?= $row->kode_barang; ?></td>
                    <td><?= $row->nama_barang; ?></td>
                    <td><?= $row->jumlah; ?></td>
                    <td><?= $row->nama_satuan; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="8" align="center"><i style="color: crimson;">Tidak ada data</i></td>
            </tr>
        <?php endif; ?>
    </table>

</body>

</html>