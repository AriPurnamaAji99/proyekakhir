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
    <title>Laporan Neraca</title>
    <style>
        body {
            font-family: calibri;
        }
    </style>
</head>

<body onload="window.print()">
    <h2 align="center">Neraca BUMDes Karya Mandiri</h2>
    <table border="1" style="border-collapse: collapse;" width="100%" cellpadding="5" cellspacing="5">
        <tr>
            <th colspan="2">AKTIVA</th>
            <!-- <th colspan="2">KEWAJIBAN</th> -->
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th colspan="2" align="left">A. AKTIVA LANCAR</th>
            <!-- <th colspan="2" align="left">A. KEWAJIBAN LANCAR</th> -->
        </tr>
        <?php
        $total_aktiva_lancar = 0;
        foreach ($aktiva_lancar as $row) : ?>
            <tr>
                <td align="left"><?= $row->nama_aktiva; ?></td>
                <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
            </tr>
        <?php $total_aktiva_lancar += $row->nominal;
        endforeach; ?>
        <tr>
            <th align="left">Jumlah Aktiva Lancar</th>
            <th align="left">Rp <?= number_format($total_aktiva_lancar, 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th colspan="2" align="left">B. AKTIVA TETAP</th>
        </tr>
        <?php $total_aktiva_tetap = 0;
        foreach ($aktiva_tetap as $row) : ?>
            <tr>
                <td align="left"><?= $row->nama_aktiva; ?></td>
                <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
            </tr>
        <?php $total_aktiva_tetap += $row->nominal;
        endforeach; ?>
        <tr>
            <th align="left">Jumlah Aktiva Tetap</th>
            <th align="left">Rp <?= number_format($total_aktiva_tetap, 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th>Jumlah Aktiva Keseluruhan</th>
            <th>Rp <?= number_format($total_aktiva_lancar + $total_aktiva_tetap, 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <!-- <th colspan="2">AKTIVA</th> -->
            <th colspan="2">KEWAJIBAN</th>
        </tr>
        <tr>
            <!-- <th colspan="2" align="left">A. AKTIVA LANCAR</th> -->
            <th colspan="2" align="left">A. KEWAJIBAN LANCAR</th>
        </tr>
        <?php
        $pad = 25 / 100;
        $cu = 35 / 100;
        $ct = 10 / 100;
        $dk = 10 / 100;
        $jp = 10 / 100;
        $ds = 10 / 100;
        ?>
        <tr>
            <td align="left">PAD (Penghasilan Asli Desa) 25%</td>
            <td>Rp <?= number_format($kas->nominal * $pad, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td align="left">Cadangan Umum 35%</td>
            <td>Rp <?= number_format($kas->nominal * $cu, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td align="left">Cadangan Tujuan 10%</td>
            <td>Rp <?= number_format($kas->nominal * $ct, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td align="left">Dana Kesejahteraan 10%</td>
            <td>Rp <?= number_format($kas->nominal * $dk, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td align="left">Jasa Produksi 10%</td>
            <td>Rp <?= number_format($kas->nominal * $jp, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td align="left">Dana Sosial 10%</td>
            <td>Rp <?= number_format($kas->nominal * $ds, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <th align="left">Jumlah Kewajiban Lancar</th>
            <th align="left">Rp <?= number_format($kas->nominal, 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th colspan="2" align="left">B. MODAL</th>
        </tr>
        <?php $total_modal = 0;
        foreach ($modal as $row) : ?>
            <tr>
                <td align="left"><?= $row->keterangan; ?></td>
                <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
            </tr>
        <?php $total_modal += $row->nominal;
        endforeach; ?>
        <tr>
            <th align="left">Jumlah Modal</th>
            <th align="left">Rp <?= number_format($total_modal, 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <th>Jumlah Kewajiban dan Modal</th>
            <th>Rp <?= number_format($total_modal + $kas->nominal, 0, ',', '.'); ?></th>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
    </table>
</body>

</html>