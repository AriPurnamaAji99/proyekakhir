<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header text-center">
            <h6 class="m-0 font-weight-bold text-secondary">AKTIVA & KEWAJIBAN</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-secondary">A. AKTIVA LANCAR</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <?= $this->session->flashdata('message_aktiva_lancar'); ?>
                                    <table class="table table-bordered">
                                        <a href="" class="badge badge-success newSatuanModalButton mb-2" data-toggle="modal" data-target="#inputAktivaLancar"><i class="fas fa-plus"></i> Tambah data</a>
                                        <tbody>
                                            <?php
                                            $total_aktiva_lancar = 0;
                                            foreach ($aktiva_lancar as $row) : ?>
                                                <tr>
                                                    <th width="200"><?= $row->nama_aktiva; ?></th>
                                                    <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <a href="" class="badge badge-warning newSatuanModalButton mb-2" data-toggle="modal" data-target="#ubahAktivaLancar<?= $row->id_aktiva_lancar; ?>"><i class="fas fa-pencil-alt"></i></a>
                                                        <!-- <a href="" class="badge badge-danger newSatuanModalButton mb-2" data-toggle="modal" data-target="#hapusAktivaLancar<?= $row->id_aktiva_lancar; ?>"><i class="fas fa-trash-alt"></i></a> -->
                                                    </td>
                                                </tr>
                                            <?php $total_aktiva_lancar += $row->nominal;
                                            endforeach; ?>
                                            <tr>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <th>Jumlah Aktiva Lancar</th>
                                            <th colspan="2">Rp <?= number_format($total_aktiva_lancar, 0, ',', '.'); ?></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-secondary">A. KEWAJIBAN LANCAR</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <?php
                                            $pad = 25 / 100;
                                            $cu = 35 / 100;
                                            $ct = 10 / 100;
                                            $dk = 10 / 100;
                                            $jp = 10 / 100;
                                            $ds = 10 / 100;
                                            ?>
                                            <tr>
                                                <th width="200">PAD (Penghasilan Asli Desa) 25%</th>
                                                <td>Rp <?= number_format($kas->nominal * $pad, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <th width="200">Cadangan Umum 35%</th>
                                                <td>Rp <?= number_format($kas->nominal * $cu, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <th width="200">Cadangan Tujuan 10%</th>
                                                <td>Rp <?= number_format($kas->nominal * $ct, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <th width="200">Dana Kesejahteraan 10%</th>
                                                <td>Rp <?= number_format($kas->nominal * $dk, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <th width="200">Jasa Produksi 10%</th>
                                                <td>Rp <?= number_format($kas->nominal * $jp, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <th width="200">Dana Sosial 10%</th>
                                                <td>Rp <?= number_format($kas->nominal * $ds, 0, ',', '.'); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <th>Jumlah Kewajiban Lancar</th>
                                            <th>Rp <?= number_format($kas->nominal, 0, ',', '.'); ?></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-secondary">A. AKTIVA TETAP</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <?= $this->session->flashdata('message_aktiva_tetap'); ?>
                                    <table class="table table-bordered">
                                        <a href="" class="badge badge-success newSatuanModalButton mb-2" data-toggle="modal" data-target="#inputAktivaTetap"><i class="fas fa-plus"></i> Tambah data</a>
                                        <tbody>
                                            <?php
                                            $total_aktiva_tetap = 0;
                                            foreach ($aktiva_tetap as $row) : ?>
                                                <tr>
                                                    <th width="200"><?= $row->nama_aktiva; ?></th>
                                                    <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <a href="" class="badge badge-warning newSatuanModalButton mb-2" data-toggle="modal" data-target="#ubahAktivaTetap<?= $row->id_aktiva_tetap; ?>"><i class="fas fa-pencil-alt"></i></a>
                                                        <!-- <a href="" class="badge badge-danger newSatuanModalButton mb-2" data-toggle="modal" data-target="#hapusAktivaTetap<?= $row->id_aktiva_tetap; ?>"><i class="fas fa-trash-alt"></i></a> -->
                                                    </td>
                                                </tr>
                                            <?php $total_aktiva_tetap += $row->nominal;
                                            endforeach; ?>
                                            <tr>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <th>Jumlah Aktiva Tetap</th>
                                            <th colspan="3">Rp <?= number_format($total_aktiva_tetap, 0, ',', '.'); ?></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-secondary">B. MODAL</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <?= $this->session->flashdata('message_modal'); ?>
                                    <table class="table table-bordered">
                                        <a href="" class="badge badge-success newSatuanModalButton mb-2" data-toggle="modal" data-target="#inputModal"><i class="fas fa-plus"></i> Tambah data</a>
                                        <tbody>
                                            <?php $total_modal = 0;
                                            foreach ($modal as $row) : ?>
                                                <tr>
                                                    <th width="200"><?= $row->keterangan; ?></th>
                                                    <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <a href="" class="badge badge-warning newSatuanModalButton mb-2" data-toggle="modal" data-target="#ubahModal<?= $row->id_modal; ?>"><i class="fas fa-pencil-alt"></i></a>
                                                        <!-- <a href="" class="badge badge-danger newSatuanModalButton mb-2" data-toggle="modal" data-target="#hapusModal<?= $row->id_modal; ?>"><i class="fas fa-trash-alt"></i></a> -->
                                                    </td>
                                                </tr>
                                            <?php $total_modal += $row->nominal;
                                            endforeach; ?>
                                            <tr>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="bg-light">
                                            <th>Jumlah Modal</th>
                                            <th colspan="2">Rp <?= number_format($total_modal, 0, ',', '.'); ?></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <!-- <h6 class="m-0 font-weight-bold text-secondary">A. AKTIVA TETAP</h6> -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tfoot class="bg-light">
                                            <th>Jumlah Aktiva Keseluruhan</th>
                                            <th><?= number_format($total_aktiva_lancar + $total_aktiva_tetap, 0, ',', '.'); ?></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <!-- <h6 class="m-0 font-weight-bold text-secondary">B. MODAL</h6> -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tfoot class="bg-light">
                                            <th>Jumlah Kewajiban & Modal</th>
                                            <th><?= number_format($total_modal + $kas->nominal, 0, ',', '.'); ?></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('laporan/cetak_neraca') ?>" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> | <i class="fas fa-file-pdf"></i> Cetak</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Aktiva Lancar-->
<div class="modal fade" id="inputAktivaLancar" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Aktiva Lancar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('laporan/input_aktiva_lancar') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="col-form-label">Nama Aktiva Lancar <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nama_aktiva" required oninvalid="this.setCustomValidity('Nama aktiva tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nominal" id="nominal_al" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" onkeyup="validasi_nominal_al()">
                        <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                    </div>
                    <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm" id="btnSimpan" disabled="true">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Aktiva Lancar-->
<?php
$count = 0;
foreach ($aktiva_lancar as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="ubahAktivaLancar<?= $row->id_aktiva_lancar; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSatuanModalLabel">Form Ubah Aktiva Lancar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('laporan/ubah_aktiva_lancar') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nama Aktiva Lancar <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nama_aktiva" required oninvalid="this.setCustomValidity('Nama aktiva tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= $row->nama_aktiva; ?>">
                            <input type="hidden" name="id_aktiva_lancar" id="" value="<?= $row->id_aktiva_lancar; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nominal" id="nominal_al2" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= 'Rp ' . number_format($row->nominal, 0, ',', '.'); ?>">
                            <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                        </div>
                        <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
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

<!-- Modal Hapus Aktiva Lancar-->
<?php
$count = 0;
foreach ($aktiva_lancar as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusAktivaLancar<?= $row->id_aktiva_lancar; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Yakin anda akan menghapus data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    Pilih tombol "hapus" dibawah jika anda akan menghapus data
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_aktiva_lancar" id="" value="<?= $row->id_aktiva_lancar; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('laporan/hapus_aktiva_lancar/') . $row->id_aktiva_lancar; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Tambah Aktiva Tetap -->
<div class="modal fade" id="inputAktivaTetap" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Aktiva Tetap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('laporan/input_aktiva_tetap') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="col-form-label">Nama Aktiva Tetap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nama_aktiva" required oninvalid="this.setCustomValidity('Nama aktiva tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nominal" id="nominal_at" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" onkeyup="validasi_nominal_at()">
                        <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                    </div>
                    <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm" id="btnSimpan2" disabled="true">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Aktiva Tetap -->
<?php
$count = 0;
foreach ($aktiva_tetap as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="ubahAktivaTetap<?= $row->id_aktiva_tetap; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSatuanModalLabel">Form Ubah Aktiva Tetap</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('laporan/ubah_aktiva_tetap') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nama Aktiva Tetap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nama_aktiva" required oninvalid="this.setCustomValidity('Nama aktiva tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= $row->nama_aktiva; ?>">
                            <input type="hidden" name="id_aktiva_tetap" id="" value="<?= $row->id_aktiva_tetap; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nominal" id="ubah_nominal_at" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= 'Rp ' . number_format($row->nominal, 0, ',', '.'); ?>">
                        </div>
                        <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
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

<!-- Modal Hapus Aktiva Tetap -->
<?php
$count = 0;
foreach ($aktiva_tetap as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusAktivaTetap<?= $row->id_aktiva_tetap; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Yakin anda akan menghapus data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    Pilih tombol "hapus" dibawah jika anda akan menghapus data
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_aktiva_tetap" id="" value="<?= $row->id_aktiva_tetap; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('laporan/hapus_aktiva_tetap/') . $row->id_aktiva_tetap; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Tambah Modal -->
<div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('laporan/input_modal') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="col-form-label">keterangan <span class="text-danger">*</span></label>
                        <textarea name="keterangan" id="" class="form-control" required oninvalid="this.setCustomValidity('Keterangan tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
                        <!-- <input type="text" class="form-control" autocomplete="off" name="keterangan" required oninvalid="this.setCustomValidity('Nama aktiva tidak boleh kosong')" oninput="setCustomValidity('')"> -->
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nominal" id="nominal_modal" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" onkeyup="validasi_nominal_modal()">
                        <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                    </div>
                    <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm" id="btnSimpan3" disabled="true">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Modal -->
<?php
$count = 0;
foreach ($modal as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="ubahModal<?= $row->id_modal; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSatuanModalLabel">Form Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('laporan/ubah_modal') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="col-form-label">Keterangan <span class="text-danger">*</span></label>
                            <textarea name="keterangan" id="" class="form-control" required oninvalid="this.setCustomValidity('Keterangan tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= $row->keterangan; ?>"><?= $row->keterangan; ?></textarea>
                            <!-- <input type="text" class="form-control" autocomplete="off" name="nama_aktiva" required oninvalid="this.setCustomValidity('Nama aktiva tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= $row->nama_aktiva; ?>"> -->
                            <input type="hidden" name="id_modal" id="" value="<?= $row->id_modal; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nominal" id="ubah_nominal_modal" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= 'Rp ' . number_format($row->nominal, 0, ',', '.'); ?>">
                        </div>
                        <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
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

<!-- Modal Hapus Modal -->
<?php
$count = 0;
foreach ($modal as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusModal<?= $row->id_modal; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Yakin anda akan menghapus data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    Pilih tombol "hapus" dibawah jika anda akan menghapus data
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_modal" id="" value="<?= $row->id_modal; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('laporan/hapus_modal/') . $row->id_modal; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    var nominal_al = document.getElementById('nominal_al');
    var nominal_al2 = document.getElementById('nominal_al2');
    var nominal_at = document.getElementById('nominal_at');
    var ubah_nominal_at = document.getElementById('ubah_nominal_at');
    var nominal_modal = document.getElementById('nominal_modal');
    var ubah_nominal_modal = document.getElementById('ubah_nominal_modal');

    nominal_al.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        nominal_al.value = formatRupiah(this.value, 'Rp ');
    });
    nominal_al2.addEventListener('keyup', function(e) {
        nominal_al2.value = formatRupiah(this.value, 'Rp ');
    });
    nominal_at.addEventListener('keyup', function(e) {
        nominal_at.value = formatRupiah(this.value, 'Rp ');
    });
    ubah_nominal_at.addEventListener('keyup', function(e) {
        ubah_nominal_at.value = formatRupiah(this.value, 'Rp ');
    });
    nominal_modal.addEventListener('keyup', function(e) {
        nominal_modal.value = formatRupiah(this.value, 'Rp ');
    });
    ubah_nominal_modal.addEventListener('keyup', function(e) {
        ubah_nominal_modal.value = formatRupiah(this.value, 'Rp ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        if (prefix != "") {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        } else {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah = undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
    }

    function validasi_nominal_al() {
        var rupiah = document.getElementById('nominal_al').value;
        let getRupiah = rupiah.split(".").join("").split("Rp").join("");
        var btnSimpan = document.getElementById('btnSimpan');

        if (getRupiah >= 20000) {
            btnSimpan.removeAttribute('disabled');
        } else {
            btnSimpan.disabled = 'true';
        }
    }

    function validasi_nominal_at() {
        var rupiah = document.getElementById('nominal_at').value;
        let getRupiah = rupiah.split(".").join("").split("Rp").join("");
        var btnSimpan = document.getElementById('btnSimpan2');

        if (getRupiah >= 20000) {
            btnSimpan.removeAttribute('disabled');
        } else {
            btnSimpan.disabled = 'true';
        }
    }

    function validasi_nominal_modal() {
        var rupiah = document.getElementById('nominal_modal').value;
        let getRupiah = rupiah.split(".").join("").split("Rp").join("");
        var btnSimpan = document.getElementById('btnSimpan3');

        if (getRupiah >= 20000) {
            btnSimpan.removeAttribute('disabled');
        } else {
            btnSimpan.disabled = 'true';
        }
    }
</script>