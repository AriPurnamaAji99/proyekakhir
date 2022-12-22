<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Neraca</title>

    <style>
        table,
        th,
        td {
            font-size: 15px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <center>
        <h3 class="">Neraca BUMDES KARYA MANDIRI</h3>
    </center><br>
    <center>
        <table class="table table-bordered">
            <?php
            foreach ($data_kas as $row) :
            ?>
                <tbody>
                    <?php
                    $total1 = number_format($row->jumlah * 0.25);
                    $total2 = number_format($row->jumlah * 0.35);
                    $total3 = number_format($row->jumlah * 0.1);
                    ?>
                    <tr>
                        <th widht="50" class="text-center" colspan="2">AKTIVA</th>
                        <th class="text-center" colspan="2">KEWAJIBAN</th>
                    </tr>
                    <tr>
                        <th colspan="2">A. AKTIVA LANCAR</th>
                        <th colspan="2">B. KEWAJIBAN LANCAR</th>
                    </tr>
                    <tr>
                        <td>1. Kas</td>
                        <td>Rp. <?= number_format($row->jumlah); ?></td>
                        <td>1. PAD (Penghasilan Asli Desa) 25 %</td>
                        <td>Rp. <?= $total1; ?></td>
                    </tr>
                    <tr>
                        <td>2. Bank BRI</td>
                        <td>Rp. 20.625.000</td>
                        <td>2. Cadangan Umum 35 %</td>
                        <td>Rp. <?= $total2; ?></td>
                    </tr>
                    <tr>
                        <td>3. BRI Link</td>
                        <td>Rp. 16.542.061</td>
                        <td>3. Cadangan Tujuan 10 %</td>
                        <td>Rp. <?= $total3; ?></td>
                    </tr>
                    <tr>
                        <td>4. Persediaan Barang Dagang</td>
                        <td>Rp. 25.740.000</td>
                        <td>4. Dana Kesejahteraan 10 %</td>
                        <td>Rp. <?= $total3; ?></td>
                    </tr>
                    <tr>
                        <td>5. Perlengkapan Kantor</td>
                        <td>Rp. 1.028.000</td>
                        <td>5. Jasa Produksi 10 %</td>
                        <td>Rp. <?= $total3; ?></td>
                    </tr>
                    <tr>
                        <td>6. Piutang Operasional</td>
                        <td>Rp. 4.400.000</td>
                        <td>6. Dana Sosial 10 %</td>
                        <td>Rp. <?= $total3; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Aktiva Lancar</th>
                        <th>Rp. 69.978.297</th>
                        <th>Jumlah Kewajiban Lancar</th>
                        <th>Rp. <?= number_format($row->jumlah); ?></th>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <th colspan="2">A. AKTIVA TETAP</th>
                        <th colspan="2">B. MODAL</th>
                    </tr>
                    <tr>
                        <td>1. Peralatan Kantor</td>
                        <td>Rp. 75.196.500</td>
                        <td>1. Penyertaan Modal dari Desa (2018)</td>
                        <td>Rp. 40.000.000</td>
                    </tr>
                    <tr>
                        <td>2. Kendaraan</td>
                        <td>Rp. 30.000.000</td>
                        <td>2. Penyertaan Modal dari Desa (2019)</td>
                        <td>Rp. 87.415.000</td>
                    </tr>
                    <tr>
                        <td>3. DO Gas</td>
                        <td>Rp. 75.000.000</td>
                        <td>3. Dana Hibah Provinsi (2019)</td>
                        <td>Rp. 100.000.000</td>
                    </tr>
                    <tr>
                        <td rowspan="2"></td>
                        <td rowspan="2"></td>
                        <td>4. Penambahan Modal Dari SHU (2020)</td>
                        <td>Rp. 551.561</td>
                    </tr>
                    <tr>
                        <td>5. Penyertaan Modal dari Desa (2020)</td>
                        <td>Rp. 20.592.000</td>
                    </tr>
                    <tr>
                        <th>Jumlah Aktiva Tetap</th>
                        <th>Rp. 180.196.500</th>
                        <th>Jumlah Modal</th>
                        <th>Rp. 248.558.561</th>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                </tbody>

                <tfoot class="bg-light">
                    <th>Jumlah Aktiva Keseluruhan</th>
                    <th>Rp. 250.174.797</th>
                    <th>Jumlah Kewajiban dan Modal</th>
                    <th>Rp. 250.174.797</th>
                </tfoot>
            <?php endforeach; ?>
        </table>
    </center>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>