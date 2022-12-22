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
                    <!-- <a href="" class="btn btn-success btn-sm newSatuanModalButton" data-toggle="modal" data-target="#newSatuanModal">Tambah Data</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Pesan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($data_pesan as $row) :
                                ?>
                                    <tr>
                                        <th scope=" row"><?= $count++; ?></th>
                                        <td><?= $row->nama; ?></td>
                                        <td><?= $row->email; ?></td>
                                        <td><?= $row->no_hp; ?></td>
                                        <td><?= $row->pesan; ?></td>
                                        <td>
                                            <!-- <a href="<?= base_url('portal/AksiDeleteData/') . $row->id ?>" onclick="return confirm('Yakin akan menghapus data ini?')" class="badge badge-danger">Hapus</a> -->
                                            <a href="" class="badge badge-danger newSatuanModalButton" data-toggle="modal" data-target="#hapusPesan<?= $row->id; ?>">Hapus</a>
                                        </td>
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

<!-- Modal Hapus-->
<?php
$count = 0;
foreach ($data_pesan as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusPesan<?= $row->id; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="" value="<?= $row->id; ?>">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('portal/hapusPesan/') . $row->id; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>