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
    <h2 align="center">Laporan Barang Masuk <br> <?= $tglAwal ?> s.d. <?= $tglAkhir ?></h2>
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr style="background-color: #DCDCDC;">
            <th>Nama Supplier</th>
            <th>Tanggal Masuk</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga</th>
        </tr>
        <?php if (!empty($rows)) : ?>
            <?php $no = 1;
            $jml = 0;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= strtoupper($row->nama); ?></td>
                    <?php $tglMasuk = Tgl_indo($row->tanggal_masuk); ?>
                    <td><?= $tglMasuk; ?></td>
                    <td><?= $row->kode_barang; ?></td>
                    <td><?= strtolower($row->nama_barang); ?></td>
                    <td><?= $row->nama_kategori; ?></td>
                    <td><?= $row->stok_barang_masuk; ?></td>
                    <td><?= $row->nama_satuan; ?></td>
                    <td>Rp.<?= number_format($row->beli_barang_masuk, 0, ',', '.'); ?></td>
                </tr>
            <?php $jml += $row->beli_barang_masuk;
            endforeach; ?>
            <tr>
                <th colspan="7" align="right">Total Harga </th>
                <th align="left">Rp.<?= number_format($jml, 0, ',', '.'); ?></th>
            </tr>
        <?php else : ?>
            <tr>
                <td colspan="8" align="center"><i style="color: crimson;">Tidak ada data</i></td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>