<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="col-lg-8">
                                <form action="<?= base_url('petugas_gudang/editProfile') ?>" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email" readonly value="<?= $user['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nama_lengkap" autocomplete="off" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>" onkeypress="return hanyaHuruf(event);">
                                            <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="alamat" id="alamat" value="<?= $user['alamat']; ?>"><?= $user['alamat']; ?></textarea>
                                            <!-- <input type="text" class="form-control" id="alamat" autocomplete="off" name="alamat" value="<?= $user['alamat']; ?>"> -->
                                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="no_hp" class="col-sm-3 col-form-label">No Telp</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="no_hp" autocomplete="off" name="no_hp" value="<?= $user['no_hp']; ?>" minlength="11" maxlength="13" onkeypress="return restrictAlphabets(event)">
                                            <!-- <input type="number" class="form-control" id="no_hp" autocomplete="off" name="no_hp" value="<?= $user['no_hp']; ?>"> -->
                                            <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">Foto</div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="image" name="image">
                                                        <label class="custom-file-label" for="image">Choose File</label>
                                                    </div>
                                                    <small class="text-muted pl-2"><i>*format file : jpg, jpeg, png</i></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                        </div>
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
    function restrictAlphabets(e) {
        var x = e.which || e.keycode;
        if ((x >= 48 && x <= 57))
            return true;
        else
            return false;
    }

    function hanyaHuruf(evt) {
        var char = evt.which;
        if (char > 31 && char != 32 && (char < 65 || char > 90) && (char < 97 || char > 122)) {
            return false;
        }
    }

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>