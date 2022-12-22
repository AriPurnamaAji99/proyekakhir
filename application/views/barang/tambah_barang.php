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
                <form action="" method="POST" id="formTambahBarang">
                    <div class="row mb-3">
                        <label for="tanggal_masuk" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <?php
                            date_default_timezone_set('Asia/Jakarta');
                            $waktu = date("Y-m-d");
                            ?>
                            <input type="date" class="form-control form-control" name="tanggal_masuk" id="tanggal_masuk" value="<?= $waktu; ?>" readonly>
                            <?= form_error('tanggal_masuk', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_supplier" class="col-sm-3 col-form-label">Nama Supplier </label>
                        <div class="col-sm-9">
                            <select name="id_supplier" id="id_supplier" class="form-control">
                                <?php foreach ($supplier as $s) : ?>
                                    <option value="<?= $s->id; ?>"><?= strtoupper($s->nama . ' - ' . $s->keterangan); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kode_barang" class="col-sm-3 col-form-label">Kode Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control" name="kode_barang" id="kode_barang" value="<?= 'KDB' . sprintf('%04s', $kode_barang) ?>" readonly>
                            <?= form_error('kode_barang', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Barang <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control" name="nama_barang" id="nama" value="<?= set_value('nama_barang'); ?>" autocomplete="off" maxlength="45">
                            <?= form_error('nama_barang', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stok" class="col-sm-3 col-form-label">Stok <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control" name="stok" id="stok" value="<?= set_value('stok'); ?>" autocomplete="off" onkeypress="return restrictAlphabets(event)">
                            <?= form_error('stok', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                        <div class="col-sm-9">
                            <select name="id_satuan" id="satuan" class="form-control">
                                <?php foreach ($satuan as $s) : ?>
                                    <option value="<?= $s->id_satuan; ?>" <?= ($s->nama_satuan == set_value('satuan')) ? 'selected' : '' ?>><?= strtolower($s->nama_satuan); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select name="id_kategori" id="kategori" class="form-control">
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k->id_kategori; ?>" <?= ($k->nama_kategori == set_value('kategori')) ? 'selected' : '' ?>><?= strtolower($k->nama_kategori); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_beli" class="col-sm-3 col-form-label">Total Harga Beli <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="total_harga_beli" id="total_harga_beli" class="form-control" placeholder="" onkeyup="hitung_harga_satuan()" value="<?= set_value('total_harga_beli'); ?>" autocomplete="off">
                            <?= form_error('total_harga_beli', '<span class="text-danger small pl-3">', '</span>') ?>
                            <!-- <span class="text">
                                Rp.
                            </span>
                            <input type="text" class="form-control form-control money angkaSemua" name="total_harga_beli" id="total_harga_beli" onkeyup="hitung_harga_satuan()" value="<?= set_value('total_harga_beli'); ?>" autocomplete="off"> -->
                        </div>
                    </div>
                    <!-- <div class="row"mb-3">
                        <label for="harga_beli" class="col-sm-3 col-form-label">Total Harga Beli</label>
                        <div class="col-sm-9">
                            <div class="prepend">
                                <span class="text">Rp.</span>
                            </div>
                            <input type="number" class="form-control form-control-sm" name="total_harga_beli" id="total_harga_beli" onkeyup="hitung_harga_satuan()" value="<?= set_value('total_harga_beli'); ?>" autocomplete="off">
                            <?= form_error('total_harga_beli', '<span class="text-danger small pl-3">', '</span>') ?>
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label for="profit" class="col-sm-3 col-form-label">Harga Per Satuan </label>
                        <div class="col-sm-9">
                            <!-- <span class="text">
                                Rp.
                            </span> -->
                            <input type="text" class="form-control form-control satuan" name="harga_satuan" id="harga_satuan" value="<?= set_value('harga_satuan') ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual Satuan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control" name="harga_jual" id="harga_jual" onkeyup="hitung()" value="<?= set_value('harga_jual'); ?>" autocomplete="off">
                            <?= form_error('harga_jual', '<span class="text-danger small pl-3">', '</span>') ?>
                            <!-- <span class="text">
                                Rp.
                            </span> -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profit" class="col-sm-3 col-form-label">Profit </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control" name="profit" id="profit" onchange="validasi()" value="<?= set_value('profit') ?>" readonly>
                            <!-- <span class="text">
                                Rp.
                            </span> -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm float-right" id="btnSimpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    var total_harga_beli = document.getElementById('total_harga_beli');
    var harga_jual = document.getElementById('harga_jual');

    total_harga_beli.addEventListener('keyup', function(e) {
        total_harga_beli.value = formatRupiah(this.value, 'Rp ');
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
        let harga_satuan = document.getElementById('harga_satuan');
        let total_harga_beli = document.getElementById('total_harga_beli').value;
        let getHargaTot = total_harga_beli.split(".").join("").split("Rp").join("");

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

        if (jumlah > 0) {
            profit.value = harga_profit_idr;
            btnSimpan.removeAttribute('disabled');
        } else {
            let value = 'Rp ';
            // profit.value = value.concat(jumlah);
            profit.value = "Profit tidak ada";
            btnSimpan.disabled = 'true';
        }
    }
</script>