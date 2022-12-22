<?php
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
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
            <a href="" class="btn btn-success btn-sm newSatuanModalButton" data-toggle="modal" data-target="#inputModal">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $jml = 0;
                    foreach ($rows as $row) : ?>
                        <tbody>
                            <?php $tanggal_masuk_modal = Tgl_indo($row->tanggal); ?>
                            <td><?= $tanggal_masuk_modal; ?></td>
                            <td>Rp. <?= number_format($row->nominal, 0, ',', '.'); ?></td>
                            <td><?= $row->keterangan; ?></td>
                            <td><a href="" class="badge badge-warning newSatuanModalButton" data-toggle="modal" data-target="#editModal<?= $row->id_modal; ?>"><i class="fas fa-pencil-alt"></i></a></td>
                        </tbody>
                    <?php $jml += $row->nominal;
                    endforeach; ?>
                    <tfoot class="bg-light">
                        <tr>
                            <th>Total</th>
                            <th colspan="3">Rp. <?= number_format($jml, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Insert-->
<div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('barang/tambah_data_modal') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" autocomplete="off" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nominal</label>
                        <input type="number" class="form-control" autocomplete="off" name="nominal" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <textarea type="text" class="form-control" name="keterangan" id="keterangan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++; ?>
    <div class="modal fade" id="editModal<?= $row->id_modal; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('barang/ubah_data_modal') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id_modal" id="" value="<?= $row->id_modal; ?>">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" autocomplete="off" name="tanggal" value="<?= $row->tanggal; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal</label>
                            <input type="number" class="form-control" autocomplete="off" name="nominal" value="<?= $row->nominal; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan"><?= $row->keterangan; ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    function hitung_total_harga_beli() {
        let harga_satuan = document.getElementById('harga_satuan').value;
        let stok = document.getElementById('stok').value;
        let total_harga_beli = document.getElementById('total_harga_beli');

        total_harga_beli.value = parseInt(harga_satuan) * parseInt(stok);
    }
</script>