<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-12 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-7 d-none d-lg-block">
                            <img src="<?= base_url('assets/img/slider/bg_login.svg') ?>" alt="" width="600" height="500" style="margin-left: 8%;" class="mt-3">
                        </div>
                        <div class="col-lg-5">
                            <div class="p-5">
                                <div class="text-center">
                                    <h5 class="text-gray-900 mb-4 mt-2" style="font-family: 'Times New Roman', Times, serif;">Selamat Datang<br>
                                        <!-- <h3>BUMDES Karya Mandiri</h3> -->
                                    </h5>
                                    <h6 class="text-gray-900 mb-4"><b>Untuk menggunakan aplikasi, <br>silahkan login terlebih dahulu.</b></h6>
                                </div>
                                <form class="user" method="post" action="<?= base_url('auth') ?>">
                                    <div class="form-group">
                                        <?= $this->session->flashdata('message'); ?>
                                        <label for="">E-mail</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-user" id="email" name="email" value="<?= set_value('email') ?>" placeholder="Masukkan Email">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </span>
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <span class="input-group-text" id="basic-addon1" onclick="lihat_password()">
                                                <i id="lihat" class="fas fa-eye" style="display: none;"></i>
                                                <i id="tutup" class="fas fa-eye-slash"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- <div class="text-right mb-2">
                                        <a class="small" href="<?= base_url('auth/lupaPassword') ?>" style="text-decoration: none;">Lupa Password?</a>
                                    </div> -->
                                    <button type="submit" class="btn btn-info btn-user btn-block">
                                        <i class="fas fa-sign-in-alt"></i> Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center small">
                                    Belum punya akun? <a href="<?= base_url('auth/registrasi') ?>" style="text-decoration: none;">Registrasi!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('portal') ?>" style="text-decoration: none;">Halaman Utama</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script>
    function lihat_password() {
        var x = document.getElementById('password');
        var y = document.getElementById('lihat');
        var z = document.getElementById('tutup');

        if (x.type === 'password') {
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
        } else {
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
        }
    }
</script>