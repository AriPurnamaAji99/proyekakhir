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
    <title>Laporan Laba Rugi <?= $tglAwal ?> s.d. <?= $tglAkhir ?></title>
    <style>
        body {
            font-family: calibri;
        }
    </style>
</head>

<body onload="window.print()">
    <h2 align="center">Laporan Laba Rugi<br>
        <?= $tglAwal ?> s.d. <?= $tglAkhir ?></h2>
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th colspan="2">Pendapatan dan Pengeluaran</th>
        </tr>
        <?php
        $totalpenjualan = 0;
        foreach ($rows as $row) : ?>
            <input type="hidden" name="total" value="<?= $row->total; ?>">
        <?php
            $totalpenjualan += $row->total;
        endforeach; ?>
        <?php
        $total = 0;
        foreach ($brilink as $bri) : ?>
            <input type="hidden" name="total" value="<?= $bri->biaya_admin; ?>">
        <?php
            $total += $bri->biaya_admin;
        endforeach; ?>
        <tr>
            <th align="left">Total Pendapatan</th>
            <td>Rp <?= number_format($totalpenjualan + $total, 0, ',', '.'); ?></td>
        </tr>
        <?php
        $totalpengeluaran = 0;
        foreach ($pengeluaran as $row) : ?>
            <input type="hidden" name="total_beli" value="<?= $row->total_harga_beli; ?>">
        <?php
            $totalpengeluaran += $row->total_harga_beli;
        endforeach; ?>
        <tr>
            <th align="left">Total Pengeluaran</th>
            <td>Rp <?= number_format($totalpengeluaran, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th align="left">Total Laba Kotor</th>
            <?php $labakotor = ($totalpenjualan + $total) - $totalpengeluaran; ?>
            <th colspan="3" align="left">Rp <?= number_format($labakotor, 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th colspan="2" align="center">Beban-beban</th>
        </tr>
        <tr>
            <th align="left">Belanja Pegawai 30%</th>
            <?php $labakotor = ($totalpenjualan + $total) - $totalpengeluaran; ?>
            <?php $pegawai = $labakotor * 0.3;  ?>
            <td>Rp <?= number_format($pegawai, 0, ',', '.'); ?></td>
        </tr>
        <?php $total_beban = 0;
        foreach ($beban as $row) : ?>
            <tr>
                <th align="left"><?= $row->keterangan; ?></th>
                <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
            </tr>
        <?php $total_beban += $row->nominal;
        endforeach; ?>
        <tr>
            <th align="left">Total Biaya</th>
            <?php $totalbiaya = $total_beban + $pegawai; ?>
            <th align="left">Rp <?= number_format($totalbiaya, 0, ',', '.'); ?></th>
        </tr>

        <?php
        $totalpengeluaran = 0;
        foreach ($pengeluaran as $row) : ?>
            <input type="hidden" name="total_beli" value="<?= $row->total_harga_beli; ?>">
        <?php
            $totalpengeluaran += $row->total_harga_beli;
        endforeach; ?>
        <tr>
            <th align="left">Total Laba Bersih</th>
            <?php $lababersih = 0;
            $lababersih = $labakotor - $totalbiaya; ?>
            <th colspan="3" align="left">Rp <?= number_format($lababersih, 0, ',', '.'); ?></th>
        </tr>
    </table>
</body>

</html>