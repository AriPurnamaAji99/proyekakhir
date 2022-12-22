<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <!-- pendapatan & pengeluaran -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Pendapatan</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php
                                foreach ($data_pendapatan as $row) :
                                ?>
                                    <tbody>
                                        <tr>
                                            <th width="200">Pendapatan Gas</th>
                                            <td>Rp. <?= number_format($total_gas) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pendapatan ATK</th>
                                            <td>Rp. <?= number_format($total_atk) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pendapatan Sembako</th>
                                            <td>Rp. <?= number_format($total_sembako) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Pendapatan Minuman</th>
                                            <td>Rp. <?= number_format($total_minuman) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                    <?php $totalpendapatan = $total_gas + $total_atk + $total_sembako + $total_minuman ?>
                                    <tfoot class="bg-light">
                                        <th>Total Pendapatan</th>
                                        <th>Rp. <?= number_format($totalpendapatan); ?></th>
                                    </tfoot>
                            </table>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Pengeluaran</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php
                                foreach ($data_pengeluaran as $row) :
                                ?>
                                    <tbody>
                                        <tr>
                                            <th width="200">Belanja Gas</th>
                                            <td>Rp. <?= number_format($modal_gas) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Belanja ATK</th>
                                            <td>Rp. <?= number_format($modal_atk) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Belanja Sembako</th>
                                            <td>Rp. <?= number_format($modal_sembako) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Belanja Minuman</th>
                                            <td>Rp. <?= number_format($modal_minuman) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                    <?php $totalpengeluaran = $modal_gas + $modal_atk + $modal_sembako + $modal_minuman ?>
                                    <tfoot class="bg-light">
                                        <th>Total Pengeluaran</th>
                                        <th>Rp. <?= number_format($totalpengeluaran); ?></th>
                                    </tfoot>
                            </table>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- laba kotor -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Laba Kotor</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php $labakotor = 0; ?>
                                <?php $labakotor = $totalpendapatan - $totalpengeluaran ?>
                                <tfoot class="bg-light">
                                    <th>Rp. <?= number_format($labakotor); ?></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- beban beban -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Beban-beban</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php
                                $pegawai = $labakotor * 0.3;
                                $totalbiaya = 0;
                                foreach ($data_beban as $row) :

                                ?>
                                    <tbody>
                                        <tr>
                                            <th width="200">Belanja Pegawai 30 %</th>
                                            <td>Rp. <?= number_format($pegawai) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Listrik</th>
                                            <td>Rp. <?= number_format($row->listrik) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Operasional BM Gas</th>
                                            <td>Rp. <?= number_format($row->operasional_gas) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Biaya Laporan</th>
                                            <td>Rp. <?= number_format($row->biaya_laporan) ?></td>
                                        </tr>
                                        <tr>
                                            <th>Biaya Opensasional ke PT.CAM</th>
                                            <td>Rp. <?= number_format($row->biaya_opensasional) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                    <?php $totalbiaya = $pegawai + $row->listrik + $row->operasional_gas + $row->biaya_laporan + $row->biaya_opensasional ?>
                                <?php endforeach; ?>
                                <tfoot class="bg-light">
                                    <th>Total Biaya</th>
                                    <th>Rp. <?= number_format($totalbiaya); ?></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- laba bersih -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Laba Bersih</i></h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php $lababersih = 0; ?>
                                <?php $lababersih = $labakotor - $totalbiaya ?>
                                <thead>
                                </thead>
                                <tfoot class="bg-light">
                                    <th>Rp. <?= number_format($lababersih); ?></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->