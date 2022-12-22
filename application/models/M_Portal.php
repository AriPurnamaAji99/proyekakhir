<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Portal extends CI_Model
{

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('pesan');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('role_id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataPortal($id)
    {
        $this->db->where('id_portal', $id);
        $query = $this->db->get('portal');
        return $query->row();
    }

    public function EditDataPortal($data, $id)
    {
        $this->db->where('id_portal', $id);
        $this->db->update('portal', $data);
    }

    public function InsertData($data)
    {
        $this->db->insert('pesan', $data);
    }

    public function DeleteData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pesan');
    }

    public function DeleteDataUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function EditStatusUser($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
}
