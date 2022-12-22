<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Supplier');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Supplier';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->db->get_where('supplier', ['deleted_at' => NULL])->result();
        $data['rows'] = $this->M_Supplier->getData()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('supplier/supplier', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Supplier';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'Alamat tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required', [
            'required' => 'No HP tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('supplier/tambah_supplier', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Supplier->tambah();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('supplier');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Supplier';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->db->get_where('supplier', ['id' => $id])->row();

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', [
            'required' => 'Alamat tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('no_hp', 'No Hp', 'trim|required', [
            'required' => 'No HP tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('supplier/edit_supplier', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Supplier->edit();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('supplier');
        }
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        // $this->db->delete('supplier');
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $this->db->set('deleted_at', $waktu);
        $this->db->where('id', $id);
        $this->db->update('supplier');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        }
        redirect('supplier');
    }
}
