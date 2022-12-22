<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Penjualan extends CI_Model
{
    public function getPenjualan()
    {
        $this->db->select('*, barang.nama_barang, penjualan.id as id_penjualan, satuan_barang.nama_satuan, kategori_barang.nama_kategori');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        // $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        $this->db->where('penjualan.kode_penjualan', $this->uri->segment(3));
        return $this->db->get();
    }

    public function getDataPenjualan()
    {
        $this->db->select('*, barang.nama_barang, penjualan.id as id_penjualan, satuan_barang.nama_satuan, kategori_barang.nama_kategori');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        // $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        // $this->db->where('penjualan.kode_penjualan', $this->uri->segment(3));
        return $this->db->get();
    }

    public function getDataPenjualanByTanggal()
    {
        $this->db->select('*, barang.nama_barang, penjualan.id as id_penjualan, satuan_barang.nama_satuan, kategori_barang.nama_kategori');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        // $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        return $this->db->get();
    }

    public function getDataBarang()
    {
        $this->db->select('*, barang.nama_barang, barang.stok as stok_barang, satuan_barang.nama_satuan');
        $this->db->from('barang');
        $this->db->join('data_barang_masuk', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->where('barang.deleted_at', NULL);
        $this->db->order_by('data_barang_masuk.tanggal_masuk', 'desc');
        $this->db->order_by('data_barang_masuk.kode_barang', 'desc');
        // $this->db->order_by('barang.nama_barang', 'asc');
        return $this->db->get();
    }

    public function dataPenjualan()
    {
        $this->db->select('penjualan.*, barang.nama_barang, penjualan.id as id_penjualan, SUM(penjualan.total) as total_belanja, penjualan.kode_penjualan, SUM(barang.profit) as total_profit');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->group_by('kode_penjualan');
        // $this->db->order_by('penjualan.tanggal', 'ASC');
        $this->db->order_by('penjualan.id', 'desc');
        return $this->db->get();
    }

    public function getBerdasarkanTanggal()
    {
        $this->db->select('penjualan.*, barang.nama_barang, penjualan.id as id_penjualan, SUM(penjualan.total) as total_belanja, penjualan.kode_penjualan, SUM(barang.profit) as total_profit');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        // $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('penjualan.kode_penjualan', 'DESC');
        $this->db->group_by('kode_penjualan');
        return $this->db->get();
    }

    public function dataDetailPenjualan($kode_penjualan)
    {
        $this->db->select('penjualan.*, barang.nama_barang, penjualan.id as id_penjualan, SUM(penjualan.total) as total_belanja');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->where('kode_penjualan', $kode_penjualan);
        return $this->db->get();
    }

    public function updateJumlahPenjualan($harga_jual, $id_penjualan)
    {
        $this->db->set('jumlah', 'jumlah + 1', false);
        $this->db->set('total', "total + $harga_jual", false);
        $this->db->where('id', $id_penjualan);
        $this->db->update('penjualan');
    }

    public function updateStokBarang0($kode_barang)
    {
        $stok = "stok - 1";
        $this->db->set('stok', $stok, false);
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('barang');
    }

    public function updateStokBarang($kode_barang)
    {
        $stok = "stok - 1";
        $this->db->set('stok', $stok, false);
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('barang');
    }

    public function updateJumlahPenjualan1($harga_jual, $id_penjualan)
    {
        $this->db->set('jumlah', 'jumlah - 1', false);
        $this->db->set('total', "total - $harga_jual", false);
        $this->db->where('id', $id_penjualan);
        $this->db->update('penjualan');
    }

    public function updateStokBarang1($kode_barang)
    {
        $this->db->set('stok', "stok + 1", false);
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('barang');
    }

    public function updateStokBarang2($jumlah, $kode_barang)
    {
        $this->db->set('stok', "stok + $jumlah", false);
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('barang');
    }

    public function simpanDetailPenjualan()
    {
        $kembalian = $this->input->post('kembalian');
        if ($kembalian < 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Transaksi gagal, Jumlah uang kurang!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            // $penjualan = $this->db->get_where('penjualan', ['id' => $id_penjualan])->row();
            // redirect('penjualan/index/' . $penjualan->kode_penjualan);
        } else {
            $data = [
                'kode_penjualan' => $this->input->post('kode_penjualan'),
                'total_bayar' => $this->input->post('total_bayar'),
                'bayar' => $this->input->post('bayar'),
                'kembalian' => $kembalian,
                // 'id_user' => $this->input->post('id_user')
            ];
            $this->db->insert('detail_penjualan', $data);
        }
    }

    public function getProfitHariIni()
    {
        $tanggalHariIni = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->where('tanggal', $tanggalHariIni);
        return $this->db->get();
    }

    public function getProfitBrilink()
    {
        $tanggalHariIni = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('brilink');
        // $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->where('deleted_at', NULL);
        $this->db->where('tanggal', $tanggalHariIni);
        return $this->db->get();
    }

    public function getTransaksiBrilink()
    {
        $this->db->select('*');
        $this->db->from('brilink');
        // $this->db->where('deleted_at', NULL);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    public function getTransaksiBrilink_by_tanggal()
    {
        $this->db->select('*');
        $this->db->from('brilink');
        // $this->db->where('deleted_at', NULL);
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }
}
