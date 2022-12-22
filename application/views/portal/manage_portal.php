<!-- Begin Page Content -->
<div class="container-fluid">

    <!------------------------->
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Judul 1</b>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $rows->judul_1; ?></p>
                    <a href="" class="btn btn-warning btn-sm newSatuanModalButton" data-toggle="modal" data-target="#editJudul1<?= $rows->id_portal; ?>" required autocomplete="off">Ubah</a>
                    <!-- <a href="<?= base_url('portal/edit_judul1/') . $rows->id_portal; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Ubah</a> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Judul 2</b>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $rows->judul_2; ?></p>
                    <a href="" class="btn btn-warning btn-sm newSatuanModalButton" data-toggle="modal" data-target="#editJudul2<?= $rows->id_portal; ?>" required autocomplete="off">Ubah</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Judul 3</b>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $rows->judul_3; ?></p>
                    <a href="" class="btn btn-warning btn-sm newSatuanModalButton" data-toggle="modal" data-target="#editJudul3<?= $rows->id_portal; ?>" required>Ubah</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Gambar 1</b>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('portal/edit_gambar1') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="<?= base_url('assets/img/slider/') . $rows->gambar_1; ?>" class="img-thumbnail" width="220" height="100">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="gambar_1">
                                            <label class="custom-file-label" for="image">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm mt-3">Ubah</button>
                    </form>
                    <!-- <a href="<?= base_url('portal/edit_judul1/') . $rows->id_portal; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Ubah</a> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Gambar 2</b>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('portal/edit_gambar2') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img width="220" height="100" src="<?= base_url('assets/img/slider/') . $rows->gambar_2; ?>" class="img-thumbnail">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="gambar_2">
                                            <label class="custom-file-label" for="image">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-9"> -->
                        <button type="submit" class="btn btn-warning btn-sm mt-3">Ubah</button>
                        <!-- </div> -->
                    </form>
                    <!-- <a href="<?= base_url('portal/edit_judul1/') . $rows->id_portal; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Ubah</a> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Gambar 3</b>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('portal/edit_gambar3') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="<?= base_url('assets/img/slider/') . $rows->gambar_3; ?>" class="img-thumbnail" width="220" height="100">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="gambar_3">
                                            <label class="custom-file-label" for="image">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm mt-3">Ubah</button>
                    </form>
                    <!-- <a href="<?= base_url('portal/edit_judul1/') . $rows->id_portal; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Ubah</a> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Deskripsi</b>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $rows->deskripsi; ?></p>
                    <a href="" class="btn btn-warning btn-sm newSatuanModalButton" data-toggle="modal" data-target="#editDeskripsi<?= $rows->id_portal; ?>">Ubah</a>
                    <!-- <a href="<?= base_url('portal/edit_deskripsi/') . $rows->id_portal; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Ubah</a> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Informasi Kontak</b>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Kepala Desa</b> : <?= $rows->info_kepdes; ?></li>
                        <li class="list-group-item"><b>Ketua</b> : <?= $rows->info_ketua; ?></li>
                        <li class="list-group-item"><b>Pengawas</b> : <?= $rows->info_pengawas; ?></li>
                        <li class="list-group-item"><b>Bendahara</b> : <?= $rows->info_bendahara; ?></li>
                        <li class="list-group-item"><b>Sekretaris</b> : <?= $rows->info_sekretaris; ?></li>
                        <li class="list-group-item"><b>Kepala Unit</b> : <?= $rows->info_kepunit; ?></li>
                    </ul>
                    <a href="" class="btn btn-warning btn-sm newSatuanModalButton" data-toggle="modal" data-target="#editKontak<?= $rows->id_portal; ?>">Ubah</a>
                    <!-- <a href="<?= base_url('portal/edit_kontak/') . $rows->id_portal; ?>" class="btn btn-warning btn-sm mt-3"><i class="fas fa-pencil-alt"></i> Ubah</a> -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <b>Struktur Organisasi</b>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('portal/edit_strukturOrganisasi') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="<?= base_url('assets/img/portal/') . $rows->struktur_organisasi; ?>" class="img-thumbnail" width="220" height="100">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="struktur_organisasi">
                                            <label class="custom-file-label" for="image">Choose File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning btn-sm mt-3">Ubah</button>
                    </form>
                    <!-- <a href="<?= base_url('portal/edit_judul1/') . $rows->id_portal; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Ubah</a> -->
                </div>
            </div>
        </div>
    </div>
    <!------------------------->
