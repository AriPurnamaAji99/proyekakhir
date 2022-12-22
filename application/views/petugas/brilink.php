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
    <div class="row">
        <div class="col-md-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="" class="btn btn-success btn-sm newSatuanModalButton" data-toggle="modal" data-target="#newSatuanModal">Tambah Transaksi</a>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('petugas/brilink_by_tanggal') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tanggal Awal <span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_awal" class="form-control" value="<?= set_value('tgl_awal'); ?>" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tanggal Akhir <span class="text-danger">*</span></label>
                                    <input type="date" name="tgl_akhir" class="form-control" value="<?= set_value('tgl_akhir'); ?>" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><br>
                                    <button type="submit" class="btn btn-success btn-sm mt-2"><i class="fas fa-search"></i></button>
                                    <a href="<?= base_url('petugas/brilink');  ?>" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nominal Transaksi</th>
                                    <th scope="col">Biaya Admin</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($rows)) : ?>
                                    <?php
                                    $count = 0;
                                    foreach ($rows as $row) :
                                        $count = $count + 1;
                                    ?>
                                        <tr>
                                            <th scope=" row"><?= $count ?></th>
                                            <?php $tgl = Tgl_indo($row->tanggal); ?>
                                            <td><?= $tgl; ?></td>
                                            <td>Rp <?= number_format($row->nominal_transaksi, 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($row->biaya_admin, 0, ',', '.'); ?></td>
                                            <td>
                                                <a href="" class="badge badge-warning newSatuanModalButton" data-toggle="modal" data-target="#edit<?= $row->id; ?>">Ubah</a>
                                                <a href="" class="badge badge-danger newSatuanModalButton" data-toggle="modal" data-target="#hapus<?= $row->id; ?>">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td>
                                            <center><i>data tidak ditemukan</i></center>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- <a href="" class="btn btn-success btn-sm newSatuanModalButton" data-toggle="modal" data-target="#newSatuanModal">Data Transaksi</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">Total Transaksi</th>
                                    <th scope="col">Total Biaya Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nominal = 0;
                                $biaya = 0;
                                foreach ($rows as $row) : ?>
                                <?php $nominal += $row->nominal_transaksi;
                                    $biaya += $row->biaya_admin;
                                endforeach; ?>
                                <tr>
                                    <th scope="row">Rp <?= number_format($nominal, 0, ',', '.'); ?></th>
                                    <th scope="row">Rp <?= number_format($biaya, 0, ',', '.'); ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Insert-->
<div class="modal fade" id="newSatuanModal" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('petugas/insertTransaksiBrilink') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <?php $today = date('Y-m-d'); ?>
                        <input type="date" class="form-control" name="tanggal" min="<?= $today; ?>" value="<?= $today; ?>" readonly>
                        <input type="hidden" name="id_user" id="" value="<?= $user['id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nominal Transaksi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nominal_transaksi" id="nominal_transaksi" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')" onkeyup="validasi()">
                        <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                    </div>
                    <div class="form-group">
                        <label for="">Biaya Admin <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="biaya_admin" id="biaya_admin" required oninvalid="this.setCustomValidity('Biaya admin tidak boleh kosong')" oninput="setCustomValidity('')">
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

<!-- Modal Ubah-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="edit<?= $row->id; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel">Form Ubah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('petugas/editTransaksiBrilink') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $row->tanggal; ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nominal Transaksi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nominal_transaksi" id="nominal_transaksi2" value="<?= 'Rp ' . number_format($row->nominal_transaksi, 0, ',', '.'); ?>" required oninvalid="this.setCustomValidity('Nominal tidak boleh kosong')" oninput="setCustomValidity('')">
                            <small class="text-muted"><i>*minimal Rp 20.000</i></small>
                        </div>
                        <div class=" form-group">
                            <label for="">Biaya Admin <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="biaya_admin" id="biaya_admin2" autocomplete="off" value="<?= 'Rp ' . number_format($row->biaya_admin, 0, ',', '.'); ?>" required oninvalid="this.setCustomValidity('Biaya admin tidak boleh kosong')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm" id="btnSimpan2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapus<?= $row->id; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('petugas/hapusTransaksiBrilink/') . $row->id; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    var rupiah = document.getElementById('nominal_transaksi');
    var rupiah2 = document.getElementById('nominal_transaksi2');
    var biaya_admin = document.getElementById('biaya_admin');
    var biaya_admin2 = document.getElementById('biaya_admin2');

    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp ');
    });

    rupiah2.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah2.value = formatRupiah(this.value, 'Rp ');
    });

    biaya_admin.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        biaya_admin.value = formatRupiah(this.value, 'Rp ');
    });

    biaya_admin2.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        biaya_admin2.value = formatRupiah(this.value, 'Rp ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        // if (prefix != "") {
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
    }

    function validasi() {
        var rupiah = document.getElementById('nominal_transaksi').value;
        let getRupiah = rupiah.split(".").join("").split("Rp").join("");
        var btnSimpan = document.getElementById('btnSimpan');

        if (getRupiah >= 20000) {
            btnSimpan.removeAttribute('disabled');
        } else {
            btnSimpan.disabled = 'true';
        }
    }
</script>