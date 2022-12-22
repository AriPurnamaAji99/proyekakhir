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
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        foreach ($data_user as $row) :
                            $count = $count + 1;
                        ?>
                            <?php if ($row->is_active == 'off') : ?>
                                <tr style="background-color:  #ffcccc;">
                                <?php else : ?>
                                <tr>
                                <?php endif; ?>
                                <th><?= $count; ?></th>
                                <td><?= $row->nama_lengkap; ?></td>
                                <td><?= $row->alamat; ?></td>
                                <td><?= $row->no_hp; ?></td>
                                <td><?= $row->email; ?></td>
                                <td>
                                    <?php if ($row->role_id == "1") : ?>
                                        <?php echo "Admin" ?>
                                    <?php elseif ($row->role_id == "2") : ?>
                                        <?php echo "Pengawas" ?>
                                    <?php else : ?>
                                        <?php echo "Petugas" ?>
                                    <?php endif; ?>
                                </td>
                                <td><img src="<?= base_url('assets/img/profile/') . $row->image ?>" alt="" width="80" height="80"></td>
                                <td>
                                    <?php if ($row->is_active == "on") : ?>
                                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#prosesOff<?= $row->id; ?>">On</a>
                                        <!-- <a href="<?= base_url('admin/offUser/') . $row->id ?>" class="badge badge-success" onclick="return confirm('Anda yakin?');" data-placement="top" title="ubah status">On</a> -->
                                    <?php else : ?>
                                        <a href="" class="badge badge-danger" data-toggle="modal" data-target="#prosesOn<?= $row->id; ?>">Off</a>
                                        <!-- <a href="<?= base_url('admin/onUser/') . $row->id ?>" class="badge badge-danger" onclick="return confirm('Anda yakin?');" data-placement="top" title="ubah status">Off</a> -->
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if ($row->is_active == "on") : ?>
                                        <button type="button" class="badge badge-secondary" disabled data-bs-toggle="tooltip" data-bs-placement="top" title="status user masih on">
                                            Hapus
                                        </button>
                                        <!-- <button href="" class="badge badge-secondary" disabled data-toggle="modal tooltip" data-target="#exampleModalCenter" data-placement="top" title="status user masih on">Hapus</button> -->
                                    <?php else : ?>
                                        <!-- <a href="<?= base_url('admin/AksiDeleteData/') . $row->id ?>" class="badge badge-danger" onclick="return confirm('Anda yakin?');" data-placement="top" title="hapus user">Hapus</a> -->
                                        <a href="" class="badge badge-danger" data-toggle="modal" data-target="#hapusUser<?= $row->id; ?>" data-placement="top" title="hapus user">Hapus</a>
                                    <?php endif ?>
                                    <!-- <a href="" class="badge badge-warning" data-toggle="modal" data-target="#ubahUser<?= $row->id; ?>" data-placement="top" title="ubah user">Ubah</a> -->
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

<!-- Modal Proses Off-->
<?php
$count = 0;
foreach ($data_user as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="prosesOff<?= $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/warning.png') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan merubah status data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/offUser/') . $row->id ?>">Ubah</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Proses Off-->
<?php
$count = 0;
foreach ($data_user as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="prosesOn<?= $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/warning.png') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan merubah status data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success btn-sm" href="<?= base_url('admin/onUser/') . $row->id ?>">Ubah</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus-->
<?php
$count = 0;
foreach ($data_user as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusUser<?= $row->id;  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger btn-sm" href="<?= base_url('admin/AksiDeleteData/') . $row->id ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Ubah-->
<?php
$count = 0;
foreach ($data_user as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="ubahUser<?= $row->id;  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <select name="role_id" id="role_id" class="form-control">
                            <?php foreach ($data_user as $row) : ?>
                                <option value="<?= $row->role_id; ?>" <?= $row->role_id == $row->role_id ? 'selected' : '' ?>><?= strtoupper($row->role_id); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger btn-sm" href="<?= base_url('admin/AksiDeleteData/') . $row->id ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>