</div>

<!-- Modal Ubah Judul 1-->
<div class="modal fade" id="editJudul1<?= $rows->id_portal; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">Ubah Judul 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('portal/edit_judul1') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_portal" value="<?= $rows->id_portal; ?>">
                        <input type="text" class="form-control" autocomplete="off" name="judul_1" value="<?= $rows->judul_1; ?>" required>
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

<!-- Modal Ubah Judul 2-->
<div class="modal fade" id="editJudul2<?= $rows->id_portal; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">Ubah Judul 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('portal/edit_judul2') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_portal" value="<?= $rows->id_portal; ?>">
                        <input type="text" class="form-control" autocomplete="off" name="judul_2" value="<?= $rows->judul_2; ?>" required>
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

<!-- Modal Ubah Judul 3-->
<div class="modal fade" id="editJudul3<?= $rows->id_portal; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">Ubah Judul 3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('portal/edit_judul3') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_portal" value="<?= $rows->id_portal; ?>">
                        <input type="text" class="form-control" autocomplete="off" name="judul_3" value="<?= $rows->judul_3; ?>" required>
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

<!-- Modal Ubah Deskripsi-->
<div class="modal fade" id="editDeskripsi<?= $rows->id_portal; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">Ubah Deskripsi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('portal/edit_deskripsi') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_portal" value="<?= $rows->id_portal; ?>">
                        <textarea type="text" name="deskripsi" class="form-control" autocomplete="off" value="<?= $rows->deskripsi; ?>" style="width:400px; height:200px" required><?= $rows->deskripsi; ?></textarea>
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

<!-- Modal Ubah Kontak-->
<div class="modal fade" id="editKontak<?= $rows->id_portal; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel">Ubah Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('portal/edit_kontak/') . $rows->id_portal; ?>" method="post">
                    <div class="mb-2">
                        <input type="hidden" name="id_portal" value="<?= $rows->id_portal; ?>">
                        <label for="info_kepdes" class="col-form-label">Kepala Desa</label>
                        <input type=" text" class="form-control form-control-sm" id="info_kepdes" name="info_kepdes" value="<?= $rows->info_kepdes; ?>" required autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <label for="info_ketua" class="col-form-label">Ketua</label>
                        <input type="text" class="form-control form-control-sm" id="info_ketua" name="info_ketua" value="<?= $rows->info_ketua; ?>" required autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <label for="info_pengawas" class="col-form-label">Pengawas</label>
                        <input type="text" class="form-control form-control-sm" id="info_pengawas" name="info_pengawas" value="<?= $rows->info_pengawas; ?>" required autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <label for="info_bendahara" class="col-form-label">Bendahara</label>
                        <input type="text" class="form-control form-control-sm" id="info_bendahara" name="info_bendahara" value="<?= $rows->info_bendahara; ?>" required autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <label for="info_sekretaris" class="col-form-label">Sekretaris</label>
                        <input type="text" class="form-control form-control-sm" id="info_sekretaris" name="info_sekretaris" value="<?= $rows->info_sekretaris; ?>" required autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <label for="info_kepunit" class="col-form-label">Kepala Unit</label>
                        <input type="text" class="form-control form-control-sm" id="info_kepunit" name="info_kepunit" value="<?= $rows->info_kepunit; ?>" required autocomplete="off">
                    </div>
                    <div class="mb-2">
                        <button type="button" class="btn btn-secondary btn-sm mt-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm mt-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>