<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <a href="<?= base_url('barang/tambah') ?>" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Barang</a> -->
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $total_pengeluaran = 0;
                        $sisa_modal = 0; ?>
                        <?php foreach ($rows as $row) : ?>
                            <?php if ($row->stok <= 5 and $row->stok >= 1) : ?>
                                <tr style="background-color: #FAFAD2;">
                                <?php elseif ($row->stok <= 0) : ?>
                                <tr style="background-color:  #ffcccc;">
                                <?php else : ?>
                                <tr>
                                <?php endif; ?>
                                <td><?= $no++; ?></td>
                                <td><?= $row->kode_barang; ?></td>
                                <td><?= strtolower($row->nama_barang); ?></td>
                                <td><?= $row->stok; ?></td>
                                <td><?= $row->nama_satuan; ?></td>
                                <td>Rp <?= number_format($row->harga_satuan, 0, ',', '.'); ?></td>
                                <td class="text-center"><a href="" class="badge badge-success" data-toggle="modal" data-target="#tambah_stokk<?= $row->kode_barang; ?>"><i class="fas fa-plus"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>

                <hr>
                <button class="btn btn-warning"></button> Stok Minimum <br>
                <button class="btn btn-danger"></button> Stok Kosong
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Stok -->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="tambah_stokk<?= $row->kode_barang; ?>" tabindex="-1" aria-labelledby="editKategoriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriLabel">Tambah Stok Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?= $row->kode_barang; ?> - <?= $row->nama_barang; ?></p>
                    <form action="<?= base_url('barang/tambah_stok/') . $row->kode_barang; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-2">
                            <input type="hidden" name="kode_barang" value="<?= $row->kode_barang; ?>">
                            <input type="hidden" name="id_supplier" value="<?= $row->id_supplier; ?>">
                            <input type="hidden" name="kode_barang" value="<?= $row->kode_barang; ?>">
                            <input type="hidden" name="nama_barang" value="<?= $row->nama_barang; ?>">
                            <input type="hidden" name="harga_satuan" id="harga_satuan" value="<?= $row->harga_satuan; ?> ">
                            <input type="hidden" name="harga_jual" value="<?= $row->harga_jual; ?>">
                            <input type="hidden" name="profit" value="<?= $row->profit; ?>">
                            <input type="hidden" name="id_satuan" value="<?= $row->id_satuan; ?>">
                            <input type="hidden" name="id_kategori" value="<?= $row->id_kategori; ?>">
                            <input type="hidden" name="tanggal_masuk" value="<?= date('Y-m-d'); ?>">
                            <label for="">Jumlah <span class="text-danger">*</span></label>
                            <input type="text" name="stok" id="stok" class="form-control" onkeyup="hitung_total_harga_beli()" autocomplete="off" required oninvalid="this.setCustomValidity('Jumlah tidak boleh kosong')" oninput="setCustomValidity('')" onkeypress="return restrictAlphabets(event)"></input>
                            <!-- <label for="">Total Harga</label>
                            <input type="number" class="form-control form-control-sm" name="total_harga_beli" id="total_harga_beli" value="<?= set_value('total_harga_beli'); ?>" readonly> -->
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
<?php endforeach; ?>

<script>
    function restrictAlphabets(e) {
        var x = e.which || e.keycode;
        if ((x >= 48 && x <= 57))
            return true;
        else
            return false;
    }

    function hitung_total_harga_beli() {
        let harga_satuan = document.getElementById('harga_satuan').value;
        let stok = document.getElementById('stok').value;
        let total_harga_beli = document.getElementById('total_harga_beli');

        total_harga_beli.value = parseInt(harga_satuan) * parseInt(stok);
    }
</script>