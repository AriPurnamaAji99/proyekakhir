<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Laporan');
        $this->load->model('M_Penjualan');
    }

    public function penjualan()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
        $data['rows'] = $this->M_Penjualan->getDataPenjualan()->result();
        $data['tgl_awal_max'] = $this->db->query("SELECT MAX(tgl_awal) as tgl_max_awal FROM data_laporan")->row();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan")->row();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('laporan/penjualan', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $data['kategori'] = $this->input->post('kategori');
            $this->load->view('laporan/cetak_penjualan', $data);
        }
    }

    public function cetak()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();

        $data['tgl_awal'] = $this->input->post('tgl_awal');
        $data['tgl_akhir'] = $this->input->post('tgl_akhir');
        $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
        $this->load->view('laporan/cetak_penjualan', $data);
    }

    // public function struk()
    // {
    //     $data['kode_penjualan'] = $this->uri->segment(3);
    //     $data['penjualan'] = $this->M_Penjualan->getPenjualan()->result();
    //     $data['tanggal_beli'] = $this->db->get_where('penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();
    //     $data['detail_penjualan'] = $this->db->get_where('detail_penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();
    //     $this->load->view('penjualan/struk', $data);
    // }

    public function laba_rugi()
    {
        $data['title'] = 'Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengeluaran'] = $this->db->get('data_barang_masuk')->result();
        $data['rows'] = $this->db->get('penjualan')->result();
        $data['brilink'] = $this->db->get_where('brilink', ['deleted_at' => NULL])->result();
        $data['beban'] = $this->db->get('data_beban')->result();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan_laba_rugi")->row();

        $data['rows'] = $this->M_Laporan->getData()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('laporan/laba_rugi', $data);
        $this->load->view('templates/footer');
    }

    public function data_labarugi_by_tanggal()
    {
        $data['title'] = 'Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
        $data['brilink'] = $this->M_Laporan->brilinkBerdasarkanTanggal()->result();
        $data['pengeluaran'] = $this->M_Laporan->pengeluaranBerdasarkanTanggal()->result();
        $data['beban'] = $this->db->get('data_beban')->result();
        $data['tgl_akhir_max'] = $this->db->query("SELECT MAX(tgl_akhir) as tgl_max_akhir FROM data_laporan_laba_rugi")->row();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('laporan/laba_rugi', $data);
            $this->load->view('templates/footer');
        } else {
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('laporan/laba_rugi', $data);
            $this->load->view('templates/footer');
        }
    }

    public function cetak_labarugi()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['rows'] = $this->M_Penjualan->dataPenjualan()->result();
        $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
        $data['brilink'] = $this->M_Laporan->brilinkBerdasarkanTanggal()->result();
        $data['pengeluaran'] = $this->M_Laporan->pengeluaranBerdasarkanTanggal()->result();
        // $data['pengeluaran'] = $this->db->get('barang')->result();
        // $data['rows'] = $this->db->get('penjualan')->result();
        $data['beban'] = $this->db->get('data_beban')->result();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('laporan/laba_rugi', $data);
            $this->load->view('templates/footer');
        } else {
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
            $data['pengeluaran'] = $this->M_Laporan->pengeluaranBerdasarkanTanggal()->result();
            $data['beban'] = $this->db->get('data_beban')->result();
            $this->load->view('laporan/cetak_laba_rugi', $data);

            // $paper_size = 'A4';
            // $orientation = 'landscape';
            // $html = $this->output->get_output();
            // $this->dompdf->set_paper($paper_size, $orientation);

            // $this->dompdf->load_html($html);
            // $this->dompdf->render();
            // $this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));
        }
    }

    public function input_beban()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => $nominal
        );

        $this->db->insert('data_beban', $data_input);
        $this->session->set_flashdata('message_beban', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/laba_rugi');
    }

    public function ubah_beban()
    {
        $id_beban = $this->input->post('id_beban');
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);

        if ($nominal >= 20000) {
            $data_ubah = array(
                'keterangan' => $this->input->post('keterangan'),
                'nominal' => $nominal
            );

            $this->db->where('id_beban', $id_beban);
            $this->db->update('data_beban', $data_ubah);
            $this->session->set_flashdata('message_beban', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/laba_rugi');
        } else {
            $this->session->set_flashdata('message_beban', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>gagal </strong>diubah. Nominal minimal RP 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/laba_rugi');
        }
    }

    public function hapus_beban($id_beban)
    {
        $this->db->where('id_beban', $id_beban);
        $this->db->delete('data_beban');
        $this->session->set_flashdata('message_beban', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data beban <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/laba_rugi');
    }

    public function neraca()
    {
        $data['title'] = 'Laporan Neraca';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['aktiva_lancar'] = $this->db->get('aktiva_lancar')->result();
        $data['aktiva_tetap'] = $this->db->get('aktiva_tetap')->result();
        $data['modal'] = $this->db->get('modal')->result();
        $data['kas'] = $this->db->get_where('aktiva_lancar', ['id_aktiva_lancar' => 1])->row();
        // $data['rows'] = $this->db->get('penjualan')->result();
        // $data['beban'] = $this->db->get('data_beban')->result();

        $data['rows'] = $this->M_Laporan->getData()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('laporan/neraca', $data);
        $this->load->view('templates/footer');
    }

    public function input_aktiva_lancar()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'nama_aktiva' => $this->input->post('nama_aktiva'),
            'nominal' => $nominal
        );

        $this->db->insert('aktiva_lancar', $data_input);
        $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function ubah_aktiva_lancar()
    {
        $id_aktiva_lancar = $this->input->post('id_aktiva_lancar');
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);

        if ($nominal >= 20000) {
            $data_ubah = array(
                'nama_aktiva' => $this->input->post('nama_aktiva'),
                'nominal' => $nominal
            );

            $this->db->where('id_aktiva_lancar', $id_aktiva_lancar);
            $this->db->update('aktiva_lancar', $data_ubah);
            $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        } else {
            $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>gagal </strong>diubah. Nominal minimal Rp 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        }
    }

    public function hapus_aktiva_lancar($id_aktiva_lancar)
    {
        $this->db->where('id_aktiva_lancar', $id_aktiva_lancar);
        $this->db->delete('aktiva_lancar');
        $this->session->set_flashdata('message_aktiva_lancar', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva lancar <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function input_aktiva_tetap()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'nama_aktiva' => $this->input->post('nama_aktiva'),
            'nominal' => $nominal
        );

        $this->db->insert('aktiva_tetap', $data_input);
        $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function ubah_aktiva_tetap()
    {
        $id_aktiva_tetap = $this->input->post('id_aktiva_tetap');
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        // $nominal = str_replace('.', '', $this->input->post('nominal'));

        if ($nominal >= 20000) {
            $data_ubah = array(
                'nama_aktiva' => $this->input->post('nama_aktiva'),
                'nominal' => $nominal
            );

            $this->db->where('id_aktiva_tetap', $id_aktiva_tetap);
            $this->db->update('aktiva_tetap', $data_ubah);
            $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        } else {
            $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>gagal </strong>diubah. Nominal minimal Rp 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        }
    }

    public function hapus_aktiva_tetap($id_aktiva_tetap)
    {
        $this->db->where('id_aktiva_tetap', $id_aktiva_tetap);
        $this->db->delete('aktiva_tetap');
        $this->session->set_flashdata('message_aktiva_tetap', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function input_modal()
    {
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);
        $data_input = array(
            'keterangan' => $this->input->post('keterangan'),
            'nominal' => $nominal
        );

        $this->db->insert('modal', $data_input);
        $this->session->set_flashdata('message_modal', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data modal <strong>berhasil </strong>ditambahkan.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function ubah_modal()
    {
        $id_modal = $this->input->post('id_modal');
        // $nominal = str_replace('.', '', $this->input->post('nominal'));
        $hilangRp = str_replace('Rp', '', $this->input->post('nominal'));
        $nominal = str_replace('.', '', $hilangRp);

        if ($nominal >= 20000) {
            $data_ubah = array(
                'keterangan' => $this->input->post('keterangan'),
                'nominal' => $nominal
            );

            $this->db->where('id_modal', $id_modal);
            $this->db->update('modal', $data_ubah);
            $this->session->set_flashdata('message_modal', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        } else {
            $this->session->set_flashdata('message_modal', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data <strong>berhasil </strong>diubah. Nominal minimal Rp 20.000
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('laporan/neraca');
        }
    }

    public function hapus_modal($id_modal)
    {
        $this->db->where('id_modal', $id_modal);
        $this->db->delete('modal');
        $this->session->set_flashdata('message_modal', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> Data aktiva tetap <strong>berhasil </strong>dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('laporan/neraca');
    }

    public function cetak_neraca()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Neraca';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['aktiva_lancar'] = $this->db->get('aktiva_lancar')->result();
        $data['aktiva_tetap'] = $this->db->get('aktiva_tetap')->result();
        $data['modal'] = $this->db->get('modal')->result();
        $data['kas'] = $this->db->get_where('aktiva_lancar', ['id_aktiva_lancar' => 1])->row();
        $this->load->view('laporan/cetak_neraca', $data);

        // $paper_size = 'A4';
        // $orientation = 'landscape';
        // $html = $this->output->get_output();
        // $this->dompdf->set_paper($paper_size, $orientation);

        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));

    }
}
