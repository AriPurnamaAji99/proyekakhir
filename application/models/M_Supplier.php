<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Supplier extends CI_Model
{
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->where('deleted_at', NULL);
        $this->db->order_by('tanggal_dibuat', 'desc');
        return $this->db->get();
    }
    public function tambah()
    {
        $data = [
            'nama' => $this->input->post('nama', true),
            'alamat' => $this->input->post('alamat', true),
            'no_hp' => $this->input->post('no_hp', true),
            'keterangan' => $this->input->post('keterangan', true) == '' ? NULL : $this->input->post('keterangan', true),
            'tanggal_dibuat' => date('Y-m-d')
        ];
        $this->db->insert('supplier', $data);
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

    public function getJumlahSupplier()
    {
        $this->db->select('*');
        $this->db->from('supplier');
        $this->db->where('supplier.deleted_at', NULL);
        return $this->db->get();
    }
}
