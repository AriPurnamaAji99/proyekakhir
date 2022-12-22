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
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="200px">Tanggal</th>
                            <th>Nama Laporan</th>
                            <th>Dikirimkan pada</th>
                            <th>Diubah pada</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <?php $tglAwal = Tgl_indo($row->tgl_awal);
                                $tglAkhir = Tgl_indo($row->tgl_akhir); ?>
                                <td><?= $tglAwal . ' s.d. ' . $tglAkhir ?></td>
                                <td><?= $row->nama_laporan; ?></td>
                                <td><?= $row->created_at; ?></td>
                                <?php if ($row->updated_at == NULL) : ?>
                                    <td><i>tidak ada perubahan</i></td>
                                <?php else : ?>
                                    <td><?= $row->updated_at; ?></td>
                                <?php endif; ?>
                                <td>
                                    <?php if ($row->status == "proses") : ?>
                                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#acc<?= $row->id_laporan; ?>">proses</a>
                                    <?php else : ?>
                                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#proses<?= $row->id_laporan; ?>">sukses</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- <a href="<?= base_url('pengawas/download_laporan_neraca/') . $row->id_laporan ?>" class="badge badge-primary"><i class="fas fa-arrow-alt-circle-down"></i> unduh</a> -->
                                    <a href="" class="badge badge-primary" data-toggle="modal" data-target="#unduh<?= $row->id_laporan; ?>"><i class="fas fa-arrow-alt-circle-down"></i> unduh</a>
                                    <a href="" class="badge badge-success" data-toggle="modal" data-target="#feedback<?= $row->id_laporan; ?>"><i class="fas fa-comment-dots"></i> komentar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Acc-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="acc<?= $row->id_laporan; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Yakin anda akan merubah status data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pilih "Ubah" di bawah jika Anda akan merubah status data laporan menjadi sukses.
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_laporan" id="" value="<?= $row->id_laporan; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('pengawas/neraca_success/') . $row->id_laporan; ?>" class="btn btn-success btn-sm">Ubah</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Proses-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="proses<?= $row->id_laporan; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle">Yakin anda akan merubah status data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pilih "Ubah" di bawah jika Anda akan merubah status data laporan menjadi proses.
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_laporan" id="" value="<?= $row->id_laporan; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('pengawas/neraca_proses/') . $row->id_laporan; ?>" class="btn btn-success btn-sm">Ubah</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Ubah Feedback-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="feedback<?= $row->id_laporan; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel">Form Komentar Laporan Neraca</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('pengawas/feedback_neraca/') . $row->id_laporan; ?><?= base_url('pengawas/feedback_barang_masuk/') . $row->id_laporan ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <input type="hidden" name="id_laporan" value="<?= $row->id_laporan; ?>">
                            <label for="feedback">Komentar Laporan Neraca</label>
                            <textarea type="text" class="form-control form-control-sm" name="feedback" id="feedback" value="<?= $row->feedback; ?>" required oninvalid="this.setCustomValidity('Komentar tidak boleh kosong')" oninput="setCustomValidity('')"><?= $row->feedback; ?></textarea>
                        </div>
                        <div class="mb-2">
                            <button type="button" class="btn btn-secondary btn-sm mt-2" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success btn-sm mt-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Unduh-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="unduh<?= $row->id_laporan; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle">Apakah anda yakin?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Pilih "Unduh" di bawah jika Anda akan mengunduh data laporan neraca dari tanggal <b><?= $tglAwal; ?></b> s.d. <b><?= $tglAkhir; ?></b>.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('pengawas/download_laporan_neraca/') . $row->id_laporan ?>" class="btn btn-success btn-sm">Unduh</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>