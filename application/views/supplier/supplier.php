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
    <h1 class="h3 mb-4 text-gray-800">Supplier</h1>
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="btn btn-success btn-sm newSatuanModalButton" data-toggle="modal" data-target="#tambahSupplier">Tambah Supplier</a>
            <!-- <a href="<?= base_url('supplier/tambah') ?>" class="btn btn-success btn-sm">Tambah Supplier</a> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Keterangan</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($rows as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= strtoupper($row->nama); ?></td>
                                <td><?= strtoupper($row->alamat); ?></td>
                                <td><?= $row->no_hp; ?></td>
                                <td><?php if ($row->keterangan == NULL) : ?>
                                        <i>tidak ada keterangan</i>
                                    <?php else : ?>
                                        <?= strtoupper($row->keterangan); ?>
                                    <?php endif; ?>
                                </td>
                                <?php $tglDibuat = Tgl_indo($row->tanggal_dibuat); ?>
                                <td><?= $tglDibuat; ?></td>
                                <td>
                                    <!-- <a href="<?= base_url('supplier/edit/') . $row->id ?>" class="badge badge-warning"><i class="fas fa-pencil-alt"></i></a> -->
                                    <a href="" class="badge badge-warning newSatuanModalButton" data-toggle="modal" data-target="#editSupplier<?= $row->id; ?>" data-toggle="tooltip" data-placement="top" title="ubah data"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="" class="badge badge-danger newSatuanModalButton" data-toggle="modal" data-target="#hapusSupplier<?= $row->id; ?>" data-toggle="tooltip" data-placement="top" title="hapus data"><i class="fas fa-trash-alt"></i></a>
                                    <!-- <a href="<?= base_url('supplier/hapus/') . $row->id ?>" class="badge badge-danger" onclick="return confirm('yakin?')"><i class="fas fa-trash-alt"></i></a> -->
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

<!-- Modal Tambah Supplier -->
<div class="modal fade" id="tambahSupplier" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">Form Input Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('supplier/tambah') ?>" method="post">
                    <div class="mb-2">
                        <label for="nama" class="col-form-label">Nama Supplier <span class="text-danger">*</span></label>
                        <input type=" text" class="form-control" id="nama" name="nama" required autocomplete="off" oninvalid="this.setCustomValidity('Nama supplier tidak boleh kosong')" oninput="setCustomValidity('')">
                    </div>
                    <div class="mb-2">
                        <label for="alamat" class="col-form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
                        <!-- <input type="text" class="form-control" id="alamat" name="alamat" required autocomplete="off"> -->
                    </div>
                    <div class="mb-2">
                        <label for="no_hp" class="col-form-label">No HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required autocomplete="off" oninvalid="this.setCustomValidity('No HP tidak boleh kosong')" oninput="setCustomValidity('')" minlength="11" maxlength="13" onkeypress="return restrictAlphabets(event)">
                    </div>
                    <div class="mb-2">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <textarea type="text" name="keterangan" class="form-control" autocomplete="off"></textarea>
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

<!-- Modal Hapus-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusSupplier<?= $row->id; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kategori" id="" value="<?= $row->id; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('supplier/hapus/') . $row->id; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Ubah Supplier-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="editSupplier<?= $row->id; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel">Form Ubah Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('supplier/edit/') . $row->id; ?>" method="post">
                        <div class="mb-2">
                            <input type="hidden" name="id" value="<?= $row->id; ?>">
                            <label for="nama" class="col-form-label">Nama Supplier <span class="text-danger">*</span></label>
                            <input type=" text" class="form-control" id="nama" name="nama" value="<?= $row->nama; ?>" required autocomplete="off" oninvalid="this.setCustomValidity('Nama supplier tidak boleh kosong')" oninput="setCustomValidity('')">
                        </div>
                        <div class="mb-2">
                            <label for="alamat" class="col-form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea type="text" name="alamat" class="form-control" autocomplete="off" value="<?= $row->alamat; ?>" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')"><?= $row->alamat; ?></textarea>
                            <!-- <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $row->alamat; ?>" required autocomplete="off"> -->
                        </div>
                        <div class="mb-2">
                            <label for="no_hp" class="col-form-label">No HP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $row->no_hp; ?>" required autocomplete="off" oninvalid="this.setCustomValidity('No HP tidak boleh kosong')" oninput="setCustomValidity('')" minlength="11" maxlength="13" onkeypress="return restrictAlphabets(event)">
                        </div>
                        <div class="mb-2">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                            <textarea type="text" name="keterangan" class="form-control" autocomplete="off" value="<?= $row->keterangan; ?>"><?= $row->keterangan; ?></textarea>
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
    function restrictAlphabets(e) {
        var x = e.which || e.keycode;
        if ((x >= 48 && x <= 57))
            return true;
        else
            return false;
    }
</script>