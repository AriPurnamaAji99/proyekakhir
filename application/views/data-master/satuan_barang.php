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
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="" class="btn btn-success btn-sm newSatuanModalButton" data-toggle="modal" data-target="#newSatuanModal">Tambah Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Satuan</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($rows as $row) :
                                    $count = $count + 1;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $count ?></th>
                                        <td><?= $row->nama_satuan ?></td>
                                        <!-- <td>
                                            <a href="<?= base_url('Data_master/editSatuan/') . $row->id_satuan ?>" class="badge badge-warning" data-placement="top" title="edit data">Edit</a>
                                            <a href="" class="badge badge-warning newSatuanModalButton" data-toggle="modal" data-target="#editSatuan<?= $row->id_satuan; ?>">Ubah</a>
                                            <a href="" class="badge badge-danger newSatuanModalButton" data-toggle="modal" data-target="#hapusSatuan<?= $row->id_satuan; ?>">Hapus</a>
                                            <a href="<?= base_url('Data_master/hapusSatuan/') . $row->id_satuan  ?>" class="badge badge-danger" onclick="return confirm('Anda yakin?');" data-placement="top" title="hapus data">Hapus</a>

                                        </td> -->
                                    </tr>
                                <?php endforeach; ?>
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
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Data_master/insertSatuan') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="col-form-label">Nama Satuan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nama_satuan" required oninvalid="this.setCustomValidity('Nama satuan tidak boleh kosong')" oninput="setCustomValidity('')" onkeypress="return hanyaHuruf(event);">
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

<!-- Modal Ubah-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="editSatuan<?= $row->id_satuan; ?>" tabindex="-1" aria-labelledby="editSatuanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSatuanLabel">Form Ubah Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Data_master/editSatuan') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nama Satuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nama_satuan" value="<?= $row->nama_satuan; ?>" required oninvalid="this.setCustomValidity('Nama satuan tidak boleh kosong')" oninput="setCustomValidity('')">
                            <input type="hidden" name="id_satuan" value="<?= $row->id_satuan; ?>">
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

<!-- Modal Hapus-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusSatuan<?= $row->id_satuan; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_satuan" id="" value="<?= $row->id_satuan; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('Data_master/hapusSatuan/') . $row->id_satuan; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>



<script>
    function hanyaHuruf(evt) {
        var char = evt.which;
        if (char > 31 && char != 32 && (char < 65 || char > 90) && (char < 97 || char > 122)) {
            return false;
        }
    }
</script>