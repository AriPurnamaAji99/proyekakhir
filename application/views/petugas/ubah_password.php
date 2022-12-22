<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <?= $this->session->flashdata('message'); ?>
                                <form action="<?= base_url('petugas/ubahPassword'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="current_password">Password Lama <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" value="<?= set_value('current_password') ?>">
                                        <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password1">Password Baru <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="new_password1" name="new_password1" value="<?= set_value('new_password1') ?>">
                                        <small class="text-muted"><i>*password minimal 8 karakter</i></small><br>
                                        <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password2">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="new_password2" name="new_password2">
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