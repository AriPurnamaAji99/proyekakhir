<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kategori');
        $this->load->library('form_validation');
    }

    public function index()
    {
    }

    public function kategori()
    {
        $data['title'] = 'Kategori Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get_where('kategori_barang', ['deleted_at' => NULL])->result();
        // $data['rows'] = $this->M_Kategori->getDataKategori()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('data-master/kategori_barang', $data);
        $this->load->view('templates/footer');
    }

    public function satuan()
    {
        $data['title'] = 'Satuan Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get_where('satuan_barang', ['deleted_at' => NULL])->result();
        // $data['rows'] = $this->M_Kategori->getDataSatuan()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas_gudang', $data);
        $this->load->view('data-master/satuan_barang', $data);
        $this->load->view('templates/footer');
    }

    public function insertKategori()
    {
        $nama_kategori = $this->input->post('nama_kategori');

        $DataInsert = array(
            'nama_kategori' => $nama_kategori,
        );

        $this->M_Kategori->InsertDataKategori($DataInsert);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('Data_master/kategori');
    }

    public function insertSatuan()
    {
        $nama_satuan = $this->input->post('nama_satuan');

        $DataInsert = array(
            'nama_satuan' => $nama_satuan,
        );

        $this->M_Kategori->InsertDataSatuan($DataInsert);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect(base_url('Data_master/satuan'));
    }

    public function editKategori()
    {
        $data['title'] = 'Edit Kategori Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $recordKategori = $this->M_Kategori->getDataDetailKategori($id);
        // $DATA = array('data_kategori' => $recordKategori);

        $id_kategori = $this->input->post('id_kategori');
        $nama_kategori = $this->input->post('nama_kategori');

        $DataUpdate = array(
            'nama_kategori' => $nama_kategori,
        );

        $this->form_validation->set_rules('nama_kategori', 'Nama', 'trim|required', [
            'required' => 'Nama kategori tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('data-master/edit_kategori_barang');
            $this->load->view('templates/footer');
        } else {
            $this->M_Kategori->EditDataKategori($DataUpdate, $id_kategori);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect(base_url('Data_master/kategori'));
        }
    }

    public function editSatuan()
    {
        $data['title'] = 'Edit Satuan Barang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $recordSatuan = $this->M_Kategori->getDataDetailSatuan($id);
        // $DATA = array('data_satuan' => $recordSatuan);

        $id_satuan = $this->input->post('id_satuan');
        $nama_satuan = $this->input->post('nama_satuan');

        $DataUpdate = array(
            'nama_satuan' => $nama_satuan,
        );

        $this->form_validation->set_rules('nama_satuan', 'Nama', 'trim|required', [
            'required' => 'Nama kategori tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas_gudang', $data);
            $this->load->view('data-master/edit_satuan_barang');
            $this->load->view('templates/footer');
        } else {
            $this->M_Kategori->EditDataSatuan($DataUpdate, $id_satuan);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect(base_url('Data_master/satuan'));
        }
    }

    public function hapusKategori($id_kategori)
    {
        // $this->M_Kategori->DeleteDataKategori($id_kategori);
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $this->db->set('deleted_at', $waktu);
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('kategori_barang');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect(base_url('Data_master/kategori'));
    }

    public function hapusSatuan($id_satuan)
    {
        // $this->M_Kategori->DeleteDataSatuan($id_satuan);
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $this->db->set('deleted_at', $waktu);
        $this->db->where('id_satuan', $id_satuan);
        $this->db->update('satuan_barang');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect(base_url('Data_master/satuan'));
    }
}
