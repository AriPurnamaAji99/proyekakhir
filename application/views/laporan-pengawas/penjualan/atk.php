<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
    <!------------------------->
    <div class="card" style="box-shadow: 0 2px 4px rgba(0,0,0,0.6);">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link " href="<?= base_url('pengawas/gas') ?>">Gas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= base_url('pengawas/atk') ?>">ATK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('pengawas/sembako') ?>">Sembako</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('pengawas/minuman') ?>">Minuman</a>
                </li>
            </ul>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between ml-4 mt-2">
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-success btn-sm">
                Januari
            </button> -->
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Harga Total</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Kategori</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $totalunit = 0;
                        $totalpendapatan = 0;
                        $count = 0;
                        foreach ($data_penjualan_atk as $row) :
                            $count = $count + 1;
                        ?>
                            <tr>
                                <td class="text-center"><?= $count ?></td>
                                <td><?= $row->nama_barang ?></td>
                                <td><?= $row->jumlah_beli ?></td>
                                <td>Rp. <?= number_format($row->harga_total) ?></td>
                                <td><?= $row->kategori ?></td>
                                <td><?= $row->tanggal ?></td>
                            </tr>
                            <?php $totalunit += $row->jumlah_beli ?>
                            <?php $totalpendapatan += $row->harga_total ?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="bg-light">
                        <tr>
                            <th colspan="2">Total</th>
                            <th><?= $totalunit; ?></th>
                            <th colspan="3">Rp. <?= number_format($totalpendapatan); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div> <br>
    <!------------------------->

</div>
<!-- /.container-fluid -->
</div>