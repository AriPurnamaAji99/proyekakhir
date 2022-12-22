<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>

    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-fluid rounded-circle" style="width: 200px; height: 200px;">
                                <h5 class="card-title mt-3"><?= $user['nama_lengkap'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h6 class="font-weight-bold text-dark">Alamat</h6>
                                    <small><?= $user['alamat'] ?></small>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="font-weight-bold text-dark">No Telp</h6>
                                    <small><?= $user['no_hp'] ?></small>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="font-weight-bold text-dark">Email</h6>
                                    <small><?= $user['email'] ?></small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->