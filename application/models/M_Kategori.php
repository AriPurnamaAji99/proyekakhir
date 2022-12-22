<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Kategori extends CI_Model
{

    public function getDataKategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_barang');
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get();
    }

    public function getDataSatuan()
    {
        $this->db->select('*');
        $this->db->from('satuan_barang');
        $this->db->order_by('nama_satuan', 'ASC');
        return $this->db->get();
    }

    public function InsertDataKategori($data)
    {
        $this->db->insert('kategori_barang', $data);
    }

    public function InsertDataSatuan($data)
    {
        $this->db->insert('satuan_barang', $data);
    }

    public function EditDataKategori($data, $id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->update('kategori_barang', $data);
    }

    public function EditDataSatuan($data, $id)
    {
        $this->db->where('id_satuan', $id);
        $this->db->update('satuan_barang', $data);
    }

    public function getDataDetailKategori($id)
    {
        $this->db->where('id_kategori', $id);
        $query = $this->db->get('kategori_barang');
        return $query->row();
    }

    public function getDataDetailSatuan($id)
    {
        $this->db->where('id_satuan', $id);
        $query = $this->db->get('satuan_barang');
        return $query->row();
    }

    public function DeleteDataKategori($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('kategori_barang');
    }

    public function DeleteDataSatuan($id)
    {
        $this->db->where('id_satuan', $id);
        $this->db->delete('satuan_barang');
    }

    public function getJumlahKategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_barang');
        $this->db->where('kategori_barang.deleted_at', NULL);
        return $this->db->get();
    }

    public function getJumlahSatuan()
    {
        $this->db->select('*');
        $this->db->from('satuan_barang');
        $this->db->where('satuan_barang.deleted_at', NULL);
        return $this->db->get();
    }
}
