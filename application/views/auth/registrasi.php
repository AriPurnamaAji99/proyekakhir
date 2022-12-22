<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block"><img src="<?= base_url('assets/img/slider/bg_regist.svg') ?>" alt="" width="500" height="680" style="margin-left: 10%;"></div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4 mt-4"><?= $title; ?></h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registrasi') ?>">
                            <div class="form-group">
                                <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-user" id="name" name="nama_lengkap" autocomplete="off" value="<?= set_value('nama_lengkap') ?>" placeholder="Masukkan Nama Lengkap" onkeypress="return hanyaHuruf(event)">
                                <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="">E-mail <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email') ?>" placeholder="Masukkan Email" autocomplete="off">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <label for="">Role <span class="text-danger">*</span></label>
                            <div class="form-group row mb-4">
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role_id" value="1" id="role_id1">
                                        <label class="form-check-label" for="role_id1">
                                            Pengawas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role_id" value="2" id="role_id1">
                                        <label class="form-check-label" for="role_id1">
                                            Petugas Penjualan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role_id" value="3" id="role_id1">
                                        <label class="form-check-label" for="role_id1">
                                            Petugas Gudang
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" value="<?= set_value('password1') ?>" placeholder="Password">
                                    <!-- <div class="input-group">
                                        <span class="input-group-text" onclick="lihat_password()">
                                            <i id="lihat" class="fas fa-eye" style="display: none;"></i>
                                            <i id="tutup" class="fas fa-eye-slash"></i>
                                        </span>
                                    </div> -->
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <div class="form-text small pl-3">*password minimal 8 karakter</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password">
                                    <!-- <div class="input-group">
                                        <span class="input-group-text" onclick="lihat_konf_password()">
                                            <i id="lihat2" class="fas fa-eye" style="display: none;"></i>
                                            <i id="tutup2" class="fas fa-eye-slash"></i>
                                        </span>
                                    </div> -->
                                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <div style="margin-left: 38px;">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="lihat_password()"> <span style="font-size: 15px;">Lihat Password</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-user btn-block mt-5">
                                Registrasi Akun
                            </button>
                        </form>
                        <hr>
                        <!-- <div class="text-center">
                            <a class="small" href="<?= base_url('auth/lupaPassword') ?>" style="text-decoration: none;">Lupa Password?</a>
                        </div> -->
                        <div class="text-center small">
                            Sudah memiliki akun?<a href="<?= base_url('auth') ?>" style="text-decoration: none;"> Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function hanyaHuruf(evt) {
        var char = evt.which;
        if (char > 31 && char != 32 && (char < 65 || char > 90) && (char < 97 || char > 122)) {
            return false;
        }
    }

    function lihat_password() {
        var x = document.getElementById('password1');
        var y = document.getElementById('password2');
        // var y = document.getElementById('lihat');
        // var z = document.getElementById('tutup');

        if (x.type === 'password') {
            x.type = "text";
            // y.style.display = "block";
            // z.style.display = "none";
        } else {
            x.type = "password";
            // y.style.display = "none";
            // z.style.display = "block";
        }

        if (y.type === 'password') {
            y.type = "text";
            // y.style.display = "block";
            // z.style.display = "none";
        } else {
            y.type = "password";
            // y.style.display = "none";
            // z.style.display = "block";
        }
    }

    // function lihat_konf_password() {
    //     var x = document.getElementById('password2');
    //     var y = document.getElementById('lihat2');
    //     var z = document.getElementById('tutup2');

    //     if (x.type === 'password') {
    //         x.type = "text";
    //         y.style.display = "block";
    //         z.style.display = "none";
    //     } else {
    //         x.type = "password";
    //         y.style.display = "none";
    //         z.style.display = "block";
    //     }
    // }
</script>