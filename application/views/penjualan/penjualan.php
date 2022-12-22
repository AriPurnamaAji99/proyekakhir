<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header">
            Petugas : <?= $user['nama_lengkap']; ?>,
            <?php
            date_default_timezone_set('Asia/Jakarta');
            echo "<font color='red' face='arial bold'>";
            echo date('d M Y, H:i:s');
            echo "</font>";
            ?>
        </div>
        <div class="card-body">
            <form action="<?= base_url('penjualan/simpanBarang') ?>" method="POST">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Kode Penjualan</label>
                            <input type="text" name="kode_penjualan" class="form-control" value="<?= $this->uri->segment(3) ?>" readonly>
                            <input type="hidden" name="id_user" id="" value="<?= $user['id']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group input-group mt-2">
                            <input type="text" name="kode_barang" id="kode_barang" class="form-control mt-4" placeholder="Kode Barang" autofocus autocomplete="off">
                            <a href="" class="btn btn-success btn-sm newSatuanModalButton mt-4" data-toggle="modal" data-target="#newSatuanModal"><i class="fas fa-search"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"><br>
                            <button type="submit" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-cart-arrow-down"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col md-9">
                    <table class="table">
                        <thead class="bg-light">
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php
                            $totalbayar = 0;
                            foreach ($penjualan as $pen) : ?>
                                <tr>
                                    <td><?= $pen->kode_barang; ?></td>
                                    <td><?= strtolower($pen->nama_barang); ?></td>
                                    <td>Rp <?= number_format($pen->harga_jual, 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="<?= base_url('penjualan/kurangiJumlah/') . $pen->id_penjualan ?>" class="badge badge-secondary"><i class="fas fa-minus"></i></a>
                                        <?= $pen->jumlah; ?>
                                        <a href="<?= base_url('penjualan/tambahJumlah/') . $pen->id_penjualan ?>" class="badge badge-secondary"><i class="fas fa-plus"></i></a>
                                    </td>
                                    <td>Rp <?= number_format($pen->total, 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="<?= base_url('penjualan/hapus/') . $pen->id_penjualan ?>" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php $totalbayar += $pen->total ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <!-- <form action="" method="POST"> -->
                    <div class="form-group">
                        <label for="">Total Beli</label>
                        <input type="hidden" name="kode_penjualan" id="kode_penjualan" value="<?= $this->uri->segment(3) ?>">
                        <input type="text" name="total_bayar" id="total_bayar" class="form-control" placeholder="Total Bayar" value="<?= 'Rp ' . number_format($totalbayar, 0, ',', '.'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Bayar <span class="text-danger">*</span></label>
                        <input type="text" name="bayar" id="bayar" class="form-control" placeholder="" required onkeyup="hitung()" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Kembalian</label>
                        <input type="text" name="kembalian" id="kembalian" class="form-control" placeholder="" readonly>
                        <input type="hidden" name="id_user" id="id_user" value="<?= $user['id']; ?>">
                    </div>
                    <button type="button" id="btn_transaksi" class="btn btn-success btn-sm btn-block" disabled="true"><i class="fas fa-cart-arrow-down"></i> Proses Transaksi</button>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        <div class="card-footer">
            <p><i>Keterangan: <br> tanda (<span class="text-danger">*</span>) artinya inputan harus diisi</i></p>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="newSatuanModal" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSatuanModalLabel">Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background-color: #DCDCDC;" class="text-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($barang as $row) :
                            ?>
                                <?php if ($row->stok <= 0) : ?>
                                    <tr style="background-color:  #ffcccc;">
                                    <?php else : ?>
                                    <tr>
                                    <?php endif; ?>
                                    <td><?= $count++; ?></td>
                                    <td><?= $row->kode_barang; ?></td>
                                    <td width="150px"><?= strtolower($row->nama_barang); ?></td>
                                    <td><?= $row->stok_barang . ' ' . $row->nama_satuan; ?></td>
                                    <td>Rp <?= number_format($row->harga_jual, 0, ',', '.'); ?></td>
                                    <td>
                                        <?php if ($row->stok <= 0) : ?>
                                            <button class="badge badge-success" id="select" data-id="<?= $row->kode_barang; ?>" disabled>
                                                <i class="fas fa-check"></i> Pilih
                                            </button>
                                        <?php else : ?>
                                            <button class="badge badge-success" id="select" data-id="<?= $row->kode_barang; ?>">
                                                <i class="fas fa-check"></i> Pilih
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    var rupiah = document.getElementById('bayar');

    rupiah.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp ');
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

    function hitung() {
        let total_bayar = document.getElementById('total_bayar').value;
        let getTotal_Bayar = total_bayar.split(".").join("").split("Rp").join("");
        // let getTotal_Bayar2 = getTotal_Bayar1.split(".").join("");
        let bayar = document.getElementById('bayar').value;
        let getBayar = bayar.split(".").join("").split("Rp").join("");
        let kembalian = document.getElementById('kembalian');
        let btn_transaksi = document.getElementById('btn_transaksi');

        let jumlah = parseInt(getBayar) - parseInt(getTotal_Bayar);
        let rupiahJumlah = formatRupiah(jumlah, '');
        kembalian.value = rupiahJumlah;

        if (jumlah >= 0) {
            btn_transaksi.removeAttribute('disabled');
        } else {
            kembalian.value = 'uang bayar tidak cukup';
            btn_transaksi.disabled = 'true';
        }
    }

    $(document).ready(function() {
        $(document).on('click', '#select', function() {
            var kode_barang = $(this).data('id');
            $('#kode_barang').val(kode_barang);
            $('#newSatuanModal').modal('hide');
        })
    })

    $(document).on('click', '#btn_transaksi', function() {
        let kode_penjualan = $('#kode_penjualan').val();
        let total_bayar = $('#total_bayar').val();
        let getTotal_Bayar = total_bayar.split(".").join("").split("Rp").join("");
        let bayar = $('#bayar').val();
        let getBayar = bayar.split(".").join("").split("Rp").join("");
        let kembalian = $('#kembalian').val();
        let getKembalian = kembalian.split(".").join("").split("Rp").join("");
        // let id_user = $('#id_user').val();

        if (bayar == "") {
            alert('Nominal uang belum diinputkan');
            $('#bayar').focus();
        } else {
            $.ajax({
                type: 'post',
                url: '<?= base_url('penjualan/simpanDetailPenjualan') ?>',
                dataType: 'json',
                data: {
                    'kode_penjualan': kode_penjualan,
                    'total_bayar': getTotal_Bayar,
                    'bayar': getBayar,
                    'kembalian': getKembalian,
                    // 'id_user': id_user
                },
                success: function(result) {
                    if (result.success == true) {
                        alert('Proses transaksi berhasil');
                        window.open('<?= base_url('penjualan/struk/' . $this->uri->segment(3)) ?>', '_blank');
                    }
                    window.location.href = '<?= base_url('penjualan/index/' . getKodePenjualan()) ?>';
                }
            })
        }
    })
</script>