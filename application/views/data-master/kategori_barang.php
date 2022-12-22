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
                                    <th scope="col">Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($rows as $row) :
                                    $count = $count + 1;
                                ?>
                                    <tr>
                                        <th scope=" row"><?= $count ?></th>
                                        <td><?= $row->nama_kategori ?></td>
                                        <!-- <td>
                                            <a href="<?= base_url('Data_master/editKategori/') . $row->id_kategori ?>" class="badge badge-warning" data-placement="top" title="edit data">Edit</a>
                                            <a href="" class="badge badge-warning newSatuanModalButton" data-toggle="modal" data-target="#editKategori<?= $row->id_kategori; ?>">Ubah</a>
                                            <a href="" class="badge badge-danger newSatuanModalButton" data-toggle="modal" data-target="#hapusKategori<?= $row->id_kategori; ?>">Hapus</a>
                                            <a href="<?= base_url('Data_master/hapusKategori/') . $row->id_kategori  ?>" class="badge badge-danger" onclick="return confirm('Anda yakin?');" data-placement="top" title="hapus data">Hapus</a>
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
                <h5 class="modal-title" id="newSatuanModalLabel">Form Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Data_master/insertKategori') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="col-form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" name="nama_kategori" required oninvalid="this.setCustomValidity('Nama kategori tidak boleh kosong')" oninput="setCustomValidity('')" onkeypress="return hanyaHuruf(event);">
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
    <div class="modal fade" id="editKategori<?= $row->id_kategori; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel">Form Ubah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('Data_master/editKategori') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="" class="col-form-label">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" autocomplete="off" name="nama_kategori" value="<?= $row->nama_kategori; ?>" required oninvalid="this.setCustomValidity('Nama kategori tidak boleh kosong')" oninput="setCustomValidity('')">
                            <input type="hidden" name="id_kategori" value="<?= $row->id_kategori; ?>">
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
    <div class="modal fade" id="hapusKategori<?= $row->id_kategori; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_kategori" id="" value="<?= $row->id_kategori; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('Data_master/hapusKategori/') . $row->id_kategori; ?>" class="btn btn-danger btn-sm">Hapus</a>
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