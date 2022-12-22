<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-lg-12">
                <form action="<?= base_url('pengawas/data_labarugi_by_tanggal') ?>" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php $tgl_akhir = date('Y-m-d', strtotime('+1 days', strtotime($tgl_akhir_max->tgl_max_akhir))); ?>
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
                                <a href="<?= base_url('laporan/laba_rugi');  ?>" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- pendapatan & pengeluaran -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Pendapatan dan Pengeluaran</h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <?php
                                    $totalpenjualan = 0;
                                    foreach ($rows as $row) : ?>
                                        <input type="hidden" name="total" value="<?= $row->total; ?>">
                                    <?php
                                        $totalpenjualan += $row->total;
                                    endforeach; ?>
                                    <?php
                                    $total = 0;
                                    foreach ($brilink as $bri) : ?>
                                        <input type="hidden" name="total" value="<?= $bri->biaya_admin; ?>">
                                    <?php
                                        $total += $bri->biaya_admin;
                                    endforeach; ?>
                                    <tr>
                                        <th width="200">Total Pendapatan</th>
                                        <td>Rp <?= number_format($totalpenjualan + $total, 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php
                                    $totalpengeluaran = 0;
                                    foreach ($pengeluaran as $row) : ?>
                                        <input type="hidden" name="total_beli" value="<?= $row->total_harga_beli; ?>">
                                    <?php
                                        $totalpengeluaran += $row->total_harga_beli;
                                    endforeach; ?>
                                    <tr>
                                        <th>Total Pengeluaran</th>
                                        <td>Rp <?= number_format($totalpengeluaran, 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                </tbody>
                                <!-- <?php $totalpendapatan = $total_gas + $total_atk + $total_sembako + $total_minuman ?> -->
                                <tfoot class="bg-light">
                                    <th>Total Laba Kotor</th>
                                    <?php $labakotor = ($totalpenjualan + $total) - $totalpengeluaran; ?>
                                    <th>Rp <?= number_format($labakotor, 0, ',', '.'); ?></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-secondary">Beban-beban </h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <?= $this->session->flashdata('message_beban'); ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <!-- <a href="" class="badge badge-warning newSatuanModalButton mb-2" data-toggle="modal" data-target="#listrik<?= $row->id_beban; ?>"><i class="fas fa-pencil-alt"></i> Ubah data</a> -->
                                    <a href="" class="badge badge-success newSatuanModalButton mb-2" data-toggle="modal" data-target="#inputBeban"><i class="fas fa-plus"></i> Tambah Data</a>
                                    <tr>
                                        <th width="200">Belanja Pegawai 30%</th>
                                        <?php $pegawai = $labakotor * 0.3;  ?>
                                        <td colspan="2">Rp <?= number_format($pegawai, 0, ',', '.'); ?></td>
                                    </tr>
                                    <?php $total = 0;
                                    foreach ($beban as $row) : ?>
                                        <tr>
                                            <th><?= $row->keterangan; ?></th>
                                            <td>Rp <?= number_format($row->nominal, 0, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <a href="" class="badge badge-warning newSatuanModalButton mb-2" data-toggle="modal" data-target="#ubahBeban<?= $row->id_beban; ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <!-- <a href="" class="badge badge-danger newSatuanModalButton mb-2" data-toggle="modal" data-target="#hapusBeban<?= $row->id_beban; ?>"><i class="fas fa-trash"></i></a> -->
                                            </td>
                                        </tr>
                                    <?php $total += $row->nominal;
                                    endforeach; ?>
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-light">
                                    <th>Total Biaya</th>
                                    <?php $totalbiaya = 0;
                                    $totalbiaya = $total + $pegawai; ?>
                                    <th colspan="2"><?= 'Rp ' . number_format($totalbiaya, 0, ',', '.'); ?></th>
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
                    <h6 class="m-0 font-weight-bold text-secondary">Total Laba Bersih</i></h6>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <?php $lababersih = 0;
                                $lababersih = $labakotor - $totalbiaya; ?>
                                <thead>
                                </thead>
                                <tfoot class="bg-light">
                                    <th>Rp <?= number_format($lababersih, 0, ',', '.'); ?></th>
                                </tfoot>
                            </table>
                        </div>
                        <form action="<?= base_url('laporan/cetak_labarugi') ?>" method="POST">
                            <div class="row ml-2 mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tanggal Awal <span class="text-danger">*</span></label>
                                        <input type="date" name="tgl_awal" class="form-control" value="<?= set_value('tgl_awal'); ?>" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                                        <!-- <?= form_error('tgl_awa', '<span class=text-danger small pl-3>', '</span>') ?> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tanggal Akhir <span class="text-danger">*</span></label>
                                        <input type="date" name="tgl_akhir" class="form-control" value="<?= set_value('tgl_akhir'); ?>" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                                        <!-- <?= form_error('tgl_akhi', '<span class=text-danger small pl-3>', '</span>') ?> -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group"><br>
                                        <button type="submit" class="btn btn-primary btn-sm mt-2"><i class="fas fa-print"> | <i class="fas fa-file-pdf"></i></i> Cetak</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                            <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="inputBeban" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Data Beban</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('laporan/input_beban') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="col-form-label">Keterangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="keterangan" required oninvalid="this.setCustomValidity('Keterangan tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nominal" id="nominal" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" onkeyup="validasi_nominal()">
                        <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm" id="btnSimpan" disabled="true">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Data -->
<?php
$count = 0;
foreach ($beban as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="ubahBeban<?= $row->id_beban; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSatuanModalLabel">Form Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('laporan/ubah_beban') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="col-form-label">Keterangan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="keterangan" required oninvalid="this.setCustomValidity('Keterangan tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= $row->keterangan; ?>">
                            <input type="hidden" name="id_beban" id="" value="<?= $row->id_beban; ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="col-form-label">Nominal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nominal" id="nominal2" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= 'Rp ' . number_format($row->nominal, 0, ',', '.'); ?>">
                            <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                            <!-- <input type="text" class="form-control" autocomplete="off" name="nominal" id="nominal2" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" onkeyup="validasi_nominal()"> -->
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

<!-- Modal Hapus Data -->
<?php
$count = 0;
foreach ($beban as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusBeban<?= $row->id_beban; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="id_beban" id="" value="<?= $row->id_beban; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('laporan/hapus_beban/') . $row->id_beban; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<script>
    var rupiah = document.getElementById('nominal');
    var nominal2 = document.getElementById('nominal2');

    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp ');
    });

    nominal2.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        nominal2.value = formatRupiah(this.value, 'Rp ');
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

    function validasi_nominal() {
        var nominal = document.getElementById('nominal').value;
        let getNominal = nominal.split(".").join("").split("Rp").join("");
        var btnSimpan = document.getElementById('btnSimpan');

        if (getNominal >= 20000) {
            btnSimpan.removeAttribute('disabled');
        } else {
            btnSimpan.disabled = 'true';
        }
    }
</script>