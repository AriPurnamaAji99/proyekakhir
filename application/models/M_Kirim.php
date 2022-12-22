<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Kirim extends CI_Model
{
    public function tambah()
    {
        $data = [
            'bulan' => $this->input->post('bulan', true),
            'laporan_penjualan' => $_FILES['laporan_penjualan'],
            'laporan_labarugi' => $_FILES['laporan_labarugi'],
            'laporan_neraca' => $_FILES['laporan_neraca'],
            'status' => 'proses',
            'feedback' => $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true)
        ];
        $this->db->insert('data_laporan', $data);
    }

    public function edit()
    {
        $data = [
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'alamat' => $this->input->post('alamat', true),
            'no_hp' => $this->input->post('no_hp', true),
            'keterangan' => $this->input->post('keterangan', true) == '' ? NULL : $this->input->post('keterangan', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('supplier', $data);
    }

    public function getLaporanPenjualan()
    {
        $this->db->select('*');
        $this->db->from('data_laporan');
        // $this->db->order_by("status", "asc");
        $this->db->order_by("status", "asc");
        return $this->db->get();
    }

    public function getLaporanLabaRugi()
    {
        $this->db->select('*');
        $this->db->from('data_laporan_laba_rugi');
        $this->db->order_by('id_laporan', 'desc');
        return $this->db->get();
    }
}
