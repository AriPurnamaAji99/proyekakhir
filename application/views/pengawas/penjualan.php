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
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-lg-8">
                <form action="<?= base_url('laporan/cetak') ?>" method="post" target="_blank">
                    <div class="row mb-3">
                        <!-- <?php $tgl_awal = $tgl_awal_max->tgl_max_awal; ?> -->
                        <?php $tgl_akhir = date('Y-m-d', strtotime('+1 days', strtotime($tgl_akhir_max->tgl_max_akhir))); ?>
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal Awal <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" min="<?= $tgl_akhir; ?>" name="tgl_awal" id="tgl_awal" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" min="<?= $tgl_akhir; ?>" name="tgl_akhir" id="tgl_akhir" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary btn-sm mt-4" style="margin-top: 5px;"><i class="fas fa-print"> | <i class="fas fa-file-pdf"></i></i> Cetak</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <form action="<?= base_url('pengawas/data_penjualan_by_tanggal') ?>" method="POST">
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
                            <a href="<?= base_url('pengawas/penjualan');  ?>" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-sync-alt"></i></a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light text-dark">
                        <tr>
                            <th>#</th>
                            <!-- <th></th> -->
                            <th>Kode Penjualan</th>
                            <!-- <th>Kode Barang</th> -->
                            <!-- <th>Nama Barang</th> -->
                            <!-- <th>Jumlah Beli</th> -->
                            <th>Total Belanja</th>
                            <!-- <th>Total Profit</th> -->
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $tot_bel = 0;
                        $tot_prof = 0;
                        foreach ($rows as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <!-- <th><?= $row->id_penjualan; ?></th> -->
                                <td><?= $row->kode_penjualan; ?></td>
                                <!-- <td><?= $row->kode_barang; ?></td> -->
                                <!-- <td><?= $row->nama_barang; ?></td> -->
                                <!-- <td><?= $row->jumlah; ?></td> -->
                                <td>Rp <?= number_format($row->total_belanja, 0, ',', '.'); ?></td>
                                <!-- <td>Rp <?= number_format($row->total_profit, 0, ',', '.'); ?></td> -->
                                <?php $tanggalPenjualan = Tgl_indo($row->tanggal); ?>
                                <td><?= $tanggalPenjualan; ?></td>
                                <td><a href="<?= base_url('pengawas/detail_penjualan/') . $row->kode_penjualan; ?>" class="badge badge-info">Detail</a></td>
                            </tr>
                        <?php
                            $tot_bel += $row->total_belanja;
                            $tot_prof += $row->total_profit;
                        endforeach; ?>
                    </tbody>
                    <tfoot>
                        <th colspan="2">Total</th>
                        <th colspan="3">Rp <?= number_format($tot_bel, 0, ',', '.'); ?></th>
                        <!-- <th colspan="3">Rp <?= number_format($tot_prof, 0, ',', '.'); ?></th> -->
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
        </div>
    </div>
</div>
<!-- /.container-fluid -->