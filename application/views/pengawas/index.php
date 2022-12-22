<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Task', 12]
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script> -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <!-- <div id="piechart" style="width: 900px; height: 500px;"></div> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <form action="<?= base_url('pengawas/data_by_tanggal') ?>" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tanggal Awal <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_awal" class="form-control" value="<?= set_value('tgl_awal'); ?>" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                            <!-- <?= form_error('tgl_awal', '<span class=text-danger small pl-3>', '</span>') ?> -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Tanggal Akhir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_akhir" class="form-control" value="<?= set_value('tgl_akhir'); ?>" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                            <!-- <?= form_error('tgl_akhir', '<span class=text-danger small pl-3>', '</span>') ?> -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"><br>
                            <button type="submit" class="btn btn-success btn-sm mt-2"><i class="fas fa-search"></i></button>
                            <a href="<?= base_url('pengawas');  ?>" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-sync-alt"></i></a>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        TOTAL PENJUALAN</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp <?= number_format($penjualan, 0, ',', '.'); ?>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        TOTAL KEUNTUNGAN DARI PENJUALAN</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp <?= number_format($profit_penjualan, 0, ',', '.'); ?>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        TOTAL PENGELUARAN</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        TOTAL TRANSAKSI BRILINK</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp <?= number_format($transaksi_brilink, 0, ',', '.'); ?>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        TOTAL BIAYA ADMIN</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp <?= number_format($profit_brilink, 0, ',', '.'); ?>
                                    </div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->