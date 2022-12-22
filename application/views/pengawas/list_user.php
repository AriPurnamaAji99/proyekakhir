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
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('pengawas/listUser') ?>">User Aktif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('pengawas/listUserNonAktif') ?>">User Nonaktif</a>
                </li>
            </ul>
            <div class="table-responsive mt-3">
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
                            <th scope="col">Status Akun</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        foreach ($data_user as $row) :
                            $count = $count + 1;
                        ?>
                            <?php if ($row->is_active == 'proses') : ?>
                                <tr style="background-color:  #F0E68C;">
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
                                        <?php echo "Pengawas" ?>
                                    <?php elseif ($row->role_id == "2") : ?>
                                        <?php echo "Petugas Penjualan" ?>
                                    <?php else : ?>
                                        <?php echo "Petugas Gudang" ?>
                                    <?php endif; ?>
                                </td>
                                <td><img src="<?= base_url('assets/img/profile/') . $row->image ?>" alt="" width="80" height="80"></td>
                                <td>
                                    <?php if ($row->is_active == "on") : ?>
                                        <?php if ($row->nama_lengkap == $user['nama_lengkap']) : ?>
                                            <button type="button" class="badge badge-secondary" disabled>
                                                Aktif
                                            </button>
                                        <?php else : ?>
                                            <a href="" class="badge badge-success" data-toggle="modal" data-target="#prosesOff<?= $row->id; ?>">Aktif</a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="" class="badge badge-warning" data-toggle="modal" data-target="#prosesOn<?= $row->id; ?>">Proses</a>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <?php if ($row->is_active == "on") : ?>
                                        <?php if ($row->nama_lengkap == $user['nama_lengkap']) : ?>
                                            <button type="button" class="badge badge-secondary" disabled>
                                                Ubah
                                            </button>
                                        <?php else : ?>
                                            <a href="" class="badge badge-info" data-toggle="modal" data-target="#ubahUser<?= $row->id; ?>">Ubah</a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <button type="button" class="badge badge-secondary" disabled>
                                            Ubah
                                        </button>
                                    <?php endif ?>
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
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Ubah status user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin anda akan merubah status data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success btn-sm" href="<?= base_url('pengawas/offUser/') . $row->id ?>">Ubah</a>
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
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Ubah status user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin anda akan merubah status data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a class="btn btn-success btn-sm" href="<?= base_url('pengawas/onUser/') . $row->id ?>">Ubah</a>
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
    <div class="modal fade" id="ubahUser<?= $row->id;  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Ubah role user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('pengawas/ubahRole') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="" value="<?= $row->id; ?>">
                        <select name="role_id" id="" class="form-control">
                            <?php $data_role = $this->db->query("SELECT * FROM role")->result(); ?>
                            <?php foreach ($data_role as $row) : ?>
                                <option value="<?= $row->role_id; ?>" <?= ($row->nama_role == set_value('nama_role')) ? 'selected' : '' ?>><?= strtolower($row->nama_role); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Ubah</button>
                    </div>
                </form>
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
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle">Yakin anda akan menghapus data ini?</h6>
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
                    <a class="btn btn-danger btn-sm" href="<?= base_url('pengawas/AksiDeleteData/') . $row->id ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>