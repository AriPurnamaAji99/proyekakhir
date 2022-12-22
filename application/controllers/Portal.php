<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Portal');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'BUMDes Karya Mandiri';
        $data['data_portal'] = $this->db->get('portal')->row();
        $this->load->view('portal/index', $data);
    }

    public function profile()
    {
        $judul['title'] = 'BUMDes Karya Mandiri';
        $this->load->view('portal/profile', $judul);
    }

    public function insertPesan()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $no_hp = $this->input->post('no_hp');
        $pesan = $this->input->post('pesan');

        $DataInsert = array(
            'nama' => $nama,
            'email' => $email,
            'no_hp' => $no_hp,
            'pesan' => $pesan
        );

        echo '<script type="text/javascript">';
        echo 'alert("Pesan berhasil dikirim")';
        echo '</script>';
        // $this->db->insert('pesan', $DataInsert);
        redirect('portal');
    }

    public function pesan()
    {
        $recordPesan = $this->M_Portal->getData();
        $DATA = array('data_pesan' => $recordPesan);

        $judul['title'] = 'List Pesan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $judul);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('portal/list_pesan', $DATA);
        $this->load->view('templates/footer');
    }

    public function manage()
    {
        $data['title'] = 'Manage Portal';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('portal')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('portal/manage_portal', $data);
        $this->load->view('templates/footer');
    }

    public function edit_judul1($id)
    {
        $data['title'] = 'Edit Judul 1';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_portal'] = $this->M_Portal->getDataPortal($id);

        $id_portal = $this->input->post('id_portal');
        $judul_1 = $this->input->post('judul_1');

        $DataUpdate = array(
            'judul_1' => $judul_1,
        );

        $this->form_validation->set_rules('judul_1', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('portal/edit_judul1', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Portal->EditDataPortal($DataUpdate, $id_portal);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Judul 1</strong> berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
        }
    }

    public function edit_judul2($id)
    {
        $data['title'] = 'Edit Judul 2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_portal'] = $this->M_Portal->getDataPortal($id);

        $id_portal = $this->input->post('id_portal');
        $judul_2 = $this->input->post('judul_2');

        $DataUpdate = array(
            'judul_2' => $judul_2,
        );

        $this->form_validation->set_rules('judul_2', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('portal/edit_judul1', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Portal->EditDataPortal($DataUpdate, $id_portal);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Judul 2</strong> berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
        }
    }

    public function edit_judul3($id)
    {
        $data['title'] = 'Edit Judul 2';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_portal'] = $this->M_Portal->getDataPortal($id);

        $id_portal = $this->input->post('id_portal');
        $judul_3 = $this->input->post('judul_3');

        $DataUpdate = array(
            'judul_3' => $judul_3,
        );

        $this->form_validation->set_rules('judul_3', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('portal/edit_judul1', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Portal->EditDataPortal($DataUpdate, $id_portal);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Judul 3</strong> berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
        }
    }

    public function edit_gambar1()
    {
        $data['title'] = 'Edit Gambar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $gambar_1 = $_FILES['gambar_1'];

        $config['upload_path'] = './assets/img/slider/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar_1')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> <strong>Gambar 1 </strong>gagal di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
            die;
        } else {
            $gambar_1 = $this->upload->data('file_name');
        }

        $data = array(
            'gambar_1' => $gambar_1
        );

        $this->db->update('portal', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Gambar 1 </strong>berhasil di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('portal/manage');
    }

    public function edit_gambar2()
    {
        $data['title'] = 'Edit Gambar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $gambar_1 = $_FILES['gambar_2'];

        $config['upload_path'] = './assets/img/slider/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar_2')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> <strong>Gambar 1 </strong>gagal di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
            die;
        } else {
            $gambar_2 = $this->upload->data('file_name');
        }

        $data = array(
            'gambar_2' => $gambar_2
        );

        $this->db->update('portal', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Gambar 1 </strong>berhasil di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('portal/manage');
    }

    public function edit_gambar3()
    {
        $data['title'] = 'Edit Gambar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $gambar_1 = $_FILES['gambar_3'];

        $config['upload_path'] = './assets/img/slider/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar_3')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> <strong>Gambar 1 </strong>gagal di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
            die;
        } else {
            $gambar_3 = $this->upload->data('file_name');
        }

        $data = array(
            'gambar_3' => $gambar_3
        );

        $this->db->update('portal', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <strong>Gambar 1 </strong>berhasil di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('portal/manage');
    }

    public function edit_deskripsi($id)
    {
        $data['title'] = 'Edit Deskripsi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_portal'] = $this->M_Portal->getDataPortal($id);

        $id_portal = $this->input->post('id_portal');
        $deskripsi = $this->input->post('deskripsi');

        $DataUpdate = array(
            'deskripsi' => $deskripsi,
        );

        $this->form_validation->set_rules('deskripsi', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('portal/edit_deskripsi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Portal->EditDataPortal($DataUpdate, $id_portal);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Deskripsi</strong> berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
        }
    }

    public function edit_kontak($id)
    {
        $data['title'] = 'Edit Kontak';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['data_portal'] = $this->M_Portal->getDataPortal($id);

        $id_portal = $this->input->post('id_portal');
        $info_kepdes = $this->input->post('info_kepdes');
        $info_ketua = $this->input->post('info_ketua');
        $info_pengawas = $this->input->post('info_pengawas');
        $info_bendahara = $this->input->post('info_bendahara');
        $info_sekretaris = $this->input->post('info_sekretaris');
        $info_kepunit = $this->input->post('info_kepunit');

        $DataUpdate = array(
            'info_kepdes' => $info_kepdes,
            'info_ketua' => $info_ketua,
            'info_pengawas' => $info_pengawas,
            'info_bendahara' => $info_bendahara,
            'info_sekretaris' => $info_sekretaris,
            'info_kepunit' => $info_kepunit
        );

        $this->form_validation->set_rules('info_kepdes', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('info_ketua', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('info_pengawas', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('info_bendahara', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('info_sekretaris', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('info_kepunit', 'Judul', 'trim|required', [
            'required' => 'Tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('portal/edit_kontak', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Portal->EditDataPortal($DataUpdate, $id_portal);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Informasi Kontak</strong> berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
        }
    }

    public function edit_strukturOrganisasi()
    {
        $data['title'] = 'Edit Gambar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $struktur_organisasi = $_FILES['struktur_organisasi'];

        $config['upload_path'] = './assets/img/portal/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('struktur_organisasi')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> <strong>Struktur organisasi </strong>gagal di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('portal/manage');
            die;
        } else {
            $struktur_organisasi = $this->upload->data('file_name');
        }

        $data = array(
            'struktur_organisasi' => $struktur_organisasi
        );

        $this->db->update('portal', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <strong>Struktur Organisasi </strong>berhasil di ubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('portal/manage');
    }

    public function hapusPesan($id)
    {
        $this->M_Portal->DeleteData($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Pesan <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('portal/pesan');
    }
}
