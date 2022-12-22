<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <?= $this->session->flashdata('message'); ?>
                                <form action="<?= base_url('admin/ubahPassword'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="current_password">Password Lama</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" value="<?= set_value('current_password') ?>">
                                        <!-- <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1" onclick="lihat_password_lama()">
                                                <i id="lihat" class="fas fa-eye" style="display: none;"></i>
                                                <i id="tutup" class="fas fa-eye-slash"></i>
                                            </span>
                                        </div> -->
                                        <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password1">Password Baru</label>
                                        <input type="password" class="form-control" id="new_password1" name="new_password1" value="<?= set_value('new_password1') ?>">
                                        <!-- <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1" onclick="lihat_password_baru()">
                                                <i id="lihat2" class="fas fa-eye" style="display: none;"></i>
                                                <i id="tutup2" class="fas fa-eye-slash"></i>
                                            </span>
                                        </div> -->
                                        <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password2">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="new_password2" name="new_password2">
                                        <!-- <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1" onclick="lihat_konfirmasi_password()">
                                                <i id="lihat3" class="fas fa-eye" style="display: none;"></i>
                                                <i id="tutup3" class="fas fa-eye-slash"></i>
                                            </span>
                                        </div> -->
                                        <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="lihat_password()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Lihat Password
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">Ubah Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
    function lihat_password() {
        var a = document.getElementById('current_password');
        var b = document.getElementById('new_password1');
        var c = document.getElementById('new_password2');

        if (a.type === 'password') {
            a.type = "text";
        } else {
            a.type = "password";
        }

        if (b.type === 'password') {
            b.type = "text";
        } else {
            b.type = "password";
        }

        if (c.type === 'password') {
            c.type = "text";
        } else {
            c.type = "password";
        }
    }
</script>