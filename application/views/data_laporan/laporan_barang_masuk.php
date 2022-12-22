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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#kirimLaporan">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Nama Laporan</th>
                            <th>Status</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <?php $tglAwal = Tgl_indo($row->tgl_awal);
                                $tglAkhir = Tgl_indo($row->tgl_akhir); ?>
                                <td><?= $tglAwal; ?></td>
                                <td><?= $tglAkhir; ?></td>
                                <td><?= $row->nama_laporan; ?></td>
                                <td>
                                    <?php if ($row->status == 'proses') : ?>
                                        <a href="#" class="badge badge-warning" disabled><?= $row->status; ?></a>
                                    <?php else : ?>
                                        <a href="#" class="badge badge-success" disabled><?= $row->status; ?></a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($row->feedback == NULL) : ?>
                                        <i>tidak ada komentar</i>
                                    <?php else : ?>
                                        <?= $row->feedback; ?>
                                </td>
                            <?php endif; ?>
                            <td>
                                <!-- <a href="" class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="edit data"><i class="fas fa-pencil-alt"></i></a> -->
                                <a href="" class="badge badge-warning newSatuanModalButton" data-toggle="modal" data-target="#editLaporan<?= $row->id_laporan; ?>" data-toggle="tooltip" data-placement="top" title="ubah data"><i class="fas fa-pencil-alt"></i></a>
                                <!-- <a href="<?= base_url('kirim/hapus/') . $row->id_laporan ?>" class="badge badge-danger" onclick="return confirm('yakin?');" data-toggle="tooltip" data-placement="top" title="hapus data"><i class="fas fa-trash-alt"></i></a> -->
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

<!-- Modal -->
<div class="modal fade" id="kirimLaporan" tabindex="-1" aria-labelledby="newKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKategoriModalLabel">Form Input Data Laporan Barang Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('kirim/tambah_laporan_barang_masuk') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tgl_awal">Tanggal Awal <span class="text-danger">*</span></label>
                        <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="tgl_akhir">Tanggal Akhir <span class="text-danger">*</span></label>
                        <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="nama_laporan">Laporan Barang Masuk <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="nama_laporan" name="nama_laporan" required oninvalid="this.setCustomValidity('Laporan tidak boleh kosong')" oninput="setCustomValidity('')">
                            <label class="custom-file-label" for="">Choose File</label>
                        </div>
                        <small class="text-muted"><i>*format file: pdf</i></small>
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

<!-- Modal Ubah Laporan-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="editLaporan<?= $row->id_laporan; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel">Form Ubah Data Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('kirim/edit_laporan_barang_masuk/') . $row->id_laporan; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <input type="hidden" name="id_laporan" value="<?= $row->id_laporan; ?>">
                            <input type="hidden" name="created_at" value="<?= $row->created_at; ?>">
                            <label for="tgl_awal" class="col-form-label">Tanggal Awal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="<?= $row->tgl_awal; ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-2">
                            <label for="tgl_akhir" class="col-form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="<?= $row->tgl_akhir; ?>" autocomplete="off" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-2">
                            <label for="nama_laporan">Laporan Barang Masuk</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="nama_laporan" name="nama_laporan" value="<?= $row->nama_laporan; ?>">
                                <label class="custom-file-label" for=""><?= $row->nama_laporan; ?></label>
                            </div>
                            <small class="text-muted"><i>*format file: pdf</i></small>
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

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>