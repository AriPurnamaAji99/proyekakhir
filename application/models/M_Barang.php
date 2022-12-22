<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Barang extends CI_Model
{
    public function getBarang()
    {
        $this->db->select('*, supplier.nama as nama_supplier, barang.nama_barang, barang.kode_barang, kategori_barang.nama_kategori, satuan_barang.nama_satuan');
        $this->db->from('barang');
        $this->db->join('supplier', 'supplier.id = barang.id_supplier', 'left');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->where('barang.deleted_at', NULL);
        $this->db->order_by('kode_barang', 'desc');
        return $this->db->get();
    }

    public function getJumlahBarang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('barang.deleted_at', NULL);
        return $this->db->get();
    }

    public function getBarangMasuk()
    {
        // $this->db->select('*, supplier.nama as nama_supplier, data_barang_masuk.nama_barang, data_barang_masuk.kode_barang, kategori_barang.nama_kategori, satuan_barang.nama_satuan');
        $this->db->select('*, data_barang_masuk.stok as stok_barang_masuk');
        $this->db->from('data_barang_masuk');
        $this->db->join('barang', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        $this->db->join('supplier', 'supplier.id = barang.id_supplier', 'left');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->order_by('data_barang_masuk.tanggal_masuk', 'DESC');
        return $this->db->get();
    }

    public function getBarangKeluar()
    {
        $this->db->select('*, barang.nama_barang, penjualan.id as id_penjualan');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('data_barang_masuk', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    public function getKodeBarang()
    {
        $this->db->select('MAX(kode_barang) as KD');
        $this->db->from('barang');
        return $this->db->get();
    }

    public function getBerdasarkanTanggal()
    {
        $this->db->select('*, data_barang_masuk.stok as stok_barang_masuk, data_barang_masuk.total_harga_beli as beli_barang_masuk');
        $this->db->from('data_barang_masuk');
        $this->db->join('barang', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        // $this->db->join('data_barang_masuk', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        $this->db->join('supplier', 'supplier.id = barang.id_supplier', 'left');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->where('data_barang_masuk.tanggal_masuk >=', $this->input->post('tgl_awal'));
        $this->db->where('data_barang_masuk.tanggal_masuk <=', $this->input->post('tgl_akhir'));
        $this->db->where('barang.deleted_at', NULL);
        $this->db->order_by('data_barang_masuk.tanggal_masuk', 'DESC');
        return $this->db->get();
    }


    public function tambah()
    {
        $data = [
            'id_supplier' => $this->input->post('id_supplier', true),
            'kode_barang' => $this->input->post('kode_barang', true),
            'nama' => $this->input->post('nama', true),
            'stok' => $this->input->post('stok', true),
            'harga_beli' => $this->input->post('harga_beli', true),
            'harga_jual' => $this->input->post('harga_jual', true),
            'profit' => $this->input->post('profit', true),
            'satuan' => $this->input->post('satuan', true),
            'kategori' => $this->input->post('kategori', true),
            'tanggal_masuk' => $this->input->post('tanggal_masuk', true)
        ];
        $this->db->insert('barang', $data);
    }

    public function edit()
    {
        $hilangRp1 = str_replace('Rp', '', $this->input->post('total_harga_beli', true));
        $hilangRp2 = str_replace('Rp', '', $this->input->post('harga_satuan', true));
        $hilangRp3 = str_replace('Rp', '', $this->input->post('harga_jual', true));
        $hilangRp4 = str_replace('Rp', '', $this->input->post('profit', true));
        $profit = str_replace('.', '', $hilangRp4);
        $data = [
            'kode_barang' => $this->input->post('kode_barang', true),
            'nama_barang' => $this->input->post('nama_barang', true),
            'stok' => $this->input->post('stok', true),
            'total_harga_beli' => str_replace('.', '', $hilangRp1),
            'harga_satuan' => str_replace('.', '', $hilangRp2),
            'harga_jual' => str_replace('.', '', $hilangRp3),
            'profit' => $profit,
            'id_satuan' => $this->input->post('id_satuan', true),
            'id_kategori' => $this->input->post('id_kategori', true),
            'id_supplier' => $this->input->post('id_supplier', true)
        ];
        $this->db->where('kode_barang', $this->input->post('kode_barang', true));
        $this->db->update('barang', $data);
    }

    public function get_data_modal()
    {
        $this->db->select('*');
        $this->db->from('modal');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    public function getBerdasarkanTanggalPenjualan()
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('data_barang_masuk', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }
}
