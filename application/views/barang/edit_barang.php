<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <div class="col-lg-8">
                <form action="" method="POST">
                    <input type="hidden" name="kode_barang" id="kode_barang" value="<?= $row->kode_barang; ?>">
                    <div class="row mb-3">
                        <label for="id_supplier" class="col-sm-3 col-form-label">Nama Supplier </label>
                        <div class="col-sm-9">
                            <select name="id_supplier" id="id_supplier" class="form-control">
                                <?php foreach ($supplier as $s) : ?>
                                    <option value="<?= $s->id; ?>" <?= $row->id_supplier == $s->id ? 'selected' : '' ?>><?= strtoupper($s->nama . ' - ' . $s->keterangan); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kode_barang" class="col-sm-3 col-form-label">Kode Barang </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="<?= $row->kode_barang; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_barang" id="nama" value=" <?= $row->nama_barang; ?>" autocomplete="off">
                            <?= form_error('nama_barang', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stok" class="col-sm-3 col-form-label">Stok <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="stok" id="stok" value="<?= $row->stok; ?>" autocomplete="off" onkeypress="return restrictAlphabets(event)">
                            <?= form_error('stok', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="satuan" class="col-sm-3 col-form-label">Satuan </label>
                        <div class="col-sm-9">
                            <select name="id_satuan" id="satuan" class="form-control">
                                <?php foreach ($satuan as $s) : ?>
                                    <option value="<?= $s->id_satuan; ?>" <?= $row->id_satuan == $s->nama_satuan ? 'selected' : '' ?>><?= strtolower($s->nama_satuan); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori </label>
                        <div class="col-sm-9">
                            <select name="id_kategori" id="kategori" class="form-control">
                                <?php foreach ($kategori as $s) : ?>
                                    <option value="<?= $s->id_kategori; ?>" <?= $row->id_kategori == $s->nama_kategori ? 'selected' : '' ?>><?= strtolower($s->nama_kategori); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_beli" class="col-sm-3 col-form-label">Total Harga Beli <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="total_harga_beli" id="harga_beli" onkeyup="hitung_harga_satuan()" value="<?= 'Rp ' . number_format($row->total_harga_beli, 0, ',', '.'); ?>" autocomplete="off">
                            <?= form_error('total_harga_beli', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profit" class="col-sm-3 col-form-label">Harga Per Satuan </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" value="<?= 'Rp ' . number_format($row->harga_satuan, 0, ',', '.'); ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual Satuan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="harga_jual" id="harga_jual" onkeyup="hitung()" value="<?= 'Rp ' . number_format($row->harga_jual, 0, ',', '.'); ?>" autocomplete="off">
                            <?= form_error('harga_jual', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profit" class="col-sm-3 col-form-label">Profit</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="profit" id="profit" value="<?= 'Rp ' . number_format($row->profit, 0, ',', '.'); ?>" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    var harga_beli = document.getElementById('harga_beli');
    var harga_jual = document.getElementById('harga_jual');

    harga_beli.addEventListener('keyup', function(e) {
        harga_beli.value = formatRupiah(this.value, 'Rp ');
    });
    harga_jual.addEventListener('keyup', function(e) {
        harga_jual.value = formatRupiah(this.value, 'Rp ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        if (prefix != "") {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        } else {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah = undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
    }

    function restrictAlphabets(e) {
        var x = e.which || e.keycode;
        if ((x >= 48 && x <= 57))
            return true;
        else
            return false;
    }

    function hitung_harga_satuan() {
        let stok = document.getElementById('stok').value;
        let harga_beli = document.getElementById('harga_beli').value;
        let getHargaTot = harga_beli.split(".").join("").split("Rp").join("");
        let total_harga_satuan = getHargaTot / stok;

        // let harga_satuan_idr = formatRupiah(total_harga_satuan, '');
        // let harga_satuan = document.getElementById('harga_satuan').value = harga_satuan_idr;

        if (stok == '') {
            harga_satuan.value = 'Rp 0';
        } else {
            let total_harga_satuan = getHargaTot / stok;
            let value = Math.ceil(total_harga_satuan);
            let harga_satuan_idr = formatRupiah(value, '');
            let harga_satuan = document.getElementById('harga_satuan').value = harga_satuan_idr;
        }
    }

    function hitung() {
        let harga_satuan = document.getElementById('harga_satuan').value;
        let getHargaSatuan = harga_satuan.split(".").join("").split("Rp").join("");
        let harga_jual = document.getElementById('harga_jual').value;
        let getHargaJual = harga_jual.split(".").join("").split("Rp").join("");
        let jumlah = parseInt(getHargaJual) - parseInt(getHargaSatuan);
        let btnSimpan = document.getElementById('btnSimpan');
        let profit = document.getElementById('profit');
        let harga_profit_idr = formatRupiah(jumlah, '');

        // profit.value = harga_profit_idr;

        if (jumlah > 0) {
            profit.value = harga_profit_idr;
            btnSimpan.removeAttribute('disabled');
        } else {
            // profit.value = harga_profit_idr;
            profit.value = "Profit tidak ada";
            btnSimpan.disabled = 'true';
        }

        // if (jumlah > 0) {
        //     btnSimpan.removeAttribute('disabled');
        // } else {
        //     btnSimpan.disabled = 'true';
        // }

        // let harga_satuan = document.getElementById('harga_satuan').value;
        // let harga_jual = document.getElementById('harga_jual').value;
        // let profit = document.getElementById('profit');

        // profit.value = parseInt(harga_jual) - parseInt(harga_satuan);
    }
</script>