<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Pengawas extends CI_Model
{
    public function getProfit()
    {
        // $tanggalHariIni = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        // $this->db->where('tanggal', $tanggalHariIni);
        return $this->db->get();
    }

    public function getProfitBrilink()
    {
        // $tanggalHariIni = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('brilink');
        // $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->where('deleted_at', NULL);
        // $this->db->where('tanggal', $tanggalHariIni);
        return $this->db->get();
    }

    public function getPengeluaran()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('deleted_at', NULL);
        return $this->db->get();
    }

    public function getProfitByTanggal()
    {
        // $tanggalHariIni = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->join('data_barang_masuk', 'data_barang_masuk.kode_barang = penjualan.kode_barang', 'left');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        // $this->db->where('tanggal', $tanggalHariIni);
        return $this->db->get();
    }

    public function getProfitBrilinkByTanggal()
    {
        // $tanggalHariIni = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('brilink');
        // $this->db->join('barang', 'barang.kode_barang = penjualan.kode_barang', 'left');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        $this->db->where('deleted_at', NULL);
        // $this->db->where('tanggal', $tanggalHariIni);
        return $this->db->get();
    }

    public function getPengeluaranByTanggal()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('data_barang_masuk', 'data_barang_masuk.kode_barang = barang.kode_barang', 'left');
        $this->db->where('data_barang_masuk.tanggal_masuk >=', $this->input->post('tgl_awal'));
        $this->db->where('data_barang_masuk.tanggal_masuk <=', $this->input->post('tgl_akhir'));
        $this->db->where('deleted_at', NULL);
        return $this->db->get();
    }

    public function edit()
    {
        $data = [
            'id_laporan' => $this->input->post('id_laporan', true),
            'bulan' => $this->input->post('bulan', true),
            'laporan_penjualan' => $this->input->post('laporan_penjualan', true),
            'laporan_labarugi' => $this->input->post('laporan_labarugi', true),
            'laporan_neraca' => $this->input->post('laporan_neraca', true),
            'status' => $this->input->post('status', true),
            'feedback' => $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true)
        ];
        $this->db->where('id_laporan', $this->input->post('id_laporan'));
        $this->db->update('data_laporan', $data);
    }

    public function user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $status = array('on', 'proses');
        $this->db->where_in('is_active', $status);
        $this->db->order_by('created_at', 'desc');
        return $this->db->get();
    }
}
