<?php
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . '-' . $bulan . '-' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "01";
            break;
        case 2:
            return "02";
            break;
        case 3:
            return "03";
            break;
        case 4:
            return "04";
            break;
        case 5:
            return "05";
            break;
        case 6:
            return "06";
            break;
        case 7:
            return "07";
            break;
        case 8:
            return "08";
            break;
        case 9:
            return "09";
            break;
        case 10:
            return "10";
            break;
        case 11:
            return "11";
            break;
        case 12:
            return "12";
            break;
    }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('penjualan/data_penjualan') ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <div class="kotak">
                <h2 align="center">BUMDes Karya Mandiri</h2>
                <p align="center" class="p1">Jl. Desa Ciangir Dusun 1 Rt 01 Rw 01</p>
                <table border="0" width="70%" align="left" class="mt-5 mb-3">
                    <tr>
                        <th align="left">Kode Penjualan</th>
                        <td><?= $this->uri->segment(3) ?></td>
                    </tr>
                    <tr>
                        <th align="left">Nama Petugas</th>
                        <?php foreach ($penjualan as $pen) : ?>
                            <?php $nama_petugas = $this->db->query("SELECT nama_lengkap FROM user WHERE id = $pen->id_user")->row(); ?>
                        <?php endforeach; ?>
                        <td><?= $nama_petugas->nama_lengkap; ?></td>
                    </tr>
                    <tr>
                        <th align="left">Tanggal dan Waktu Transaksi</th>
                        <?php $tanggalBeli = tgl_indo($tanggal_beli->tanggal); ?>
                        <td><?= $tanggalBeli; ?> <?= $tanggal_beli->jam; ?></td>
                    </tr>
                </table>
                <table border="1" width="100%" style="border-collapse: collapse;" cellpadding="5" cellspacing="5">
                    <tr>
                        <th align="left">Nama Barang</th>
                        <th align="left">Harga Satuan</th>
                        <th align="left">Jumlah Beli</th>
                        <th align="left">Total Harga</th>
                    </tr>
                    <?php foreach ($penjualan as $pen) : ?>
                        <tr>
                            <td><?= $pen->nama_barang; ?></td>
                            <td>Rp <?= number_format($pen->harga_jual, 0, ',', '.') . ' / ' . $pen->nama_satuan; ?></td>
                            <td><?= $pen->jumlah . ' ' . $pen->nama_satuan; ?></td>
                            <td>Rp <?= number_format($pen->harga_jual * $pen->jumlah, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th align="right" colspan="3">Total Belanja </th>
                        <td>Rp <?= number_format($detail_penjualan->total_bayar, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th align="right" colspan="3">Bayar </th>
                        <td>Rp <?= number_format($detail_penjualan->bayar, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th align="right" colspan="3">Kembalian </th>
                        <td>Rp <?= number_format($detail_penjualan->kembalian, 0, ',', '.'); ?></td>
                    </tr>
                </table>
                <!-- <p align="center" class="">Terima kasih sudah berbelanja ditempat kami.</p> -->
                <!-- <p align="center">-----------------------------------</p> -->
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->