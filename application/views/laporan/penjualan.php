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
</div>
<!-- /.container-fluid -->