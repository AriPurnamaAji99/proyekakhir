<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kategori');
    }

    public function index()
    {
        $data['title'] = 'Kategori Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $recordKategori = $this->M_Kategori->getDataKategori();
        $DATA = array('data_kategori' => $recordKategori);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('data-master/kategori_barang', $DATA);
        $this->load->view('templates/footer');
    }

    public function AksiInsert()
    {
        $nama_kategori = $this->input->post('nama_kategori');

        $DataInsert = array(
            'nama_kategori' => $nama_kategori,
        );

        $this->M_Kategori->InsertDataKategori($DataInsert);
        redirect(base_url('Kategori'));
    }

    public function formEdit($id)
    {
        $data['title'] = 'Edit Kategori Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $recordKategori = $this->M_Kategori->getDataDetailKategori($id);
        $DATA = array('data_kategori' => $recordKategori);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('data-master/form_edit', $DATA);
        $this->load->view('templates/footer');
    }

    public function AksiEdit()
    {
        $id_kategori = $this->input->post('id_kategori');
        $nama_kategori = $this->input->post('nama_kategori');

        $DataUpdate = array(
            'nama_kategori' => $nama_kategori,
        );

        $this->M_Kategori->EditDataKategori($DataUpdate, $id_kategori);
        redirect(base_url('Kategori'));
    }

    public function AksiDeleteData($id_kategori)
    {
        $this->M_Kategori->DeleteDataKategori($id_kategori);
        redirect(base_url('Kategori'));
    }
}
