<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('barang/tambah') ?>" class="btn btn-success btn-sm">Tambah Barang</a>
        </div>
        <div class="card-body">

            <div class="table-responsive table-hover">
                <!-- <div class="card" style="width: 18rem;"> -->
                <hr>
                <!-- </div><br> -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Satuan</th>
                            <th>Harga Jual</th>
                            <th>Profit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        $total_pengeluaran = 0;
                        $sisa_modal = 0; ?>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= strtoupper($row->nama_supplier); ?></td>
                                <td><?= $row->kode_barang; ?></td>
                                <td><?= strtolower($row->nama_barang); ?></td>
                                <td><?= $row->nama_kategori; ?></td>
                                <td><?= $row->stok . ' ' . $row->nama_satuan ?></td>
                                <td>Rp.<?= number_format($row->total_harga_beli, 0, ',', '.'); ?></td>
                                <td>Rp.<?= number_format($row->harga_satuan, 0, ',', '.') . '/' . $row->nama_satuan; ?></td>
                                <td>Rp.<?= number_format($row->harga_jual, 0, ',', '.') . '/' . $row->nama_satuan; ?></td>
                                <td>Rp.<?= number_format($row->profit, 0, ',', '.') . '/' . $row->nama_satuan ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('barang/edit/') . $row->kode_barang; ?>" class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="edit data"><i class="fas fa-pencil-alt"></i></a>
                                    <!-- <a href="" class="badge badge-danger newSatuanModalButton" data-toggle="modal" data-target="#hapusBarang<?= $row->kode_barang; ?>" data-toggle="tooltip" data-placement="top" title="hapus data"><i class="fas fa-trash-alt"></i></a> -->
                                </td>
                            </tr>
                        <?php
                            $total_pengeluaran += $row->total_harga_beli;
                            $sisa_modal = 5000000 - $total_pengeluaran;
                        endforeach; ?>
                    </tbody>
                </table>
                <hr>
                <!-- <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="card-title">Pengeluaran : Rp. <?= number_format($total_pengeluaran, 0, ',', '.'); ?></h5>
                            <h5 class="card-title">Sisa Modal : Rp. <?= number_format($sisa_modal, 0, ',', '.'); ?></h5>
                        </div>
                        <div class="col-md-8 text-left">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Hapus-->
<?php
$count = 0;
foreach ($rows as $row) :
    $count = $count++;
?>
    <div class="modal fade" id="hapusBarang<?= $row->kode_barang; ?>" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="exampleModalCenterTitle"><img src="<?= base_url('assets/img/icon/hapus.jpg') ?>" width="70" class="rounded-circle" height="60" alt="">Yakin anda akan menghapus data ini?</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <a href="<?= base_url('barang/hapus/') . $row->kode_barang; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal tambah modal-->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="newSatuanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-center" id="exampleModalCenterTitle">Form Tambah Modal</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('barang/tambah_modal') ?>" method="post">
                <div class="modal-body">
                    <label for="">Nominal:</label>
                    <input type="number" class="form-control" name="nominal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>