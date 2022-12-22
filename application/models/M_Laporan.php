<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Laporan extends CI_Model
{
    public function getBerdasarkanTanggal()
    {
        $this->db->select('penjualan.*, barang.harga_jual, barang.profit, barang.nama_barang, kategori_barang.nama_kategori, SUM(penjualan.jumlah) as jumlah_beli, SUM(penjualan.total) as total_beli, satuan_barang.nama_satuan');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('satuan_barang', 'satuan_barang.id_satuan = barang.id_satuan', 'left');
        $this->db->join('kategori_barang', 'kategori_barang.id_kategori = barang.id_kategori', 'left');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        // $this->db->or_where('kategori', $this->input->post('kategori'));
        $this->db->group_by('penjualan.kode_barang');
        return $this->db->get();
    }

    public function pengeluaranBerdasarkanTanggal()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('data_barang_masuk', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        $this->db->where('tanggal_masuk >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal_masuk <=', $this->input->post('tgl_akhir'));
        return $this->db->get();
    }

    public function brilinkBerdasarkanTanggal()
    {
        $this->db->select('*');
        $this->db->from('brilink');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        $this->db->where('deleted_at', NULL);
        return $this->db->get();
    }

    // public function tampilData()
    // {
    //     $this->db->select('*');
    //     $this->db->from('penjualan');
    //     return $this->db->get();
    // }

    public function getData()
    {
        // $search = "kategori='minuman'";
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('penjualan', 'penjualan.kode_barang = barang.kode_barang', 'left');
        // $this->db->where($search);
        return $this->db->get();
    }
}
